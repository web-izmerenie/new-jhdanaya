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
<div class="filter wrapper">
    <form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get">
        <div class="filter-left">        
            <ul>        
                <?                                            
                foreach($arResult["ITEMS"] as $key=>$arItem){
                    $idx = '';  
                    if($arItem['CODE'] != 'LABEL'){
                        $arCur = current($arItem["VALUES"]);
                        switch ($arItem["DISPLAY_TYPE"]){
                            case "A"://NUMBERS_WITH_SLIDER
                                if($arItem['CODE'] == 'PRICE' && $arItem["VALUES"]["MIN"]["VALUE"] != $arItem["VALUES"]["MAX"]["VALUE"]){
                                    $idx = 'style-select2';                                    
                                    $precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
                                    $step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4;
                                    $price = array();
									if($arItem["VALUES"]["MIN"]["VALUE"] > 0){
										$price[] = number_format($arItem["VALUES"]["MIN"]["VALUE"], $precision, ".", "");
									}
                                    $price[] = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step, $precision, ".", "");
                                    $price[] = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 2, $precision, ".", "");
                                    $price[] = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 3, $precision, ".", "");
                                    $price[] = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");                                                                
                                    ?>                                
                                    <li id="filter_item_<?=$key?>">                                       
                                        <input type="hidden" <?=(!$arItem["VALUES"]["MIN"]['HTML_VALUE'] ? 'disabled="disabled"' : NULL)?> name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" id="filter_item_<?=$key?>_min" value="<?=($arItem["VALUES"]["MIN"]['HTML_VALUE'] ? $arItem["VALUES"]["MIN"]['HTML_VALUE'] : NULL)?>" />									
                                        <input type="hidden" <?=(!$arItem["VALUES"]["MAX"]['HTML_VALUE'] ? 'disabled="disabled"' : NULL)?> name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" id="filter_item_<?=$key?>_max" value="<?=($arItem["VALUES"]["MAX"]['HTML_VALUE'] ? $arItem["VALUES"]["MAX"]['HTML_VALUE'] : NULL)?>" />									                                
                                        <select name="style-select" id="<?=$idx?>" data-min-id="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" data-max-id="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>">
                                            <option value="filter_item_<?=$key?>" data-title="Все"><?=$arItem['NAME']?></option>
                                            <?foreach($price as $key=>$priceItem):?>
                                                <?												
                                                if($key == 0){
                                                    $price_value = '0_'.$price[$key];
                                                    $price_option = 'до '.$price[$key];
                                                }else{
                                                    $price_value = $price[$key-1].'_'.$price[$key];
                                                    $price_option = 'от '.$price[$key-1].' до '.$price[$key];
                                                }                                            
                                                ?>
                                                <option value="<?=$price_value?>" <?=((int)$arItem["VALUES"]["MIN"]['HTML_VALUE'].'_'.(int)$arItem["VALUES"]["MAX"]['HTML_VALUE'] == $price_value ? 'selected="selected"' : NULL)?>><?=$price_option?></option>                                    
                                            <?endforeach;?>
                                        </select>    
                                    </li>                                                                    
                                    <?
                                }
                                break;              						
                            default://CHECKBOXES                                                              
                                if($arItem['CODE'] == 'FILTER_METAL'){
                                    $idx = 'style-select1';
                                }
                                if($arItem['CODE'] == 'FILTER_STONE'){
                                    $idx = 'style-select';
                                }
                                ?>
                                <?if(count($arItem["VALUES"])){?>    
                                    <li id="filter_item_<?=$key?>">
                                        <?                                       
                                        foreach($arItem["VALUES"] as $val => $ar){
                                            ?><input <?=(!$ar['CHECKED'] ? 'disabled="disabled"' : NULL)?> type="hidden" id="<?=$ar["CONTROL_NAME"]?>" name="<?=$ar["CONTROL_NAME"]?>" value="<?=($ar['CHECKED'] ? 'Y' : NULL)?>" /><?
                                        }
                                        ?>
                                        <select name="style-select" id="<?=$idx?>">
                                            <option value="filter_item_<?=$key?>" data-title="Все"><?=$arItem['NAME']?></option>
                                            <?foreach($arItem["VALUES"] as $val => $ar):?>
                                                <option value="<?=$ar["CONTROL_NAME"]?>" <?=($ar['CHECKED'] ? 'selected="selected"' : NULL)?>><?=$ar["VALUE"]?></option>                                    
                                            <?endforeach;?>
                                        </select>    
                                    </li>
                                <?}?>
                        <?}?>
                    <?}?>            
                <?}?>    
            </ul>
        </div>        
        <?
        foreach($arResult["ITEMS"] as $key=>$arItem){   
            if($arItem['CODE'] == 'LABEL'){
                $arCur = current($arItem["VALUES"]);
                ?>
                <div class="filter-right" id="style-select3">
                    <?if(count($arItem["VALUES"])){?>  
                        <ul id="filter_item_<?=$key?>">
                            <?
                            switch ($arItem["DISPLAY_TYPE"]){                                						
                                default://CHECKBOXES                                
                                    foreach($arItem["VALUES"] as $val => $ar){
                                        ?><input type="hidden" <?=(!$ar['CHECKED'] ? 'disabled="disabled"' : NULL)?> id="<?=$ar["CONTROL_NAME"]?>" name="<?=$ar["CONTROL_NAME"]?>" value="<?=($ar['CHECKED'] ? 'Y' : NULL)?>" /><?
                                    }
                                    foreach($arItem["VALUES"] as $val => $ar){
                                        ?><li <?=($ar['CHECKED'] ? 'class="active"' : NULL)?>><a data-value="<?=$ar["CONTROL_NAME"]?>"><?=$ar["VALUE"]?></a></li><?
                                    }                                
                            }                        
                            ?>
                        </ul>
                    <?}?>
                </div>
                <?                            
            }
        }
        ?>          
        <input type="hidden" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" />
        <input style="display:none" class="bx_filter_search_button" type="submit" />			
    </form>
</div>            