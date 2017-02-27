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
use app\modules\ls_admin\models\Product;
use app\modules\ls_admin\models\RegForm;
use app\modules\ls_admin\models\UiBanks;
use app\modules\ls_admin\models\User;
use kartik\mpdf\Pdf;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
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
            $documentItem->price = $_POST['price'];
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

    public function actionDoc_pdf($id=46,$type='rah'){
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/pdf');

        $document = Document::findOne($id);

        $filename = '';

        $orint = true;

        switch ($type){
            case 'act_b':
                $content = $this->renderPartial('pdf_act_b',[
                    'document'=>$document,
                    'image' => false,
                ]);
                $orint = true;
                $filename = 'Акт о передачи права без печати № '. $document->id .' от '. Yii::$app->formatter->asDate($document->data_document).'.pdf';
                break;
            case 'rah_b':
                $orint = false;
                $content = $this->renderPartial('pdf_rah',[
                    'document'=>$document,
                    'image' => false,
                ]);
                $filename = 'Счет на оплату без печати № '. $document->id .' от '. Yii::$app->formatter->asDate($document->data_document).'.pdf';
                break;
            case 'act_z':
                $content = $this->renderPartial('pdf_act_b',[
                    'document'=>$document,
                    'image' => true,
                ]);
                $orint = true;
                $filename = 'Акт о передачи права c печати № '. $document->id .' от '. Yii::$app->formatter->asDate($document->data_document).'.pdf';
                break;
            case 'rah_z':
                $orint = false;
                $content = $this->renderPartial('pdf_rah',[
                    'document'=>$document,
                    'image' => true,
                ]);
                $filename = 'Счет на оплату c печати № '. $document->id .' от '. Yii::$app->formatter->asDate($document->data_document).'.pdf';
                break;
        }


        $pdf = new Pdf([
            'filename'=>$filename,
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
//            'orientation' => Pdf::ORIENT_PORTRAIT,
            'orientation' => ($orint) ? Pdf::ORIENT_LANDSCAPE : Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_DOWNLOAD,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            //'cssFile' => '@web/frontend/css/main.css',
            // any css to be embedded if required
            'cssInline' => '.img_p{position: absolute;left: 0; top: 0;}',
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
                    ->setTo($_POST['email'])
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

    public function AddUser($user){
        $model = new RegForm();
        $model->username = $user->name;
        $model->lastname = 'Surname'.$user->name;
        $model->password = Yii::$app->getSecurity()->generateRandomString(5);
        $model->login = 'User_'.time();
        $model->email = $user->email;
        $model->role = 'user';
        $model->partner_id = $user->id;
        if ( $model->validate()):
            if ($user = $model->reg()):
                if (Yii::$app->user->isGuest):
                    Yii::$app->getUser()->login($user);
                endif;
            endif;
        endif;
    }

    public function actionGet_partner_create(){
        return Yii::$app->session->get('savePartner');
    }

    public function actionGet_bank(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['status'=>false, 'results' => ['kor_rah' => '', 'name_bank' => '']];

        $bank = UiBanks::findOne(['bik'=>$_POST['bik']]);
        if ($bank){
            $out = ['status'=>true, 'results' => ['kor_rah' => $bank->ks, 'name_bank' => $bank->name]];
        }

        return $out;
    }

    public function actionGet_category(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out[] = ['text'=>'Главная', 'cat_id'=> 0, 'selectedIcon' => "glyphicon glyphicon-check", 'icon' => "glyphicon glyphicon-unchecked", 'nodes'=>[]];

        $categories = Product::findAll(['group'=>1]);

        $row = [];
        foreach ($categories as $category){
            if ($category->parent_id == 0){
                $out[0]['nodes'][] = ['text'=>$category->name, 'cat_id'=> $category->id, 'selectedIcon' => "glyphicon glyphicon-check", 'icon' => "glyphicon glyphicon-unchecked"];
            }else{
                foreach ($out[0]['nodes'] as $des){
                    if ($des['cat_id']==$category->parent_id){
                        $rrr[] = $this->parent_cat($category->parent_id);
                        $des['nodes'][]= ['text'=>$category->name, 'cat_id'=> $category->id, 'selectedIcon' => "glyphicon glyphicon-check", 'icon' => "glyphicon glyphicon-unchecked",'nodes'=>$rrr];
                    }
                }
            }
        }

        return $out;
    }

    public function parent_cat($id){
        $cats = Product::findAll(['id'=>$id]);
        $array = [];
        foreach ($cats as $cat){
            if ($cat->parent_id == 0){
                return ['text'=>$cat->name, 'cat_id'=> $cat->id, 'selectedIcon' => "glyphicon glyphicon-check", 'icon' => "glyphicon glyphicon-unchecked"];
            }else{
                $rrr[] = $this->parent_cat($cat->parent_id);
                $array = ['text'=>$cat->name, 'cat_id'=> $cat->id, 'selectedIcon' => "glyphicon glyphicon-check", 'icon' => "glyphicon glyphicon-unchecked",'nodes'=>$rrr];
            }
        }
        return $array;
    }

    public function actionGet_category1(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $out[] = ['text'=>'Главная', 'cat_id'=> 0, 'state' => ['checked' => true] ,'selectable' => true, 'selectedIcon' => "glyphicon glyphicon-check", 'icon' => "glyphicon glyphicon-unchecked", 'nodes'=>[]];


        $out[0]['nodes'] = $this->parent_cat1(0);
        $categories = Product::find()->select(['id','name','parent_id'])->where(['group'=>1])->orderBy(['parent_id'=>SORT_ASC])->asArray()->all();
        $result = ArrayHelper::map($categories, 'id', 'name', 'parent_id');

        /*foreach ($result as $key => $value){
            foreach ($value as $index => $item){
                echo $index;
                echo $item;
            }
            var_dump($key);
            var_dump($value);
        }*/

//        $this->parent_cat1(0);


        return $out;

    }

    public function parent_cat1($id){
        $categories = Product::find()->select(['id','name','parent_id'])->where(['group'=>1])->orderBy(['parent_id'=>SORT_ASC])->asArray()->all();

        $result = ArrayHelper::map($categories, 'id', 'name', 'parent_id');

//        var_dump($result);

        $array = [];
        if (array_key_exists($id, $result)) {
            foreach ($result[$id] as $key => $name){
//                var_dump($key);
//                var_dump($name);
                if (array_key_exists($key, $result)){
                    $array[]= ['text'=>$name, 'cat_id'=> $key, 'selectedIcon' => "glyphicon glyphicon-check", 'icon' => "glyphicon glyphicon-unchecked",'nodes'=> $this->parent_cat1($key)];
                } else {
                    $array[]= ['text'=>$name, 'cat_id'=> $key, 'selectedIcon' => "glyphicon glyphicon-check", 'icon' => "glyphicon glyphicon-unchecked"];
                }
            }
        }
        return $array;
    }

}
