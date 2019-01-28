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

	// 가로 모드
	$is_garo = (isset($wset['garo']) && $wset['garo']) ? $wset['garo'] : 0;
	$is_sero = ($is_garo == "2") ? true : false;

	// 더보기 모드
	$is_more = (isset($wset['more']) && $wset['more'] && !$is_sero) ? true : false;

	// 가로수
	$item = (isset($wset['item']) && $wset['item'] > 0) ? (int)$wset['item'] : 2;
}

// 추출하기
$list = apms_item_post_rows($wset);
$list_cnt = count($list);

// 아이콘
$icon = (isset($wset['icon']) && $wset['icon']) ? '<span class="lightgray">'.apms_fa($wset['icon']).'</span>' : '';
$is_ticon = (isset($wset['ticon']) && $wset['ticon']) ? true : false;

// 랭킹
$rank = apms_rank_offset($wset['rows'], $wset['page']); 

// 날짜
$is_date = (isset($wset['date']) && $wset['date']) ? true : false;
$is_dtype = (isset($wset['dtype']) && $wset['dtype']) ? $wset['dtype'] : 'm.d';
$is_dtxt = (isset($wset['dtxt']) && $wset['dtxt']) ? true : false;

// 새글
$is_new = (isset($wset['new']) && $wset['new']) ? $wset['new'] : 'red'; 

// 별점
$is_star = (isset($wset['star']) && $wset['star']) ? $wset['star'] : 'color'; 

// 강조글
$bold = array();
$strong = explode(",", $wset['strong']);
$is_strong = count($strong);
for($i=0; $i < $is_strong; $i++) {

	list($n, $bc) = explode("|", $strong[$i]);

	if(!$n) continue;

	$n = $n - 1;
	$bold[$n]['num'] = true;
	$bold[$n]['color'] = ($bc) ? ' class="'.$bc.'"' : '';
}

// 세로모드 나눔
$sero_rows = ($is_sero) ? round($wset['rows'] / $item) : 0;

?>

<ul class="post-list">
<?php
// 리스트
for ($i=0; $i < $list_cnt; $i++) { 

	//세로일 때
	if($sero_rows) {
		if($i > 0 && $i%$sero_rows == 0) {
			echo '</ul>'.PHP_EOL;
			echo '<ul class="post-list">'.PHP_EOL;
		}
	}

	//아이콘 체크
	$wr_icon = $icon;
	$is_lock = false;
	if ($list[$i]['secret'] || $list[$i]['is_lock']) {
		$is_lock = true;
		$wr_icon = '<span class="wr-icon wr-secret"></span>';
	} else if ($wset['rank']) {
		$wr_icon = '<span class="rank-icon en bg-'.$wset['rank'].'">'.$rank.'</span>';	
		$rank++;
	} else if($list[$i]['new']) {
		$wr_icon = '<span class="wr-icon wr-new"></span>';
	}

	//강조글
	if($is_strong) {
		if($bold[$i]['num']) {
			$list[$i]['subject'] = '<b'.$bold[$i]['color'].'>'.$list[$i]['subject'].'</b>';
		}
	}

?>
	<li class="post-row">
		<a href="<?php echo $list[$i]['href'];?>" class="ellipsis">
			<span class="pull-right gray font-12">
				<?php if($wset['mode'] == 'use') { // 후기 ?>
					<span class="font-13 txt-normal <?php echo $is_star;?>"><?php echo $list[$i]['star'];?></span>
				<?php } else if($wset['mode'] == 'qa') { // 문의 ?>
					<?php echo ($list[$i]['answer']) ? '<span class="orangered">답변완료</span>' : '답변대기';?>
				<?php } else if($list[$i]['name']) { ?>
					<?php echo $list[$i]['name'];?>
				<?php } ?>

				<?php if($is_comment) { ?>
					<span class="name">
						<?php echo $list[$i]['name'];?>
					</span>
				<?php } else if($list[$i]['comment']) { ?>
					<span class="count orangered">
						+<?php echo $list[$i]['comment'];?>
					</span>
				<?php } ?>
				<?php if ($is_date) { ?>
					&nbsp;<?php echo ($is_dtxt) ? apms_datetime($list[$i]['date'], $is_dtype) : date($is_dtype, $list[$i]['date']); ?>
				<?php } ?>
			</span>
			<?php echo $wr_icon;?>
			<?php echo $list[$i]['subject'];?>
		</a> 
	</li>
<?php } ?>
<?php if(!$list_cnt) { ?>
	<li class="post-none">글이 없습니다.</li>
<?php } ?>
</ul>
