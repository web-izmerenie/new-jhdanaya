<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)){?>            
    <?
    $previousLevel = 0;
    foreach($arResult as $arItem){
        if($previousLevel && $arItem['DEPTH_LEVEL'] == 1){
            echo '</ul>';
        }
        if($arItem['DEPTH_LEVEL'] == 1){
            echo '<ul class="f-link">';
        }
        ?><li><a href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a></li><?
        $previousLevel = $arItem['DEPTH_LEVEL'];
    }
    echo '</ul>';
    ?>                    
<?}?>