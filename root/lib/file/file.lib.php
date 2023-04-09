<?php
if (!defined('_PAVE_')) exit;

include_once(PAVE_LIB_FILE_PATH."/constants.php");

/*************************************************************************
**
**  파일 함수 모음
**
*************************************************************************/

/************************************************************************************************************************
   컨텐츠 내용 이미지 경로 추출 함수 
************************************************************************************************************************/
function get_content_img_path($content){
    if(!$content){
        return false;
    }

    $content = stripslashes($content);

    preg_match_all(PAVE_IMG_SRC_REGEX, $content, $matchs);

    $img_url = $matchs[1];
    for ($i=0; $i < count($img_url); $i++) { 
        $img_url[$i] = str_replace(PAVE_DATA_TEMP_URL, PAVE_DATA_TEMP_PATH, $img_url[$i]);
    }


    return $img_url;
}
class Files extends Objects{
    function __construct() {
    }
    
    public static function get_file_cf_list($file_id = ""){
        $sql = "SELECT * FROM pave_cf_file";
      
        if($file_id){
            $sql .= " WHERE file_id = '{$file_id}'";
        }
        $result = pave_query($sql);

        $file_cf = array();
        for ($i=0; $row = pave_fetch_assoc($result); $i++) { 
            if($row["file_id"] == "epsd_copy"){
                $row["file_id_text"] = "회차원고";
            }else if($row["file_id"] == "epsd_img"){
                $row["file_id_text"] = "회차 이미지";
            }else if($row["file_id"] == "user_img"){
                $row["file_id_text"] = "프로필 이미지";
            }else if($row["file_id"] == "work_img"){
                $row["file_id_text"] = "작품 이미지";
            }

            $row["file_ext_list"] = pave_explode($row["file_ext"], ",");
            $file_cf[] = $row;
        }
        return $file_cf;
    }

    public static function file_cf($file_id = ""){
        return self::get_file_cf_list($file_id)[0];
    }

    public static function generate_file($files){
        $result = array();

        if(pave_is_array($files["name"])){
            $count = count($files["name"]);
            for ($i=0; $i < $count; $i++) {
                $result[$i]["name"] = $files["name"][$i];
                $result[$i]["type"] = $files["type"][$i];
                $result[$i]["tmp_name"] = $files["tmp_name"][$i];
                $result[$i]["error"] = $files["error"][$i];
                $result[$i]["size"] = $files["size"][$i];
            }
        }else{
            $result[0]["name"] = $files["name"];
            $result[0]["type"] = $files["type"];
            $result[0]["tmp_name"] = $files["tmp_name"];
            $result[0]["error"] = $files["error"];
            $result[0]["size"] = $files["size"];
        }
        
    
        return $result;
    }

    public function get_file_list($file_id, $work_id = '', $epsd_id = 0){
        global $pave_user;

        $sql = "SELECT * FROM pave_file WHERE user_id = '{$pave_user["user_id"]}' AND file_id = '{$file_id}' AND work_id = '{$work_id}' AND epsd_id = '{$epsd_id}' ORDER BY file_order";
        $result = pave_query($sql);
    
        $file = array();
    
        for ($i=0; $row = pave_fetch_assoc($result); $i++) {
            if($row["file_size"] > 0){
                $row["file_size_text"] = Converter::display_byte_format($row["file_size"]);
            }
            $file[] = $row;
        }
    
        return $file;
    }
    

    public function sanitize_file_total($file_cf, $files){
        if($msg = $this->check_total_allow_size($file_cf, $files)){
            return $msg;
        } 

        if($msg = $this->check_total_count($file_cf, $files)){
            return $msg;
        } 
        
        return "";
    }
  
    public function sanitize_file($file_cf, $file){
        if($msg = $this->check_temp_file($file["tmp_name"])){
            return $msg;
        }
    
        if($msg = $this->check_file_name($file["name"])){
            return $msg;
        } 
    
        if($msg = $this->check_allow_extension($file_cf["file_ext"], $file["name"])){
            return $msg;
        } 
    
        if($msg = $this->check_allow_size($file_cf, $file["size"])){
            return $msg;
        } 
    
        if($this->is_img($file["name"])){
            $size = getimagesize($file["tmp_name"]);
            if($msg = $this->check_allow_img_width($file_cf["file_width"], $file_cf["file_width_opt"], $file_cf["file_opt_action"], $size[0])){
                return $msg;
            }
            if($msg = $this->check_allow_img_height($file_cf["file_height"], $file_cf["file_height_opt"], $file_cf["file_opt_action"], $size[1])){
                return $msg;
            }
        }
        
        return "";
    }

    public function move_file_path($file_path, $new_file_path){
        rename($file_path, $new_file_path);
    }

    public function file_insert($file_path, $file_id, $tmp_file, $work_id = "", $epsd_id = 0, $file_order = 0){
        global $pave_user;
    
        if($this->is_img($tmp_file["name"])){
            $file_type = "img";
            $img_info = getimagesize($file_path);
            $file_width = $img_info[0];
            $file_height = $img_info[1];
        }else{
            $file_type = "doc";
            $file_width = 0;
            $file_height = 0;
        }
    
        $file = array(
            "file_id"           => $file_id,
            "user_no"           => $pave_user["user_no"],
            "work_id"           => $work_id,
            "epsd_id"           => $epsd_id,
            "file_type"         => $file_type,
            "file_orgn_name"    => $this->get_file_name($tmp_file["orgn"]),
            "file_full_name"    => $tmp_file["name"],
            "file_name"         => $this->get_file_name($tmp_file["name"]),
            "file_ext"          => $this->get_file_extension($tmp_file["name"]),
            "file_size"         => filesize($file_path),
            "file_width"        => $file_width,
            "file_height"       => $file_height,
            "file_order"        => $file_order,
            "file_insert_dt"    => PAVE_TIME_YMDHIS,
            "file_insert_ip"    => PAVE_USER_IP
        );
    
        $result = pave_insert("pave_file", $file);
    
        if(!$result){
            @unlink($file_path);
        }
    
        return $result;
    }

    public function sight_file_insert($file_path, $file_id, $tmp_file, $sight_no){
        global $pave_user;
    
        if($this->is_img($tmp_file["name"])){
            $file_type = "img";
            $img_info = getimagesize($file_path);
            $file_width = $img_info[0];
            $file_height = $img_info[1];
        }else{
            $file_type = "doc";
            $file_width = 0;
            $file_height = 0;
        }
    
        $file = array(
            "file_id"           => $file_id,
            "user_no"           => $pave_user["user_no"],
            "sight_no"          => $sight_no,
            "file_type"         => $file_type,
            "file_orgn_name"    => $this->get_file_name($tmp_file["orgn"]),
            "file_full_name"    => $tmp_file["name"],
            "file_name"         => $this->get_file_name($tmp_file["name"]),
            "file_ext"          => $this->get_file_extension($tmp_file["name"]),
            "file_size"         => filesize($file_path),
            "file_width"        => $file_width,
            "file_height"       => $file_height,
            "file_insert_dt"    => PAVE_TIME_YMDHIS,
            "file_insert_ip"    => PAVE_USER_IP
        );
    
        $result = pave_insert("pave_file", $file);
    
        if(!$result){
            @unlink($file_path);
        }
    
        return $result;
    }

    public function is_img($file_name){
        $file_ext = $this->get_file_extension($file_name);
    
        if(!preg_match(PAVE_FILE_IMAGE_EXT_REGX, $file_ext)){
            return false;
        }
    
        return true;
    }

    public function get_file_name($file_name){
        return pathinfo($file_name, PATHINFO_FILENAME);
    }

    public function get_file_extension($file_name){
        return strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    }


    public function check_temp_file($tmp_name){
        if(!is_uploaded_file($tmp_name)){
            return "파일을 다시 업로드 해주세요.";
        }
    
        return "";
    }

    public function check_file_name($file_name){
        $file_name = $this->get_file_name($file_name);
        if(mb_strlen($file_name, "UTF-8") > PAVE_FILE_NAME_MAX_LEN){
            return "파일의 이름의 길이가 길어 업로드가 불가능합니다.";
        } 
    
        return "";
    }

    public function check_allow_extension($allow_ext, $file_name){
        $allow_ext = str_replace(".", "", $allow_ext);
        $allow_ext = str_replace(",", "|", $allow_ext);
        $file_ext = $this->get_file_extension($file_name);
    
        if(!preg_match("/^({$allow_ext})$/i", $file_ext)){
            return "사용할 수 없는 파일입니다.";
        }
        return "";
    }

    public function check_allow_size($file_cf, $file_size){
        $max_size = Converter::display_byte($file_cf["file_size"].$file_cf["file_unit"]);
        
        if($file_size > $max_size){
            return "업로드 가능한 용량은 ".$file_cf["file_size"].$file_cf["file_unit"]." 입니다.";
        }
    
        return "";
    }

    public function check_total_allow_size($file_cf, $files){
        $total_size = array_sum(array_column($files, "size"));
        $total_max_size = Converter::display_byte($file_cf["file_total_size"].$file_cf["file_total_unit"]);
    
        if($total_size > $total_max_size){
            return "업로드 가능한 총 용량은 ".$file_cf["file_total_size"].$file_cf["file_total_unit"]." 입니다.";
        }
        return "";
    }

    public function check_total_count($file_cf, $files){
        if(count($files) > $file_cf["file_cnt"]){
            return "업로드 가능한 파일은 최대 {$file_cf["file_cnt"]}개 입니다.";

        }
        
        return "";
    }

    public function check_allow_img_width($allow_width, $width_opt, $opt_action, $file_width){
        if($opt_action == "ignore"){
            return "";
        }
        switch ($width_opt) {
            case '==':
                if($file_width != $allow_width){
                    return "이미지의 너비는 {$allow_width}px 이어야 합니다.";
                }
                break;
            case '>':
                if($file_width < $allow_width){
                    return "이미지의 너비는 {$allow_width}px 보다 커야합니다.";
                }
                break;
            case '<':
                if($file_width > $allow_width){
                    return "이미지의 너비는 {$allow_width}px 보다 작아야합니다.";
                }
                break;
            case '>=':
                if($file_width < $allow_width ){
                    return "이미지의 너비는 {$allow_width}px 보다 크거나같아야합니다.";
                }
                break;
            case '<=':
                if($file_width > $allow_width){
                    return "이미지의 너비는 {$allow_width}px 보다 작거나같아야합니다.";
                }
                break;
        }
    
        return "";
    }

    public function check_allow_img_height($allow_height, $height_opt, $opt_action, $file_height){
        if($opt_action == "ignore"){
            return "";
        }
        switch ($height_opt) {
            case '==':
                if($file_height != $allow_height){
                    return "이미지의 높이는 {$allow_height}px 이어야 합니다.";
                }
                break;
            case '>':
                if($allow_height > $file_height){
                    return "이미지의 높이는 {$allow_height}px 보다 커야합니다.";
                }
                break;
            case '<':
                if($file_height > $allow_height){
                    return "이미지의 높이는 {$allow_height}px 보다 작아야합니다.";
                }
                break;
            case '>=':
                if($allow_height > $file_height){
                    return "이미지의 높이는 {$allow_height}px 보다 크거나같아야합니다.";
                }
                break;
            case '<=':
                if($file_height > $allow_height){
                    return "이미지의 높이는 {$allow_height}px 보다 작거나같아야합니다.";
                }
                break;
        }
        return "";
    }

    public function get_unique_file_name($file_path, $file_name, $ext){
        $file_hash = md5(PAVE_TIME.$file_name);
        $file_name = "{$file_hash}.{$ext}";
        $file_path .= $file_name;
        
        if(is_file($file_path)){
            $n = 0;
            do {
                $file_hash = md5(PAVE_TIME.$file_name.$n);
                $file_name = "{$file_hash}.{$ext}";
                $file_path .= $file_name;
                
                if(!is_file($file_path)){
                    break;
                }else{
                    if( $n > 100 ) break;
                }

                $n++;
            } while(1);
        }
    
        return $file_name;
    }

    public function check_unique_file_name($file_name){
        if(is_file($file_name)){
            return "잠시 후 다시 시작해주세요.";
        }

        return "";
    }

    public function upload_file($file_tmp_name ,$new_file_name){
        if(!move_uploaded_file($file_tmp_name,$new_file_name)){
            return "업로드에 실패했습니다.";
        }
        chmod($new_file_name, PAVE_FILE_PERMISSION);

        return "";
    }
}
?>
