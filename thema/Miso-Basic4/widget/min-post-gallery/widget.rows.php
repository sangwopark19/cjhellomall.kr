<style>
	.event-box .miso-post-list .post-list li a {display: table;width: 100%;}
	.event-box .miso-post-list .img-box,
	.event-box .miso-post-list .txt-box {display: table-cell;vertical-align: middle;height: 125px;}
	.event-box .miso-post-list .img-box {position: relative;overflow: hidden;width: 25%;border-right: 1px solid #ddd;}
	.event-box .miso-post-list .img-box img {width: 100%;}
	.event-box .miso-post-list .post-list li {width: 49%;float: left;border: 1px solid #ddd;border-bottom: none;}
	.event-box .miso-post-list .post-list li:nth-last-child(2),
	.event-box .miso-post-list .post-list li:last-child {border-bottom: 1px solid #ddd;}
	.event-box .miso-post-list .post-list li:nth-child(even) {margin-left: 2%;}
	.event-box .miso-post-list .txt-box {background-color: #fff;padding: 10px 0 10px 20px;white-space:normal;color: #666;width: 75%;}
	.event-box .miso-post-list .txt-box .title {font-size: 13px;color: #333;height: 23px;width: 150px;}
	.event-box .miso-post-list .title-wrap {margin-bottom: 5px;}
	.event-box .miso-post-list .txt-content {overflow: hidden;}
	.event-box .miso-post-list .txt-content > div {line-height: 18px;}
	
	@media all and (max-width:1200px){
		.event-box .miso-post-list .img-box, .event-box .miso-post-list .txt-box {display: block;float: left;}
		.event-box .miso-post-list .img-box {display: flex;align-items: center;}
	}
	@media all and (max-width:480px){
		.event-box .miso-post-list .post-list li {width: 100%;float: none;}
		.event-box .miso-post-list .post-list li:nth-child(even) {margin-left: 0;}
	}
</style>
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
$list = apms_board_rows($wset, 'calnon');
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

// 댓글
$is_comment = (isset($wset['comment']) && $wset['comment']) ? true : false;

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
	} else if($is_ticon) {
		if ($list[$i]['icon_video']) {
			$wr_icon = '<span class="wr-icon wr-video"></span>';
		} else if ($list[$i]['icon_image']) {
			$wr_icon = '<span class="wr-icon wr-image"></span>';
		} else if ($list[$i]['wr_file']) {
			$wr_icon = '<span class="wr-icon wr-file"></span>';
		}
	}

	// 링크이동
	$target = '';
	if($is_link_target && $list[$i]['wr_link1']) {
		$target = $is_link_target;
		$list[$i]['href'] = $list[$i]['link_href'][1];
	}

	//강조글
	if($is_strong) {
		if($bold[$i]['num']) {
			$list[$i]['subject'] = '<b'.$bold[$i]['color'].'>'.$list[$i]['subject'].'</b>';
		}
	}

?>
	<li class="post-row">
		<a href="<?php echo $list[$i]['href'];?>" class="ellipsis"<?php echo $is_modal_js;?><?php echo $target;?>>
			<div class="img-box">
				<img src="<?php echo $list[$i]['as_thumb'];?>">
			</div>
			<div class="txt-box">
				<div class="title-wrap">
					<div class="title ellipsis">
						<?php echo $list[$i]['subject'];?>
					</div>	
					<div>
						<?php echo $list[$i]['wr_4'];?>
					</div>
				</div>
				<div class="txt-content">
					<div>헬로렌탈 <span><?php echo $list[$i]['wr_2'];?></span></div>
					<div>카드할인 <span><?php echo $list[$i]['wr_1'];?></span></div>
				</div>
			</div>
		</a> 
	</li>
<?php } ?>
<?php if(!$list_cnt) { ?>
	<li class="post-none">글이 없습니다.</li>
<?php } ?>
</ul>
