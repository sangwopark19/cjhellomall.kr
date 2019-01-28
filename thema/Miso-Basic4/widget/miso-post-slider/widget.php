<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// Flex Slider 불러오기
apms_script('flexslider'); 

//add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
//add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css" media="screen">', 0);

// 기본값 정리
$wset['effect'] = (isset($wset['effect']) && $wset['effect']) ? $wset['effect'] : 'slide';
$wset['thumb_w'] = (isset($wset['thumb_w']) && $wset['thumb_w'] > 0) ? $wset['thumb_w'] : 400;
$wset['thumb_h'] = (isset($wset['thumb_h']) && $wset['thumb_h'] > 0) ? $wset['thumb_h'] : 225;
$wset['in'] = (isset($wset['in']) && $wset['in']) ? true : false; // 내부 그림자

// 그림자
$shadow_in = $shadow_out = '';
if($wset['shadow']) {
	if($wset['in']) {
		$shadow_in = '<div class="in-shadow">'.apms_shadow($wset['shadow']).'</div>';
	} else {
		$shadow_out = apms_shadow($wset['shadow']);
	}
}

// 높이
$img_height = apms_img_height($wset['thumb_w'], $wset['thumb_h'], 100);

$widget_id = apms_id(); // Random ID

?>
<div class="img-wrap img-fix" style="padding-bottom:<?php echo $img_height;?>%;">
	<div class="img-item img-fix widget-miso-post-slider">
		<?php echo $shadow_in; ?>
		<div id="<?php echo $widget_id;?>" class="flexslider">
			<ul class="slides">
			<?php 
				if($wset['cache'] > 0) { // 캐시적용시
					echo apms_widget_cache($widget_path.'/widget.rows.php', $wname, $wid, $wset);
				} else {
					include($widget_path.'/widget.rows.php');
				}
			?>
			</ul>
		</div>
	</div>
</div>
<?php echo $shadow_out; ?>
<?php if($setup_href) { ?>
	<div class="btn-wset text-center p10">
		<a href="<?php echo $setup_href;?>" class="win_memo">
			<span class="text-muted font-12"><i class="fa fa-cog"></i> 위젯설정</span>
		</a>
	</div>
<?php } ?>
<script>
$(window).load(function() {
	$('#<?php echo $widget_id;?>').flexslider({
		<?php if(!isset($wset['nav']) || !$wset['nav']) { ?>
		controlNav: false,
		<?php } ?>
		<?php if(isset($wset['rdm']) && $wset['rdm']) { ?>
		randomize: true,
		<?php } ?>
		<?php if(isset($wset['speed']) && $wset['speed'] > 0) { ?>
	    slideshowSpeed: <?php echo $wset['speed'];?>,
		<?php } ?>
		<?php if(isset($wset['ani']) && $wset['ani'] > 0) { ?>
	    animationSpeed: <?php echo $wset['ani'];?>,
		<?php } ?>
		<?php if($wset['effect'] == 'vertical') { ?>
	    direction: "vertical",
		<?php } ?>
		animation: "<?php echo ($wset['effect'] == 'fade') ? 'fade' : 'slide';?>"
	});
});
</script>
