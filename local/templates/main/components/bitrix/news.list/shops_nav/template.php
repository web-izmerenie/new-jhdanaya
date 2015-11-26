<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<ul class="sub-nav shops-nav">
<?foreach($arResult["ITEMS"] as $key=>$arItem){?>
	<li class="<?=($key == 0 ? 'active' : NULL)?>">
		<a class="title-1 <?=($key == 0 ? 'active' : NULL)?>"
			data-map="<?=$arItem['ID']?>"
			data-point="<?=$arItem['DISPLAY_PROPERTIES']['COORD']['DISPLAY_VALUE']?>"
			onclick="yaCounter26647785.reachGoal('SHOPS_<?=$arItem['ID'];?>'); return true;">
			<?=$arItem['NAME']?>
		</a>
	</li>
<?}?>
</ul>
