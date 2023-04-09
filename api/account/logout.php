<?php
session_unset();
session_destroy();

set_cookie("user_auto_login", '', -3600);
set_cookie("user_no", '', -3600);

die(return_json(null, "success","", get_url(PAVE_URL)));
?>