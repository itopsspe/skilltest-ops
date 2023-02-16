<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

use yii\helpers\Html;

$this->title = Yii::t('interface', 'create rule');

$this->params['breadcrumbs'][] = ['label' => Yii::t('interface', 'rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="auth-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
