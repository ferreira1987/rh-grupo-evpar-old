<?php

namespace backend\controllers;

use backend\models\PersonnelRequest;
use backend\models\PersonnelRequestSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

/**
 * PersonnelRequestController implements the CRUD actions for PersonnelRequest model.
 */
class PersonnelRequestController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => ['login', 'error'],
                            'allow' => true,
                        ],
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
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
     * Lists all PersonnelRequest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonnelRequestSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new PersonnelRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PersonnelRequest();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

                \Yii::$app->session->setFlash('info', 'Requisição Criada!');
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
     * Updates an existing PersonnelRequest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->logo = $this->companyLogo($model->enterprise->group_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('info', 'Ficha atualizada!');
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PersonnelRequest model.
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
     * Finds the PersonnelRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return PersonnelRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PersonnelRequest::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPdfView($id)
    {
        $model = $this->findModel($id);

        $model->logo = $this->companyLogo($model->enterprise->group_id);

        $content = $this->renderPartial('_pdf', ['model' => $model]);

        $pdf = \Yii::$app->pdf;
        $pdf->cssFile = '@webroot/css/pdf.css';
        $pdf->content = $content;
        $pdf->methods = [
            'SetTitle' => 'Grupo Evpar - grupoevpar.com.br',
        ];
        return $pdf->render();
    }

    public function companyLogo($group_id)
    {
        $logo = null;
        switch($group_id) :
            case '01';
                $logo = Yii::getAlias('@web') . '/images/' . 'evpar.png';
                break;
            case '02';
                $logo = Yii::getAlias('@web') . '/images/' . 'locservice.png';
                break;
            case '04';
                $logo = Yii::getAlias('@web') . '/images/' . 'grupohable.png';
                break;
            case '05';
                $logo = Yii::getAlias('@web') . '/images/' . 'evtek.png';
                break;
            case '06';
                $logo = Yii::getAlias('@web') . '/images/' . 'vbank.png';
                break;
        endswitch;
        return $logo;
    }
}
