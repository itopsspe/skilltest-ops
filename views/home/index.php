<?php

$this->registerCssFile("@web/css/page/home.css", [
    'depends' => [\app\assets\MainAsset::className()],
], 'css-print-theme');

?>

<div class="container-fluid">
	<section class="row section-banner">
        <div class="col-md-12 text-center">
            <img src="/images/home/logo.svg" alt="DRAC" class="col-6" />
        </div>
    </section>
</div>