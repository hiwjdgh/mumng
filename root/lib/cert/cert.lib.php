<?php
if (!defined('_PAVE_')) exit;
include_once(PAVE_LIB_CERT_PATH."/constants.php");
/*************************************************************************
**
**  인증 함수 모음
**
*************************************************************************/

/************************************************************************************************************************
   나이스 API 접속 토큰 생성 함수 
************************************************************************************************************************/
function create_nice_access_token(){
    global $cert_config;

    $curl = curl_init();
    $token_data = "grant_type=client_credentials&scope=default";
    $credential = base64_encode($cert_config["cert_nice_client_key"].":".$cert_config["cert_nice_secret_key"]);

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://svc.niceapi.co.kr:22001/digital/niceid/oauth/oauth/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $token_data,
        CURLOPT_HTTPHEADER => [
            "Authorization: Basic " . $credential,
            "Content-Type: application/x-www-form-urlencoded"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    $response = json_decode($response, true);
    if ($err) {
        return false;
    }

    if($response["dataHeader"]["GW_RSLT_CD"] != "1200"){
        return false;
    }


    return $response;
}

/************************************************************************************************************************
   나이스 API 접속 토큰 폐기 함수 
************************************************************************************************************************/
function delete_nice_access_token(){
    global $cert_config;
    $access_token = get_nice_access_token();
    $curl = curl_init();
    $credential = base64_encode($access_token.":".PAVE_TIME.":".$cert_config["cert_nice_client_key"]);

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://svc.niceapi.co.kr:22001/digital/niceid/oauth/oauth/token/revokeById",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: Basic " . $credential,
            "Content-Type: application/x-www-form-urlencoded"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    $response = json_decode($response, true);
    if ($err) {
        return false;
    }

    if($response["dataHeader"]["GW_RSLT_CD"] != "1200"){
        return false;
    }


    
    return $response["dataBody"]["result"];
}

/************************************************************************************************************************
   나이스 API 접속 토큰 가져오기 함수 
************************************************************************************************************************/
function get_nice_access_token(){
    $token_data = create_nice_access_token();
  
    if(!$token_data){
        return false;
    }
    //토큰 만료시
    if($token_data["dataBody"]["expires_in"] < 1){
        if(!delete_nice_access_token()){
            return false;
        }

        $new_token_data = create_nice_access_token();

        return $new_token_data["dataBody"]["access_token"];
    }

    return $token_data["dataBody"]["access_token"];
}

/************************************************************************************************************************
   나이스 API 암호화 토큰 함수 
************************************************************************************************************************/
function create_nice_crypto_token($data){
    global $cert_config;
    $access_token = $cert_config["cert_nice_access_token"];

    if(!$access_token){
        return false;
    }

    $curl = curl_init();
    $credential = base64_encode($access_token.":".PAVE_TIME.":".$cert_config["cert_nice_client_key"]);

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://svc.niceapi.co.kr:22001/digital/niceid/api/v1.0/common/crypto/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => [
            "Authorization: bearer " . $credential,
            "Content-Type: application/json",
            "productID: ". $cert_config["cert_nice_product_code"]
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    $response = json_decode($response, true);
    if ($err) {
        return false;
    }

    if($response["dataHeader"]["GW_RSLT_CD"] != "1200" || $response["dataBody"]["rsp_cd"] != "P000" || $response["dataBody"]["result_cd"] != "0000"){
        return false;
    }

    return $response;
}

/************************************************************************************************************************
   나이스 API 요청 데이터 암호화 생성 함수 
************************************************************************************************************************/
function create_nice_crypto_request(){
    $crypto_token_data = array(
        "dataHeader" => array(
            "CNTY_CD" => "ko"
        ),
        "dataBody" => array(
            "req_dtim" => PAVE_CERT_REQ_TIME,
            "req_no"   => get_unique(20),
            "enc_mode" => "1"
        )
    );

    $crpto_token_result = create_nice_crypto_token($crypto_token_data);

    if(!$crpto_token_result){
        return false;
    }

    $result = array(
        "request" => $crypto_token_data,
        "response" => $crpto_token_result,
    );

    return $result;
}

/************************************************************************************************************************
   나이스 API 암호화 함수 
************************************************************************************************************************/
function encrypt_nice($data, $key, $iv){
    return base64_encode(openssl_encrypt($data, "AES-128-CBC", $key, OPENSSL_RAW_DATA, $iv));
}
function decrypt_nice($data, $key, $iv){
    return openssl_decrypt(base64_decode($data), "AES-128-CBC", $key, OPENSSL_RAW_DATA, $iv);
}
?>