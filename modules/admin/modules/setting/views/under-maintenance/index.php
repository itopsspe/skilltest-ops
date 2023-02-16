<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Setting', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="card col-md-12 mb-5 px-0">
    <div class="card-title font-bold text-center py-2">
        <h2>Under Maintenance<h2>
    </div>
    <div class="card-body">
        <div class="offset-md-3 col-md-6">
            <div class="btn-group btn-group-justified border">
                <div class="btn-group">
                    <a href="/admin/setting/under-maintenance/1" class="btn <?= $model->status == 1 ? 'btn-primary' : 'btn-default' ?>">ON</a>
                </div>
                <div class="btn-group">
                    <a href="/admin/setting/under-maintenance/0" class="btn <?= $model->status == 0 ? 'btn-primary' : 'btn-default' ?>">OFF</a>
                </div>
            </div>
        </div>
    </div>
</div>