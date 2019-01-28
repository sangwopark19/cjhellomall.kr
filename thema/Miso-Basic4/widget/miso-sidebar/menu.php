<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

global $bo_table;

?>

<!-- Categroy -->
<div class="div-title-underline-thin en">
	<b>MENU</b>
</div>

<div class="sidebar-menu panel-group" id="<?php echo $menu_id;?>" role="tablist" aria-multiselectable="true">
	<?php 
		for($i=1; $i < $menu_cnt; $i++) { 
			$cate_id = $menu_id.'_c'.$i;
			$sub_id = $menu_id.'_s'.$i;
	?>
		<?php if($menu[$i]['is_sub']) { //서브메뉴가 있을 때 ?>
			<?php if( $menu[$i]['name'] !== '고객센터') {; ?>
			<div class="panel">
				<div class="ca-head<?php echo ($menu[$i]['on'] == "on") ? ' active' : '';?>" role="tab" id="<?php echo $cate_id;?>">
					<a href="#<?php echo $sub_id;?>" data-toggle="collapse" data-parent="#<?php echo $menu_id;?>" aria-expanded="true" aria-controls="<?php echo $sub_id;?>" class="is-sub">
						<span class="ca-href pull-right" onclick="sidebar_href('<?php echo $menu[$i]['href']; ?>');">&nbsp;</span>
						<?php echo $menu[$i]['name']; ?>
						<?php echo ($menu[$i]['new'] == "new") ? $menu_new : '';?>
					</a>
				</div>
				<div id="<?php echo $sub_id;?>" class="panel-collapse collapse<?php echo ($menu[$i]['on'] == "on") ? ' in' : '';?>" role="tabpanel" aria-labelledby="<?php echo $cate_id;?>">
					
						<?php 
							for($j=0; $j < count($menu[$i]['sub']); $j++) { 
						?>
								<?php 
									$sql = "SELECT bo_category_list, bo_table FROM g5_board WHERE gr_id='".$menu[$i]['gr_id']."' ";
									$res = sql_query($sql);
									$ca = mysqli_fetch_array($res);									
									$bo_category_list = explode("|",$ca['bo_category_list']);
									$bo_cnt = count($bo_category_list);
									for($a=0; $a<$bo_cnt; ++$a) {
										echo "<ul class='ca-sub'>";
										echo "<li><a href='/bbs/board.php?bo_table={$ca['bo_table']}&sca={$bo_category_list[$a]}'>";
										echo $bo_category_list[$a];
										echo "</a></li>";
										echo "</ul>";
									}
								?>
						<?php } ?>
				</div>
			</div>
		<?php } ?>
		<?php } else { ?>
			<div class="panel">
				<div class="ca-head<?php echo ($menu[$i]['on'] == "on") ? ' active' : '';?>" role="tab">
					<a href="<?php echo $menu[$i]['href'];?>"<?php echo $menu[$i]['target'];?> class="no-sub">
						<?php echo $menu[$i]['name'];?>
						<?php echo ($menu[$i]['new'] == "new") ? $menu_new : '';?>
					</a>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
	
	<div class="panel">
		<div class="ca-head<?php echo ($menu[$i]['on'] == "on") ? ' active' : '';?>" role="tab" id="<?php echo $cate_id;?>">
			<a href="#<?php echo $sub_id;?>" data-toggle="collapse" data-parent="#<?php echo $menu_id;?>" aria-expanded="true" aria-controls="<?php echo $sub_id;?>" class="is-sub">
				<span class="ca-href pull-right" onclick="sidebar_href('<?php echo $menu[$i]['href']; ?>');">&nbsp;</span>
				고객센터
			</a>
		</div>
		<div id="<?php echo $sub_id;?>" class="panel-collapse collapse<?php echo ($menu[$i]['on'] == "on") ? ' in' : '';?>" role="tabpanel" aria-labelledby="<?php echo $cate_id;?>">
			<ul class="ca-sub">
				<li class="<?php if($bo_table == 'm0702') { echo "on"; };?>">
					<a href="/bbs/board.php?bo_table=m0702">
						사용후기
					</a>
				</li>
				<li class="<?php if($bo_table == 'm0703') { echo "on"; };?>">
					<a href="/bbs/board.php?bo_table=m0703">
						제휴카드
					</a>
				</li>
				<li class="<?php if($bo_table == 'm0704') { echo "on"; };?>">
					<a href="/bbs/board.php?bo_table=m0704">
						공지사항
					</a>
				</li>
				<li class="<?php if($PHP_SELF == "/bbs/faq.php") { echo "on"; };?>">
					<a href="/bbs/faq.php">
						자주 묻는 질문
					</a>
				</li>
				<li class="<?php if($bo_table == 'm0705') { echo "on"; };?>">
					<a href="/bbs/write.php?bo_table=m0705">
						렌탈신청
					</a>
				</li>
				<li class="<?php if($bo_table == 'm0706') { echo "on"; };?>">
					<a href="/bbs/write.php?bo_table=m0706">
						렌탈상담신청
					</a>
				</li>
				<li class="<?php if($hid == 'search') { echo "on"; };?>">
					<a href="/bbs/page.php?hid=search">
						렌탈신청조회
					</a>
				</li>
			</ul>
		</div>
	</div>
	
</div>

<div class="h20"></div>
