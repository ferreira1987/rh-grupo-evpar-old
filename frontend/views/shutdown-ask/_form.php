<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use yii\helpers\ArrayHelper;
use backend\models\Ask;

/* @var $this yii\web\View */
/* @var $model frontend\models\ShutdownAsk */
/* @var $form yii\bootstrap4\ActiveForm */


$companies = \yii\helpers\ArrayHelper::map(\backend\models\Enterprise::find()->all(), 'id', 'company_name', 'group_name');
$asks = ArrayHelper::map(Ask::find()->all(), 'id', 'ask', 'group');
?>

<div class="shutdown-ask-form">

<?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary card-outline">
                <div class="card-header header-primary">
                    <i class="fa fa-lg fa-lg fa-user"></i> COLABORADOR
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <?= $form->field($model, 'staff_company')->textInput() ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'staff_branch')->textInput() ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'staff_registry')->textInput() ?>
                        </div>
                        <div class="col-9">
                            <?= $form->field($model, 'staff_name')->textInput() ?>
                        </div>
                        <div class="col-6">
                            <?= $form->field($model, 'staff_job')->textInput() ?>
                        </div>
                        <div class="col-6">
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
                            <?= $form->field($model, 'shutdown_date')->textInput(); ?>
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
