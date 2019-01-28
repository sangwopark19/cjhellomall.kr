<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
?>

<style>
	.wrap {border: 1px solid #ddd;background-color: #f5f5f5;padding: 30px 50px;text-align: center;margin-top: 35px;}
	.wrap .wrap-box {width: 100%;max-width: 320px;overflow: hidden;margin: 0 auto;}
	.form-group {text-align: left;margin-bottom: 10px;overflow: hidden;font-size: 14px;}
	.form-group:last-child {margin-bottom: 0;}
	.text-word {height: 30px;border: 1px solid #ddd;width: 100%;}
	
	.search-bt {width: 100px;height: 40px;line-height: 1px;text-align: center;color: #fff;background-color: #333;font-size: 14px;padding: 20px 30px;display: block;margin: 0 auto;margin-top: 20px;}
	.search-bt:hover {color: #fff;}
	
	@media only all and (max-width:991px){
		.shop-box {padding-top: 20px;}
	}
</style>

<!------------------------------------------------------------------------------------------------->
<style>
	.title {font-size: 28px;font-weight: bold;padding-bottom: 30px;border-bottom: 1px solid #ddd;margin-bottom: 20px;}
	.col-md-3.at-side {padding: 0;width: 20.8%;}

	.at-row { background-color: #f5f5f5;}
	.at-main {width: 79.2%;padding-left: 50px;background-color: #fff;padding-top: 40px;min-height: 600px;}
	
</style>
<div class="title">
	<img src="/image/title-icon.jpg" alt=""/> <?php echo $page_title;?>
</div>
<form name="fhsearch" method="POST" role="form" class="form">
	<div class="wrap">   
		   <div class="wrap-box">
				<div class="form-group">
					<div class="col-sm-4">이름</div>
					<div class="col-sm-8">
						<input type="text" class="text-word" name="wr_subject" id="wr_subject">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">전화번호</div>
					<div class="col-sm-8">
						<input type="text" class="text-word" name="wr_3" id="wr_3">
						<div>예) 010-1234-1234</div>
					</div>
				</div>
			</div>
	</div>	
	<div class="form-group">
		<span class="pull-btn">
			<input type="button" class="btn search-bt" value="검색" onclick="search_btn();">
		</span>
	</div>
</form>	   

<script>
    function search_btn() {
        var f = document.fhsearch;

        var chk_input01 = document.getElementById('wr_subject');   
        var wr_subject = null;
        if(chk_input01.value == ''){ 
            alert('이름을 작성해 주세요.');
            return false;
        }

        var chk_input02 = document.getElementById('wr_3');
        var wr_3 = null;
        if(chk_input02.value == ''){ 
            alert('휴대폰 번호를 작성해 주세요.');
            return false;
        }

        f.action = "/search.php";
        f.submit();
    }
</script>