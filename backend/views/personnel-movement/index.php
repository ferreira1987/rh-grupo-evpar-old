<?php

use kartik\datecontrol\DateControl;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PersonnelMovementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Movimentação de Pessoal';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personnel-movement-index">

    <p>
        <?= Html::a('Nova Movimentação', ['create'], ['class' => 'btn btn-info']) ?>
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
            // [
            //     'attribute' => 'status',
            //     'filter' => Html::dropDownList('PersonnelMovementSearch[status]', '', ['pending' => 'PENDENTE', 'approved' => 'APROVADO', 'denied' => 'REJEITADO'], ['prompt' => '', 'class' => 'form-control'])
            // ],
            // 'staff_id',
            [
                'attribute' => 'staff',
                'value' => 'staff.RA_NOME',
                'label' => 'Funcionário',
            ],            
            'movement_type',
            [
                'attribute' => 'enterprise',
                'value' => 'enterprise.company_name',
                'label' => 'Empresa',
            ],
            //'change_type',
            //'change_motive',
            //'shutdown_motive',
            //'shutdown_type',
            //'attachments:ntext',
            //'move_detail:ntext',
            //'requester_authorization',
            //'director_authorization',
            //'rh_authorization',
            //'updated_by',
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDate($model->created_at);
                },
                'filter' => DateControl::widget([
                    'name'=>'PersonnelMovementSearch[created_at]',
                    //'value'=> date('d/m/Y', strtotime('-2 days')),
                    'type' => DateControl::FORMAT_DATE,
                    'saveTimezone' => 'UTC'
                ])
            ],
            //'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'text-align: right; width: 100px'],
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
