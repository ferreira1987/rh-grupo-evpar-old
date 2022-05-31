<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RequestForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <table cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <td width="50%" style="border: 0;">
                <h1>MOVIMENTAÇÃO DE PESSOAL</h1><br>
                <p>formulário para movimentação de colaboradores</p><br>
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

    <table cellspacing="5" cellpadding="0" width="100%">
        <tbody>
            <tr class="bg-dark">
                <td colspan="3" width="100%">SOLICITANTE</td>
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
            <tr>
                <td colspan="2" width="60%">
                    <small class="label">SUPERIOR RESPONSÁVEL:</small>
                    <p><?= $model->user->direct_responsible ?></p>
                </td>
                <td colspan="1" width="40%">
                    <small class="label">UNIDADE:</small>
                    <p></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table cellspacing="5" cellpadding="0" width="100%" style="margin-top: 10px">
        <tbody>
            <tr class="bg-dark">
                <td colspan="4" width="100%">COLABORADOR</td>
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
                <td colspan="3" width="60%">
                    <small class="label">EMPRESA:</small>
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
                    <p><?= $model->staff_job ?: '...' ?></p>
                </td>
                <td colspan="2" width="50%">
                    <small class="label">DEPARTAMENTO:</small>
                    <p><?= $model->staff_department ?: '...' ?></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table cellspacing="5" cellpadding="0" width="100%" style="margin-top: 10px">
        <tbody>
        <tr class="bg-dark">
            <td colspan="4" width="100%">TIPO DA MOVIMENTAÇÕES</td>
        </tr>
        <tr>
            <td colspan="2" width="40%">
                <small class="label">TIPO DE MOVIMENTAÇÃO:</small>
                <p><?= $model->movement_type ?></p>
            </td>
            <?php if($model->movement_type === 'ALTERACAO'): ?>
            <td colspan="2" width="60%">
                <small class="label">MOTIVO:</small>
                <p><?= $model->change_motive ?></p>
            </td>
            <?php endif; ?>
            <?php if($model->movement_type === 'DESLIGAMENTO') : ?>
            <td colspan="1" width="30%">
                <small class="label">MOTIVO DESLIGAMENTO:</small>
                <p><?= $model->shutdown_motive ?></p>
            </td>
            <td colspan="1" width="30%">
                <small class="label">TIPO DESLIGAMENTO:</small>
                <p><?= $model->shutdown_type ?></p>
            </td>
            <?php endif; ?>
        </tr>
        <?php if($model->movement_type === 'ALTERACAO'): ?>
        <tr class="bg-dark">
            <td colspan="4" width="100%">DETALHES DA MOVIMENTAÇÃO</td>
        </tr>
        <?php foreach($model->move_detail as $detail) : ?>
        <tr>
            <td colspan="2" width="50%">
                <small class="label">TIPO:</small>
                <p><?= $detail['type'] ?></p>
            </td>
            <td colspan="1" width="25%">
                <small class="label">SITUAÇÃO ATUAL:</small>
                <p><?= $detail['name'] ?></p>
            </td>
            <td colspan="1" width="25%">
                <small class="label">PROPOSTA:</small>
                <p><?= $detail['info'] ?></p>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

    <table cellspacing="5" cellpadding="0" width="100%" style="margin-top: 15px">
        <tbody>
            <tr>
                <td colspan="2">
                    <small class="label">JUSTIFICATIVA DA MOVIMENTAÇÃO:</small>
                    <p><?= $model->justification == null || $model->justification == '' ? '...' : $model->justification; ?></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table width="100%" style="margin-top: 100px">
        <tr>
            <td width="50%" align="center" style="border: 0">
                <span>___________________________________________________________________</span> <br><br>
                <p>Gestor Recursos Humanos</p><br>
                <small>Eu como responsável do departamento de RH, declaro  estar ciente sobre esta movimentação.</small>
            </td>
            <td width="50%" align="center" style="border: 0">
                <span>___________________________________________________________________</span> <br><br>
                <p>Gestor Dep. Pessoal</p><br>
                <small>Eu como responsável pelo departamento pessoal, declaro  estar ciente sobre esta movimentação.</small>
            </td>
        </tr>
    </table>
    <table width="100%" style="margin-top: 50px">
        <tr>
            <td colspan="1" width="50%" align="center" style="border: 0">
                <span>___________________________________________________________________</span> <br><br>
                <p>Solicitante</p><br>
                <small>Eu como solicitante, declaro estar ciente sobre esta movimentação.</small>
            </td>
            <td colspan="1" width="50%" align="center" style="border: 0">
                <span>___________________________________________________________________</span> <br><br>
                <p>Diretor</p><br>
                <small>Eu como diretor responsável, declaro estar ciente sobre esta movimentação.</small>
            </td>
        </tr>
    </table>
</div>