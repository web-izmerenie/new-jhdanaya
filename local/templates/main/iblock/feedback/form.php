<?if(!$arParams['FORM_BODY']){?>
<div class="popup-inner" id="popup-3">
    <div class="popup-form">
        <a href="#" class="close"></a>
        <div class="title">Написать нам</div>
        <div class="form">
            <form name="SIMPLE_FORM_3" action="<?=SITE_DIR?>forms/add_feedback.php">
<?}?>
                <input type="hidden" name="WEB_FORM_ID" value="3">
                <input type="hidden" name="ADD_RESULT" value="1">
                <input type="hidden" name="product_id" value="">
                <div class="line"><input type="text" name="form_text_7" placeholder="Имя" class="placeholder-1" required="required" data-placeholder="Имя" /></div>
                <div class="line"><input type="email" name="form_email_8" placeholder="E-mail" class="placeholder-3" required="required" data-placeholder="E-mail" /></div>
                <div class="line"><textarea class="placeholder-4" name="form_textarea_9" data-placeholder="Сообщение" placeholder="Сообщение" required="required"></textarea></div>
                <div class="line-send"><input type="submit" value="Отправить" name="web_form_submit" class="btn-type-1" /></div>
<?if(!$arParams['FORM_BODY']){?>                
            </form>
        </div>
    </div>
</div>
<?}?>