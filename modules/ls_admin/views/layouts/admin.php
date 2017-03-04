<?php
/**
 * Created by PhpStorm.
 * User: Listat
 * Date: 30.11.2015
 * Time: 17:24
 */

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\MainAsset;
use yii\helpers\Url;

MainAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="en-US">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <?php $this->beginBody() ?>

    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="#" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>A</b>LT</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Admin</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->

                        <!-- Notifications: style can be found in dropdown.less
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">10</span>
                            </a>
                        </li>
                         Tasks: style can be found in dropdown.less -->
                        <li><a href="<?=Url::toRoute('default/logout');?>"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Выход</a></li>

                    </ul>

                </div>
            </nav>
        </header>

        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- sidebar menu: : style can be found in sidebar.less -->
                <!--<ul class="sidebar-menu">
                    <li class="treeview">
                        <a href="<?/*=Url::toRoute('default/index');*/?>">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>
                </ul>-->
               <!-- <ul class="sidebar-menu">
                    <li class="treeview">
                        <a href="<?/*=Url::toRoute('user/index');*/?>">
                            <i class="fa fa-folder-open"></i> <span>Users</span>
                        </a>
                    </li>
                </ul>-->
                 <ul class="sidebar-menu">
                    <li class="treeview">
                        <a href="<?=Url::toRoute('user/index');?>">
                            <i class="fa fa-folder-open"></i> <span>Администраторы</span>
                        </a>
                    </li>
                </ul>
                <!--<ul class="sidebar-menu">
                    <li class="treeview">
                        <a href="<?/*=Url::toRoute('pages/index');*/?>">
                            <i class="fa fa-folder-open"></i> <span>Pages</span>
                        </a>
                    </li>
                </ul>-->
                <ul class="sidebar-menu">
                    <li class="treeview">
                        <a href="<?=Url::toRoute('default/document');?>">
                            <i class="fa fa-file-o"></i> <span>Новый документ</span>
                        </a>
                    </li>
                </ul>
                <ul class="sidebar-menu">
                    <li class="treeview">
                        <a href="<?=Url::toRoute('document/index');?>">
                            <i class="fa fa-files-o"></i> <span>Документы</span>
                        </a>
                    </li>
                </ul>
                <ul class="sidebar-menu">
                    <li class="treeview">
                        <a href="<?=Url::toRoute('company/index');?>">
                            <i class="fa fa-clone"></i> <span>Организации</span>
                        </a>
                    </li>
                </ul>
                <ul class="sidebar-menu">
                    <li class="treeview">
                        <a href="<?=Url::toRoute('partner/index');?>">
                            <i class="fa fa-users"></i> <span>Контрагенты</span>
                        </a>
                    </li>
                </ul>
                <ul class="sidebar-menu">
                    <li class="treeview">
                        <a href="<?=Url::toRoute('product/index');?>">
                            <i class="fa fa-suitcase"></i> <span>Номенклатура</span>
                        </a>
                    </li>
                </ul>
                <ul class="sidebar-menu">
                    <li class="treeview">
                        <a href="<?=Url::toRoute('typestorage/index');?>">
                            <i class="fa fa-building"></i> <span>Склады</span>
                        </a>
                    </li>
                </ul>
                <ul class="sidebar-menu">
                    <li class="treeview">
                        <a href="<?=Url::toRoute('typeprice/index');?>">
                            <i class="fa fa-usd"></i> <span>Типы Цен</span>
                        </a>
                    </li>
                </ul>
                <ul class="sidebar-menu">
                    <li class="treeview">
                        <a href="<?=Url::toRoute('statusdocument/index');?>">
                            <i class="fa fa-cogs"></i> <span>Настройка</span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= $content ?>
            </section>
        </div><!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
            </div>
        </footer>

        <!-- Add the sidebar's background. This div must be placed
             immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->


    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>