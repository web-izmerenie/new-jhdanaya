<?
CModule::IncludeModule("iblock");

function p($array, $bReturn = false){
	$sResult = '<pre>'.print_r($array, true).'</pre>';
	if($bReturn){
		return $sResult;
	}else{
		echo $sResult;
	}
}
function PriceFormat($price){
        return number_format($price, 0, " ", " ");
}
function GetResizeImageDir($filename){
        $hash = md5($filename);
        $dir1 = substr($hash, 0, 2);
        $dir2 = substr($hash, 2, 2);
        $arDir = array('image_cache', $dir1, $dir2);		
        $path = implode('/', $arDir);
        if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$path)){
                mkdir($_SERVER['DOCUMENT_ROOT'].'/'.$path, 0777, true);
        }
        return $path;
}
function AIResizeImage($file, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefrompng($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    
    imagealphablending($dst, false);
    $bg = imagecolortransparent($out, imagecolorallocatealpha($dst, 255, 255, 255, 127));
    imagefill($dst, 0, 0, $bg);
    imagesavealpha($dst,true);
    
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    
    $filename = md5($file).'.png';
    $dir = GetResizeImageDir($filename);		
    $to = '/'.$dir.'/'.$w.'_'.$h.'_'.(int)$crop.'_'.$filename;
    
    imagepng($dst, $_SERVER['DOCUMENT_ROOT'].$to);
    return $to;
}
function PhotoReflection($filename, $height, $strength){   
    if(file_exists($filename)){   
        #p(mime_content_type($filename));
        $in = imagecreatefrompng($filename);
        if($strength){
            $reflection_strength = $strength;
        }else{
            $reflection_strength = 40;
        }        
        if($height){
            $reflection_height = $height;
        }else{        
            $reflection_height = imagesy($in)/10*5.5;        
        }
        $gap = 0;

        $orig_height = imagesy($in);                                
        $orig_width = imagesx($in);                                    
        $output_height = $orig_height + $reflection_height + $gap;

        $out = imagecreatetruecolor($orig_width, $output_height);
        imagealphablending($out, false);
        $bg = imagecolortransparent($out, imagecolorallocatealpha($out, 255, 255, 255, 127));
        imagefill($out, 0, 0, $bg);
        //imagefilledrectangle($out, 0, 0, imagesx($in), imagesy($in), $bg1);

        imagecopyresampled ( $out , $in , 0, 0, 0, 0, imagesx($in), imagesy($in), imagesx($in), imagesy($in));

        $reflection_section = imagecreatetruecolor(imagesx($in), 1);
        imagealphablending($reflection_section, false);
        $bg1 = imagecolortransparent($reflection_section, imagecolorallocatealpha($reflection_section, 255, 255, 255, 127));
        imagefill($reflection_section, 0, 0, $bg1);

        for ($y = 0; $y<$reflection_height;$y++){    
            $t = ((127-$reflection_strength) + ($reflection_strength*($y/$reflection_height)));
            imagecopy($reflection_section, $out, 0, 0, 0, imagesy($in)  - $y, imagesx($in), 1);
            imagefilter($reflection_section, IMG_FILTER_COLORIZE, 0, 0, 0, $t);
            imagecopyresized($out, $reflection_section, $a, imagesy($in) + $y + $gap, 0, 0, imagesx($in) - (2*$a), 1, imagesx($in), 1);
        }
        $arFileName = explode('/', $filename);        
        $last_key = count($arFileName) -1;        
        imagesavealpha($out,true);
        $path = '/'.GetReflectionImageDir($arFileName[$last_key]).'/'.$orig_width.'_'.($orig_height+$reflection_height).'_'.$reflection_strength.'_'.$arFileName[$last_key];            
        imagepng($out, $_SERVER['DOCUMENT_ROOT'].$path);        
        return array('src'=>$path, 'width'=>$orig_width, 'height'=>$reflection_height+$orig_height);
    }
    return false;
}
function GetReflectionImageDir($filename){
        $hash = md5($filename);
        $dir1 = substr($hash, 0, 2);
        $dir2 = substr($hash, 2, 2);
        $arDir = array('upload/reflection_cache', $dir1, $dir2);		
        $path = implode('/', $arDir);
        if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$path)){
                mkdir($_SERVER['DOCUMENT_ROOT'].'/'.$path, 0777, true);
        }
        return $path;
}
function GetProductInfo($product_id){
    $dbElement = CIBlockElement::GetList(array(), array('ID'=>$product_id, 'IBLOCK_ID'=>3));
    if($dbElement->SelectedRowsCount()){
        while($obElement = $dbElement->GetNextElement()){
            $arElement = $obElement->GetFields();
            $arElement['PROPERTIES'] = $obElement->GetProperties();            
            $arPropCode = array('PRICE', 'METAL', 'STONE', 'NAME');
            foreach($arPropCode as $pid){
                $arElement['DISPLAY_PROPERTIES'][$pid] = CIBlockFormatProperties::GetDisplayValue($arElement, $arElement['PROPERTIES'][$pid]);            
            }                        
            $rsSites = CSite::GetByID(SITE_ID);
            $arSite = $rsSites->Fetch();            
            $arProp = array();
            if($arElement['DISPLAY_PROPERTIES']['NAME']['DISPLAY_VALUE']){
                $arProp[] = $arElement['DISPLAY_PROPERTIES']['NAME']['DISPLAY_VALUE'];
            }
            if(is_array($arElement['DISPLAY_PROPERTIES']['METAL']['DISPLAY_VALUE'])){
                foreach($arElement['DISPLAY_PROPERTIES']['METAL']['DISPLAY_VALUE'] as $value){
                    $arProp[] = $value;
                }
            }else if($arElement['DISPLAY_PROPERTIES']['METAL']['DISPLAY_VALUE']){
                $arProp[] = $arElement['DISPLAY_PROPERTIES']['METAL']['DISPLAY_VALUE'];
            }
            if(is_array($arElement['DISPLAY_PROPERTIES']['STONE']['DISPLAY_VALUE'])){
                foreach($arElement['DISPLAY_PROPERTIES']['STONE']['DISPLAY_VALUE'] as $value){
                    $arProp[] = $value;
                }
            }else if($arElement['DISPLAY_PROPERTIES']['STONE']['DISPLAY_VALUE']){
                $arProp[] = $arElement['DISPLAY_PROPERTIES']['STONE']['DISPLAY_VALUE'];
            }  
            $url = 'http://'.$arSite['SERVER_NAME'].$arElement['DETAIL_PAGE_URL'];
            $arPhotoPreview = CFile::ResizeImageGet($arElement['DETAIL_PICTURE'], array('width'=>301, 'height'=>1000), BX_RESIZE_IMAGE_PROPORTIONAL, true);
            $sResult = '';
            $sResult .= '<p><a href="'.$url.'" target="_blank"><img src="'.$arPhotoPreview['src'].'" width="'.$arPhotoPreview['width'].'" height="'.$arPhotoPreview['height'].'" /></a></p><br />';
            $sResult .= '<p>Арт. '.$arElement['NAME'];
            if(count($arProp)){
                $sResult .= '<br />';
                $sResult .= implode('<br />', $arProp);
            }
            $sResult .= '</p>';            
            $sResult .= '<br /><p>Для перехода на страницу товара кликните по ссылке:<br /><a href="'.$url.'" target="_blank">'.$url.'</a></p>';
            return $sResult;           
        }  
    }
}
function GetSEOText(){    
    if($_SERVER['QUERY_STRING']){
        $arg = $_SERVER['QUERY_STRING'];
        $arg = str_replace('&clear_cache=Y', '', $arg);
    }
    global $APPLICATION;
    $dir = $APPLICATION->GetCurDir();    
    $arFilter = array('IBLOCK_ID'=>5, 'ACTIVE'=>'Y', 'NAME'=>$dir);    
    if($arg){
        $arFilter['PROPERTY_GET'] = "%".$arg."%";
    }    	
    $obSEO = CIBlockElement::GetList(array('SORT'=>'ASC'), $arFilter, false, false, array('IBLOCK_ID', 'NAME', 'ID', 'PROPERTY_GET', 'PROPERTY_TITLE', 'PROPERTY_PAGE_TITLE', 'PROPERTY_DESCRIPTION', 'PROPERTY_KEYWORDS', 'DETAIL_TEXT'));
    if($arSEO = $obSEO->GetNext()){        
        if($arSEO['PROPERTY_TITLE_VALUE']){
            $APPLICATION->SetTitle($arSEO['PROPERTY_TITLE_VALUE']);
            $APPLICATION->SetPageProperty('title', $arSEO['PROPERTY_TITLE_VALUE']);
        }
        if($arSEO['PROPERTY_PAGE_TITLE_VALUE']){
            $APPLICATION->SetPageProperty('page_title', $arSEO['PROPERTY_PAGE_TITLE_VALUE']);            
        }
        if($arSEO['PROPERTY_DESCRIPTION_VALUE']['TEXT']){
            $APPLICATION->SetPageProperty('description', $arSEO['PROPERTY_DESCRIPTION_VALUE']['TEXT']);            
        }
        if($arSEO['PROPERTY_KEYWORDS_VALUE']['TEXT']){
            $APPLICATION->SetPageProperty('keywords', $arSEO['PROPERTY_KEYWORDS_VALUE']['TEXT']);            
        }
        return $arSEO['DETAIL_TEXT'];
    }
}
?>