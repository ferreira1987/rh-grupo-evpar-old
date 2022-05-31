<?php

/* @var $this yii\web\View */
/* @var $model frontend\models\ShutdownAsk */

$this->title = 'Entrevista de Desligamento';
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form', [
                        'model' => $model
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>