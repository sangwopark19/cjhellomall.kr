<style>
	.glyphicon-chevron-left:before,
	.glyphicon-chevron-right:before {content: '';display: block;width: 30px;height: 53px;background-size: cover;background-position: center center;}
	
	.glyphicon-chevron-left:before {background-image: url(/image/left-aro.png);}
	.glyphicon-chevron-right:before {background-image: url(/image/right-aro.png);}
	
	.carousel-control {opacity: 1;width: 5%;}
	.carousel-control.left,
	.carousel-control.right {background-image: none;}
	
	.carousel-indicators .active {background-color: #2478e8;border-color: #2478e8;width: 15px;height: 15px;margin-right: 8px;}
	.carousel-indicators li {background-color: #d8d8d8;border-color: #d8d8d8;width: 15px;height: 15px;margin: 0;margin-right: 8px;}
	
	.img-wrap .in-title { position: absolute;left: 29%;top: 51%;transform: translate(-50%,-50%);width: 100%;max-width: 500px;font-size: 36px;line-height: 50px;padding: 0;bottom: auto;color: #000;}
	.img-wrap .in-title .link-band { font-size: 16px; border: 1px solid #000;width: 130px;height: 35px;line-height: 34px;text-align: center;margin-top: 35px;}
	
	.carousel-control .glyphicon-chevron-left, .carousel-control .glyphicon-chevron-right {z-index: 1;}
	
	@media all and (max-width:991px){
		.img-wrap .in-title {left: 8%;transform: translate(0%, -50%);font-size: 26px;line-height: 35px;}
	}
	@media all and (max-width:480px){
		.carousel-control .icon-next, .carousel-control .glyphicon-chevron-right,
		.carousel-control .icon-prev, .carousel-control .glyphicon-chevron-left {margin: 0;}
		
		.img-wrap .in-title .link-band {margin-top: 15px;}
	}
</style>

<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

if(!$wset['slider']) {
	$wset['slider'] = 2;
	for($i=1; $i <= 2; $i++) {
		$wset['use'.$i] = 1;
		$wset['cl'.$i] = 'center';
		$wset['img'.$i] = $widget_url.'/img/title.jpg';
		$wset['cs'.$i] = 'title';
		$wset['cf'.$i] = 'white';
		$wset['cc'.$i] = 'black';
		$wset['caption'.$i] = '위젯설정에서 사용할 타이틀을 등록해 주세요.';
	}
}

// 높이
$height = (isset($wset['height']) && $wset['height']) ? $wset['height'] : '400px';
$lg = (isset($wset['lg']) && $wset['lg']) ? $wset['lg'] : '';
$md = (isset($wset['md']) && $wset['md']) ? $wset['md'] : '';
$sm = (isset($wset['sm']) && $wset['sm']) ? $wset['sm'] : '';
$xs = (isset($wset['xs']) && $wset['xs']) ? $wset['xs'] : '';

// 효과
$effect = apms_carousel_effect($wset['effect']);

// 간격
if($wset['auto'] == "") {
	$wset['auto'] = 3000;
}
$interval = apms_carousel_interval($wset['auto']);

// 작은화살표
$is_small = (isset($wset['small']) && $wset['small']) ? ' div-carousel' : '';

$list = array();

// 슬라이더
$k=0;
for ($i=1; $i <= $wset['slider']; $i++) {

	if(!$wset['use'.$i]) continue; // 사용하지 않으면 건너뜀

	$list[$k]['cl'] = ($wset['cl'.$i]) ? ' background-position:'.$wset['cl'.$i].' center;' : '';
	$list[$k]['img'] = $wset['img'.$i];
	$list[$k]['link'] = ($wset['link'.$i]) ? $wset['link'.$i] : 'javascript:;';
	$list[$k]['target'] = ($wset['target'.$i]) ? ' target="'.$wset['target'.$i].'"' : '';
	$list[$k]['label'] = $wset['label'.$i];
	$list[$k]['txt'] = $wset['txt'.$i];
	$list[$k]['cs'] = $wset['cs'.$i];
	$list[$k]['caption'] = $wset['caption'.$i];
	$list[$k]['cf'] = $wset['cf'.$i];
	$list[$k]['cc'] = $wset['cc'.$i];
	$k++;
}

$list_cnt = count($list);

// 랜덤
if($wset['rdm'] && $list_cnt) shuffle($list);

// 테두리
$is_round = ($is_small) ? '' : ' is-round-title';

// 랜덤아이디
$widget_id = apms_id(); 

?>
<style>
	#<?php echo $widget_id;?> .item { background-size:cover; background-position:center center; background-repeat:no-repeat; }
	#<?php echo $widget_id;?> .img-wrap { padding-bottom:<?php echo $height;?>; }
	#<?php echo $widget_id;?> .tab-indicators { position:absolute; left:0; bottom:0; width:100%; }
	#<?php echo $widget_id;?> .nav a { background: rgba(255,255,255, 0.9); color:#000; border-radius: 0px; margin:0px; }
	#<?php echo $widget_id;?> .nav a:hover, #<?php echo $widget_id;?> .nav a:focus,
	#<?php echo $widget_id;?> .nav .active a { background: rgba(0,0,0, 0.6); color:#fff; }
	<?php if(_RESPONSIVE_) { //반응형일 때만 작동 ?>
		<?php if($lg) { ?>
		@media (max-width:1199px) { 
			.responsive #<?php echo $widget_id;?> .img-wrap { padding-bottom:<?php echo $lg;?> !important; } 
		}
		<?php } ?>
		<?php if($md) { ?>
		@media (max-width:991px) { 
			.responsive #<?php echo $widget_id;?> .img-wrap { padding-bottom:<?php echo $md;?> !important; } 
		}
		<?php } ?>
		<?php if($sm) { ?>
		@media (max-width:767px) { 
			.responsive #<?php echo $widget_id;?> .img-wrap { padding-bottom:<?php echo $sm;?> !important; } 
		}
		<?php } ?>
		<?php if($xs) { ?>
		@media (max-width:480px) { 
			.responsive #<?php echo $widget_id;?> .img-wrap { padding-bottom:<?php echo $xs;?> !important; } 
		}
		<?php } ?>
	<?php } ?>
</style>
<div id="<?php echo $widget_id;?>" class="swipe-carousel carousel<?php echo $is_small;?><?php echo $effect;?>" data-ride="carousel" data-interval="<?php echo $interval;?>">
	<div class="carousel-inner bg-black is-round-title">
		<?php for ($i=0; $i < $list_cnt; $i++) { ?>
			<div class="item<?php echo (!$i) ? ' active' : '';?>" style="background-image: url('<?php echo $list[$i]['img'];?>');<?php echo $list[$i]['cl'];?>">
				<a href="<?php echo $list[$i]['link'];?>"<?php echo $list[$i]['target'];?>>
					<div class="img-wrap">
						<div class="img-item">
							<?php if($list[$i]['cs'] && $list[$i]['caption']) { // 캡션 ?>
								<div class="en in-<?php echo $list[$i]['cs'];?>">
									<?php echo apms_fa($list[$i]['caption']); ?>
								<?php if($list[$i]['label']) { // 라벨 ?>
									<div class="link-band"><?php echo apms_fa($list[$i]['txt']); ?></div>
								<?php } ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</a>
			</div>
		<?php $k++;} ?>
	</div>
	<?php if(!$wset['arrow']) { ?>
		<!-- Controls -->
		<a class="left carousel-control<?php echo $is_round;?>" href="#<?php echo $widget_id;?>" role="button" data-slide="prev">
			<?php if($is_small) { ?>
				<i class="fa fa-chevron-left" aria-hidden="true"></i>
			<?php } else { ?>
			   <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<?php } ?>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control<?php echo $is_round;?>" href="#<?php echo $widget_id;?>" role="button" data-slide="next">
			<?php if($is_small) { ?>
				<i class="fa fa-chevron-right" aria-hidden="true"></i>
			<?php } else { ?>
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<?php } ?>
			<span class="sr-only">Next</span>
		</a>
	<?php } ?>
	<!-- Indicators -->
	<?php if($wset['nav']) { ?>
		<ol class="carousel-indicators" style="z-index:2;margin-bottom:0px;bottom:<?php echo ($wset['dot']) ? $wset['dot'] : '10px';?>;">
			<?php for ($i=0; $i < $list_cnt; $i++) { ?>
				<li data-target="#<?php echo $widget_id;?>" data-slide-to="<?php echo $i;?>"<?php echo (!$i) ? ' class="active"' : '';?>></li>
			<?php } ?>
		</ol>
	<?php } ?>
</div>
<?php if($wset['shadow']) echo apms_shadow($wset['shadow']); //그림자 ?>
<?php if($setup_href) { ?>
	<div class="btn-wset text-center p10">
		<a href="<?php echo $setup_href;?>" class="win_memo">
			<span class="text-muted font-12"><i class="fa fa-cog"></i> 위젯설정</span>
		</a>
	</div>
<?php } ?>
