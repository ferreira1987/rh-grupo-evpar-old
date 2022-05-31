<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ShutdownChecklist */

$this->title = 'Checklist de Desligamento';
$this->params['breadcrumbs'][] = ['label' => 'Checklist', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shutdown-checklist-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
