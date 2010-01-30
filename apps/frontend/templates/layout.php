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
        <div id="page">
            <div id="header">
                <h1>Cukorka.SCH</h1>
                <span>HMS - Homework Management System</span>
                <div id="login_box">
                    <?php include_component('profile', 'loginBox') ?>
                </div>
            </div>
            <div id="content">
                <div id="messages">
                    <?php if ($sf_user->hasFlash('message')): ?>
                        <?php echo $sf_user->getFlash('message') ?>
                    <?php endif; ?>
                </div>
                <div id="sidebar">
                    <?php if (has_slot('sidebar')): ?>
                        <?php include_slot('sidebar') ?>
                    <?php endif; ?>
                </div>
                <div id="main">
                    <?php if (has_slot('main')): ?>
                        <?php include_slot('main') ?>
                    <?php endif; ?>
                </div>
            </div>
            <div id="footer">
                Copyright Webteam 2010
            </div>
        </div>
    </body>
</html>
