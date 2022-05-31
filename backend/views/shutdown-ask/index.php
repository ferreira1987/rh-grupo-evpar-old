<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ShutdownAskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entrevista de Desligamento';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shutdown-ask-index">

    <p>
        <?= Html::a('Nova Entrevista', ['create'], ['class' => 'btn btn-info']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'staff_name',
            'staff_job',
            [
                'attribute' => 'enterprise',
                'value' => 'enterprise.company_name'
            ],
            //'staff_department',
            //'staff_branch',
            //'shutdown_date',
            //'company_time',
            //'shutdown_motive:ntext',
            //'shutdown_initiative:ntext',
            //'admission_period:ntext',
            //'acting_period:ntext',
            //'dismissal_period:ntext',
            //'categories:ntext',
            //'interview_type',
            //'created_by',
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
