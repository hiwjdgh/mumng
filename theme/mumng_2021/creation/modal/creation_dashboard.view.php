<?php
if (!defined('_PAVE_')) exit;
?>
<div id="modal" class="modals creation_dashboard_modal" data-target="creation_dashboard_modal">
    <div class="modals__box">
        <div class="modals__header">
            <h2 class="modals__title"><?=$modal_title?></h2>
            <button type="button" class="modal-close-button modals__close-button" data-anchor="creation_dashboard_modal"><span class="icon-x icon-16"></span><span class="skip">닫기</span></button>
        </div>
        <div class="modals__content">
            <div class="creation_dashboard">
                <h2 class="text-size-lg mgb-6">작업자 선정</h2>
                <p class="text-size-xsmall mgb-12">작업자를 클릭하여 창작물을 확인한 후 의뢰맡길분을 선정해주세요.</p>
                <div class="creation_dashboard__request-list list w-100 bd-1-solid-g4 bdrd-6 mgb-24">
                    <?php foreach ((array)$request_list as $i => $request) { ?>
                    <a href="<?=$request["request_user"]["user_page_url"]?>" class="flex flex-align-item-center bdb-1-solid-g4 pd-16" target="_blank">
                        <div class="user lg">
                            <div class="user__link">
                                <div class="user__img-box">
                                    <img src="<?=$request["request_user"]["user_img"]?>" alt="" class="user__img">
                                </div>
                                <div>
                                    <p class="user__nick"><?=$request["request_user"]["user_nick"]?></p>
                                    <p class="user__field">창작 <?=$request["request_user"]["request_cnt"]?>건</p>
                                </div>
                            </div>
                            <button type="button" class="creation-select-button button-t1 button-s4" data-request="<?=$request["creation_request_no"]?>"><?=Converter::display_number($request["creation_request_exp"])?> EXP로 작업자 선정</button>
                        </div>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

