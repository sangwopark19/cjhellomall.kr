<?php
if (!defined('_GNUBOARD_')) {
	include_once('../../../../common.php');
	include_once(G5_LIB_PATH.'/apms.more.lib.php');

	// 창열기
	$wset['modal'] = (isset($wset['modal'])) ? $wset['modal'] : '';
	$is_modal_js = $is_link_target = '';
	if($wset['modal'] == "1") { //모달
		$is_modal_js = ' onclick="view_modal(this.href); return false;"';
	} else if($wset['modal'] == "2") { //링크#1
		$is_link_target = ' target="_blank"';
	}

	// 모드
	$is_masonry = (isset($wset['masonry']) && $wset['masonry']) ? true : false;

	$wset['thumb_w'] = (isset($wset['thumb_w']) && $wset['thumb_w'] > 0) ? $wset['thumb_w'] : 400;
	if($is_masonry) {
		$wset['thumb_h'] = (isset($wset['thumb_h']) && $wset['thumb_h'] > 0) ? $wset['thumb_h'] : 0;
	} else {
		$wset['thumb_h'] = (isset($wset['thumb_h']) && $wset['thumb_h'] > 0) ? $wset['thumb_h'] : 300;
	}

	$wset['line'] = (isset($wset['line']) && $wset['line'] >= 0) ? $wset['line'] : 1;
	$wset['line_height'] = 20 * $wset['line'];

	// 캡션
	$caption = (isset($wset['caption']) && $wset['caption']) ? $wset['caption'] : '';
	$is_caption = ($caption == "1") ? false : true;
}

// 추출하기
if(!$wset['rows']) {
	$wset['rows'] = 12;	
}

// 추출하기
$wset['image'] = 1; //이미지글만 추출
$list = apms_board_rows($wset);
$list_cnt = count($list); // 글수

// 랭킹
$rank = apms_rank_offset($wset['rows'], $wset['page']);

// 날짜
$is_date = (isset($wset['date']) && $wset['date']) ? true : false;
$is_dtype = (isset($wset['dtype']) && $wset['dtype']) ? $wset['dtype'] : 'm.d';
$is_dtxt = (isset($wset['dtxt']) && $wset['dtxt']) ? true : false;

// 새글
$is_new = (isset($wset['new']) && $wset['new']) ? $wset['new'] : 'red'; 

// 분류
$is_cate = (isset($wset['cate']) && $wset['cate']) ? true : false;

// 글내용
$is_cont = ($wset['line'] > 1) ? true : false; 
$is_details = ($is_cont) ? '' : ' no-margin'; 

// 동영상아이콘
$is_vicon = (isset($wset['vicon']) && $wset['vicon']) ? '' : '<i class="fa fa-play-circle-o post-vicon"></i>'; 

// 스타일
$is_center = (isset($wset['center']) && $wset['center']) ? ' text-center' : ''; 
$is_bold = (isset($wset['bold']) && $wset['bold']) ? true : false; 

// 그림자
$shadow_in = '';
$shadow_out = (isset($wset['shadow']) && $wset['shadow']) ? apms_shadow($wset['shadow']) : '';
if($shadow_out && isset($wset['inshadow']) && $wset['inshadow']) {
	$shadow_in = '<div class="in-shadow">'.$shadow_out.'</div>';
	$shadow_out = '';	
}

// 메이슨리 클래스
$img_wrap = ($is_masonry && !$wset['thumb_h']) ? 'post-img' : 'img-wrap';

// 리스트
for ($i=0; $i < $list_cnt; $i++) {

	//아이콘 체크
	$wr_icon = '';
	$is_lock = false;
	if ($list[$i]['secret'] || $list[$i]['is_lock']) {
		$is_lock = true;
		$wr_icon = '<span class="rank-icon en bg-orange en">Lock</span>';	
	} else if($list[$i]['new']) {
		$wr_icon = '<span class="rank-icon txt-normal en bg-'.$is_new.'">New</span>';	
	}

	$rank_icon = '';
	if ($wset['rank']) {
		$rank_icon = '<div class="in-right"><span class="rank-icon en bg-'.$wset['rank'].'">'.$rank.'</span></div>';	
		$rank++;
	}

	// 링크이동
	$target = '';
	if($is_link_target && $list[$i]['wr_link1']) {
		$target = $is_link_target;
		$list[$i]['href'] = $list[$i]['link_href'][1];
	}

	//볼드체
	if($is_bold) {
		$list[$i]['subject'] = '<b>'.$list[$i]['subject'].'</b>';
	}

?>
	<div class="post-row">
		<div class="post-list post-col">
			<div class="post-image">
				<a href="<?php echo $list[$i]['href'];?>"<?php echo $is_modal_js;?><?php echo $target;?>>
					<div class="<?php echo $img_wrap;?> is-round-post-img">
						<div class="img-item">
							<?php echo $shadow_in;?>
							<?php echo $rank_icon;?>
							<?php if($caption && $wr_icon) { ?>
								<div class="in-right"><?php echo $wr_icon;?></div>
							<?php } else {
								echo $rank_icon;
							} ?>
							<?php if($list[$i]['as_list'] == "2" || $list[$i]['as_list'] == "3") echo $is_vicon; ?>
							<img src="<?php echo $list[$i]['img']['src'];?>" alt="<?php echo $list[$i]['img']['alt'];?>" class="wr-img">
							<?php if($is_caption && $caption) { ?>
								<div class="in-subject ellipsis trans-bg-black">
									<?php if($is_date || $list[$i]['comment']) { ?> 
										<span class="pull-right">
											<?php if ($list[$i]['comment']) { ?>
												<span class="count orangered">+<?php echo $list[$i]['comment']; ?></span>
											<?php } ?>
											<?php if ($is_idate) { ?>
												&nbsp;<?php echo ($is_dtxt) ? apms_datetime($list[$i]['date'], $is_dtype) : date($is_dtype, $list[$i]['date']); ?>
											<?php } ?>
										</span>
									<?php } ?>
									<?php echo $list[$i]['subject'];?>
								</div>
							<?php } ?>
						</div>
					</div>
				</a>
				<?php echo $shadow_out;?>
			</div>
			<?php if($is_caption && !$caption) { // 캡션이 아닐 때 ?>
				<?php if($wset['line_height']) { ?>
					<div class="post-content<?php echo $is_center;?>">
						<div class="post-subject">
							<a href="<?php echo $list[$i]['href'];?>"<?php echo $is_modal_js;?><?php echo $target;?>>
								<?php echo $wr_icon;?>
								<?php echo $list[$i]['subject'];?>
								<?php if($is_cont) { ?>
									<div class="post-text">
										<?php echo apms_cut_text($list[$i]['content'], 100);?>
									</div>
								<?php } ?>
							</a>
						</div>
						<div class="post-text post-ko txt-short ellipsis<?php echo $is_center;?><?php echo $is_details;?>">
							<?php echo $list[$i]['name'];?>
							<?php if($is_cate && $list[$i]['ca_name']) { ?>
								<span class="post-sp">|</span>
								<?php echo $list[$i]['ca_name'];?>
							<?php } ?>
							<?php if($is_idate) { ?>
								<span class="post-sp">|</span>
								<span class="txt-normal">
									<?php echo ($is_dtxt) ? apms_datetime($list[$i]['date'], $is_dtype) : date($is_dtype, $list[$i]['date']); ?>
								</span>
							<?php } ?>
							<?php if ($list[$i]['comment']) { ?>
								<span class="count orangered">+<?php echo $list[$i]['comment']; ?></span>
							<?php } ?>
						</div>
					</div>
				<?php } else { ?>
					<div class="post-content">
						<a href="<?php echo $list[$i]['href'];?>"<?php echo $is_modal_js;?><?php echo $target;?> class="ellipsis">
							<?php if ($list[$i]['comment']) { ?>
								<span class="pull-right count orangered">+<?php echo $list[$i]['comment']; ?></span>
							<?php } ?>
							<?php echo $wr_icon;?>
							<?php echo $list[$i]['subject'];?>
						</a>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
<?php } // end for ?>
<?php if(!$list_cnt) { ?>
	<div class="post-none">등록된 글이 없습니다.</div>
<?php } ?>
