<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RequestFormSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-form-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'requester') ?>

    <?= $form->field($model, 'office') ?>

    <?= $form->field($model, 'department') ?>

    <?= $form->field($model, 'cost_center') ?>

    <?php // echo $form->field($model, 'company') ?>

    <?php // echo $form->field($model, 'unit') ?>

    <?php // echo $form->field($model, 'direct_responsible') ?>

    <?php // echo $form->field($model, 'vacancy_office') ?>

    <?php // echo $form->field($model, 'vacancy_quantity') ?>

    <?php // echo $form->field($model, 'vacancy_salary') ?>

    <?php // echo $form->field($model, 'vacancy_variable') ?>

    <?php // echo $form->field($model, 'vacancy_benefits') ?>

    <?php // echo $form->field($model, 'vacancy_type') ?>

    <?php // echo $form->field($model, 'vacancy_workload') ?>

    <?php // echo $form->field($model, 'vacancy_motive') ?>

    <?php // echo $form->field($model, 'vacancy_gender') ?>

    <?php // echo $form->field($model, 'vacany_confidential') ?>

    <?php // echo $form->field($model, 'vacancy_formation') ?>

    <?php // echo $form->field($model, 'vacancy_activities') ?>

    <?php // echo $form->field($model, 'vacancy_requirements') ?>

    <?php // echo $form->field($model, 'requester_authorization') ?>

    <?php // echo $form->field($model, 'director_authorization') ?>

    <?php // echo $form->field($model, 'rh_authorization') ?>

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
