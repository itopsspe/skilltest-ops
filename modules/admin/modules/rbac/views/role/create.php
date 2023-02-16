<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'RBAC', 'url' => ['#']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'role'), 'url' => ['index']];
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

<div class="col-md-2 rbac-container-menu">
    <div class="rbac-menu">
        <a href="/admin/rbac/user">User</a>
    </div>
    <div class="rbac-menu">
        <a href="/admin/rbac/assignment">Assignment</a>
    </div>
    <div class="rbac-menu">
        <a href="/admin/rbac/role" class="active">Role</a>
    </div>
    <div class="rbac-menu">
        <a href="/admin/rbac/permission">Permission</a>
    </div>
    <div class="rbac-menu">
        <a href="/admin/rbac/route">Route</a>
    </div>
    <div class="rbac-menu">
        <a href="/admin/rbac/menu">Menu</a>
    </div>
</div>