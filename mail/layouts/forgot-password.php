<?php

use yii\helpers\Html;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <style type="text/css">
        /* ===== Normalize for Outlook & Hotmail ===== */
        .ExternalClass {
            width: 100%;
        }
        
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: 100%;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0 !important;
            padding: 0 !important;
            -webkit-text-size-adjust: 100% !important;
            -ms-text-size-adjust: 100% !important;
            -webkit-font-smoothing: antialiased !important;
        }
    </style>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    
    <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
        <tr>
            <td align="center" valign="top">
                <table border="0" cellpadding="0" cellspacing="0" width="600">
                    <tr>
                        <td align="center" valign="center" style="background-color:#0C2043;padding:50px 20px">
                            <img src="<?= Yii::$app->params['url_assets'] ?>/images/mail/logo.png" width="200px" alt="DRAC" />
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="center" style="background-color:#DD013F;color:inherit;color:#fff;text-decoration:none;padding:15px;letter-spacing:2px;font-size:15px;font-weight:bold">
                            b a s e - b a s i c  . d a v i d r i v a l d y . i d
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="center" style="background-color:#ccc;padding:40px 25px 5px 25px;line-height:25px;font-size:14px">
                            Tekan tombol <span style="color:#DD013F;font-weight:bold">RESET PASSWORD</span> untuk mengganti password anda.
                            <br />
                            Jika anda tidak merasa melakukan permintaan penggantian password
                            <br />
                            abaikan email ini.
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="center" style="background-color:#ccc;font-size:15px;padding:50px 20px">                        
                            <a href="<?= Yii::$app->params['url'] ?>/change-password/<?= $key ?>" target="_blank" style="padding:20px 30px;background-color:#DC062D;color:inherit;color:#fff;text-decoration:none;letter-spacing:2px;font-weight:bold;font-size:18px;border-radius:8px">
                                RESET PASSWORD
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="center" style="background-color:#ccc;font-size:15px;padding:0 30px 50px 30px;font-size:12px;line-height:25px">                        
                            Jika anda mengalami kendala saat menekan tombol RESET PASSWORD,
                            <br />
                            silakan copy + paste link berikut pada browser anda:
                            <br />
                            <span style="font-weight:bold;color:#DD013F"><?= Yii::$app->params['url'] ?>/change-password/<?= $key ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="center" style="background-color:#0C2043;color:#fff;font-size:13px;line-height:25px;padding:30px 10px 50px 10px;letter-spacing:1px">
                            Copyright <?= date('Y') ?>. DRAC
                            <br />
                            All rights reserved
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>