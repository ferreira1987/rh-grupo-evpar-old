<?php
    use yii\helpers\Html;
    $profile = Yii::$app->user->identity->profile;
?>

<aside id="sidebar-custom" class="main-sidebar sidebar-dark-blue elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Yii::$app->homeUrl ?>" class="bg-gradient-light d-block p-2" >
        <img src="<?= Yii::getAlias('@web/') ?>images/logo-evpar.png" alt="Grupo Evpar" class="img-fluid">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=<?= Yii::$app->user->isGuest ? 'V' : Yii::$app->user->identity->full_name ?>" class="img-circle elevation-2" alt="<?= Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->full_name ?>">
            </div>
            <div class="info">
                <?= Html::a(Yii::$app->user->identity->full_name, ['/user/update', 'id' => Yii::$app->user->identity->id], ['class' => 'btn btn-sm']); ?>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Formulários', 'header' => true],
                    ['label' => 'Requisição',  'icon' => 'user-plus', 'url' => ['/personnel-request']],
                    ['label' => 'Movimentação', 'icon' => 'retweet', 'url' => ['/personnel-movement']],
                    ['label' => 'Checklist', 'icon' => 'ban', 'url' => ['/shutdown-checklist']],
                    ['label' => 'Entrevista', 'icon' => 'tasks', 'url' => ['/shutdown-ask']],
                    ['label' => 'Programação', 'icon' => 'calendar-check', 'url' => ['/calendar-event']],
                    ['label' => 'Painel', 'icon' => 'bullhorn', 'url' => ['/notification-panel']],
                    ['label' => 'Ouvidoria', 'icon' => 'headset', 'url' => ['/ombudsman-call']],
                    ['label' => 'Usuários', 'icon' => 'users', 'url' => ['/user'], 'visible' => ($profile === 'ADMIN' || $profile === 'MANAGER')],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>