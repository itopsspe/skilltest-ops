<?php

use yii\widgets\DetailView;
use app\models\rbac\assignment\Assignment;

$this->params['breadcrumbs'][] = ['label' => 'Account', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="card col-md-12 mb-5 px-0">
    <div class="card-body row">
        <div class="col-md-12 px-0 overflow-auto">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'label' => 'Name',
                        'captionOptions' => [
                            'class' => 'align-top'
                        ],
                        'value' => $model->name,
                    ],
                    [
                        'label' => 'Username',
                        'captionOptions' => [
                            'class' => 'align-top'
                        ],
                        'value' => $model->username,
                    ],
                    [
                        'label' => 'Email',
                        'captionOptions' => [
                            'class' => 'align-top'
                        ],
                        'value' => $model->email,
                    ],
                    [
                        'label' => 'Status',
                        'captionOptions' => [
                            'class' => 'align-top'
                        ],
                        'value' => ucfirst($model->status),
                    ],
                    [
                        'label' => 'Role',
                        'captionOptions' => [
                            'class' => 'align-top'
                        ],
                        'format' => 'raw',
                        'value' => function($data) {
                            $assignment = Assignment::find()->where(['user_id' => $data->id])->all();

                            if ($assignment) { 
                                $return = '';

                                foreach($assignment as $role) {
                                    $return .= '<span class="badge badge-primary font-12 mr-1">'.$role->item_name.'</span>';
                                }

                                return $return;
                            } else {
                                return '-';
                            }
                        }
                    ],
                    [
                        'label' => 'Last Login',
                        'captionOptions' => [
                            'class' => 'align-top'
                        ],
                        'value' => $model->last_login_datetime,
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>