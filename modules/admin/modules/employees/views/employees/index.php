<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\employees\EmployeesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $title;
?>

<div class="card col-md-12">
    <div class="card-body ">
        <div class="employees-index">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $emp) { ?>
                        <tr>
                            <td><?= $emp['nik'] ?></td>
                            <td><?= $emp['name'] ?></td>
                            <td><?= $emp['email'] ?></td>
                            <td><?= $emp['phone'] ?></td>
                            <td><?= $emp['address'] ?></td>
                            <td>
                                <a class="user-trigger" href="employees/view?nik=<?= $emp['nik'] ?>" title="View">
                                    <button type="button" class="btn btn-sm btn-primary" style="width:40px">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>


        </div>
    </div>
</div>