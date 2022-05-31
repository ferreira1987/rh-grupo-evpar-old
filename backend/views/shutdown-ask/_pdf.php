<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RequestForm */
/* @var $form yii\widgets\ActiveForm */

//\yii\helpers\VarDumper::dump($model, 3, true); die;
?>

<div class="row">
    <table cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <td width="50%" style="border: 0;">
                <h1>ENTREVISTA</h1><br>
                <p>entrevista de desligamento de colaboradores</p><br>
                <hr>
                <p>data: <strong><?= date('d/m/Y'); ?></strong></p>
            </td>
            <td width="50%" style="border: 0;" align="right">
                <img src="<?= Yii::getAlias('@web') . $model->logo; ?>" width="150px" alt="">
            </td>
        </tr>
        <tr>
            <td colspan="2" style="border: 0">
                <hr>
            </td>
        </tr>
    </table>

    <table cellspacing="3" cellpadding="0" width="100%">
        <tbody>
            <tr class="bg-dark">
                <td colspan="4" style="padding: 8px 5px">COLABORADOR</td>
            </tr>
            <tr>
                <td colspan="1" width="30%">
                    <small class="label">MATRÍCULA:</small>
                    <p><?= $model->staff->RA_MAT ?></p>
                </td>
                <td colspan="3" width="70%">
                    <small class="label">NOME:</small>
                    <p><?= $model->staff->RA_NOME ?></p>
                </td>
            </tr>
            <tr>
                <td colspan="3" width="50%">
                    <small class="label">GRUPO EMPRESARIAL:</small>
                    <p><?= $model->enterprise->group_name ?></p>
                </td>
                <td colspan="1" width="50%">
                    <small class="label">FILIAL:</small>
                    <p><?= $model->enterprise->company_name ?></p>
                </td>
            </tr>
            <tr>
                <td colspan="2" width="50%">
                    <small class="label">CARGO:</small>
                    <p><?= $model->staff_job ?: '...' ?></p>
                </td>
                <td colspan="2" width="50%">
                    <small class="label">DEPARTAMENTO:</small>
                    <p><?= $model->staff_department ?: '...' ?></p>
                </td>
            </tr>
            <tr>
                <td colspan="2" width="50%">
                    <small class="label">TEMPO DE EMPRESA:</small>
                    <p><?= \backend\models\Ask::findOne($model->company_time)['ask'] ?></p>
                </td>
                <td colspan="2" width="50%">
                    <small class="label">DATA DO DESLIGAMENTO:</small>
                    <p><?= date_format(date_create($model->shutdown_date), 'd/m/Y') ?></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table cellspacing="3" cellpadding="0" width="100%" style="margin-top: 10px">
        <tbody>
        <tr class="bg-dark">
            <td colspan="8" class="left">INFORMAÇÕES DO DESLIGAMENTO</td>
        </tr>
        <tr>
            <td colspan="8">
                <small class="label">O DESLIGAMENTO OCORREU POR:</small>
                <p><?= $model->shutdown_initiative ?: '¨'?></p>
            </td>
        </tr>
        <tr>
            <td colspan="8">
                <small class="label">O QUE PODERIA TER EVITADO O SEU DESLIGAMENTO:</small>
                <p>_</p>
            </td>
        </tr>
        <tr>
            <td colspan="8">
                <small class="label">MOTIVOS:</small>
                <p>
                <?php foreach($model->shutdown_motive as $id =>  $item) : ?>
                    <span><?= \backend\models\Ask::findOne($item)['ask'] ?: '...' ?></span>,&nbsp;&nbsp;
                <?php endforeach; ?>
                </p>
            </td>
        </tr>
        <tr class="grid">
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
        </tr>
        </tbody>
    </table>

    <table cellspacing="3" cellpadding="0" width="100%" style="margin-top: 10px">
        <tbody>
        <tr class="bg-dark">
            <td colspan="8" class="left">PERÍODO ADMISSIONAL</td>
        </tr>
        <?php foreach($model->admission_period as $id =>  $item) : ?>
        <tr>
            <td colspan="7">
                <p><?= \backend\models\Ask::findOne($id)['ask'] ?: '...' ?></p>
            </td>
            <td colspan="1">
                <p><?= $item ?: '...' ?></p>
            </td>
        </tr>
        <?php endforeach; ?>
        <tr class="grid">
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
        </tr>
        </tbody>
    </table>

    <table cellspacing="3" cellpadding="0" width="100%" style="margin-top: 10px">
        <tbody>
        <tr class="bg-dark">
            <td colspan="8" class="left">PERÍODO DE ATUAÇÃO</td>
        </tr>
        <?php foreach($model->acting_period as $id =>  $item) : ?>
            <tr>
                <td colspan="7">
                    <p><?= \backend\models\Ask::findOne($id)['ask'] ?: '...' ?></p>
                </td>
                <td colspan="1">
                    <p><?= $item ?: '...' ?></p>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr class="grid">
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
        </tr>
        </tbody>
    </table>

    <table cellspacing="3" cellpadding="0" width="100%" style="margin-top: 10px">
        <tbody>
        <tr class="bg-dark">
            <td colspan="8" class="left">PERÍODO DEMISSIONAL</td>
        </tr>
        <?php foreach($model->acting_period as $id =>  $item) : ?>
            <tr>
                <td colspan="7">
                    <p><?= \backend\models\Ask::findOne($id)['ask'] ?: '...' ?></p>
                </td>
                <td colspan="1">
                    <p><?= $item ?: '...' ?></p>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr class="grid">
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
        </tr>
        </tbody>
    </table>

    <table cellspacing="3" cellpadding="0" width="100%" style="margin-top: 10px">
        <tbody>
        <tr class="bg-dark">
            <td colspan="8" class="left">CATEGORIAS</td>
        </tr>
        <?php foreach($model->acting_period as $id =>  $item) :?>
            <tr>
                <td colspan="7">
                    <p><?= \backend\models\Ask::findOne($id)['ask'] ?: '...' ?></p>
                </td>
                <td colspan="1">
                    <p><?= $item ?: '...' ?></p>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr class="grid">
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
            <td width="12.5%" border="0"></td>
        </tr>
        </tbody>
    </table>
</div>