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

?>

<div class="card col-md-10 mb-5 px-0">
    <div class="card-body row">
        <div class="col-md-12 text-right">
            <?= Html::a('<i class="fa fa-plus-circle"></i>', ['create'], ['class' => 'btn btn-primary']) ?>
        </div>

        <div class="col-md-12 px-0 overflow-auto">
            <?php Pjax::begin(); ?>
                <?= GridView::widget([
                    'pager' => [
                        'firstPageLabel' => 'First',
                        'lastPageLabel'  => 'Last',
                        'maxButtonCount' => 3,
                    ],
                    'dataProvider' => $dataProvider,
                    'options' => ['class' => 'form-horizontal main-table'],
                    'filterModel' => $searchModel,
                    'columns' => [
                        [
                            'headerOptions' => [
                                'class' => 'text-center text-uppercase font-12 c-white',
                                'style' => 'min-width:40px;max-width:40px;width:40px',
                            ],
                            'class' => 'yii\grid\SerialColumn',
                            'contentOptions' => [
                                'class' => 'text-center text-bold font-12',
                            ],
                        ],
                        [
                            'headerOptions' => [
                                'class' => 'text-center text-uppercase font-12',
                                'style' => 'min-width:170px;max-width:170px;width:170px'
                            ],
                            'attribute' => 'name',
                            'filterInputOptions' => [
                                'class' => 'text-center form-control font-11'
                            ],
                            'contentOptions' => [
                                'class' => 'font-11',
                            ],
                        ],
                        [
                            'headerOptions' => [
                                'class' => 'text-center text-uppercase font-12',
                                'style' => 'min-width:170px;max-width:170px;width:170px'
                            ],
                            'attribute' => 'menuParent.name',
                            'label' => Yii::t('app', 'parent'),
                            'filterInputOptions' => [
                                'class' => 'text-center form-control font-11'
                            ],
                            'filter' => Html::activeTextInput($searchModel, 'parent_name', [
                                'class' => 'form-control', 'id' => null
                            ]),
                            'contentOptions' => [
                                'class' => 'font-11',
                            ],
                            'value' => function($data) {
                                if ($data->menuParent != NULL) {
                                    return $data->menuParent->name;
                                } else {
                                    return '-';
                                }
                            }
                        ],
                        [
                            'headerOptions' => [
                                'class' => 'text-center text-uppercase font-12',
                            ],
                            'attribute' => 'route',
                            'label' => Yii::t('app', 'route'),
                            'filterInputOptions' => [
                                'class' => 'text-center form-control font-11'
                            ],
                            'contentOptions' => [
                                'class' => 'font-11',
                            ],
                            'value' => function($data) {
                                if ($data->route != NULL) {
                                    return $data->route;
                                } else {
                                    return '-';
                                }
                            }
                        ],
                        [
                            'headerOptions' => [
                                'class' => 'text-center text-uppercase font-12',
                                'style' => 'min-width:70px;max-width:70px;width:70px'
                            ],
                            'attribute' => 'order',
                            'label' => Yii::t('app', 'order'),
                            'filterInputOptions' => [
                                'class' => 'text-center form-control font-11'
                            ],
                            'contentOptions' => [
                                'class' => 'text-center font-11',
                            ],
                            'value' => function($data) {
                                if ($data->order != NULL) {
                                    return $data->order;
                                } else {
                                    return '-';
                                }
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => [
                                'class' => 'text-center text-uppercase',
                                'style' => 'min-width:60px;max-width:60px;width:60px'
                            ],
                            'header' => '#',
                            'template' => '{update} {delete}',
                            'buttons' => [
                                'update' => function($url, $data) {
                                    return Html::a(
                                        '<button type="button" class="btn btn-sm btn-primary text-center px-0 mb-1" style="width:40px">
                                            <i class="fa fa-pencil"></i>
                                        </button>',
                                        $url,
                                        [
                                            'title' => 'Update',
                                        ]
                                    );
                                },
                                'delete' => function($url, $data) {
                                    return Html::a(
                                        '<button type="button" class="btn btn-sm btn-danger text-center px-0" style="width:40px">
                                            <i class="fa fa-trash"></i>
                                        </button>',
                                        $url,
                                        [
                                            'title' => 'Delete',
                                            'data-pjax' => '0',
                                            'data' => [
                                                'confirm' => 'Are you sure to delete this Menu?',
                                                'method' => 'post',
                                            ]
                                        ]
                                    );
                                },
                            ],
                        ],
                    ],
                ]); ?>
            <?php Pjax::end(); ?>
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
        <a href="/admin/rbac/route">Route</a>
    </div>
    <div class="rbac-menu">
        <a href="/admin/rbac/menu" class="active">Menu</a>
    </div>
</div>
