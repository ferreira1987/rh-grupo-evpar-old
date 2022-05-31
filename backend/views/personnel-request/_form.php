<?php

use backend\models\User;
use kartik\widgets\DepDrop;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\PersonRequest */
/* @var $form yii\widgets\ActiveForm */

$action = Yii::$app->controller->action->id;
$groups = \yii\helpers\ArrayHelper::map(\backend\models\Enterprise::find()->distinct('group_id')->all(), 'group_id', 'group_name');

if($action === 'create'){
    $requester = User::find()->where(['id' => Yii::$app->user->identity->id])->with('enterprise')->one();
}else{
    $requester = User::find()->where(['id' => $model->requester_id])->with('enterprise')->one();
}
?>

<div class="request-form-form container" data-spy="scroll" data-target=".blablaba" data-offset="50">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-9">

            <div class="card card-secondary card-outline">
                <div class="card-header header-primary">
                    <i class="fa fa-lg fa-user-tie"></i> Solicitante
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 form-group">
                            <?= Html::label('Solicitante'); ?>
                            <?= Html::input('text', 'requester', $requester->full_name, ['disabled' => 'disabled', 'class' => 'form-control']) ?>
                        </div>
                        <div class="col-6 form-group">
                            <?= Html::label('Empresa'); ?>
                            <?= Html::input('text', 'requester', $requester->enterprise->company_name, ['disabled' => 'disabled', 'class' => 'form-control']) ?>
                        </div>
                        <div class="col-4 form-group">
                            <?= Html::label('Cargo'); ?>
                            <?= Html::input('text', 'requester', $requester->office, ['disabled' => 'disabled', 'class' => 'form-control']) ?>
                        </div>
                        <div class="col-4 form-group">
                            <?= Html::label('Departamento'); ?>
                            <?= Html::input('text', 'requester', $requester->department, ['disabled' => 'disabled', 'class' => 'form-control']) ?>
                        </div>
                        <div class="col-4 form-group">
                            <?= Html::label('Diretor/Responsável'); ?>
                            <?= Html::input('text', 'requester', $requester->direct_responsible, ['disabled' => 'disabled', 'class' => 'form-control']) ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-secondary card-outline">
                <div class="card-header">
                    <i class="fa fa-lg fa-bullhorn"></i> Informações da vaga
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <?= $form->field($model, 'vacancy_department')->dropDownList(['RH' => 'Recursos Humanos', 'DP' => 'Departamento Pessoal', 'TI' => 'Tecnologia', 'DR' => 'Diretoria'], ['prompt' => '']) ?> 
                        </div>
                        <div>
                            &nbsp;
                        </div>
                        <div class="col-6">
                            <?= $form->field($model, 'group')->widget(Select2::class, [
                                'data' => $groups,
                                'options' => [
                                    'id' => 'group',
                                    'placeholder' => 'Escolha uma empresa',
                                    'value' => $action == 'update' ?  $model->enterprise->group_id : null
                                ],
                                'pluginOptions' => [
                                    'allowClear' => false
                                ]
                            ]) ?>
                        </div>
                        <div class="col-6">
                            <?= $form->field($model, 'vacancy_company')->widget(DepDrop::class, [
                                'type' => DepDrop::TYPE_SELECT2,
                                'options' => ['id' => 'company', 'placeholder' => 'Escolher ...'],
                                'select2Options' => [
                                    'value' => $action == 'update' ? $model->enterprise->company_id : null,
                                    'initValueText' => $action == 'update' ? $model->enterprise->company_name : null,
                                    'pluginOptions' => ['allowClear' => false],
                                    'pluginEvents' => [
                                    ]
                                ],
                                'pluginOptions' => [
                                    'depends' => ['group'],
                                    'url' => Url::to(['/enterprise/companies']),
                                    'loadingText' => 'Escolher Filial ...',
                                ]
                            ]); ?>
                        </div>
                        <div class="col-6">
                            <?= $form->field($model, 'vacancy_office')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'vacancy_quantity')->textInput(['type' => 'number']) ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'vacancy_salary')->textInput() ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'vacancy_type')->dropDownList(['APRENDIZ' => 'APRENDIZ', 'EFETIVO' => 'EFETIVO', 'ESTÁGIO' => 'ESTÁGIO', 'TEMPORÁRIO' => 'TEMPORÁRIO'], ['prompt' => '']) ?>
                        </div>
                        <div class="col-8">
                            <?= $form->field($model, 'vacancy_workload')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'vacancy_gender')->dropDownList(['MASCULINO' => 'MASCULINO', 'FEMININO' => 'FEMININO', 'INDIFERENTE' => 'INDIFERENTE'], ['prompt' => '']) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'vacany_confidential')->dropDownList(['SIM' => 'SIM', 'NÃO' => 'NÃO'], ['prompt' => 'ESCOLHA']) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'vacancy_formation')->dropDownList(['SUPERIOR COMPLETO' => 'SUPERIOR COMPLETO', 'SUPERIOR CURSANDO' => 'SUPERIOR CURSANDO', 'ENSINO MEDIO' => 'ENSINO MEDIO', 'ENSINO FUNDAMENTAL' => 'ENSINO FUNDAMENTAL', 'INDIFERENTE' => 'INDIFERENTE'], ['prompt' => '']) ?>
                        </div>
                        <div class="col-12">
                            <?= $form->field($model, 'vacancy_benefits')->checkboxList(['VALE_TRANSPORTE' => 'VALE TRANSPORTE', 'AJUDA_DE_CUSTO_TRANSPORTE' => 'AJUDA DE CUSTO TRANSPORTE', 'VALE_ALIMENTACAO' => 'VALE ALIMENTAÇÃO', 'VALE_REFEICAO' => 'VALE REFEIÇÃO', 'PLANO_ODONTOLOGICO' => 'PLANO ODONTOLÓGICO', 'PLANO_DE_SAUDE' => 'PLANO DE SAÚDE', 'INSALUBRIDADE' => 'INSALUBRIDADE']) ?>
                        </div>
                        <div class="col-6">
                            <?= $form->field($model, 'vacancy_motive')->textarea(['rows' => 4]) ?>
                        </div>
                        <div class="col-6">
                            <?= $form->field($model, 'vacancy_activities')->textarea(['rows' => 4]) ?>
                        </div>
                        <div class="col-6">
                            <?= $form->field($model, 'vacancy_requirements')->textarea(['rows' => 4]) ?>
                        </div>
                        <div class="col-6">
                            <?= $form->field($model, 'vacancy_comments')->textarea(['rows' => 4]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card card-success card-outline" id="sidemenu" data-spy="affix" data-offset-top="197">
                <div class="card-header">
                    Opções
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php if($action == 'update') : ?>
                            <div class="col-12 d-flex justify-content-center">
                                <img src="<?= Yii::getAlias('@web') . $model->logo; ?>"  class="img-fluid" width="150px" alt="">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <div class="col form-group mb-2">
                            <?php
                                if(!in_array(Yii::$app->user->identity->id, [$model->dp_authorization, $model->director_authorization, $model->rh_authorization]) && Yii::$app->user->identity->id == $model->requester_id){
                                    echo Html::submitButton('<i class="fa fa-lg fa-save"></i> Salvar', ['class' => 'btn btn-outline-success btn-block']);
                                }elseif($action === 'create'){
                                    echo Html::submitButton('<i class="fa fa-lg fa-save"></i> Salvar', ['class' => 'btn btn-outline-success btn-block']);
                                }
                            ?>
                        </div>
                        <div class="col-12 form-group <?= $action === 'update' ? 'd-block':'d-none'?>">
                            <?php
                                if(in_array(Yii::$app->user->identity->profile, ['ADMIN', 'MANAGER'])){
                                    if(in_array(Yii::$app->user->identity->id, [$model->dp_authorization, $model->director_authorization, $model->rh_authorization])){
                                       echo Html::button('<i class="fa fa-lg fa-check"></i> Você já aprovou!', ['class' => 'btn btn-success btn-block']);
                                    }else{
                                        echo Html::a('<i class="fa fa-lg fa-thumbs-up"></i> Aprovar', ['approve', 'id' => $model->id], ['class' => 'btn btn-outline-info btn-block', 'data-method' => 'post', 'data-confirm' => 'Deseja realmente aprovar está requisição?']);
                                    }
                                }
                            ?>
                            <?= Html::a('<i class="fa fa-lg fa-file-pdf"></i> Imprimir', ['pdf-view', 'id' => $model->id], ['class' => 'btn btn-outline-secondary btn-block', 'target' => '_new']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <?= Html::a('<i class="fa fa-lg fa-hand-point-left"></i> Voltar', 'index', ['class' => 'btn btn-app d-block m-0']) ?>
                        </div>
                        <div class="col-6">
                            <?= Html::a('<i class="fa fa-lg fa-plus"></i> Novo', 'create', ['class' => 'btn btn-app d-block m-0']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--<div class="card card-secondary card-outline">
        <div class="card-header">
            Aprovação
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <?/*= $form->field($model, 'requester_authorization')->textInput(['maxlength' => true]) */?>
                </div>
                <div class="col-4">
                    <?/*= $form->field($model, 'director_authorization')->textInput(['maxlength' => true]) */?>
                </div>
                <div class="col-4">
                    <?/*= $form->field($model, 'rh_authorization')->textInput(['maxlength' => true]) */?>
                </div>
            </div>
        </div>
    </div>-->

    <?php ActiveForm::end(); ?>

</div>