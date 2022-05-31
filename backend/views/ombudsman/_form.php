<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\User;
use kartik\widgets\FileInput;
use yii\bootstrap4\Modal;
use yii\helpers\Url;
use richardfan\widget\JSRegister;


/* @var $this yii\web\View */
/* @var $model app\models\Ombudsman */
/* @var $form yii\widgets\ActiveForm */

$action = Yii::$app->controller->action->id;
?>

<div class="ombudsman-form">

    <?php 
        $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data'] // important
    ]); ?>

    <div class="row">
        <div class="col-9">
            <div class="card card-secondary card-outline">
                <div class="card-header header-primary">
                    <i class="fa fa-lg fa-user-tie"></i> Informações do Canal
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-6">
                            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-12">
                            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-12">
                            <?= $form->field($model, 'subtitle')->textInput(['maxlength' => true]) ?>
                        </div>
                        
                        <div class="col-12">
                            <?= $form->field($model, 'footer_title')->textInput(['maxlength' => true]) ?>
                        </div>
                        
                        <div class="col-12">
                            <?= $form->field($model, 'footer_subtitle')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-6">
                            <?= $form->field($model, 'banner')->textInput(['maxlength' => true]) ?>
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
                        <div class="col form-group">
                            <?= Html::submitButton('<i class="fa fa-lg fa-save"></i> Salvar', ['class' => 'btn btn-outline-success btn-block']) ?>
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

            <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h6><i class="fas fa-images"></i> Foto/Logomarca da loja</h6>
                        </div>
                        <div class="card-body">
                            <div class="row" id="store-images">
                                <?php if($model->logo) : ?>
                                    <div class="store-thumbnail col-12 mb-2" style="position: relative">
                                            <span class="drop-thumbnail btn btn-sm btns-danger btn-icon" style="display: none; position: absolute; top: -7px; right: 0; background: indianred; color: #fff">
                                                <i class="fa fa-trash"></i>
                                            </span>
                                        <img class="img-thumbnail" src="/<?= $model->logo ?>" alt="" style="object-fit: cover">
                                        <input type="hidden" name="Store[image]" value="<?= $model->logo ?>">
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?= Html::a(Yii::t('app',
                                '<i class="fa fa-1x fa-images"></i> Escolher Imagem'
                            ),
                                ['create'], [
                                    'class' => 'btn btn-outline-info btn-block mt-5',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#media-manager'
                                ])
                            ?>

                        </div>
                    </div>


            <div class="card card-success card-outline">
                <div class="card-header">
                    Logo
                </div>
                <div class="card-body">
                    <?php 
                    Modal::begin([
                        'title'=>'Logomarca',
                        'toggleButton' => [
                            'label'=>'Logo', 'class'=>'btn btn-block btn-default'
                        ],
                        'closeButton' => [
                            'label'=>'<i class="fa fa-lg fa-times text-danger"></i>', 'class'=>'btn btn-warn'
                        ],
                        'size' => 'modal-xl'
                    ]);
                    
                        
                    
                    Modal::end();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<!-- MODAL - MEDIA UPLOADER -->
<div class="modal fade" id="media-manager" tabindex="-1"
     role="dialog"  aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" style="min-width: 90%">
        <div class="modal-content">
            <div class="modal-header p-2">
                <ul class="nav nav-tabs m-0" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="upload-tab" data-toggle="tab" href="#upload" role="tab" aria-controls="upload" aria-selected="true">
                            Enviar Fotos
                        </a>
                    </li>
                    <li class="nav-item" role="tablist">
                        <a class="nav-link"  id="gallery-tab" data-toggle="tab" href="#gallery" role="tab" aria-controls="gallery" aria-selected="true">
                            Galeria de Fotos
                        </a>
                    </li>
                </ul>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tab-content" id="myTabContent" style="min-height: 250px">
                    <div class="tab-pane fade show active" id="upload" role="tabpanel" aria-labelledby="upload-tab">
                        <div class="row">
                            <div class="col-12 d-flex">
                                <form action="upload" class="dropzone d-flex flex-column justify-content-center flex-fill" style="border-radius: 6px; min-height: 250px; border-style: dashed">
                                    <i class="mx-auto fa fa-4x fa-images"></i>
                                    <h5 class="text-center">arraste e solte as imagens aqui!</h5>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
                        <div id="media-container" class="row">
                            <?php
                            $images = \backend\models\Gallery::find()->all();
                            if($images) :
                                foreach ($images as $image) { ?>
                                    <div class="col-2 mb-2">
                                        <div class="card p-2">
                                            <div class="card-body gallery-thumbnail p-1" style="position: relative">
                                                <div class="d-flex flex-column-reverse" style="position: absolute; top: -3px; right: -3px;">
                                                    <button class="drop-image btn btn-sm btn-icon btn-danger mb-1" id="trash-<?= $image->id ?>" data-id="<?= $image->id ?>">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-icon btn-info mb-1">
                                                        <input id="<?= $image->id ?>"
                                                               name="Store[image][<?=$image->path?>]"
                                                               data-link="<?=$image->path?>"
                                                               class="check-image"
                                                               type="checkbox">
                                                    </button>
                                                </div>
                                                <label for="<?= $image->id ?>" style="padding: 0">
                                                    <img src="<?= Url::to('@web/') . $image->path ?>" class="img-fluid" alt="" style="width: 100%; max-height: 180px; object-fit: cover">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-success" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<?php JSRegister::begin([
    'position' => \yii\web\View::POS_READY
]); ?>
    <script>

        //////////////////////////////////////
        //////// UPLOAD DE IMAGENS
        $('.dropzone').dropzone({
            url: "upload", // Set the url for your upload script location
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 10,
            maxFilesize: 10, // MB
            resizeWidth: 1024,
            resizeHeight: 1024,
            resizeMethod: "crop",
            //resizeMimeType: 'image/jpeg',
            addRemoveLinks: true,
            acceptedFiles: "image/jpg, image/jpeg, image/png, image/gif",
            complete: function(data){
                console.log('done!', data);
                let image = JSON.parse(data.xhr.response);
                console.log(image.path);

                let html = `<div class="col-2 mb-2">
                    <div class="card p-2">
                        <div class="card-body gallery-thumbnail p-1" style="position: relative">
                            <div class="d-flex flex-column-reverse" style="position: absolute; top: -3px; right: -3px;">
                                <button class="drop-image btn btn-sm btn-icon btn-danger mb-1" id="trash-${image.id}" data-id="${image.id}">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-info mb-1">
                                    <input id="${image.id}"
                                           name="Store[image][${image.path}]"
                                           data-link="${image.path}"
                                           class="check-image"
                                           type="checkbox">
                                </button>
                            </div>
                            <label for="${image.id}" style="padding: 0">
                            <img src="/${image.path}" class="img-fluid" alt="" style="width: 100%; max-height: 180px; object-fit: cover">
                            </label>
                        </div>
                    </div>
                </div>`;
                $('#media-container').prepend(html);
            },
            queuecomplete: function(){
                console.log('AllDone!!');
                this.removeAllFiles();
                $('#myTab a[href="#gallery"]').tab('show')
            }
        });

        //////////////////////////////////////
        //////// ADICIONA IMAGENS DA LOJA
        $(document).on('change', '.check-image', function(){
            let link = $(this).attr('data-link');

            if( $(this).prop( "checked" ) === true ) {
                let html = `<div class="store-thumbnail col-12 mb-2" style="position: relative">
                        <span class="drop-thumbnail btn btn-sm btns-danger btn-icon" style="display: none; position: absolute; top: -7px; right: 0; background: indianred; color: #fff">
                            <i class="fa fa-trash"></i>
                        </span>
                        <img class="img-thumbnail img-fluid" src="/${link}" alt="">
                        <input type="hidden" name="Store[image]" value="${link}">
                    </div>`;
                $('#store-images').html(html);
                $('#media-manager').modal('hide');
            } else
                $(`.store-thumbnail`).remove()
        })
        //////////////////////////////////////
        //////// SHOW HIDE IMAGE DROP BUTTON
        $(document).on('mouseover', '.store-thumbnail', function(){
            let element = $(this).attr('data-item');
            $(`.drop-thumbnail`).show('fast');
        })

        $(document).on('mouseleave', '.store-thumbnail', function(){
            let element = $(this).attr('data-item');
            $(`.drop-thumbnail`).hide('fast');
        })

        //////////////////////////////////////
        //////// DELETE STORE IMAGE THUMBNAIL
        $(document).on('click', '.drop-thumbnail', function(){
            let action = confirm('Confirma a exclusão?');

            if (action == true) {
                $(`.store-thumbnail`).remove();
                let html = `<input type="hidden" name="Store[image]" value="">`;
                $('#store-images').html(html);
            }
        })
    </script>
<?php JSRegister::end(); ?>