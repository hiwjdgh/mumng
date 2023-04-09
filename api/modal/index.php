<?php
include_once(PAVE_API_PATH."/modal/_common.php");

switch ($modal_id) {
    case "user_img":
        include_once(PAVE_API_PATH."/modal/user_img_modal.php");
        break;
    case "user_field":
        include_once(PAVE_API_PATH."/modal/user_field_modal.php");
        break;
    case "user_major":
        include_once(PAVE_API_PATH."/modal/user_major_modal.php");
        break;
    case "user_follow":
        include_once(PAVE_API_PATH."/modal/user_folow_modal.php");
        break;
    case "charge_payment":
        include_once(PAVE_API_PATH."/modal/charge_payment_modal.php");
        break;
    case "charge_payment_cancel":
        include_once(PAVE_API_PATH."/modal/charge_payment_cancel_modal.php");
        break;
    case "charge_pay_cancel":
        include_once(PAVE_API_PATH."/modal/charge_pay_cancel_modal.php");
        break;
    case "charge_receipt_detail":
        include_once(PAVE_API_PATH."/modal/charge_receipt_detail_modal.php");
        break;
    case "charge_pay_detail":
        include_once(PAVE_API_PATH."/modal/charge_pay_detail_modal.php");
        break;
    case "upload_work_with":
        include_once(PAVE_API_PATH."/modal/upload_work_with_modal.php");
        break;
    case "upload_work_guide":
        include_once(PAVE_API_PATH."/modal/upload_work_guide_modal.php");
        break;
    case "work_description":
        include_once(PAVE_API_PATH."/modal/work_description_modal.php");
        break;
    case "work_epsd_pay":
        include_once(PAVE_API_PATH."/modal/work_epsd_pay_modal.php");
        break;
    case "work_cmt":
        include_once(PAVE_API_PATH."/modal/work_cmt_modal.php");
        break;
    case "work_epsd_caution":
        include_once(PAVE_API_PATH."/modal/work_epsd_caution_modal.php");
        break;
    case "work_epsd_comment":
        include_once(PAVE_API_PATH."/modal/work_epsd_comment_modal.php");
        break;
    case "commerce_calc":
        include_once(PAVE_API_PATH."/modal/commerce_calc_modal.php");
        break;
    case "commerce_calc_detail":
        include_once(PAVE_API_PATH."/modal/commerce_calc_detail_modal.php");
        break;
    case "commerce_reg":
        include_once(PAVE_API_PATH."/modal/commerce_reg_modal.php");
        break;
    case "penalty":
        include_once(PAVE_API_PATH."/modal/penalty_modal.php");
        break;
    case "sight_form":
        include_once(PAVE_API_PATH."/modal/sight_form_modal.php");
        break;
    default:
        die(return_json(null, "200", "비정상적인 접근입니다."));
        break;
}
?>