<?php

namespace app\modules\ls_admin\controllers;

use app\modules\ls_admin\models\DocumentItem;
use app\modules\ls_admin\models\DocumentItemSearch;
use app\modules\ls_admin\models\Partner;
use app\modules\ls_admin\models\ProductSearch;
use Yii;
use app\modules\ls_admin\models\Document;
use app\modules\ls_admin\models\DocumentSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DocumentController implements the CRUD actions for Document model.
 */
class DocumentController extends Controller
{
    /**
     * @inheritdoc
     */
  public $layout = 'admin';
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
          'access' => [
            'class' => AccessControl::className(),
            'rules' => [
              [
                'allow' => true,
                'roles' => ['@'],
              ],
            ],
          ],
        ];
    }

    /**
     * Lists all Document models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort=false;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Document model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Document model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Document();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Document model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $document = $this->findModel($id);

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
                    return $this->redirect('document/index');
                }
        }


        return $this->render('update',[
            'document' => $document,
            'kontrahent' => $kontrahent,
            'documentItems' => $documentItems,
            'documentItemsDataProvider' => $documentItemsDataProvider,
            'productSearch' => $productSearch,
            'productDataProvider' => $productDataProvider,
        ]);
    }

    /**
     * Deletes an existing Document model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Document model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Document the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Document::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
