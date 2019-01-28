<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
?>
<div class="sidebar-login">
	<?php if($is_member) { //Login ?>
		<div class="profile">
			<a href="<?php echo $at_href['myphoto'];?>" target="_blank" class="win_memo" title="사진등록">
				<div class="photo pull-left">
					<?php echo ($member['photo']) ? '<img src="'.$member['photo'].'" alt="">' : '<i class="fa fa-user-plus"></i>'; //사진 ?>
				</div>
			</a>
			<h3><?php echo $member['mb_nick'];?></h3>
			<div class="font-12 text-muted" style="letter-spacing:-1px;">
				<?php echo $member['grade'];?>
			</div>
			<div class="clearfix"></div>
		</div>

		<div class="btn-group btn-group-justified" role="group">
			<?php if($member['admin']) { ?>
				<a href="<?php echo G5_ADMIN_URL;?>" class="btn btn-navy btn-sm">관리자</a>
			<?php } ?>
			<?php if($member['partner']) { ?>
				<a href="<?php echo $at_href['myshop'];?>" class="btn btn-navy btn-sm">마이샵</a>
			<?php } ?>
			<a href="<?php echo $at_href['logout'];?>" class="btn btn-navy btn-sm">나가기</a>
		</div>
		
		<div class="h15"></div>

		<!-- Service -->
		<div class="div-title-underline-thin en">
			<b>MY MENU</b>
		</div>

		<ul class="sidebar-list list-links">
			<li>
				<a href="<?php echo $at_href['mypage']; ?>">
					마이페이지
				</a>
			</li>
			<li>
				<a href="<?php echo $at_href['mypost']; ?>" target="_blank" class="win_memo">
					내글관리
				</a>
			</li>
			<li>
				<a href="<?php echo $at_href['myphoto'];?>" target="_blank" class="win_memo">
					사진등록
				</a>
			</li>
			<li>
				<a href="<?php echo $at_href['edit'];?>">
					정보수정
				</a>
			</li>
			<li>
				<a href="<?php echo $at_href['leave'];?>" class="leave-me">
					탈퇴하기
				</a>
			</li>
		</ul>

	<?php } else { //Logout ?>

		<form id="sidebar_login_form" name="sidebar_login_form" method="post" action="<?php echo $at_href['login_check'];?>" autocomplete="off" role="form" class="form" onsubmit="return sidebar_login(this);">
		<input type="hidden" name="url" value="<?php echo $urlencode; ?>">
			<div class="form-group">	
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user gray"></i></span>
					<input type="text" name="mb_id" id="mb_id" class="form-control input-sm" placeholder="아이디" tabindex="91">
				</div>
			</div>
			<div class="form-group">	
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-lock gray"></i></span>
					<input type="password" name="mb_password" id="mb_password" class="form-control input-sm" placeholder="비밀번호" tabindex="92">
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-navy btn-block" tabindex="93">Login</button>    
			</div>	

			<label class="text-muted" style="letter-spacing:-1px;">
				<input type="checkbox" name="auto_login" value="1" id="remember_me" class="remember-me" tabindex="94">
				자동로그인 및 로그인 상태 유지
			</label>
		</form>

		<div class="h10"></div>

		<?php if($sns_login_icon) { // 소셜로그인 ?>
			<!-- SNS Login -->
			<div class="div-title-underline-thin en">
				<b>SNS LOGIN</b>
			</div>
			<div class="sidebar-sns-login">
				<?php echo $sns_login_icon; ?>
				<div class="clearfix"></div>
			</div>
			<div class="h20"></div>
		<?php } ?>

		<!-- Member -->
		<div class="div-title-underline-thin en">
			<b>MEMBER</b>
		</div>
		<ul class="sidebar-list list-links">
			<li><a href="<?php echo $at_href['reg'];?>">회원가입</a></li>
			<li><a href="<?php echo $at_href['lost'];?>" class="win_password_lost">아이디/비밀번호 찾기</a></li>
		</ul>
		
	<?php } //End ?>
</div>

<div class="h20"></div>

