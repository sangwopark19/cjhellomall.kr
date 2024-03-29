<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// Common Skin
@include_once($skin_path.'/common.skin.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);

$img = apms_it_thumbnail($view, 80, 80, false, true);
$it_price = ($view['it_tel_inq']) ? '전화문의' : number_format(get_price($view));

// 별점
$scolor = (isset($wset['star']) && $wset['star']) ? $wset['star'] : 'red';

?>

<div class="view-wrap<?php echo (G5_IS_MOBILE) ? ' view-mobile font-14' : '';?>">
	<h1><?php if($view['iq_photo']) { ?><img src="<?php echo $view['iq_photo'];?>" class="photo" alt=""><?php } ?><?php echo $view['iq_subject']; ?></h1>
	<div class="panel panel-default view-head" style="border-bottom:0;">
		<div class="panel-heading">
			<div class="font-12 text-muted">
				<i class="fa fa-user"></i>
				<?php echo $view['iq_name']; //등록자 ?>
				<span class="hidden-xs">
					<span class="sp"></span>
					<i class="fa fa-clock-o"></i>
					<?php echo apms_datetime($view['iq_time'], 'Y.m.d H:i'); //시간 ?>
				</span>
			</div>
		</div>
	</div>

	<div class="view-content">
		<?php echo get_view_thumbnail($view['iq_question'], $default['pt_img_width']); ?>
	</div>

	<div class="view-sns text-right">
		<?php 
			$sns_url  = G5_SHOP_URL.'/itemqaview.php?iq_id='.$iq_id;
			$sns_title = get_text($view['iq_subject'].' : '.$view['it_name'].' | '.$config['cf_title']);
			$sns_img = $skin_url.'/img';
			echo  get_sns_share_link('facebook', $sns_url, $sns_title, $sns_img.'/sns_fb.png').' ';
			echo  get_sns_share_link('twitter', $sns_url, $sns_title, $sns_img.'/sns_twt.png').' ';
			echo  get_sns_share_link('googleplus', $sns_url, $sns_title, $sns_img.'/sns_goo.png').' ';
			echo  get_sns_share_link('kakaostory', $sns_url, $sns_title, $sns_img.'/sns_kakaostory.png').' ';
			echo  get_sns_share_link('kakaotalk', $sns_url, $sns_title, $sns_img.'/sns_kakao.png').' ';
			echo  get_sns_share_link('naverband', $sns_url, $sns_title, $sns_img.'/sns_naverband.png').' ';
		?>
	</div>

	<?php if($view['iq_answer']) { ?>
		<div class="div-title-wrap" style="margin-top:-5px;">
			<h4 class="div-title"><i class="fa fa-comment fa-lg lightgray"></i> Answer</h4>
			<div class="div-sep-wrap">
				<div class="div-sep sep-bold"></div>
			</div>
		</div>

		<div class="ans-content">
			<?php echo get_view_thumbnail($view['iq_answer'], $default['pt_img_width']); ?>
			<br>
			<div class="text-muted">
				<div class="pull-right">
					<i class="fa fa-clock-o"></i> <?php echo apms_datetime($view['iq_time'], 'Y.m.d H:i'); //시간 ?>
				</div>
				<?php if($view['iq_ans_href']) { ?>
					<div class="pull-left">
						<a href="<?php echo $view['iq_ans_href']; ?>"><span class="text-muted"><i class="fa fa-plus"></i> 답변수정</span></a>
					</div>
				<?php } ?>
				<div class="clearfix"></div>
			</div>
		</div>
	<?php } ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Question Item</h3>
		</div>
		<div class="panel-body">
			<div class="item-media">
				<div class="media">
					<div class="item-photo pull-left">
						<?php echo ($img['src']) ? '<img src="'.$img['src'].'" alt="'.$img['src'].'">' : '<i class="fa fa-cube></i>'; ?>
					</div>
					<div class="media-body">
						<div class="media-heading">
							<a href="<?php echo $view['it_href'] ?>">
								<b><?php echo $view['it_name'] ?></b>
							</a>
						</div>
						<div class="media-info text-muted">
							<span class="<?php echo $scolor;?> font-14"><?php echo apms_get_star($view['it_use_avg']); //평균별점 ?></span>
							<span class="sp"></span>
							<i class="fa fa-comment"></i> <?php echo ($view['pt_comment']) ? '<b class="red">'.number_format($view['pt_comment']).'</b>' : 0;?>
							<span class="hidden-xs">
								<span class="sp"></span>
								<i class="fa fa-krw"></i> <?php echo $it_price;?>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="view-btn">
	<div class="form-group pull-left">
		<div class="btn-group">
			<a href="./itemqalist.php?sfl=<?php echo urlencode('a.it_id');?>&amp;stx=<?php echo urlencode($view['it_id']);?>" class="btn btn-<?php echo $btn2;?> btn-sm"><i class="fa fa-eye"></i> 더보기</a>
		</div>
	</div>
	<div class="form-group pull-right">
		<div class="btn-group">
			<?php if($view['iq_edit_href']) { ?>
				<a href="<?php echo $view['iq_edit_href']; ?>" class="btn btn-<?php echo $btn1;?> btn-sm"><i class="fa fa-plus"></i><span class="hidden-xs"> 수정</span></a>
			<?php } ?>
			<?php if($view['iq_del_href']) { ?>
				<a href="<?php echo $view['iq_del_href']; ?>" class="btn btn-<?php echo $btn1;?> btn-sm"><i class="fa fa-times"></i><span class="hidden-xs"> 삭제</span></a>
			<?php } ?>
			<a href="./itemqalist.php?<?php echo $qstr;?>" class="btn btn-<?php echo $btn1;?> btn-sm"><i class="fa fa-bars"></i> 목록</a>
			<?php if($view['iq_ans_href'] && !$view['iq_answer']) { ?>
				<a href="<?php echo $view['iq_ans_href']; ?>" class="btn btn-<?php echo $btn2;?> btn-sm"><i class="fa fa-comment"></i><span class="hidden-xs"> 답변</span></a>
			<?php } ?>
		</div>
	</div>
	<div class="clearfix"></div>
</div>

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });
});
</script>