<?php
if (!defined('_PAVE_')) exit;
?>
<div class="fab-container">
    <button type="button" class="fab-button">
        <span class="icon icon-white-plus icon-24"></span>
    </button>
    <ul class="fab-option">
        <li class="fab-option-item">
            <button type="button" class="button-t1 button-s2 upload-sight-button" data-action="create">창작물 등록</button>
        </li>
        <li class="fab-option-item">
            <a href="<?=get_url(PAVE_UPLOAD_URL, "home")?>" class="button-t1 button-s2 add-work-button">원고 등록</a>
        </li>
    </ul>
</div>