<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<div class="container py-5 mt-2">
	<div class="row">
		<div class="col-md-12 text-center">
			<img src="/images/error/drac-gears.svg" class="col-md-4" alt="DRAC" />

			<h1 class="font-100 font-bold px-5 my-0"><?= $exception->statusCode ?></h1>
			<h4 class="font-28 font-bold px-5 my-0 mb-1"><?= $exception->getName() ?></h4>
			<p class="font-18 px-3 m-0">
				<?= $exception->getMessage() ?>
			</p>
			<a href="/" class="drac-button col-md-2 offset-md-5">Go Home</a>
		</div>
	</div>
</div>