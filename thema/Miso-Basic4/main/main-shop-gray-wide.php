<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 위젯 대표아이디 설정
$wid = 'mbst-msgw';

?>
<style>
	@import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic');
	.at-body { background:#fafafa; }
	.w-main .div-title-underbar { margin-bottom:15px; }
	.w-main .div-title-underbar span { padding-bottom:4px; }
	.w-main .div-title-underbar span b { font-weight:500; }
	.w-main .w-img img { display:block; max-width:100%; /* 배너 이미지 */ }
	.w-main .w-box { margin-bottom:30px; }
	.w-main .w-more { font-size:15px; margin-top:8px; }
	.w-main .w-p10 { padding:10px; }
	.w-main .w-p15 { padding:15px; }
	.w-main .w-row { margin-left:-15px; margin-right:-15px; }
	.w-main .w-col { padding-left:15px; padding-right:15px; }
	.w-main h2 { font-family: "Source Sans Pro", sans-serif; font-size: 50px; line-height: 120%; font-style: normal; font-weight: 100; margin:40px 0px 30px; text-align:center; }
	.w-main h3 { font-family: "Source Sans Pro", sans-serif; display:block; margin-bottom:15px; font-weight:100; line-height:120%; }
	.w-main h2 a,
	.w-main h3 a { font-family: "Source Sans Pro", }
	.w-main .call-box { background:#fff; padding:15px; border-radius:10px; }
	@media (max-width:480px) { 
		.responsive .w-main h2 { font-size:36px; }
	}
</style>

<?php echo apms_widget('miso-title', $wid.'-title', 'height=400px shadow=4', 'auto=0'); //타이틀 ?>

<?php @include_once(THEMA_PATH.'/wing.php'); // Wing ?>

<div class="h20"></div>

<div class="at-container w-main">

	<div class="row w-row">
		<div class="col-md-9 w-col">

			<!-- Start //-->
			<a href="<?php echo $at_href['event'];?>">
				<h3 class="div-title-underbar" style="margin-bottom:17px;">
					<span class="pull-right w-more">
						+ more
					</span>
					<span class="div-title-underbar-bold border-color">
						Event
					</span>
				</h3>
			</a>
			<div class="w-box">
				<?php echo apms_widget('miso-shop-event', $wid.'-event1', 'auto=0 rows=7 item=3 sm=2 nav=1 rdm=1 thumb_w=400 thumb_h=300'); ?>
			</div>
			<!--// End -->

		</div>
		<div class="col-md-3 w-col">

			<!-- Start //-->
			<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
				<h3 class="div-title-underbar">
					<span class="pull-right w-more">
						+ more
					</span>
					<span class="div-title-underbar-bold border-color">
						Notice
					</span>
				</h3>
			</a>
			<div class="w-box">
				<?php echo apms_widget('miso-post-list', $wid.'-list1', 'rows=10 date=1 icon={아이콘:bell}'); ?>
			</div>
			<!--// End -->

		</div>
	</div>

	<!-- 히트 & 베스트 시작 -->
	<h2>
		<a href="<?php echo $at_href['itype'];?>?type=1">
			Hit & Best
		</a>
	</h2>
	<div class="w-box">
		<?php echo apms_widget('miso-shop-item-slider', $wid.'-wm1', 'type1=1 type4=1 auto=0 nav=1 rdm=1 item=4 md=3 sm=2 xs=2', 'auto=0'); ?>
	</div>
	<!-- 히트 & 베스트 끝 -->

	<!-- 추천 & 신상 시작 -->
	<h2>
		<a href="<?php echo $at_href['itype'];?>?type=2">
			Cool & New
		</a>
	</h2>
	<div class="w-box">
		<?php echo apms_widget('miso-shop-item-slider', $wid.'-wm2', 'type2=1 type3=1 auto=0 nav=1 rdm=1 item=4 md=3 sm=2 xs=2', 'auto=0'); ?>
	</div>
	<!-- 추천 & 신상 끝 -->

	<!-- 할인 시작 -->
	<h2>
		<a href="<?php echo $at_href['itype'];?>?type=5">
			Discount
		</a>
	</h2>
	<div class="w-box">
		<?php echo apms_widget('miso-shop-item-slider', $wid.'-wm3', 'type5=1 auto=0 nav=1 rdm=1 item=4 md=3 sm=2 xs=2', 'auto=0'); ?>
	</div>
	<!-- 할인 끝 -->

	<!-- 이미지 배너 시작 -->	
	<div class="w-box w-img">
		<a href="#배너이동주소">
			<img src="<?php echo THEMA_URL;?>/assets/img/banner-garo.jpg">
		</a>
	</div>
	<!-- 이미지 배너 끝 -->	

	<!-- 전체상품 시작 -->
	<div class="w-box">
		<?php echo apms_widget('miso-shop-item', $wid.'-wm4', 'more=1 rows=12 item=4 md=3 sm=2 xs=2', 'auto=0'); ?>
	</div>
	<!-- 전체상품 끝 -->

	<h2>
		Posts
	</h2>

	<h3 class="div-title-underbar">
		<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=보드아이디">
			<span class="pull-right w-more">+more</span>
			<span class="div-title-underbar-bold border-color">
				Gallery
			</span>
		</a>
	</h3>
	<div class="w-box">
		<?php echo apms_widget('miso-post-gallery', $wid.'-gallery1', 'center=1'); ?>
	</div>

	<div class="row w-row">
		<div class="col-sm-4 w-col">

			<!-- 후기 시작 -->
			<h3 class="div-title-underbar">
				<a href="<?php echo $at_href['iuse'];?>">
					<span class="pull-right w-more">+more</span>
					<span class="div-title-underbar-bold border-color">
						Reviews
					</span>
				</a>
			</h3>
			<div class="w-box">
				<?php echo apms_widget('miso-shop-post', $wid.'-wm9', 'rows=6 mode=use icon={아이콘:star} star=red new=blue strong=1,2'); ?>
			</div>
			<!-- 후기 끝 -->
		</div>
		<div class="col-sm-4 w-col">

			<!-- 문의 시작 -->
			<h3 class="div-title-underbar">
				<a href="<?php echo $at_href['iqa'];?>">
					<span class="pull-right w-more">+more</span>
					<span class="div-title-underbar-bold border-color">
						Q & A
					</span>
				</a>
			</h3>
			<div class="w-box">
				<?php echo apms_widget('miso-shop-post', $wid.'-wm10', 'rows=6 mode=qa icon={아이콘:user} new=green strong=1,2'); ?>
			</div>
			<!-- 문의 끝 -->

		</div>
		<div class="col-sm-4 w-col">

			<!-- 댓글 시작 -->
			<h3 class="div-title-underbar">
				<span class="div-title-underbar-bold border-color">
					Comments
				</span>
			</h3>
			<div class="w-box">
				<?php echo apms_widget('miso-shop-post', $wid.'-wm11', 'rows=6 mode=comment icon={아이콘:comment} strong=1'); ?>
			</div>
			<!-- 댓글 끝 -->

		</div>
	</div>

	<h2>
		Service
	</h2>

	<div class="row w-row">
		<div class="col-sm-4 w-col">

			<!-- 아이콘 시작 -->
			<h3 class="div-title-underbar">
				<span class="div-title-underbar-bold border-color">
					Shopping
				</span>
			</h3>

			<div class="w-box">
				<?php echo apms_widget('miso-shop-icon'); ?>
			</div>
			<!-- 아이콘 끝 -->

		</div>
		<div class="col-sm-8 w-col">
			<div class="row w-row">
				<div class="col-sm-6 w-col">
					<h3 class="div-title-underbar">
						<span class="div-title-underbar-bold border-color">
							CS Center
						</span>
					</h3>
					<div class="w-box">
						<p>
							대표상담전화
						</p>
						<p class="en orangered" style="font-size:30px;">
							<b>1234-5678</b>
						</p>	
					</div>
				</div>
				<div class="col-sm-6 w-col">
					<h3 class="div-title-underbar">
						<span class="div-title-underbar-bold border-color">
							Bank Info
						</span>
					</h3>
					<div class="w-box">
						<p>
							예금주 : 홍길동
						</p>
						<p class="en font-20">
							○○은행 123-45-6789
						</p>	
					</div>
				</div>
			</div>
			
			<div class="call-box">
				<div class="row w-row">
					<div class="col-sm-6 w-col">
						<b>ㆍ상담시간 : AM 10:00 ~ PM 6:00</b>
						<br>
						ㆍ토/일/공휴일은 휴무입니다.
						<br>
						ㆍ부재시 <a href="<?php echo $at_href['secret'];?>">문의 게시판</a>을 이용해 주세요.
					</div>
					<div class="col-sm-6 w-col">
						<b>ㆍ주문마감시간</b>
						<br>
						<div class="pull-left en red" style="font-size:30px; letter-spacing:-1px; padding-top:8px;">
							<i class="fa fa-clock-o"></i>
							<b>2:00</b>
							<span class="font-14">PM</span>
						</div>
						<div class="pull-left" style="padding-left:20px;">
							평일오후 2시까지
							<br>
							주문시 당일배송
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>

		</div>
	</div>

	<!-- 배너 시작 -->
	<div class="w-box">
		<?php echo apms_widget('miso-shop-banner', $wid.'-banner1', 'rows=10 rdm=1 nav=1 thumb_w=400 thumb_h=200 auto=0 item=4 lg=3 md=2 sm=2 xs=2'); ?>
	</div>
	<!-- 배너 끝 -->

	<!-- SNS아이콘 시작 -->
	<div class="w-box text-center">
		<?php echo $sns_share_icon; // SNS 공유아이콘 ?>
	</div>
	<!-- SNS아이콘 끝 -->

</div>
