<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 wset[배열키] 형태로 등록
// 모바일 설정값은 동일 배열키에 배열변수만 wmset으로 지정 → wmset[배열키]

// 초기값
if(!$wset['thumb_w']) $wset['thumb_w'] = 400;
if(!$wset['thumb_h']) $wset['thumb_h'] = 225;

?>

<div class="tbl_head01 tbl_wrap">
	<table>
	<caption>위젯설정</caption>
	<colgroup>
		<col class="grid_2">
		<col>
	</colgroup>
	<thead>
	<tr>
		<th scope="col">구분</th>
		<th scope="col">설정</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td align="center">스타일</td>
		<td>
			<select name="wset[effect]">
				<option value=""<?php echo get_selected('', $wset['effect']); ?>>슬라이더</option>
				<option value="fade"<?php echo get_selected('fade', $wset['effect']); ?>>페이드</option>
				<option value="vertical"<?php echo get_selected('vertical', $wset['effect']); ?>>버티컬</option>
			</select>
			&nbsp;
			<label><input type="checkbox" name="wset[nav]" value="1"<?php echo get_checked('1', $wset['nav']);?>> 네비 출력</label>
			&nbsp;
			<label><input type="checkbox" name="wset[rdm]" value="1"<?php echo get_checked('1', $wset['rdm']);?>> 랜덤 출력</label>
		</td>
	</tr>
	<tr>
		<td align="center">스피드</td>
		<td>
			<?php echo help('밀리초(ms)는 천분의 1초입니다. ex) 5초 = 5000ms');?>
			<input type="text" name="wset[speed]" value="<?php echo $wset['speed']; ?>" class="frm_input" size="4"> ms 슬라이더(기본값 7000)
			&nbsp;
			<input type="text" name="wset[ani]" value="<?php echo $wset['ani']; ?>" class="frm_input" size="4"> ms 애니메이션(기본값 600)
		</td>
	</tr>
	<tr>
		<td align="center">그림자</td>
		<td>
			<select name="wset[shadow]">
				<?php echo apms_shadow_options($wset['shadow']);?>
			</select>
			&nbsp;
			<label><input type="checkbox" name="wset[in]" value="1"<?php echo get_checked('1', $wset['in']); ?>> 내부 그림자</label>
		</td>
	</tr>
	<tr>
		<td align="center">썸네일</td>
		<td>
			<input type="text" required name="wset[thumb_w]" value="<?php echo $wset['thumb_w']; ?>" class="frm_input" size="4">
			x
			<input type="text" name="wset[thumb_h]" value="<?php echo $wset['thumb_h']; ?>" class="frm_input" size="4">
			px 
			&nbsp;
			<label><input type="checkbox" name="wset[thumb_no]" value="1"<?php echo get_checked('1', $wset['thumb_no']);?>> 원본출력</label>
		</td>
	</tr>
	<tr>
		<td align="center">캡션설정</td>
		<td>
			<select name="wset[caption]">
				<option value=""<?php echo get_selected('', $wset['caption']); ?>>출력안함</option>
				<option value="small"<?php echo get_selected('small', $wset['caption']); ?>>스몰캡션</option>
				<option value="large"<?php echo get_selected('large', $wset['caption']); ?>>라지캡션</option>
			</select>
			&nbsp;
			<select name="wset[bg]">
				<?php echo apms_color_options($wset['bg']);?>
			</select>
			캡션 배경색
			&nbsp;
			<label><input type="checkbox" name="wset[trans]" value="1"<?php echo get_checked('1', $wset['trnas']);?>> 반투명 배경</label>
		</td>
	</tr>
	<tr>
		<td align="center">제목설정</td>
		<td>
			<input type="text" name="wset[scut]" value="<?php echo ($wset['scut']);?>" size="3" class="frm_input"> 자
			&nbsp;
			<label><input type="checkbox" name="wset[link]" value="1"<?php echo get_checked('1', $wset['link']);?>> 관련링크#1 적용(새창)</label>
		</td>
	</tr>
	<tr>
		<td align="center">추출글수</td>
		<td>
			<input type="text" name="wset[rows]" value="<?php echo $wset['rows']; ?>" class="frm_input" size="3"> 개 - PC
			&nbsp;
			<input type="text" name="wmset[rows]" value="<?php echo $wmset['rows']; ?>" class="frm_input" size="3"> 개 - 모바일
			&nbsp;
			<input type="text" name="wset[page]" value="<?php echo $wset['page'];?>" size="3" class="frm_input"> 페이지 자료
		</td>
	</tr>
	<tr>
		<td align="center">추출유형</td>
		<td>
			<select name="wset[main]">
				<option value=""<?php echo get_selected('', $wset['main']); ?>>모든글</option>
				<option value="1"<?php echo get_selected('1', $wset['main']); ?>>메인글</option>
			</select>
			추출
			&nbsp;
			<label><input type="checkbox" name="wset[image]" value="1"<?php echo get_checked('1', $wset['image']); ?>> 이미지글만 추출</label>
		</td>
	</tr>
	<tr>
		<td align="center">추출보드</td>
		<td>
			<?php echo help('보드아이디를 콤마(,)로 구분해서 복수 등록 가능, 미입력시 전체 게시판 적용');?>
			<input type="text" name="wset[bo_list]" value="<?php echo $wset['bo_list']; ?>" size="60" class="frm_input">
			&nbsp;
		</td>
	</tr>
	<tr>
		<td align="center">추출그룹</td>
		<td>
			<?php echo help('그룹아이디를 콤마(,)로 구분해서 복수 등록 가능, 설정시 추출보드는 적용안됨');?>
			<input type="text" name="wset[gr_list]" value="<?php echo $wset['gr_list']; ?>" size="60" class="frm_input">
		</td>
	</tr>
	<tr>
		<td align="center">추출분류</td>
		<td>
			<?php echo help('분류를 콤마(,)로 구분해서 복수 등록 가능, 단일보드 추출시에만 적용됨');?>
			<input type="text" name="wset[ca_list]" value="<?php echo $wset['ca_list']; ?>" size="60" class="frm_input">
		</td>
	</tr>
	<tr>
		<td align="center">제외설정</td>
		<td>
			<label><input type="checkbox" name="wset[except]" value="1"<?php echo get_checked('1', $wset['except']); ?>> 지정한 보드/그룹 제외</label>
			&nbsp;
			<label><input type="checkbox" name="wset[ex_ca]" value="1"<?php echo get_checked('1', $wset['ex_ca']); ?>> 지정한 분류제외</label>
		</td>
	</tr>
	<tr>
		<td align="center">새글설정</td>
		<td>
			<input type="text" name="wset[newtime]" value="<?php echo ($wset['newtime']);?>" size="4" class="frm_input"> 시간 이내 등록 글
			&nbsp;
			색상
			<select name="wset[new]">
				<?php echo apms_color_options($wset['new']);?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center">정렬설정</td>
		<td>
			<select name="wset[sort]">
				<?php echo apms_rank_options($wset['sort']);?>
			</select>
			&nbsp;
			랭크표시
			<select name="wset[rank]">
				<option value=""<?php echo get_selected('', $wset['rank']); ?>>표시안함</option>
				<?php echo apms_color_options($wset['rank']);?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center">기간설정</td>
		<td>
			<select name="wset[term]">
				<?php echo apms_term_options($wset['term']);?>
			</select>
			&nbsp;
			<input type="text" name="wset[dayterm]" value="<?php echo $wset['dayterm'];?>" size="4" class="frm_input"> 일전까지 자료(일자지정 설정시 적용)
		</td>
	</tr>
	<tr>
		<td align="center">회원지정</td>
		<td>
			<?php echo help('회원아이디를 콤마(,)로 구분해서 복수 등록 가능');?>
			<input type="text" name="wset[mb_list]" value="<?php echo $wset['mb_list']; ?>" size="46" class="frm_input">
			&nbsp;
			<label><input type="checkbox" name="wset[ex_mb]" value="1"<?php echo get_checked('1', $wset['ex_mb']); ?>> 제외하기</label>
		</td>
	</tr>
	<tr>
		<td align="center">캐시사용</td>
		<td>
			<input type="text" name="wset[cache]" value="<?php echo $wset['cache']; ?>" class="frm_input" size="4"> 초 간격으로 캐싱
		</td>
	</tr>
	</tbody>
	</table>
</div>