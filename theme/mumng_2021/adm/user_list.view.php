<?php
if (!defined('_PAVE_')) exit;
?>

<div class="adm-content__header flex flex-column gap-row-12">
    <div class="flex flex-justify-content-space-between flex-align-item-center">
        <h1 class="adm-content__header__title"><?=$adm_title?></h1>
    
        <div class="flex flex-align-item-center gap-column-8">
            <form class="adm-list__delete-form" action="<?=get_url(PAVE_ADM_URL, "user/delete")?>" method="post" onsubmit="return delete_form_check(this);" enctype="multipart/form-data" novalidate autocomplete="off">
                <input type="hidden" name="temp" value="">
                <button type="submit" class="button-t2 button-s2">삭제</button>
            </form>
            <a href="<?=get_url(PAVE_ADM_URL,"user/form")?>" class="button-t1 button-s2">가계정 생성</a>
        </div>
    </div>

    <form class="adm-list__form" action="<?=get_url(PAVE_ADM_URL, "user/list")?>" method="get" enctype="multipart/form-data" novalidate autocomplete="off">
        <input type="hidden" name="page" id="page" value="<?=$page?>">

        <div class="flex flex-column gap-row-12">
            <div class="flex flex-align-item-center flex-justify-content-space-between">
                <div class="flex gap-column-8">
                    <div class="flex flex-align-item-center">
                        <span class="bg-g12 text-color-white pd-4 bdrdl-4 text-size-xsmall">전체회원수</span>    
                        <span class="bg-g4 text-color-g12 pd-4 bdrdr-4 text-size-xsmall"><?=Converter::display_number($total_user_list_cnt, "명")?></span>
                    </div>
                    <div class="flex">
                        <span class="bg-g12 text-color-white pd-4 bdrdl-4 text-size-xsmall">일반회원수</span>    
                        <span class="bg-g4 text-color-g12 pd-4 bdrdr-4 text-size-xsmall"><?=Converter::display_number($normal_user_list_cnt, "명")?></span>
                    </div>
                    <div class="flex">
                        <span class="bg-g12 text-color-white pd-4 bdrdl-4 text-size-xsmall">가계정회원수</span>    
                        <span class="bg-g4 text-color-g12 pd-4 bdrdr-4 text-size-xsmall"><?=Converter::display_number($temp_user_list_cnt, "명")?></span>
                    </div>
                    <div class="flex">
                        <span class="bg-g12 text-color-white pd-4 bdrdl-4 text-size-xsmall">커머스회원수</span>    
                        <span class="bg-g4 text-color-g12 pd-4 bdrdr-4 text-size-xsmall"><?=Converter::display_number($commerce_user_list_cnt, "명")?></span>
                    </div>
                    <div class="flex">
                        <span class="bg-g12 text-color-white pd-4 bdrdl-4 text-size-xsmall">탈퇴회원수</span>    
                        <span class="bg-g4 text-color-g12 pd-4 bdrdr-4 text-size-xsmall"><?=Converter::display_number($leave_user_list_cnt, "명")?></span>
                    </div>
                    <div class="flex">
                        <span class="bg-g12 text-color-white pd-4 bdrdl-4 text-size-xsmall">차단회원수</span>    
                        <span class="bg-g4 text-color-g12 pd-4 bdrdr-4 text-size-xsmall"><?=Converter::display_number($block_user_list_cnt, "명")?></span>
                    </div>
                </div>
              
            </div>
            <table class="data-search-table">
                <tbody class="data-search-table__body">
                    <tr class="data-search-table__body-row">
                        <th class="data-search-table__body-header">분류</th>
                        <td class="data-search-table__body-col">
                            <div class="flex gap-column-8 mxw-2">
                                <div class="select-box-t2">
                                    <select name="search_field" id="search_field" class="select-box-t2__select" title="사용자 검색 구분">
                                        <option value="user_id" <?=get_selected("user_id", $search_field)?>>회원ID</option>
                                        <option value="user_nick" <?=get_selected("user_nick", $search_field)?>>필명</option>
                                    </select>
                                </div>

                                <div class="input-box input-box-t4">
                                    <input type="text" name="search_keyword" id="search_keyword" class="input-box-t4__input" value="<?=$search_keyword?>" placeholder="검색">
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="flex gap-column-8 flex-justify-content-flex-end">
                <a href="<?=get_url(PAVE_ADM_URL, "user/list")?>" class="button-t2 button-s2">초기화</a>
                <button type="submit" class="button-t1 button-s2">검색</button>
            </div>
        </div>
    </form>

    
</div>

<div class="flex flex-column gap-row-24 mg-20">
    
    <table class="data-table">
        <thead class="data-table__head">
            <tr class="data-table__head-row">
                <th class="data-table__head-col check nosort">
                    <span class="data-table__head-col-text">
                        <label for="adm_check_all" class="check-box">
                            <input type="checkbox" name="adm_check_all" id="adm_check_all" class="check-box__check" value="1">
                            <span class="check-box__span"></span>
                        </label>
                    </span>
                </th>
                <th class="data-table__head-col nosort">
                    <span class="data-table__head-col-text">회원 ID</span>
                </th>
                <th class="data-table__head-col nosort">
                    <span class="data-table__head-col-text">필명</span>
                </th>
                <th class="data-table__head-col nosort">
                    <span class="data-table__head-col-text">이름</span>
                </th>
                <th class="data-table__head-col nosort">
                    <span class="data-table__head-col-text">성별</span>
                </th>
                <th class="data-table__head-col nosort">
                    <span class="data-table__head-col-text">보유 EXP</span>
                </th>
                <th class="data-table__head-col nosort">
                    <span class="data-table__head-col-text">생년월일</span>
                </th>
                <th class="data-table__head-col nosort">
                    <span class="data-table__head-col-text">휴대폰번호</span>
                </th>
                <th class="data-table__head-col nosort">
                    <span class="data-table__head-col-text">본인인증여부</span>
                </th>
                <th class="data-table__head-col nosort">
                    <span class="data-table__head-col-text">성인여부</span>
                </th>
                <th class="data-table__head-col nosort">
                    <span class="data-table__head-col-text">가입일</span>
                </th>
                <th class="data-table__head-col nosort">
                    <span class="data-table__head-col-text">상세보기</span>
                </th>
            </tr>
        </thead>
        <tbody class="data-table__body">
            <?php if(pave_is_array($user_list)){ ?>
                <?php foreach ($user_list as $i => $user) { ?>
                <tr class="data-table__body-row">
                    <td class="data-table__body-col">
                        <label for="adm_check_<?=$i?>" class="check-box">
                            <input type="checkbox" name="adm_check[]" id="adm_check_<?=$i?>" class="check-box__check" value="<?=$user["user_id"]?>">
                            <span class="check-box__span"></span>
                        </label>
                    </td>
                    <td class="data-table__body-col"><?=$user["user_id"]?></td>
                    <td class="data-table__body-col">
                        <a href="<?=$user["user_page_url"]?>" class="flex flex-align-item-center" target="_blank">
                            <img src="<?=$user["user_img"]?>" alt="프로필 이미지" class="bdrd-50 bd-1-solid-g4 mgr-12" width="40" height="40">
                            <span class="text-weight-bold <?=$user["user_leave_state"]? "text-color-error text-decoration-line-through" : ""?>"><?=$user["user_nick"]?><?=$user["user_temporary_state"]? "(가계정)" : ""?><?=$user["user_leave_state"]? "(탈퇴)" : ""?></span>
                        </a>
                    </td>
                    <td class="data-table__body-col"><?=$user["user_name"]?></td>
                    <td class="data-table__body-col"><?=$user["user_sex_text"]?></td>
                    <td class="data-table__body-col"><?=Converter::display_number($user["user_exp"], "EXP")?></td>
                    <td class="data-table__body-col"><?=$user["user_birth_date"]?></td>
                    <td class="data-table__body-col"><?=Converter::add_hyphen_cp($user["user_cp"])?></td>
                    <td class="data-table__body-col">
                        <?php if($user["user_cp_cert_state"]){ 
                            echo "🟢";
                        }else{
                            echo "❌";
                        }
                        ?>
                    </td>
                    <td class="data-table__body-col">
                        <?php if($user["user_adult_cert_state"]){ 
                            echo "🟢";
                        }else{
                            echo "❌";
                        }
                        ?>
                    </td>
                    <td class="data-table__body-col"><?=$user["user_insert_dt"]?></td>
                    <td class="data-table__body-col"><a href="<?=get_url(PAVE_ADM_URL,"user/form?search_field={$search_field}&search_keyword={$search_keyword}&page={$page}&user_id={$user["user_id"]}")?>" class="button-t1 button-s3">상세보기</a></td>
                </tr>
            <?php } ?>
            <?php }else{ ?>
            <tr>
                <td colspan="12" class="data-table__body-col empty">회원 내역이 없습니다.</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php if($pagination["total_page"] > 1){ ?>
    <ul id="charge__content_pagination" class="pagination">
        <li class="pagination__prev <?=$pagination["prev_page"] < 1 ? "hidden" : ""?>">
            <a href="<?=get_url(PAVE_ADM_URL, "user/list?search_field={$search_field}&search_keyword={$search_keyword}&page={$pagination["prev_page"]}")?>">이전</a>
        </li>
        <?php for ($i = $pagination["from_page"]; $i <= $pagination["to_page"] ; $i++) { ?>
        <li class="pagination__item <?=$pagination["page"] == $i ? "current" : ""?>">
            <a href="<?=get_url(PAVE_ADM_URL, "user/list?search_field={$search_field}&search_keyword={$search_keyword}&page={$i}")?>"><?=$i?></a>
        </li>
        <?php } ?>
        <li class="pagination__next <?=$pagination["next_page"] < 1 ? "hidden" : ""?>">
            <a href="<?=get_url(PAVE_ADM_URL, "user/list?search_field={$search_field}&search_keyword={$search_keyword}&page={$pagination["next_page"]}")?>">다음</a>
        </li>
    </ul>
    <?php } ?>
</div>
