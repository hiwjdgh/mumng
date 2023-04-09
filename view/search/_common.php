<?php
define("__SEARCH__", true);
$pave_site = $config_obj->get_site($request[0]);
$pave_theme = get_theme("search");
$pave_html->add_css(get_url($pave_theme["thm_url"], "style.min.css"));

if(!$pave_site["site_use"]){
    alert("현재 해당 페이지를 이용할 수 없습니다.", get_url(PAVE_URL));
}

if($is_mobile){
    $pave_html->add_js(get_url(PAVE_LIB_WORK_URL, "js/mobile/work2.lib.js"));
    $pave_html->add_css(get_url(PAVE_LIB_WORK_URL, "css/mobile/work2.lib.min.css"));
}else{
    $pave_html->add_js(get_url(PAVE_LIB_WORK_URL, "js/work2.lib.js"));
    $pave_html->add_css(get_url(PAVE_LIB_WORK_URL, "css/work2.lib.min.css"));
}

$search_type = pave_input_sanitize($request[1]);
$search_keword = pave_input_sanitize($request[2]);


switch ($search_type) {
    case "webtoon":
        $tmp_title = "웹툰검색";
        break;
    case "user":
        $tmp_title = "작가검색";
        break;
    case "hashtag":
        $tmp_title = "해시태그검색";
        break;
    case "tags":
        $tmp_title = "태그검색";
        break;
}
$pave_meta["title2"] = ($search_keword ?:"추천")." - {$tmp_title}";
$pave_meta["url"] = get_url(PAVE_SEARCH_URL, "{$search_type}/{$search_keword}");
?>