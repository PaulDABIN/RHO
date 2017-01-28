<?php
	if (!empty($_SESSION['flash'])) {
		$flashType = $_SESSION['flash'][0];
		$flash = $_SESSION['flash'][1];
		unset($_SESSION['flash']);
	}
 ?>