<?php

namespace app\modules\ls_admin\controllers;

use Yii;
use app\modules\ls_admin\models\StatusDocument;
use app\modules\ls_admin\models\StatusDocumentSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StatusdocumentController implements the CRUD actions for StatusDocument model.
 */
class StatusdocumentController extends Controller
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
     * Lists all StatusDocument models.
     * @return mixed
     */
    public function actionIndex()
    {
        $newModel = new StatusDocument();

        if (Yii::$app->request->post()){
            if ($newModel->load(Yii::$app->request->post())){
                if ($newModel->save()){
                    $newModel = new StatusDocument();
                }
            }
        }

        if(isset($_POST['up_store']) && isset($_POST['up_id'])){
            $upModel = StatusDocument::findOne($_POST['up_id']);
            if($upModel){
                $upModel->name=$_POST['up_name'];
                $upModel->save();
            }

        }

        $searchModel = new StatusDocumentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'newModel' => $newModel,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StatusDocument model.
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
     * Creates a new StatusDocument model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StatusDocument();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StatusDocument model.
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
     * Deletes an existing StatusDocument model.
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
     * Finds the StatusDocument model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StatusDocument the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StatusDocument::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
