<?php
if($_SESSION['csrf_token'] != $csrf){
    alert("비정상적인 접근입니다.", PAVE_URL);
}

$epsd_list           = pave_input_sanitize($epsd);

foreach ((array)$epsd_list as $key => $epsd) {
    $update = array(
        "epsd_no_type_use"      => $epsd["epsd_no_type_use"],
        "epsd_no_type"          => pave_implode($epsd["epsd_no_type"], ","),
        "epsd_name_use"         => $epsd["epsd_name_use"],
        "epsd_name_min_len"     => $epsd["epsd_name_min_len"],
        "epsd_name_max_len"     => $epsd["epsd_name_max_len"],
        "epsd_copy_use"         => $epsd["epsd_copy_use"],
        "epsd_content_use"      => $epsd["epsd_content_use"],
        "epsd_content_min_len"  => $epsd["epsd_content_min_len"],
        "epsd_content_max_len"  => $epsd["epsd_content_max_len"],
        "epsd_eplg_use"         => $epsd["epsd_eplg_use"],
        "epsd_eplg_max_len"     => $epsd["epsd_eplg_max_len"],
        "epsd_cmt_use"          => $epsd["epsd_cmt_use"],
        "epsd_cmt_max_len"      => $epsd["epsd_cmt_max_len"]
    );
    
    pave_update("pave_cf_epsd", $update, "epsd_cate = '{$key}'");
}

url_move(get_url(PAVE_ADM_URL, "config/epsd/form"));
?>