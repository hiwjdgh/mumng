<?php
if (!defined('_PAVE_')) exit;
?>
<section id="find" class="flex flex-column mxw-360 pdhz-22">
    <h2 id="find__title" class="text-weight-bold text-color-g12 text-size-large mgb-48">아이디를 정상적으로 찾았습니다.</h2>

    <div class="input-box input-box-t2 mgb-32 focus">
        <label for="user_cp" class="input-box-t2__label">회원님의 아이디</label>
        <span class="input-box-t2__input"><?=Converter::display_mask($user["user_id"])?></span>
        <p id="user_cp_msg" class="input-box-t2__msg"></p>
    </div>

    <div class="flex-align-self-center flex flex-align-item-center gap-column-4 mgb-60">
        <span class="text-weight-regular text-color-g12 text-size-small">비밀번호를 잊으셨나요?</span>
        <a href="<?=get_url(PAVE_ACCOUNT_URL,"find/pwd/form")?>" class="text-weight-bold text-color-g12 text-size-small" title="비밀번호 찾기">비밀번호 찾기</a>
    </div>

    <a href="<?=get_url(PAVE_ACCOUNT_URL,"login")?>" class="button-t1 button-s1" title="로그인">로그인</a>
</section>