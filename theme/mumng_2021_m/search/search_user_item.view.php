<?php
if (!defined('_PAVE_')) exit;
?>
<?php if(pave_is_array($search_list)){ ?>
    <?php foreach ($search_list as $i => $user) { ?>
    <li class="user-item">
        <a href="<?=$user["user_page_url"]?>" class="user-item-link" target="_blank">
            <img src="<?=$user["user_img"]?>" alt="프로필 이미지" class="user-item-img" width="54" height="54">
        </a>

        <div class="user-item-info">
            <div class="user-item-info-inner-box">
                <a href="<?=$user["user_page_url"]?>" class="user-item-nick" target="_blank"><?=$user["user_nick"]?></a>
                <?php if($user["user_field"]){ ?>
                <span class="user-item-field"><?=$user["user_field"]?></span>
                <?php }?>

            </div>
            <?php if($user["user_follow"]["is_follow_display"]){ ?>
                <?php if($user["user_follow"]["is_follow"]){ ?>
                <button type="button" class="user-item-follow-button follow-button button-t3 button-s4" data-user="<?=$user["user_code"]?>">팔로우 취소</button>
                <?php }else{ ?>
                <button type="button" class="user-item-follow-button follow-button button-t1 button-s4" data-user="<?=$user["user_code"]?>">팔로우</button>
                <?php } ?>
            <?php } ?>
        </div>
    </li>
    <?php }?>
<?php }else{ ?>
    <?php if($search_page == 1){ ?>
    <li class="user-item-empty">
        <img src="<?=get_url(PAVE_IMG_URL,"img_empty_default_640px.png")?>" alt="검색없음 이미지" width="240" height="240" usemap="#author" class="user-item-empty-img">
        <map name="author">
        <area shape="rect" coords="40,200,92,212" alt="jearth._.k" href="https://www.instagram.com/jearth._.k" target="_blank">
        </map>
        <p class="user-item-empty-text">"<?=$search_keyword?>" 작가님이 없습니다.</p>
    </li>
    <?php } ?>
<?php }?>
