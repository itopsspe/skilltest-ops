<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->name;

$this->params['breadcrumbs'][] = ['label' => Yii::t('interface', 'rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="auth-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('interface', 'update'), ['update', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
        
        <?= Html::a(Yii::t('interface', 'delete'), ['delete', 'id' => $model->name], [
            'class' => 'btn btn-danger',
            'data-confirm' => Yii::t('app/message', 'Are you sure to delete this item?'),
            'data-method' => 'post',
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'className',
        ],
    ]) ?>
</div>