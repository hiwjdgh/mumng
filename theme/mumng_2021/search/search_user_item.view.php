<?php
if (!defined('_PAVE_')) exit;
?>
<?php if(pave_is_array($search_list)){ ?>
    <?php foreach ($search_list as $i => $user) { ?>
    <li class="user-item">
        <a href="<?=$user["user_page_url"]?>" class="user-item-link" target="_blank">
            <img src="<?=$user["user_img"]?>" alt="프로필 이미지" class="user-item-img width="96" height="96">
        </a>

        <div class="user-item-info">
            <a href="<?=$user["user_page_url"]?>" class="user-item-nick" target="_blank"><?=$user["user_nick"]?></a>
            <span class="user-item-field"><?=$user["user_field"]?></span>
            <div class="user-item-follow-box">
                <button type="button" class="user-item-follower-button follower-button" data-user="<?=$user["user_no"]?>">
                    <span class="user-item-follower-text">팔로워</span>
                    <span class="user-item-follower-cnt"><?=Converter::display_number_format($user["user_follow"]["follower_cnt"]) ?></span>
                </button>

                <div class="line-vertical-g7-mhz-10"></div>

                <button type="button" class="user-item-following-button following-button" data-user="<?=$user["user_no"]?>">
                    <span class="user-item-following-text">팔로잉</span>
                    <span class="user-item-following-cnt"><?=Converter::display_number_format($user["user_follow"]["following_cnt"]) ?></span>
                </button>
                <?php if($user["user_follow"]["is_follow_display"]){ ?>
                    <?php if($user["user_follow"]["is_follow"]){ ?>
                    <button type="button" class="user-item-follow-button follow-button button-t3 button-s2" data-user="<?=$user["user_no"]?>">팔로우 취소</button>
                    <?php }else{ ?>
                    <button type="button" class="user-item-follow-button follow-button button-t1 button-s2" data-user="<?=$user["user_no"]?>">팔로우</button>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <?php if($user["user_major"]){ ?>
        <a href="<?=$user["user_major"]["work_url"]?>" class="user-item-major-box" target="_blank">
            <img src="<?=$user["user_major"]["work_img"]?>" alt="대표작품 이미지" width="90" height="112" class="user-item-major-img">
            <div class="user-item-major-inner-box">
                <span class="user-item-major-epsd">총 <?=Converter::display_number($user["user_major"]["work_epsd_cnt"], "화") ?></span>
                <span class="user-item-major-name text-truncate" ><?=$user["user_major"]["work_name"]?></span>
                <p class="user-item-major-description text-truncate-line3"><?=$user["user_major"]["work_description"]?></p>
            </div>
        </a>
        <?php } ?>
    </li>
    <?php }?>
<?php }else{ ?>
    <?php if($search_page == 1){ ?>
    <li class="user-item-empty">
        <img src="<?=get_url(PAVE_IMG_URL,"img_empty_default_640px.png")?>" alt="검색없음 이미지" width="360" height="360" usemap="#author" class="user-item-empty-img">
        <map name="author">
        <area shape="rect" coords="63,306,136,320" alt="jearth._.k" href="https://www.instagram.com/jearth._.k" target="_blank">
        </map>
        <p class="user-item-empty-text">"<?=$search_keyword?>" 작가님이 없습니다.</p>
    </li>
    <?php } ?>
<?php }?>
