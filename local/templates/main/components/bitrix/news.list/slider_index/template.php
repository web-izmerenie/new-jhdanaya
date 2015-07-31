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
<div class="main-slider-wrapper">
    <ul class="js-main-slider">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <?
            if($arItem['DISPLAY_PROPERTIES']['FULL_WIDTH']['VALUE']){
                $arPhoto = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>816, 'height'=>384), BX_RESIZE_IMAGE_PROPORTIONAL, true, array());        
            }else{
                $arPhoto = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>396, 'height'=>444), BX_RESIZE_IMAGE_PROPORTIONAL, true, array());        
            }
            ?>                  
            <li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <a <?=($arItem['DISPLAY_PROPERTIES']['URL']['VALUE'] ? 'href="'.$arItem['DISPLAY_PROPERTIES']['URL']['VALUE'].'"' : NULL)?>>
                    <?
                    $marginTop = (444 - $arPhoto['height']) / 2;
                    if($arItem['DISPLAY_PROPERTIES']['FULL_WIDTH']['VALUE']){
                        $marginTop = 0;
                    }
                    ?>
                    <img src="<?=$arPhoto['src']?>" alt="" style="margin-top:<?=(int)$marginTop?>px;" />
                    <div class="text">
                        <?=$arItem['PREVIEW_TEXT']?>	  
                        <div class="price">
                            <?if($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE']){?>
                                <?=PriceFormat($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'])?> <i class="icon-rub"></i>
                            <?}else{?>
                                &nbsp;
                            <?}?>
                        </div>
                    </div>
                </a>
            </li>
        <?endforeach;?>
    </ul>	    	
</div>
