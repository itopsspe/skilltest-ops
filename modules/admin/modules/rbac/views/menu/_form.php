<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveForm;
use app\assets\rbac\RBACAutoComplete;
use app\models\rbac\Menu;

RBACAutocomplete::register($this);

$opts = Json::htmlEncode([
    'menus'     => Menu::getMenuSource(),
    'routes'    => Menu::getSavedRoutes(),
]);

$this->registerJs("var _opts = $opts;");

$this->registerJs($this->render('_script.js'));

$this->registerCssFile("@web/vendor/bootstrap-iconpicker-1.10.0/dist/css/bootstrap-iconpicker.min.css", [
    'depends' => [app\assets\AdminLimitlessAsset::className()],
]);

$this->registerJsFile("@web/vendor/bootstrap-iconpicker-1.10.0/dist/js/bootstrap-iconpicker.bundle.min.js", [
    'depends' => [app\assets\AdminLimitlessAsset::className()],
]);

$css = <<<CSS
.icon-selector-button {
    border: 2px solid #bbb;
    background: #fff;
    color: #999;
    border-radius: 8px;
}
CSS;

$this->registerCss($css);

$js = <<<JS
$(document).ready(function() {
    $('#drac-icon-selector').on('change', function(drac) {
        $('#menu-icon').val(drac.icon);
    });
});
JS;

$this->registerJs($js);

?>

<?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <?= Html::activeHiddenInput($model, 'parent', ['id' => 'parent_id']); ?>
        
        <div class="col-md-6 text-input-wrapper">
            <?= $form->field($model, 'name')->textInput(['maxlength' => 128, 'autocomplete' => 'off']) ?>
        </div>
        
        <div class="col-md-6 text-input-wrapper">
            <?= $form->field($model, 'parent_name')->textInput(['id' => 'parent_name'])->label(Yii::t('app', 'parent')) ?>
        </div>
        
        <div class="col-md-12 text-input-wrapper"> 
            <?= $form->field($model, 'route')->textInput(['id' => 'route']) ?>
        </div>
        
        <div class="col-md-6 text-input-wrapper">
            <?= $form->field($model, 'order')->input('number')->label(Yii::t('app', 'order')) ?>
        </div>

        <div class="col-md-6 text-input-wrapper">
            <label>Icon</label>
            <button id="drac-icon-selector" class="btn btn-lg btn-block icon-selector-button" data-iconset="glyphicon|ionicon|fontawesome5" data-icon="<?= $model->icon ? $model->icon : 'fab fa-squarespace' ?>" data-rows="3" data-cols="8" data-footer="true" role="iconpicker"></button>
        </div>
        
        <div class="col-md-12 display-none">
            <?= $form->field($model, 'icon')->hiddenInput()->label(false) ?>
        </div>
        
        <div class="col-md-12 mt-3">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'save') : Yii::t('app', 'update'), ['class' => 'btn btn-lg btn-block btn-primary']) ?>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>
