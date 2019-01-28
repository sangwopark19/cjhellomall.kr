<?php
include_once('./_common.php');

//print_r($_POST);

$sql = " SELECT wr_id FROM g5_write_m0705 WHERE wr_subject='{$wr_subject}' AND wr_3='{$wr_3}' ";
$res = sql_query($sql);
$wr = mysqli_fetch_array($res);

if( empty($wr['wr_id']) ) {
	alert("일치하는 렌탈신청 결과가 없습니다.\\n이름 : {$wr_subject}\\n전화번호 : {$wr_3}");
} else {
	goto_url(G5_HTTP_BBS_URL.'/board.php?bo_table=m0705&wr_id='.$wr['wr_id'].'&wr_subject='.$wr_subject.'&wr_3='.$wr_3);
}
?>