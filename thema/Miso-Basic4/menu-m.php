<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
?>
<style>
        .m_logo{position: absolute;top: 25px;}
    @media(max-width:991px){
        .m-nav {display: none;}
        .m-menu {position: fixed;}
        .m-menu .m-icon, .m-menu .m-list {height: 77px;border: none;line-height: 77px;}
        .index_wrap {padding-top: 78px;}
        .m-wrap {padding: 0 15px}
    }
</style>
<div class="m-wrap">
	<div class="at-container">
		<div class="m-table en">
			<div class="m_logo">
				<a href="http://sw180911.dothome.co.kr">
					<embed type="image/svg+xml" src="/image/logo.svg" width="100px">
				</a>
			</div>
			<?php if(IS_YC) { // 영카트 이용시 ?>

			<?php } ?>
			<div class="m-list">
				<div class="m-nav" id="mobile_nav">
					<ul class="clearfix">
					<li>
						<a href="<?php echo $at_href['main'];?>">메인</a>
					</li>
					<?php 
						$j = 1; //현재위치 표시
						for ($i=1; $i < $menu_cnt; $i++) {

							if(!$menu[$i]['gr_id']) continue;

							if($menu[$i]['on'] == 'on') {
								$m_sat = $j;

								//서브메뉴
								if($menu[$i]['is_sub']) {
									$m_sub = $i;
								}
							}
					?>
						<li>
							<a href="<?php echo $menu[$i]['href'];?>"<?php echo $menu[$i]['target'];?>>
								<?php echo $menu[$i]['menu'];?>
								<?php if($menu[$i]['new'] == "new") { ?>
									<i class="fa fa-bolt new"></i>
								<?php } ?>
							</a>
						</li>
					<?php $j++; } //for ?>
					</ul>
				</div>
			</div>
			<?php if(IS_YC) { // 영카트 이용시 ?>
<!--				<div class="m-icon">
					<a href="<?php echo $at_href['cart'];?>" onclick="sidebar_open('sidebar-cart'); return false;"> 
						<i class="fa fa-shopping-bag"></i>
						<?php if($member['cart'] || $member['today']) { ?>
							<span class="label bg-green en">
								<?php echo number_format($member['cart'] + $member['today']);?>
							</span>
						<?php } ?>
					</a>
				</div>-->
			<?php } ?>
			<div class="m-icon">
				<a href="javascript:;" onclick="sidebar_open('sidebar-menu');">
					<i class="fa fa-bars"></i>
					<span class="label bg-orangered en"<?php echo ($member['response'] || $member['memo']) ? '' : ' style="display:none;"';?>>
						<span class="msgCount"><?php echo number_format($member['response'] + $member['memo']);?></span>
					</span>
				</a>
			</div>
		</div>
	</div>
</div>

<div class="clearfix"></div>