<?php
namespace app\controllers;
/**
 * Created by PhpStorm.
 * User: Listat
 * Date: 20.02.2017
 * Time: 13:08
 */
use app\commands\Dadata;
use app\modules\ls_admin\models\Document;
use app\modules\ls_admin\models\DocumentItem;
use app\modules\ls_admin\models\LoginForm;
use app\modules\ls_admin\models\Partner;
use app\modules\ls_admin\models\User;
use kartik\mpdf\Pdf;
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

    public function actionAdd_product_up(){
        if (isset($_POST['id'])){
            $documentItem = new DocumentItem();
            $documentItem->order_id = $_POST['doc_id'];
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

    public function actionUpdate_paid(){
        if (isset($_POST['id'])){
            $document = Document::findOne($_POST['id']);
            if ($document){
                $document->paid = isset($_POST['status']);
                if ($document->save())
                    return true;
                else
                    return false;
            }
            else
                return false;
        }else{
            return false;
        }
    }

    public function actionDoc_pdf($id){

        $document = Document::findOne($id);

        $content = $this->renderPartial('pdf',[
            'document'=>$document,
        ]);
        $pdf = new Pdf([
            'filename'=>'Счет на оплату № '. $document->id .' от "' . Yii::$app->formatter->asDate($document->data_document).'".pdf',
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_DOWNLOAD,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            //'cssFile' => '@web/frontend/css/main.css',
            // any css to be embedded if required
            'cssInline' => '.sum_param{color: #a9a9a9;
                                        float: left;
                                        font-size: 15px;
                                        line-height: 15px;
                                        margin: 0 2% 20px 0;
                                        width: 30%;}',
            // set mPDF properties on the fly
            //'options' => ['title' => 'Krajee Report Title'],
            // call mPDF methods on the fly
//            'methods' => [
//                'SetHeader'=>['Krajee Report Header'],
//                'SetFooter'=>['{PAGENO}'],
//            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    public function actionLogin(){
        if (isset($_POST['email'])){
            $user = User::findOne(['email'=>$_POST['email']]);
            if ($user){
                Yii::$app->mailer->compose()
                    ->setFrom('from@domain.com')
                    ->setTo('to@domain.com')
                    ->setSubject('Код входа на сайт')
                    ->setHtmlBody('Код: '.$user->password)
                    ->send();
                return true;
            } else {
                return false;
            }
        }
    }

    public function actionLogin_kod(){
        $model = new LoginForm();

        $model->email = $_POST['email'];
        $model->password = $_POST['kod'];
        if ($model->login()) {
            return true;
        }
        return false;
    }

}
