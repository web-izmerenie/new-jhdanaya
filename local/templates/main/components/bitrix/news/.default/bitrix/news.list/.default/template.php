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
<div class="events-wrapper">
    <div class="wrapper">
        <ul class="clearfix">
            <?foreach($arResult["ITEMS"] as $arItem){?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <?
                $arPhoto = array();
                if($arItem['PREVIEW_PICTURE']['ID']){
                    $arPhoto = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>443, 'height'=>230), BX_RESIZE_IMAGE_EXACT, true);        
                }
                ?>
                <li <?=($arPhoto['src'] ? NULL : 'class="no-image"')?> id="<?=$this->GetEditAreaId($arItem['ID']);?>">                    
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                        <?if($arPhoto['src']){?>
                            <img src="<?=$arPhoto['src']?>" alt="" />
                        <?}?>
                        <span><?=($arItem['PREVIEW_TEXT'] ? $arItem['PREVIEW_TEXT'] : $arItem['NAME'])?></span>
                    </a>
                </li>                
            <?}?>
        </ul>
        <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
            <?=$arResult["NAV_STRING"]?>
        <?endif;?>
    </div>
</div>  

