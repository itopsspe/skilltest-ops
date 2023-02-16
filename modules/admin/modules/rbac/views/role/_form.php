<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveForm;
use app\assets\rbac\RBACAutoComplete;
use app\components\rbac\Configs;
use app\components\rbac\RouteRule;

$rules = Configs::authManager()->getRules();

unset($rules[RouteRule::RULE_NAME]);

$source = Json::htmlEncode(array_keys($rules));

$js = <<<JS
    $('#rule_name').autocomplete({
        source: $source,
    });
JS;

RBACAutoComplete::register($this);

$this->registerJs($js);

?>

<?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6 text-input-wrapper">
            <?= $form->field($model, 'name')->textInput(['maxlength' => 64, 'placeholder' => Yii::t('app', 'name')]) ?>
        </div>

        <div class="col-md-6 text-input-wrapper">
            <?= $form->field($model, 'description')->textInput(['rows' => 4, 'placeholder' => Yii::t('app', 'description')]) ?>
        </div>
        
        <div class="col-md-12 mt-3">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'save') : Yii::t('app', 'update') , ['class' => 'btn btn-lg btn-block btn-primary']) ?>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>