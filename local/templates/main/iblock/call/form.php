<?if(!$arParams['FORM_BODY']){?>
<div class="popup-inner" id="popup-2">
    <div class="popup-form">
        <a href="#" class="close"></a>
        <div class="title">Заказать звонок</div>
        <div class="form">
            <form name="SIMPLE_FORM_2" action="<?=SITE_DIR?>forms/add_call.php">
<?}?>                
                <input type="hidden" name="WEB_FORM_ID" value="2">
                <input type="hidden" name="ADD_RESULT" value="1">
                <input type="hidden" name="product_id" value="">
                <div class="line"><input type="text" name="form_text_5" required="required" placeholder="Имя" class="placeholder-1" data-placeholder="Имя" /></div>
                <div class="line"><input type="text" name="form_text_6" required="required" placeholder="Телефон" class="placeholder-2" data-placeholder="Телефон" /></div>
                <div class="line-send"><input type="submit" value="Отправить" name="web_form_submit" class="btn-type-1" /></div>
<?if(!$arParams['FORM_BODY']){?>                
            </form>
        </div>
    </div>
</div>
<?}?>