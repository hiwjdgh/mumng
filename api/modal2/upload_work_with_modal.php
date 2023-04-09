<?php
$pave_theme = get_theme("upload");

$return = array(
    "title"     => $modal_title
);

$data = json_decode(stripslashes($data), true);
$work_with_list = $data["work_with_list"];
$work_with_list = pave_implode(pave_explode($work_with_list, ","), "','");

if($work_with_list){
    $obj = new Objects2();
    $obj->generate_sql_init()
    ->set_sql_common("SELECT user.user_no, user.user_img, user.user_nick, user.user_field, user.user_share FROM pave_user AS user")
    ->set_sql_where("user.user_no IN ('{$work_with_list}')");
    
    $with_list = array();
    $result = pave_query($obj->generate_sql());
    for ($i=0; $row = pave_fetch_assoc($result) ; $i++) { 
        $row["user_page_url"] = get_url(PAVE_PAGE_URL, $row["user_share"]);
        $with_list[] = $row;
    }
}


$theme_path = $pave_theme["thm_path"]."/modal/work_with.view.php";
if(!is_file($theme_path) || !file_exists($theme_path)){
    die(return_json(null, "200", "해당 파일을 찾을 수 없습니다."));
}
ob_start();
include_once($theme_path);
$return["html"] = ob_get_contents();
ob_end_clean();

die(return_json($return, "success"));
?>