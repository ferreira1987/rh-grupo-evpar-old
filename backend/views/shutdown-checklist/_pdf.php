<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RequestForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <table cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <td width="50%" style="border: 0;">
                <h1>CHECKLIST</h1><br>
                <p>checklist para desligamento de colaboradores</p><br>
                <hr>
                <p>data: <strong><?= date('d/m/Y'); ?></strong></p>
            </td>
            <td width="50%" style="border: 0;" align="right">
                <img src="<?= $model->logo; ?>" width="150px" alt="">
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
                <td colspan="3" style="padding: 8px 5px">SOLICITANTE</td>
            </tr>
            <tr>
                <td colspan="2" width="60%">
                    <small class="label">NOME:</small>
                    <p><?= $model->user->full_name ?></p>
                </td>
                <td colspan="1" width="40%">
                    <small class="label">CARGO:</small>
                    <p><?= $model->user->office ?></p>
                </td>
            </tr>
            <tr>
                <td colspan="1" width="25%">
                    <small class="label">DEPARTAMENTO:</small>
                    <p><?= $model->user->department ?></p>
                </td>
                <td colspan="2" width="75%">
                    <small class="label">EMPRESA:</small>
                    <p><?= $model->user->enterprise->company_name ?></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table cellspacing="3" cellpadding="0" width="100%" style="margin-top: 10px">
        <tbody>
            <tr class="bg-dark">
                <td colspan="4" style="padding: 8px 5px">COLABORADOR</td>
            </tr>
            <tr>
                <td colspan="1" width="30%">
                    <small class="label">MATRÍCULA:</small>
                    <p><?= $model->staff_registry ?></p>
                </td>
                <td colspan="3" width="70%">
                    <small class="label">NOME:</small>
                    <p><?= $model->staff->RA_NOME ?></p>
                </td>
            </tr>
            <tr>
                <td colspan="3" width="60%">
                    <small class="label">GRUPO:</small>
                    <p><?= $model->enterprise->group_name ?></p>
                </td>
                <td colspan="1" width="40%">
                    <small class="label">FILIAL:</small>
                    <p><?= $model->enterprise->company_name ?></p>
                </td>
            </tr>
            <tr>
                <td colspan="2" width="50%">
                    <small class="label">CARGO:</small>
                    <p><?= $model->staff->job->RJ_FUNCAO ?></p>
                </td>
                <td colspan="2" width="50%">
                    <small class="label">DEPARTAMENTO:</small>
                    <p><?= $model->staff_department ?: '...' ?></p>
                </td>
            </tr>
            <tr>
                <td colspan="2" width="50%">
                    <small class="label">TIPO DE MOVIMENTAÇÃO:</small>
                    <p><?= $model->shutdown_motive ?></p>
                </td>
                <td colspan="2" width="50%">
                </td>
            </tr>
            <tr style="background: #ccc;">
                <td colspan="4" style="padding: 5px; font-size: 11px; font-style: italic">
                    <p>Colaborador, para efetivar o seu processo de desligamento você deve seguir todas as etapas passando pelos departamentos abaixo, Você deve concluir todo processo no prazo máximo de 2 (dois) dias.</p>
                </td>
            </tr>
        </tbody>
    </table>

    <table cellspacing="3" cellpadding="0" width="100%" style="margin-top: 10px">
        <tbody>
        <tr class="bg-dark">
            <td colspan="5" class="left">1ª ETAPA - RH</td>
            <td colspan="3" class="data">
                <small class="label">ASS. RESPONSÁVEL</small>
                <p>_</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <small class="label">ENTREVISTA DESLIGAMENTO:</small>
                <p><?= $model->e1_interview ?: '...' ?></p>
            </td>
            <td colspan="2">
                <small class="label">PLANO SAÚDE:</small>
                <p><?= $model->e1_health_plan ?: '...' ?></p>
            </td>
            <td colspan="2">
                <small class="label">PLANO ODONT:</small>
                <p><?= $model->e1_health_plan ?: '...' ?></p>
            </td>
            <td colspan="2">
                <small class="label">DATA:</small>
                <p><?= $model->e1_date ? date_format(date_create($model->e1_date), 'd/m/Y') : '____/____/________' ?></p>
            </td>
        </tr>

        <tr class="bg-dark">
            <td colspan="5" class="left">2ª ETAPA - DP</td>
            <td colspan="3" class="data">
                <small class="label">ASS. RESPONSÁVEL</small>
                <p>_</p>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <small class="label">AVISO PRÉVIO:</small>
                <p><?= $model->e2_early_warning ?: '...' ?></p>
            </td>
            <td colspan="2">
                <small class="label">DATA:</small>
                <p><?= $model->e2_date ? date_format(date_create($model->e2_date), 'd/m/Y') : '____/____/________' ?></p>
            </td>
        </tr>

        <tr class="bg-dark">
            <td colspan="5" class="left">3ª ETAPA - TI</td>
            <td colspan="3" class="data">
                <small class="label">ASS. RESPONSÁVEL</small>
                <p>_</p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <small class="label">BLOQUEAR ACESSOS:</small>
                <p><?= $model->e3_access_blocking ?: '...' ?></p>
            </td>
            <td colspan="3">
                <small class="label">DEVOLVER EQUIPAMENTOS:</small>
                <p><?= $model->e3_return_equipment ?: '...' ?></p>
            </td>
            <td colspan="2">
                <small class="label">DATA:</small>
                <p><?= $model->e3_date ? date_format(date_create($model->e3_date), 'd/m/Y') : '____/____/________' ?></p>
            </td>
        </tr>

        <tr class="bg-dark">
            <td colspan="5" class="left">4ª ETAPA - FROTAS</td>
            <td colspan="3" class="data">
                <small class="label">ASS. RESPONSÁVEL</small>
                <p>_</p>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <small class="label">DEVOLUÇÃO DE CARRO:</small>
                <p><?= $model->e4_return_vehicle ?: '...' ?></p>
            </td>
            <td colspan="2">
                <small class="label">DATA:</small>
                <p><?= $model->e4_date ? date_format(date_create($model->e4_date), 'd/m/Y') : '____/____/________' ?></p>
            </td>
        </tr>

        <tr class="bg-dark">
            <td colspan="5" class="left">5ª ETAPA - ALMOXARIFADO</td>
            <td colspan="3" class="data">
                <small class="label">ASS. RESPONSÁVEL</small>
                <p>_</p>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <small class="label">DEVOLUÇÃO DE FERRAMENTAS:</small>
                <p><?= $model->e5_return_tools ?: '...' ?></p>
            </td>
            <td colspan="2">
                <small class="label">DATA:</small>
                <p><?= $model->e5_date ? date_format(date_create($model->e5_date), 'd/m/Y') : '____/____/________' ?></p>
            </td>
        </tr>

        <tr class="bg-dark">
            <td colspan="5" class="left">6ª ETAPA - SESMT</td>
            <td colspan="3" class="data">
                <small class="label">ASS. RESPONSÁVEL</small>
                <p>_</p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <small class="label">DEVOLUÇÃO DE EPI:</small>
                <p><?= $model->e6_return_epis ?: '...' ?></p>
            </td>
            <td colspan="3">
                <small class="label">DEVOLUÇÃO DE UNIFORME:</small>
                <p><?= $model->e6_return_uniform ?: '...' ?></p>
            </td>
            <td colspan="2">
                <small class="label">DATA:</small>
                <p><?= $model->e6_date ? date_format(date_create($model->e6_date), 'd/m/Y') : '____/____/________' ?></p>
            </td>
        </tr>

        <tr class="bg-dark">
            <td colspan="5" class="left">7ª ETAPA - DP</td>
            <td colspan="3" class="data">
                <small class="label">ASS. RESPONSÁVEL</small>
                <p>_</p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <small class="label">ASO DEMISSIONAL:</small>
                <p><?= $model->e7_aso_dismissal ?: '...' ?></p>
            </td>
            <td colspan="3">
                <small class="label">HOMOLOGAÇÃO:</small>
                <p><?= $model->e7_homologation ?: '...' ?></p>
            </td>
            <td colspan="2">
                <small class="label">DATA:</small>
                <p><?= $model->e7_date ? date_format(date_create($model->e7_date), 'd/m/Y') : '____/____/________' ?></p>
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
</div>