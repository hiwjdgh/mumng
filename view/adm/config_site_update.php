<?php
if($_SESSION['csrf_token'] != $csrf){
    alert("비정상적인 접근입니다.", PAVE_URL);
}
$pave_tit                   = pave_input_sanitize($pave_tit);
$pave_description           = pave_input_sanitize($pave_description);
$pave_keyword               = pave_input_sanitize($pave_keyword);
$pave_prohibit_word         = pave_input_sanitize($pave_prohibit_word);
$pave_slang_word            = pave_input_sanitize($pave_slang_word);
$pave_adm                   = pave_input_sanitize($pave_adm);
$pave_adm_email             = pave_input_sanitize($pave_adm_email);
$pave_anly                  = $pave_anly;
$pave_robot                 = $pave_robot;
$pave_test                  = pave_input_sanitize($pave_test);
$pave_co_name               = pave_input_sanitize($pave_co_name);
$pave_co_own                = pave_input_sanitize($pave_co_own);
$pave_co_bsns_num           = pave_input_sanitize($pave_co_bsns_num);
$pave_co_addr               = pave_input_sanitize($pave_co_addr);
$pave_co_addr_zip           = pave_input_sanitize($pave_co_addr_zip);
$pave_co_addr_load          = pave_input_sanitize($pave_co_addr_load);
$pave_co_addr_jibun         = pave_input_sanitize($pave_co_addr_jibun);
$pave_co_addr_detail        = pave_input_sanitize($pave_co_addr_detail);
$pave_co_addr_extra         = pave_input_sanitize($pave_co_addr_extra);
$pave_co_cp                 = pave_input_sanitize($pave_co_cp);
$pave_co_tel                = pave_input_sanitize($pave_co_tel);
$pave_co_fax                = pave_input_sanitize($pave_co_fax);
$pave_co_telemarket_num     = pave_input_sanitize($pave_co_telemarket_num);
$pave_co_cpo_name           = pave_input_sanitize($pave_co_cpo_name);



$update = array(
    "pave_tit"                  => $pave_tit,
    "pave_description"          => $pave_description,
    "pave_keyword"              => $pave_keyword,
    "pave_prohibit_word"        => $pave_prohibit_word,
    "pave_slang_word"           => $pave_slang_word,
    "pave_adm"                  => $pave_adm,
    "pave_adm_email"            => $pave_adm_email,
    "pave_anly"                 => $pave_anly,
    "pave_robot"                => $pave_robot,
    "pave_test"                 => $pave_test,
    "pave_co_name"              => $pave_co_name,
    "pave_co_own"               => $pave_co_own,
    "pave_co_bsns_num"          => $pave_co_bsns_num,
    "pave_co_addr"              => $pave_co_addr,
    "pave_co_addr_zip"          => $pave_co_addr_zip,
    "pave_co_addr_load"         => $pave_co_addr_load,
    "pave_co_addr_jibun"        => $pave_co_addr_jibun,
    "pave_co_addr_detail"       => $pave_co_addr_detail,
    "pave_co_addr_extra"        => $pave_co_addr_extra,
    "pave_co_cp"                => $pave_co_cp,
    "pave_co_tel"               => $pave_co_tel,
    "pave_co_fax"               => $pave_co_fax,
    "pave_co_telemarket_num"    => $pave_co_telemarket_num,
    "pave_co_cpo_name"          => $pave_co_cpo_name
);

pave_update("pave_cf", $update, "1");

url_move(get_url(PAVE_ADM_URL, "config/site/form"));
?>