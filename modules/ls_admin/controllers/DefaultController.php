<?php

namespace app\modules\ls_admin\controllers;

use app\modules\ls_admin\models\Company;
use app\modules\ls_admin\models\Document;
use app\modules\ls_admin\models\DocumentItem;
use app\modules\ls_admin\models\DocumentItemSearch;
use app\modules\ls_admin\models\Partner;
use app\modules\ls_admin\models\ProductSearch;
use app\modules\ls_admin\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\modules\ls_admin\models\LoginForm;
use app\modules\ls_admin\models\RegForm;

class DefaultController extends Controller
{
    public $layout = 'admin';
    public function actionIndex()
    {
        Yii::$app->session->set('id_doc_create', false);
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(['/admin/document/index']);
//            return $this->render('index');
        }else {
            return $this->redirect(['/admin/signin']);
        }
    }
    public function actionSignin()
    {
        $error=false;
        $this->layout = 'main';
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(['/admin/index']);
        }

        $model = new LoginForm();

        if (Yii::$app->request->post()){

            $model->email = Yii::$app->request->post('email');
            $model->password = Yii::$app->request->post('password');
            $model->rememberMe = Yii::$app->request->post('rememberMe');
            if ($model->login()) {

                return $this->redirect(['/admin/index']);
            }
            if ($model->validate()){
                $error=false;
            }else {
                $error =$model->errors;
            }
        }
        return $this->render('log', [
            'model' => $model,
            'masseg' => $error,
        ]);
    }


    public function actionSignup()
    {
        $this->layout = 'main';
        $error = false;

        $model = new RegForm();
        if (Yii::$app->request->post()) {
            $model->username = Yii::$app->request->post('username');
            $model->lastname = Yii::$app->request->post('lastname');
            $model->password = Yii::$app->request->post('password');
            $model->login = Yii::$app->request->post('login');
            $model->email = Yii::$app->request->post('email');
            if ( $model->validate()):
                if ($user = $model->reg()):
                    if ($user->status === User::STATUS_ACTIVE):
                        if (Yii::$app->getUser()->login($user)):
                            return $this->redirect(['/admin/index']);
                        endif;
                    endif;
                endif;
            endif;
            if ($model->validate()) {
                $error = false;
            } else {
                $error = $model->errors;
            }
        }
        return $this->render(
            'reg',
            [
                'model' => $model,
                'masseg' => $error,
            ]
        );
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['/admin/signin']);
    }

    public function actionDocument1()
    {
        $document = new Document();
        $document->status_id=0;
        $document->paid=0;

        $kontrahent = new Partner();

        $documentItems = new DocumentItemSearch(['order_id'=> 0-Yii::$app->user->id]);
        $documentItemsDataProvider = $documentItems->search(Yii::$app->request->queryParams);

        $temp = DocumentItem::findAll(['order_id'=> 0-Yii::$app->user->id]);

        $document->total=0;
        foreach ($temp as $item){
            $document->total += $item->price * $item->quantity;
        }

        if (isset($_POST['add_partner'])){
            if ($kontrahent->load(Yii::$app->request->post()))
                if ($kontrahent->save()){
                    $document->partner_id = $kontrahent->id;
                    Yii::$app->session->set('savePartner',true);
                }else{
                    Yii::$app->session->set('savePartner',false);
                }
        }

        $productSearch = new ProductSearch();
        $productDataProvider = $productSearch->search(Yii::$app->request->queryParams);

        if (isset($_POST['add_document'])){
            if ($document->load(Yii::$app->request->post()))
                if ($document->save()){
                    DocumentItem::updateAll(['order_id' => $document->id], ['order_id' => 0-Yii::$app->user->id]);
                    return $this->redirect('document/index');
                }
        }


        return $this->render('document',[
            'document' => $document,
            'kontrahent' => $kontrahent,
            'documentItems' => $documentItems,
            'documentItemsDataProvider' => $documentItemsDataProvider,
            'productSearch' => $productSearch,
            'productDataProvider' => $productDataProvider,
        ]);
    }
    public function actionDocument()
    {
        if ($_POST){
            if(Yii::$app->session->get('id_doc_create')){
                $document = Document::findOne(Yii::$app->session->get('id_doc_create'));
                $document->load(Yii::$app->request->post());
            }else{
                $document = Document::findOne($_POST['Document']['id']);
                $document->load(Yii::$app->request->post());
            }

        } else {
            if (Yii::$app->session->get('id_doc_create')){
                $document = Document::findOne(Yii::$app->session->get('id_doc_create'));
            } else {
                $company = Company::find()->one();
                $document = new Document();
                $document->status_id = 1;
                $document->paid = 0;
                $document->total = 0;
                if ($company)
                    $document->company_id = $company->id;
                else
                    $document->company_id = 0;
                $document->partner_id = 0;
                $document->save();
                Yii::$app->session->set('id_doc_create', $document->id);
            }
        }

        if (!Yii::$app->user->isGuest){
            $document->partner_id = Yii::$app->user->identity['partner_id'];
        }else{
            $document->partner_id = null;
        }

        $kontrahent = new Partner();

        $documentItems = new DocumentItemSearch(['order_id'=>$document->id]);
        $documentItemsDataProvider = $documentItems->search(Yii::$app->request->queryParams);

        $temp = DocumentItem::findAll(['order_id'=> $document->id]);

        foreach ($temp as $item){
            $document->total += $item->price * $item->quantity;
        }

        if (isset($_POST['add_partner'])){
            if ($kontrahent->load(Yii::$app->request->post()))
                if ($kontrahent->save()){
                    $document->partner_id = $kontrahent->id;
                    Yii::$app->session->set('savePartner',true);
                }else{
                    Yii::$app->session->set('savePartner',false);
                }
        }

        $productSearch = new ProductSearch();
        $productDataProvider = $productSearch->search(Yii::$app->request->queryParams);

        if (isset($_POST['add_document'])){
            if ($document->load(Yii::$app->request->post()))
                if ($document->save()){
//                    DocumentItem::updateAll(['order_id' => $document->id], ['order_id' => 0-Yii::$app->user->id]);
//                    return $this->redirect('/index');

                    switch ($_POST['add_document']){
                        case 'act_b':
                            $this->redirect('/api/doc_pdf?id='.$document->id.'&type=act_b');
                            break;
                        case 'dohovor_b':
                            $this->redirect('/api/doc_pdf?id='.$document->id.'&type=dohovor_b');
                            break;
                    }
                    Yii::$app->session->set('id_doc_create', false);

                }
        }


        return $this->render('document',[
            'document' => $document,
            'kontrahent' => $kontrahent,
            'documentItems' => $documentItems,
            'documentItemsDataProvider' => $documentItemsDataProvider,
            'productSearch' => $productSearch,
            'productDataProvider' => $productDataProvider,
        ]);
    }
}
