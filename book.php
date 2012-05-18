<?php

include_once( 'Item.class.php' );
define( 'API' , 'http://api.douban.com/book/subject/isbn/');

$item = new Item( $_GET['isbn'] );
$item->getInfo();
$info = $item->show();
?>
<!DOCTYPE html> 
	<html> 
		　<head> 
		　　<title>舒克</title>
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<meta charset='utf-8'>
				<link rel="stylesheet" href="style.css">
				<link rel="stylesheet" href="http://code.Jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" />
				<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.3.min.js"></script>
				<script type="text/javascript" src="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
		</head> 
		<body>
			<div data-role="page"  data-theme="b">
			<h3><?=$info['title']?></h3>
			<div id="above">
				<div id="pic">
				<img src="<?=$info['img']?>">
				</div>
				<div id="info">
<?php
if( !empty( $info['author'] ) )
	echo "<span>作者:{$info['author']}</span><br>";
if( !empty( $info['translator'] ) )
	echo "<span>译者:{$info['translator']}</span><br>";
if( !empty( $info['publisher'] ) )
	echo "<span>出版社:{$info['publisher']}</span><br>";
if( !empty( $info['pubdate'] ) )
	echo "<span>出版年:{$info['pubdate']}</span><br>";
if( !empty( $info['pages'] ) )
	echo "<span>页数:{$info['pages']}</span><br>";
if( !empty( $info['price'] ) )
	echo "<span>定价:{$info['price']}</span><br>";
if( !empty( $info['binding'] ) )
	echo "<span>装帧:{$info['binding']}</span><br>";
if( !empty( $info['isbn'] ) )
	echo "<span>ISBN:{$info['isbn']}</span><br>";
?>
				</div>
			</div>
			<div id="below">
<?php
	echo "内容简介 ......<br>";
		echo $info['summary'];
?>
			</div>
			</div>
		</body>
	</html>
