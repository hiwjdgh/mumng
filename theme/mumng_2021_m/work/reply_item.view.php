<?php
if (!defined('_PAVE_')) exit;
?>
<?php foreach (array_reverse($comment_list) as $i => $comment) { ?>
<li class="cmt-item">
    <div class="cmt-item__box">
        <button type="button" class="cmt-item__more-button icon-button icon-button-24" >
            <span class="icon-more icon-24"></span>
        </button>

        <button type="button" class="cmt-item__more-button helper__button icon-button icon-button-24" data-anchor="comment_more_<?=$comment["comment_no"]?>_<?=$i?>" data-id="<?=$comment["work_id"]?>" data-epsd="<?=$comment["epsd_id"]?>" data-comment="<?=$comment["comment_no"]?>">
            <span class="icon-more icon-24"></span>
        </button>
        <div class="helper" data-target="comment_more_<?=$comment["comment_no"]?>_<?=$i?>">
            <div class="helper__container">
                <div id="helper__more-box" class="helper__action-box">
                    <button type="button" class="penalty-button helper__action-button" style="color:#E34850;" data-type="cmt" data-target="<?=$comment["comment_no"]?>">의견 신고</button>

                    <?php if($work["is_owner"] || $work["is_with"] || $comment["is_own"]){ ?>
                    <button type="button" class="cmt-delete helper__action-button" data-id="<?=$work["work_id"]?>" data-epsd="<?=$epsd["epsd_id"]?>" data-comment="<?=$comment["comment_no"]?>">의견 삭제</button>
                    <?php } ?>

                    <a href="<?=$comment["comment_user"]["user_page_url"]?>" class="helper__action-button" target="_blank">페이지</a>
                    <?php if($comment["comment_user"]["is_follow_display"]){ ?>
                        <?php if($comment["comment_user"]["is_follow"]){ ?>
                        <button type="button" class="follow-button helper__action-button" data-user="<?=$comment["comment_user"]["user_no"]?>">팔로우 취소</button>
                        <?php }else{ ?>
                        <button type="button" class="follow-button helper__action-button" data-user="<?=$comment["comment_user"]["user_no"]?>">팔로우</button>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="helper__close-box">
                    <button type="button" class="helper__close-button" data-anchor="comment_more_<?=$comment["comment_no"]?>_<?=$i?>">취소</button>
                </div>
            </div>
        </div>

        <button type="button" class="cmt-item__like-button comment-like-button icon-button icon-button-32 icon-button-circle" data-comment="<?=$comment["comment_no"]?>" data-like="<?=$comment["comment_like"]?>">
            <?php if($comment["is_like"]){ ?>
            <span class="icon-like icon-like--active icon-16"></span>
            <?php }else{ ?>
            <span class="icon-like icon-like--inactive icon-16"></span>
            <?php } ?>
        </button>
        
        <a href="<?=$comment["comment_user"]["user_page_url"]?>" class="cmt-item__user">
            <img src="<?=$comment["comment_user"]["user_img"]?>" alt="의견작성자 프로필" class="cmt-item__user-img" width="20" height="20">
            <span class="cmt-item__user-nick text text-truncate"><?=$comment["comment_user"]["user_nick"]?></span>
        </a>


        <div class="cmt-item__content-box">
            <?php if($comment["is_best"]){ ?>
            <span class="cmt-item__badge best-badge">BEST</span>
            <?php } ?>
            <p class="cmt-item__text"><?=$comment["comment_content"]?></p>
        </div>
        
        <div class="cmt-item__info-box">
            <span class="cmt-item__upload"><?=Converter::display_time_ago($comment["comment_insert_dt"])?></span>
            <span class="cmt-item__like">좋아요 <?=Converter::display_number_format($comment["comment_like"], "개")?></span>
            <button class="cmt-item__reply-button" data-mention="<?=$comment["comment_user"]["user_nick"]?>" data-comment="<?=$comment["comment_parent_no"]?>">의견쓰기</button>
        </div>
    </div>
</li>
<?php } ?>
