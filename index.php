<?php

    define('_ROOTPATH_',__DIR__);

    spl_autoload_register();

    use App\controller\Controller;

    require_once _ROOTPATH_.'/templates/header.php';

    $controller=new Controller();
    $controller->route();

    require_once _ROOTPATH_.'/templates/footer.php';
?>
