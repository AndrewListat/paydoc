<?php

namespace app\modules\ls_admin\controllers;
\Yii::$app->session->set('id_doc_create', false);
use Yii;
use app\modules\ls_admin\models\TypeStorage;
use app\modules\ls_admin\models\TypeStorageSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TypestorageController implements the CRUD actions for TypeStorage model.
 */
class TypestorageController extends Controller
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
            'auth'=>[
                'class' =>'app\commands\Auth',
            ],
        ];
    }

    /**
     * Lists all TypeStorage models.
     * @return mixed
     */
    public function actionIndex()
    {


        $store = new TypeStorage();

        if (Yii::$app->request->post()){
            if ($store->load(Yii::$app->request->post())){
                if ($store->save()){
                    $store = new TypeStorage();
                }
            }
        }

        if(isset($_POST['up_store']) && isset($_POST['up_id'])){
            $upModel = TypeStorage::findOne($_POST['up_id']);
            if($upModel){
                $upModel->name=$_POST['up_name'];
                $upModel->save();
            }

        }

        $searchModel = new TypeStorageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'store' => $store,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TypeStorage model.
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
     * Creates a new TypeStorage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TypeStorage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TypeStorage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TypeStorage model.
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
     * Finds the TypeStorage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TypeStorage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TypeStorage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
