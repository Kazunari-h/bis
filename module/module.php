<?php
	//対象日付の設定
	if( isset($_GET["target_time"]) ){
		//GETパラメータの取得
		$targetTime = $_GET["target_time"];
	}else{
		//現在時刻の取得
		$targetTime = time();
	}

	//フォーマッティング
	$targetYear = date( "Y", $targetTime );
	$targetMonth = date( "m", $targetTime );
	$targetDay = date( "d", $targetTime );

	//月初取得
	$beginOfMonthTime = mktime( 0, 0, 0, $targetMonth, 1, $targetYear );

	//月初の曜日取得（0:日 1:月 2:火 3:水 4:木 5:金 6:土）
	$firstDayOfWeek = date( "w", $beginOfMonthTime );

	//月末取得
	$endOfMonthTime = mktime( 0, 0, 0, $targetMonth+1, 0, $targetYear );
	$endOfMonthDay = date( "d", $endOfMonthTime );

	//出力用配列の用意
	$calendar = array();

	//月初空白詰め
	for( $i = 0; $i < $firstDayOfWeek; $i++ ){
		$calendar[] = "";
	}

	//日にちの設定
	for( $i = 1; $i <= $endOfMonthDay; $i++ ){
		$calendar[] = $i;
	}

	//月末空白詰め
	while( count($calendar) % 7 != 0 ){
		$calendar[] = "";
		$i++;
	}

	//翌月と、前月のタイムスタンプ取得
	$nextMonthTime = mktime( 0, 0, 0, $targetMonth+1, 1, $targetYear );
	$prevMonthTime = mktime( 0, 0, 0, $targetMonth-1, 1, $targetYear );

	//現在時刻を取得
	$nowTime = time();
	$nowYear = date( "Y", $nowTime );
	$nowMonth = date( "m", $nowTime );
	$nowDay = date( "d", $nowTime );

	//対象年月が、現在年月と一致しているかチェック
	$tagetDateIsNow = false;
	if( $nowYear == $targetYear && $nowMonth == $targetMonth ){
		$tagetDateIsNow = true;
	}

?>
		<h2>
			<a href="calendar.php?target_time=<?php echo $prevMonthTime; ?>">&lt;</a>
			<?php echo "${targetYear}年${targetMonth}月"; ?>
			<a href="calendar.php?target_time=<?php echo $nextMonthTime; ?>">&gt;</a>
		</h2>
		<table>
			<tr>
				<td>日</td>
				<td>月</td>
				<td>火</td>
				<td>水</td>
				<td>木</td>
				<td>金</td>
				<td>土</td>
			</tr>
<?php
		for( $i = 0; $i < count( $calendar ); $i++ ){
			//行頭出力
			if( $i % 7 == 0 ){
				echo "<tr>";
			}

			//日付データ出力
			echo "<td";
			if( $tagetDateIsNow && $calendar[$i] == $nowDay ){
				//対象日付が今日
				echo " id='today'";
			}
			echo " class='cel'>";
            $m = sprintf("%02d",$targetMonth);
            $d = sprintf("%02d",$calendar[$i]);
            echo "<a href='web_edit.php?edit_data=${targetYear}${m}${d}&target_time=${targetTime} '>";

			echo $calendar[$i];
			echo "</a></td>";

			//行末出力
			if( $i % 7 == 6 ){
				echo "</tr>";
			}
		}
?>
		</table>
