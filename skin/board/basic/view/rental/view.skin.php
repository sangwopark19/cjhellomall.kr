<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$view_skin_url.'/view.css" media="screen">', 0);

$attach_list = '';
if ($view['link']) {
	// 링크
	for ($i=1; $i<=count($view['link']); $i++) {
		if ($view['link'][$i]) {
			$attach_list .= '<a class="list-group-item break-word" href="'.$view['link_href'][$i].'" target="_blank">';
			$attach_list .= '<i class="fa fa-link"></i> '.cut_str($view['link'][$i], 70).' &nbsp;<span class="blue">+ '.$view['link_hit'][$i].'</span></a>'.PHP_EOL;
		}
	}
}

// 가변 파일
$j = 0;
if ($view['file']['count']) {
	for ($i=0; $i<count($view['file']); $i++) {
		if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
			if ($board['bo_download_point'] < 0 && $j == 0) {
				$attach_list .= '<a class="list-group-item"><i class="fa fa-bell red"></i> 다운로드시 <b>'.number_format(abs($board['bo_download_point'])).'</b>'.AS_MP.' 차감 (최초 1회 / 재다운로드시 차감없음)</a>'.PHP_EOL;
			}
			$file_tooltip = '';
			if($view['file'][$i]['content']) {
				$file_tooltip = ' data-original-title="'.strip_tags($view['file'][$i]['content']).'" data-toggle="tooltip"';
			}
			$attach_list .= '<a class="list-group-item break-word view_file_download at-tip" href="'.$view['file'][$i]['href'].'"'.$file_tooltip.'>';
			$attach_list .= '<span class="pull-right hidden-xs text-muted"><i class="fa fa-clock-o"></i> '.date("Y.m.d H:i", strtotime($view['file'][$i]['datetime'])).'</span>';
			$attach_list .= '<i class="fa fa-download"></i> '.$view['file'][$i]['source'].' ('.$view['file'][$i]['size'].') &nbsp;<span class="orangered">+ '.$view['file'][$i]['download'].'</span></a>'.PHP_EOL;
			$j++;
		}
	}
}

$view_font = (G5_IS_MOBILE) ? '' : ' font-12';
$view_subject = get_text($view['wr_subject']);

?>
<section itemscope itemtype="http://schema.org/NewsArticle">
	<article itemprop="articleBody">
		<div class="box">
			<div>
			<?php
				// 이미지 상단 출력
				$v_img_count = count($view['file']);
				if($v_img_count && $is_img_head) {
					echo '<div class="view-img">'.PHP_EOL;
					for ($i=0; $i<=count($view['file']); $i++) {
						if ($view['file'][$i]['view']) {
							echo get_view_thumbnail($view['file'][$i]['view']);
						}
					}
					echo '</div>'.PHP_EOL;
				}
			 ?>			
			</div>
			<div>
				<h2><?php echo cut_str(get_text($view['wr_subject']), 70); ?></h2>
				<div class="code">(<?php echo $view['wr_4']; ?>)</div>
				<p>
					<?php echo nl2br($view['wr_6']);?>
				</p>
				<hr>
				<div class="pay-box">
					<div class="pay-list">
						<div>색상/모델명</div>
						<div><span><?php echo $view['wr_4'];?></span></div>
					</div>
					<div class="pay-list">
						<div>CJ렌탈가</div>
						<div><span><?php echo $view['wr_2'];?></span></div>
					</div>
					<div class="pay-list">
						<div>카드할인가</div>
						<div><span class="big"><?php echo $view['wr_1'];?></span></div>
					</div>
					<div class="pay-list">
						<div>약정개월</div>
						<div><?php echo $view['wr_5'];?></div>
					</div>
					<div class="pay-list">
						<div>현금사은품</div>
						<div><?php echo $view['wr_3'];?></div>
					</div>
				</div>
				<hr>
				<div class="btn-box">
					<a class="rental-apply" href="/bbs/write.php?bo_table=m0705&target_table=<?php echo $bo_table;?>&target_id=<?php echo $wr_id;?>">렌탈신청</a>
					<a class="rental-sam" href="/bbs/write.php?bo_table=m0706">렌탈상담신청</a>
				</div>
				<div class="cacao-btn">
					<a class="rental-sam" href="#">
						<img src="/image/cacao.jpg" alt=""/>
						카카오톡 1:1상담
					</a>
				</div>
			</div>
		</div>

		<div class="view-padding">
			<div itemprop="description" class="view-content">
				<?php echo get_view_thumbnail($view['content']); ?>
			</div>

			<?php
				// 이미지 하단 출력
				if($v_img_count && $is_img_tail) {
					echo '<div class="view-img">'.PHP_EOL;
					for ($i=0; $i<=count($view['file']); $i++) {
						if ($view['file'][$i]['view']) {
							echo get_view_thumbnail($view['file'][$i]['view']);
						}
					}
					echo '</div>'.PHP_EOL;
				}
			?>
		</div>
		<hr>
		<div class="ex-txt">
			<div class="title-ex">고객안내사항</div>
			<div class="small-title">
				CJ 렌탈은 생활 가전을 월납(36/48/60개월 등)으로 이용하는 서비스입니다.
			</div>
			<ul class="ex-list">
				<li>
					○ CJ 렌탈 서비스는 고객에게 소유권을 유보한 할부매매 방식의 서비스로, 렌탈 된 제품 분할 납부 완료되면 고객님의 소유가 됩니다.
				</li>
				<li>
					○ 렌탈 상품은 고객 주소지로 제조사 직원이 직접 방문 설치 혹은 택배 배송합니다.
				</li>
				<li>○ 고객당 최대 3대까지 이용하실 수 있습니다.</li>
				<li>○ 헬로 렌탈 서비스 이용 기간 중, 상품의 중도 반납은 불가하며, 서비스 해지 시, 납부되어야 할 잔여 렌탈료가 다음달에 일괄 청구됩니다.</li>
				<li>○ 계약기간 동안 제품을 무단으로 타인에게 양도/재판매 등을 할 시 법적 조치를 받을 수 있습니다.</li>
				<li>○ 선택 사항(TV 벽걸이, 에어컨 추가 배관 설치, 건조기 거치대 등)은 추가 설치비가 발생하며, 배송 업체에 직접 납부하셔야 합니다. ○ CJ헬로 방송,
					인터넷, 인터넷 전화 서비스 동시 신규가입의 경우, 렌탈 상품은 방송, 인터넷, 인터넷 전화 서비스 상품 설치 완료 후 배송 됩니다.</li>
				<li>○ 상품 설치 및 제품 배송 후 단순 변심에 의한 교환, 반품은 불가합니다.(제품에 의한 불량/하자 발생 시 교환, 반품 가능)</li>
				<li>○ 렌탈 상품의 공급 및 설치를 위하여 포장 박스를 개봉한 후부터는 헬로 렌탈 서비스가 개시된 것이며, 이후 어떠한 경우에도 품목변경(TV 32형 → 42형 등)
					은 불가합니다.</li>
				<li>○ 렌탈 상품의 유지 보수는 제조사의 약관 및 정책을 기준으로 제공 됩니다.</li>
				<li>○ 렌탈 상품은 각 제조사의 A/S정책을 따릅니다. 무상 A/S 기간 동안 제조사를 통하여 A/S 받으실 수 있습니다. (단, 고객 과실시 유상 수리 될 수 있습니다.)</li>
				<li>○ 렌탈 상품 중 추가 옵션으로 A/S보험 적용 된 상품의 경우 계약된 보험사를 통해 보상 청구할 수 있습니다.</li>
				<li>○ 주문 및 배송, 고장 수리를 위해 제품 공급 및 배송 업체(삼성 전자(주), LG전자(주) 등), 고장 수리보험 업체(AIG손해보험(주)), 홈케어 서비스 공급업체
					((주)에이치에스케어, 키친웰, 원봉 등)에 개인정보가 제공됩니다.</li>
				<li>○ 당사 내부 가입 기준에 의해 고객님의 신용 등급 등 조건에 따라 가입이 제한 될 수 있습니다.</li>
				<li>○ 자동이체 및 신용카드 납부만 가능하며 월 렌탈료 3만원 이상일 경우 신용카드 납부만 가능합니다.</li>
				<li>○ 제휴카드 할인의 경우 각 카드사 정책별 기준에 의거 카드사 청구할인 됩니다.</li>
			</ul>
		</div>
	</article>
</section>
