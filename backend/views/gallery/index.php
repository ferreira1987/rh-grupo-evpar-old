<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use richardfan\widget\JSRegister;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Media';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="media-index">

    <p>
        <?= Html::a(Yii::t('app', '<i class="fa fa-cloud-upload-alt"></i> &nbsp; Enviar Imagens'), ['create'], ['class' => 'btn btn-outline-primary pull-right', 'data-toggle' => 'modal', 'data-target' => '#media-manager']) ?>
    </p>

    <?php Pjax::begin(['id' => 'imagesGrid']); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '{items}',
        'emptyText' => 'Não há medias a serem exibidas',
        'itemOptions' => ['class' => 'col-2'],
        'options' => ['class' => 'row'],
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('_image', ['model' => $model, 'index' => $index]);//Html::a(Html::encode($model->title), ['view', 'id' => $model->id]);
        },
        'summaryOptions' => ['class' => 'col-12'],
        'pager' => [
            'options' => [
                'class' => 'col-12 mt-5 kt-pagination kt-pagination--lg kt-pagination--circle kt-pagination--info'
            ],
            /*'listOptions' => [ // tag UL
                'class' => 'mx-auto kt-pagination__links'
            ],*/
            'linkContainerOptions' => [ // tag LI
                'class' => ''
            ],
            'linkOptions' => ['class' => ['']], // tag A
            'firstPageCssClass' => 'kt-pagination__link--first',
            'lastPageCssClass' => 'kt-pagination__link--last',
            'prevPageCssClass' => 'kt-pagination__link--prev',
            'nextPageCssClass' => 'kt-pagination__link--next',
            'activePageCssClass' => 'kt-pagination__link--active'
        ]
    ]) ?>

    <?php Pjax::end(); ?>

    <!-- MODAL MEDIA UPLOAD -->
    <div class="modal fade" id="media-manager" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" style="min-width: 90%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enviar imagens</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form class="col-12 card dropzone" id="my-awesome-dropzone">
                            <div class="dz-message" data-dz-message>
                                <i class="fa fa-4x fa-images"></i><br>  
                                <span>ARRASTE AS IMAGENS OU CLIQUE AQUI</span>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

</div>


<?php JSRegister::begin([
    'position' => \yii\web\View::POS_END
]); ?>
    <script>
        $('.dropzone').dropzone({
            url: "upload", // Set the url for your upload script location
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 10,
            maxFilesize: 10, // MB
            resizeWidth: 1024,
            resizeHeight: 1024,
            resizeMethod: "crop",
            resizeMimeType: 'image/jpeg',
            addRemoveLinks: true,
            acceptedFiles: "image/jpg, image/jpeg, image/png, image/gif",
            complete: function(data){
                console.log('done!');
            },
            queuecomplete: function(){
                console.log('AllDone!!');
                this.removeAllFiles();
                $('#media-manager').modal('hide')
                $.pjax.reload({container:'#imagesGrid'})
            }
        });
    </script>
<?php JSRegister::end(); ?>