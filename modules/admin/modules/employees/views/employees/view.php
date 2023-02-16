<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\employees\Employees */

$this->title = $model['name'];
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card col-md-12">
    <div class="card-body ">
        <div class="employees-view">

            <h1><?= $model['name'] ?></h1>

            <table class="table table-striped table-bordered detail-view">
                <tbody>
                    <tr>
                        <th>NIK</th>
                        <td><?= $model['nik'] ?></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td><?= $model['name'] ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><a href="mailto:<?= $model['email'] ?>"><?= $model['email'] ?></a></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td><?= $model['phone'] ?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?= $model['address'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>