<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->params['breadcrumbs'][] = ['label' => 'RBAC', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile("@web/css/rbac/main.css", [
    'depends' => [\app\assets\AdminLimitlessAsset::className()],
], 'css-print-theme');

$columns = [
    ['class' => 'yii\grid\SerialColumn'],
    $emailField,
];

$columns[] = [
    'class' => 'yii\grid\ActionColumn',
    'template' => '{view}'
];

?>

<div class="card col-md-10 mb-5 px-0">
    <div class="card-body row">
        <div class="col-md-12 px-0 overflow-auto">
            <?php Pjax::begin(); ?>
                <?= GridView::widget([
                    'pager' => [
                        'firstPageLabel' => 'First',
                        'lastPageLabel'  => 'Last',
                        'maxButtonCount' => 3,
                    ],
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        [
                            'headerOptions' => [
                                'class' => 'text-center text-uppercase',
                                'style' => 'min-width:50px;max-width:50px;width:50px'
                            ],
                            'contentOptions' => [
                                'class' => 'text-center font-11',
                            ],
                            'class' => 'yii\grid\SerialColumn'
                        ],
                        [
                            'headerOptions' => [
                                'class' => 'text-center text-uppercase font-12',
                                'style' => 'min-width:250px'
                            ],
                            'header' => Yii::t('app', 'name'),
                            'attribute' => 'name',
                            'filterInputOptions' => [
                                'class' => 'text-center form-control font-12',
                                'autocomplete' => 'off'
                            ],
                            'format' => 'raw',
                            'value' => function($data) {
                                return $data->name.'<br><small>('.$data->email.')</small>';
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => [
                                'class' => 'text-center',
                                'style' => 'min-width:60px;max-width:60px;width:60px'
                            ],
                            'header' => false,
                            'template' => '{view}',
                            'buttons' => [
                                'view' => function($url, $data) {
                                    return Html::a(
                                        '<button type="button" class="btn btn-sm btn-primary text-center px-0" style="width:40px">
                                            <i class="fa fa-eye"></i>
                                        </button>',
                                        $url,
                                        [
                                            'title' => 'View',
                                        ]
                                    );
                                },
                            ],
                        ],
                    ],
                ]) ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>

<div class="col-md-2 rbac-container-menu mb-5">
    <div class="rbac-menu">
        <a href="/admin/rbac/user">User</a>
    </div>
    <div class="rbac-menu">
        <a href="/admin/rbac/assignment" class="active">Assignment</a>
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
        <a href="/admin/rbac/menu">Menu</a>
    </div>
</div>