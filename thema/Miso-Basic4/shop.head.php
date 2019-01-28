<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
include_once(THEMA_PATH.'/assets/thema.php');
?>
<link rel="stylesheet" type="text/css" href="/css/custom/header.css">
<?php if( $PHP_SELF == "/index.php" ) {?>
    <link rel="stylesheet" type="text/css" href="/css/custom/main.css">
<?php }?>
<link rel="stylesheet" type="text/css" href="/css/custom/menu.css">
<link rel="stylesheet" type="text/css" href="/css/custom/footer.css">
<link rel="stylesheet" type="text/css" href="/css/custom/sub.css">
<link rel="stylesheet" type="text/css" href="/css/custom/test.css">
<script defer type="text/javascript" src="https://partner.talk.naver.com/banners/script"></script>
<div class="at-html">
	<div id="thema_wrapper" class="wrapper <?php echo $is_thema_layout;?> <?php echo $is_thema_font;?>">
		<header class="at-header">
			<!-- LNB -->
			<aside class="at-lnb hidden-sm">
				<div class="at-container">
					<!-- LNB Right -->
					<div class="pull-right">
						<ul>
							<?php if($is_member) { // 로그인 상태 ?>
								<li><a href="javascript:;" onclick="sidebar_open('sidebar-user');"><b><?php echo $member['mb_nick'];?></b></a></li>
								<?php if($member['admin']) {?>
									<li><a href="<?php echo G5_ADMIN_URL;?>">관리</a></li>
									<li><a href="/bbs/board.php?bo_table=m0705">렌탈신청 목록</a></li>
									<li><a href="/bbs/board.php?bo_table=m0706">렌탈상담신청 목록</a></li>
									<li><a href="/bbs/board.php?bo_table=m0707">빠른상담신청 목록</a></li>
								<?php } ?>
							<?php } else { // 로그아웃 상태 ?>
								<li><a href="<?php echo $at_href['login'];?>" onclick="sidebar_open('sidebar-user'); return false;">로그인</a></li>
								<li><a href="<?php echo $at_href['reg'];?>">회원가입</a></li>
							<?php } ?>
							<?php if($is_member) { ?>
								<li><a href="<?php echo $at_href['logout'];?>">로그아웃	</a></li>
							<?php } ?>
							<li><a href="/bbs/write.php?bo_table=m0705">렌탈신청</a></li>
							<li><a href="/bbs/write.php?bo_table=m0706">렌탈상담신청</a></li>
							<li><a href="/bbs/page.php?hid=search">렌탈신청조회</a></li>
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
			</aside>

			<!-- PC Header -->
			<div class="pc-header">
				<div class="at-container">
					<!-- PC Logo -->
					<div class="header-logo">
						<a href="<?php echo $at_href['home'];?>">
							<embed type="image/svg+xml" src="/image/logo.svg" width="100px">
						</a>
					</div>
					<!-- PC Search -->
					<div class="header-search">
						<form name="tsearch" method="get" onsubmit="return tsearch_submit(this);" role="form" class="form">
						<input type="hidden" name="url"	value="<?php echo $at_href['search'];?>">
							<div class="input-group input-group-sm">
								<input type="text" name="stx" class="form-control input-sm" value="<?php echo $stx;?>" placeholder="검색어를 입력하세요.">
								<span class="input-group-btn">
									<button type="submit" class="btn btn-sm"><i class="fa fa-search fa-lg"></i></button>
								</span>
							</div>
						</form>
					</div>
					<!--PC Phon-->
					<div class="header-phon">
						<a href="tel:1855-0660">
							<img src="/image/phon.png" alt="1855-0660"/>
						</a>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</header>

		<div class="at-wrapper">
			<!-- Menu -->
			<nav class="at-menu">
				<!-- PC Menu -->
				<div class="pc-menu">
					<?php include_once(THEMA_PATH.'/menu.php');	// 메뉴 불러오기 ?>
					<div class="clearfix"></div>
					<div class="nav-back"></div>
				</div><!-- .pc-menu -->

				<!-- PC All Menu -->
				<div class="pc-menu-all">
					<div id="menu-all" class="collapse">
						<div class="at-container table-responsive">
							<table class="table">
							<tr>
							<?php 
								$az = 0;
								for ($i=1; $i < $menu_cnt; $i++) {

									if(!$menu[$i]['gr_id']) continue;

									// 줄나눔
									if($az && $az%$is_allm == 0) {
										echo '</tr><tr>'.PHP_EOL;
									}
							?>
								<td class="<?php echo $menu[$i]['on'];?>">
									<a class="menu-a" href="<?php echo $menu[$i]['href'];?>"<?php echo $menu[$i]['target'];?>>
										<?php echo $menu[$i]['name'];?>
										<?php if($menu[$i]['new'] == "new") { ?>
											<i class="fa fa-bolt new"></i>
										<?php } ?>
									</a>
									<?php if($menu[$i]['is_sub']) { //Is Sub Menu ?>
										<div class="sub-1div">
											<ul class="sub-1dul">
											<?php for($j=0; $j < count($menu[$i]['sub']); $j++) { ?>

												<?php if($menu[$i]['sub'][$j]['line']) { //구분라인 ?>
													<li class="sub-1line"><a><?php echo $menu[$i]['sub'][$j]['line'];?></a></li>
												<?php } ?>

												<li class="sub-1dli <?php echo $menu[$i]['sub'][$j]['on'];?>">
													<a href="<?php echo $menu[$i]['sub'][$j]['href'];?>" class="sub-1da<?php echo ($menu[$i]['sub'][$j]['is_sub']) ? ' sub-icon' : '';?>"<?php echo $menu[$i]['sub'][$j]['target'];?>>
														<?php echo $menu[$i]['sub'][$j]['name'];?>
														<?php if($menu[$i]['sub'][$j]['new'] == "new") { ?>
															<i class="fa fa-bolt sub-1new"></i>
														<?php } ?>
													</a>
												</li>
											<?php } //for ?>
											</ul>
										</div>
									<?php } ?>
								</td>
							<?php $az++; } //for ?>
							</tr>
							</table>
							<div class="menu-all-btn">
								<div class="btn-group">
									<a class="btn btn-lightgray" href="<?php echo $at_href['main'];?>"><i class="fa fa-home"></i></a>
									<a href="javascript:;" class="btn btn-lightgray" data-toggle="collapse" data-target="#menu-all"><i class="fa fa-times"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div><!-- .pc-menu-all -->

				<!-- Mobile Menu -->
				<div class="m-menu">
					<?php include_once(THEMA_PATH.'/menu-m.php');	// 메뉴 불러오기 ?>
					<div class="kakao-m">
						<a href="https://pf.kakao.com/_YNDxlj/chat" target="_blank">
							<img src="/img/kakao-logo.png" alt="카카오톡 상담"/>
						</a>
						<a href="https://pf.kakao.com/_YNDxlj" target="_blank">
							<img src="/img/kakao-puls-logo.png" alt="카카오톡 플러스친구 상담"/>
						</a>	
						<a href="https://talk.naver.com/WC0T68" target="_blank">
							<img src="/img/talk-talk.png" alt="네이버 톡톡"/>
						</a>	
					</div>
				</div><!-- .m-menu -->
			</nav><!-- .at-menu -->

			<div class="clearfix"></div>

			<div class="at-body">
				<?php echo apms_widget('basic-wing-right', $wid.'-right'); ?>
				<?php if($col_name) { ?>
					<div class="at-container">
					<?php if($col_name == "two") { ?>
						<div class="row at-row">
                            <div class="col-md-<?php echo $col_side;?><?php echo ($at_set['side']) ? ' pull-left' : '';?> at-col at-side show_faq">
                                <?php include_once($is_side_file); // Side ?>
                            </div>

							<div class="col-md-<?php echo $col_content;?><?php echo ($at_set['side']) ? ' pull-right' : '';?> at-col at-main">
					<?php } else { ?>
						<div class="at-content">
					<?php } ?>
				<?php } ?>
