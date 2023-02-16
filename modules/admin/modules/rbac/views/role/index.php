<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

use yii\grid\GridView;
use yii\helpers\Html;
use app\components\rbac\RouteRule;
use app\components\rbac\Configs;

$this->params['breadcrumbs'][] = ['label' => 'RBAC', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile("@web/css/rbac/main.css", [
    'depends' => [\app\assets\AdminLimitlessAsset::className()],
], 'css-print-theme');

$rules = array_keys(Configs::authManager()->getRules());

$rules = array_combine($rules, $rules);

unset($rules[RouteRule::RULE_NAME]);

?>

<div class="card col-md-10 mb-5 px-0">
    <div class="card-body row">
        <div class="col-md-12 text-right">
            <?= Html::a('<i class="fa fa-plus-circle"></i>', ['create'], ['class' => 'btn btn-primary']) ?>
        </div>

        <div class="col-md-12 px-0 overflow-auto">
            <?= GridView::widget([
                'pager' => [
                    'firstPageLabel' => 'First',
                    'lastPageLabel'  => 'Last',
                    'maxButtonCount' => 3,
                ],
                'dataProvider' => $dataProvider,
                'options' => ['class' => 'form-horizontal'],
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'headerOptions' => [
                            'class' => 'text-center text-uppercase font-12',
                            'style' => 'min-width:50px;max-width:50px;width:50px',
                        ],
                        'class' => 'yii\grid\SerialColumn',
                        'contentOptions' => [
                            'class' => 'text-center text-bold font-12',
                        ],
                    ],
                    [
                        'headerOptions' => [
                            'class' => 'text-center text-uppercase font-12',
                            'style' => 'min-width:250px'
                        ],
                        'attribute' => 'name',
                        'label' => Yii::t('app', 'role'),
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
                            'style' => 'min-width:250px'
                        ],
                        'attribute' => 'description',
                        'label' => Yii::t('app', 'description'),
                        'filterInputOptions' => [
                            'class' => 'text-center form-control font-11'
                        ],
                        'contentOptions' => [
                            'class' => 'font-11',
                        ],
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'headerOptions' => [
                            'class' => 'text-center text-uppercase',
                            'style' => 'min-width:60px;max-width:60px;width:60px'
                        ],
                        'header' => '#',
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
        </div>
    </div>
</div>

<div class="col-md-2 mb-5 rbac-container-menu">
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