<?php
if (!defined('_PAVE_')) exit;

/*************************************************************************
**
**  공통 함수 모음
**
*************************************************************************/
/************************************************************************************************************************
   쿠키 설정 함수 
************************************************************************************************************************/
function set_cookie($name, $value, $expire){
    setcookie(md5($name), base64_encode($value), PAVE_TIME + $expire, DIRECTORY_SEPARATOR);
}

/************************************************************************************************************************
   쿠키 가져오기 함수 
************************************************************************************************************************/
function get_cookie($name){
	$name = md5($name);
	return array_key_exists($name, $_COOKIE) ? base64_decode($_COOKIE[$name]) : false;
}

/************************************************************************************************************************
   세션 설정 함수 
************************************************************************************************************************/
function set_session($session_name, $value)
{
   $_SESSION[$session_name] = $value;
}


/************************************************************************************************************************
   세션 가져오기 함수 
************************************************************************************************************************/
function get_session($session_name)
{
    return isset($_SESSION[$session_name]) ? $_SESSION[$session_name] : '';
}

/************************************************************************************************************************
   페이지 이동 함수 
************************************************************************************************************************/
function url_move($url){
	$url = str_replace("&amp;", "&", $url);
	if (!headers_sent()){
        header('Location: '.$url);
	}else{
        echo '<script>';
        echo 'location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'">';
        echo '</noscript>';
    }
	exit();
}

/************************************************************************************************************************
   경고창 함수 
************************************************************************************************************************/
function alert($msg, $url=''){
    echo '<script>alert("'.$msg.'");</script>';

    if($url === false){
        return;
    }
    if( $url == "" ) {
        echo '<script>history.back();</script>';
    }else if( $url ){
        echo '<script>';
        echo 'location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'">';
        echo '</noscript>';
    }
    exit();
}

/************************************************************************************************************************
   경고창 닫기 함수 
************************************************************************************************************************/
function alert_close($msg = ""){
    if($msg){
        echo '<script>alert("'.$msg.'");</script>';
    }
    echo '<script>window.close();</script>';
    exit();
}

/************************************************************************************************************************
   Confirm창 함수 
************************************************************************************************************************/
function confirm($msg, $url, $url2){
    echo '<script>if(confirm("'.$msg.'")){';
    echo 'location.href="'.$url.'";';
    echo '}else{';
        echo 'location.href="'.$url2.'";';
    echo '}</script>';
    exit();
}

/************************************************************************************************************************
   새로고침 방지 함수 
************************************************************************************************************************/
function no_refresh($title){
    echo '<html>';
    echo '<head>';
    echo '<title>'.$title.'</title>';
    echo '<script>';
    echo 'function noRefresh()';
    echo '{';
    echo 'if ((event.keyCode == 78) && (event.ctrlKey == true))';
    echo '{';
    echo 'event.keyCode = 0;';
    echo 'return false;';
    echo '}';
    echo 'if(event.keyCode == 116)';
    echo '{';
    echo 'event.keyCode = 0;';
    echo 'return false;';
    echo '}';
    echo '}';
    echo 'document.onkeydown = noRefresh ;';
    echo '</script>';
    echo '</head>';
    echo '</html>';
}

/************************************************************************************************************************
   콘솔로그 함수 
************************************************************************************************************************/
function console($msg){
    if(PAVE_TEST){
        echo "<script>console.log(".json_encode($msg).")</script>";
    }
}

/************************************************************************************************************************
   토큰생성 함수 
************************************************************************************************************************/
function get_token(){
	return md5(PAVE_USER_IP.PAVE_TIME.$_COOKIE['PHPSESSID']);
}

/************************************************************************************************************************
   unique id 함수 
************************************************************************************************************************/
function get_unique($lenth = 20){
    // uniqid gives 13 chars, but you could adjust it to your needs.
    if (function_exists("random_bytes")) {
        $bytes = random_bytes(ceil($lenth / 2));
    } elseif (function_exists("openssl_random_pseudo_bytes")) {
        $bytes = openssl_random_pseudo_bytes(ceil($lenth / 2));
    } else {
        throw new Exception("no cryptographically secure random function available");
    }
    return substr(bin2hex($bytes), 0, $lenth);
}

/************************************************************************************************************************
   셀렉트박스 선택여부 함수 
************************************************************************************************************************/
function get_selected($value,$value2){
    if($value == $value2){
        return "selected";
    }
}

/************************************************************************************************************************
   체크박스 체크여부 함수 
************************************************************************************************************************/
function get_checked($value, $value2){
    if(is_array($value2)){
        if(in_array($value,$value2)){
            return "checked";
        }
    }else{
        if($value == $value2){
            return "checked";
        }
    }
}

/************************************************************************************************************************
   필수 여부 함수 
************************************************************************************************************************/
function is_required($required){
   if($required){
       return "required";
   }

   return "";
}

/************************************************************************************************************************
   api return 함수 
************************************************************************************************************************/
function return_json($data = null, $status = "200", $msg = "", $redirect_url = ""){
    $result = array(
        "status" => $status,
        "msg"   => $msg,
        "data" => $data,
        "redirect_url" => $redirect_url
    );
    
    return json_encode($result);
}

/************************************************************************************************************************
   디렉토리 전체 삭제 함수 
************************************************************************************************************************/
function rm_rf($file)
{
    if (file_exists($file)) {
        if (is_dir($file)) {
            $handle = opendir($file);
            while($filename = readdir($handle)) {
                if ($filename != '.' && $filename != '..')
                    rm_rf($file.'/'.$filename);
            }
            closedir($handle);

            @rmdir($file);
        } else {
            @unlink($file);
        }
    }
}

/************************************************************************************************************************
   시간 null 함수 
************************************************************************************************************************/
function is_time_null($str){
    if(!$str){
        return true;
    }

    if($str == "0000-00-00 00:00:00"){
        return true;
    }

    return false;
}

/************************************************************************************************************************
   헤더 가져오기 함수 
************************************************************************************************************************/
function get_header($title = "", $use_header = true){
    extract($GLOBALS);

    if($title){
        $pave_meta["title"] = $title." | ".$pave_meta["title"];
    }
    //HTML 시작 불러오기
    include_once(PAVE_PATH.'/top.php');

    if($use_header){
        // 헤더
        $header_theme_path = $pave_theme["thm_path"]."/header.view.php";
        if(is_file($header_theme_path) && file_exists($header_theme_path)){
            include_once($header_theme_path);
        }else{
            console("헤더 파일을 찾을 수 없어 기본테마로 대체합니다.");
            include_once($pave_theme["thm_default"]."/header.view.php");
        }
    }

    //추가 헤더
    $add_header_theme_path = $pave_theme["thm_path"]."/header.add.view.php";
    if(is_file($add_header_theme_path) && file_exists($add_header_theme_path)){
        include_once($add_header_theme_path);
    }
}

/************************************************************************************************************************
   푸터 가져오기 함수 
************************************************************************************************************************/
function get_footer($use_footer = true){
    extract($GLOBALS);

    // 추가 푸터
    $add_footer_theme_path = $pave_theme["thm_path"]."/footer.add.view.php";
    if(is_file($add_footer_theme_path) && file_exists($add_footer_theme_path)){
        include_once($add_footer_theme_path);
    }
    if($use_footer){
    
    
        // 푸터
        $footer_theme_path = $pave_theme["thm_path"]."/footer.view.php";
        if(is_file($footer_theme_path) && file_exists($footer_theme_path)){
            include_once($footer_theme_path);
        }else{
            console("푸터 파일을 찾을 수 없어 기본테마로 대체합니다.");
            include_once($pave_theme["thm_default"].'/footer.view.php');
        }
    }

    //HTML 끝 불러오기
    include_once(PAVE_PATH.'/bottom.php');
}
?>