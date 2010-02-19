<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
    </head>
    <body>
        <div id="templatemo_container">
            <div id="templatemo_menu"> 
                <div id="login_box">
                <?php include_component('profile', 'loginBox') ?>
                </div>
            </div> <!-- end of menu -->

            <div id="templatemo_banner_bar">
                <div id="site_title">
                    <h1>
                        <a href="/">Cukorka.SCH<span>Webteam HMS - Homework Management System</span></a>            </h1>
                </div>
            </div> <!-- end of banner -->

            <div id="templatemo_content">
            <?php if ($sf_user->hasFlash('message')): ?>
                <div id="messages-outer">
                    <div id="messages">
                        <?php echo $sf_user->getFlash('message') ?>
                    </div>
                </div>
            <?php endif; ?>
                <div id="side_column">
                    <?php if (has_slot('sidebar')): ?>
                        <?php include_slot('sidebar') ?>
                    <?php endif; ?>
                </div><!-- end of side column -->

                <div id="main_column">
                    <?php if (has_slot('main')): ?>
                        <?php include_slot('main') ?>
                    <?php endif; ?>
                </div> <!-- end of main column -->

                <div class="cleaner"></div>
            </div> <!-- end of content -->
            <div id="templatemo_footer_bar">
                Copyright © 2010 <a href="http://kszk.sch.bme.hu/webteam">KSZK Webteam</a> |
                Designed by <a href="http://www.templatemo.com" target="_parent">Free CSS Templates</a> |
                Validate <a href="http://validator.w3.org/check?uri=referer">XHTML</a> &amp; <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>
            </div>

        </div><!-- end of container -->
    </body>
</html>