<?php
if (!defined('_PAVE_')) exit;

include_once(PAVE_LIB_SQL_PATH."/constants.php");

/*************************************************************************
**
**  SQL 관련 함수 모음
**
*************************************************************************/
/************************************************************************************************************************
   DB 연결 함수
************************************************************************************************************************/
function pave_connect(){
    $con = mysqli_connect(PAVE_MYSQL_HOST, PAVE_MYSQL_USER, PAVE_MYSQL_PASSWORD, PAVE_MYSQL_DB);

    // 연결 오류 발생 시 스크립트 종료
    if (mysqli_connect_errno()) {
        die('Connect Error: '.mysqli_connect_error());
    }
    
	return $con;
}

/************************************************************************************************************************
   쿼리 실행 함수
************************************************************************************************************************/
function pave_query($query){
    global $db_conn;

    $query = trim($query);
    
    //sql 보안 처리
    $query = preg_replace(INFORMATION_SCHEMA, "select 1", $query);
    try{
        $result = mysqli_query($db_conn,$query);
        if($result === false){
            throw new Exception($query);
        }

        return $result;
    }catch(Exception $e){
        console($e->getMessage());
    }
}

/************************************************************************************************************************
   쿼리 추출 함수 (한행)
************************************************************************************************************************/
function pave_fetch($query){
    $result = pave_query($query);
    $row = pave_fetch_assoc($result);
    return $row;
}

/************************************************************************************************************************
   쿼리 추출 함수 (연관배열)
************************************************************************************************************************/
function pave_fetch_assoc($result){
    return mysqli_fetch_assoc($result);
}

/************************************************************************************************************************
   삽입된 A.I 값 추출 함수
************************************************************************************************************************/
function pave_insert_id(){
    global $db_conn;
	return mysqli_insert_id($db_conn);
}

/************************************************************************************************************************
   쿼리결과 갯수 추출 함수
************************************************************************************************************************/
function pave_row($result){
    return mysqli_num_rows($result);
}

/************************************************************************************************************************
   Insert 함수
************************************************************************************************************************/
function pave_insert($table, $data){
    $key =  array_keys($data);
    $value = array_values($data);
    $value = array_map('Converter::add_quotes', $value); //quotes 추가
    $query = "INSERT INTO {$table} (".implode(',',$key).") VALUES (".implode(',', $value).")";
    
    return pave_query($query);
}

/************************************************************************************************************************
   Update 함수
************************************************************************************************************************/
function pave_update($table, $data, $where='1'){
    if(!pave_is_array($data)){
        return false;
    }

    $key = array_keys($data);
    $value = array_values($data);
    $cnt = count($key);

    $value = array_map('Converter::add_quotes', $value); //quotes 추가
    for ($i=0; $i < $cnt ; $i++) { 
        $set[] = $key[$i]."=".$value[$i] ;
    }
    $query = "UPDATE {$table} SET ".implode(',',$set)." WHERE {$where}";
    return pave_query($query);
}

/************************************************************************************************************************
   Delete 함수
************************************************************************************************************************/
function pave_delete($table, $where = array()){
    $query_where = array();    
    if(pave_is_array($where)){
        foreach ($where as $key => $value) {
            if(pave_is_array($value)){
                $opt = key($value);
                $opr = $value[$opt];
                $query_where[] = "{$key} {$opt} '{$opr}'";
            }else{
                $query_where[] = "{$key} = '{$value}'";
            }
        }
    }
    $query_where = pave_implode($query_where," AND ");


    $query = "DELETE FROM {$table} WHERE {$query_where}";
    return pave_query($query);
}

/************************************************************************************************************************
   Close 함수
************************************************************************************************************************/
function pave_close(){
    global $db_conn;
    mysqli_close($db_conn);
}
?>