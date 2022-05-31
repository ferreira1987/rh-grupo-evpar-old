<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ShutdownChecklistSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shutdown-checklist-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'requester_id') ?>

    <?= $form->field($model, 'staff_registry') ?>

    <?= $form->field($model, 'staff_name') ?>

    <?= $form->field($model, 'staff_company') ?>

    <?php // echo $form->field($model, 'staff_job') ?>

    <?php // echo $form->field($model, 'staff_department') ?>

    <?php // echo $form->field($model, 'staff_branch') ?>

    <?php // echo $form->field($model, 'dp_authorization') ?>

    <?php // echo $form->field($model, 'director_authorization') ?>

    <?php // echo $form->field($model, 'rh_authorization') ?>

    <?php // echo $form->field($model, 'shutdown_motive') ?>

    <?php // echo $form->field($model, 'e1_interview') ?>

    <?php // echo $form->field($model, 'e1_dental_plan') ?>

    <?php // echo $form->field($model, 'e1_health_plan') ?>

    <?php // echo $form->field($model, 'e1_date') ?>

    <?php // echo $form->field($model, 'e2_early_warning') ?>

    <?php // echo $form->field($model, 'e2_date') ?>

    <?php // echo $form->field($model, 'e3_access_blocking') ?>

    <?php // echo $form->field($model, 'e3_return_equipment') ?>

    <?php // echo $form->field($model, 'e3_date') ?>

    <?php // echo $form->field($model, 'e4_return_vehicle') ?>

    <?php // echo $form->field($model, 'e4_date') ?>

    <?php // echo $form->field($model, 'e5_return_tools') ?>

    <?php // echo $form->field($model, 'e5_date') ?>

    <?php // echo $form->field($model, 'e6_return_epis') ?>

    <?php // echo $form->field($model, 'e6_return_uniform') ?>

    <?php // echo $form->field($model, 'e6_date') ?>

    <?php // echo $form->field($model, 'e7_aso_dismissal') ?>

    <?php // echo $form->field($model, 'e7_homologation') ?>

    <?php // echo $form->field($model, 'e7_date') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
