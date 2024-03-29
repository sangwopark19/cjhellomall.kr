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
}

// 이미지 비율
$thumb_w = $board['bo_'.MOBILE_.'gallery_width'];
$thumb_h = $board['bo_'.MOBILE_.'gallery_height'];
$img_h = apms_img_height($thumb_w, $thumb_h); // 이미지 높이

$cont_len = (G5_IS_MOBILE) ? $boset['m_cont'] : $boset['cont'];
if($cont_len == "") $cont_len = 100;
$sep_color = ($boset['color']) ? $boset['color'] : 'black';

// 라벨
$is_itack = $is_stack = false;
if($label_cnt) {
	switch($boset['tack']) {
		case '1'	: $is_stack = true; break;
		case '2'	: $is_itack = true; $is_stack = true; break;
		default		: $is_itack = true; break;
	}
}
?>

<div class="list-row timeline animated<?php echo $boset['dadan'];?>">

<?php
// 리스트
$save_sep = '';
for ($i=0; $i < $list_cnt; $i++) { 

	if($list[$i]['is_notice']) continue;		

	// 라벨
	$wr_tack = '';
	if($label_cnt) { 
		list($label_name, $label_color) = apms_label_icon($list[$i]['ca_name'], $labels, $label_cnt, $boset['label_name'], $boset['label_color']);
		$wr_tack = ($label_name) ? '<span class="tack-icon bg-'.$label_color.'">'.$label_name.'</span>' : '';
	}

	//날짜
	$timeline_sep = '';
	if($boset['sep'] == 'day') {
		$date_sep = date("Ymd", $list[$i]['date']);
		$date_title = date("d M Y", $list[$i]['date']);
		$am_pm = (int)date("H", $list[$i]['date']);
		$am_pm = ($am_pm > 12) ? 'PM' : 'AM';
		$date_wr = date("Y.m.d h:i", $list[$i]['date']).' '.$am_pm;
	} else if($boset['sep'] == 'year') {
		$date_sep = date("Y", $list[$i]['date']);
		$date_title = date("Y", $list[$i]['date']);
		$date_wr = date("d M Y", $list[$i]['date']);
	} else {
		$date_sep = date("Ym", $list[$i]['date']);
		$date_title = date("M Y", $list[$i]['date']);
		$date_wr = date("d M Y", $list[$i]['date']);
	}

	if(substr($list[$i]['wr_datetime'], 0, 10) == G5_TIME_YMD) {
		$date_sep = $date_title = 'Today';
	}

	if($save_sep == $date_sep) {
		;
	} else {
		$timeline_sep = ' timeline-sep';
		$save_sep = $date_sep;
	}

	//아이콘 체크
	$is_lock = false;
	$wr_lock = $wr_icon = $wr_label = '';
	$fa_icon = '<i class="fa fa-comment bg-lightgray"></i>';
	if ($list[$i]['icon_secret'] || $list[$i]['is_lock']) {
		$wr_lock = '<span class="wr-icon wr-secret"></span>';
		$list[$i]['wr_content'] = ($list[$i]['is_lock']) ? '잠긴글입니다' : '비밀글입니다.';
		$is_lock = true;
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

	// 공지, 현재글 스타일 체크
	if ($wr_id == $list[$i]['wr_id']) { // 현재글
		$wr_label = '<div class="label-band bg-blue">Now</div>';
		$wr_icon = '<span class="tack-icon bg-blue">현재</span>';
		$fa_icon = '<i class="fa fa-eye bg-blue"></i>';
	} else if($is_lock) {
		$wr_label = '<div class="label-band bg-red">Lock</div>';
		$fa_icon = '<i class="fa fa-lock bg-red"></i>';
	} else if ($list[$i]['icon_hot']) {
		$wr_label = '<div class="label-band bg-orange">Hot</div>';
		$wr_icon = '<span class="tack-icon bg-orange">인기</span>';
		$fa_icon = '<i class="fa fa-thumbs-up bg-orange"></i>';
	} else if ($list[$i]['icon_new']) {
		$wr_label = '<div class="label-cap bg-green">New</div>';
		$wr_icon = '<span class="tack-icon bg-green">새글</span>';
		$fa_icon = '<i class="fa fa-heart bg-green"></i>';
	} else if ($img['src']) {
		$fa_icon = '<i class="fa fa-picture-o bg-green"></i>';
	} else if ($list[$i]['icon_link']) {
		$fa_icon = '<i class="fa fa-link bg-yellow"></i>';
	} else if ($list[$i]['icon_file']) {
		$fa_icon = '<i class="fa fa-download bg-violet"></i>';
	}

	// 제목 라벨
	if($is_stack) {
		$wr_icon = ($wr_icon) ? $wr_icon : $wr_tack;
	}

	// 링크
	if($is_link_target && $list[$i]['wr_link1']) {
		$list[$i]['href'] = $list[$i]['link_href'][1];
	}

	//회원사진
	$photo = ($list[$i]['mb_id'] && $boset['photo']) ? apms_photo_url($list[$i]['mb_id']) : ''; 
	$fa_icon = ($photo) ? '<img src="'.$photo.'">' : $fa_icon;

?>
	<div class="timeline-row list-item<?php echo $timeline_sep;?>">
		<?php if($timeline_sep) { ?>
			<div class="timeline-label en bg-<?php echo $sep_color;?> no-border">
				<i><?php echo $date_title;?></i>
			</div>
		<?php } ?>
		<div class="timeline-time en">
			<i class="fa fa-clock-o fa-lg lightgray"></i> <?php echo $date_wr; ?>
		</div>
		<div class="timeline-icon">
			<?php echo $fa_icon;?>
		</div>
		<div class="timeline-content">
			<div class="list-content">
				<?php if($thumb['src']) { ?>
					<div class="list-media">
						<?php if($is_itack) { ?>
							<div class="label-tack"><?php echo $wr_tack;?></div>
						<?php } ?>
						<?php echo $wr_label;?>
						<?php if($boset['lightbox']) { //라이트박스 ?>
							<a href="<?php echo $img['src'];?>" data-lightbox="<?php echo $bo_table;?>-lightbox" data-title="<?php echo $caption;?>">
						<?php } else { ?>
							<a href="<?php echo $list[$i]['href'];?>"<?php echo $is_modal_js.$is_link_target;?>>
						<?php } ?>
							<img src="<?php echo $thumb['src'];?>" alt="<?php echo $thumb['alt'];?>" class="timeline-img">
						</a>
						<?php if($boset['shadow']) echo apms_shadow($boset['shadow']); //그림자 ?>
					</div>
				<?php } ?>
				<div class="timeline-desc">
					<h2 class="timeline-heading">
						<a href="<?php echo $list[$i]['href'];?>"<?php echo $is_modal_js.$is_link_target;?>>
							<?php echo $wr_icon;?>
							<?php echo $wr_lock;?>
							<?php if($wr_id && $list[$i]['wr_id'] == $wr_id) {?>
								<span class="crimson"><?php echo $list[$i]['subject'];?></span>
							<?php } else { ?>
								<?php echo $list[$i]['subject'];?>
							<?php } ?>
						</a>
					</h2>
					<?php if($cont_len > 0) { ?>
						<div class="timeline-explan">
							<?php echo apms_cut_text($list[$i]['wr_content'], $cont_len,'… <span class="font-11 text-muted">더보기</span>');?>
						</div>
					<?php } ?>
					<div class="timeline-info text-muted">
						<div class="pull-left">
							<?php echo $list[$i]['name'];?>
							<?php if($is_category && $list[$i]['ca_name']) { ?>
								<span class="list-sp">|</span>
								<?php echo $list[$i]['ca_name'];?>
							<?php } ?>
						</div>
						<div class="timeline-details pull-right">
							<i class="fa fa-comment"></i> <span class="red"><?php echo number_format($list[$i]['wr_comment']);?></span>
							<i class="fa fa-eye"></i> <span class="violet"><?php echo number_format($list[$i]['wr_hit']);?></span>
							<?php if($is_good) { ?>
								<i class="fa fa-thumbs-up"></i> <span class="blue"><?php echo number_format($list[$i]['wr_good']);?></span>
							<?php } ?>
							<?php if ($boset['udp'] && $list[$i]['as_down']) { ?>
								<i class="fa fa-download"></i>
								<?php echo number_format($list[$i]['as_down']); ?>P
							<?php } ?>
							<?php if ($is_checkbox) { ?>
								&nbsp; <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
							<?php } ?>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
</div>