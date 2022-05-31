<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ShutdownAsk */

$this->title = 'Entrevista de Desligamento';
$this->params['breadcrumbs'][] = ['label' => 'Entrevista', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Formulário';
?>
<div class="shutdown-ask-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
