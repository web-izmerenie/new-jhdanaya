<?if(!$arParams['FORM_BODY']){?>
<div class="popup-inner" id="popup-1">
    <div class="popup-form">
        <a href="#" class="close"></a>
        <div class="title">Хочу в подарок!</div>
        <div class="form">
            <form name="SIMPLE_FORM_1" action="<?=SITE_DIR?>forms/add_gift.php">
<?}?>
                <input type="hidden" name="WEB_FORM_ID" value="1">
                <input type="hidden" name="ADD_RESULT" value="1">
                <input type="hidden" name="product_id" value="">
                <div class="line"><input type="text" name="form_text_1" required="required" placeholder="Ваше имя" class="placeholder-5" data-placeholder="Ваше имя" /></div>
                <div class="line"><input type="email" name="form_email_2" required="required" placeholder="Ваш e-mail" class="placeholder-6" data-placeholder="Ваш e-mail" /></div>
                <div class="line"><input type="text" name="form_text_3" required="required" placeholder="Имя дарителя" class="placeholder-7" data-placeholder="Имя дарителя" /></div>
                <div class="line"><input type="email" name="form_email_4" required="required" placeholder="E-mail дарителя" class="placeholder-8" data-placeholder="E-mail дарителя" /></div>
                <div class="line-send">
									<input type="submit" value="Отправить" name="web_form_submit" class="btn-type-1" onclick="yaCounter26647785.reachGoal('SURPRICE_SUBMIT'); return true;"/>
								</div>
<?if(!$arParams['FORM_BODY']){?>
            </form>
        </div>
    </div>
</div>
<?}?>
