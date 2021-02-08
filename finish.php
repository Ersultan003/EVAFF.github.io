<?php
if (!isset($_GET['phone']) || empty($_GET['phone'])) {
    header('Location:  http://' . $_SERVER['HTTP_HOST']);
}

include_once "class.crm.php";
$settings = CRM::getLandingSettings();

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $crm = new CRM();
    $email = $crm->landingMailSend();
    die($email);
}

if (isset($_GET["refer"]) && preg_match("/brdmarket.com/i", $_GET['refer'])) {
    $content_head = "<h1><span>Поздравляем!</span> ваш заказ принят!</h1>
                    <h1>Спасибо за покупку с BRDmarket</h1>";
    $content_email = "<h3 class=\"onew\">Для получения специальных предложений оставьте адрес электронной почты</h3>";
    $content_input = "<div style='text-align: left; font-size: 23px; font-weight: 300;'><br><br><a style='text-decoration: none;' href='http://brdmarket.com/'>Продолжить покупки</a></div>";

} elseif (isset($_GET["msg"]) && preg_match("/оставляли/i", $_GET['msg'])) {

    $content_head = "<h1>Вы уже оставляли у нас заявку!!!</h1>";

} else {
    $content_head = "<h1>Спасибо<br> Ваш заказ принят!</h1>
                     <p class=\"p1\">В ближайшее время с Вами свяжется оператор для подтверждения заказа.</p>
                     <p class=\"p2\">Информация для заказа:</p>";
    $content_email = "<h2 class=\"one\">Участвуйте в Акции!</h2>
                        <p class=\"p8 onew\">Для того, чтобы принять участие в акции и следить за статусом Вашего заказа,
                            введите E-mail и нажмите <span>«Участвовать»<span>
                        </p>";
    $content_input = "";
}

$corset = '';
/*if (isset($_GET["offer"]) && preg_match("/waist/i", $_GET['offer'])) {
    $corset = "<div class='preffix_4 grid_4' style=\"background-color: #e8e8e3; padding: 5px; background-color: rgba(231, 231, 226, 0.7);\">
                <h3 style='text-align: center; font-size: 16px;'>Для того, чтобы определить размер waist-trainer надо измерить: Обхват талии, измеряется не затягивая по талии.</h3>
                <img width='290' src='http://waist-trainer-action.lendos.biz/corset.jpeg'/>
                </div>";
}*/
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv=content-type content="text/html; charset=utf-8">
    <meta name="robots" content="noindex, nofollow" />
    <meta name="viewport" content="width=300">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic" rel="stylesheet">
    <title>Ваш заказ принят!</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <?php echo isset($settings["header_code"]) && !empty($settings["header_code"]) ? $settings["header_code"] : ""; ?>
</head>
<style type='text/css'>

    html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6,
    p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn,
    em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b,
    u, i, center, dl, dt, dd, ol, fieldset, form, label, legend, table,
    caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details,
    embed, figure, figcaption, footer, header, menu, nav, output, ruby, section,
    summary, time, mark, audio, video { margin: 0; padding: 0; border: 0; outline: 0;}

    body{
        max-width: 300px;
        margin: 0 auto;
        font-size: 18px;
        font-family: 'Roboto', sans-serif;
        background-color: #fff;
        font-weight: 300;
    }

    html{
        margin: 0;
        padding: 0;
    }
    .block1{
        background: url(http://waist-trainer-action.lendos.biz/forma.png) 0% 0 no-repeat #ecd6b2;
        padding-top: 25px;
        text-align: right;
        padding-bottom: 15px;
    }
    .block1 p {
        text-align: center;
        font-size: 14px;
    }
    .block1 p {
        text-align: center;
        font-size: 14px;
    }

    .block1  h1 {
        font-size: 22px;
        color: black;
        line-height: 25px;
        margin-top: 10px;
        text-align: center;
        margin-bottom: 10px;
    }
    .block1 .p1 {
        line-height: 20px;
    }
    .block1 .p2 {
        margin-top: 15px;
    }
    .block1 .p3 {
        margin-top: 15px;
        font-weight: bold;
        font-size: 17px;
    }
    .block2 h2 {
        font-size: 23px;
        color: black;
        line-height: 25px;
        margin-top: 20px;
        text-align: center;
        margin-bottom: 10px;
    }
    .block2 .p4 {
        text-align: center;
        font-size: 15px;
        margin-bottom: 10px;
    }
    .block2 .p5 {
        text-align: center;
    }
    .block2 .p6 {
        margin-top: 5px;
        font-size: 14px;
        padding-left: 20px;
        padding-right: 20px;
        line-height: 21px;
    }
    .block2 .p7 {
        text-align: center;
        margin-top: 20px;
    }
    a.button {
        display: inline-block;
        color: #040404;
        font-weight: 700;
        text-decoration: none;
        user-select: none;
        padding: .5em 2em;
        outline: none;
        border: 1px solid;
        border-radius: 1px;
        transition: 0.2s;
        padding-left: 75px;
        padding-right: 75px;
    }
    a.button:hover { background: rgba(255,255,255,.2); }
    a.button:active { background: #040404; }

    .block3 {
        /*width: 200px;*/
        height: 235px;
        /*margin: 5px;*/
        border: #5e5e5e dashed 1px;
        background: #f5c982;
        box-shadow: 0 0 0 5px #f5c982;
        margin-top: 40px;
        margin-bottom: 40px;
    }
    .block3  h2 {
        font-size: 22px;
        color: black;
        line-height: 25px;
        margin-top: 10px;
        text-align: center;
        margin-bottom: 10px;
    }
    .block3 .p8 {
        text-align: center;
        font-size: 14px;
        padding-left: 20px;
        padding-right: 20px;
        line-height: 20px;
    }
    .block3 .p8 span {
        font-weight: bold;
    }
    input[type="email"] {
        border: 1px solid rgba(0, 0, 0, 0.3);
        border-radius: 4px;
        font-size: 13px;
        margin-bottom: 10px;
        outline: medium none;
        padding: 10px;
        width: 75%;
        margin-left: 25px;
        margin-top: 10px;
    }
    input[type="submit"] {
        background: rgb(56, 175, 25) none repeat scroll 0 0;
        border: 0 none;
        border-radius: 4px;
        box-shadow: 0 -3px rgb(48, 134, 24) inset;
        color: #fff;
        cursor: pointer;
        display: inline-block;
        font-size: 18px;
        font-weight: bold;
        margin-left: 25px;
        padding: 7px 0;
        width: 82%;

    }
    input[type="submit"]:hover { background: rgb(74, 211, 29); }
    input[type="submit"]:active {
        background: rgb(68, 192, 25);
        box-shadow: 0 3px rgb(61, 184, 27) inset;
    }
</style>
<body>
<!--noindex-->
<div class="wrapper">
    <div class="page">
        <div class="block1">
            <?php echo $content_head; ?>
            <p class="p3"><?php echo (!isset($_GET['fio']) || empty($_GET['fio']) ? "" : $_GET['fio']); ?></p>
        </div>
        <?php echo $corset; ?>
        <!-- <div class="block2">
             <h2>Возможно Вам также будет интересно!</h2>
             <p class="p4">Этот товар сегодня самый востребованный:</p>
             <p class="p5"><img src="img/lucem.png" alt=""></p>
             <p class="p6">Мечтаете о малыше? А забеременеть не получается? Lucem надежное и проверенное средство в борьбе с бесплодием.</p>
             <p class="p7"><a href="#" class="button">Посмотреть</a></p>
         </div>-->
        <?php
        if (isset($_GET["msg"]) && preg_match("/свяжется/i", $_GET['msg'])) : ?>
            <div class="block3">
                <?php echo $content_email; ?>
                <form id='bookingForm' class='booking-form' method='POST' enctype='multipart/form-data' action=''>
                    <div class='tmInput'>
                        <input name='email' class="email-b" id="email" placeHolder='Введите ваш е-mail' type='email' value=""  required='required'><br>
                        <input type='submit'  class='btn' value='Участвовать'>
                        <input type='hidden' name="fio" id="fio" value='<?php echo (!isset($_GET['fio']) || empty($_GET['fio']) ? "" : $_GET['fio']); ?>'>
                        <input type='hidden' name="offer" id="offer" value='<?php echo $_GET['offer']; ?>'>
                    </div>
                </form>
            </div>
        <?php endif;
        echo $content_input; ?>
    </div>
</div>
<!--/noindex-->
<?php echo isset($settings["footer_code"]) && !empty($settings["footer_code"]) ? $settings["footer_code"] : ""; ?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#bookingForm').submit(function(){
            var email = jQuery("input#email").val();
            var fio = jQuery("input#fio").val();
            var offer = jQuery("input#offer").val();
            var dataString = 'email=' + email + '&fio=' + fio + '&offer=' + offer;
            jQuery.ajax({
                type: "POST",
                url: "/finish.php",
                data: dataString,
                success:  function() {
                    //console.log(data);
                    jQuery('.one').hide();
                    jQuery('.onew').hide();
                    jQuery('#bookingForm').html("<div id='message'></div>");
                    jQuery('#message').html("<br><br><h2 style='color: black'>Спасибо за участие</h2>")
                        .hide()
                        .fadeIn(1500, function() {
                            $('#message').append("<i class=\"icon-ok\"></i>");
                        });
                }
            });
            return false;
        });
    });
</script>
</body>
</html>
