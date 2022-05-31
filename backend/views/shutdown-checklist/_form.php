<?php

use backend\models\User;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\datecontrol\DateControl;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\ShutdownChecklist */
/* @var $form yii\widgets\ActiveForm */

$action = Yii::$app->controller->action->id;
$groups = \yii\helpers\ArrayHelper::map(\backend\models\Enterprise::find()->distinct('group_id')->all(), 'group_id', 'group_name');

if(Yii::$app->controller->action->id === 'create'){
    $requester = User::find(Yii::$app->user->id)->with('enterprise')->one();
}else{
    $requester = User::find($model->requester_id)->with('enterprise')->one();
}

//VarDumper::dump( $model, $depth = 10, $highlight = true); die;
?>

<div class="shutdown-checklist-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-9">
            <div class="card card-secondary card-outline">
                <div class="card-header header-primary">
                    <i class="fa fa-lg fa-lg fa-user-tie"></i> SOLICITANTE
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 form-group">
                            <?= Html::label('Solicitante'); ?>
                            <?= Html::input('text', 'requester', Yii::$app->user->identity->username, ['disabled' => 'disabled', 'class' => 'form-control']) ?>
                        </div>
                        <div class="col-6 form-group">
                            <?= Html::label('Empresa'); ?>
                            <?= Html::input('text', 'requester', $requester->enterprise->company_name, ['disabled' => 'disabled', 'class' => 'form-control']) ?>
                        </div>
                        <div class="col-4 form-group">
                            <?= Html::label('Cargo')?>
                            <?= Html::input('text', 'requester', Yii::$app->user->identity->office, ['disabled' => 'disabled', 'class' => 'form-control']) ?>
                        </div>
                        <div class="col-4 form-group">
                            <?= Html::label('Departamento')?>
                            <?= Html::input('text', 'requester', Yii::$app->user->identity->department, ['disabled' => 'disabled', 'class' => 'form-control']) ?>
                        </div>
                        <div class="col-4 form-group">
                            <?= Html::label('Empresa')?>
                            <?= Html::input('text', 'requester', Yii::$app->user->identity->direct_responsible, ['disabled' => 'disabled', 'class' => 'form-control']) ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-secondary card-outline">
                <div class="card-header header-primary">
                    <i class="fa fa-lg fa-id-card-alt"></i> COLABORADOR
                </div>
                <div class="card-body">
                <div class="row">
                        <div class="col-5">
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
                        <div class="col-7">
                            <?= $form->field($model, 'staff_company')->widget(DepDrop::class, [
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
                            <?= $form->field($model, 'staff_id')->widget(DepDrop::class, [
                                'type' => DepDrop::TYPE_SELECT2,
                                'options' => ['id' => 'staff'],
                                'select2Options' => [
                                    'value' => $action == 'update' ? $model->staff_id : null,
                                    'initValueText' => $action == 'update' && $model->staff ? $model->staff->RA_NOME : null,
                                    'pluginOptions' => ['allowClear' => false],
                                    'pluginEvents' => [
                                    ]
                                ],
                                'pluginOptions' => [
                                    'depends' => ['company'],
                                    'placeholder' => 'Escolher ...',
                                    'url' => Url::to(['/enterprise/employees']),
                                    'loadingText' => 'Selecione uma Filial ...',
                                ],
                                'pluginEvents' => [
                                    "select2:select" => "function(event){ 
                                        console.log(event)
                                        
                                        $.ajax({
                                            method: 'POST',
                                            url: '/enterprise/employee',
                                            data: { staff_id: event.params.data.id, company_id: $('#company').val() }
                                        }).done(function(data) {
                                            console.log('AjaxData:', data)
                                            $('#shutdownchecklist-staff_registry').val(data.output.RA_MAT)
                                            $('#shutdownchecklist-staff_admission').val(data.output.RA_ADMISSA)
                                            $('#shutdownchecklist-staff_cc').val(data.output.RA_CC)
                                            $('#shutdownchecklist-staff_job').val(data.output.CARGO?.RJ_DESC)
                                        });
                                    }",
                                    "depdrop:change" => "function(event, id, value, count){
                                        console.info('id', id); console.info('value', value);
                                        console.info('count', count);
                                    }"
                                ]
                            ]); ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'staff_registry')->textInput(['readonly' => 'readonly']) ?>
                        </div>
                        <div class="col-3">
                            <?php echo $form->field($model, 'staff_admission')->widget(DateControl::class, [
                                'type' => DateControl::FORMAT_DATETIME,
                                'displayFormat' => 'php: d/m/Y',
                                'disabled' => true
                            ]); ?>
                            <?php //= $form->field($model, 'staff_admission')->textInput(['readonly' => 'readonly']) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'staff_cc')->textInput(['readonly' => 'readonly']) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'staff_job')->textInput(['readonly' => 'readonly']) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'staff_department')->textInput() ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-secondary card-outline">
                <div class="card-header header-primary">
                    <i class="fa fa-lg fa-tasks"></i> CHECKLIST
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <?= $form->field($model, 'shutdown_motive')->dropDownList(['DEMISSAO_JUSTA_CAUSA' => 'DEMISSÃO POR JUSTA CAUSA', 'DEMISSAO_SEM_JUSTA_CAUSA' => 'DEMISSÃO SEM JUSTA CAUSA', 'FIM_CONTRATO' => 'FIM DE CONTRATO', 'OUTROS' => 'OUTROS'], ['prompt' => 'Selecione']) ?>
                        </div>
                        <div class="col-12">
                            <p class="bg-gradient-gray p-1">ETAPA 1 - RH</p>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'e1_interview')->dropDownList(['SIM' => 'SIM', 'NAO' => 'NAO'], ['prompt' => 'Selecione']) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'e1_dental_plan')->dropDownList(['SIM' => 'SIM', 'NAO' => 'NAO'], ['prompt' => 'Selecione']) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'e1_health_plan')->dropDownList(['SIM' => 'SIM', 'NAO' => 'NAO'], ['prompt' => 'Selecione']) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'e1_date')->widget(DateControl::class, [
                                'type' => DateControl::FORMAT_DATE,
                                'ajaxConversion' => false,
                                'widgetOptions' => [
                                    'size' => 'sm',
                                    'pluginOptions' => [
                                        'autoclose' => true
                                    ]
                                ]
                            ]); ?>
                        </div>

                        <div class="col-12">
                            <p class="bg-gradient-gray p-1">ETAPA 2 - DP</p>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'e2_early_warning')->dropDownList(['SIM' => 'SIM', 'NAO' => 'NAO'], ['prompt' => 'Selecione']) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'e2_date')->widget(DateControl::class, [
                                'type' => DateControl::FORMAT_DATE,
                                'ajaxConversion' => false,
                                'widgetOptions' => [
                                    'size' => 'sm',
                                    'pluginOptions' => [
                                        'autoclose' => true
                                    ]
                                ]
                            ]); ?>
                        </div>

                        <div class="col-12">
                            <p class="bg-gradient-gray p-1">ETAPA 3 - TI</p>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'e3_access_blocking')->dropDownList(['SIM' => 'SIM', 'NAO' => 'NAO'], ['prompt' => 'Selecione']) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'e3_return_equipment')->dropDownList(['SIM' => 'SIM', 'NAO' => 'NAO'], ['prompt' => 'Selecione']) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'e3_date')->widget(DateControl::class, [
                                'type' => DateControl::FORMAT_DATE,
                                'ajaxConversion' => false,
                                'widgetOptions' => [
                                    'size' => 'sm',
                                    'pluginOptions' => [
                                        'autoclose' => true
                                    ]
                                ]
                            ]); ?>
                        </div>


                        <div class="col-12">
                            <p class="bg-gradient-gray p-1">ETAPA 4 - FROTAS</p>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'e4_return_vehicle')->dropDownList(['SIM' => 'SIM', 'NAO' => 'NAO'], ['prompt' => 'Selecione']) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'e4_date')->widget(DateControl::class, [
                                'type' => DateControl::FORMAT_DATE,
                                'ajaxConversion' => false,
                                'widgetOptions' => [
                                    'size' => 'sm',
                                    'pluginOptions' => [
                                        'autoclose' => true
                                    ]
                                ]
                            ]); ?>
                        </div>


                        <div class="col-12">
                            <p class="bg-gradient-gray p-1">ETAPA 5 - ALMOXARIFADO</p>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'e5_return_tools')->dropDownList(['SIM' => 'SIM', 'NAO' => 'NAO'], ['prompt' => 'Selecione']) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'e5_date')->widget(DateControl::class, [
                                'type' => DateControl::FORMAT_DATE,
                                'ajaxConversion' => false,
                                'widgetOptions' => [
                                    'size' => 'sm',
                                    'pluginOptions' => [
                                        'autoclose' => true
                                    ]
                                ]
                            ]); ?>
                        </div>


                        <div class="col-12">
                            <p class="bg-gradient-gray p-1">ETAPA 6 - SESMT</p>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'e6_return_epis')->dropDownList(['SIM' => 'SIM', 'NAO' => 'NAO'], ['prompt' => 'Selecione']) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'e6_return_uniform')->dropDownList(['SIM' => 'SIM', 'NAO' => 'NAO'], ['prompt' => 'Selecione']) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'e6_date')->widget(DateControl::class, [
                                'type' => DateControl::FORMAT_DATE,
                                'ajaxConversion' => false,
                                'widgetOptions' => [
                                    'size' => 'sm',
                                    'pluginOptions' => [
                                        'autoclose' => true
                                    ]
                                ]
                            ]); ?>
                        </div>

                        <div class="col-12">
                            <p class="bg-gradient-gray p-1">ETAPA 7 - DP</p>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'e7_aso_dismissal')->dropDownList(['SIM' => 'SIM', 'NAO' => 'NAO'], ['prompt' => 'Selecione']) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'e7_homologation')->dropDownList(['SIM' => 'SIM', 'NAO' => 'NAO'], ['prompt' => 'Selecione']) ?>
                        </div>

                        <div class="col-4">
                            <?= $form->field($model, 'e7_date')->widget(DateControl::class, [
                                'type' => DateControl::FORMAT_DATE,
                                'ajaxConversion' => false,
                                'widgetOptions' => [
                                    'size' => 'sm',
                                    'pluginOptions' => [
                                        'autoclose' => true
                                    ]
                                ]
                            ]); ?>
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
                        <div class="col form-group">
                            <?= Html::submitButton('<i class="fa fa-lg fa-save"></i> Salvar', ['class' => 'btn btn-outline-success btn-block']) ?>
                        </div>
                        <div class="col-12 form-group <?= $action === 'update' ? 'd-block':'d-none'?>">
                            <?= Html::a('<i class="fa fa-lg fa-thumbs-up"></i> Aprovar', ['pdf-view', 'id' => $model->id], ['class' => 'btn btn-outline-info btn-block', 'target' => '_new']) ?>
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

    <?php ActiveForm::end(); ?>

</div>
