<style>
	.item-wig .img-box {position: relative;overflow: hidden;border-bottom: 1px solid #e4e4e4;margin: 0 15px;padding-top: 50px;}
	.item-wig .img-box .top-month {position: absolute;left: 10px;top: 15px;background-color: #2a8eea;color: #fff;padding: 8px 18px;font-size: 14px;}
	.item-wig .img-box img {position: absolute;left: 50%;top:50%;
		transform: translate(-50%,-50%);
		-webkit-transform: translate(-50%,-50%);
		-ms-transform: translate(-50%,-50%);
		-moz-transform: translate(-50%,-50%);
		-o-transform: translate(-50%,-50%); 
	}
	.item-wig .miso-post-list .post-list li {width: 24%;float: left;margin-right: 1.3%;background-color: #fff;border: 1px solid #ddd;margin-bottom: 1.3%;}
	.item-wig .miso-post-list .post-list li:nth-child(4),
	.item-wig .miso-post-list .post-list li:nth-child(8) {margin-right: 0;}
	.item-wig .txt-box {background-color: #fff;padding: 20px;white-space:normal;color: #666;text-align: center;height: 168px;}
	.item-wig .txt-box .title {font-weight: bold;font-size: 14px;color: #333;margin-bottom: 3px;}
	.item-wig .txt-box .code {font-size: 16px;}
	.item-wig .title-wrap {margin-bottom: 15px;}
	.item-wig .txt-content {height: 66px;overflow: hidden;width: 100%;max-width: 180px;margin: 0 auto;}
	.item-wig .txt-content > div {font-size: 16px;text-align: left;}
	.item-wig .txt-content > div span {float: right;}
	.item-wig .color-txt1 {color: #2f7ce4;}
	.item-wig .color-txt2 {color: #1abdfa;}
	.item-wig .color-txt3 {color: #9600ff;}
	
	@media all and (max-width:991px){
		.item-wig .miso-post-list .post-list li {width: 32.333%;}
		.item-wig .miso-post-list .post-list li:nth-child(4),
		.item-wig .miso-post-list .post-list li:nth-child(8) {margin-right: 1.3%;}
		.item-wig .miso-post-list .post-list li:nth-child(3),
		.item-wig .miso-post-list .post-list li:nth-child(6) {margin-right: 0;}
	}
	
	@media all and (max-width:767px){
		.item-wig .img-box {height: auto;}
		.item-wig .miso-post-list .post-list li {width: 49.5%;}
		.item-wig .miso-post-list .post-list li {margin-right: 1%;}
		.item-wig .miso-post-list .post-list li:nth-child(3),
		.item-wig .miso-post-list .post-list li:nth-child(6) {margin-right: 1%;}
		.item-wig .miso-post-list .post-list li:nth-child(even) {margin-right: 0%;}
		
		.item-wig .txt-box .title {font-size: 16px;}
		.item-wig .txt-box {padding: 10px;height: 150px;}
		.item-wig .txt-content > div {font-size: 14px;}
	}
	@media all and (max-width:767px){
		.item-wig .img-box .top-month {left: 0;top: 8px;padding: 2px 15px;font-size: 12px;}	
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
$list = apms_board_rows($wset, 'falcon');
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
	<style>
		.item-box #wr-img<?php echo $wset[bo_list]?><?php echo $i?> {background-image:url("<?php echo $list[$i]['as_thumb'];?>");}
		.item-box .post-row .wr-img {
			background-size: contain;
			padding-bottom: 75%;
			background-repeat: no-repeat;
			background-position: center center;
		}	
	</style>
		<a href="<?php echo $list[$i]['href'];?>" class="ellipsis"<?php echo $is_modal_js;?><?php echo $target;?>>
			<div class="img-box">
				<div class="top-month"><?php echo $list[$i]['wr_5'];?></div>
				<div id="wr-img<?php echo $wset[bo_list]?><?php echo $i?>" class="wr-img"></div>
			</div>
			<div class="txt-box">
				<div class="title-wrap">
					<div class="title ellipsis">
						<?php echo $list[$i]['subject'];?>
					</div>	
					<div class="code">
						<?php echo $list[$i]['wr_4'];?>
					</div>
				</div>
				<div class="txt-content">
					<div>헬로렌탈가 <span><?php echo $list[$i]['wr_2'];?></span></div>
					<div>카드할인가 <span class="color-txt1"><span><?php echo $list[$i]['wr_1'];?></span></span></div>
					<div>현금사은품 <span class="color-txt3"><?php echo $list[$i]['wr_3'];?></span></div>
				</div>
			</div>
		</a> 
	</li>
<?php } ?>
<?php if(!$list_cnt) { ?>
	<li class="post-none">글이 없습니다.</li>
<?php } ?>
</ul>
