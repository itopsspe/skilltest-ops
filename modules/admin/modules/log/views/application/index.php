<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap4\Modal;

$this->params['breadcrumbs'][] = ['label' => 'Log', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$css = <<<CSS
.modal-dialog {
    margin-top: 100px;
}
CSS;

$this->registerCss($css);

Modal::begin([
    'id' => 'log-modal',
    'size' => 'modal-lg',
]);

echo "<div id='log-content' style='max-height:400px;overflow-y:scroll'></div>";

Modal::end();

?>

<div class="card col-md-12 mb-5 px-0">
    <div class="card-body row">
        <div class="col-md-12 px-0 overflow-auto">
            <?php Pjax::begin(); ?>
                <?php
                    $js = "
                    $(document).ready(function ($) {
                        $('.log-trigger').on('click', function (event) {
                            event.preventDefault();
                            $('#log-modal').modal('show').find('#log-content').load($(this).attr('href'));
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
                                'class' => 'text-center text-uppercase font-12',
                                'style' => 'min-width:100px;width:100px'
                            ],
                            'attribute' => 'level',
                            'filterInputOptions' => [
                                'class' => 'text-center form-control font-11'
                            ],
                            'contentOptions' => [
                                'class' => 'font-11'
                            ],
                            'value' => function($model) {
                                switch ($model->level) {
                                    case 1:
                                        $level = "Error";
                                        break;
                                    case 2:
                                        $level = "Warning";
                                        break;
                                    case 4:
                                        $level = "Info";
                                        break;
                                    case 8:
                                        $level = "Trace";
                                        break;
                                    case 64:
                                        $level = "Profile";
                                        break;
                                    case 80:
                                        $level = "Profile Begin";
                                        break;
                                    case 96:
                                        $level = "Profile End";
                                        break;
                                    default:
                                        $level = "Unknow";
                                }

                                return $level;
                            }
                        ],
                        [
                            'headerOptions' => [
                                'class' => 'text-center text-uppercase font-12',
                                'style' => 'min-width:280px;width:280px'
                            ],
                            'attribute' => 'category',
                            'filterInputOptions' => [
                                'class' => 'text-center form-control font-11',
                                'placeholder' => 'Category'
                            ],
                            'contentOptions' => [
                                'class' => 'font-11'
                            ],
                        ],
                        [
                            'headerOptions' => [
                                'class' => 'text-center text-uppercase font-12',
                            ],
                            'attribute' => 'prefix',
                            'filterInputOptions' => [
                                'class' => 'text-center form-control font-11',
                                'placeholder' => 'Prefix'
                            ],
                            'contentOptions' => [
                                'class' => 'font-11'
                            ],
                        ],
                        [
                            'headerOptions' => [
                                'class' => 'text-center text-uppercase font-12',
                                'style' => 'min-width:110px;width:110px'
                            ],
                            'attribute' => 'created_at',
                            'label' => 'Date',
                            'filterInputOptions' => [
                                'class' => 'text-center form-control font-11',
                                'placeholder' => 'Date'
                            ],
                            'contentOptions' => [
                                'class' => 'font-11 text-center'
                            ],
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => [
                                'class' => 'text-center text-uppercase',
                                'style' => 'min-width:65px;max-width:65px;width:65px'
                            ],
                            'header' => '#',
                            'template' => '{detail}',
                            'buttons' => [
                                'detail' => function($url, $data) {
                                    return Html::a(
                                        '<button type="button" class="btn btn-sm btn-primary text-center px-0" style="width:40px">
                                            <i class="fa fa-eye"></i>
                                        </button>',
                                        $url,
                                        [
                                            'title' => 'View',
                                            'class' => 'log-trigger',
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