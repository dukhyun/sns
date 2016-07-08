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

// $_SESSION['id'] = email -> id
function get_user_id($conn, $email) {
	$query = sprintf("SELECT id FROM user WHERE email = '%s'", $email);
	$result = mysqli_query($conn, $query);
	if ($result === false) {
		die ("Database access failed: ".mysqli_error());
	}
	$row = mysqli_fetch_assoc($result);
	return $row['id'];
}

// post(user_id) -> user(email)
function get_user_email($conn, $user_id) {
	$query = sprintf("SELECT email FROM user WHERE id = %d", $user_id);
	$result = mysqli_query($conn, $query);
	if ($result === false) {
		die ("Database access failed: ".mysqli_error());
	}
	$row = mysqli_fetch_assoc($result);
	
	return $row['email'];
}

// post(user_id) -> user(nick)
function get_user_nick($conn, $user_id) {
	$query = sprintf("SELECT nick FROM user WHERE id = %d", $user_id);
	$result = mysqli_query($conn, $query);
	if ($result === false) {
		die ("Database access failed: ".mysqli_error());
	}
	$row = mysqli_fetch_assoc($result);
	
	return $row['nick'];
}

// post(category_id) -> category(name)
function get_category_name($conn, $id) {
	$query = sprintf("SELECT name FROM category WHERE id = %d", $id);
	$result = mysqli_query($conn, $query);
	if ($result === false) {
		die ("Database access failed: ".mysqli_error());
	}
	$row = mysqli_fetch_assoc($result);
	
	return $row['name'];
}

// db -> category list
function get_category_list($conn, $user_id) {
	$query = sprintf("SELECT * FROM category WHERE user_id = %d", $user_id);
	$result = mysqli_query($conn, $query);
	if ($result === false) {
		die ("Database access failed: ".mysqli_error());
	}
	
	return $result;
}


// 타임셋
function time_set($date) {
	if (!$date) {
		return $date;
	}
	$timezone = 'GMT+0';
	$date = strtotime($date.' '.$timezone);
	$date = date('Y-m-d H:i:s', $date);
	return $date;
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
	$stmt = mysqli_prepare($conn, "SELECT pw_hash FROM user WHERE email = ?");
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