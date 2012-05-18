<?php

include_once('Search.class.php');

if(empty($_POST['book']))
{
		$book = "C";
		// 获取豆瓣图书首页信息
		echo "empty";
		return ;
}
$keyword = rawurlencode($_POST['book']);
$result = new Search( $keyword );
$items = $result->search();
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
		<script type="text/javascript" >
		function  isEmpty()
		{
			value=docment.search.book;
			if(first==null || first=='')
				return false;
		}
		</script>
	</head> 
	<body>
		<div data-role="page" id="search" data-theme="b">
			<div data-role="header" data-theme="b">
				<h1>舒克</h1>
			</div><!-- /header -->
		<div data-role="conntent" data-theme="b">
			<form name="search" method="post" action="search.php">
				<input name="book" type="text">
				<input name="submit" type="submit" value="search">
			</form>
			<ul data-role="listview" style="margin-top: 0;">
<?php
foreach($items as $item)
{
	echo "<li>";
//	<img src="http://img.freebase.com/api/trans/image_thumb/en/henry_viii_of_england?pad=1&errorid=%2Ffreebase%2Fno_image_png&maxheight=64&mode=fillcropmid&maxwidth=64" />
	echo "<h3><a href='book.php?isbn={$item['isbn']}'>{$item['title']}</a></h3>";
	if(isset($item['translator']))
		echo "<p>{$item['author']}/{$item['translator']}";
	else
		echo "<p>{$item['author']}";
	echo '/'.$item['publisher'].'/'.$item['pubdate'].'/'.$item['price'].'</p>';
	echo "</li>";
}
?>
			</ul>
		</div>
	</body>
</html>
