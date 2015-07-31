<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
global $APPLICATION;
$curDir = $APPLICATION->GetCurDir();
?>
<?if (!empty($arResult)):?>
    <ul class="parrent-nav">
        <?foreach($arResult as $arItem):?>
            <?if($arItem['SELECTED']){?>
                <li class="active <?=($curDir != $arItem['LINK'] ? 'parent-active' : NULL)?>"><a href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a></li>            
            <?}else{?>
                <li><a href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a></li>
            <?}?>
        <?endforeach?>
    </ul>
<?endif?>