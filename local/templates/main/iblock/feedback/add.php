<?
if(CModule::IncludeModule("form")){     
    $arValues = $_REQUEST;
    if($arValues['product_id']){
        $arValues['form_text_11'] = $arValues['product_id'];
        $arValues['form_textarea_15'] = GetProductInfo($arValues['product_id']);        
    }
    $error = CForm::Check($_REQUEST['WEB_FORM_ID'], $arValues);    
    if(!$error){   
        if($RESULT_ID = CFormResult::Add($_REQUEST['WEB_FORM_ID'], $arValues)){
            CFormResult::Mail($RESULT_ID);
            ?><div class='successText append-form'>Спасибо. Сообщение отправлено. В ближайшее время с вами свяжутся по указанным контактам.</div><?
        }else{
            global $strError;
            $error = $strError;
        }
    }
    if($error){
        ?><div class="warnText append-form"><?=$error?></div><?        
    }
}
?>