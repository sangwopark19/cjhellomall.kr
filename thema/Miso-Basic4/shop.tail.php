<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

?>
				<?php if($col_name) { ?>
					<?php if($col_name == "two") { ?>
							</div>
							<div class="col-md-<?php echo $col_side;?><?php echo ($at_set['side']) ? ' pull-left' : '';?> at-col at-side">
								<?php include_once($is_side_file); // Side ?>
							</div>
						</div>
					<?php } else { ?>
						</div><!-- .at-content -->
					<?php } ?>
					</div><!-- .at-container -->
				<?php } ?>
			</div><!-- .at-body -->

			<?php if(!$is_main_footer) { ?>
				<footer class="at-footer">
					<nav class="at-links">
						<div class="at-container">
							<ul class="pull-left">
								<li><a href="<?php echo G5_BBS_URL;?>/page.php?hid=provision">이용약관</a></li> 
								<li><a href="<?php echo G5_BBS_URL;?>/page.php?hid=privacy">개인정보처리방침</a></li>
							</ul>
							<div class="clearfix"></div>
						</div>
					</nav>
					<div class="at-infos">
						<div class="at-container">
							<div class="media">
								<div class="footer-logo">
									<a href="http://sw180911.dothome.co.kr">
										<embed type="image/svg+xml" src="/image/logo.svg" width="100px">
									</a>
								</div>	
								<div class="media-body">
									<ul class="at-about">
										<li>
											주)에스디정보통신<br/>
											전남 영암군 삼호읍 세가래로 47
										</li>
										<li>
											<!--통신판매업신고 :-->
											사업자등록번호 : 415-81-52669
										</li>
										<li>
											TEL. 061) 284-8812, 1855-1740
										</li>
										<li>E-mail. cjhello_online@naver.com</li>
									</ul>
									<div class="clearfix"></div>
									<div class="copyright">
										Copytight <?php echo $config['cf_title'];?>.All rights reserved.
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="fast-apply">
						<div class="left-box">
							<div class="ban-container">
								지금바로 렌탈상담!
								<a href="tel:1855-1740">1855-1740</a>
								<span>
									<img src="/image/footer-won.png">
								</span>
							</div>
						</div>
						<div class="right-box">
							<form name="inquiryForm" method="POST" enctype="multipart/form-data">
							<div class="ban-container apply-wrap">
								<div>
									<div>
										<span class="sm-block">
											<label>성함</label>
											<input type="text" name="wr_1" id="wr_1" class="input-txt" aria-label="성함">
										</span>
										<span class="sm-block">
											<label>연락처</label>
											<input type="text" name="wr_2" id="wr_2" class="input-txt" aria-label="연락처">
										</span>
									</div>
									<div>
										<input type="checkbox" name="wr_10" id="wr_10" class="input-ck">
										개인정보취급방침에 동의합니다. 
										<a href="/bbs/page.php?hid=provision" class="more-bt" target="_blank">
											[이용약관 보기]
										</a>	
									</div>
								</div>
								<div>
									<input type="button" class="input-btn" value="빠른상담신청" onclick="submit_btn();">
								</div>
							</div>
							</form>
						</div>
					</div>
				</footer>
			<?php } ?>
		</div><!-- .at-wrapper -->
	</div><!-- .wrapper -->
</div><!-- .at-html -->

<div class="at-go">
	<div id="go-btn" class="go-btn">
		<span class="go-top cursor"><i class="fa fa-chevron-up"></i></span>
		<span class="go-bottom cursor"><i class="fa fa-chevron-down"></i></span>
	</div>
</div>

<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo THEMA_URL;?>/assets/js/respond.js"></script>
<![endif]-->

<!-- JavaScript -->
<script>
var sub_show = "<?php echo $at_set['subv'];?>";
var sub_hide = "<?php echo $at_set['subh'];?>";
var menu_startAt = "<?php echo ($m_sat) ? $m_sat : 0;?>";
var menu_sub = "<?php echo $m_sub;?>";
var menu_subAt = "<?php echo ($m_subsat) ? $m_subsat : 0;?>";
</script>
<script type="text/javascript" src="<?php echo THEMA_URL;?>/assets/bs3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo THEMA_URL;?>/assets/js/sly.min.js"></script>
<script type="text/javascript" src="<?php echo THEMA_URL;?>/assets/js/custom.js"></script>
<?php if($is_sticky_nav) { ?>
<script type="text/javascript" src="<?php echo THEMA_URL;?>/assets/js/sticky.js"></script>
<?php } ?>

<?php echo apms_widget('miso-sidebar'); //사이드바 및 모바일 메뉴(UI) ?>

<?php if($is_designer || $is_demo) include_once(THEMA_PATH.'/assets/switcher.php'); //Style Switcher ?>

<script>
	function submit_btn() {
				var f = document.inquiryForm;
				if( document.getElementById('wr_1').value == '' ){
					alert("성함을 입력해주세요.");
					f.wr_1.focus();
					return false;
				}
				if( document.getElementById('wr_2').value == '' ){
					alert("연락처를 입력하세요.");
					f.wr_2.focus();
					return false;
				}
				if( document.getElementById('wr_10').checked != true ){
					alert("개인정보취급방침에 동의해주세요.");
					f.wr_10.focus();
					return false;
				}
			f.action = "/bbs/inquiry_update.php";
		f.submit();
	}
</script>