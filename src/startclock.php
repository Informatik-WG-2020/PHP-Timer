<?php	
	if (!isset($_POST['uhrzeit'])) {
		header('Location: clock.html');
	}
	
	session_start();
	
	$_SESSION['uhrzeit'] = $_POST['uhrzeit'];
	//$_SESSION['rainbow'] = $_POST['rainbow'];
	//$_SESSION['blinklow'] = $_POST['blinklow'];
	//$_SESSION['blink'] = $_POST['blink'];
	$_SESSION['mode'] = $_POST['mode'];
	header('Location: clock.php');
?>