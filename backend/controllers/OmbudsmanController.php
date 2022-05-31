<?php

namespace backend\controllers;

use backend\models\Ombudsman;
use backend\models\OmbudsmanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OmbudsmanController implements the CRUD actions for OmbudsmanController model.
 */
class OmbudsmanController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all OmbudsmanController models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OmbudsmanSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new OmbudsmanController model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ombudsman();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

                if(isset($logo)){
                    $image = new Upload();
                    $image->active_store_id = $model->id;
                    $image->link = $photo;
                    
                    if($image->save()){
                        \Yii::$app->session->setFlash('success', 'Logomarca cadastrada!');
                    }else{
                        \Yii::$app->session->setFlash('danger', 'A logomarca não foi salva!');
                    }
                }

                \Yii::$app->session->setFlash('success', 'Ouvidoria Cadastrada!!');
                return $this->redirect(['update', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing OmbudsmanController model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {

            $model->image = !empty($model->image) ? $model->image : null;
            if($model->save()){
                \Yii::$app->session->setFlash('success', 'Dados Atualizados!!');
            } else {
                \Yii::$app->session->setFlash('danger', 'Não foi possível atualizar!!');
            }

            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing OmbudsmanController model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OmbudsmanController model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Ombudsman the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ombudsman::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Deletes an existing ProductStorage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDropImage($id)
    {
        $photo = StorePhotos::findOne($id);

        if($photo->delete()){
            @unlink($photo->link);

            return true;
        } else {
            return false;
        }

    }
}
