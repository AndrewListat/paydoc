<?php
namespace app\widgets;
/**
 * Created by PhpStorm.
 * User: Listat
 * Date: 27.02.2017
 * Time: 22:44
 */
class ButtonPdfWidget extends \yii\base\Widget {

    public function init(){
        parent::init();
    }

    public function run(){

        return $this->render('buttonPdf');
    }

}