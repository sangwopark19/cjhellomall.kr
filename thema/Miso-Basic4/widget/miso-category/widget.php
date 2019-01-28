<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

global $menu , $bo_table , $PHP_SELF , $hid;

//add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css">', 0);

$table = $bo_table == 'm0702'||$bo_table == 'm0703'||$bo_table == 'm0704'||$PHP_SELF == "/bbs/faq.php"||$bo_table == 'm0705'||$bo_table == 'm0706'||$hid == 'search';

for ($i=0; $i < count($menu); $i++) {
	if($menu[$i]['on'] == "on") {

?>
	<div class="miso-category">
		<div class="ca-head en ellipsis">
			<a href="<?php echo $menu[$i]['href'];?>">
				<?php echo $menu[$i]['name'];?>
			</a>
		</div>
		<?php if($menu[$i]['is_sub']) { ?>
			<div class="ca-body hide-box">
				<?php for($j=0; $j < count($menu[$i]['sub']); $j++) { ?>
					<?php if($menu[$i]['sub'][$j]['line']) { //구분라인이 있을 때 ?>
						<div class="ca-line">
							<?php echo $menu[$i]['sub'][$j]['line'];?>
						</div>
					<?php } ?>
					<?php if($menu[$i]['sub'][$j]['is_sub'] && $menu[$i]['sub'][$j]['on'] == 'on') { // 선택메뉴이면 서브 출력 ?>
						<ul class="ca-sub2">
						<?php for($k=0; $k < count($menu[$i]['sub'][$j]['sub']); $k++) { ?>
							<li class="<?php echo $menu[$i]['sub'][$j]['sub'][$k]['on']; ?>">
								<a href="<?php echo $menu[$i]['sub'][$j]['sub'][$k]['href'];?>"<?php echo $menu[$i]['sub'][$j]['sub'][$k]['target'];?>>
									<?php echo $menu[$i]['sub'][$j]['sub'][$k]['name'];?>
								</a>
							</li>
						<?php } ?>
						</ul>
					<?php } ?>
				<?php } ?>
			</div>
		<?php } ?>
		
		<?php if($table) {?>
		<style>
			.hide-box {display: none;}
		</style>
		<div class="ca-body">
			<ul class="ca-sub2">
				<!--li class="?php if($bo_table == 'm0702') { echo "on"; };?>">
					<a href="/bbs/board.php?bo_table=m0702">
						사용후기
					</a>
				</li-->
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
		<?php } ?>
	</div>
<?php 
		break;
	} 
} 
?>
