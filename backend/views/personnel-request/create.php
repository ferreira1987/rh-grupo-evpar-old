<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RequestForm */

$this->title = 'Requisição de Pessoal';
$this->params['breadcrumbs'][] = ['label' => 'Requisição de Pessoal', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Formulário';
?>
<div class="request-form-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
