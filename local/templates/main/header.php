<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<?
global $wrapper_class;
$wrapper_class = '';
if(defined('company')){
    $wrapper_class = 'company-wrapper';
}
if(defined('vacancies')){
    $wrapper_class = 'vacancies-wrapper';
}
if(defined('charity')){
    $wrapper_class = 'charity-wrapper';
}
if(defined('shops')){
    $wrapper_class = 'salons-wrapper';
}
if(defined('products')){
    $wrapper_class = 'product-wrapper';
}
if(defined('card_product')){
    $wrapper_class = 'product-card-wrapper';
}
if(defined('ERROR_404')){
    $wrapper_class = 'error-wrapper';
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie10 lt-ie9 lt-ie8 ie7"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie10 lt-ie9 ie8"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10 ie9"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
<head lang="ru-RU">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?$APPLICATION->ShowHead();?>
    <title><?$APPLICATION->ShowTitle();?></title>
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <meta name="description" content="">
    <meta name="format-detection" content="telephone=no">
    <?$APPLICATION->SetAdditionalCSS(SITE_DIR.'css/main.css')?>
    <?$APPLICATION->SetAdditionalCSS(SITE_DIR.'css/jquery.fancybox.css')?>
    <?$APPLICATION->SetAdditionalCSS(SITE_DIR.'css/jquery.selectbox.css')?>
</head>
<?global $USER;?>
<body <?=($USER->IsAdmin() ? 'class="admin-mode"' : NULL)?>>
    <?$APPLICATION->ShowPanel();?>
	<?/*<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk/debug.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>*/?>
		<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '433636456822472',
      xfbml      : true,
      version    : 'v2.4'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/ru_RU/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
    <div class="page <?=(defined('index') ? 'main-page' : 'inside-page')?>">
        <header class="header">
            <div class="logo">
                <a <?=(defined('index') ? 'id="logo1"' : 'href="'.SITE_DIR.'" id="logo"')?>
									onclick="yaCounter26647785.reachGoal('LOGO'); return true;"></a>
            </div>
            <?if(!defined('ERROR_404')){?>
            <nav>
                <div class="wrapper">
                    <a <?=(defined('index') ? '' : 'href="'.SITE_DIR.'"')?> id="logo-nav"></a>
                </div>
                <?$APPLICATION->IncludeComponent("bitrix:menu", "", Array(
                        "ROOT_MENU_TYPE" => "top",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => array(""),
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "left",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N"
                    )
                );
                ?>
				<?if(defined('shops')){?>
					<?$APPLICATION->IncludeComponent("bitrix:news.list", "shops_nav", array(
						"IBLOCK_TYPE" => "danaya",
						"IBLOCK_ID" => "1",
						"NEWS_COUNT" => "20",
						"SORT_BY1" => "SORT",
						"SORT_ORDER1" => "ASC",
						"SORT_BY2" => "NAME",
						"SORT_ORDER2" => "ASC",
						"FILTER_NAME" => "",
						"FIELD_CODE" => array(
							0 => "",
							1 => "",
						),
						"PROPERTY_CODE" => array(
							0 => "COORD",
							1 => "",
						),
						"CHECK_DATES" => "Y",
						"DETAIL_URL" => "",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "36000000",
						"CACHE_FILTER" => "N",
						"CACHE_GROUPS" => "Y",
						"PREVIEW_TRUNCATE_LEN" => "",
						"ACTIVE_DATE_FORMAT" => "d.m.Y",
						"SET_TITLE" => "N",
						"SET_BROWSER_TITLE" => "N",
						"SET_META_KEYWORDS" => "N",
						"SET_META_DESCRIPTION" => "N",
						"SET_STATUS_404" => "N",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"ADD_SECTIONS_CHAIN" => "N",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"PARENT_SECTION" => "",
						"PARENT_SECTION_CODE" => "",
						"INCLUDE_SUBSECTIONS" => "Y",
						"DISPLAY_DATE" => "Y",
						"DISPLAY_NAME" => "Y",
						"DISPLAY_PICTURE" => "Y",
						"DISPLAY_PREVIEW_TEXT" => "Y",
						"PAGER_TEMPLATE" => ".default",
						"DISPLAY_TOP_PAGER" => "N",
						"DISPLAY_BOTTOM_PAGER" => "N",
						"PAGER_TITLE" => "Новости",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"AJAX_OPTION_ADDITIONAL" => ""
						), false
					);
					?>
				<?}else{?>
					<?$APPLICATION->IncludeComponent("bitrix:menu", "submenu", Array(
							"ROOT_MENU_TYPE" => "left",
							"MENU_CACHE_TYPE" => "N",
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => array(""),
							"MAX_LEVEL" => "1",
							"CHILD_MENU_TYPE" => "left",
							"USE_EXT" => "Y",
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N"
						)
					);
					?>
				<?}?>
            </nav>
            <?}?>
        </header>
        <?if($wrapper_class == 'error-wrapper'){?>
            <div class="error-wrapper">
	    	<div class="error-wrapper-inr">
        <?}else if($wrapper_class != 'product-card-wrapper'){?>
            <div class="<?=$wrapper_class?>">
                <?if($wrapper_class == 'salons-wrapper'){?>
                    <div id="map-container"></div>
                    <div class="wrapper map-balloon">
                <?}else{?>
                    <div class="wrapper">
                <?}?>
        <?}?>
