<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// 추출하기
$list = apms_board_rows($wset);
$list_cnt = count($list); // 글수

// 랭킹
$rank = apms_rank_offset($wset['rows'], $wset['page']);

// 캡션
$wset['caption'] = (isset($wset['caption']) && $wset['caption']) ? $wset['caption'] : ''; // 캡션

if($wset['caption']) {
	$wset['caption'] = ($wset['caption'] == 'small') ? 'caption' : 'title en'; // 캡션
	$wset['bg'] = (isset($wset['bg']) && $wset['bg']) ? $wset['bg'] : 'black';
	$wset['bg'] = (isset($wset['trans']) && $wset['trans']) ? ' trans-bg-'.$wset['bg'] : ' bg-'.$wset['bg']; // 반투명
	$wset['scut'] = (isset($wset['scut']) && $wset['scut'] > 0) ? $wset['scut'] : 0; // 제목
}

// 링크
$is_link = (isset($wset['link']) && $wset['link']) ? true : false;

// 리스트
for ($i=0; $i < $list_cnt; $i++) {

	// 링크#1
	$target = '';
	if($is_link && $list[$i]['wr_link1']) {
		$list[$i]['href'] = $list[$i]['link_href'][1];
		$target = ' target="_blank"';
	}

?>
	<li>
		<div class="img-wrap" style="padding-bottom:<?php echo $img_height;?>%;">
			<div class="img-item">
				<?php if($wset['rank']) { ?>
					<div class="label-cap en bg-<?php echo $wset['rank'];?>">Top<?php echo $rank; $rank++; ?></div>
				<?php } else if($list[$i]['new']) { ?>
					<div class="label-cap en bg-<?php echo $wset['new'];?>">New</div>
				<?php } ?>
				<a href="<?php echo $list[$i]['href'];?>"<?php echo $target;?>>
					<img src="<?php echo $list[$i]['img']['src'];?>" alt="<?php echo str_replace("\"", "'", $list[$i]['subject']);?>">
					<?php if($wset['caption']) { //캡션 
						if($wset['scut']) $list[$i]['subject'] = apms_cut_text($list[$i]['subject'], $wset['scut']); // 제목
					?>
						<div class="in-<?php echo $wset['caption'];?> <?php echo $wset['bg']; ?>">
							<?php echo $list[$i]['subject'];?>
							<?php if($list[$i]['comment']) { ?>
								<span class="count red"><?php echo number_format($list[$i]['comment']);?></span>
							<?php } ?>
						</div>
					<?php } ?>
				</a>
			</div>
		</div>
	</li>
<?php } ?>
