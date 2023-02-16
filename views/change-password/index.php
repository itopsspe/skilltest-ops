<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\assets\ForgotPasswordAsset;

ForgotPasswordAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    
    <link rel="apple-touch-icon" sizes="57x57" href="<?= Url::to('@web/favicon/apple-icon-57x57.png') ?>">
	<link rel="apple-touch-icon" sizes="60x60" href="<?= Url::to('@web/favicon/apple-icon-60x60.png') ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?= Url::to('@web/favicon/apple-icon-72x72.png') ?>">
	<link rel="apple-touch-icon" sizes="76x76" href="<?= Url::to('@web/favicon/apple-icon-76x76.png') ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?= Url::to('@web/favicon/apple-icon-114x114.png') ?>">
	<link rel="apple-touch-icon" sizes="120x120" href="<?= Url::to('@web/favicon/apple-icon-120x120.png') ?>">
	<link rel="apple-touch-icon" sizes="144x144" href="<?= Url::to('@web/favicon/apple-icon-144x144.png') ?>">
	<link rel="apple-touch-icon" sizes="152x152" href="<?= Url::to('@web/favicon/apple-icon-152x152.png') ?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?= Url::to('@web/favicon/apple-icon-180x180.png') ?>">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?= Url::to('@web/favicon/android-icon-192x192.png') ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= Url::to('@web/favicon/favicon-32x32.png') ?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?= Url::to('@web/favicon/favicon-96x96.png') ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= Url::to('@web/favicon/favicon-16x16.png') ?>">
	<link rel="manifest" href="<?= Url::to('@web/favicon/manifest.json') ?>">
	<meta name="msapplication-TileColor" content="#FFFFFF">
	<meta name="msapplication-TileImage" content="<?= Url::to('@web/favicon/ms-icon-144x144.png') ?>">
    <meta name="theme-color" content="#FFFFFF">
    
    <title><?= Yii::$app->params['application_name'] ?> | <?= Html::encode($this->title) ?></title>

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<div class="main-background">
    <div class="row">
        <div class="main-panel offset-md-4 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mt-3 mb-3">
                        <a href="/" class="logo">
                            <?= Html::img('@web/images/layouts/login/logo.svg?drac='.strtotime(date('Y-m-d H:i:s')), ['class' => 'col-10', 'alt' => 'DRAC']) ?>
                        </a>
                    </div>

                    <div class="px-3">
                        <h5 class="text-white text-center pt-3"></h5>
                        <p class="text-white text-center mb-4">Enter your email and we'll send you a link to get back into your account.</p>

                        <?php $form = ActiveForm::begin([
                            'method' => 'POST',
                            'enableAjaxValidation' => true
                        ]); ?>

                            <div class="text-input-wrapper mb-4">
                                <?= $form->field($model, 'password')->passwordInput([
                                    'placeholder' => 'New Password',
                                    'autocomplete' => 'off'
                                ])->label() ?>
                            </div>

                            <div class="text-input-wrapper mb-5">
                                <?= $form->field($model, 'confirm_password')->passwordInput([
                                    'placeholder' => 'Confirm Password',
                                    'autocomplete' => 'off'
                                ])->label() ?>
                            </div>

                            <div class="form-group row mb-5">
                                <div class="col-sm-12 text-right">
                                    <button class="btn col-md-12 font-bold text-uppercase" type="submit"><?= Yii::t('app', 'submit') ?></button>
                                </div>
                            </div>

                            <div class="form-group row forgot-link">
                                <div class="col-12 text-white text-uppercase text-center font-bold">
                                    <a href="/login"><?= Yii::t('app/message', 'back to login') ?></a>
                                </div>
                            </div>

                        <?php ActiveForm::end(); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
