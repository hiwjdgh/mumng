<?php
if (!defined('_PAVE_')) exit;
?>
<!DOCTYPE html>
<html lang="ko">
	<head>
		<title><?=$pave_meta["title"]?></title>
		<meta charset="utf-8">
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="format-detection" content="telephone=no, address=no, email=no">
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<!-- meta -->
		<meta name="title" content="<?=$pave_meta["title2"]?>">
		<meta name="author" content="<?=$pave_meta['author']?>">
		<meta name="description" content="<?=$pave_meta['description']?>">
		<meta name="keywords" content="<?=$pave_meta['keyword']?>">

		<!-- naver search advisor -->
		<meta name="naver-site-verification" content="476286c4ec5c1cb20053eb9386c533a72046d803" />

		<!-- facebook -->	
		<meta property="og:url" content="<?=$pave_meta["url"]?>"/>
		<meta property="og:title" content="<?=$pave_meta["title2"]?>"/>
		<meta property="og:description" content="<?=$pave_meta["description"]?>"/>
		<meta property="og:type" content="website"/>
		<meta property="og:image" content="<?=$pave_meta["img"]?>"/>

		<!-- twitter  -->
		<meta name="twitter:card" content="summary">
		<meta name="twitter:url" content="<?=$pave_meta["url"]?>">
		<meta name="twitter:title" content="<?= $pave_meta["title2"] ?>">
		<meta name="twitter:description" content="<?= $pave_meta["description"] ?>">
		<meta name="twitter:image" content="<?= $pave_meta["img"] ?>">

		<link rel="shortcut icon" href="<?=get_url(PAVE_IMG_URL, "favicon.ico")?>" type="image/x-icon">
		<link rel="apple-touch-icon" href="<?=get_url(PAVE_IMG_URL, "favicon_ios.png")?>" />
		<script>
			const pave_url = "<?=get_url(PAVE_URL,"")?>";
			const pave_page_url = "<?=get_url(PAVE_PAGE_URL,"")?>";
			const pave_work_url = "<?=get_url(PAVE_WORK_URL,"")?>";
			const pave_is_user = "<?=$is_user?>";
			const is_mobile = "<?=Visit::is_mobile() == "mobile" ? true : false;?>";
		</script>
		<?= $pave_html->run(); ?>

	</head>	
<body>