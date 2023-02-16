<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap4\Modal;

$this->params['breadcrumbs'][] = ['label' => 'RBAC', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile("@web/css/rbac/main.css", [
    'depends' => [\app\assets\AdminLimitlessAsset::className()],
], 'css-print-theme');

$css = <<<CSS
.modal-dialog {
    margin-top: 100px;
}
CSS;

$this->registerCss($css);

Modal::begin([
    'id' => 'user-modal',
    'size' => 'modal-lg',
]);

echo "<div id='user-content' style='max-height:400px;overflow-y:scroll'></div>";

Modal::end();

$js = <<<JS
$(document).ready(function() {
    function refreshPjax()
    {
        $.pjax.reload({container: "#user-pjax", async: false});
    }
});
JS;

$this->registerJs($js);

?>

<div class="card col-md-10 mb-5 px-0">
    <div class="card-body row">
        <div class="col-md-12 text-right">
            <?= Html::a('<i class="fa fa-plus-circle"></i>', ['create'], ['class' => 'btn btn-primary']) ?>
        </div>

        <div class="col-md-12 px-0 overflow-auto">
            <?php Pjax::begin(['id' => 'user-pjax', 'timeout' => 880000]); ?>
                <?php
                    $js = "
                    $(document).ready(function ($) {
                        $('.user-trigger').on('click', function (event) {
                            event.preventDefault();
                            $('#user-modal').modal('show').find('#user-content').load($(this).attr('href'));
                            $(window).scrollTop(0);
                        });
                    });
                    ";
                    
                    $this->registerJs($js);
                ?>

                <?= GridView::widget([
                    'pager' => [
                        'firstPageLabel' => 'First',
                        'lastPageLabel'  => 'Last',
                        'maxButtonCount' => 3,
                    ],
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        [
                            'headerOptions' => [
                                'class' => 'text-center text-uppercase font-12'
                            ],
                            'attribute' => 'name',
                            'label' => 'Name',
                            'contentOptions' => [
                                'class' => 'font-11'
                            ]
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => [
                                'class' => 'text-center text-uppercase',
                                'style' => 'min-width:155px;max-width:155px;width:155px'
                            ],
                            'header' => '#',
                            'template' => '{detail} {update} {delete}',
                            'buttons' => [
                                'detail' => function($url, $data) {
                                    return Html::a(
                                        '<button type="button" class="btn btn-sm btn-primary text-center px-0 mb-1" style="width:40px">
                                            <i class="fa fa-eye"></i>
                                        </button>',
                                        $url,
                                        [
                                            'title' => 'View',
                                            'class' => 'user-trigger',
                                        ]
                                    );
                                },
                                'update' => function($url, $data) {
                                    return Html::a(
                                        '<button type="button" class="btn btn-sm btn-warning text-center px-0 mb-1" style="width:40px">
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
                                        '<button type="button" class="btn btn-sm btn-danger text-center px-0 mb-1" style="width:40px">
                                            <i class="fa fa-trash"></i>
                                        </button>',
                                        $url,
                                        [
                                            'title' => 'Delete',
                                            'data-pjax' => '0',
                                            'data' => [
                                                'confirm' => 'Are you sure to delete this User?',
                                                'method' => 'post',
                                            ]
                                        ]
                                    );
                                },
                            ],
                            'contentOptions' => [
                                'class' => 'text-center',
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
        <a href="/admin/rbac/user" class="active">User</a>
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
        <a href="/admin/rbac/menu">Menu</a>
    </div>
</div>