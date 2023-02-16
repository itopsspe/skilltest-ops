<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\assets\LoginAsset;

LoginAsset::register($this);

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

<div class="home-btn d-none d-sm-block rounded-circle text-center pt-3">
    <a href="/"><h3><i class="fa fa-home"></i></h3></a>
</div>

<div class="main-background"></div>

<div class="wrapper-page left-panel">
    <div class="card">
        <div class="card-body">
            <div class="text-center my-3">
                <a href="/" class="logo">
                    <?= Html::img('@web/images/layouts/login/logo.svg?drac='.strtotime(date('Y-m-d H:i:s')), ['class' => 'col-10', 'alt' => 'DRAC']) ?>
                </a>
            </div>

            <div class="p-3">
                <?php if (Yii::$app->session->hasFlash('password-changed')) { ?>
                    <div class="alert alert-success fade show text-center" role="alert">
                        <strong>Success!</strong> <?= Yii::$app->session->getFlash('password-changed') ?>
                    </div>
                <?php } else { ?>
                    <h5 class="text-white text-center pt-3">Welcome Back !</h5>
                    <p class="text-white text-center mb-2">Sign in to continue.</p>
                <?php } ?>

                <?php $form = ActiveForm::begin([
                    'method' => 'POST',
                    'enableAjaxValidation' => true
                ]); ?>

                    <div class="text-input-wrapper mb-4">
                        <?= $form->field($model, 'email')->textInput([
                            'placeholder' => 'Email',
                            'autocomplete' => 'off'
                        ]) ?>
                    </div>

                    <div class="text-input-wrapper mb-5">
                        <?= $form->field($model, 'password')->passwordInput([
                            'placeholder' => 'Password',
                            'autocomplete' => 'off'
                        ]) ?>
                    </div>

                    <div class="form-group row mt-5 mb-5">
                        <div class="col-sm-6">
                            <div class="custom-checkbox">
                                <?= $form->field($model, 'rememberMe')->checkbox([
                                    'template' => "<div>{input} {label}</div>",
                                ]) ?>
                            </div>
                        </div>
                        <div class="col-sm-6 text-right">
                            <button class="btn col-md-10 text-uppercase" type="submit"><?= Yii::t('app', 'login') ?></button>
                        </div>
                    </div>

                    <div class="form-group row forgot-link">
                        <div class="col-12 text-center text-white">
                            <a href="/forgot-password"><i class="fa fa-lock"></i> <?= Yii::t('app', 'forgot password') ?>?</a>
                        </div>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>

        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
