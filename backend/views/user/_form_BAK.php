<?php

use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */

$companies = \yii\helpers\ArrayHelper::map(\backend\models\Enterprise::find()->all(), 'id', 'company_name', 'group_name');

//VarDumper::dump($model, 10, true); die;
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-9">
            <div class="card card-secondary card-outline">
                <div class="card-header header-primary">
                    Cadastro do Usuário
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <?php // $form->field($model, 'company_id')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'company_id')->widget(Select2::classname(), [
                                'data' => $companies,
                                'language' => 'de',
                                'options' => ['placeholder' => 'Escolha uma empresa'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]); ?>
                        </div>
                        <div class="col-6">
                            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-6">
                            <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-6">
                            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                                'mask' => ['(99) 9999-9999', '(99) 99999-9999'],
                            ]) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'office')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-5">
                            <?= $form->field($model, 'department')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'direct_responsible')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-2">
                            <?= $form->field($model, 'status')->dropDownList([10 => 'ATIVO', 9 => 'DESATIVADO'], ['prompt' => '']) ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'profile')->dropDownList(['USER' => 'USUÁRIO', 'MANAGER' => 'GESTOR', 'APPROVER' => 'APROVADOR', 'ADMIN' => 'ADMINISTRADOR'], ['prompt' => '']) ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'reset_password')->passwordInput(['maxlength' => true]) ?>
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
                        <div class="col form-group">
                            <?= Html::submitButton('<i class="fa fa-lg fa-save"></i> Salvar', ['class' => 'btn btn-outline-success btn-block']) ?>
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
