<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RequestForm */

$this->title = 'Requisição de Pessoal';
$this->params['breadcrumbs'][] = ['label' => 'Requisição de Pessoal', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Formulário';
?>
<div class="request-form-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
