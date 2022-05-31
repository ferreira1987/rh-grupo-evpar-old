<?php
/* @var $content string */

use common\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
?>
<div class="content-wrapper <?= Yii::$app->user->isGuest ? 'isGuest' : '' ?>">
    <!-- Content Header (Page header) -->
    <div class="content-header <?= Yii::$app->user->isGuest ? 'd-none' : '' ?>">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0">
                        <?php
                        if (!is_null($this->title)) {
                            echo \yii\helpers\Html::encode($this->title);
                        } else {
                            echo \yii\helpers\Inflector::camelize($this->context->id);
                        }
                        ?>
                    </h5>
                </div><!-- /.col -->
                <div class="col-sm-6 p-0">
                    <?php
                        echo Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            'options' => [
                                'class' => 'breadcrumb float-sm-right'
                            ]
                        ]);
                    ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content p-3">
        <?= \hail812\adminlte\widgets\FlashAlert::widget(); ?>
        <?= $content ?><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>