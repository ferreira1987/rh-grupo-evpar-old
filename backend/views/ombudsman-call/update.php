<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OmbudsmanCall */

$this->title = 'Ouvidoria: ' . $model->ombudsman->name ?: null;
$this->params['breadcrumbs'][] = ['label' => 'OmbudsmanController Calls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ombudsman-call-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
