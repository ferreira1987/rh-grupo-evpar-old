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
                <h1>REQUISIÇÃO DE PESSOAL</h1><br>
                <p>formulário para solicitação de colaboradores</p><br>
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
                <td colspan="4" width="100%">DETALHES DA VAGA</td>
            </tr>
            <tr>
                <td colspan="2" width="50%">
                    <small class="label">CARGO:</small>
                    <p><?= $model->vacancy_office ?></p>
                </td>
                <td colspan="1" width="25%">
                    <small class="label">VAGAS:</small>
                    <p><?= $model->vacancy_quantity ?></p>
                </td>
                <td colspan="1" width="25%">
                    <small class="label">TIPO CONTRATAÇÃO:</small>
                    <p><?= $model->vacancy_type ?></p>
                </td>
            </tr>
            <tr>
                <td colspan="1" width="25%">
                    <small class="label">SALÁRIO:</small>
                    <p><?= $model->vacancy_salary ?></p>
                </td>
                <td colspan="1" width="25%">
                    <small class="label">VARIÁVEL:</small>
                    <p><?= $model->vacancy_variable ?: '...' ?></p>
                </td>                
                <td colspan="1" width="25%">
                    <small class="label">GÊNERO:</small>
                    <p><?= $model->vacancy_gender ?></p>
                </td>
                <td colspan="1" width="25%">
                    <small class="label">CONFIDENCIAL:</small>
                    <p><?= $model->vacany_confidential ?></p>
                </td>                
            </tr>
            <tr>
                <td colspan="2" width="50%">
                    <small class="label">FORMAÇÃO:</small>
                    <p><?= $model->vacancy_formation ?></p>
                </td>
            </tr>
            <td colspan="2" width="50%">
                <small class="label">PERÍODO:</small>
                <p><?= $model->vacancy_workload ?></p>
            </td>            
            <tr>
                <td colspan="4" width="100%">
                    <small class="label">JUSTIFICATIVA:</small>
                    <p><?= $model->vacancy_motive ?: '...' ?></p>
                </td>
            </tr>
            <tr>
                <td colspan="4" width="100%">
                    <small class="label">BENEFÍCIOS:</small>
                    <p><?= $model->vacancy_benefits ? implode(', ', $model->vacancy_benefits) : '...' ?></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table cellspacing="5" cellpadding="0" width="100%" style="margin-top: 15px">
        <tbody>
            <tr valign="top">
                <td colspan="1" width="50%">
                    <small class="label">ATIVIDADES:</small>
                    <p class="text"><?= $model->vacancy_activities ?: '...' ?></p>
                </td>
                <td colspan="1" width="50%">
                    <small class="label">REQUERIMENTOS:</small>
                    <p class="text"><?= $model->vacancy_requirements ?: '...' ?></p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <small class="label">OBSERVAÇÕES:</small>
                    <p><?= $model->vacancy_comments ?: '...' ?></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table width="100%" style="margin-top: 100px">
        <tr>
            <td colspan="1" width="50%" align="center" style="border: 0;">                
                <span><?= $model->rh_authorization ? $model->rh->full_name : '&nbsp;'; ?></span>
                <hr style="margin: 0">                
            </td>
            <td colspan="1" width="50%" align="center" style="border: 0;">
                <span><?= $model->dp_authorization ? $model->dp_authorization : '&nbsp;'; ?></span>
                <hr style="margin: 0">
            </td>
        </tr>
        <tr>
            <td width="50%" align="center" style="border: 0">
                <p style="font-size: 10px;">Gestor Recursos Humanos</p><br>
                <p style="font-size: 8px;">Eu como responsável do departamento de RH, declaro  estar ciente sobre esta movimentação.</p>
            </td>
            <td width="50%" align="center" style="border: 0">
                <p style="font-size: 10px;">Gestor Dep. Pessoal</p><br>
                <p style="font-size: 8px;">Eu como responsável pelo departamento pessoal, declaro  estar ciente sobre esta movimentação.</p>
            </td>
        </tr>
    </table>
    <table width="100%" style="margin-top: 50px">
        <tr>
            <td colspan="1" width="50%" align="center" style="border: 0;">                
                <span><?= $model->user->full_name ? $model->user->full_name : '&nbsp;'; ?></span>
                <hr style="margin: 0">                
            </td>
            <td colspan="1" width="50%" align="center" style="border: 0;">
                <span><?= $model->director_authorization ? $model->director->full_name : '&nbsp;'; ?></span>
                <hr style="margin: 0">
            </td>
        </tr>
        <tr>
            <td colspan="1" width="50%" align="center" style="border: 0">
                <p style="font-size: 10px;">Solicitante</p><br>
                <p style="font-size: 8px;">Eu como solicitante, declaro estar ciente sobre esta requisição.</p>
            </td>
            <td colspan="1" width="50%" align="center" style="border: 0">
                <p style="font-size: 10px;">Diretor / Responsável</p><br>
                <p style="font-size: 8px;">Eu como diretor responsável, declaro estar ciente sobre esta requisição.</p>
            </td>            
        </tr>
    </table>
</div>