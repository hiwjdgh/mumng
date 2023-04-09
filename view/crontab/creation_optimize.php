<?php
$obj = new Objects2();

$obj->generate_sql_init()
->set_sql_common("SELECT * FROM pave_creation")
->set_sql_where("creation_state = 'recruit'")
->set_sql_where("'".PAVE_TIME_YMDHIS."' >= creation_end_dt");

$result = pave_query($obj->generate_sql());

$expired_creation_list = array();
for ($i=0; $row = pave_fetch_assoc($result) ; $i++) { 
    $expired_creation_list[] = $row;
}

foreach ((array)$expired_creation_list as $i => $expired_creation) {
    pave_update("pave_creation", array("creation_state" => "expired"), "creation_no = '{$expired_creation["creation_no"]}'");
}
?>