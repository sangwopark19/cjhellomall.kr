<?php
$sub_menu = "100600";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '회원관리';
include_once('./admin.head.php');
?>

<div class="local_desc01 local_desc">
    <p>
        MYSQL DB info.
    </p>
    <p>
        ! MYSQL_DB : <?=MYSQL_DB?>
    </p>
    <p>
        ! MYSQL_USER : <?=G5_MYSQL_USER?>
    </p>
    <p>
        ! MYSQL_PASSWORD : <?=G5_MYSQL_PASSWORD?>
    </p>
</div>

<div class="local_desc01 local_desc">
    <p>
        <a href="<?=G5_URL?>/phpmyadmin" target="_blank"><?php echo G5_URL."/phpmyadmin"; ?></a>
    </p>
</div>

<?php
include_once ('./admin.tail.php');
?>
