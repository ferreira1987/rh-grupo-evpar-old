<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Requisição de Pessoal';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-form-index">

    <p>
        <?= Html::a('Nova Requisição', ['create'], ['class' => 'btn btn-info']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'requester_id',
            [
                'attribute' => 'enterprise',
                'value' => 'enterprise.company_name'
            ],
            'vacancy_office',
            'vacancy_quantity',
            //'vacancy_salary',
            //'vacancy_variable',
            //'vacancy_benefits',
            'vacancy_type',
            //'vacancy_workload',
            //'vacancy_motive',
            //'vacancy_gender',
            //'vacany_confidential',
            //'vacancy_formation',
            //'vacancy_activities:ntext',
            //'vacancy_requirements:ntext',
            //'requester_authorization',
            //'director_authorization',
            //'rh_authorization',
            //'created_by',
            //'updated_by',
            //'created_at',
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

    <?php Pjax::end(); ?>

</div>
