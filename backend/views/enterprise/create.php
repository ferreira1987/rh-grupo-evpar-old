<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Enterprise */

$this->title = 'Create Enterprise';
$this->params['breadcrumbs'][] = ['label' => 'Enterprises', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enterprise-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
