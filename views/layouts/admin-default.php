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
use app\widgets\DefaultMenu;
use app\widgets\DefaultRBACMenu;
use app\assets\AdminDefaultAsset;

AdminDefaultAsset::register($this);

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

    <title>SPE | <?= Html::encode($this->title) ?></title>
    
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <?php $this->head() ?>
</head>

<body class="hold-transition drac-skin fixed sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">
    <header class="main-header">
        <a href="/" class="logo">
            <span class="logo-mini"><?= Html::img('@web/images/layouts/default/icon.png', ['height' => '40', 'alt' => 'DRAC']) ?></span>
            <span class="logo-lg"><?= Html::img('@web/images/layouts/default/logo.png', ['height' => '40', 'alt' => 'DRAC']) ?></span>
        </a>

        <nav class="navbar navbar-static-top" role="navigation">
            <a href="javascript:;" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <?php
                        $current_time = date("G");

                        if ($current_time < "12") {
                            $greeting = Yii::t('app/message', 'good morning');
                        } else if ($current_time >= "12" && $current_time < "17") {
                            $greeting = Yii::t('app/message', 'good afternoon');
                        } else if ($current_time >= "17" && $current_time < "19") {
                            $greeting = Yii::t('app/message', 'good evening');
                        } else if ($current_time >= "19") {
                            $greeting = Yii::t('app/message', 'good night');
                        }

                        $greeting_name = $greeting.", ".ucfirst(strtolower(Yii::$app->user->identity->username));

                        $profile_picture_available = Yii::$app->user->identity->profile_picture ? Yii::$app->user->identity->profile_picture : 'images/layouts/default/default-user.svg';

                        if (Yii::$app->user->identity->profile_picture) {
                            if (file_exists(Yii::getAlias('@app/web/').$profile_picture_available)) {
                                $profile_picture = $profile_picture_available;
                            } else {
                                $profile_picture = 'images/layouts/default/default-user.svg';
                            }
                        } else {
                            $profile_picture = $profile_picture_available;
                        }
                        ?>

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="line-height: 40px">
                            <span class="hidden-xs"><?= $greeting_name.'!' ?></span>
                            
                            <?= Html::img('@web/'.$profile_picture.'?drac='.strtotime(date('Y-m-d H:i:s')), ['class' => 'user-image', 'alt' => Yii::$app->user->identity->name]) ?>
                        </a>

                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <?= Html::img('@web/images/layouts/default/default-user.svg?drac='.strtotime(date('Y-m-d H:i:s')), ['class' => 'img-circle', 'alt' => Yii::$app->user->identity->name]) ?>

                                <p>
                                    <?= Yii::$app->user->identity->name ?>
                                </p>
                            </li>
                            
                            <li class="user-footer">
                                <div class="pull-left">
                                    <?= Html::a('Profile', ['/profile'], ['class' => 'btn btn-default btn-flat']) ?>
                                </div>

                                <div class="pull-right">
                                    <?= Html::a('Logout', ['/logout'], ['class' => 'btn btn-default btn-flat']) ?>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    
    <aside class="main-sidebar">
		<section class="sidebar">
			<?php
				$callback = function($menu) {
					return [
						'label' => $menu['name'],
						'icon'  => $menu['icon'],
						'url'   => [$menu['route']],
						'items' => $menu['children'],
					];
				};
				
                $items = DefaultRBACMenu::getAssignedMenu(Yii::$app->user->id, null, $callback, true);
                
				echo DefaultMenu::widget([
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                    'items' => $items
                ])
            ?>
		</section>
	</aside>

    <div class="content-wrapper">
        <section class="content-header" style="padding-top:30px">
			<div class="col-md-12 text-right text-bold letter-spacing-1 font-12">
				<?= Breadcrumbs::widget([
					'homeLink' 	=> ['label' => Yii::$app->params['application_name'], 'url' => ['/']],
					'links' 	=> isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
				]) ?>
			</div>
        </section>

        <section class="content container-fluid">
            <?= $content ?>
        </section>
    </div>

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            DRAC
        </div>

        <strong>Copyright &copy; <?= date('Y') ?> <a href="#">DRAC</a>.</strong> All rights reserved.
    </footer>
    
    <div class="control-sidebar-bg"></div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>