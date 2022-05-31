<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Media */
/* @var $index */
?>

<div class="card mb-4">
    <img class="card-img-top img-fluid" src="<?= Url::to('@web/') . $model->path ?>" alt="" style="height: 140px; object-fit: cover">
    <div class="card-body">
        <p class="card-text">
            <?= $model->name ?>
        </p>
    </div>
    <div class="d-flex flex-column" style="position: absolute; top: 15px; right: -7px">
        <?= Html::a(Yii::t('app', '<i class="fa fa-times"></i>'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-icon btn-circle',
            'data' => [
                'confirm' => Yii::t('app', 'Produtos podem estar utilizando esta imagem, deseja mesmo excluir?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>
</div>
