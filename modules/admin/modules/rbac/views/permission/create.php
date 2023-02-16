<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

$this->params['breadcrumbs'][] = ['label' => 'RBAC', 'url' => ['#']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'permission'), 'url' => ['index']];
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
        <a href="/official/rbac/assignment">Assignment</a>
    </div>
    <div class="rbac-menu">
        <a href="/official/rbac/role">Role</a>
    </div>
    <div class="rbac-menu">
        <a href="/official/rbac/permission" class="active">Permission</a>
    </div>
    <div class="rbac-menu">
        <a href="/official/rbac/route">Route</a>
    </div>
    <div class="rbac-menu">
        <a href="/official/rbac/menu">Menu</a>
    </div>
</div>