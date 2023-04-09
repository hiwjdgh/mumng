<?php
if (!defined('_PAVE_')) exit;
?>
<section class="sight-container">
    <ul class="sight-list"></ul>
</section>
<script>
$(function(){
    sight_obj.init($(".sight-list"));
    sight_obj.get_sight_list();
});
</script>