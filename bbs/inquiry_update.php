<?php
/****************************************************************************
■ 메인페이지에서 1:1상담문의 사용 할 때 게시판 테이블과 연동하는 코드 START

*중요
■ 파일을 입력받을 때는 form 태그에 아래의 속성을 추가한다.
enctype="multipart/form-data"
ex) <form name="inquiryForm" method="POST" enctype="multipart/form-data">
****************************************************************************/
include_once('./_common.php');

// 필수 변수 값 입력
/*************************************/
// g4_id, bo_table 값만 입력하면 작동
$gr_id = "m07";
$bo_table = "m0707";
$write_table = "g5_write_".$bo_table;
/*************************************/

$cnt = 0;
$sql = "select * from {$write_table} order by wr_id desc ";
$result = sql_query($sql);
while($row = mysqli_fetch_array($result)){
    $wr_id = $row['wr_id'] + 1;
    $wr_num = -($wr_id);
    $wr_parent = $wr_id;
    $cnt++;
    break;
}

if( $cnt == 0 ) {
    $wr_id = 1;
    $wr_num = -1;
    $wr_parent = 1;
}

if( empty($_POST['wr_1']) ) { alert("고객명을 입력해주세요."); }
else { $wr_1 = $_POST['wr_1']; }

if( empty($_POST['wr_2']) ) { alert("연락처를 입력하세요."); }
else { $wr_2 = $_POST['wr_2']; }

if( empty($_POST['wr_10']) ) { alert("개인정보 이용 및 취급방침에 동의해 주시기 바랍니다."); }
else { $wr_10 = $_POST['wr_10']; }

$content = "고객이름 : {$wr_1} \n연락처 : {$wr_2}";

$wr_datetime = date("Y-m-d G:i:s");

$wr_subject = $wr_1."님의 빠른상담신청 내역입니다.";

$sql = "insert {$write_table}
            set wr_id = '$wr_id',
                wr_num = '$wr_num',
                wr_parent = '$wr_parent',
                wr_subject = '$wr_subject',
                wr_content = '$content',
                mb_id = '$wr_1',
                wr_name = '$wr_1',
                wr_1 = '$wr_1',
                wr_2 = '$wr_2',
                wr_10 = '$wr_10',
                wr_datetime = '$wr_datetime',
                wr_last = '$wr_datetime'
                ";
sql_query($sql);

/******************************
■ 글번호 맞추기 위한 코드
******************************/
$sql = "select * from g5_board where gr_id = '{$gr_id}' and bo_table = '{$bo_table}' ";
$result = sql_query($sql);
while($row = mysqli_fetch_array($result)){
    $bo_count_write = $row['bo_count_write']+1;
}

$sql = "update g5_board
            set bo_count_write = '$bo_count_write'
                where gr_id = '{$gr_id}' and bo_table = '{$bo_table}'
                ";
sql_query($sql);

/******************************
■ 이메일 연동
******************************/
$email_from = "cjhello_online@naver.com"; // 보내는사람 이메일주소
$email_subject = "[SD정보통신][빠른상담신청] {$wr_1} / {$wr_2}"; // 제목
$email_subject = '=?UTF-8?B?'.base64_encode($email_subject).'?=';

// 이메일 내용
$email_message = "";
$email_message .= $content;

// create email headers
$headers = 'From: '.$email_from;

$email_to = "feel8811@hanmail.net"; // 받는사람 이메일주소
@mail($email_to, $email_subject, $email_message, $headers);

$email_to = "velvet1004@nate.com"; // 받는사람 이메일주소
@mail($email_to, $email_subject, $email_message, $headers);

$email_to = "piano8070@naver.com"; // 받는사람 이메일주소
@mail($email_to, $email_subject, $email_message, $headers);

$email_to = "kss950800@naver.com"; // 받는사람 이메일주소
@mail($email_to, $email_subject, $email_message, $headers);

$email_to = "juseong0818@nate.com"; // 받는사람 이메일주소
@mail($email_to, $email_subject, $email_message, $headers);

echo "<script>alert('문의가 정상적으로 접수되었습니다.\\n확인 후 연락드리겠습니다. 감사합니다.');</script>";
echo "<script>location.replace('".$_SERVER['HTTP_REFERER']."');</script>";
?>