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
<?
$arItem = $arResult;
$arProp = array();
if($arItem['DISPLAY_PROPERTIES']['NAME']['DISPLAY_VALUE']){
    $arProp[] = $arItem['DISPLAY_PROPERTIES']['NAME']['DISPLAY_VALUE'];
}
if(is_array($arItem['DISPLAY_PROPERTIES']['METAL']['DISPLAY_VALUE'])){
    foreach($arItem['DISPLAY_PROPERTIES']['METAL']['DISPLAY_VALUE'] as $value){
        $arProp[] = $value;
    }
}else if($arItem['DISPLAY_PROPERTIES']['METAL']['DISPLAY_VALUE']){
    $arProp[] = $arItem['DISPLAY_PROPERTIES']['METAL']['DISPLAY_VALUE'];
}
if(is_array($arItem['DISPLAY_PROPERTIES']['STONE']['DISPLAY_VALUE'])){
    foreach($arItem['DISPLAY_PROPERTIES']['STONE']['DISPLAY_VALUE'] as $value){
        $arProp[] = $value;
    }
}else if($arItem['DISPLAY_PROPERTIES']['STONE']['DISPLAY_VALUE']){
    $arProp[] = $arItem['DISPLAY_PROPERTIES']['STONE']['DISPLAY_VALUE'];
}
$arLabel = array(
    'KThr2ELo' => 'novelty-icon',
    'XeEKQHTj' => 'label-hot-1',
    'czOAlqGa' => 'action-icon'
);
$arPhoto = array();
$arPhotoPreview = array();
$photo_id = $arItem['DETAIL_PICTURE']['ID'];
if($photo_id){
	$arFile = CFile::GetFileArray($photo_id);
	if($arFile['WIDTH'] >= $arFile['HEIGHT']){
		$arSize = array('width'=>561, 'height'=>403);
		$arSizePreview = array('width'=>400, 'height'=>301);
	}else{
		$arSize = array('width'=>403, 'height'=>461);
		$arSizePreview = array('width'=>301, 'height'=>344);
	}
    /*$arPhoto = array();    
    $arPhoto['src'] = AIResizeImage($_SERVER['DOCUMENT_ROOT'].$arItem['DETAIL_PICTURE']['SRC'], $arSize['width'], $arSize['height']);                                                
    $arPhotoPreview = array();    
    $arPhotoPreview['src'] = AIResizeImage($_SERVER['DOCUMENT_ROOT'].$arItem['DETAIL_PICTURE']['SRC'], $arSizePreview['width'], $arSizePreview['height']);*/
    
    $arPhoto = CFile::ResizeImageGet($photo_id, $arSize, BX_RESIZE_IMAGE_PROPORTIONAL, true, array());        
    $arPhotoPreview = CFile::ResizeImageGet($photo_id, $arSizePreview, BX_RESIZE_IMAGE_PROPORTIONAL, true, array());
    $arPhotoReflection = PhotoReflection($_SERVER['DOCUMENT_ROOT'].$arPhotoPreview['src'], 134);   		
}
?>
<div id="product_id" data-product-id="<?=$arItem['ID']?>" data-product-name="Арт. <?=$arItem['NAME']?>" class="product-card-wrapper clearfix">
    <div class="product-card-left">
        <div class="image-block">
            <a href="<?=$arItem['SECTION']['SECTION_PAGE_URL']?>" onclick="history.back(); return false;" class="close"></a>
            <a href="<?=$arPhoto['src']?>" class="image fancybox">
                <img src="<?=$arPhotoReflection['src']?>" alt="" />
                <span class="full"></span>
                <?foreach($arItem['DISPLAY_PROPERTIES']['LABEL']['VALUE'] as $value){?>
                    <span class="<?=$arLabel[$value]?>"></span>
                <?}?>                
            </a>
        </div>
    </div>
    <div class="product-card-right">
        <div class="params">
            <p>Арт. <?=$arItem['NAME']?></p>
            <?foreach($arProp as $arPropItem){?>                    
                <p><?=$arPropItem?></p>
            <?}?>                    
        </div>
        <div class="price">
            <?if($arItem['DISPLAY_PROPERTIES']['PRICE_OLD']['VALUE']){?>
                <div class="old"><?=PriceFormat($arItem['DISPLAY_PROPERTIES']['PRICE_OLD']['VALUE'])?> <i class="icon-rub"></i></div>
            <?}?>
			<?
			$price_value = 0;
			if($arItem['DISPLAY_PROPERTIES']['STATUS']['DISPLAY_VALUE']){
				$price_value = '<span style="font-size:24px;">'.$arItem['DISPLAY_PROPERTIES']['STATUS']['DISPLAY_VALUE'].'</span>';
			}else if((int)$arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE']){
				$price_value = PriceFormat($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE']).' <i class="icon-rub"></i>';
			}
			?>
			<?if($price_value){?>
				<div class="current"><?=$price_value?></div>
			<?}?>
        </div>
        <div class="social">
            <div>
				<?global $APPLICATION;?>
                <div class="fb-like" data-href="<?=$APPLICATION->GetCurPage()?>" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>                    
            </div>         
            <div><a href="http://instagram.com/jhdanaya/" target="_blank"><img src="/img/instagram24_24.png" alt="" /></a></div>
        </div>
        <div class="btn-group">
            <a href="#popup-1" class="btn-type-1 popup-open">Хочу в подарок!</a>
            <a href="#popup-2" class="btn-type-1 popup-open">Заказать звонок</a>
            <a href="#popup-3" class="btn-type-1 popup-open">Написать нам</a>
        </div>
    </div>
</div>
<?if(is_array($arItem['DISPLAY_PROPERTIES']['RELATIVE']['LINK_ELEMENT_VALUE'])){?>
    <div class="accompanying-products">
        <div class="title">С этим товаром покупают:</div>
        <ul>
            <?foreach($arItem['DISPLAY_PROPERTIES']['RELATIVE']['LINK_ELEMENT_VALUE'] as $arRelative){?>
                <?
                $arPhoto = array();
                if($arRelative['DETAIL_PICTURE']){
                    $arFile = CFile::GetFileArray($arRelative['DETAIL_PICTURE']);
                    if($arFile['WIDTH'] >= $arFile['HEIGHT']){
                        $arSize = array('width'=>235, 'height'=>178);
                    }else{
                        $arSize = array('width'=>178, 'height'=>235);
                    }
                    /*$arPhoto = array();    
                    $arPhoto['src'] = AIResizeImage($_SERVER['DOCUMENT_ROOT'].$arFile['SRC'], $arSize['width'], $arSize['height']);                     */
                    $arPhoto = CFile::ResizeImageGet($arRelative['DETAIL_PICTURE'], $arSize, BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, array());
                    $arPhotoReflection = PhotoReflection($_SERVER['DOCUMENT_ROOT'].$arPhoto['src'], 50);                        
                } 
                ?>
                <li><a href="<?=$arRelative['DETAIL_PAGE_URL']?>"><img src="<?=$arPhotoReflection['src']?>" /></a></li>
            <?}?>            
        </ul>
    </div>
<?}?>