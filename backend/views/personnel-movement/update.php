<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PersonnelMovement */

$this->title = 'Movimentação de Pessoal';
$this->params['breadcrumbs'][] = ['label' => 'Movimentação de Pessoal', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Formulário';
?>
<div class="personnel-movement-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
