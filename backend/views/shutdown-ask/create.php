<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ShutdownAsk */

$this->title = 'Checklist de Desligamento';
$this->params['breadcrumbs'][] = ['label' => 'Entrevistas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Formulário';
?>
<div class="shutdown-ask-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
