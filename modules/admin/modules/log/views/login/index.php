<?php

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
                            'filter' => false,
                            'contentOptions' => [
                                'class' => 'font-11'
                            ],
                        ],
                        [
                            'headerOptions' => [
                                'class' => 'text-center text-uppercase font-12',
                                'style' => 'min-width:130px;width:130px'
                            ],
                            'attribute' => 'last_login',
                            'filter' => false,
                            'contentOptions' => [
                                'class' => 'font-11 text-center'
                            ],
                            'value' => function($model) {
                                if ($model->last_login_datetime != NULL) {
                                    return $model->last_login_datetime;
                                } else {
                                    return '-';
                                }
                            }
                        ],
                    ],
                ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>