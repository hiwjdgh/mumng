<?php
if (!defined('_PAVE_')) exit;
?>
<ul class="work_detail__epsd-pagination">
    <li class="work_detail__epsd-pagination-item">
        <button type="button" class="work-detail work_detail__epsd-pagination-prev epsd-pagination <?=$epsd_pagination["prev_page"] == 0 ? "readonly" : "" ?>" data-id="<?=$work["work_id"]?>" data-page="<?=$epsd_pagination["prev_page"]?>">이전</button>
    </li>
    <?php for ($i = $epsd_pagination["from_page"]; $i <= $epsd_pagination["to_page"] ; $i++) { ?>
        <li class="work_detail__epsd-pagination-item">
            <button type="button" class="work-detail work_detail__epsd-pagination-num epsd-pagination <?=$epsd_pagination["page"] == $i ? "current readonly" : ""?>" data-id="<?=$work["work_id"]?>" data-page="<?=$i?>"><?=$i?></button>
        </li>
    <?php } ?>
    <li class="work_detail__epsd-pagination-item">
        <button type="button" class="work-detail work_detail__epsd-pagination-next epsd-pagination <?=$epsd_pagination["next_page"] == 0 ? "readonly" : "" ?>" data-id="<?=$work["work_id"]?>" data-page="<?=$epsd_pagination["next_page"]?>">다음</button>
    </li>
</ul>
