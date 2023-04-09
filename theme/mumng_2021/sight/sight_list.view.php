<?php
if (!defined('_PAVE_')) exit;
?>
<section class="sight-container">
    <div class="sight-header">
        <ul class="sight-header__filter">
            <li class="sight-header__filter-item current" data-type="">발견</li>
            <?php if($is_user){ ?>
            <li class="sight-header__filter-item" data-type="follow">팔로잉</li>
            <?php } ?>
        </ul>
    </div>

    <ul class="sight-list"></ul>
</section>
<script>
$(function(){
    sight_obj.init($(".sight-list"));
    sight_obj.get_sight_list();
});
</script>