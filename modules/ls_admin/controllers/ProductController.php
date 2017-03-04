<?php

namespace app\modules\ls_admin\controllers;
\Yii::$app->session->set('id_doc_create', false);
use app\modules\ls_admin\models\ProductPrice;
use app\modules\ls_admin\models\ProductStock;
use Yii;
use app\modules\ls_admin\models\Product;
use app\modules\ls_admin\models\ProductSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = false;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        $productPrice = new ProductPrice();
        $productPrice->product_id = 0;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($productPrice->load(Yii::$app->request->post()) ){
                $productPrice->product_id = $model->id;
                $productPrice->save();

                return $this->redirect(['index']);
            }else{
                return $this->render('create', [
                    'model' => $model,
                    'productPrice' => $productPrice,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'productPrice' => $productPrice,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $productPrice = ProductPrice::findOne(['product_id'=>$id]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($productPrice->load(Yii::$app->request->post()) ){
                $productPrice->product_id = $model->id;
                $productPrice->save();
                return $this->redirect(['index']);
            }else{
                return $this->render('update', [
                    'model' => $model,
                    'productPrice' => $productPrice,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'productPrice' => $productPrice,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
