<?php
if (!defined('_PAVE_')) exit;
class Html{
    protected $css_link = array();
    protected $js_link  = array();
    protected $js_inline  = array();
    
    public function add_css($path){
        if(!trim($path)){
            return;
        }

        if(!in_array($path, $this->css_link)){
            $this->css_link[] = $path;
        }
    }

    public function add_js($path){
        if(!trim($path)){
            return;
        }
        if(!in_array($path, $this->js_link)){
            $this->js_link[] = $path;
        }
    }

    public function add_js_inline($js){
        if(!trim($js)){
            return;
        }
        $this->js_inline[] = $js;
    }

    public function run(){
        $css = '';
        $links = $this->css_link;

        foreach($links as $link) {
            $css .= PHP_EOL.'<link rel="stylesheet" href="'.$link.'">';
        }

        $js = '';
        $links = $this->js_link;

        $inlines = $this->js_inline;
        foreach($inlines as $inline) {
            $js .= PHP_EOL.$inline;
        }
        
        foreach($links as $link) {
            $js .= PHP_EOL.'<script src="'.$link.'"></script>';
        }

     


        return $css.$js;
    }
}
?>