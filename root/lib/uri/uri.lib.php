<?php
if (!defined('_PAVE_')) exit;

/*************************************************************************
**
**  URI 함수 모음
**
*************************************************************************/

/************************************************************************************************************************
   url 함수 
************************************************************************************************************************/
function get_url($url, $file = '', $query = ""){
    $clean_url = array();
    $clean_url[0] = $url;
    parse_str($query, $query_array);
    switch ($file) {
        case 'novel':
            break;
        case 'page':
            $clean_url[1] = $query_array["user_code"];
            break;
        case 'user':
            break;
        default:
            $clean_url[1] = $file;
            break;
    }
  /*   if($file){
       $url .=  DIRECTORY_SEPARATOR.$file;
    }

    if($query){
        $url .= '?'.$query;
    } */

    $clean_url = pave_implode($clean_url, "/");

    return $clean_url;
}
?>