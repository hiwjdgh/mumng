<?php
define("__WORK_API__", true);
$pave_theme = get_theme("work");

//작품 라이브러리
require_once(PAVE_LIB_WORK_PATH.'/work.lib.php');

$epsd_cf = Epsds::epsd_cf("epsd");
?>