<?php
if (!defined('_PAVE_')) exit;
include_once(PAVE_LIB_SHARE_PATH."/constants.php");
class Share{
    private $user = array();

    function __construct() {
        global $pave_user;
        $this->user = $pave_user;
    }

    function get_work_share_link($work){
        if(!$work["work_id"]){
            return null;
        }


        $share_url = get_url(PAVE_WORK_URL, "/detail/{$work["work_id"]}");
        $share_title = $work["work_name"];
    
        $facebook_url = str_replace("{url}", rawurlencode($share_url)  , PAVE_FACEBOOK_SHARE_URL);
        
        $twitter_url = str_replace("{url}", rawurlencode($share_url) , PAVE_TWITTER_SHARE_URL);
        $twitter_url = str_replace("{title}", rawurlencode($share_title) , $twitter_url);
    
        $naverblog_url = str_replace("{url}", rawurlencode($share_url) , PAVE_NAVER_BLOG_SHARE_URL);
        $naverblog_url = str_replace("{title}", rawurlencode($share_title) , $naverblog_url);

        $kakaostory_url = str_replace("{url}", rawurlencode($share_url) , PAVE_KAKAO_STORY_SHARE_URL);
        
    
        $return = array(
            "facebook" => $facebook_url,
            "twitter" => $twitter_url,
            "naverblog" => $naverblog_url,
            "kakaostory" => $kakaostory_url,
        );
    
        return $return;
    }

    function get_epsd_share_link($epsd){
        if(!$epsd["epsd_id"]){
            return null;
        }

        $share_url = get_url(PAVE_WORK_URL, "/epsd/{$epsd["work_id"]}/{$epsd["epsd_id"]}");
        $share_title = $epsd["epsd_name"];
    
        $facebook_url = str_replace("{url}", rawurlencode($share_url)  , PAVE_FACEBOOK_SHARE_URL);
        
        $twitter_url = str_replace("{url}", rawurlencode($share_url) , PAVE_TWITTER_SHARE_URL);
        $twitter_url = str_replace("{title}", rawurlencode($share_title) , $twitter_url);
    
        $naverblog_url = str_replace("{url}", rawurlencode($share_url) , PAVE_NAVER_BLOG_SHARE_URL);
        $naverblog_url = str_replace("{title}", rawurlencode($share_title) , $naverblog_url);

        $kakaostory_url = str_replace("{url}", rawurlencode($share_url) , PAVE_KAKAO_STORY_SHARE_URL);
        
    
        $return = array(
            "facebook" => $facebook_url,
            "twitter" => $twitter_url,
            "naverblog" => $naverblog_url,
            "kakaostory" => $kakaostory_url,
        );
    
        return $return;
    }

    function get_page_share_link(){

    }

}

?>