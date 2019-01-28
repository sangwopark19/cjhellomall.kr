<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$write_skin_url.'/write.css" media="screen">', 0);

if(!$header_skin) { 
?>
<div class="title-box">
	기본정보입력
</div>
<?php } ?>
<style>
	.adrs {width: 180px;float: left;}
	.title-box {font-size: 23px;border-bottom: 2px solid #000;padding-bottom: 17px;margin-bottom: 25px;margin-top: 15px;}
	.form-horizontal .control-label {text-align: left;font-size: 14px;}
	.input-box {width: 50%;float: left;margin-right: 10px;}
	.form-over {overflow: hidden;margin-bottom: 10px;}
	.addr_btn {background-color: #333;color: #fff;border: none;box-shadow: none;padding: 4px 20px;margin-left: 10px;}
	.write-wrap label {color: #333;}
	
    .sub_page_title h2{margin:0;font-weight: 700;font-size:16px;line-height: 24px;padding: 0;margin-bottom: 10px;}
    .privacy_box{width:100%;height: 125px;border:1px solid #f2f2f2;overflow-y:scroll;padding:15px;background: #fff;margin-bottom: 10px;}
    .privacy_chk{text-align: right;font-size:14px;padding-top:25px;border-bottom:none;padding-bottom: 0;}
    
    .privacy_wrap {padding: 10px;background: #f8f8f8;border: 1px solid #ececec;margin-bottom: 40px;}
    .privacy_wrap .form-horizontal .form-group,input[type=radio], input[type=checkbox] {margin: 0;}
    .privacy_wrap .form-group {margin-top: 22px;}
	
	.btn-com {width: 100px;height: 40px;background-color: #333;color: #fff;text-align: center;line-height: 25px;font-size: 16px;}
	.btn-com:hover {color: #fff;}
	.soot-input {width: 180px;}
	
	.d_form {font-size: 1em;
    padding: .5em;
    border: 1px solid #ccc;
    border-color: #dbdbdb #d2d2d2 #d0d0d0 #d2d2d3;
    box-shadow: inset 0.1em 0.1em 0.15em rgba(0,0,0,.1);
    vertical-align: middle;
    line-height: 1.25em;
    outline: 0;
    width: 20em;
	}
	.d_form.std {width: 25em;margin-bottom: 5px;}
	.d_btn {
		display: inline-block;
		padding: .5em 1em;
		margin: .4em .15em;
		border: 1px solid #ccc;
		border-color: #dbdbdb #d2d2d2 #b2b2b2 #d2d2d3;
		cursor: pointer;
		color: #464646;
		border-radius: .2em;
		vertical-align: middle;
		font-size: 1em;
		line-height: 1.25em;
		background-image: -webkit-gradient(linear,left top,left bottom,from(#fff),to(#f2f2f2));
		background-image: -moz-linear-gradient(top,#fff,#f2f2f2);
		background-image: -o-gradient(top,#fff,#f2f2f2);
		background-image: linear-gradient(top,#fff,#f2f2f2);
	}
	.d_form.mini {width: 7em;}
</style>
<!-- 게시물 작성/수정 시작 { -->
<form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" role="form" class="form-horizontal">
<input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
<input type="hidden" name="sca" value="<?php echo $sca ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="spt" value="<?php echo $spt ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<?php
	$option = '';
	$option_hidden = '';
	if ($is_notice || $is_html || $is_secret || $is_mail) {
		if ($is_notice) {
			$option .= "\n".'<label class="control-label sp-label"><input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'> 공지</label>';
		}

		if ($is_html) {
			if ($is_dhtml_editor) {
				$option_hidden .= '<input type="hidden" value="html1" name="html">';
			} else {
				$option .= "\n".'<label class="control-label sp-label"><input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'> HTML</label>';
			}
		}

		if ($is_secret) {
			if ($is_admin || $is_secret==1) {
				$option .= "\n".'<label class="control-label sp-label"><input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'> 비밀글</label>';
			} else {
				$option_hidden .= '<input type="hidden" name="secret" value="secret">';
			}
		}

		if ($is_notice) {
			$main_checked = ($write['as_type']) ? ' checked' : '';
			$option .= "\n".'<label class="control-label sp-label"><input type="checkbox" id="as_type" name="as_type" value="1" '.$main_checked.'> 메인글</label>';
		}

		if ($is_mail) {
			$option .= "\n".'<label class="control-label sp-label"><input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'> 답변메일받기</label>';
		}
	}

	echo $option_hidden;
?>

<?php if ($is_name) { ?>
	<input type="hidden" name="wr_name" id="wr_name" value="test">
<?php } ?>

<?php if ($is_password) { ?>
	<input type="hidden" name="wr_password" id="wr_password" value="1234">
<?php } ?>

<div class="form-group">
	<label class="col-sm-2 control-label" for="wr_subject">이름<span class="red">*</span></label>
	<div class="col-sm-6">
		<input type="text" name="wr_subject" id="wr_subject" value="<?php echo $subject ?>" class="form-control input-sm soot-input" size="50">
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="wr_1">전화번호<span class="red">*</span></label>
	<div class="col-sm-6">
		<input type="text" name="wr_1" id="wr_1" value="<?php echo $wr_1 ?>" class="form-control input-sm soot-input" size="50" placeholder="예)010-0000-0000">
		<div>(반드시 본인명의 휴대폰이 있어야만 가입이 가능합니다.)</div>
	</div>
</div>
	
<div class="form-group">
	<label class="col-sm-2 control-label" for="wr_2">E-mail<span class="red">*</span></label>
	<div class="col-sm-6">
		<input type="text" name="wr_2" id="wr_2" value="<?php echo $wr_2 ?>" class="form-control input-sm soot-input" size="50">
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="wr_4">상담시간<span class="red">*</span></label>
	<div class="col-sm-10">
		<select name="wr_6" class="soot-input form-control input-sm">
			<option value="9시">9시</option>
			<option value="10시">10시</option>
			<option value="11시">11시</option>
			<option value="12시">12시</option>
			<option value="13시">13시</option>
			<option value="14시">14시</option>
			<option value="15시">15시</option>
			<option value="16시">16시</option>
			<option value="17시">17시</option>
			<option value="18시">18시</option>
		</select>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="wr_content">상담문의<span class="red">*</span></label>
	<div class="col-sm-10">
		<input type="text" name="wr_content" id="wr_content" value="<?php echo $content ?>" class="form-control input-sm" size="50">
	</div>
</div>
<hr>	
<div class="sub_page_title">
	<h2>
		개인정보 수집 이용 동의
	</h2>
</div>
<div class="privacy_wrap">
	<div class="privacy_box">
		<div>
<div class="page-content">

			<div class="text-center" style="margin:15px 0px;">
			<h3 class="div-title-underline-bold border-color">
				개인정보 처리방침
			</h3>
		</div>
	
	<div class="article-title" style="padding-top:0px;">제1조 총칙</div>

	<ol>
		<li>본 사이트는 귀하의 개인정보보호를 매우 중요시하며, 『정보통신망이용촉진등에관한법률』상의 개인정보보호 규정 및 정보통신부가 제정한 『개인정보보호지침』을 준수하고 있습니다. 
		</li><li>본 사이트는 개인정보보호방침을 통하여 귀하께서 제공하시는 개인정보가 어떠한 용도와 방식으로 이용되고 있으며 개인정보보호를 위해 어떠한 조치가 취해지고 있는지 알려드립니다. 
		</li><li>본 사이트는 개인정보보호방침을 홈페이지 첫 화면 하단에 공개함으로써 귀하께서 언제나 용이하게 보실 수 있도록 조치하고 있습니다. 
		</li><li>본 사이트는 개인정보취급방침을 개정하는 경우 웹사이트 공지사항(또는 개별공지)을 통하여 공지할 것입니다.
	</li></ol>

	<div class="article-title">제2조 개인정보 수집에 대한 동의</div>

	귀하께서 본 사이트의 개인정보보호방침 또는 이용약관의 내용에 대해 「동의한다」버튼 또는 「동의하지 않는다」버튼을 클릭할 수 있는 절차를 마련하여, 「동의한다」버튼을 클릭하면 개인정보 수집에 대해 동의한 것으로 봅니다. 

	<div class="article-title">제3조 개인정보의 수집 및 이용목적</div>

	<ol>
		<li>본 사이트는 다음과 같은 목적을 위하여 개인정보를 수집하고 있습니다.
		<ol>
			<li>서비스제공을 위한 계약의 성립 : 본인식별 및 본인의사 확인 등
			</li><li>서비스의 이행 : 상품배송 및 대금결제
			</li><li>회원 관리 : 회원제 서비스 이용에 따른 본인확인, 개인 식별, 연령확인, 불만처리 등 민원처리
			</li><li>기타 새로운 서비스, 신상품이나 이벤트 정보 안내
		</li></ol>
		</li><li>단, 이용자의 기본적 인권 침해의 우려가 있는 민감한 개인정보(인종 및 민족, 사상 및 신조, 출신지 및 본적지, 정치적 성향 및 범죄기록, 건강상태 및 성생활 등)는 수집하지 않습니다. 
	</li></ol>

	<div class="article-title">제4조 수집하는 개인정보 항목</div>

	본 사이트는 회원가입, 상담, 서비스 신청 등등을 위해 아래와 같은 개인정보를 수집하고 있습니다.
	<ol>
		<li>수집항목 : 이름 , 생년월일 , 성별 , 로그인ID , 비밀번호 , 자택 전화번호 , 자택 주소 , 휴대전화번호 , 이메일 , 주민등록번호 , 접속 로그 , 접속 IP 정보 , 결제기록
		</li><li>개인정보 수집방법 : 홈페이지(회원가입) 
	</li></ol>

	<div class="article-title">제5조 개인정보 자동수집 장치의 설치, 운영 및 그 거부에 관한 사항</div>

	본 사이트는 귀하에 대한 정보를 저장하고 수시로 찾아내는 '쿠키(cookie)'를 사용합니다. 쿠키는 웹사이트가 귀하의 컴퓨터 브라우저(넷스케이프, 인터넷 익스플로러 등)로 전송하는 소량의 정보입니다. 귀하께서 웹사이트에 접속을 하면 본 쇼핑몰의 컴퓨터는 귀하의 브라우저에 있는 쿠키의 내용을 읽고, 귀하의 추가정보를 귀하의 컴퓨터에서 찾아 접속에 따른 성명 등의 추가 입력 없이 서비스를 제공할 수 있습니다. 
	<p>
	쿠키는 귀하의 컴퓨터는 식별하지만 귀하를 개인적으로 식별하지는 않습니다. 또한 귀하는 쿠키에 대한 선택권이 있습니다. 웹브라우저의 옵션을 조정함으로써 모든 쿠키를 다 받아들이거나, 쿠키가 설치될 때 통지를 보내도록 하거나, 아니면 모든 쿠키를 거부할 수 있는 선택권을 가질 수 있습니다. 
	</p><ol>
		<li>쿠키 등 사용 목적 : 이용자의 접속 빈도나 방문 시간 등을 분석, 이용자의 취향과 관심분야를 파악 및 자취 추적, 각종 이벤트 참여 정도 및 방문 회수 파악 등을 통한 타겟 마케팅 및 개인 맞춤 서비스 제공
		</li><li>쿠키 설정 거부 방법 : 쿠키 설정을 거부하는 방법으로는 귀하가 사용하는 웹 브라우저의 옵션을 선택함으로써 모든 쿠키를 허용하거나 쿠키를 저장할 때마다 확인을 거치거나, 모든 쿠키의 저장을 거부할 수 있습니다. 
		</li><li>설정방법 예시 : 인터넷 익스플로어의 경우 → 웹 브라우저 상단의 도구 &gt; 인터넷 옵션 &gt; 개인정보
		</li><li>단, 귀하께서 쿠키 설치를 거부하였을 경우 서비스 제공에 어려움이 있을 수 있습니다.
	</li></ol>

	<div class="article-title">제6조 목적 외 사용 및 제3자에 대한 제공</div>

	<ol>
		<li>본 사이트는 귀하의 개인정보를 "개인정보의 수집목적 및 이용목적"에서 고지한 범위 내에서 사용하며, 동 범위를 초과하여 이용하거나 타인 또는 타기업·기관에 제공하지 않습니다. 
		</li><li>그러나 보다 나은 서비스 제공을 위하여 귀하의 개인정보를 제휴사에게 제공하거나 또는 제휴사와 공유할 수 있습니다. 개인정보를 제공하거나 공유할 경우에는 사전에 귀하께 제휴사가 누구인지, 제공 또는 공유되는 개인정보항목이 무엇인지, 왜 그러한 개인정보가 제공되거나 공유되어야 하는지, 그리고 언제까지 어떻게 보호·관리되는지에 대해 개별적으로 전자우편 및 서면을 통해 고지하여 동의를 구하는 절차를 거치게 되며, 귀하께서 동의하지 않는 경우에는 제휴사에게 제공하거나 제휴사와 공유하지 않습니다. 
		</li><li>또한 이용자의 개인정보를 원칙적으로 외부에 제공하지 않으나, 아래의 경우에는 예외로 합니다.
		<ol>
			<li>이용자들이 사전에 동의한 경우
			</li><li>법령의 규정에 의거하거나, 수사 목적으로 법령에 정해진 절차와 방법에 따라 수사기관의 요구가 있는 경우
		</li></ol>
	</li></ol>

	<div class="article-title">제7조 개인정보의 열람 및 정정</div>

	<ol>
		<li>귀하는 언제든지 등록되어 있는 귀하의 개인정보를 열람하거나 정정하실 수 있습니다. 개인정보 열람 및 정정을 하고자 할 경우에는 "회원정보수정"을 클릭하여 직접 열람 또는 정정하거나, 개인정보관리책임자에게 E-mail로 연락하시면 조치하겠습니다. 
		</li><li>귀하가 개인정보의 오류에 대한 정정을 요청한 경우, 정정을 완료하기 전까지 당해 개인정보를 이용하지 않습니다. 
	</li></ol>

	<div class="article-title">제8조 개인정보 수집, 이용, 제공에 대한 동의철회</div>

	<ol>
		<li>회원가입 등을 통해 개인정보의 수집, 이용, 제공에 대해 귀하께서 동의하신 내용을 귀하는 언제든지 철회하실 수 있습니다. 동의철회는 "마이페이지"의 "회원탈퇴(동의철회)"를 클릭하거나 개인정보관리책임자에게 E-mail등으로 연락하시면 즉시 개인정보의 삭제 등 필요한 조치를 하겠습니다. 
		</li><li>본 사이트는 개인정보의 수집에 대한 회원탈퇴(동의철회)를 개인정보 수집시와 동등한 방법 및 절차로 행사할 수 있도록 필요한 조치를 하겠습니다. 
	</li></ol>

	<div class="article-title">제9조 개인정보의 보유 및 이용기간</div>

	<ol>
		<li>원칙적으로, 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체 없이 파기합니다. 단, 다음의 정보에 대해서는 아래의 이유로 명시한 기간 동안 보존합니다.
		<ol>
			<li>보존 항목 : 회원가입정보(로그인ID, 이름, 별명)
			</li><li>보존 근거 : 회원탈퇴시 다른 회원이 기존 회원아이디로 재가입하여 활동하지 못하도록 하기 위함
			</li><li>보존 기간 : 사이트 폐쇄 또는 영업 종료시
		</li></ol>
		</li><li> 그리고 상법 등 관계법령의 규정에 의하여 보존할 필요가 있는 경우 회사는 아래와 같이 관계법령에서 정한 일정한 기간 동안 거래 및 회원정보를 보관합니다.
		<ol>
			<li>보존 항목 : 계약 또는 청약철회 기록, 대금 결제 및 재화공급 기록, 불만 또는 분쟁처리 기록
			</li><li>보존 근거 : 전자상거래등에서의 소비자보호에 관한 법률 제6조 거래기록의 보존
			</li><li>보존 기간 : 계약 또는 청약철회 기록(5년), 대금 결제 및 재화공급 기록(5년), 불만 또는 분쟁처리 기록(3년)
		</li></ol>
		</li><li>위 보유기간에도 불구하고 계속 보유하여야 할 필요가 있을 경우에는 귀하의 동의를 받겠습니다. 
	</li></ol>

	<div class="article-title">제10조 개인정보의 파기절차 및 방법</div>

	본 사이트는 원칙적으로 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체없이 파기합니다. 파기절차 및 방법은 다음과 같습니다.
	<ol>
		<li>파기절차 : 귀하가 회원가입 등을 위해 입력하신 정보는 목적이 달성된 후 별도의 DB로 옮겨져(종이의 경우 별도의 서류함) 내부 방침 및 기타 관련 법령에 의한 정보보호 사유에 따라(보유 및 이용기간 참조) 일정 기간 저장된 후 파기되어집니다. 별도 DB로 옮겨진 개인정보는 법률에 의한 경우가 아니고서는 보유되어지는 이외의 다른 목적으로 이용되지 않습니다.
		</li><li>파기방법 : 전자적 파일형태로 저장된 개인정보는 기록을 재생할 수 없는 기술적 방법을 사용하여 삭제합니다. 
	</li></ol>

	<div class="article-title">제11조 아동의 개인정보 보호</div>

	<ol>
		<li>본 사이트는 만14세 미만 아동의 개인정보를 수집하는 경우 법정대리인의 동의를 받습니다. 
		</li><li>만14세 미만 아동의 법정대리인은 아동의 개인정보의 열람, 정정, 동의철회를 요청할 수 있으며, 이러한 요청이 있을 경우 본 사이트는 지체없이 필요한 조치를 취합니다. 
	</li></ol>

	<div class="article-title">제12조 개인정보 보호를 위한 기술적 대책</div>

	본 사이트는 귀하의 개인정보를 취급함에 있어 개인정보가 분실, 도난, 누출, 변조 또는 훼손되지 않도록 안전성 확보를 위하여 다음과 같은 기술적 대책을 강구하고 있습니다. 
	<ol>
		<li>귀하의 개인정보는 비밀번호에 의해 보호되며, 파일 및 전송 데이터를 암호화하거나 파일 잠금기능(Lock)을 사용하여 중요한 데이터는 별도의 보안기능을 통해 보호되고 있습니다. 
		</li><li>본 사이트는 백신프로그램을 이용하여 컴퓨터바이러스에 의한 피해를 방지하기 위한 조치를 취하고 있습니다. 백신프로그램은 주기적으로 업데이트되며 갑작스런 바이러스가 출현할 경우 백신이 나오는 즉시 이를 제공함으로써 개인정보가 침해되는 것을 방지하고 있습니다. 
		</li><li>해킹 등에 의해 귀하의 개인정보가 유출되는 것을 방지하기 위해, 외부로부터의 침입을 차단하는 장치를 이용하고 있습니다. 
	</li></ol>

	<div class="article-title">제13조 개인정보의 위탁처리</div>

	본 사이트는 서비스 향상을 위해서 귀하의 개인정보를 외부에 위탁하여 처리할 수 있습니다. 
	<ol>
		<li>개인정보의 처리를 위탁하는 경우에는 미리 그 사실을 귀하에게 고지하겠습니다. 
		</li><li>개인정보의 처리를 위탁하는 경우에는 위탁계약 등을 통하여 서비스제공자의 개인정보호 관련 지시엄수, 개인정보에 관한 비밀유지, 제3자 제공의 금지 및 사고시의 책임부담 등을 명확히 규정하고 당해 계약내용을 서면 또는 전자적으로 보관하겠습니다. 
	</li></ol>

	<div class="article-title">제14조 의견수렴 및 불만처리</div>

	<ol>
		<li>본 사이트는 개인정보보호와 관련하여 귀하가 의견과 불만을 제기할 수 있는 창구를 개설하고 있습니다. 개인정보와 관련한 불만이 있으신 분은 본 쇼핑몰의 개인정보 관리책임자에게 의견을 주시면 접수 즉시 조치하여 처리결과를 통보해 드립니다.
		<ol>
			<li>개인정보 보호책임자 성명 : 호남통신
			</li><li>전화번호 : 1855-0330
			</li><li>이메일 : cjhello_online@naver.com
		</li></ol>
		</li><li>또는 개인정보침해에 대한 신고나 상담이 필요하신 경우에는 아래 기관에 문의하시기 바랍니다.
		<ol>
			<li>개인분쟁조정위원회 (<a href="http://www.1336.or.kr" target="_blank">www.1336.or.kr</a> / 1336)
			</li><li>정보보호마크인증위원회 (<a href="http://www.eprivacy.or.kr" target="_blank">www.eprivacy.or.kr</a> / 02-580-0533~4)
			</li><li>대검찰청 인터넷범죄수사센터 (<a href="http://icic.sppo.go.kr" target="_blank">icic.sppo.go.kr</a> / 02-3480-3600)
			</li><li>경찰청 사이버테러대응센터 (<a href="http://www.ctrc.go.kr" target="_blank">www.ctrc.go.kr</a> / 02-392-0330)
		</li></ol>
	</li></ol>

	<div class="article-title">부&nbsp;&nbsp;칙 시행일 등</div> 

	<ol>
		<li>본 방침은 OOOO년 OO월 OO일부터 시행합니다.
	</li></ol>

</div>
		</div>
	</div>
    <div>
        <input type="checkbox" name="wr_10" id="wr_10" style="margin:0">
        <label for="wr_10">
            개인정보 취급방침에 동의합니다.
        </label>
     </div>
</div>
	
<?php if ($is_category || $option) { ?>
	<div class="form-group" style="display:none">
		<label class="col-sm-2 control-label hidden-xs"><?php echo ($is_category) ? '분류' : '옵션';?></label>
		<?php if ($is_category) { ?>
			<div class="col-sm-3">
				<select name="ca_name" id="ca_name" required class="form-control input-sm">
					<option value="">선택하세요</option>
					<?php echo $category_option ?>
				</select>
			</div>
		<?php } ?>
		<?php if ($option) { ?>
			<div class="col-sm-7">
				<div class="h10 visible-xs"></div>
				<?php echo $option ?>
			</div>
		<?php } ?>
	</div>
<?php } ?>

<?php if ($is_member) { // 임시 저장된 글 기능 ?>
	<script src="<?php echo G5_JS_URL; ?>/autosave.js"></script>
	<?php if($editor_content_js) echo $editor_content_js; ?>
	<div class="modal fade" id="autosaveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">임시 저장된 글 목록</h4>
				</div>
				<div class="modal-body">
					<div id="autosave_wrapper">
						<div id="autosave_pop">
							<ul></ul>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<?php if ($is_guest) { //자동등록방지  ?>
	<div class="well well-sm text-center">
		<?php echo $captcha_html; ?>
	</div>
<?php } ?>

<div class="write-btn pull-center">
	<button type="submit" id="btn_submit" accesskey="s" class="btn btn-com btn-sm">확인</button>
</div>

<div class="clearfix"></div>

</form>

<script>
<?php if($write_min || $write_max) { ?>
// 글자수 제한
var char_min = parseInt(<?php echo $write_min; ?>); // 최소
var char_max = parseInt(<?php echo $write_max; ?>); // 최대
check_byte("wr_content", "char_count");

$(function() {
	$("#wr_content").on("keyup", function() {
		check_byte("wr_content", "char_count");
	});
});
<?php } ?>

function apms_myicon() {
	document.getElementById("picon").value = '';
	document.getElementById("ticon").innerHTML = '<?php echo str_replace("'","\"", $myicon);?>';
	return true;
}

function html_auto_br(obj) {
	if (obj.checked) {
		result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
		if (result)
			obj.value = "html2";
		else
			obj.value = "html1";
	}
	else
		obj.value = "";
}

function fwrite_submit(f) {

	<?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

	var subject = "";
	var content = "";
	$.ajax({
		url: g5_bbs_url+"/ajax.filter.php",
		type: "POST",
		data: {
			"subject": f.wr_subject.value,
			"content": f.wr_content.value
		},
		dataType: "json",
		async: false,
		cache: false,
		success: function(data, textStatus) {
			subject = data.subject;
			content = data.content;
		}
	});

	if (subject) {
		alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
		f.wr_subject.focus();
		return false;
	}

	if (content) {
		alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
		if (typeof(ed_wr_content) != "undefined")
			ed_wr_content.returnFalse();
		else
			f.wr_content.focus();
		return false;
	}

	if (document.getElementById("char_count")) {
		if (char_min > 0 || char_max > 0) {
			var cnt = parseInt(check_byte("wr_content", "char_count"));
			if (char_min > 0 && char_min > cnt) {
				alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
				return false;
			}
			else if (char_max > 0 && char_max < cnt) {
				alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
				return false;
			}
		}
	}

	<?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

	document.getElementById("btn_submit").disabled = "disabled";

	return true;
}

$(function(){
	$("#wr_content").addClass("form-control input-sm write-content");
});
</script>

<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script>
    function sample6_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var fullAddr = ''; // 최종 주소 변수
                var extraAddr = ''; // 조합형 주소 변수

                // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    fullAddr = data.roadAddress;

                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    fullAddr = data.jibunAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
                if(data.userSelectedType === 'R'){
                    //법정동명이 있을 경우 추가한다.
                    if(data.bname !== ''){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있을 경우 추가한다.
                    if(data.buildingName !== ''){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                    fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('sample6_postcode').value = data.zonecode; //5자리 새우편번호 사용
                document.getElementById('sample6_address').value = fullAddr;

                // 커서를 상세주소 필드로 이동한다.
                document.getElementById('sample6_address2').focus();
            }
        }).open();
    }
</script>
