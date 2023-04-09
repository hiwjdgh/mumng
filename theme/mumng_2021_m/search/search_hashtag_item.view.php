<?php
if (!defined('_PAVE_')) exit;
?>
<?php if(pave_is_array($search_list)){ ?>
    <?php foreach ($search_list as $i => $hashtag) { ?>
    <li class="hashtag-item">
        <a href="<?=$hashtag["tags_url"]?>" class="hashtag-item-link">
            <img src="<?=get_url(PAVE_IMG_URL, "img_hashtag_96px.png")?>" alt="해시태그 이미지" class="hashtag-item-img">
            <div class="hashtag-item-info">
                <span class="hashtag-item-name"><?=$hashtag["hashtag_name"]?></span>
                <span class="hashtag-item-cnt"><?=Converter::display_number_format($hashtag["hashtag_cnt"], "개")?></span>
            </div>
        </a>
    </li>
    <?php }?>
<?php }else{ ?>
    <?php if($search_page == 1){ ?>
    <li class="hashtag-item-empty">
        <img src="<?=get_url(PAVE_IMG_URL,"img_empty_default_640px.png")?>" alt="검색없음 이미지" width="240" height="240" usemap="#author" class="hashtag-item-empty-img">
        <map name="author">
        <area shape="rect" coords="40,200,92,212" alt="jearth._.k" href="https://www.instagram.com/jearth._.k" target="_blank">
        </map>
        <p class="hashtag-item-empty-text">"<?=$search_keyword?>" 해시태그가 없습니다.</p>
    </li>
    <?php } ?>
<?php }?>