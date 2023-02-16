<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

$this->params['breadcrumbs'][] = ['label' => 'RBAC', 'url' => ['#']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'menu'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile("@web/css/rbac/main.css", [
    'depends' => [\app\assets\AdminLimitlessAsset::className()],
], 'css-print-theme');

?>

<div class="card col-md-10 mb-5 px-0">
    <div class="card-body">
        <?= $this->render('_form', ['model' => $model]) ?>
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
        <a href="/admin/rbac/route">Route</a>
    </div>
    <div class="rbac-menu">
        <a href="/admin/rbac/menu" class="active">Menu</a>
    </div>
</div>