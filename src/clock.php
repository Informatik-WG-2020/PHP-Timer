<?php session_start(); ?>
<html>
	<head>
		<meta charset="UTF-8">
		<?php			
			if (!isset($_SESSION['uhrzeit'])) {
				echo('<script>document.location.href = "index.html"</script>');
			}
			
			$day = date("d", time());
			$month = date("m", time());
			$year = date("Y", time());
			
			$end = date_create("$year-$month-$day ".$_SESSION['uhrzeit']);
			$now = new DateTime("@".time());
			
			
			$waittime = $end->diff($now);
			$output = $waittime->format("%H:%I:%S");
			
			if ($end > $now) {
				echo('<title>DER COUNTDOWN LÄUFT!</title>
				<script type="text/javascript">
					window.setTimeout("parent.window.location.reload(true);", 1000);
				</script>');
			}
			else {
				echo('<title>COUNTDOWN ABGELAUFEN!</title>');
			}
			
			$rainbow = $_SESSION['mode'] == 'rainbow';
			$blinklow = $_SESSION['mode'] == 'blinklow';
			$blink = $_SESSION['mode'] == 'blink';
			$truerainbow = $_SESSION['mode'] == 'truerainbow';
			
			function random_color_part() {
				return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
			}

			function random_color() {
				return random_color_part() . random_color_part() . random_color_part();
			}
		?>
		
		<style type="text/css">
			h1 {
				font-size: 300;
				position: fixed; 
				top: 30%; 
				left: 6%;
			}
			
			* {
				
				<?php 
				if ($rainbow) {
					echo ('background-color: #' . random_color() . ';');
					echo ('color: #' . random_color() . ';');
				}
				elseif ($truerainbow) {
					$totalseconds = (($waittime->s) + ($waittime->i * 60) + ($waittime->h * 60 * 60)) % 7;
					switch ($totalseconds) {
						case 6: //rot
							echo ('background-color: #ff0000;');
							echo ('color: #ff7f00;');
							break;
							
						case 5: //orange
							echo ('background-color: #ff7f00;');
							echo ('color: #dfff00;');
							break;
							
						case 4: //gelb
							echo ('background-color: #dfff00;');
							echo ('color: #1fff00;');
							break;
							
						case 3: //grün
							echo ('background-color: #1fff00;');
							echo ('color: #007fff;');
							break;
							
						case 2: //hellblau
							echo ('background-color: #007fff;');
							echo ('color: #001fff;');
							break;
							
						case 1: //dunkelblau
							echo ('background-color: #001fff;');
							echo ('color: #7f00ff;');
							break;
							
						case 0: //violett
							echo ('background-color: #7f00ff;');
							echo ('color: #ff0000;');
							break;
					}
				}
				else {							
					$i = $waittime->i;
					if ($waittime->h != 0 or $i >= 10) {
						echo('background-color: #000;');
						echo('color: #fff;');
					}
					elseif ($i >= 4) {
						echo('background-color: #000;');
						echo('color: #c00;');
					}
					elseif ($i == 3) {
						echo('background-color: #000;');
						echo('color: #d00;');
					}
					elseif ($i == 2) {
						echo('background-color: #000;');
						echo('color: #e00;');
					}
					else {
						if ($blink) {
							if ($waittime->s % 2 == 0) {
								echo('background-color: #fff;');
							}
							else {
								echo('background-color: #000;');
							}
							echo('color: #f00;');
						}
						else
						{
							echo('background-color: #000;');
							if ($blinklow and $i == 0 and $waittime->s % 2 == 0) {
								echo('color: #fff;');
							}
							else {
								echo('color: #f00;');
							}
						}
					}
				}
				?>
			}
		</style>
	</head>
	<body>
		<?php	
			if ($end > $now) {
				echo("<h1>".$output."</h1>");
			}
			else {
				echo('<image width=100% src="https://t4.ftcdn.net/jpg/00/11/29/69/240_F_11296951_NBmuplMJ4ZZv9UxggkFCqua7IycBInHV.jpg"></image>');
			}
		?>
	</body>
</html>