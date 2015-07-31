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
<div class="balloon">
	<?/*
    <?foreach($arResult["ITEMS"] as $key=>$arItem){?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="title-1 <?=($key == 0 ? 'active' : NULL)?>" data-map="<?=$arItem['ID']?>" data-point="<?=$arItem['DISPLAY_PROPERTIES']['COORD']['DISPLAY_VALUE']?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>"><?=$arItem['NAME']?></div>	
    <?}?>
	*/?>
    <?foreach($arResult["ITEMS"] as $key=>$arItem){?>
        <?
        $arPhoto = array();
        if($arItem['PREVIEW_PICTURE']['ID']){
            $arPhoto = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>328, 'height'=>194), BX_RESIZE_IMAGE_EXACT, true);        
        }
        ?>
        <div class="balloon-tab" data-tab="<?=$arItem['ID']?>" <?=($key > 0 ? 'style="display: none;"' : NULL)?>>            
            <?if($arPhoto['src']){?>
                <div class="image"><img src="<?=$arPhoto['src']?>" alt="" /></div>
            <?}?>
            <div class="contact"><?=$arItem['PREVIEW_TEXT']?></div>
        </div>
    <?}?>
</div>