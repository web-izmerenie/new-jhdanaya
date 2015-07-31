<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Такой страницы нет");
?>
<div class="image"><img src="/img/error.png" alt="" /></div>
<div class="text-1">Ошибка 404</div>
<div class="text-2">Введен неверный адрес, или такой страницы больше нет.</div>
<div class="back"><a href="/" class="btn-type-1">Вернуться на главную</a></div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>