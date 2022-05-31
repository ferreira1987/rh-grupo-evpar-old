<?php

use backend\models\User;
use kartik\date\DatePicker;
use kartik\datecontrol\DateControl;
use richardfan\widget\JSRegister;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model backend\models\PersonnelMovement */
/* @var $form yii\widgets\ActiveForm */

$action = Yii::$app->controller->action->id;
$groups = \yii\helpers\ArrayHelper::map(\backend\models\Enterprise::find()->distinct('group_id')->all(), 'group_id', 'group_name'); //'group_name'

if(Yii::$app->controller->action->id === 'create'){
    $requester = User::find()->where(['id' => Yii::$app->user->identity->id])->with('enterprise')->one();
}else{
    $requester = User::find()->where(['id' => $model->requester_id])->with('enterprise')->one();
}

?>

<div class="personnel-movement-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-9">
            <div class="card card-secondary card-outline">
                <div class="card-header header-primary">
                    <i class="fa fa-lg fa-user-tie"></i> Solicitante
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 form-group">
                            <?= Html::label('Solicitante'); ?>
                            <?= Html::input('text', 'requester', $requester->full_name, ['disabled' => 'disabled', 'class' => 'form-control']) ?>
                        </div>
                        <div class="col-6 form-group">
                            <?= Html::label('Empresa'); ?>
                            <?= Html::input('text', 'requester', $requester->enterprise->company_name, ['disabled' => 'disabled', 'class' => 'form-control']) ?>
                        </div>
                        <div class="col-4 form-group">
                            <?= Html::label('Cargo'); ?>
                            <?= Html::input('text', 'requester', $requester->office, ['disabled' => 'disabled', 'class' => 'form-control']) ?>
                        </div>
                        <div class="col-4 form-group">
                            <?= Html::label('Departamento'); ?>
                            <?= Html::input('text', 'requester', $requester->department, ['disabled' => 'disabled', 'class' => 'form-control']) ?>
                        </div>
                        <div class="col-4 form-group">
                            <?= Html::label('Diretor/Responsável'); ?>
                            <?= Html::input('text', 'requester', $requester->direct_responsible, ['disabled' => 'disabled', 'class' => 'form-control']) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-secondary card-outline">
                <div class="card-header header-primary">
                    <i class="fa fa-lg fa-id-card-alt"></i> Colaborador
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <?= $form->field($model, 'group')->widget(Select2::class, [
                                    'data' => $groups,
                                    'options' => [
                                        'id' => 'group',
                                        'placeholder' => 'Escolha uma empresa',
                                        'value' => $action == 'update' ?  $model->enterprise->group_id : null
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => false,
                                    ]
                                ]) ?>
                            </div>
                        </div>
                        <div class="col-8">
                            <?= $form->field($model, 'staff_company')->widget(DepDrop::class, [
                                'type' => DepDrop::TYPE_SELECT2,
                                'options' => ['id' => 'company', 'placeholder' => 'Escolher ...'],
                                'select2Options' => [
                                    'value' => $action == 'update' ? $model->enterprise->company_id : null,
                                    'initValueText' => $action == 'update' ? $model->enterprise->company_name : null,
                                    'pluginOptions' => ['allowClear' => false],
                                    'pluginEvents' => [
                                    ]
                                ],
                                'pluginOptions' => [
                                    'depends' => ['group'],
                                    'url' => Url::to(['/enterprise/companies']),
                                    'loadingText' => 'Escolher Filial ...',
                                ]
                            ]); ?>
                        </div>
                        <div class="col-6">
                            <?= $form->field($model, 'staff_id')->widget(DepDrop::class, [
                                'type' => DepDrop::TYPE_SELECT2,
                                'options' => ['id' => 'staff'],
                                'select2Options' => [
                                    'value' => $action == 'update' ? $model->staff_id : null,
                                    'initValueText' => $action == 'update' ? $model->staff->RA_NOME : null,
                                    'pluginOptions' => ['allowClear' => false],
                                    'pluginEvents' => [
                                    ]
                                ],
                                'pluginOptions' => [
                                    'depends' => ['company'],
                                    'placeholder' => 'Escolher ...',
                                    'url' => Url::to(['/enterprise/employees']),
                                    'loadingText' => 'Selecione uma Filial ...',
                                ],
                                'pluginEvents' => [
                                    "select2:select" => "function(event){ 
                                        console.log(event)
                                        
                                        $.ajax({
                                            method: 'POST',
                                            url: '/enterprise/employee',
                                            data: { staff_id: event.params.data.id, company_id: $('#company').val() }
                                        }).done(function(data) {
                                            console.log('AjaxData:', data)
                                            $('#personnelmovement-staff_registry').val(data.output.RA_MAT)
                                            $('#personnelmovement-staff_admission').val(data.output.RA_ADMISSA)
                                            $('#personnelmovement-staff_cc').val(data.output.RA_CC)
                                            $('#personnelmovement-staff_job').val(data.output.CARGO?.RJ_DESC)
                                        });
                                    }",
                                    "depdrop:change" => "function(event, id, value, count){
                                        console.info('id', id); console.info('value', value); console.info('count', count);
                                    }"
                                ]
                            ]); ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'staff_registry')->textInput(['readonly' => 'readonly']) ?>
                        </div>
                        <div class="col-3">
                            <?php echo $form->field($model, 'staff_admission')->widget(DatePicker::class, [
                                'disabled' => true,
                                'options' => ['placeholder' => 'Data ...'],
                                'pluginOptions' => [
                                    'autoclose' => true
                                ]
                            ]); ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'staff_cc')->textInput(['readonly' => 'readonly']) ?>
                        </div>
                        <div class="col-5">
                            <?= $form->field($model, 'staff_job')->textInput(['readonly' => 'readonly']) ?>
                        </div>
                        <div class="col-4">
                            <!-- <?= $form->field($model, 'staff_department')->textInput() ?> -->
                            <?= $form->field($model, 'staff_department')->dropDownList(['RH' => 'Recursos Humanos', 'DP' => 'Departamento Pessoal', 'TI' => 'Tecnologia', 'DR' => 'Diretoria'], ['prompt' => '']) ?> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-secondary card-outline">
                <div class="card-header header-primary">
                    <i class="fa fa-lg fa-retweet"></i> Movimentação
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <?= $form->field($model, 'movement_type')->dropDownList([ 'ALTERACAO' => 'ALTERACAO', 'DESLIGAMENTO' => 'DESLIGAMENTO', ], ['prompt' => '...']) ?>
                        </div>
                        <div class="col-4 change_motive">
                            <?= $form->field($model, 'change_motive')->dropDownList([ 'PROMOCAO' => 'PROMOCAO', 'OUTROS' => 'OUTROS', ], ['prompt' => '...']) ?>
                        </div>
                        <div class="col-4 shutdown_motive">
                            <?= $form->field($model, 'shutdown_motive')->dropDownList([ 'PEDIDO DE DEMISSAO' => 'PEDIDO DE DEMISSAO', 'TERMINO DE CONTRATO' => 'TERMINO DE CONTRATO', 'DEMISSAO SEM JUSTA CAUSA' => 'DEMISSAO SEM JUSTA CAUSA', 'DEMISSAO POR JUSTA CAUSA' => 'DEMISSAO POR JUSTA CAUSA', ], ['prompt' => '...']) ?>
                        </div>
                        <div class="col-4 shutdown_type">
                            <?= $form->field($model, 'shutdown_type')->dropDownList([ 'AVISO TRABALHADO' => 'AVISO TRABALHADO', 'AVISO INDENIZADO' => 'AVISO INDENIZADO', ], ['prompt' => '...']) ?>
                        </div>
                        <div id="movement-box" class="col-12">
                            <div class="row">
                                <?= \common\widgets\repeater\Repeater::widget(['model' => $model]) ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <?= $form->field($model, 'attachments')->checkboxList(['Avl. Periodo Experiencia', 'Feedback de Acompanhamento', 'Outros']) ?>
                        </div>
                        <div class="col-12">
                            <?= $form->field($model, 'justification')->textarea() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card card-success card-outline" id="sidemenu" data-spy="affix" data-offset-top="197">
                <div class="card-header">
                    Opções
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php if($action == 'update') : ?>
                            <div class="col-12 d-flex justify-content-center">
                                <img src="<?= Yii::getAlias('@web') . $model->logo; ?>"  class="img-fluid" width="150px" alt="">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <?php
                                if(!in_array(Yii::$app->user->identity->id, [$model->dp_authorization, $model->director_authorization, $model->rh_authorization]) && Yii::$app->user->identity->id == $model->requester_id){
                                    echo Html::submitButton('<i class="fa fa-lg fa-save"></i> Salvar', ['class' => 'btn btn-outline-success btn-block']);
                                }elseif($action === 'create'){
                                    echo Html::submitButton('<i class="fa fa-lg fa-save"></i> Salvar', ['class' => 'btn btn-outline-success btn-block']);
                                }
                            ?>
                        </div>
                        <div class="col-12 form-group <?= $action === 'update' ? 'd-block':'d-none'?>">
                            <?php
                                if(in_array(Yii::$app->user->identity->profile, ['ADMIN', 'MANAGER'])){
                                    if(in_array(Yii::$app->user->identity->id, [$model->dp_authorization, $model->director_authorization, $model->rh_authorization])){
                                       echo Html::button('<i class="fa fa-lg fa-check"></i> Você já aprovou!', ['class' => 'btn btn-success btn-block']);
                                    }else{
                                        echo Html::a('<i class="fa fa-lg fa-thumbs-up"></i> Aprovar', ['approve', 'id' => $model->id], ['class' => 'btn btn-outline-info btn-block', 'data-method' => 'post', 'data-confirm' => 'Deseja realmente aprovar está movimentação?']);
                                    }
                                }
                            ?>

                            <?= Html::a('<i class="fa fa-lg fa-file-pdf"></i> Imprimir', ['pdf-view', 'id' => $model->id], ['class' => 'btn btn-outline-secondary btn-block', 'target' => '_new']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <?= Html::a('<i class="fa fa-lg fa-hand-point-left"></i> Voltar', 'index', ['class' => 'btn btn-app d-block m-0']) ?>
                        </div>
                        <div class="col-6">
                            <?= Html::a('<i class="fa fa-lg fa-plus"></i> Novo', 'create', ['class' => 'btn btn-app d-block m-0']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php JSRegister::begin([
    'position' => \yii\web\View::POS_READY
]); ?>
    <script>
        if($("#personnelmovement-movement_type").val() === 'ALTERACAO'){
            $(".change_type").show()
            $(".change_motive").show()
            $(".shutdown_motive").hide()
            $(".shutdown_type").hide()
            $("#movement-box").show()
        }else if($("#personnelmovement-movement_type").val() === 'DESLIGAMENTO'){
            $(".change_type").hide()
            $(".change_motive").hide()
            $(".shutdown_motive").show()
            $(".shutdown_type").show()
            $("#movement-box").hide()
        } else {
            $(".change_type").hide()
            $(".change_motive").hide()
            $(".shutdown_motive").hide()
            $(".shutdown_type").hide()
            $("#movement-box").hide()
        }

        $("#personnelmovement-movement_type").change(function() {
            if ($(this).val() === 'ALTERACAO') {
                $(".change_type").show()
                $(".change_motive").show()
                $(".shutdown_motive").hide()
                $(".shutdown_type").hide()
                $("#movement-box").show()
            } else {
                $(".shutdown_motive").show()
                $(".shutdown_type").show()
                $(".change_type").hide()
                $(".change_motive").hide()
                $("#movement-box").hide()
            }
        })
    </script>
<?php JSRegister::end(); ?>
