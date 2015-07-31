<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
die();
?>
<?
global $wrapper_class;
?>
        <?if($wrapper_class == 'error-wrapper'){?>
                </div>
	    </div>
        <?}else if($wrapper_class != 'product-card-wrapper'){?>
                </div>
	    </div>	        
        <?}?>
        <footer class="footer">
            <?if($wrapper_class != 'error-wrapper'){?>
                <div class="footer-top clearfix">
                    <div class="wrapper">
                        <?$APPLICATION->IncludeComponent("bitrix:menu", "bottom", Array(
                                "ROOT_MENU_TYPE" => "top",
                                "MENU_CACHE_TYPE" => "N",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => array(""),
                                "MAX_LEVEL" => "2",
                                "CHILD_MENU_TYPE" => "left",
                                "USE_EXT" => "Y",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N"
                            )
                        );
                        ?>     
                        <div class="social">
                            <?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "AREA_FILE_SUFFIX" => "inc", "PATH" => SITE_DIR."include_areas/social_bottom.php"));?>                        
                        </div>
                    </div>
                </div>
                <?
                $seo = GetSEOText();
                ?>
                <?if($seo){?>
                    <div class="footer-middle">
                        <div class="wrapper">
                            <div class="seo-text">                            
                                <?=$seo?>                                
                            </div>
                        </div>
                    </div> 	
                <?}?>
            <?}?>
            <div class="footer-bottom clearfix">
                <div class="wrapper">
                    <div class="dev">
                        <span>Сделано в</span>
                        <a href="http://www.web-izmerenie.ru/" target="_blank" class="icon-dev"></a>
                    </div>
                </div>
            </div>
        </footer>
    </div>        
    <?$APPLICATION->IncludeFile("iblock/gift/form.php")?>
    <?$APPLICATION->IncludeFile("iblock/call/form.php")?>
    <?$APPLICATION->IncludeFile("iblock/feedback/form.php")?>
    <?$APPLICATION->AddHeadScript(SITE_DIR.'js/plugins.min.js');?>
    <?$APPLICATION->AddHeadScript(SITE_DIR.'js/jquery-ui.js');?>
    <?$APPLICATION->AddHeadScript(SITE_DIR.'js/jquery.selectbox-0.1.3.js');?>
    <?$APPLICATION->AddHeadScript(SITE_DIR.'js/form.js');?>
    <?$APPLICATION->AddHeadScript(SITE_DIR.'js/main.js');?>
    <?$APPLICATION->AddHeadScript('http://maps.googleapis.com/maps/api/js?sensor=false');?>
    <?$APPLICATION->AddHeadScript(SITE_DIR.'js/map.js');?>    
</body>
</html>