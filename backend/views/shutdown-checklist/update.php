<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ShutdownChecklist */

$this->title = 'Checklist de Desligamento';
$this->params['breadcrumbs'][] = ['label' => 'Checklist', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Formulário';
?>
<div class="shutdown-checklist-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
