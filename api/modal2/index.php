<?php
include_once(PAVE_API_PATH."/modal2/_common.php");

switch ($modal_id) {
    case "user_img":
        include_once(PAVE_API_PATH."/modal2/user_img_modal.php");
        break;
    case "user_field":
        include_once(PAVE_API_PATH."/modal2/user_field_modal.php");
        break;
    case "user_major":
        include_once(PAVE_API_PATH."/modal2/user_major_modal.php");
        break;
    case "user_follow":
        include_once(PAVE_API_PATH."/modal2/user_follow_modal.php");
        break;
    case "user_follow":
        include_once(PAVE_API_PATH."/modal2/user_follow_modal.php");
        break;
    case "sight_form":
        include_once(PAVE_API_PATH."/modal2/sight_form_modal.php");
        break;
    case "user_share":
        include_once(PAVE_API_PATH."/modal2/user_share_modal.php");
        break;
    case "epsd_detail":
        include_once(PAVE_API_PATH."/modal2/epsd_detail_modal.php");
        break;
    case "work_detail":
        include_once(PAVE_API_PATH."/modal2/work_detail_modal.php");
        break;
    case "work_description":
        include_once(PAVE_API_PATH."/modal2/work_description_modal.php");
        break;
    case "work_comment":
        include_once(PAVE_API_PATH."/modal2/work_comment_modal.php");
        break;
    case "work_epsd_pay":
        include_once(PAVE_API_PATH."/modal2/work_epsd_pay_modal.php");
        break;
    case "work_epsd_caution":
        include_once(PAVE_API_PATH."/modal2/work_epsd_caution_modal.php");
        break;
    case "charge_exp":
        include_once(PAVE_API_PATH."/modal2/charge_exp_modal.php");
        break;
    case "cancel_exp":
        include_once(PAVE_API_PATH."/modal2/cancel_exp_modal.php");
        break;
    case "charge_receipt_detail":
        include_once(PAVE_API_PATH."/modal2/charge_receipt_detail_modal.php");
        break;
    case "charge_pay_detail":
        include_once(PAVE_API_PATH."/modal2/charge_pay_detail_modal.php");
        break;
    case "cancel_pay":
        include_once(PAVE_API_PATH."/modal2/cancel_pay_modal.php");
        break;
    case "commerce_reg":
        include_once(PAVE_API_PATH."/modal2/commerce_reg_modal.php");
        break;
    case "commerce_calc":
        include_once(PAVE_API_PATH."/modal2/commerce_calc_modal.php");
        break;
    case "upload_work_with":
        include_once(PAVE_API_PATH."/modal2/upload_work_with_modal.php");
        break;
    case "upload_work_guide":
        include_once(PAVE_API_PATH."/modal2/upload_work_guide_modal.php");
        break;
    case "creation_temp":
        include_once(PAVE_API_PATH."/modal2/creation_temp_modal.php");
        break;
    case "creation_temp_complete":
        include_once(PAVE_API_PATH."/modal2/creation_temp_complete_modal.php");
        break;
    case "creation_temp_list":
        include_once(PAVE_API_PATH."/modal2/creation_temp_list_modal.php");
        break;
    case "creation_dashboard":
        include_once(PAVE_API_PATH."/modal2/creation_dashboard_modal.php");
        break;
    default:
        die(return_json(null, "200", "잘못된 요청 입니다."));
        break;
}
?>