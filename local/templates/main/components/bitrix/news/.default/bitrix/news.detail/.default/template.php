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
<div class="event-wrapper">
    <div class="wrapper">
        <div class="title">                       
            <div class="title-1"><?=preg_replace('#(\d+)#iU', '<span>$1</span>', $arResult['NAME'])?> </div>
            <div class="title-2"><?=$arResult['DETAIL_TEXT']?></div>
            <a href="<?=$arResult['LIST_PAGE_URL']?>" class="close"></a>
        </div>
        <?if(count($arResult['DISPLAY_PROPERTIES']['PHOTO']['VALUE'])){?>
            <ul class="clearfix">
                <?foreach($arResult['DISPLAY_PROPERTIES']['PHOTO']['VALUE'] as $photo_id){?>
                    <?
                    $arPhoto = array();
                    $arPhotoPreview = array();
                    if($photo_id){
                        $arPhoto = CFile::ResizeImageGet($photo_id, array('width'=>877, 'height'=>585), BX_RESIZE_IMAGE_EXACT, true);        
                        $arPhotoPreview = CFile::ResizeImageGet($photo_id, array('width'=>269, 'height'=>269), BX_RESIZE_IMAGE_EXACT, true);        
                    }
                    ?>
                    <li><a href="<?=$arPhoto['src']?>" class="fancybox-event" rel="gallery"><img src="<?=$arPhotoPreview['src']?>" alt="" /></a></li>
                <?}?>                
            </ul>
        <?}?>
    </div>
</div>