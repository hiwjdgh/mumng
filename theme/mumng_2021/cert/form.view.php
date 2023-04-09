<?php
if (!defined('_PAVE_')) exit;
?>
<form name="cert_form" id="cert_form" action="https://nice.checkplus.co.kr/CheckPlusSafeModel/service.cb" method="post">
    <input type="hidden" id="m" name="m" value="service" />
    <input type="hidden" id="token_version_id" name="token_version_id" value="<?=$nice_data["response"]["dataBody"]["token_version_id"]?>">
    <input type="hidden" id="enc_data" name="enc_data" value="<?=$encrypt_text?>">
    <input type="hidden" id="integrity_value" name="integrity_value" value="<?=$integrity_value?>">
</form>
<script>
$(document).ready(function(){
    $("#cert_form").submit();
});
</script>

