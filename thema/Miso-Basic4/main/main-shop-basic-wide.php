<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 위젯 대표아이디 설정
$wid = 'mbst-msbw';

?>
<div class="wrap">
    <div>
        <?php echo apms_widget('miso-title', $wid.'-title', 'height=400px shadow=4', 'auto=0'); //타이틀 ?>
    </div>
    <!--<div class="visible-xs">
        ?php echo apms_widget('miso-title', $wid.'-title_m', 'height=400px shadow=4', 'auto=0'); //타이틀 ?>
    </div>-->
	<ul class="banner-link">
		<li>
			<a href="/bbs/board.php?bo_table=m0101">
				<img src="/image/main/main-top01.jpg" alt=""/>
				<span>특가상품</span>
			</a>
		</li>		
		<li>
			<a href="/bbs/board.php?bo_table=m0703">
				<img src="/image/main/main-top02.jpg" alt=""/>
				<span>제휴카드</span>
			</a>
		</li>		
		<li>
			<a href="/bbs/page.php?hid=search">
				<img src="/image/main/main-top03.jpg" alt=""/>
				<span>렌탈신청조회</span>
			</a>
		</li>
	</ul>
	<div class="event">
		<div class="title-box">
			헬로 렌탈 MD 추천 생활가전
		</div>
		<div class="event-box">
			<div>
				<?php echo apms_widget('min-post-gallery', $wid.'-event'); ?>
			</div>
			<div>
				<a href="/bbs/board.php?bo_table=m0301">
					<img src="/image/main/event.png" alt=""/>
				</a>	
			</div>
		</div>
	</div>
</div>
<div class="item-box item-bg">
	<div class="wrap">
		<div class="title-box">
			TV 렌탈상품
			<a href="/bbs/board.php?bo_table=m0101">+더보기</a>
		</div>
		<div class="item-wig">
			<?php echo apms_widget('min-item-gallery', $wid.'-item01'); ?>
		</div>	
	</div>
</div>
<div class="item-box item-pc">
	<div class="wrap">
		<div class="title-box">
			PC 렌탈상품
			<a href="/bbs/board.php?bo_table=m0201">+더보기</a>
		</div>
		<div class="item-wig">
			<?php echo apms_widget('min-item-gallery', $wid.'-item02'); ?>
		</div>	
	</div>
</div>
<div class="item-box item-pc">
	<div class="wrap">
		<div class="title-box">
			생활가전
			<a href="/bbs/board.php?bo_table=m0301">+더보기</a>
		</div>
		<div class="item-wig">
			<?php echo apms_widget('min-item-gallery', $wid.'-item03'); ?>
		</div>	
	</div>
</div>
<div class="item-box item-pc">
	<div class="wrap">
		<div class="title-box">
			계절가전
			<a href="/bbs/board.php?bo_table=m0401">+더보기</a>
		</div>
		<div class="item-wig">
			<?php echo apms_widget('min-item-gallery', $wid.'-item04'); ?>
		</div>	
	</div>
</div>
<div class="item-box item-pc">
	<div class="wrap">
		<div class="title-box">
			가족가전
			<a href="/bbs/board.php?bo_table=m0501">+더보기</a>
		</div>
		<div class="item-wig">
			<?php echo apms_widget('min-item-gallery', $wid.'-item05'); ?>
		</div>	
	</div>
</div>
<div class="item-box item-pc">
	<div class="wrap">
		<div class="title-box">
			케어상품
			<a href="/bbs/board.php?bo_table=m0601">+더보기</a>
		</div>
		<div class="item-wig">
			<?php echo apms_widget('min-item-gallery', $wid.'-item06'); ?>
		</div>	
	</div>
</div>
<div class="service">
	<ul>
		<li>
			<div class="title">고객센터</div>
			<div class="tel-box">
				<a href="tel:1855-1740">1855-1740</a>
				<div class="form-group">
					<div>업무시간</div>
					<div>09:00 ~ 18:00</div>
				</div>
				<div class="form-group">
					<div>점심시간</div>
					<div>12:00 ~ 13:00</div>
				</div>
				<div class="form-group">
					<div>휴무</div>
					<div>토,일 공휴일</div>
				</div>
				<div class="form-group">
					<div>이메일</div>
					<div>cjhello_online@naver.com</div>
				</div>
			</div>
		</li>
		<li>
			<div class="title">
				공지사항
				<a href="/bbs/board.php?bo_table=m0704"><img src="/image/puls.jpg" alt=""/></a>
			</div>
			<div>
				<?php echo apms_widget('miso-post-list', $wid.'-list01'); ?>
			</div>
		</li>
		<li>
			<div class="title">
				제휴카드
				<a href="/bbs/board.php?bo_table=m0703"><img src="/image/puls.jpg" alt=""/></a>
			</div>
			<div>
				<?php echo apms_widget('miso-post-list', $wid.'-list02'); ?>
			</div>
		</li>
		<li>
			<div class="title">
				자주 묻는 질문
				<a href="/bbs/faq.php"><img src="/image/puls.jpg" alt=""/></a>
			</div>
			<div class="miso-post-list">
				<div class="post-wrap">
				<!--?php echo apms_widget('miso-post-list', $wid.'-list03'); ?-->
					<ul class="post-list qa-list">
						<?php
						$sql = "SELECT * FROM g5_faq WHERE 1";
						$result = sql_query($sql);
						while( $faq = mysqli_fetch_array($result) ) {
							echo "<li class='post-row'>";
							echo "<a href='/bbs/faq.php'>".$faq['fa_subject']."</a>";
							echo "</li>";
						}
						?>
					</ul>				
				</div>	
			</div>
		</li>
	</ul>
</div>