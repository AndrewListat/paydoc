<?php
namespace app\controllers;
/**
 * Created by PhpStorm.
 * User: Listat
 * Date: 20.02.2017
 * Time: 13:08
 */
use app\commands\Dadata;
use app\modules\ls_admin\models\DocumentItem;
use app\modules\ls_admin\models\Partner;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class ApiController extends Controller{

    public function beforeAction($action) {
      $this->enableCsrfValidation = false;
      return parent::beforeAction($action);
    }

    public function actionPartner($q = null, $id = null) {
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      $out = ['results' => ['id' => '', 'text' => '']];
      if (!is_null($q)) {
        $query = new Query();
        $query->select('id, name AS text')
          ->from('prefix_partner')
          ->where(['like', 'name', $q])
          ->limit(20);
        $command = $query->createCommand();
        $data = $command->queryAll();
        $out['results'] = array_values($data);
      }
      elseif ($id > 0) {
        $out['results'] = ['id' => $id, 'text' => Partner::find($id)->name];
      }
      return $out;
    }

    public function actionInfo_inn($q = null){

        $dadata = new Dadata();
        print_r($dadata->suggest("address", array("query"=>"Москва", "count"=>2)));
    }

    public function actionAdd_product(){
        if (isset($_POST['id'])){
            $documentItem = new DocumentItem();
            $documentItem->order_id = 0 - Yii::$app->user->id;
            $documentItem->product_id=$_POST['id'];
            $documentItem->quantity=$_POST['count'];
            $documentItem->price = 5;
            if ($documentItem->save())
                return true;
            else
                return false;
        }else{
            return false;
        }
    }
    public function actionDelete_product(){
        if (isset($_POST['id'])){
            $documentItem = DocumentItem::findOne($_POST['id']);
            if ($documentItem)
                if ($documentItem->delete())
                    return true;
                else
                    return false;
            else
                return false;
        }else{
            return false;
        }
    }
}
