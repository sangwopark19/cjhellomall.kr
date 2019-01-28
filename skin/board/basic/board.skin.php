<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 헤더 출력
$header_skin = (isset($boset['header_skin']) && $boset['header_skin']) ? $boset['header_skin'] : ''; 
if($header_skin) {
	$header_color = $boset['header_color'];
	include_once('./header.php');
}

// 게시판 관리의 상단 내용
if(!$is_bo_content_head) {
	if (G5_IS_MOBILE) {
		echo stripslashes($board['bo_mobile_content_head']);
	} else {
		echo stripslashes($board['bo_content_head']);
	}
}

?>
<style>
	.title {font-size: 28px;font-weight: bold;padding-bottom: 30px;border-bottom: 1px solid #ddd;margin-bottom: 20px;}
	.col-md-3.at-side {padding: 0;width: 20.8%;}

	.at-row { background-color: #f5f5f5;}
	.at-main {width: 79.2%;padding-left: 50px;background-color: #fff;padding-top: 40px;}
	
</style>
<div class="title">
	<img src="/image/title-icon.jpg" alt=""/> <?php echo $page_title;?>
</div>