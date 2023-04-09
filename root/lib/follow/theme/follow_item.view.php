<?php
if (!defined('_PAVE_')) exit;
?>
<?php if(pave_is_array($follow_list)){ ?>
    <?php foreach ($follow_list as $i => $follow) { ?>
    <li class="follow-item">
        <a href="<?=$follow["user_page_url"]?>" class="follow-item__link" target="_blank">
            <img src="<?=$follow["user_img"]?>" alt="프로필 이미지" width="48" height="48" class="follow-item__img">
        </a>
        <div class="follow-item__inner-box">
            <span class="follow-item__nick">
                <a href="<?=$follow["user_page_url"]?>" target="_blank"><?=$follow["user_nick"]?></a>
            </span>
            <span class="follow-item__field"><?=$follow["user_field"]?></span>
        </div>
        <?php if($follow["is_follow_display"]){ ?>
            <?php if(User::is_follow_user($pave_user, $user)){ ?>
            <button type="button" class="follow-item__follow-button button-t3 button-s4 follow-button" data-user="<?=$follow["user_no"]?>">팔로우 취소</button>
            <?php }else{ ?>
            <button type="button" class="follow-item__follow-button button-t1 button-s4 follow-button" data-user="<?=$follow["user_no"]?>">팔로우</button>
            <?php } ?>
        <?php } ?>
    </li>
    <?php }?>
<?php }else { ?> 
    <?php if($page == "1"){ ?>
    <li class="follow-item-empty">
        <span class="follow-item-empty__text">검색결과가 없습니다.</span>
    </li>
    <?php } ?>
<?php } ?>