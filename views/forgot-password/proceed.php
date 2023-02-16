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
        <div class="offset-md-2 col-md-8 text-white p-5 text-center" style="background-color: rgba(6, 18, 43, 0.8);margin-top:130px">
            <h1 class="font-100 text-success"><i class="fa fa-check"></i></h1>
            <h2 class="mb-4">You have requested to reset your password</h2>
            <h6>Please check your email to reset your password.</h6>
            <h6 class="mt-5 text-uppercase"><a ctyle="color:inherit" href="/">Back to Home</a></h6>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
