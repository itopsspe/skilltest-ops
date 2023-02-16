<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6 text-input-wrapper">
            <?= $form->field($model, 'name')->textInput() ?>
        </div>
        
        <div class="col-md-6 text-input-wrapper">
            <?= $form->field($model, 'username')->textInput() ?>
        </div>
        
        <div class="col-md-6 text-input-wrapper"> 
            <?= $form->field($model, 'email')->textInput() ?>
        </div>
        
        <div class="col-md-6 text-input-wrapper">
            <?= $form->field($model, 'status')->dropDownList(['active' => 'Active', 'inactive' => 'Inactive', 'blocked' => 'Blocked'], [
                'prompt'=>'- '.Yii::t('app', 'status').' -'
            ]); ?>
        </div>

        <div class="col-md-6 text-input-wrapper">
            <?= $form->field($model, 'new_password')->passwordInput() ?>
        </div>

        <div class="col-md-6 text-input-wrapper">
            <?= $form->field($model, 'confirm_password')->passwordInput() ?>
        </div>
        
        <div class="col-md-12 mt-3">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'save') : Yii::t('app', 'update'), ['class' => 'btn btn-lg btn-block btn-primary']) ?>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>
