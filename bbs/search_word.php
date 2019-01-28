<?php
include_once('./_common.php');

$search_url = "/bbs/board.php?bo_table=m0705";
$sfl = '&sfl=';
$stx = '&stx=';
$cnt = 0;

if( !empty($_POST['wr_1']) ) {
    $data[$cnt]['sfl'] = "wr_subject";
    $data[$cnt]['stx'] = $_POST['wr_1'];
    ++$cnt;
}
if( !empty($_POST['wr_2']) ) {
    $data[$cnt]['sfl'] = "wr_3";
    $data[$cnt]['stx'] = $_POST['wr_2'];
    ++$cnt;
}

for($i=0; $i<$cnt; $i++) {
    if( ($i+1) != $cnt ) {
        $sfl .= $data[$i]['sfl']."||";
        $stx .= $data[$i]['stx']." ";
    } else {
        $sfl .= $data[$i]['sfl'];
        $stx .= $data[$i]['stx'];
    }
}

$search_url .= $sfl.$stx;

echo "<script>location.replace('{$search_url}');</script>";
?>