<?php

namespace backend\controllers;

use backend\models\Enterprise;
use backend\models\PersonnelMovement;
use backend\models\PersonnelMovementSearch;
use backend\models\protheus\SRA010Funcionario;
use backend\models\protheus\SRA020Funcionario;
use backend\models\protheus\SRA040Funcionario;
use backend\models\protheus\SRA050Funcionario;
use backend\models\protheus\SRA060Funcionario;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PersonnelMovementController implements the CRUD actions for PersonnelMovement model.
 */
class PersonnelMovementController extends Controller
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
     * Lists all PersonnelMovement models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonnelMovementSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new PersonnelMovement model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PersonnelMovement();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                \Yii::$app->session->setFlash('success', "Movimentação Salva!");
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
     * Updates an existing PersonnelMovement model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $staff = $this->findEmployee($model->staff_id, $model->staff_company);

        $model->staff_registry = $staff->RA_MAT ?: null;
        $model->staff_cc = $staff->RA_CC ?: null;
        $model->staff_job = $staff->job->RJ_DESC ?: null;
        $model->staff_admission = date_format(date_create($staff->RA_ADMISSA), 'Y-m-d h:i:s');
        $model->logo = $this->companyLogo($model->enterprise->group_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            //VarDumper::dump($model, 4, true); die;
            \Yii::$app->session->setFlash('success', "Movimentação Atualizada!");
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionApprove($id){
        $model = PersonnelMovement::findOne($id);

        $profile = \Yii::$app->user->identity->profile;
        $department = \Yii::$app->user->identity->department;

        switch($department){
            case 'RH' :
                $model->rh_authorization = \Yii::$app->user->identity->id;
            break;
            case 'DP' :
                $model->requester_authorization = \Yii::$app->user->identity->id;
            break;
        }

        if(in_array($profile, ['ADMIN', 'MANAGER'])){
            $model->director_authorization = \Yii::$app->user->identity->id;
        }

        // $model->director_authorization = \Yii::$app->user->identity->full_name;

        if($model->save(false)){
            \Yii::$app->session->setFlash('info', 'Movimentação Aprovada!');
            return $this->redirect(['update', 'id' => $model->id]);              
        }   
    }    

    /**
     * Deletes an existing PersonnelMovement model.
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
     * Finds the PersonnelMovement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return PersonnelMovement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PersonnelMovement::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function findEmployee($staff_id, $staff_company)
    {
        $enterprise = Enterprise::findOne($staff_company);
        $query = null;

        switch ($enterprise->group_id) :
            case '01';
                $query = SRA010Funcionario::findOne(['R_E_C_N_O_' => $staff_id]);
                break;
            case '02';
                $query = SRA020Funcionario::findOne(['R_E_C_N_O_' => $staff_id]);
                break;
            case '04';
                $query = SRA040Funcionario::findOne(['R_E_C_N_O_' => $staff_id]);
                break;
            case '05';
                $query = SRA050Funcionario::findOne(['R_E_C_N_O_' => $staff_id]);
                break;
            case '06';
                $query = SRA060Funcionario::findOne(['R_E_C_N_O_' => $staff_id]);
                break;
        endswitch;

        return $query;
    }

    public function actionPdfView($id)
    {
        set_time_limit(3000);
        
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
