<?php
/**
 * Description of sfSchaccFilter
 *
 * @author szel
 */
class sfSchaccFilter extends sfFilter {

    /**
     *
     * @return sfGuardSecurityUser
     */
    protected function getUser() {
        return $this->getContext()->getUser();
    }

    protected function isSignin() {
        return $this->getRequest()->getMethod() == 'POST' &&
                $this->getRequest()->hasParameter('signin');
    }

    /**
     *
     * @return sfRequest
     */
    protected function getRequest() {
        return $this->getContext()->getRequest();
    }

    protected function getPostParameter($name) {
        return $this->getRequest()->getParameter($name);
    }

    public static function getLDAP($username = null, $password = null) {
        return new adLDAP(array_merge(sfConfig::get('sf_Schacc_LDAP'),
                array(
                    'ad_username' => $username,
                    'ad_password' => $password
                )
        ));
    }

    protected function getUserData($username, $password, $keys = array('*')) {
        return $this->getLDAP($username, $password)->user_info($username, $keys);
    }

    protected function updateProfile($user, $data) {
        $userData = $this->getUserData(
                        $data['username'],
                        $data['password'],
                        array_keys(sfConfig::get('sf_Schacc_Profile'))
                    );

        $user->is_schacc = true;
        $user->password = $data['password'];
        
        foreach(sfConfig::get('sf_Schacc_Profile') as $key => $value) {
            $user->Profile->{$value} = $userData[0][$key][0];
        }
        
        if(in_array($data['username'], sfConfig::get('sf_Schacc_Admins'))) {
            $user->is_super_admin = true;
        }
        $user->save();
    }

    /**
     *
     * @param sfFilterChain $filterChain
     */
    public function execute ($filterChain) {

        //Ha be van kapcsolva a Schacc login és
        //Ha nem is akar bejeletkezni, akkor nincs semmi dolgunk, mehet tovább a lánc
        if(!sfConfig::get('sf_Schacc_enable') || !$this->isSignin()) {
            $filterChain->execute();
            return;
        }

        $post = $this->getPostParameter('signin');
        $user = Doctrine::getTable('SchaccUser')->findOneBy('username', $post['username']);

        //Ha van lokális user, ami nem schacc-al került be
        //Ezt nem a mi dolgunk kezelni, továbbküldjük
        if($user && !$user->is_schacc) {
            $filterChain->execute();
            //ha ide eljutunk azt jelenti, hogy nem sikerült autentikálni lokális adatbázisból
            //ezt később figyelembe kell vennünk
            $has_local_non_schacc_acc = true;
        }

        //Schacc autentikáció
        $this->form = new sfGuardFormSignin();
        $this->form->getValidatorSchema()->setPostValidator(new sfSchaccValidatorUser());
        $this->form->bind($post);

        if($this->form->isValid()) {
            //sikerült autentikálni a Schacc-t

            if($has_local_non_schacc_acc) {
                //ha ide jutunk az nagy baj
                //azt jelenti, hogy valaki egy Schacc-al próbált bejelentkezni
                //de már van egy ugyan olyan felhasználó nevű, de más jelszavú user,
                //aki korábban nem Schaccal lépett be,
                //hanem regisztrált
                //erről nem tudhatjuk biztosan, hogy Ő-e, így figyelmeztetjük
                throw (new Exception(<<<EOF
                    Schaccal próbáltál bejelentkezni, 
                    de már van egy ilyen nevű user az adatbázisban,
                    aki korábban regisztrált.
                    Ha Te vagy ez a meglévő felhasználó,
                    lépj be a regisztrációnál megadott jelszavaddal.
                    Ha nem Te vagy, akkor sajnos más olyan felhasználónevet választott,
                    ami a Te Schaccod. Kérlek regisztrálj egy másik névvel.
EOF
                ));
            }

            $values = $this->form->getValues();

            //Ha nem volt eddig ilyen user
            if(!$user) {
                $user = new SchaccUser();
                $user->username = $values['username'];
            }

            $this->updateProfile($user, $post);

            $this->getUser()->signin($user, array_key_exists('remember', $values) ? $values['remember'] : false);

            // always redirect to a URL set in app.yml
            // or to the referer
            // or to the homepage
            $signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url', $user->getReferer(''));

            $this->getContext()->getController()->redirect('' != $signinUrl ? $signinUrl : '@homepage');
        }
        $filterChain->execute();
    }
}
?>
