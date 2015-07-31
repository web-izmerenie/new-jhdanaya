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
$arLabel = array(
    'KThr2ELo' => 'novelty-icon',
    'XeEKQHTj' => 'hit-icon',
    'czOAlqGa' => 'action-icon'
);
?>
<div class="product-category" id="product-category">
    <div class="product-category__wrapper wrapper clearfix">
<?
if (!empty($arResult['ITEMS'])){
    ?>    
            <ul>   
                <?
                foreach ($arResult['ITEMS'] as $key => $arItem){
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
                    $strMainID = $this->GetEditAreaId($arItem['ID']);
                    $arPhoto = array();
                    if($arItem['DETAIL_PICTURE']['ID']){
                        $arFile = CFile::GetFileArray($arItem['DETAIL_PICTURE']['ID']);
                        if($arFile['WIDTH'] >= $arFile['HEIGHT']){
                            $arSize = array('width'=>235, 'height'=>178);
                        }else{
                            $arSize = array('width'=>178, 'height'=>235);
                        }	                        
                        /*$arPhoto = array();
                        $arPhoto['src'] = AIResizeImage($_SERVER['DOCUMENT_ROOT'].$arItem['DETAIL_PICTURE']['SRC'], $arSize['width'], $arSize['height']);*/
                        $arPhoto = CFile::ResizeImageGet($arItem['DETAIL_PICTURE']['ID'], $arSize, BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, array());						
                        $arPhotoReflection = PhotoReflection($_SERVER['DOCUMENT_ROOT'].$arPhoto['src'], 50);                        
                    }                                        
                    ?>
                    <li>                              
                        <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                            <div class="image"><img src="<?=$arPhotoReflection['src']?>" /></div>
                            <div class="text">
                                <?foreach($arItem['DISPLAY_PROPERTIES']['LABEL']['VALUE'] as $value){?>
                                    <span class="<?=$arLabel[$value]?>"></span>
                                <?}?>
                            </div>
                        </a>
                    </li>
                    <?
                }
                ?>
            </ul>                        
    <?
}else{
    ?><p>Товары не найдены</p><?
}
?>
    </div>
</div>    
<? echo $arResult["NAV_STRING"]; ?>
