<?php

namespace app\controllers;

use app\modules\ls_admin\models\Document;
use app\modules\ls_admin\models\DocumentItem;
use app\modules\ls_admin\models\DocumentItemSearch;
use app\modules\ls_admin\models\DocumentSearch;
use app\modules\ls_admin\models\Partner;
use app\modules\ls_admin\models\ProductSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        if(Yii::$app->user->isGuest)
            return $this->render('index');
        else{
            $searchModel = new DocumentSearch(['partner_id'=>Yii::$app->user->identity['partner_id']]);
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->sort=false;

            return $this->render('all_document', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionDocument_delete($id)
    {
        Document::findOne($id)->delete();
        return $this->goHome();
    }

    public function actionDocument_update($id)
    {
        $document = Document::findOne($id);

        $kontrahent = new Partner();

        $documentItems = new DocumentItemSearch(['order_id'=> $document->id]);
        $documentItemsDataProvider = $documentItems->search(Yii::$app->request->queryParams);

        $temp = DocumentItem::findAll(['order_id'=> $document->id]);
        $document->total=0;
        foreach ($temp as $item){
            $document->total += $item->price * $item->quantity;
        }

        if (isset($_POST['add_partner'])){
            if ($kontrahent->load(Yii::$app->request->post()))
                if ($kontrahent->save()){
                    $document->partner_id = $kontrahent->id;
                    Yii::$app->session->setFlash('modalKontrahent');
                }
        }

        $productSearch = new ProductSearch();
        $productDataProvider = $productSearch->search(Yii::$app->request->queryParams);

        if (isset($_POST['add_document'])){
            if ($document->load(Yii::$app->request->post()))
                if ($document->save()){
                    return $this->goHome();
                }
        }


        return $this->render('document_update',[
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
        $document = new Document();
        $document->status_id=0;
        $document->paid=0;

        if (Yii::$app->session->get('partner_create')){
            $document->partner_id = Yii::$app->session->get('partner_id');
        }

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
                    Yii::$app->session->set('partner_create',true);
                    Yii::$app->session->set('partner_id',$kontrahent->id);
                }
        }

        $productSearch = new ProductSearch();
        $productDataProvider = $productSearch->search(Yii::$app->request->queryParams);

        if (isset($_POST['add_document'])){
            if ($document->load(Yii::$app->request->post()))
                if ($document->save()){
                    DocumentItem::updateAll(['order_id' => $document->id], ['order_id' => 0-Yii::$app->user->id]);
                    return $this->redirect('/index');
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
