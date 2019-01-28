<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 썸네일 만들기
function apms_get_item_thumbnail($img, $width, $height=0, $id='') {

    $file = G5_DATA_PATH.'/item/'.$img;

	if(is_file($file))
        $size = @getimagesize($file);

    if($size[2] < 1 || $size[2] > 3)
        return;

	if($width > 0) {
		$img_width = $size[0];
		$img_height = $size[1];
		$filename = basename($file);
		$filepath = dirname($file);

		$thumb = thumbnail($filename, $filepath, $filepath, $width, $height, false, true);

		if($thumb) {
			$file_url = str_replace(G5_PATH, G5_URL, $filepath.'/'.$thumb);
			$str = '<img src="'.$file_url.'"';
			if($id)
				$str .= ' id="'.$id.'"';
			$str .= ' alt="">';
		} else {
			return;
		}
	} else {
	    $file_url = G5_DATA_URL.'/item/'.$img;
	}

	$str = '<img src="'.$file_url.'"';
	if($id)
		$str .= ' id="'.$id.'"';
	$str .= ' alt="">';

    return $str;
}

// 관련상품 전체 추출을 위해서 재세팅함
$rmods = 100;
$rrows = 1;

// 버튼
$btn1 = (isset($wset['btn1']) && $wset['btn1']) ? $wset['btn1'] : 'navy';
$btn2 = (isset($wset['btn2']) && $wset['btn2']) ? $wset['btn2'] : 'color';

// 별점
$wset['istar'] = (isset($wset['istar']) && $wset['istar']) ? $wset['istar'] : 'red';

// 큰이미지
$big_w = (isset($wset['big_w']) && ($wset['big_w'] > 0 || $wset['big_w'] == "0")) ? $wset['big_w'] : 800;
$big_h = (isset($wset['big_h']) && ($wset['big_h'] > 0 || $wset['big_h'] == "0")) ? $wset['big_h'] : 800;

// 헤드스킨
if(isset($wset['hskin']) && $wset['hskin']) {
	add_stylesheet('<link rel="stylesheet" href="'.G5_CSS_URL.'/head/'.$wset['hskin'].'.css" media="screen">', 0);
	$head_class = 'list-head';
} else {
	$head_class = (isset($wset['hcolor']) && $wset['hcolor']) ? 'border-'.$wset['hcolor'] : 'border-black';
}

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$item_skin_url.'/style.css" media="screen">', 0);

if($is_orderable) echo '<script src="'.$item_skin_url.'/shop.js"></script>'.PHP_EOL;

$new = ($it['pt_num'] >= (G5_SERVER_TIME - (24 * 3600))) ? true : false;

// 할인
$cur_price = $dc = '';
if($it['it_cust_price'] > 0 && $it['it_price'] > 0) {
	$dc = round((($it['it_cust_price'] - $it['it_price']) / $it['it_cust_price']) * 100);
	$cur_price = '<strike>'.number_format($it['it_cust_price']).'원</strike> ';
	$cur_price .= '<span class="dc">'.$dc.'% DC</span> ';
}

// 아이콘
$item_icon = item_icon($it);

// 이용기간
if($is_ramintime) { 
	$remain_day = (int)(($is_reamintime - G5_SERVER_TIME) / 86400); //남은일수
	$attach_list .= '<a class="list-group-item" href="#"><i class="fa fa-bell"></i> '.date("Y.m.d H:i", $is_remaintime).'('.number_format($remain_day).'일 남음)까지 이용가능합니다.</a>'.PHP_EOL;
}

$it_comment_cnt = ($it['pt_comment'] > 0) ? ' <b class="orangered en">'.number_format($it['pt_comment']).'</b>' : 0;
$it_use_cnt = ($item_use_count > 0) ? ' <b class="orangered en">'.number_format($item_use_count).'</b>' : 0;
$it_qa_cnt = ($item_qa_count > 0) ? ' <b class="orangered en">'.number_format($item_qa_count).'</b>' : 0;

$is_seller = ($it['pt_id'] && $it['pt_id'] != $config['cf_admin']) ? true : false;

// 상단 네비
if($nav_title) {
	$nav_cnt = count($nav);
	for($i=0;$i < $nav_cnt; $i++) { 
		$nav[$i]['nav'] = '<a href="./list.php?ca_id='.$nav[$i]['ca_id'].'"><span class="text-muted">'.$nav[$i]['name'];
		if($nav[$i]['cnt']) {
			$nav[$i]['nav'] .= '('.number_format($nav[$i]['cnt']).')';
		}
		$nav[$i]['nav'] .= '</span></a>';
	}
	$page_name = $nav_title;
	$page_nav1 = $nav[0]['nav'];
	$page_nav2 = $nav[1]['nav'];
	$page_nav3 = $nav[2]['nav'];
}

//헤더 네비
if($nav_title) {
	$header_skin = (isset($wset['header_skin']) && $wset['header_skin']) ? $wset['header_skin'] : 'basic';
	if($header_skin != 'none') {
		$header_color = (isset($wset['header_color']) && $wset['header_color']) ? $wset['header_color'] : 'navy';
		include_once('./header.php');
	}
}

?>

<div class="item-wrap">

	<?php echo $it_head_html; // 상단 HTML; ?>

	<div class="item-head">
		<div class="row">
			<div class="col-sm-6 col img-container">
				<?php if($item_icon) { ?>
					<div class="label-tack"><?php echo $item_icon; ?></div>
				<?php } ?>
				<?php if($dc) {?>
					<div class="label-band bg-red">DC</div>
				<?php } else if($new) {?>
					<div class="label-band bg-blue">New</div>
				<?php } ?>
				<div id="sit_pvi">
					<div id="sit_pvi_big">
						<?php
						$big_img_count = 0;
						$thumbnails = array();
						for($i=1; $i<=10; $i++) {
							if(!$it['it_img'.$i])
								continue;

							// 큰이미지 썸네일
							$img = apms_get_item_thumbnail($it['it_img'.$i], $big_w, $big_h);;

							if($img) {
								// 썸네일
								$thumb = apms_get_item_thumbnail($it['it_img'.$i], 60, 60);
								$thumbnails[] = $thumb;
								$thumb_first = ($big_img_count) ? '' : ' visible';
								echo '<a href="'.G5_SHOP_URL.'/largeimage.php?it_id='.$it['it_id'].'&amp;no='.$i.'" target="_blank" class="popup_item_image'.$thumb_first.'">'.$img.'</a>';

								$big_img_count++;
							}
						}
						?>
					</div>
					<?php 
						// 그림자
						if(isset($wset['ishadow']) && $wset['ishadow']) echo apms_shadow($wset['ishadow']);

						// 썸네일
						$thumb1 = true;
						$thumb_count = 0;
						$total_count = count($thumbnails);
						if($total_count > 0) {
							echo '<div id="sit_pvi_thumb">';
							foreach($thumbnails as $val) {
								$thumb_count++;
								echo '<a class="img_thumb">'.$val.'<span class="sound_only"> '.$thumb_count.'번째 이미지 새창</span></a>';
							}
							echo '</div>';
						}
					?>
				</div>
			</div>
			<div class="col-sm-6 col form-container">
				<div id="buy_form" class="text">
					<h1><?php echo stripslashes($it['it_name']); // 상품명 ?></h1>
					<?php if($it['it_basic']) { ?>
						<div class="desc"><?php echo $it['it_basic']; ?></div>
					<?php } ?>
					<div class="price font-16 en">
						<?php if ($it['it_use_avg']) { ?>
							<div class="pull-right">
								<span class="font-20 <?php echo $wset['istar'];?>"><?php echo apms_get_star($it['it_use_avg']); //평균별점 ?></span>
							</div>
						<?php } ?>
						<div class="pull-left">
							<?php if (!$it['it_use']) { // 판매가능이 아닐 경우 ?>
								<b>판매중지</b>
							<?php } else if ($it['it_tel_inq']) { // 전화문의일 경우 ?>
								<b class="blue">전화문의</b>
							<?php } else { // 전화문의가 아닐 경우?>
								<b class="font-18 red"><?php echo display_price(get_price($it), $it['it_tel_inq']);?></b>
								<?php echo $cur_price;?>
							<?php } ?>
						</div>
						<div class="clearfix"></div>
					</div>

					<form name="fitem" method="post" action="<?php echo $action_url; ?>" class="form" role="form" onsubmit="return fitem_submit(this);">
					<input type="hidden" name="it_id[]" value="<?php echo $it_id; ?>">
					<input type="hidden" name="it_msg1[]" value="<?php echo $it['pt_msg1']; ?>">
					<input type="hidden" name="it_msg2[]" value="<?php echo $it['pt_msg2']; ?>">
					<input type="hidden" name="it_msg3[]" value="<?php echo $it['pt_msg3']; ?>">
					<input type="hidden" name="sw_direct">
					<input type="hidden" name="url">
					<?php if ($it['it_use'] && !$it['it_tel_inq']) { ?>
						<input type="hidden" id="it_price" value="<?php echo get_price($it); ?>">
					<?php } ?>

					<div class="option-line"></div>

					<div id="item_option">
						<table class="table option-tbl">
						<tbody>
						<?php if ($it['it_maker']) { ?>
							<tr><th>제조사</th><td><?php echo $it['it_maker']; ?></td></tr>
						<?php } ?>
						<?php if ($it['it_origin']) { ?>
							<tr><th>원산지</th><td><?php echo $it['it_origin']; ?></td></tr>
						<?php } ?>
						<?php if ($it['it_brand']) { ?>
							<tr><th>브랜드</th><td><?php echo $it['it_brand']; ?></td></tr>
						<?php } ?>
						<?php if ($it['it_model']) { ?>
							<tr><th>모델</th><td><?php echo $it['it_model']; ?></td></tr>
						<?php } ?>
						<?php if($it['it_maker'] || $it['it_origin'] || $it['it_brand'] || $it['it_model']) { ?>
							<tr><td colspan="2"><div class="option-line"></div></td></tr>
						<?php } ?>
						<?php if ($config['cf_use_point']) { // 포인트 사용한다면 ?> 
							<tr>
							<th>포인트</th>
							<td>
								<?php
									if($it['it_point_type'] == 2) {
										echo '구매금액(추가옵션 제외)의 '.$it['it_point'].'%';
									} else {
										$it_point = get_item_point($it);
										echo number_format($it_point).'점';
									}
								?>
								적립
							</td>
							</tr>
						<?php } ?>
						<?php
							$ct_send_cost_label = '배송비';

							if($it['it_sc_type'] == 1)
								$sc_method = '무료배송';
							else {
								if($it['it_sc_method'] == 1)
									$sc_method = '수령후 지불';
								else if($it['it_sc_method'] == 2) {
									$ct_send_cost_label = '<label for="ct_send_cost">배송비결제</label>';
									$sc_method = '<select name="ct_send_cost" id="ct_send_cost" class="form-control input-sm">
													  <option value="0">주문시 결제</option>
													  <option value="1">수령후 지불</option>
												  </select>';
								}
								else
									$sc_method = '주문시 결제';
							}
						?>
						<tr><th><?php echo $ct_send_cost_label; ?></th><td><?php echo $sc_method; ?></td></tr>
						<?php if($option_item) { ?>
							<?php echo $option_item; // 선택옵션	?>
						<?php }	?>
						<?php if($supply_item) { ?>
							<?php echo $supply_item; // 추가옵션 ?>
						<?php }	?>
						</tbody>
						</table>

						<?php if($is_soldout) { ?>
							<p id="sit_ov_soldout" class="help-block font-11 blue">현재 재고가 부족하여 구매할 수 없습니다.</p>
						<?php } else { ?>
							<?php if($it['it_buy_min_qty'] || $it['it_buy_max_qty']) { ?>
								<p class="help-block font-11">
									<?php if($it['it_buy_min_qty']) { ?>
										최소 구매수량은 <b class="red"><?php echo number_format($it['it_buy_min_qty']); ?>개</b>
									<?php } ?>
									<?php if($it['it_buy_min_qty'] && $it['it_buy_max_qty']) { ?>
										,
									<?php } ?>
									<?php if($it['it_buy_max_qty']) { ?>
										최대 구매수량은 <b class="red"><?php echo number_format($it['it_buy_max_qty']); ?>개</b>
									<?php } ?>
									입니다.
								</p>
							<?php } ?>
						<?php } ?>

						<?php if ($is_orderable) { ?>
							<div id="it_sel_option">
								<?php
								if(!$option_item) {
									if(!$it['it_buy_min_qty'])
										$it['it_buy_min_qty'] = 1;
								?>
									<ul id="it_opt_added" class="list-group">
										<li class="it_opt_list list-group-item">
											<input type="hidden" name="io_type[<?php echo $it_id; ?>][]" value="0">
											<input type="hidden" name="io_id[<?php echo $it_id; ?>][]" value="">
											<input type="hidden" name="io_value[<?php echo $it_id; ?>][]" value="<?php echo $it['it_name']; ?>">
											<input type="hidden" class="io_price" value="0">
											<input type="hidden" class="io_stock" value="<?php echo $it['it_stock_qty']; ?>">
											<div class="row">
												<div class="col-sm-6">
													<label>
														<span class="it_opt_subj"><?php echo $it['it_name']; ?></span>
														<span class="it_opt_prc"><span class="sound_only">(+0원)</span></span>
													</label>
												</div>
												<div class="col-sm-6">
													<div class="input-group">
														<label for="ct_qty_<?php echo $i; ?>" class="sound_only">수량</label>
														<input type="text" name="ct_qty[<?php echo $it_id; ?>][]" value="<?php echo $it['it_buy_min_qty']; ?>" id="ct_qty_<?php echo $i; ?>" class="form-control input-sm" size="5">
														<div class="input-group-btn">
															<button type="button" class="it_qty_plus btn btn-lightgray btn-sm"><i class="fa fa-plus-circle fa-lg"></i><span class="sound_only">증가</span></button>
															<button type="button" class="it_qty_minus btn btn-lightgray btn-sm"><i class="fa fa-minus-circle fa-lg"></i><span class="sound_only">감소</span></button>
														</div>
													</div>
												</div>
											</div>
											<?php if($it['pt_msg1']) { ?>
												<div class="option-msg">
													<input type="text" name="pt_msg1[<?php echo $it_id; ?>][]" class="form-control input-sm" placeholder="<?php echo $it['pt_msg1'];?>">
												</div>
											<?php } ?>
											<?php if($it['pt_msg2']) { ?>
												<div class="option-msg">
													<input type="text" name="pt_msg2[<?php echo $it_id; ?>][]" class="form-control input-sm" placeholder="<?php echo $it['pt_msg2'];?>">
												</div>
											<?php } ?>
											<?php if($it['pt_msg3']) { ?>
												<div class="option-msg">
													<input type="text" name="pt_msg3[<?php echo $it_id; ?>][]" class="form-control input-sm" placeholder="<?php echo $it['pt_msg3'];?>">
												</div>
											<?php } ?>
										</li>
									</ul>
									<script>
									$(function() {
										price_calculate();
									});
									</script>
								<?php } ?>
							</div>
							<!-- 총 구매액 -->
							<div class="price-sum">
								총 금액 <b><span id="it_tot_price" class="font-20 red en">0원</span></b>
							</div>
						<?php } ?>
					</div>

					<div class="item-form-footer text-center">
						<?php if ($is_orderable) { ?>
							<ul class="item-form-btn">
							<li>
								<a href="#" class="btn btn-item btn-block" onclick="apms_wishlist('<?php echo $it['it_id']; ?>'); return false;">
									<i class="fa fa-heart fa-lg red"></i> 위시
								</a>
							</li>
							<li>
								<a href="#" class="btn btn-item btn-block" onclick="apms_recommend('<?php echo $it['it_id']; ?>', '<?php echo $ca_id; ?>'); return false;">
									<i class="fa fa-envelope fa-lg green"></i> 추천
								</a>
							</li>
							<li><input type="submit" onclick="document.pressed=this.value;" value="바로구매" class="btn btn-<?php echo $btn2;?> btn-block"></li>
							<li><input type="submit" onclick="document.pressed=this.value;" value="장바구니" class="btn btn-<?php echo $btn1;?> btn-block"></li>
							</ul>
							<?php if ($naverpay_button_js) { ?>
								<div class="text-right" style="margin:10px 0px;"><?php echo $naverpay_request_js.$naverpay_button_js; ?></div>
							<?php } ?>
						<?php } ?>
						<?php if(!$is_orderable && $it['it_soldout'] && $it['it_stock_sms']) { ?>
							<button type="button" onclick="popup_stocksms('<?php echo $it['it_id']; ?>','<?php echo $ca_id; ?>');" class="btn btn-<?php echo $btn2;?> btn-lg">재입고알림(SMS)</a>
						<?php } ?>
						<div class="clearfix"></div>
					</div>
					</form>

					<script>
						// BS3
						$(function() {
							$("select.it_option").addClass("form-control input-sm");
							$("select.it_supply").addClass("form-control input-sm");
						});

						// 재입고SMS 알림
						function popup_stocksms(it_id, ca_id) {
							url = "./itemstocksms.php?it_id=" + it_id + "&ca_id=" + ca_id;
							opt = "scrollbars=yes,width=616,height=420,top=10,left=10";
							popup_window(url, "itemstocksms", opt);
						}

						// 바로구매, 장바구니 폼 전송
						function fitem_submit(f) {
							if (document.pressed == "장바구니") {
								f.sw_direct.value = 0;
							} else { // 바로구매
								f.sw_direct.value = 1;
							}

							// 판매가격이 0 보다 작다면
							if (document.getElementById("it_price").value < 0) {
								alert("전화로 문의해 주시면 감사하겠습니다.");
								return false;
							}

							if($(".it_opt_list").size() < 1) {
								alert("선택옵션을 선택해 주십시오.");
								return false;
							}

							var val, io_type, result = true;
							var sum_qty = 0;
							var min_qty = parseInt(<?php echo $it['it_buy_min_qty']; ?>);
							var max_qty = parseInt(<?php echo $it['it_buy_max_qty']; ?>);
							var $el_type = $("input[name^=io_type]");

							$("input[name^=ct_qty]").each(function(index) {
								val = $(this).val();

								if(val.length < 1) {
									alert("수량을 입력해 주십시오.");
									result = false;
									return false;
								}

								if(val.replace(/[0-9]/g, "").length > 0) {
									alert("수량은 숫자로 입력해 주십시오.");
									result = false;
									return false;
								}

								if(parseInt(val.replace(/[^0-9]/g, "")) < 1) {
									alert("수량은 1이상 입력해 주십시오.");
									result = false;
									return false;
								}

								io_type = $el_type.eq(index).val();
								if(io_type == "0")
									sum_qty += parseInt(val);
							});

							if(!result) {
								return false;
							}

							if(min_qty > 0 && sum_qty < min_qty) {
								alert("선택옵션 개수 총합 "+number_format(String(min_qty))+"개 이상 주문해 주십시오.");
								return false;
							}

							if(max_qty > 0 && sum_qty > max_qty) {
								alert("선택옵션 개수 총합 "+number_format(String(max_qty))+"개 이하로 주문해 주십시오.");
								return false;
							}

							if (document.pressed == "장바구니") {
								$.post("./itemcart.php", $(f).serialize(), function(error) {
									if(error != "OK") {
										alert(error.replace(/\\n/g, "\n"));
										return false;
									} else {
										if(confirm("장바구니에 담겼습니다.\n\n바로 확인하시겠습니까?")) {
											document.location.href = "./cart.php";
										}
									}
								});
								return false;
							} else {
								return true;
							}
						}

						// Wishlist
						function apms_wishlist(it_id) {
							if(!it_id) {
								alert("코드가 올바르지 않습니다.");
								return false;
							}

							$.post("./itemwishlist.php", { it_id: it_id },	function(error) {
								if(error != "OK") {
									alert(error.replace(/\\n/g, "\n"));
									return false;
								} else {
									if(confirm("위시리스트에 담겼습니다.\n\n바로 확인하시겠습니까?")) {
										document.location.href = "./wishlist.php";
									}
								}
							});

							return false;
						}

						// Recommend
						function apms_recommend(it_id, ca_id) {
							if (!g5_is_member) {
								alert("회원만 추천하실 수 있습니다.");
							} else {
								url = "./itemrecommend.php?it_id=" + it_id + "&ca_id=" + ca_id;
								opt = "scrollbars=yes,width=616,height=420,top=10,left=10";
								popup_window(url, "itemrecommend", opt);
							}
						}
					</script>

					<div class="sns-icon pull-right">
						<div class="sns-share-icon">
							<?php 
								$sns_url  = G5_SHOP_URL.'/item.php?it_id='.$it_id;
								$sns_title = get_text($it['it_name'].' | '.$config['cf_title']);
								$sns_img = $item_skin_url.'/img';
								echo  get_sns_share_link('facebook', $sns_url, $sns_title, $sns_img.'/sns_fb.png', $seometa['img']['src']).' ';
								echo  get_sns_share_link('twitter', $sns_url, $sns_title, $sns_img.'/sns_twt.png', $seometa['img']['src']).' ';
								echo  get_sns_share_link('googleplus', $sns_url, $sns_title, $sns_img.'/sns_goo.png', $seometa['img']['src']).' ';
								echo  get_sns_share_link('kakaostory', $sns_url, $sns_title, $sns_img.'/sns_kakaostory.png', $seometa['img']['src']).' ';
								echo  get_sns_share_link('kakaotalk', $sns_url, $sns_title, $sns_img.'/sns_kakao.png', $seometa['img']['src']).' ';
								echo  get_sns_share_link('naverband', $sns_url, $sns_title, $sns_img.'/sns_naverband.png', $seometa['img']['src']).' ';
							?>
						</div>
					</div>
					<div class="clearfix"></div>
					<?php if ($is_tag) { // 태그 ?>
						<p class="tag"><i class="fa fa-tags"></i> <?php echo $tag_list;?></p>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

	<div class="clearfix"></div>

	<?php if($is_viewer || $is_link) { 
		// 보기용 첨부파일 확장자에 따른 FA 아이콘 - array(이미지, 비디오, 오디오, PDF)
		$viewer_fa = array("picture-o", "video-camera", "music", "file-powerpoint-o");
	?>
		<div class="item-view-icon text-center">
			<ul>
			<?php if($is_link) { ?>
				<?php for($i=0; $i < count($link); $i++) { ?>
					<li>
						<a href="<?php echo $link[$i]['url']; ?>" target="_blank"<?php echo ($link[$i]['name']) ? ' title="'.$link[$i]['name'].'"' : ''; ?>>
							<i class="fa fa-<?php echo ($link[$i]['fa']) ? $link[$i]['fa'] : 'link';?> circle light-circle normal"></i>
							<span>관련링크</span>
						</a>
					</li>
				<?php } ?>
			<?php } ?>

			<?php if($is_viewer) { ?>
				<?php for($i=0; $i < count($viewer); $i++) { $v = ($viewer[$i]['ext'] - 1); ?>
					<li>
					<?php if($viewer[$i]['href_view']) { ?>
						<a href="<?php echo $viewer[$i]['href_view'];?>" class="view_win">
							<i class="fa fa-<?php echo $viewer_fa[$v];?> circle light-circle normal"></i>
							<span><?php echo ($viewer[$i]['free']) ? '무료보기' : '바로보기';?></span>
						</a>
					<?php } else { ?>
						<a onclick="alert('구매한 회원만 볼 수 있습니다.');">
							<i class="fa fa-<?php echo $viewer_fa[$v];?> circle light-circle normal"></i>
							<span>유료보기</span>
						</a>
					<?php } ?>
					</li>
				<?php } ?>
			<?php } ?>
			</ul>
			<div class="clearfix"></div>
		</div>
		<script>
			var view_win = function(href) {
				var new_win = window.open(href, 'view_win', 'left=0,top=0,width=640,height=480,toolbar=0,location=0,scrollbars=0,resizable=1,status=0,menubar=0');
				new_win.focus();
			}
			$(function() {
				$(".view_win").click(function() {
					view_win(this.href);
					return false;
				});
			});
		</script>
	<?php } ?>

	<?php if($is_download) { 
		$download_cnt = count($download);	
	?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-download"></i> Download</h3>
			</div>
			<div class="list-group">
				<?php for($i=0; $i < $download_cnt; $i++) { ?>
					<a class="list-group-item font-16 en" href="<?php echo ($download[$i]['href']) ? $download[$i]['href'] : 'javascript:alert(\'구매한 회원만 다운로드할 수 있습니다.\');';?>">
						<?php echo $i + 1;?>. <?php echo $download[$i]['source'];?> <span class="font-13">(<?php echo $download[$i]['size'];?>)</span>
						<?php if($download[$i]['free']) { ?>
							<?php if($download[$i]['guest_use']) { ?>
								<span class="label label-default pull-right down-label">무료</span> 
							<?php } else { ?>
								<span class="label label-primary pull-right down-label">회원</span> 
							<?php } ?>
						<?php } else { ?>
							<span class="label label-danger pull-right down-label">유료</span> 
						<?php } ?>
					</a>
				<?php } ?>
			</div>
		</div>
	<?php } ?>

	<?php if ($is_torrent) { // 토렌트 파일정보 ?>
		<?php for($i=0; $i < count($torrent); $i++) { ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-cube"></i> <?php echo $torrent[$i]['name'];?></h3>
				</div>
				<div class="panel-body">
					<span class="pull-right hidden-xs text-muted en font-11"><i class="fa fa-clock-o"></i> <?php echo date("Y-m-d H:i", $torrent[$i]['date']);?></span>
					<?php if ($torrent[$i]['is_size']) { ?>
							<b class="en font-16"><i class="fa fa-cube"></i> <?php echo $torrent[$i]['info']['name'];?> (<?php echo $torrent[$i]['info']['size'];?>)</b>
					<?php } else { ?>
						<p><b class="en font-16"><i class="fa fa-cubes"></i> Total <?php echo $torrent[$i]['info']['total_size'];?></b></p>
						<div class="text-muted font-12">
							<?php for ($j=0;$j < count($torrent[$i]['info']['file']);$j++) { 
								echo ($j + 1).'. '.implode(', ', $torrent[$i]['info']['file'][$j]['name']).' ('.$torrent[$i]['info']['file'][$j]['size'].')<br>'."\n";
							} ?>
						</div>
					<?php } ?>
				</div>
				<ul class="list-group">
					<li class="list-group-item en font-14 break-word"><i class="fa fa-magnet"></i> <?php echo $torrent[$i]['magnet'];?></li>
					<li class="list-group-item break-word">
						<div class="text-muted" style="font-size:12px;">
							<?php for ($j=0;$j < count($torrent[$i]['tracker']);$j++) { ?>
								<i class="fa fa-tags"></i> <?php echo $torrent[$i]['tracker'][$j];?><br>
							<?php } ?>
						</div>
					</li>
					<?php if($torrent[$i]['comment']) { ?>
						<li class="list-group-item en font-14 break-word"><i class="fa fa-bell"></i> <?php echo $torrent[$i]['comment'];?></li>
					<?php } ?>
				</ul>
			</div>
		<?php } ?>
	<?php } ?>

	<div id="tspot"></div>

	<div class="item-tab">
		<div class="tabs">
			<ul class="nav nav-tabs tabs-top">
				<li class="tab-explan active"><a href="#item_tab1" data-toggle="tab" ref="explan" tid="0">상품상세설명</a></li>
				<li class="tab-delivery"><a href="#item_tab5" data-toggle="tab" ref="delivery" tid="0">필수/배송/교환/반품</a></li>
				<?php $tab_last = true; ?>
				<?php if ($write_href) { ?>
					<li class="tab-right<?php echo ($tab_last) ? ' last' : '';?>"><a href="<?php echo $write_href;?>">등록</a></li>
				<?php $tab_last = false; } ?>
				<?php if($edit_href) { ?>
					<li class="tab-right<?php echo ($tab_last) ? ' last' : '';?>"><a href="<?php echo $edit_href;?>">수정</a></li>
				<?php $tab_last = false; } ?>
				<?php if($next_href) { ?>
					<li class="tab-right<?php echo ($tab_last) ? ' last' : '';?>"><a href="<?php echo $next_href;?>" title="<?php echo $next_item;?>">다음상품</a></li>
				<?php $tab_last = false; } ?>
				<?php if($prev_href) { ?>
					<li class="tab-right<?php echo ($tab_last) ? ' last' : '';?>"><a href="<?php echo $prev_href;?>" title="<?php echo $prev_item;?>">이전상품</a></li>
				<?php } ?>
			</ul>
			<div class="tab-content bg-white">
				<div class="tab-pane active" id="item_tab1">
					<div class="item-explan img-resize">
						<?php echo apms_link_video($link_video); // 링크 비디오 체크 ?>
						<?php if ($it['pt_explan']) { // 구매회원에게만 추가로 보이는 상세설명 ?>
							<div class="well"><?php echo apms_explan($it['pt_explan']); ?></div>
						<?php } ?>
						<?php echo apms_explan($it['it_explan']); ?>
					</div>

					<?php if ($is_good) { // 추천 ?>
						<div class="item-good-box">
							<span class="item-good">
								<a href="#" onclick="apms_good('<?php echo $it_id;?>', '', 'good', 'it_good'); return false;">
									<b id="it_good"><?php echo number_format($it['pt_good']) ?></b>
									<br>
									<i class="fa fa-thumbs-up"></i>
								</a>
							</span>
							<span class="item-nogood">
								<a href="#" onclick="apms_good('<?php echo $it_id;?>', '', 'nogood', 'it_nogood'); return false;">
									<b id="it_nogood"><?php echo number_format($it['pt_nogood']) ?></b>
									<br>
									<i class="fa fa-thumbs-down"></i>
								</a>
							</span>
						</div>
					<?php } ?>

					<?php if ($is_tag) { // 태그 ?>
						<p class="text-muted"><i class="fa fa-tags"></i> <?php echo $tag_list;?></p>
					<?php } ?>

					<?php if ($is_ccl) { // CCL ?>
						<div class="well">
							<img src="<?php echo $ccl_img;?>" alt="CCL" />  &nbsp; 본 자료는 <u><?php echo $ccl_license;?></u>에 따라 이용할 수 있습니다.
						</div>
					<?php } ?>

					<?php if(isset($wset['seller']) && $wset['seller']) { // 판매자 ?>
						<div class="panel panel-default item-seller">
							<div class="panel-heading">
								<h3 class="panel-title">
									<?php if($author['partner']) { ?>
										<a href="<?php echo $at_href['myshop'];?>?id=<?php echo $author['mb_id'];?>" class="pull-right">
											<span class="label label-primary"><span class="font-11 en">My Shop</span></span>
										</a>
									<?php } ?>
									Seller
								</h3>
							</div>
							<div class="panel-body">
								<div class="pull-left text-center auth-photo">
									<div class="img-photo">
										<?php echo ($author['photo']) ? '<img src="'.$author['photo'].'" alt="">' : '<i class="fa fa-user"></i>'; ?>
									</div>
									<div class="btn-group" style="margin-top:-30px;white-space:nowrap;">
										<button type="button" class="btn btn-color btn-sm" onclick="apms_like('<?php echo $author['mb_id'];?>', 'like', 'it_like'); return false;" title="Like">
											<i class="fa fa-thumbs-up"></i> <span id="it_like"><?php echo number_format($author['liked']) ?></span>
										</button>
										<button type="button" class="btn btn-color btn-sm" onclick="apms_like('<?php echo $author['mb_id'];?>', 'follow', 'it_follow'); return false;" title="Follow">
											<i class="fa fa-users"></i> <span id="it_follow"><?php echo $author['followed']; ?></span>
										</button>
									</div>
								</div>
								<div class="auth-info">
									<div style="margin-bottom:4px;">
										<span class="pull-right">Lv.<?php echo $author['level'];?></span>
										<b><?php echo $author['name']; ?></b> &nbsp;<span class="text-muted font-11"><?php echo $author['grade'];?></span>
									</div>
									<div class="div-progress progress progress-striped no-margin">
										<div class="progress-bar progress-bar-exp" role="progressbar" aria-valuenow="<?php echo round($author['exp_per']);?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($author['exp_per']);?>%;">
											<span class="sr-only"><?php echo number_format($author['exp']);?> (<?php echo $author['exp_per'];?>%)</span>
										</div>
									</div>
									<p style="margin-top:10px;">
										<?php echo ($author['signature']) ? $author['signature'] : '등록된 서명이 없습니다.'; ?>
									</p>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					<?php } ?>
				</div>

				<div class="tab-pane" id="item_tab5">
					<?php include_once($item_skin_path.'/item.delivery.php'); // 필수 및 배송정보?>
				</div>

			</div>
			<ul class="nav nav-tabs tabs-bottom">
				<li class="tab-explan active"><a href="#item_tab1" data-toggle="tab" ref="explan" tid="1">상품상세설명</a></li>
				<li class="tab-delivery"><a href="#item_tab5" data-toggle="tab" ref="delivery" tid="1">필수/배송/교환/반품</a></li>
				<?php if($prev_href) { ?>
					<li><a href="<?php echo $prev_href;?>" title="<?php echo $prev_item;?>">이전상품</a></li>
				<?php } ?>
				<?php if($next_href) { ?>
					<li><a href="<?php echo $next_href;?>" title="<?php echo $next_item;?>">다음상품</a></li>
				<?php } ?>
			</ul>
		</div>
	</div>

	<div class="h20"></div>

	<?php if ($is_relation) { ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-share-alt"></i> Relation Items</h3>
			</div>
			<div class="panel-body">
				<div id="itemrelation">
					<?php include_once('./itemrelation.php'); ?>
				</div>
			</div>
		</div>
	<?php } ?>

	<!-- 위젯에서 해당글 클릭시 이동위치 : icv - 댓글, iuv - 후기, iqv - 문의 -->
	<div id="iuv"></div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-camera"></i> <span class="font-18"><?php echo $it_use_cnt;?></span> Reviews</h3>
		</div>
		<div class="panel-body" style="padding-bottom:0px;">
			<div id="itemuse">
				<?php include_once('./itemuse.php'); ?>
			</div>
		</div>
	</div>

	<div id="iqv"></div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-comments-o"></i> <span class="font-18"><?php echo $it_qa_cnt;?></span> Questions</h3>
		</div>
		<div class="panel-body" style="padding-bottom:0px;">
			<div id="itemqa">
				<?php include_once('./itemqa.php'); ?>
			</div>
		</div>
	</div>

	<?php if($is_comment) { ?>
		<div id="icv"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-commenting"></i> <span class="font-18"><?php echo $it_comment_cnt;?></span> Comments</h3>
			</div>
			<div class="panel-body">
				<?php include_once('./itemcomment.php'); ?>
			</div>
		</div>
	<?php } ?>

	<?php echo $it_tail_html; // 하단 HTML ?>

	<div class="btn-group btn-group-justified">
		<?php if($prev_href) { ?>
			<a class="btn btn-<?php echo $btn1;?>" href="<?php echo $prev_href;?>" title="<?php echo $prev_item;?>"><i class="fa fa-chevron-circle-left"></i> 이전</a>
		<?php } ?>
		<?php if($next_href) { ?>
			<a class="btn btn-<?php echo $btn1;?>" href="<?php echo $next_href;?>" title="<?php echo $next_item;?>"><i class="fa fa-chevron-circle-right"></i> 다음</a>
		<?php } ?>
		<?php if($edit_href) { ?>
			<a class="btn btn-<?php echo $btn1;?>" href="<?php echo $edit_href;?>"><i class="fa fa-plus"></i><span class="hidden-xs"> 수정</span></a>
		<?php } ?>
		<?php if ($write_href) { ?>
			<a class="btn btn-<?php echo $btn1;?>" href="<?php echo $write_href;?>"><i class="fa fa-upload"></i><span class="hidden-xs"> 등록</span></a>
		<?php } ?>
		<?php if($item_href) { ?>
			<a class="btn btn-<?php echo $btn1;?>" href="<?php echo $item_href;?>"><i class="fa fa-th-large"></i><span class="hidden-xs"> 관리</span></a>
		<?php } ?>
		<?php if($setup_href) { ?>
			<a class="btn btn-<?php echo $btn1;?> win_memo" href="<?php echo $setup_href;?>"><i class="fa fa-cogs"></i><span class="hidden-xs"> 스킨설정</span></a>
		<?php } ?>
		<a class="btn btn-<?php echo $btn2;?>" href="<?php echo $list_href;?>"><i class="fa fa-bars"></i> 목록</a>
	</div>

	<div class="h30"></div>
</div>

<script>
$(function() {

	$('.item-tab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		var ref = $(e.target).attr("ref") // activated tab
		var tid = $(e.target).attr("tid") // activated tab
		$('.item-tab .nav-tabs li').removeClass('active');
		$('.tab-'+ref).addClass('active');
		if(tid == "1") {
			location.href = "#tspot";
		}
	});

    // 상품이미지 첫번째 링크
    $("#sit_pvi_big a:first").addClass("visible");

    // 상품이미지 미리보기 (썸네일에 마우스 오버시)
    $("#sit_pvi .img_thumb").bind("mouseover focus", function(){
        var idx = $("#sit_pvi .img_thumb").index($(this));
        $("#sit_pvi_big a.visible").removeClass("visible");
        $("#sit_pvi_big a:eq("+idx+")").addClass("visible");
    });

    // 상품이미지 크게보기
    $(".popup_item_image").click(function() {
        var url = $(this).attr("href");
        var top = 10;
        var left = 10;
        var opt = 'scrollbars=yes,top='+top+',left='+left;
        popup_window(url, "largeimage", opt);

        return false;
    });

	$("a.view_image").click(function() {
		window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
		return false;
	});
});
</script>

<?php include_once('./itemlist.php'); // 분류목록 ?>
