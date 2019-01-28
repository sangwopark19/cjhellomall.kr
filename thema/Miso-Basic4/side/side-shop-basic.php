<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

// 위젯 설정값 아이디 접두어 지정
$wid = 'mbst-sb';

?>
<style>
	.w-side .div-title-underbar { margin-bottom:15px; }
	.w-side .div-title-underbar span { padding-bottom:4px; }
	.w-side .w-more { font-weight:normal; color:#888; letter-spacing:-1px; font-size:11px; }
	.w-side .w-img img { display:block; max-width:100%; /* 배너 이미지 */ }
	.w-side .w-box { margin-bottom:30px; }
	.w-side .w-p10 { padding:10px; }
	.w-side .tabs.div-tab ul.nav-tabs li.active a { font-weight:bold; color:#333 !important; }
	.w-side .main-tab .tab-more { margin-top:-28px; margin-right:10px; font-size:11px; letter-spacing:-1px; color:#888 !important; }
	.w-side .tabs { margin-bottom:30px !important; }
	.w-side .tab-content { border:0px !important; padding:15px 0px 0px !important; }
	.w-side .call-box { background:#fafafa; padding:10px; border-radius:10px; margin-top:10px; }
</style>
<div class="w-side">

	<!-- Start //-->
	<?php
		//카테고리
		$side_category = apms_widget('miso-category');
		if($side_category) {
	?>
		<div class="w-box">
			<?php echo $side_category; // 카테고리 ?>
		</div>
	<?php } ?>
	<!-- //End -->

	
</div>
