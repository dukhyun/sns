<?php
function get_connection() {
	$hostname = 'kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com';
	$username = 'sns';
	$password = 'sns';
	$dbname = 'sns';
	
	$db_server = mysqli_connect($hostname, $username, $password, $dbname);
	mysqli_query($db_server, "SET NAMES 'utf8'");
	if (!$db_server) {
		die('Mysql connection failed: '.mysqli_connect_error());
	}
	
	return $db_server;
}

// 쿠키 생성
function start_session() {
	$secure = false;
	$httponly = true;
	
	if (ini_set('session.use_only_cookies', 1) === false) {
		header("Location: error.php?error_code=2");
		exit();
	}
	
    $params = session_get_cookie_params();
    session_set_cookie_params($params["lifetime"],
        $params["path"], 
        $params["domain"], 
        $secure, $httponly);
 
    session_start();
    session_regenerate_id(true);
}

// 쿠키 삭제
function destroy_session() {
	$_SESSION = array();
	$params = session_get_cookie_params();
	
	setcookie(session_name(), '', 0, 
		$params['path'], $params['domain'], $params['secure'], isset($params['httponly'])); 
	session_destroy();
}

function try_to_login($id, $password) {
	if (check_user_account($id, $password)) {
		$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
		$_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
		$_SESSION['id'] = $id;
		$_SESSION['password'] = $password;
		$_SESSION['login_status'] = true;
		return true;
	} else {
		return false;
	}
}

function try_to_logout() {
	if (check_login()) {
		$_SESSION['login_status'] = false;
	} else {
	}
}

function check_login() {
	return isset($_SESSION['ip'], $_SESSION['user_agent'], $_SESSION['login_status']) && 
		$_SESSION['ip'] == $_SERVER['REMOTE_ADDR'] && 
		$_SESSION['user_agent'] == $_SERVER['HTTP_USER_AGENT'] &&
		$_SESSION['login_status'];
}

function check_user_account($id, $password) {
	$conn = get_connection();
	// statement : 명제
	$stmt = mysqli_prepare($conn, "SELECT pw_hash FROM user WHERE id = ?");
	mysqli_stmt_bind_param($stmt, "s", $id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	if (mysqli_num_rows($result) === 0) {
		header('Location: error.php?error_code=1');
	} else {
		$row = mysqli_fetch_assoc($result);
		$hash = $row["pw_hash"];
		return password_verify($password, $hash);
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}
?>