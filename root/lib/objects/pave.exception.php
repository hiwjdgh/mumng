<?php
if (!defined('_PAVE_')) exit;
class PaveException extends Exception{
    private $redirect_url = "";
    public function __construct($code = 0, $message = "", $redirect_url = ""){
        parent::__construct($message, $code);
        $this->redirect_url = $redirect_url;
    }

    public function get_error(){
        return $this;    
    }

    public function get_message(){
        return $this->getMessage();
    }

    public function get_code(){
        return $this->getCode();
    }

    public function get_redirect_url(){
        return $this->redirect_url;
    }
}
?>