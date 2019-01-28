<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
?>
<?php if($is_top_nav == 'full') { // 전체형 메뉴 ?>
	<div id="nav_full" class="nav-full nav-full-height nav-visible">
		<div id="nav_full_back" class="nav-full-back nav-height"></div>
		<div id="nav_full_container" class="at-container nav-full-height">
			<div class="nav-slide">
				<ul class="menu-ul">
				<?php 
					for ($i=1; $i < $menu_cnt; $i++) {
						
						if(!$menu[$i]['gr_id']) continue;

						// 제외메뉴는 출력안함
						if($is_top_menu && in_array($menu[$i]['gr_id'], $menu_top_list)) continue;
						$all_menu = '';
						if( $menu[$i]['name'] == '전체카테고리' ) {
							$all_menu = 'all_menu';
							$menu[$i]['href'] = '#none';
						}
                        if( $menu[$i]['name'] == '고객센터' ) continue;
				?>
					<li class="menu-li <?php echo $menu[$i]['on'];?> <?php echo $all_menu;?>">
						<a class="menu-a nav-height" href="<?php echo $menu[$i]['href'];?>"<?php echo $menu[$i]['target'];?>>
							<?php echo $menu[$i]['name'];?>
							<?php if($menu[$i]['new'] == "new") { ?>
								<i class="fa fa-bolt new"></i>
							<?php } ?>
						</a>
						<?php if($menu[$i]['is_sub']) { //Is Sub Menu ?>
							<div class="sub-slide sub-1div">
								<ul class="sub-1dul subm-w pull-left">
								<?php 
									$smw1 = 1; //나눔 체크
									for($j=0; $j < count($menu[$i]['sub']); $j++) { 
								?>
									<?php if($menu[$i]['sub'][$j]['sp']) { //나눔 ?>
										</ul>
										<ul class="sub-1dul subm-w pull-left">
									<?php $smw1++; } // 나눔 카운트 ?>


									<li class="sub-1dli <?php echo $menu[$i]['sub'][$j]['on'];?>">
										<?php 
											$smw2 = 1; //나눔 체크
											for($k=0; $k < count($menu[$i]['sub'][$j]['sub']); $k++) { 
										?>
												<a href="<?php echo $menu[$i]['sub'][$j]['sub'][$k]['href'];?>" class="sub-2da"<?php echo $menu[$i]['sub'][$j]['sub'][$k]['target'];?>>
													<?php echo $menu[$i]['sub'][$j]['sub'][$k]['name'];?>
												</a>
										<?php } ?>
									</li>
								<?php } //for ?>
								</ul>
								<?php $smw1 = ($smw1 > 1) ? $is_subw * $smw1 : 0; //서브메뉴 너비 ?>
								<div class="clearfix"<?php echo ($smw1) ? ' style="width:'.$smw1.'px;"' : '';?>></div>
							</div>
						<?php } ?>
					</li>
				<?php } //for ?>
				    <li class="menu-li <?php echo $all_menu;?>">
                        <a class="menu-a nav-height" href="/bbs/board.php?bo_table=m0703">
                           고객센터
                        </a>
                        <div class="sub-slide sub-1div">
                            <ul class="sub-1dul subm-w pull-left">
                                <ul class="sub-1dul subm-w pull-left">
									<li class="sub-1dli">
										<a href="/bbs/board.php?bo_table=m0703" class="sub-2da">
											제휴카드
										</a>
									</li>									
									<li class="sub-1dli">
										<a href="/bbs/board.php?bo_table=m0704" class="sub-2da">
											공지사항
										</a>
									</li>									
									<li class="sub-1dli">
										<a href="/bbs/faq.php" class="sub-2da">
											자주 묻는 질문
										</a>
									</li>									
									<li class="sub-1dli">
										<a href="/bbs/write.php?bo_table=m0705" class="sub-2da">
											렌탈신청
										</a>
									</li>									
									<li class="sub-1dli">
										<a href="/bbs/write.php?bo_table=m0706" class="sub-2da">
											렌탈상담신청
										</a>
									</li>									
									<li class="sub-1dli">
										<a href="/bbs/page.php?hid=search" class="sub-2da">
											렌탈신청조회
										</a>
									</li>
                                </ul>
                            </ul>
                        </div>
                    </li>
				</ul>
			</div><!-- .nav-slide -->
			<div class="sub-wrap">
			<?php 
				for ($i=1; $i < $menu_cnt; $i++) {
			?>
			<?php if($menu[$i]['is_sub']) { //Is Sub Menu ?>
				<div class="sub-box">
					<ul class="sub-ul">
					<?php for($j=0; $j < count($menu[$i]['sub']); $j++) { ?>
						<li class="sub-li <?php echo $menu[$i]['sub'][$j]['on'];?>">
							<a href="<?php echo $menu[$i]['sub'][$j]['href'];?>" class="sub-title"<?php echo $menu[$i]['sub'][$j]['target'];?>>
								<?php echo $menu[$i]['sub'][$j]['name'];?>
							</a>
							<?php if($menu[$i]['sub'][$j]['is_sub']) { // Is Sub Menu ?>
								<div class="sub-menu">
									<ul class="sub-2dul subm-w pull-left">					
									<?php 
										$smw2 = 1; //나눔 체크
										for($k=0; $k < count($menu[$i]['sub'][$j]['sub']); $k++) { 
									?>
										<li class="sub-2dli <?php echo $menu[$i]['sub'][$j]['sub'][$k]['on'];?>">
											<a href="<?php echo $menu[$i]['sub'][$j]['sub'][$k]['href'];?>" class="sub-2da"<?php echo $menu[$i]['sub'][$j]['sub'][$k]['target'];?>>
												<?php echo $menu[$i]['sub'][$j]['sub'][$k]['name'];?>
											</a>
										</li>
									<?php } ?>
									</ul>
									<?php $smw2 = ($smw2 > 1) ? $is_subw * $smw2 : 0; //서브메뉴 너비 ?>
									<div class="clearfix"<?php echo ($smw2) ? ' style="width:'.$smw2.'px;"' : '';?>></div>
								</div>
							<?php } ?>
						</li>
					<?php } //for ?>
					</ul>
				</div>
			<?php } ?>
			<?php } //for ?>
				<div class="sub-box">
					<ul class="sub-ul">
						<li class="sub-li">
							<div class="sub-menu">
								<ul class="sub-2dul subm-w pull-left">					
									<!--<li class="sub-2dli">
										<a href="/bbs/board.php?bo_table=m0702" class="sub-2da">
											사용후기
										</a>
									</li>	-->								
									<li class="sub-2dli">
										<a href="/bbs/board.php?bo_table=m0703" class="sub-2da">
											제휴카드
										</a>
									</li>									
									<li class="sub-2dli">
										<a href="/bbs/board.php?bo_table=m0704" class="sub-2da">
											공지사항
										</a>
									</li>									
									<li class="sub-2dli">
										<a href="/bbs/faq.php" class="sub-2da">
											자주 묻는 질문
										</a>
									</li>									
									<li class="sub-2dli">
										<a href="/bbs/write.php?bo_table=m0705" class="sub-2da">
											렌탈신청
										</a>
									</li>									
									<li class="sub-2dli">
										<a href="/bbs/write.php?bo_table=m0706" class="sub-2da">
											렌탈상담신청
										</a>
									</li>									
									<li class="sub-2dli">
										<a href="/bbs/page.php?hid=search" class="sub-2da">
											렌탈신청조회
										</a>
									</li>
								</ul>
								<?php $smw2 = ($smw2 > 1) ? $is_subw * $smw2 : 0; //서브메뉴 너비 ?>
								<div class="clearfix"<?php echo ($smw2) ? ' style="width:'.$smw2.'px;"' : '';?>></div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div><!-- .at-container -->
	</div><!-- .nav-full -->

	<div class="nav-visible">
		<div class="at-container">
			<div class="nav-top nav-float nav-slide">
				
			</div><!-- .nav-top -->
		</div>	<!-- .nav-container -->
	</div><!-- .nav-visible -->
<?php } ?>
