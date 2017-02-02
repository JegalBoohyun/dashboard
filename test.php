<?php
	//DB 연결
	$conn = new mysqli('192.168.1.30', 'root', 'Password1!', 'water_lv');
	if($conn->connect_errno){
		die("Failed to Connect to Mysql: (" . $conn->connect_errno . ") " . $conn->connect_error);
	}
	header('Content-Type: application/json');
	//쿼리 작성
	$query ="select tb.time, tb.num, tb.dist from (select time, num, dist from water_lv.level_hst order by num desc LIMIT 100) as tb order by tb.num";
	$result = $conn->query($query);
	
	$json =array();
	
	// 쿼리 테스팅
	if(!$result){
		$message = 'Invalid query: ' . $conn->error . "n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	
	while ( $row = $result->fetch_assoc() ) {
		$json[] = $row;
	}
	
	// 연결 종료
	mysqli_close($link);
	echo json_encode($json);
?>

