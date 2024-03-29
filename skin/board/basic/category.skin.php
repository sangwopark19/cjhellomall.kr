<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$ca_cnt = count($categories);
$boset['ctype'] = (isset($boset['ctype']) && $boset['ctype']) ? $boset['ctype'] : '';
$boset['mctab'] = (isset($boset['mctab']) && $boset['mctab']) ? $boset['mctab'] : 'color';

//탭
$category_tabs = (isset($boset['tab']) && $boset['tab']) ? $boset['tab'] : '';
switch($category_tabs) {
	case '-top'		: $category_tabs .= ' tabs-'.$boset['mctab'].'-top'; break;
	case '-bottom'	: $category_tabs .= ' tabs-'.$boset['mctab'].'-bottom'; break;
	case '-line'	: $category_tabs .= ' tabs-'.$boset['mctab'].'-top tabs-'.$boset['mctab'].'-bottom'; break;
	case '-btn'		: $category_tabs .= ' tabs-'.$boset['mctab'].'-bg'; break;
	case '-box'		: $category_tabs .= ' tabs-'.$boset['mctab'].'-bg'; break;
	default			: $category_tabs .= ($boset['tabline']) ? ' tabs-'.$boset['mctab'].'-top' : ' trans-top'; break;
}

$cate_w = ($boset['ctype'] == "2") ? apms_bunhal($ca_cnt + 1, $boset['bunhal']) : ''; //전체 포함으로 +1 해줌

?>

<?php if($gr_id !== 'service') { ?>
<style>
	.list-category {border: 2px solid #2f7de4;border-radius: 10px;padding: 30px 0;margin-bottom: 35px;}
	.div-tab.tabs ul.nav-tabs {text-align: center;}
	.nav-tabs>li {float: none;font-size: 16px;}
	.div-tab.tabs ul.nav-tabs li {display: inline-block;}
	.div-tab.tabs ul.nav-tabs li,
	.div-tab.tabs ul.nav-tabs li a, .div-tab.tabs ul.nav-tabs li a:hover, .div-tab.tabs ul.nav-tabs li a:focus, .div-tab.tabs ul.nav-tabs li:first-child a, .div-tab.tabs ul.nav-tabs li:first-child a:hover, .div-tab.tabs ul.nav-tabs li:first-child a:focus, .div-tab.tabs ul.nav-tabs li:last-child a, .div-tab.tabs ul.nav-tabs li:last-child a:hover, .div-tab.tabs ul.nav-tabs li:last-child a:focus,
	.nav-tabs {border: none!important;background-color: transparent;}

	.div-tab.tabs.trans-top ul.nav-tabs li.active a {color: #2f7de4!important;}
	.all-count {font-size: 15px;margin-bottom: 20px;}
	
	@media all and (max-width:767px){
		.list-category {border: none;}
		.list-category {margin-bottom: 0;padding: 10px 0;}
	}
</style>
<aside class="list-category<?php echo (G5_IS_MOBILE) ? ' list-category-mobile' : '';?>">
	<div class="tabs div-tab<?php echo $category_tabs;?> hidden-xs">
		<ul class="nav nav-tabs<?php echo ($boset['ctype'] == "1") ? ' nav-justified' : '';?><?php echo ($cate_w) ? ' text-center' :'';?>">
			<li<?php echo (!$sca) ? ' class="active"' : '';?><?php echo $cate_w;?>>
				<a href="./board.php?bo_table=<?php echo $bo_table;?>">
					All
				</a>
			</li>
			<?php for ($i=0; $i < $ca_cnt; $i++) { ?>
				<li<?php echo ($categories[$i] === $sca) ? ' class="active"' : '';?><?php echo $cate_w;?>>
					<a href="./board.php?bo_table=<?php echo $bo_table;?>&amp;sca=<?php echo urlencode($categories[$i]);?>">
						<?php echo $categories[$i];?><?php if($categories[$i] === $sca) echo '('.number_format($total_count).')';?>
					</a>
				</li>
			<?php } ?>
		</ul>
	</div>
	<div class="dropdown visible-xs">
		<a id="categoryLabel" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-block btn-<?php echo $boset['mctab'];?>">
			<?php echo ($sca) ? $sca : 'All';?>(<?php echo number_format($total_count);?>)
		</a>
		<ul class="dropdown-menu" role="menu" aria-labelledby="categoryLabel">
			<li<?php if(!$sca) echo ' class="selected"';?>>
				<a href="./board.php?bo_table=<?php echo $bo_table;?>">All</a>
			</li>
			<?php for ($i=0; $i < $ca_cnt; $i++) { ?>
				<li<?php if($categories[$i] === $sca) echo ' class="selected"';?>>
					<a href="./board.php?bo_table=<?php echo $bo_table;?>&amp;sca=<?php echo urlencode($categories[$i]);?>"><?php echo $categories[$i];?></a>
				</li>
			<?php } ?>
		</ul>
	</div>
</aside>
<div class="all-count">
	<?php if(!$sca) echo '총'.number_format($total_count).'개';?>
</div>
<?php } else {?>
<style>
	.title {margin-bottom: 38px;}
	.div-tab.tabs ul.nav-tabs li {width: 16.6666%;text-align: center;background-color: #fff;font-size: 16px;}
	.div-tab.tabs.trans-top ul.nav-tabs li.active a {background-color: #464646;color: #fff!important;}
	.nav>li>a {padding: 12px 0;}
	.list-category {margin-bottom: 56px;}
</style>
<aside class="list-category<?php echo (G5_IS_MOBILE) ? ' list-category-mobile' : '';?>">
	<div class="tabs div-tab<?php echo $category_tabs;?> hidden-xs">
		<ul class="nav nav-tabs<?php echo ($boset['ctype'] == "1") ? ' nav-justified' : '';?><?php echo ($cate_w) ? ' text-center' :'';?>">
			<li<?php echo (!$sca) ? ' class="active"' : '';?><?php echo $cate_w;?>>
				<a href="./board.php?bo_table=<?php echo $bo_table;?>">
					All
				</a>
			</li>
			<?php for ($i=0; $i < $ca_cnt; $i++) { ?>
				<li<?php echo ($categories[$i] === $sca) ? ' class="active"' : '';?><?php echo $cate_w;?>>
					<a href="./board.php?bo_table=<?php echo $bo_table;?>&amp;sca=<?php echo urlencode($categories[$i]);?>">
						<?php echo $categories[$i];?><?php if($categories[$i] === $sca) echo '('.number_format($total_count).')';?>
					</a>
				</li>
			<?php } ?>
		</ul>
	</div>
	<div class="dropdown visible-xs">
		<a id="categoryLabel" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-block btn-<?php echo $boset['mctab'];?>">
			<?php echo ($sca) ? $sca : 'All';?>(<?php echo number_format($total_count);?>)
		</a>
		<ul class="dropdown-menu" role="menu" aria-labelledby="categoryLabel">
			<li<?php if(!$sca) echo ' class="selected"';?>>
				<a href="./board.php?bo_table=<?php echo $bo_table;?>">All</a>
			</li>
			<?php for ($i=0; $i < $ca_cnt; $i++) { ?>
				<li<?php if($categories[$i] === $sca) echo ' class="selected"';?>>
					<a href="./board.php?bo_table=<?php echo $bo_table;?>&amp;sca=<?php echo urlencode($categories[$i]);?>"><?php echo $categories[$i];?></a>
				</li>
			<?php } ?>
		</ul>
	</div>
</aside>
<?php }?>