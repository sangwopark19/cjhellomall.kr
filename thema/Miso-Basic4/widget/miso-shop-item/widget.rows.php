<?php
if (!defined('_GNUBOARD_')) {
	include_once('../../../../common.php');
	include_once(G5_LIB_PATH.'/apms.more.lib.php');
	$is_ajax = true;

	//썸네일
	$wset['thumb_w'] = (isset($wset['thumb_w']) && $wset['thumb_w'] > 0) ? $wset['thumb_w'] : 400;
	$wset['thumb_h'] = (isset($wset['thumb_h']) && ($wset['thumb_h'] > 0 || $wset['thumb_h'] == "0")) ? $wset['thumb_h'] : 500;
}

// 추출하기
if(!isset($wset['rows']) || !$wset['rows']) {
	$wset['rows'] = 8;
}

$list = apms_item_rows($wset);
$list_cnt = count($list);

// 랭킹
$is_rank = (isset($wset['rank']) && $wset['rank']) ? $wset['rank'] : '';
$rank = apms_rank_offset($wset['rows'], $wset['page']);

// 새상품
$new_item = (isset($wset['newtime']) && $wset['newtime']) ? $wset['newtime'] : 24;

// 별점
$wset['star'] = (isset($wset['star']) && $wset['star']) ? $wset['star'] : '1';
$is_star = ($wset['star'] != "1") ? true : false;

// 포인트
$wset['pbg'] = (isset($wset['pbg']) && $wset['pbg']) ? $wset['pbg'] : 'navy';

// 숨김항목
$is_buy = (isset($wset['buy']) && $wset['buy']) ? false : true;
$is_cmt = (isset($wset['cmt']) && $wset['cmt']) ? false : true;
$is_good = (isset($wset['good']) && $wset['good']) ? false : true;

// 보임항목
$is_use = (isset($wset['use']) && $wset['use']) ? true : false;
$is_qa = (isset($wset['qa']) && $wset['qa']) ? true : false;
$is_hit = (isset($wset['hit']) && $wset['hit']) ? true : false;

$is_info = ($is_star || $is_use || $is_qa || $is_buy || $is_cmt || $is_good || $is_hit) ? true : false;

// 그림자
$is_shadow = (isset($wset['shadow']) && $wset['shadow']) ? apms_shadow($wset['shadow']) : '';

for ($i=0; $i < $list_cnt; $i++) { 

	$item_label = $dc = '';
	if($list[$i]['it_cust_price'] > 0 && $list[$i]['it_price'] > 0) {
		$dc = round((($list[$i]['it_cust_price'] - $list[$i]['it_price']) / $list[$i]['it_cust_price']) * 100);
	}

	// 아이콘
	$item_icon = item_icon($list[$i]);
?>
	<div class="item-row">
		<div class="item-list item-col is-round-item">
			<div class="bg-white">
				<div class="item-image">
					<?php if($wset['thumb_h'] > 0) { // 이미지 높이값이 있을 경우?>
						<div class="imgframe">
							<div class="img-wrap is-round-item-img">
								<a href="<?php echo $list[$i]['href'];?>">
									<?php if($list[$i]['it_point']) { ?>
										<div class="item-point rank-icon trans-bg-<?php echo $wset['pbg'];?>">
											<span><?php echo ($list[$i]['it_point_type'] == 2) ? $list[$i]['it_point'].'%' : number_format(get_item_point($list[$i])).' '.AS_MP;?></span> 적립
										</div>
									<?php } ?>
									<div class="img-item" style="overflow:hidden;">
										<img src="<?php echo $list[$i]['img']['src'];?>" alt="<?php echo $list[$i]['img']['alt'];?>" class="wr-img">
									</div>
								</a>
							</div>
						</div>
					<?php } else { ?>
						<div class="item-img is-round-item-img">
							<a href="<?php echo $list[$i]['href'];?>">
								<?php echo $item_label;?>
								<?php if($item_icon) { ?>
									<div class="item-icon"><?php echo $item_icon;?></div>
								<?php } ?>
								<?php if($list[$i]['it_point']) { ?>
									<div class="item-point rank-icon trans-bg-<?php echo $wset['pbg'];?>">
										<span><?php echo ($list[$i]['it_point_type'] == 2) ? $list[$i]['it_point'].'%' : number_format(get_item_point($list[$i])).' '.AS_MP;?></span> 적립
									</div>
								<?php } ?>
								<img src="<?php echo $list[$i]['img']['src'];?>" alt="<?php echo $list[$i]['img']['alt'];?>" class="wr-img">
							</a>
						</div>
					<?php } ?>
				</div>
				<div class="is-item-content">
					<?php echo $is_shadow; //그림자 ?>
					<div class="item-content">
						<a href="<?php echo $list[$i]['href'];?>">
							<?php if ($is_rank) { ?>
								<span class="rank-icon en bg-<?php echo $is_rank;?>"><?php echo $rank;?></span>	
							<?php } ?>
							<?php echo $list[$i]['it_name'];?>
							<div class="item-desc text-muted">
								<?php echo $list[$i]['it_basic']; ?>
							</div>
							<div class="price-box">
								<div class="item-desc text-muted">
									헬로렌탈 월 <span>0</span>원
								</div>
								<div class="item-desc text-muted">
									카드할인 월 <span>0</span>원
								</div>
								<div class="item-desc text-muted">
									현금사은품 <span>0</span>원
								</div>								
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $rank++; } ?>
<?php if(!$is_ajax && !$list_cnt) { ?>
	<div class="item-none text-center text-muted">
		등록된 상품이 없습니다.
	</div>
<?php } ?>