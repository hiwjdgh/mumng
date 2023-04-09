<?php
if (!defined('_PAVE_')) exit;
?>
<div class="container">
    <section class="user_creation">
        <aside class="navbar left">
            <nav class="navbar__box">
                <a href="<?=get_url(PAVE_USER_URL, "creation/ask/all")?>" class="navbar__title">내 창작</a>
                <button type="button" class="collapse-button" data-anchor="user_creation" data-collapse="toggle">
                    <span class="icon-hamburger"></span>
                </button>
                <div class="collapse-content show">
                    <ul class="navbar__nav">
                        <li>
                            <a href="<?=get_url(PAVE_USER_URL, "creation/ask/all")?>" class="navbar__link <?=$request[2] == "ask" ? "current" : "" ?>">의뢰한 창작물</a>
                            <ul class="navbar__nav2">
                                <li>
                                    <a href="<?=get_url(PAVE_USER_URL, "creation/ask/all")?>" class="navbar__link2 <?=$request[3] == "all" ? "current" : "" ?>">전체 <span class="badge badge--t1"><?=Converter::display_number_format(array_sum($creation_state_list))?></span></a>
                                </li>
                                <li>
                                    <a href="<?=get_url(PAVE_USER_URL, "creation/ask/recruit")?>" class="navbar__link2 <?=$request[3] == "recruit" ? "current" : "" ?>">모집중 <span class="badge badge--t1"><?=Converter::display_number_format($creation_state_list["recruit"])?></span></a>
                                </li>
                                <li>
                                    <a href="<?=get_url(PAVE_USER_URL, "creation/ask/wait")?>" class="navbar__link2 <?=$request[3] == "wait" ? "current" : "" ?>">선정대기 <span class="badge badge--t1"><?=Converter::display_number_format($creation_state_list["wait"])?></span></a>
                                </li>
                                <li>
                                    <a href="<?=get_url(PAVE_USER_URL, "creation/ask/ongoing")?>" class="navbar__link2 <?=$request[3] == "ongoing" ? "current" : "" ?>">작업중 <span class="badge badge--t1"><?=Converter::display_number_format($creation_state_list["ongoing"])?></span></a>
                                </li>
                                <li>
                                    <a href="<?=get_url(PAVE_USER_URL, "creation/ask/complete")?>" class="navbar__link2 <?=$request[3] == "complete" ? "current" : "" ?>">작업완료 <span class="badge badge--t1"><?=Converter::display_number_format($creation_state_list["complete"])?></span></a>
                                </li>
                                <li>
                                    <a href="<?=get_url(PAVE_USER_URL, "creation/ask/cancel")?>" class="navbar__link2 <?=$request[3] == "cancel" ? "current" : "" ?>">취소 <span class="badge badge--t1"><?=Converter::display_number_format($creation_state_list["cancel"])?></span></a>
                                </li>
                                <li>
                                    <a href="<?=get_url(PAVE_USER_URL, "creation/ask/expired")?>" class="navbar__link2 <?=$request[3] == "expired" ? "current" : "" ?>">마감 <span class="badge badge--t1"><?=Converter::display_number_format($creation_state_list["expired"])?></span></a>
                                </li>
                                <li>
                                    <a href="<?=get_url(PAVE_USER_URL, "creation/ask/ready")?>" class="navbar__link2 <?=$request[3] == "ready" ? "current" : "" ?>">임시저장 <span class="badge badge--t3"><?=Converter::display_number_format($creation_state_list["ready"])?></span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?=get_url(PAVE_USER_URL, "creation/participate/all")?>" class="navbar__link <?=$request[2] == "participate" ? "current" : "" ?>">참여한 창작물</a>
                            <ul class="navbar__nav2">
                                <li>
                                    <a href="<?=get_url(PAVE_USER_URL, "creation/participate/all")?>" class="navbar__link2 <?=$request[3] == "all" ? "current" : "" ?>">전체</a>
                                </li>
                                <li>
                                    <a href="<?=get_url(PAVE_USER_URL, "creation/participate/ready")?>" class="navbar__link2 <?=$request[3] == "ready" ? "current" : "" ?>">대기</a>
                                </li>
                                <li>
                                    <a href="<?=get_url(PAVE_USER_URL, "creation/participate/ongoing")?>" class="navbar__link2 <?=$request[3] == "ongoing" ? "current" : "" ?>">작업중</a>
                                </li>
                                <li>
                                    <a href="<?=get_url(PAVE_USER_URL, "creation/participate/complete")?>" class="navbar__link2 <?=$request[3] == "complete" ? "current" : "" ?>">작업완료</a>
                                </li>
                                <li>
                                    <a href="<?=get_url(PAVE_USER_URL, "creation/participate/cancel")?>" class="navbar__link2 <?=$request[3] == "cancel" ? "current" : "" ?>">취소</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </aside>
        <main class="user_creation__content">
            <section class="user_creation__content-header">
                <h2 class="user_creation__content-title">의뢰한 창작물</h2>
                <p class="user_creation__content-description">의뢰한 창작물 관리를 할 수 있어요.</p>
            </section>

            <div class="user_creation__list">
                <?php include_once($pave_theme["thm_path"]."/user_creation_item.view.php"); ?>
            </div>
        </main>
    </section>
</div>
<script>
    $(function(){
        creation_admin_obj.init();
    });
</script>