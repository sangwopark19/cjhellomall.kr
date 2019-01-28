<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$view_skin_url.'/view.css" media="screen">', 0);

$attach_list = '';
if ($view['link']) {
	// 링크
	for ($i=1; $i<=count($view['link']); $i++) {
		if ($view['link'][$i]) {
			$attach_list .= '<a class="list-group-item break-word" href="'.$view['link_href'][$i].'" target="_blank">';
			$attach_list .= '<i class="fa fa-link"></i> '.cut_str($view['link'][$i], 70).' &nbsp;<span class="blue">+ '.$view['link_hit'][$i].'</span></a>'.PHP_EOL;
		}
	}
}

// 가변 파일
$j = 0;
if ($view['file']['count']) {
	for ($i=0; $i<count($view['file']); $i++) {
		if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
			if ($board['bo_download_point'] < 0 && $j == 0) {
				$attach_list .= '<a class="list-group-item"><i class="fa fa-bell red"></i> 다운로드시 <b>'.number_format(abs($board['bo_download_point'])).'</b>'.AS_MP.' 차감 (최초 1회 / 재다운로드시 차감없음)</a>'.PHP_EOL;
			}
			$file_tooltip = '';
			if($view['file'][$i]['content']) {
				$file_tooltip = ' data-original-title="'.strip_tags($view['file'][$i]['content']).'" data-toggle="tooltip"';
			}
			$attach_list .= '<a class="list-group-item break-word view_file_download at-tip" href="'.$view['file'][$i]['href'].'"'.$file_tooltip.'>';
			$attach_list .= '<span class="pull-right hidden-xs text-muted"><i class="fa fa-clock-o"></i> '.date("Y.m.d H:i", strtotime($view['file'][$i]['datetime'])).'</span>';
			$attach_list .= '<i class="fa fa-download"></i> '.$view['file'][$i]['source'].' ('.$view['file'][$i]['size'].') &nbsp;<span class="orangered">+ '.$view['file'][$i]['download'].'</span></a>'.PHP_EOL;
			$j++;
		}
	}
}

$view_font = (G5_IS_MOBILE) ? '' : ' font-12';
$view_subject = get_text($view['wr_subject']);

?>
<section itemscope itemtype="http://schema.org/NewsArticle">
	<article itemprop="articleBody">
		<h1 itemprop="headline" content="<?php echo $view_subject;?>" class="title-wrap">
			<div class="title-box">
				<?php echo cut_str(get_text($view['wr_subject']), 70); ?>
			</div>
			<div class="name-box">
				이름 | 전화번호
			</div>
			<div class="content-box ellipsis">
				<?php echo get_view_thumbnail($view['content']); ?>
			</div>
		</h1>

		<div class="view-padding">

			<?php
				// 이미지 상단 출력
				$v_img_count = count($view['file']);
				if($v_img_count && $is_img_head) {
					echo '<div class="view-img">'.PHP_EOL;
					for ($i=0; $i<=count($view['file']); $i++) {
						if ($view['file'][$i]['view']) {
							echo get_view_thumbnail($view['file'][$i]['view']);
						}
					}
					echo '</div>'.PHP_EOL;
				}
			 ?>

			<div itemprop="description" class="view-content">
				<?php echo get_view_thumbnail($view['content']); ?>
			</div>
		</div>

		<?php if ($good_href || $nogood_href) { ?>
			<div class="print-hide view-good-box">
				<?php if ($good_href) { ?>
					<span class="view-good">
						<a href="#" onclick="apms_good('<?php echo $bo_table;?>', '<?php echo $wr_id;?>', 'good', 'wr_good'); return false;">
							<b id="wr_good"><?php echo $view['wr_good']; ?></b>
							<br>
							<i class="fa fa-thumbs-up"></i>
						</a>
					</span>
				<?php } ?>
				<?php if ($nogood_href) { ?>
					<span class="view-nogood">
						<a href="#" onclick="apms_good('<?php echo $bo_table;?>', '<?php echo $wr_id;?>', 'nogood', 'wr_nogood'); return false;">
							<b id="wr_nogood"><?php echo $view['wr_nogood']; ?></b>
							<br>
							<i class="fa fa-thumbs-down"></i>
						</a>
					</span>
				<?php } ?>
			</div>
			<p></p>
		<?php } else { //여백주기 ?>
			<div class="h40"></div>
		<?php } ?>

		<?php if ($is_tag) { // 태그 ?>
			<p class="view-tag view-padding<?php echo $view_font;?>"><i class="fa fa-tags"></i> <?php echo $tag_list;?></p>
		<?php } ?>

	</article>
</section>
<div class="sns-box">
		<?php 
			// SNS 보내기
			if ($board['bo_use_sns']) {
				echo apms_sns_share_icon('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], $view['subject'], $seometa['img']['src']);
			}
		?>
</div>
