<?php
if (!defined('_PAVE_')) exit;
?>
<?php if(pave_is_array($user_list)){ ?>
    <?php foreach ($user_list as $i => $user) { ?>
    <li class="work_with__item">
        <a href="<?=$user["user_page_url"]?>" class="work_with__item-link" target="_blank">
            <img src="<?=$user["user_img"]?>" alt="프로필 이미지" width="48" height="48" class="work_with__item-img">

            <div class="work_with__item-inner-box">
                <span class="work_with__item-nick"><?=$user["user_nick"]?></span>
                <span class="work_with__item-field"><?=$user["user_field"]?></span>
            </div>
        </a>
        <?php if(pave_is_array($work_with_list) && in_array($user["user_no"], $work_with_list)){ ?>
        <button type="button" class="work_with__item-add-button button-t2 button-s4 disabled" data-user="<?=$user["user_no"]?>" data-json="<?=htmlspecialchars(stripslashes(json_encode($user, JSON_UNESCAPED_UNICODE)))?>" disabled>추가됨</button>
        <?php }else{ ?>
        <button type="button" class="work_with__item-add-button button-t2 button-s4" data-user="<?=$user["user_no"]?>" data-json="<?=htmlspecialchars(stripslashes(json_encode($user, JSON_UNESCAPED_UNICODE)))?>">추가</button>
        <?php } ?>
    </li>
    <?php }?>
<?php }else { ?> 
    <?php if($page == 1){ ?>
    <li class="work_with__item-empty">
        <p class="work_with__item-empty-text">함께한 작가님을 추가하려면<br>작가간 팔로우 상태이어야 합니다.</p>
    </li>
    <?php } ?>
<?php } ?>
