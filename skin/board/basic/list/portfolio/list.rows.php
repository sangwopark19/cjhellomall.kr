<?php
if (!defined('_GNUBOARD_')) {
	// AJAX일 때
	$is_ajax = true;
	include_once('../../../../../common.php');
	include_once(G5_BBS_PATH.'/list.rows.php');
	$list_cnt = count($list);
	if(!$list_cnt) exit;

	// 창열기
	$is_modal_js = $is_link_target = '';
	if($boset['modal'] == "1") { // 모달
		$is_modal_js = ' onclick="view_modal(this.href); return false;"';
	} else if($boset['modal'] == "2") { //링크#1
		$is_link_target = ' target="_blank"';
	}

	// 라벨
	$labels = array();
	$label_cnt = 0;
	if($boset['label']) {
		$labels = apms_label_list($boset);
		$label_cnt = count($labels);
		if(!$label_cnt) $label_cnt = 1;
	}

	if(!$boset['list_skin']) $boset['list_skin'] = 'list'; // 목록스킨

	$list_skin_url = $board_skin_url.'/list/'.$boset['list_skin'];
	$list_skin_path = $board_skin_path.'/list/'.$boset['list_skin'];

	// 나누기
	if(!$boset['masonry']) {
		echo '<div class="list-row clearfix"></div>'.PHP_EOL;
	}
}

// 이미지 비율
$thumb_w = $board['bo_'.MOBILE_.'gallery_width'];
$thumb_h = $board['bo_'.MOBILE_.'gallery_height'];
$img_h = apms_img_height($thumb_w, $thumb_h); // 이미지 높이

// 제목
$ellipsis = ($boset['sone'] && !G5_IS_MOBILE) ? ' class="ellipsis"' : '';

$cont_len = ($boset['cont'] > 0) ? $boset['cont'] : 70;
$ncont_len = ($boset['ncont'] > 0) ? $boset['ncont'] : 140;

// 날짜
$is_date = '';
if($boset['date']) {
	$is_date = ($boset['trans']) ? 'trans-bg-'.$boset['date'] : 'bg-'.$boset['date'];
	$is_date = ($boset['right']) ? $is_date.' right' : $is_date.' left';
}

// 라벨
$is_itack = $is_stack = false;
if($label_cnt) {
	switch($boset['tack']) {
		case '1'	: $is_stack = true; break;
		case '2'	: $is_itack = true; $is_stack = true; break;
		default		: $is_itack = true; break;
	}
}

// 리스트
$k = 0;
for ($i=0; $i < $list_cnt; $i++) { 

	if($list[$i]['is_notice']) continue;		

	// 라벨
	$wr_tack = '';
	if($label_cnt) { 
		list($label_name, $label_color) = apms_label_icon($list[$i]['ca_name'], $labels, $label_cnt, $boset['label_name'], $boset['label_color']);
		$wr_tack = ($label_name) ? '<span class="tack-icon bg-'.$label_color.'">'.$label_name.'</span>' : '';
	}

	// 제목 라벨
	if($is_stack) {
		$wr_icon = ($wr_icon) ? $wr_icon : $wr_tack;
	}

	// 링크
	if($is_link_target && $list[$i]['wr_link1']) {
		$list[$i]['href'] = $list[$i]['link_href'][1];
	}

	$list[$i]['no_img'] = ''; // No-Image
	if($boset['lightbox']) { //라이트박스
		$img = ($is_lock) ? apms_thumbnail($list[$i]['no_img'], 0, 0, false, true) : apms_wr_thumbnail($bo_table, $list[$i], 0, 0, false, true);
		$thumb = apms_thumbnail($img['src'], $thumb_w, $thumb_h, false, true); // 썸네일
		$caption = "<a href='".$list[$i]['href']."'>".str_replace('"', '\'', $wr_icon).apms_get_html($list[$i]['subject'], 1);
		$caption .= " &nbsp;<i class='fa fa-comment'></i> ";
		if($list[$i]['wr_comment']) $caption .= "<span class='en orangered'>".$list[$i]['wr_comment']."</span>&nbsp; ";
		$caption .= "<span class='font-normal font-11'>댓글달기</span></a>";
	} else {
		$thumb = ($is_lock) ? apms_thumbnail($list[$i]['no_img'], $thumb_w, $thumb_h, false, true) : apms_wr_thumbnail($bo_table, $list[$i], $thumb_w, $thumb_h, false, true);
	}
?>
	<?php if(!$boset['masonry'] && $k > 0 && $k%$board['bo_gallery_cols'] == 0) { ?>
		<div class="list-row clearfix"></div>
	<?php } ?>
	<div class="list-row">
		<div class="list-item">
			<?php if($thumb['src']) { ?>
				<?php if($thumb_h > 0) { ?>
					<div class="imgframe">
						<div class="img-wrap" style="padding-bottom:<?php echo $img_h;?>%;">
							<div class="img-item">
								<?php if($is_itack) { ?>
									<div class="label-tack"><?php echo $wr_tack;?></div>
								<?php } ?>
								<?php echo $wr_label;?>
								<?php if($boset['lightbox']) { //라이트박스 ?>
									<a href="<?php echo $img['src'];?>" data-lightbox="<?php echo $bo_table;?>-lightbox" data-title="<?php echo $caption;?>">
								<?php } else { ?>
									<a href="<?php echo $list[$i]['href'];?>"<?php echo $is_modal_js.$is_link_target;?>>
								<?php } ?>
									<img src="<?php echo $thumb['src'];?>" alt="<?php echo $thumb['alt'];?>">
								</a>
							</div>
						</div>
						<?php if($is_date) { ?>
							<div class="list-date <?php echo $is_date;?> en">
								<?php echo date("Y.m.d", $list[$i]['date']); ?>
							</div>
						<?php } ?>
					</div>
				<?php } else { ?>
					<div class="list-img">
						<?php if($is_itack) { ?>
							<div class="label-tack"><?php echo $wr_tack;?></div>
						<?php } ?>
						<?php echo $wr_label;?>
							<?php if($boset['lightbox']) { //라이트박스 ?>
								<a href="<?php echo $img['src'];?>" data-lightbox="<?php echo $bo_table;?>-lightbox" data-title="<?php echo $caption;?>">
							<?php } else { ?>
								<a href="<?php echo $list[$i]['href'];?>"<?php echo $is_modal_js.$is_link_target;?>>
							<?php } ?>
							<img src="<?php echo $thumb['src'];?>" alt="<?php echo $thumb['alt'];?>">
						</a>
						<?php if($is_date) { ?>
							<div class="list-date <?php echo $is_date;?> en">
								<?php echo date("Y.m.d", $list[$i]['date']); ?>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
				<?php if($boset['shadow']) echo apms_shadow($boset['shadow']); //그림자 ?>
			<?php } ?>
			<div class="list-content">
				<h2>
					<a href="<?php echo $list[$i]['href'];?>"<?php echo $ellipsis.$is_modal_js.$is_link_target;?>>
						<div class="ellipsis">
							<?php echo date("Y.m.d", $list[$i]['date']); ?>
						</div>
						<div class="ellipsis">
							<?php echo $list[$i]['subject'];?>
						</div>	
						<div class="ellipsis">
							<?php 
								$len = ($thumb['src']) ? $cont_len : $ncont_len;
								echo apms_cut_text($list[$i]['wr_content'], $len,'… <span class="font-11 text-muted">더보기</span>');
							?>
						</div>
					</a>
				</h2>
			</div>
		</div>
	</div>
<?php $k++; } ?>
