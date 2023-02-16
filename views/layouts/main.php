<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\MainAsset;

MainAsset::register($this);

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

    <title><?= Yii::$app->params['application_name'] ?> <?= $this->title ? '|' : '' ?> <?= Html::encode($this->title) ?></title>

	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<nav class="navbar navbar-expand-lg fixed-top">
	<a class="navbar-brand text-white py-2" href="/">
		<?= Html::img('@web/images/layouts/main/logo.svg?drac='.strtotime(date('Y-m-d H:i:s')), ['alt' => 'Logo', 'height' => '45']) ?>
	</a>

	<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbar-trigger" aria-controls="navbar-trigger" aria-expanded="false" aria-label="Toggle navigation">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbar-trigger">
		<ul class="navbar-nav navbar-anchor ml-auto">
			<li class="nav-item"><a href="/" class="nav-link nav-link-large text-uppercase"><?= Yii::t('app', 'home') ?></a></li>
			<li class="nav-item"><a href="/login" class="nav-link nav-link-large text-uppercase"><?= Yii::t('app', 'login') ?></a></li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="/language/en" id="language-list" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<img src="/images/language/<?= Yii::$app->language ?>.png" width="25px" style="margin-top:-5px" alt="<?= Yii::$app->language == 'en' ? 'English' : 'Indonesia' ?>" />
				</a>
				<div class="dropdown-menu" aria-labelledby="language-list" style="min-width:5px !important">
					<a class="dropdown-item" href="/language/en"><img src="/images/language/en.png" width="25px" alt="English" /> English</a>
					<a class="dropdown-item" href="/language/id"><img src="/images/language/id.png" width="25px" alt="Indonesia" /> Indonesia</a>
				</div>
			</li>
		</ul>
	</div>
</nav>

<div class="main-content">
    <?= $content ?>
</div>

<footer class="site-footer">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<p class="copyright-text">
					Copyright &copy; <?= date("Y") ?> All Rights Reserved by <a href="https://www.davidrivaldy.id">DRAC</a>.
				</p>
			</div>

			<div class="col-md-12">
				<ul class="social-icons">
					<li><a class="instagram" href="https://www.instagram.com/davidrivaldy" target="_blank"><i class="fab fa-instagram"></i></a></li>
					<li><a class="facebook" href="https://www.facebook.com/davidXrivaldy" target="_blank"><i class="fab fa-facebook-square"></i></i></a></li>
					<li><a class="twitter" href="https://twitter.com/_davidrivaldy" target="_blank"><i class="fab fa-twitter"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>