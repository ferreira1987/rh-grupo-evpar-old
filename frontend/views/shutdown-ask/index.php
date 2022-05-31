<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ShutdownAskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entrevista de Desligamento';
?>
<div class="container-fluid">
    <div class="row d-flex ai-center jc-center">
        <div class="col-md-6 offset-3">
            <div class="card">
                <div class="card-body">

                    <?= Html::beginForm(['update'], 'GET'); ?>
                        <div class="form-group">
                        <?= Html::textInput('id', '', ['class' => 'form-control', 'placeholder' => 'insira a chave de acesso']) ?>
                        </div>
                        <div class="form-group">
                            <?= Html::submitButton('Acessar', ['class' => 'btn btn-block btn-primary']); ?>
                        </div>
                    <?= Html::endForm(); ?>

                </div>
            </div>
        </div>
    </div>
</div>