<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ombudsman */

$this->title = 'Ouvidoria';
$this->params['breadcrumbs'][] = ['label' => 'Ouvidoria', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Formulário';
?>
<div class="ombudsman-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
