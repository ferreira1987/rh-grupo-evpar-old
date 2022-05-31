<?php

use backend\models\Ask;
use kartik\date\DatePicker;
use kartik\widgets\DepDrop;
use yii\bootstrap4\Accordion;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model backend\models\ShutdownAsk */
/* @var $form yii\widgets\ActiveForm */

$action = Yii::$app->controller->action->id;
$groups = \yii\helpers\ArrayHelper::map(\backend\models\Enterprise::find()->distinct('group_id')->all(), 'group_id', 'group_name');
$asks = ArrayHelper::map(Ask::find()->all(), 'id', 'ask', 'group');
?>

<div class="shutdown-ask-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-9">
            <div class="card card-secondary card-outline">
                <div class="card-header header-primary">
                    <i class="fa fa-lg fa-lg fa-user"></i> COLABORADOR
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
                                    'initValueText' => $action == 'update' ? $model->staff->RA_NOME : null,
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
                                            $('#shutdownask-staff_registry').val(data.output.RA_MAT)
                                            $('#shutdownask-staff_admission').val(data.output.RA_ADMISSA)
                                            $('#shutdownask-staff_cc').val(data.output.RA_CC)
                                            $('#shutdownask-staff_job').val(data.output.CARGO?.RJ_DESC)
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
                            <?php echo $form->field($model, 'staff_admission')->widget(DatePicker::class, [
                                'disabled' => true,
                                'options' => ['placeholder' => 'Data ...'],
                                'pluginOptions' => [
                                    'autoclose' => true
                                ]
                            ]); ?>
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
                    <i class="fas fa-lg fa-power-off"></i> DESLIGAMENTO
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <?= $form->field($model, 'shutdown_date')->widget(DateControl::class, [
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
                        <div class="col-4">
                            <?= $form->field($model, 'company_time')->dropDownList($asks['COMPANY_TIME'], ['prompt' => '']) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'shutdown_initiative')->dropDownList(['INICIATIVA_DO_EMPREGADO' => 'INICIATIVA DO EMPREGADO', 'INICIATIVA_DA_EMPRESA' => 'INICIATIVA DA EMPRESA', 'OUTROS' => 'OUTROS'], ['prompt' => '']) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'interview_type')->dropDownList([ 'PESSOALMENTE' => 'PESSOALMENTE', 'TELEFONE' => 'TELEFONE', ], ['prompt' => '']) ?>
                        </div>
                        <div class="col-8">
                            <?= $form->field($model, 'prevent_shutdown_ask')->textInput() ?>
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
                        <?= $model->logo ?>
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

        <div class="col-12">
            <div class="card card-secondary card-outline">
                <div class="card-header header-primary">
                    <i class="fa fa-lg fa-lg fa-tasks"></i> MOTIVOS DO DESLIGAMENTO
                </div>
                <div class="card-body">
                    <div class="row">
                        <?= $form->field($model, 'shutdown_motive')->checkboxList($asks['MOTIVE'], [
                            'item' =>
                                function ($index, $label, $name, $checked, $value) {
                                    return Html::checkbox($name, $checked, [
                                        'value' => $value,
                                        'label' => '<label for="' . $label . '">' . $label . '</label>',
                                        'labelOptions' => [
                                            'class' => 'ckbox ckbox-primary col-md-4',
                                        ],
                                    ]);
                                },
                            'separator' => false,
                            'template' => '<div class=&quot;row&quot;>{input} -- {label}</div>'
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card card-secondary card-outline">
                <div class="card-header header-primary">
                    <i class="fa fa-lg fa-lg fa-file-signature"></i> PERÍODO ADMISSIONAL
                </div>
                <div class="card-body">
                    <table class="table table-striped table-sm table-condensed text-uppercase">
                        <thead>
                            <tr>
                                <th>Pergunta</th>
                                <th class="text-right">Opção</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($asks['ADMISSION_PERIOD'] as $id => $ask) : ?>
                        <tr>
                            <td><?= $ask ?></td>
                            <td><?= $form->field($model, 'admission_period['. $id .']', ['template' => '{input}', 'options' => ['class' => '']])->dropDownList(['SIM' => 'SIM', 'NAO' => 'NAO', 'NA' => 'N/A'], ['prompt' => ''])->label(false) ?></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card card-secondary card-outline">
                <div class="card-header header-primary">
                    <i class="fa fa-lg fa-lg fa-user-clock"></i> PERÍODO DE ATUAÇÃO
                </div>
                <div class="card-body">
                    <table class="table table-striped table-sm table-condensed text-uppercase">
                        <thead>
                        <tr>
                            <th>Pergunta</th>
                            <th class="text-right">Opção</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach($asks['ACTING_PERIOD'] as $id => $ask) : ?>
                        <tr>
                            <td><?= $ask ?></td>
                            <td><?= $form->field($model, 'acting_period['. $id .']', ['template' => '{input}', 'options' => ['class' => '']])->dropDownList(['SIM' => 'SIM', 'NAO' => 'NAO', 'NA' => 'N/A'], ['prompt' => ''])->label(false) ?></td>
                        </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card card-secondary card-outline">
                <div class="card-header header-primary">
                    <i class="fa fa-lg fa-lg fa-unlink"></i> PERÍODO DEMISSIONAL
                </div>
                <div class="card-body">
                    <table class="table table-striped table-sm table-condensed text-uppercase">
                        <thead>
                        <tr>
                            <th>Pergunta</th>
                            <th class="text-right">Opção</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach($asks['DISMISSAL_PERIOD'] as $id => $ask) : ?>
                        <tr>
                            <td><?= $ask ?></td>
                            <td><?= $form->field($model, 'dismissal_period['. $id .']', ['template' => '{input}', 'options' => ['class' => '']])->dropDownList(['SIM' => 'SIM', 'NAO' => 'NAO', 'NA' => 'N/A'], ['prompt' => ''])->label(false) ?></td>
                        </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card card-secondary card-outline">
                <div class="card-header header-primary">
                    <i class="fa fa-lg fa-lg fa-tags"></i> CATEGORIAS
                </div>
                <div class="card-body">
                    <table class="table table-striped table-sm table-condensed text-uppercase">
                        <thead>
                        <tr>
                            <th>Pergunta</th>
                            <th class="text-right">Opção</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach($asks['CATEGORY'] as $id => $ask) : ?>
                        <tr>
                            <td><?= $ask ?></td>
                            <td><?= $form->field($model, 'categories['. $id .']', ['template' => '{input}', 'options' => ['class' => '']])->dropDownList(['RUIM' => 'RUIM', 'FRACO' => 'FRACO', 'REGULAR' => 'REGULAR', 'BOM' => 'BOM', 'OTIMO' => 'ÓTIMO'], ['prompt' => ''])->label(false) ?></td>
                        </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
