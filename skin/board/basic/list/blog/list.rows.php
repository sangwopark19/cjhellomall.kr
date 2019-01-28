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

$ellipsis = (G5_IS_MOBILE) ? '' : ' class="ellipsis"';
$cont_len = (G5_IS_MOBILE) ? $boset['m_cont'] : $boset['cont'];
if($cont_len == "") $cont_len = 100;
$color = ($boset['color']) ? $boset['color'] : 'green';
$shadow = ($boset['shadow']) ? ' shadow' : '';

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
for ($i=0; $i < $list_cnt; $i++) { 

	if($list[$i]['is_notice']) continue;		

	// 라벨
	$wr_tack = '';
	if($label_cnt) { 
		list($label_name, $label_color) = apms_label_icon($list[$i]['ca_name'], $labels, $label_cnt, $boset['label_name'], $boset['label_color']);
		$wr_tack = ($label_name) ? '<span class="tack-icon bg-'.$label_color.'">'.$label_name.'</span>' : '';
	}

	// 아이콘 체크
	$is_lock = false;
	$wr_lock = $wr_label = $wr_icon = '';
	if ($list[$i]['icon_secret'] || $list[$i]['is_lock']) {
		$wr_lock = '<span class="wr-icon wr-secret"></span>';
		$list[$i]['wr_content'] = ($list[$i]['is_lock']) ? '잠긴글입니다' : '비밀글입니다.';
		$is_lock = true;
	}

	// 제목 라벨
	if($is_stack) {
		$wr_icon = ($wr_icon) ? $wr_icon : $wr_tack;
	}

	// 링크
	if($is_link_target && $list[$i]['wr_link1']) {
		$list[$i]['href'] = $list[$i]['link_href'][1];
	}

	$img = ($is_lock) ? array('src'=>'', 'alt'=>'') : apms_wr_thumbnail($bo_table, $list[$i], 0, 0, false, true); // 썸네일

?>
	<div class="media list-media">
		<div class="list-item">
			<?php if($img['src']) { $fa_icon = 'picture-o'; ?>
				<div class="media-box<?php echo $shadow;?>">
					<?php if($is_itack) { ?>
						<div class="label-tack"><?php echo $wr_tack;?></div>
					<?php } ?>
					<?php echo $wr_label;?>
					<a href="<?php echo $list[$i]['href'];?>"<?php echo $is_modal_js.$is_link_target;?>>
						<img src="<?php echo $img['src'];?>" alt="<?php echo $img['alt'];?>">
					</a>
					<?php if($boset['shadow']) echo apms_shadow($boset['shadow']); //그림자 ?>
					<div class="btn-box">
						<a href="<?php echo $list[$i]['wr_link1'];?>" target="_blank">온라인 신청</a>
					</div>	
				</div>
			<?php } ?>

			<div class="media-body">
				<h2 class="media-heading">
					<a href="<?php echo $list[$i]['href'];?>"<?php echo $ellipsis.$is_modal_js.$is_link_target;?>>
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
					<div class="list-cont text-muted">
						<a href="<?php echo $list[$i]['href'];?>"<?php echo $is_modal_js.$is_link_target;?>>
							<?php echo nl2br($list[$i]['wr_content']);?>
						</a>
					</div>
				<?php } ?>
				<?php if($list[$i]['as_tag']) { ?>
					<div class="list-tag text-muted">
						<i class="fa fa-tags"></i> <?php echo apms_get_tag($list[$i]['as_tag']);?>
					</div>
				<?php } ?>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
<?php } ?>
