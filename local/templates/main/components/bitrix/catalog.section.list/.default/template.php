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
<div class="main-category" id="main-category">
    <div class="main-category__wrapper wrapper clearfix">
        <ul>    
            <?
            foreach ($arResult['SECTIONS'] as &$arSection){
                $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
                $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);                                
                ?>
                <?
                $arFile = CFile::GetFileArray($arSection['PICTURE']['ID']);
                if($arFile['WIDTH'] >= $arFile['HEIGHT']){
                    $arSize = array('width'=>235, 'height'=>178);
                }else{
                    $arSize = array('width'=>178, 'height'=>235);
                }
                $arPhoto = CFile::ResizeImageGet($arSection['PICTURE']['ID'], $arSize, BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, array());  
                $arPhotoReflection = PhotoReflection($_SERVER['DOCUMENT_ROOT'].$arPhoto['src'], 47, 40);
                ?>  
                <li id="<?echo $this->GetEditAreaId($arSection['ID']);?>">
                    <a href="<?=$arSection['SECTION_PAGE_URL']?>">
                        <div class="image"><img src="<?=$arPhotoReflection['src']?>" alt="" /></div>
                        <div class="text"><?=$arSection['NAME']?></div>
                    </a>
                </li>
                <?
            }
            ?>
        </ul>
    </div>
</div>			