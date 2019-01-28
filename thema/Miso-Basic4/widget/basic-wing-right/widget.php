<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

global $g5, $member, $is_member, $at_href;

// 오늘 본 게시물 저장 시작
// tv 는 today view 약자
$saved = false;
$tv_idx = (int)get_session("ss_tv_idx");
if ($tv_idx > 0) {
    for ($i=1; $i<=$tv_idx; $i++) {
        if (get_session("ss_tv[$i]") == $wr_id) {
            $saved = true;
            break;
        }
    }
}

if (!$saved) {
    $tv_idx++;
    set_session("ss_tv_idx", $tv_idx); // 총 게시물수
    set_session("ss_tv[$tv_idx]", $wr_id); // 게시물번호를 세션 배열에 담는다.
    set_session("ss_tv_board[$tv_idx]", $bo_table); // 게시판명을 세션 배열에 담는다.
}
// 오늘 본 게시물 저장 끝


$tv_idx = get_session("ss_tv_idx");

$tv_div['top'] = 0;
$tv_div['img_width'] = 70;
$tv_div['img_height'] = 70;
$tv_div['img_length'] = 3; // 한번에 보여줄 이미지 수

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css" media="screen">', 0);
?>
<style>
	.talk_preview_area .banner_type_card {width: 100%!important;}
	.talk_expose_white {border: none!important;}
</style>

<!-- 오늘 본 상품 시작 { -->
<div class="at-wing-right">
	<div class="container">
		<aside id="stv">
			<div id="stv_list">
				<ul class="side-list">
					<li>
						<a href="https://talk.naver.com/WC0T68" target="_blank">
							<img src="/image/right01.jpg" alt=""/>
							<div class="btn-box">문의하기</div>
						</a>
					</li>
					<li>
						<a href="https://pf.kakao.com/_YNDxlj/chat" target="_blank">
							<img src="/image/right02.jpg" alt=""/>
							<div class="btn-box">문의하기</div>
						</a>
					</li>
					<li>
						<a href="https://pf.kakao.com/_YNDxlj" target="_blank">
							<img src="/image/right03.jpg" alt=""/>
							<div class="btn-box">문의하기</div>
						</a>
					</li>
				</ul>
			</div>
		</aside>
	</div>
</div>
<script src="<?php echo G5_JS_URL ?>/scroll_oldie.js"></script>
<!-- } 오늘 본 상품 끝 -->