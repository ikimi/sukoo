<?php

include_once( 'Item.class.php' );
define( 'API' , 'http://api.douban.com/book/subject/isbn/');

$item = new Item( $_GET['isbn'] );
$item->getInfo();
//$ch = curl_init( API.$isbn );
//curl_setopt( $ch , CURLOPT_RETURNTRANSFER , true );
//curl_setopt( $ch , CURLOPT_BINARYTRANSFER , true );
//$info = curl_exec( $ch );
?>
<!DOCTYPE html> 
	<html> 
		　<head> 
		　　<title>舒克</title>
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<meta charset='utf-8'>
				<link rel="stylesheet" href="http://code.Jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" />
				<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.3.min.js"></script>
				<script type="text/javascript" src="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
		</head> 
		<body>
			<div data-role="page" id="search" data-theme="b">
				<?=API.$_GET['isbn'] ?>
			</div>
		</body>
	</html>
