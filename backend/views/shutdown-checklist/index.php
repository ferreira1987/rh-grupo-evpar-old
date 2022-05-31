<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ShutdownChecklistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Checklist de Desligamento';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shutdown-checklist-index">

    <p>
        <?= Html::a('Novo Checklist', ['create'], ['class' => 'btn btn-info']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'requester_id',
            'staff_registry',
            'staff_name',
            [
                'attribute' => 'enterprise',
                'value' => 'enterprise.company_name'
            ],
            //'staff_job',
            //'staff_department',
            //'staff_branch',
            //'dp_authorization',
            //'director_authorization',
            //'rh_authorization',
            //'shutdown_motive',
            //'e1_interview',
            //'e1_dental_plan',
            //'e1_health_plan',
            //'e1_date',
            //'e2_early_warning',
            //'e2_date',
            //'e3_access_blocking',
            //'e3_return_equipment',
            //'e3_date',
            //'e4_return_vehicle',
            //'e4_date',
            //'e5_return_tools',
            //'e5_date',
            //'e6_return_epis',
            //'e6_return_uniform',
            //'e6_date',
            //'e7_aso_dismissal',
            //'e7_homologation',
            //'e7_date',
            //'updated_by',
            'created_at:date',
            //'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'text-align: right'],
                'template' => '{update}{delete}',
                'buttons'=>[
                    'update'=>function ($url, $model) {
                        return Html::a("<i class='text-primary fa fa-lg fa-edit'></i>", ['update', 'id' => $model->id], ['class' => 'btn btn-sm']);
                    },
                    'delete' => function($url, $model) {
                        return Html::a("<i class='text-danger fa fa-lg fa-trash'></i>", ['delete', 'id' => $model->id], ['class' => 'btn btn-sm', 'data-method' => 'post', 'data-confirm' => 'Excluir este produto?']);
                    },
                ],
            ],
        ],
    ]); ?>


</div>
