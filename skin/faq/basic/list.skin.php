
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css">', 0);

// 헤더 출력
if($header_skin)
	include_once('./header.php');

if ($himg_src) 
	echo '<div id="faq_himg" class="faq-img"><img src="'.$himg_src.'" alt=""></div>';

?>
<style>
	.at-row {margin: 0;}
    .qna {color: #5686da;}
    .collapse.in{position: relative;}
	.faq-category .div-tab {margin-bottom: 0!important;}
    .is-pc .ko .panel .panel-body{padding:20px 15px 20px 50px;font-size:16px;background-color: #f6f6f6;}
    .div-panel.panel-group .panel{border-bottom: 1px solid #ddd;}
	.div-panel.panel-group .panel-heading a {color: #333;}
    .div-panel.panel-group .panel-heading a.active{border:none !important;color: #20aaf3;}
    .qnq,.qna{position: absolute;right:20px;top:19px; font-size:20px;}
	.at-body .at-container{padding:0;}
    .faq-box{display: none;}
	.nav-tabs {border-bottom: 2px solid #000;}
    .div-tab.tabs ul.nav-tabs li{display: inline-block;text-align: center;border: none;}
    .nav>li>a{display: inline-block;padding-top:20px;padding-bottom:20px;}
    .nav-tabs>li{float: none;margin:0;}
    .div-tab.tabs ul.nav-tabs li{border:none;background-color:#fff;}
    .div-tab.tabs.trans-top ul.nav-tabs li.active a{border:none;font-size: 21px!important;color: #333!important;}
    .div-tab.tabs.trans-top ul.nav-tabs li a{border:none;font-size: 18px!important;color: #333!important;padding-bottom: 20px;padding-left: 0;}
    .div-tab.tabs ul.nav-tabs li a, .div-tab.tabs ul.nav-tabs li a:hover, .div-tab.tabs ul.nav-tabs li a:focus, .div-tab.tabs ul.nav-tabs li:first-child a, .div-tab.tabs ul.nav-tabs li:first-child a:hover, .div-tab.tabs ul.nav-tabs li:first-child a:focus, .div-tab.tabs ul.nav-tabs li:last-child a, .div-tab.tabs ul.nav-tabs li:last-child a:hover, .div-tab.tabs ul.nav-tabs li:last-child a:focus{border:none;font-size:16px;}
    .div-tab.tabs ul.nav-tabs li.active a, .div-tab.tabs ul.nav-tabs li.active a:hover, .div-tab.tabs ul.nav-tabs li.active a:focus, .div-tab.tabs ul.nav-tabs li.active:first-child a, .div-tab.tabs ul.nav-tabs li.active:first-child a:hover, .div-tab.tabs ul.nav-tabs li.active:first-child a:focus, .div-tab.tabs ul.nav-tabs li.active:last-child a, .div-tab.tabs ul.nav-tabs li.active:last-child a:hover, .div-tab.tabs ul.nav-tabs li.active:last-child a:focus{border:none;}
    .div-tab.tabs ul.nav-tabs li.active{border:none;}
    .div-tab.tabs ul.nav-tabs li:first-child{border:none;}
    .div-tab.tabs ul.nav-tabs li:last-child, .div-tab.tabs ul.nav-tabs li:last-child:hover{border:none;}
    .div-tab.tabs ul.nav-tabs li:hover, .div-tab.tabs ul.nav-tabs li:focus{border:none;}
    
    .div-panel.panel-group .panel-heading a{border:none;font-size:16px;font-weight: 400;padding:20px 15px 20px 20px;}
	
	.title {font-size: 28px;font-weight: bold;padding-bottom: 30px;border-bottom: 1px solid #ddd;margin-bottom: 20px;}
	.col-md-3.at-side {padding: 0;width: 20.8%;min-height: 600px;}

	.at-row { background-color: #f5f5f5;}
	.at-main {width: 79.2%;padding-left: 50px;background-color: #fff;padding-top: 40px;min-height: 600px;}
	
	.at-side {display: none;}
	.show_faq {display: block!important;}
	
    @media(max-width:991px){
		.col-md-3.at-side {min-height: auto} 
		.is-pc .ko .panel .panel-body,
		.div-panel.panel-group .panel-heading a {padding-left: 10px;}
    }	
</style>
<div class="title">
	<img src="/image/title-icon.jpg" alt=""/> <?php echo $page_title;?>
</div>
<div class="faq-box">
    <form class="form" role="form" name="faq_search_form" method="get">
    <input type="hidden" name="fm_id" value="<?php echo $fm_id;?>">
		<div class="row">
			<div class="col-sm-3 col-sm-offset-3 col-xs-7">
				<div class="form-group input-group">
					<span class="input-group-addon"><i class="fa fa-tags"></i></span>
				    <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" class="form-control input-sm" placeholder="검색어">
				</div>
			</div>
			<div class="col-sm-3 col-xs-5">
				<div class="form-group">
					<button type="submit" class="btn btn-black btn-sm btn-block"><i class="fa fa-search"></i> 검색하기</button>
				</div>
			</div>
		</div>
	</form>
</div>

<?php echo '<div id="faq_hhtml" class="faq-html">'.$faq_head_html.'</div>'; // 상단 HTML ?>

<?php if(count($faq_master_list)){ ?>
	<aside class="faq-category">
		<div class="div-tab tabs trans-top">
			<ul class="nav nav-tabs">
			<?php
			foreach($faq_master_list as $v){
				$category_active = '';
				if($v['fm_id'] == $fm_id){ // 현재 선택된 카테고리라면
					$category_active = ' class="active"';
				}
			?>
				<li<?php echo $category_active;?>>
					<a href="<?php echo $category_href;?>?fm_id=<?php echo $v['fm_id'];?>">
						<?php echo $category_msg.$v['fm_subject'];?>
					</a>
				</li>
			<?php }	?>
		</div>
		<div class="dropdown" style="display:none;">
			<a id="categoryLabel" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-color btn-block">
				카테고리
			</a>
			<ul class="dropdown-menu" role="menu" aria-labelledby="categoryLabel">
			<?php
			foreach($faq_master_list as $v){
				$category_selected = '';
				if($v['fm_id'] == $fm_id){ // 현재 선택된 카테고리라면
					$category_selected = ' class="selected"';
				}
			?>
				<li<?php echo $category_selected;?>>
					<a href="<?php echo $category_href;?>?fm_id=<?php echo $v['fm_id'];?>">
						<?php echo $category_msg.$v['fm_subject'];?>
					</a>
				</li>
			<?php }	?>
			</ul>
		</div>
	</aside>
<?php } ?>

<section class="faq-content">
	<?php if( count($faq_list) ){ // FAQ 내용 ?>
		<div class="div-panel no-animation panel-group at-toggle" id="faq_accordion">
			<?php
				$i = 1;
				foreach($faq_list as $key=>$v){
					if(empty($v))
						continue;
			?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<a data-toggle="collapse" data-parent="#faq_accordion" href="#faq_collapse<?php echo $i;?>">
							<span class="qnq"><img src="/image/arrow.jpg"></span>
							<?php echo apms_get_text($v['fa_subject']); ?>
						</a>
					</div>
					<div id="faq_collapse<?php echo $i;?>" class="panel-collapse collapse">
						<div class="panel-body">
							 <?php echo apms_content(conv_content($v['fa_content'], 1)); ?>
						</div>
					</div>
				</div>
			<?php $i++; } ?>
		</div>
	<?php } else {
		if($stx){
			echo '<div class="faq-none text-center">검색된 FAQ가 없습니다.</div>';
		} else {
			echo '<div class="faq-none text-center">등록된 FAQ가 없습니다.';
			if($is_admin)
				echo '<br><a href="'.G5_ADMIN_URL.'/faqmasterlist.php">FAQ를 새로 등록하시려면 FAQ관리</a> 메뉴를 이용하십시오.';
			echo '</div>';
		}
	}
	?>
</section>

<?php if($total_count > 0) { ?>
	<div class="text-center">
		<ul class="pagination pagination-sm en">
			<?php echo apms_paging($write_page_rows, $page, $total_page, $list_page); ?>
		</ul>
	</div>
<?php } ?>

<?php 
	 // 하단 HTML
	echo '<div id="faq_thtml" class="faq-html">'.$faq_tail_html.'</div>';

	if ($timg_src) 
		echo '<div id="faq_timg" class="faq-img"><img src="'.$timg_src.'" alt=""></div>';

	if ($admin_href) 
		echo '<p class="text-center"><a href="'.$admin_href.'" class="btn btn-black btn-sm">FAQ 수정</a></p>'; 
?>
