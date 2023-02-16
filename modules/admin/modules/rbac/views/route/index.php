<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\YiiAsset;
use app\assets\rbac\RBACAnimate;

$this->params['breadcrumbs'][] = ['label' => 'RBAC', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile("@web/css/rbac/main.css", [
    'depends' => [\app\assets\AdminLimitlessAsset::className()],
], 'css-print-theme');

RBACAnimate::register($this);

YiiAsset::register($this);

$opts = Json::htmlEncode([
    'routes' => $routes,
]);

$this->registerJs("var _opts = {$opts};");

$this->registerJs($this->render('_script.js'));

$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';

?>

<div class="card col-md-10 mb-5 px-0">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12" style="margin-bottom:30px">
                <div class="input-group">
                    <input id="inp-route" type="text" class="form-control font-12" placeholder="<?= Yii::t('app', 'new route(s)') ?>">
                    <span class="input-group-btn">
                        <?= Html::a(Yii::t('app', 'add') . $animateIcon, ['create'], [
                            'class' => 'btn btn-primary',
                            'id' => 'btn-new',
                        ]);?>
                    </span>
                </div>
            </div>

            <div class="col-md-5">
                <div class="input-group">
                    <input class="form-control search font-12" data-target="available" placeholder="<?= Yii::t('app/message', 'search for available') ?>">
                    <span class="input-group-btn">
                        <?= Html::a('<span class="fas fa-sync"></span>', ['refresh'], [
                            'class' => 'btn btn-info',
                            'id' => 'btn-refresh',
                        ]);?>
                    </span>
                </div>

                <select multiple size="20" class="form-control list font-12" style="height:300px"  data-target="available"></select>
            </div>

            <div class="col-md-2 text-center">
                <?= Html::a('<i class="fa fa-forward"></i>' . $animateIcon, ['assign'], [
                    'class' => 'btn btn-block btn-primary btn-assign',
                    'data-target' => 'available',
                    'title' => Yii::t('app', 'assign'),
                ]) ?>
                    
                <?= Html::a('<i class="fa fa-backward"></i>' . $animateIcon, ['remove'], [
                    'class' => 'btn btn-block btn-danger btn-assign',
                    'data-target' => 'assigned',
                    'title' => Yii::t('app', 'remove'),
                ]) ?>
            </div>
                                                    
            <div class="col-md-5">
                <input class="form-control search font-12" data-target="assigned" placeholder="<?= Yii::t('app/message', 'search for assignment') ?>">
                <select multiple size="20" class="form-control list font-12" style="height:300px" data-target="assigned"></select>
            </div>
        </div>
    </div>
</div>

<div class="col-md-2 rbac-container-menu mb-5">
    <div class="rbac-menu">
        <a href="/admin/rbac/user">User</a>
    </div>
    <div class="rbac-menu">
        <a href="/admin/rbac/assignment">Assignment</a>
    </div>
    <div class="rbac-menu">
        <a href="/admin/rbac/role">Role</a>
    </div>
    <div class="rbac-menu">
        <a href="/admin/rbac/permission">Permission</a>
    </div>
    <div class="rbac-menu">
        <a href="/admin/rbac/route" class="active">Route</a>
    </div>
    <div class="rbac-menu">
        <a href="/admin/rbac/menu">Menu</a>
    </div>
</div>