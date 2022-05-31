<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OmbudsmanCallSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ouvidoria';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ombudsman-call-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'ombudsman_id',
            [
                'attribute' => 'ombudsman',
                'value' => 'ombudsman.name'
            ],
            //'anonymity',
            'department',
            'name',
            //'state',
            //'city',
            //'job',
            //'email:email',
            //'phone',
            //'leader',
            //'message:ntext',
            'created_at:date',
            //'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'text-align: right'],
                'template' => '{update}{delete}',
                'buttons' => [
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
