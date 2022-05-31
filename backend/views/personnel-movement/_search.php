<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PersonnelMovementSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personnel-movement-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'requester_id') ?>

    <?= $form->field($model, 'movement_type') ?>

    <?= $form->field($model, 'change_type') ?>

    <?= $form->field($model, 'change_motive') ?>

    <?php // echo $form->field($model, 'shutdown_motive') ?>

    <?php // echo $form->field($model, 'shutdown_type') ?>

    <?php // echo $form->field($model, 'attachments') ?>

    <?php // echo $form->field($model, 'move_detail') ?>

    <?php // echo $form->field($model, 'requester_authorization') ?>

    <?php // echo $form->field($model, 'director_authorization') ?>

    <?php // echo $form->field($model, 'rh_authorization') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
