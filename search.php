<?php

error_reporting (E_ALL & ~(E_WARNING | E_NOTICE));
include_once('Search.class.php');

?>
<!DOCTYPE html> 
<html> 
	　<head> 
		　　<title>sukoo</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset='utf-8'>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="http://code.Jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.3.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
		<script type="text/javascript">
		$(function() {
			$('#more').submit(function() {
				alert(adsfas);
				//接收json
				$.get("search2.php", {
					book : $("#book").val() ,
					curPage : $("#curPage").val()
				} , function (data) {
					var data = JSON.parser(data);
					alert(data.length);
					//$("#more").prepend(data.title);
				},"json");
			});
		});
		</script>
	</head> 
	<body>
		<div data-role="page" id="search" data-theme="b">
			<div data-role="header" data-theme="b">
				<h1>sukoo</h1>
			</div><!-- /header -->
		<div data-role="conntent" data-theme="b">
			<form name="search" method="post" action="search.php">
				<input name="book" type="text">
				<input name="submit" type="submit" value="search">
			</form>
			<ul data-role="listview" style="margin-top: 0;">
<?php
if( !empty($_POST['book']) )
{
	$keyword = rawurlencode( $_POST['book'] );
	$result = new Search( $keyword );
	$items = $result->search();

foreach($items as $item)
{
	echo "<li>";
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
			<?php $more = '更多'.$result->getMore().'条';?>
<input id="more" name="submit" type="submit" value='<?=$more?>' >
<input type="hidden" id="curPage" value='<?=$result->curPage?>'>
<input type="hidden" id="keyword" value='<?=$keyword?>'>
<?php }?>
		</div>
	</body>
</html>
