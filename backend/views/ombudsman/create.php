<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ombudsman */

$this->title = 'Ouvidoria';
$this->params['breadcrumbs'][] = ['label' => 'Ouvidoria', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ombudsman-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
