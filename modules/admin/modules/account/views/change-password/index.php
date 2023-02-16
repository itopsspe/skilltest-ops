<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = ['label' => 'Account', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="card col-md-12 mb-5 px-0">
    <div class="card-body">
        <?php if (Yii::$app->session->hasFlash('password-changed')) { ?>
            <div class="alert alert-success fade show text-center" role="alert">
                <strong>Success!</strong> <?= Yii::$app->session->getFlash('password-changed') ?>
            </div>
        <?php } ?>

        <?php $form = ActiveForm::begin([
            'method' => 'POST',
            'enableAjaxValidation' => true
        ]); ?>

            <div class="row">
                <div class="col-md-12 text-input-wrapper">
                    <?= $form->field($model, 'current_password')->passwordInput() ?>
                </div>
                
                <div class="col-md-6 text-input-wrapper">
                    <?= $form->field($model, 'new_password')->passwordInput() ?>
                </div>
                
                <div class="col-md-6 text-input-wrapper"> 
                    <?= $form->field($model, 'confirm_password')->passwordInput() ?>
                </div>
                
                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'save'), ['class' => 'btn btn-lg btn-block btn-primary']) ?>
                    </div>
                </div>
            </div>
            
        <?php ActiveForm::end(); ?>
    </div>
</div>
