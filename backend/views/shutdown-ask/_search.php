<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ShutdownAskSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shutdown-ask-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'staff_registry') ?>

    <?= $form->field($model, 'staff_name') ?>

    <?= $form->field($model, 'staff_company') ?>

    <?= $form->field($model, 'staff_job') ?>

    <?php // echo $form->field($model, 'staff_department') ?>

    <?php // echo $form->field($model, 'staff_branch') ?>

    <?php // echo $form->field($model, 'shutdown_date') ?>

    <?php // echo $form->field($model, 'company_time') ?>

    <?php // echo $form->field($model, 'shutdown_motive') ?>

    <?php // echo $form->field($model, 'shutdown_initiative') ?>

    <?php // echo $form->field($model, 'admission_period') ?>

    <?php // echo $form->field($model, 'acting_period') ?>

    <?php // echo $form->field($model, 'dismissal_period') ?>

    <?php // echo $form->field($model, 'categories') ?>

    <?php // echo $form->field($model, 'interview_type') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
