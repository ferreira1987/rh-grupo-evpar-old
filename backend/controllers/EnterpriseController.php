<?php

namespace backend\controllers;

use backend\models\Enterprise;
use backend\models\EnterpriseSearch;
use backend\models\protheus\SRA010Funcionario;
use backend\models\protheus\SRA020Funcionario;
use backend\models\protheus\SRA040Funcionario;
use backend\models\protheus\SRA050Funcionario;
use backend\models\protheus\SRA060Funcionario;
use backend\models\protheus\SRJ010Cargos;
use backend\models\protheus\SRJ020Cargos;
use backend\models\protheus\SRJ040Cargos;
use backend\models\protheus\SRJ050Cargos;
use backend\models\protheus\SRJ060Cargos;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EnterpriseController implements the CRUD actions for Enterprise model.
 */
class EnterpriseController extends Controller
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
     * Lists all Enterprise models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EnterpriseSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new Enterprise model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Enterprise();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Enterprise model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Enterprise model.
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
     * Finds the Enterprise model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Enterprise the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Enterprise::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param string $params
     * @return $output[] the loaded model
     */
    public function actionCompanies()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $params = \Yii::$app->request->post('depdrop_all_params');
        $query = Enterprise::find()->where(['=', 'group_id', $params['group']])->all();
        $result = [];

        if($query) {
            foreach ($query as $company){
                array_push( $result, ["id" => $company['id'], "name" => $company['company_name']]);
            };
        }

        return ["output" => $result];
    }

    /**
     * @param string $params
     * @return $output[] the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEmployees()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $params = \Yii::$app->request->post('depdrop_all_params');
        $parents = \Yii::$app->request->post('depdrop_parents');
        $query = null;
        $out = [];

        // return ['params' => $params, 'parents' => $parents];
        // return $enterprise;

        if ( $params['company'] != "" ) {
            $enterprise = Enterprise::findOne($params['company']);
            switch ($enterprise->group_id) :
                case '01';
                    $query = SRA010Funcionario::find()->where(['!=', 'RA_SITFOLH', 'D'])
                        ->andWhere(['=', 'RA_FILIAL', $enterprise->company_id])->all();
                    break;
                case '02';
                    $query = SRA020Funcionario::find()->where(['!=', 'RA_SITFOLH', 'D'])
                        ->andWhere(['=', 'RA_FILIAL', $enterprise->company_id])->all();
                    break;
                case '04';
                    $query = SRA040Funcionario::find()->where(['!=', 'RA_SITFOLH', 'D'])
                        ->andWhere(['=', 'RA_FILIAL', $enterprise->company_id])->all();
                    break;
                case '05';
                    $query = SRA050Funcionario::find()->where(['!=', 'RA_SITFOLH', 'D'])
                        ->andWhere(['=', 'RA_FILIAL', $enterprise->company_id])->all();
                    break;
                case '06';
                    $query = SRA060Funcionario::find()->where(['!=', 'RA_SITFOLH', 'D'])
                        ->andWhere(['=', 'RA_FILIAL', $enterprise->company_id])->all();
                    break;
            endswitch;

            // return ['params' => $params, 'enterprise' => $enterprise, 'query' => $query];

            if ($query) {
                foreach ($query as $employee) {
                    array_push($out, [
                        "id" => $employee['R_E_C_N_O_'],
                        "name" => trim($employee['RA_NOME']),
                        'job' => $employee->job
                    ]);
                };
            }
        }

        return ["output" => $out];
    }

    /**
     * @param string $params
     * @return $output[] the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEmployee()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $params = \Yii::$app->request->post();
        $enterprise = Enterprise::findOne($params['company_id']);
        $query = null;

        switch ($enterprise->group_id) :
            case '01';
                $query = SRA010Funcionario::findOne(['R_E_C_N_O_' => $params['staff_id']]);
                break;
            case '02';
                $query = SRA020Funcionario::findOne(['R_E_C_N_O_' => $params['staff_id']]);
                break;
            case '04';
                $query = SRA040Funcionario::findOne(['R_E_C_N_O_' => $params['staff_id']]);
                break;
            case '05';
                $query = SRA050Funcionario::findOne(['R_E_C_N_O_' => $params['staff_id']]);
                break;
            case '06';
                $query = SRA060Funcionario::findOne(['R_E_C_N_O_' => $params['staff_id']]);
                break;
        endswitch;

        $query->RA_ADMISSA = date_format(date_create($query->RA_ADMISSA), 'd/m/Y');
        return ["output" => $query];
    }

}
