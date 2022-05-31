<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Ombudsman;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\OmbudsmanCall */
/* @var $form yii\widgets\ActiveForm */

$action = Yii::$app->controller->action->id;
$ombudsmans = ArrayHelper::map(Ombudsman::find()->all(), 'id', 'name');

?>

<div class="ombudsman-call-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-9">
            <div class="card card-secondary card-outline">
                <div class="card-header header-primary">
                    <i class="fa fa-lg fa-list"></i> Mensagem
                </div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-6"><?= $form->field($model, 'ombudsman_id')->dropDownList($ombudsmans, ['prompt' => '']) ?></div>

                    <div class="col-4"><?= $form->field($model, 'contact_type')->dropDownList([ 'SUGESTAO' => 'SUGESTAO', 'ELOGIO' => 'ELOGIO', 'RECLAMACAO' => 'RECLAMACAO', 'DENUNCIA' => 'DENUNCIA', ], ['prompt' => '']) ?></div>

                    <div class="col-2"><?= $form->field($model, 'anonymity')->dropDownList([1 => 'SIM', 0 => 'NAO'], ['prompt' => '']) ?></div>

                    <div class="col-7"><?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?></div>

                    <div class="col-5"><?= $form->field($model, 'job')->textInput(['maxlength' => true]) ?></div>

                    <div class="col-4"><?= $form->field($model, 'department')->textInput(['maxlength' => true]) ?></div>

                    <div class="col-4"><?= $form->field($model, 'leader')->textInput(['maxlength' => true]) ?></div>

                    <div class="col-4"><?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, [
                            'mask' => ['(99) 9999-9999', '(99) 9 9999-9999'],
                    ]) ?></div>

                    <div class="col-5"><?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?></div>

                    <div class="col-5"><?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?></div>

                    <div class="col-2"><?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?></div>

                    <div class="col-12"><?= $form->field($model, 'message')->textarea(['rows' => 8]) ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card card-secondary card-outline">
                <div class="card-header header-primary">
                    <i class="fa fa-lg fa-user-tie"></i> Opções
                </div>
                <div class="card-body">
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
    </div>     

    <?php ActiveForm::end(); ?>

</div>
