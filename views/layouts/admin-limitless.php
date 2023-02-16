<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

if (Yii::$app->user->isGuest) {
    return Yii::$app->controller->redirect('/');
}

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\Breadcrumbs;
use app\widgets\LimitlessMenu;
use app\widgets\LimitlessRBACMenu;
use app\assets\AdminLimitlessAsset;

AdminLimitlessAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>

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

<body class="navbar-top">
<?php $this->beginBody() ?>
	<div class="navbar navbar-expand-md navbar-static fixed-top">
		<div class="navbar-header navbar-config d-none d-md-flex align-items-md-center">
			<div class="navbar-brand navbar-brand-md text-center">
				<a href="/" class="d-inline-block">
					<img src="/images/layouts/limitless/logo.svg" alt="DRAC">
				</a>
			</div>
			
			<div class="navbar-brand navbar-brand-xs text-center">
				<a href="/" class="d-inline-block">
					<img src="/images/layouts/limitless/icon.svg" alt="DRAC">
				</a>
			</div>

			<a class="navbar-collapse-switch sidebar-control sidebar-main-toggle">
				<i class="fas fa-align-left"></i>
			</a>
		</div>
		
		<div class="d-flex flex-1 d-md-none">
			<div class="navbar-brand mr-auto">
				<a href="/" class="d-inline-block">
					<img src="/images/layouts/limitless/logo.svg" alt="DRAC">
				</a>
			</div>

			<button class="navbar-toggler sidebar-mobile-main-toggle text-white" type="button">
				<i class="fas fa-align-right"></i>
			</button>
		</div>
	</div>

	<div class="page-content">
		<div class="sidebar sidebar-dark sidebar-main sidebar-fixed sidebar-expand-md">
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-main-toggle">
					<i class="far fa-angle-left"></i>
				</a>
				
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div>
			
			<div class="sidebar-content">
				<div class="sidebar-user-material">
					<div class="sidebar-user-material-body">
						<div class="card-body text-center">
							<a href="#">
								<?php
									$profile_picture = 'images/layouts/limitless/default-user.svg';
								?>

								<img src="/<?= $profile_picture ?>" class="img-fluid rounded-circle shadow-1 mb-3" width="80" height="80" alt="">
							</a>

							<?php
								$count_name = str_word_count(Yii::$app->user->identity->name);

								if ($count_name >= 3) {
									$trim_name = trim(Yii::$app->user->identity->name);

									$array_name = explode(' ', $trim_name);

									$material_name = $array_name[0].' '.$array_name[1];
								} else {
									$material_name = Yii::$app->user->identity->name;
								}
							?>

							<h6 class="mb-0 text-white text-shadow-dark"><strong><?= $material_name ?></strong></h6>
							<span class="font-size-xs text-white text-shadow-dark">Engineer</span>
						</div>
													
						<div class="sidebar-user-material-footer">
							<a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse"><span>Account</span></a>
						</div>
					</div>

					<div class="collapse" id="user-nav">
						<ul class="nav nav-sidebar">
							<li class="nav-item">
								<a href="/admin/account/profile" class="nav-link">
									<i class="fas fa-user-cog"></i>
									<span>Profile</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="/admin/account/change-password" class="nav-link">
									<i class="fas fa-key"></i>
									<span>Change Password</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="/logout" class="nav-link">
									<i class="fas fa-sign-out"></i>
									<span>Logout</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
				
				<div class="card card-sidebar-mobile">
					<?php
						$callback = function($menu) {
							return [
								'label' => $menu['name'],
								'icon'  => $menu['icon'],
								'url'   => [$menu['route']],
								'items' => $menu['children'],
								'data'	=> json_decode($menu['data'], true)
							];
						};
						
						$items = LimitlessRBACMenu::getAssignedMenu(Yii::$app->user->id, null, $callback, true);
					?>
						
					<?= LimitlessMenu::widget([
						'options'	=> ['class' => 'nav nav-sidebar', 'data-nav-type' => 'accordion'],
						'items'		=> $items
					]) ?>
				</div>
			</div>
		</div>

		<div class="content-wrapper">
			<div class="page-header">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<?= Breadcrumbs::widget([
							'homeLink' 	=> ['label' => Yii::$app->params['application_name'], 'url' => ['/admin/']],
							'links' 	=> isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
						]) ?>
					</div>
				</div>
			</div>
			
			<div class="content pt-0 px-4">
				<div class="row">
					<?= $content ?>
				</div>
			</div>
			
			<div class="navbar navbar-expand-lg navbar-light">
				<div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy; 1994 - <?= date('Y') ?>. <a href="#">Yii2 Base Basic</a> by <a href="https://www.davidrivaldy.id" target="_blank">DRAC</a>
					</span>
				</div>
			</div>
		</div>
	</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>