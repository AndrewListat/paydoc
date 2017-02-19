<?php
/**
 * Created by PhpStorm.
 * User: Listat
 * Date: 30.11.2015
 * Time: 17:38
 */
namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'template_admin/assets/css/AdminLTE.min.css',
        'template_admin/assets/css/skins/_all-skins.min.css',

    ];
    public $js = [
        'template_admin/plugins/slimScroll/jquery.slimscroll.min.js',
        'template_admin/plugins/fastclick/fastclick.min.js',
        'template_admin/assets/js/app.min.js',
        'template_admin/assets/js/demo.js',
        'template_admin/bootstrap/js/bootstrap.min.js',


    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}