<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OmbudsmanCall */

$this->title = 'Ouvidoria' . $model->contact_type;
$this->params['breadcrumbs'][] = ['label' => 'Ouvidoria', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ombudsman-call-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
