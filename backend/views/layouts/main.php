<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use backend\assets\AppAsset;

\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');

$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
\hail812\adminlte3\assets\PluginAsset::register($this)->add(['sweetalert2', 'toastr']);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style type="text/css">
        .isGuest{margin: 0px !important; width: 100% !important;}
    </style>
</head>
<body class="hold-transition sidebar-mini" data-spy="scroll" data-target=".navbar" data-offset="50">
<?php $this->beginBody() ?>

<div class="wrapper">   
    <!-- Main Sidebar Container -->
    <?php 
        if(!Yii::$app->user->isGuest){
            echo $this->render('navbar', ['assetDir' => $assetDir]);

            echo $this->render('sidebar', ['assetDir' => $assetDir]);
        }        
    ?>

    <!-- Content Wrapper. Contains page content -->
    <?= $this->render('content', ['content' => $content, 'assetDir' => $assetDir]) ?>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <?= $this->render('control-sidebar') ?>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?= $this->render('footer') ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
