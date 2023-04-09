<?php
if (!defined('_PAVE_')) exit;
?>
<section id="login">
    <form id="login__form" novalidate autocomplete="off">
        <input type="hidden" name="csrf" id="csrf" value="<?=$_SESSION['csrf_token']?>">
        <fieldset>
            <legend id="login__title">로그인</legend>

            <div id="login__id" class="input-box-t1">
                <label for="user_id" class="input-box-t1__label">아이디</label>
                <input type="text" name="user_id" id="user_id" class="input-box-t1__input" required>
            </div>

            <div id="login__pwd" class="input-box-t1">
                <label for="user_pwd" class="input-box-t1__label">비밀번호</label>
                <input type="password" name="user_pwd" id="user_pwd" class="input-box-t1__input" required>
            </div>

            <button type="submit" id="login__submit" class="button-s1 button-t1"><span class="button__text">로그인</span></button>
            
            <div id="login__more">
                <a href="<?=get_url(PAVE_ACCOUNT_URL, "find/id/form")?>" id="login__more-id" title="아이디 찾기">아이디 찾기</a>
                <a href="<?=get_url(PAVE_ACCOUNT_URL, "find/pwd/form")?>" id="login__more-pwd" title="비밀번호 찾기">비밀번호 찾기</a>
                <label id="login__more-auto" for="user_auto_login" class="check-box">
                    <input type="checkbox" name="user_auto_login" id="user_auto_login" class="check-box__check">
                    <span class="check-box__span"></span>
                    <span class="check-box__label">로그인유지</span>
                </label>
            </div>
            <div id="login__reg">
                <span id="login__reg-msg01">무명회원이 아니신가요?</span><a href="<?=get_url(PAVE_ACCOUNT_URL,"reg")?>" id="login__reg-msg02" title="회원가입">지금 가입하세요.</a>
            </div>
        </fieldset>
    </form>
    
    <div id="login__ad" class="mumng-ad">
        <img src="<?=get_url(PAVE_IMG_URL, "img_page_ad_376px.png")?>" alt="무명 페이지 내부 광고 이미지">
    </div>
</section>