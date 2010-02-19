<?php

/**
 * Description of SSLFilterclass
 *
 * @author szel
 */
class SSLFilter extends sfFilter {

    
    public function execute($filterchain) {
        $request = sfContext::getInstance()->getRequest();
        if(!$request->isSecure()) {
            $url = $request->getUri();
            $url = preg_replace("/^http:/", "https:", $url);
            sfContext::getInstance()->getController()->redirect($url);
        }
        $filterchain->execute();
    }
    
}
?>
