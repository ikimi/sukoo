<?php

error_reporting(E_ALL & ~ (E_WARNING | E_NOTICE));
include_once( 'Search.class.php' );

	$keyword = $_GET['book'];
	$curPage = $_GET['curPage'];
	$result = new Search( $keyword , $curPage );
	$items = $result->search();
	foreach($items as $item)
	{
		foreach($item as $value)
			iconv('gb2312','utf-8',$value);
	}
	echo json_encode($items);
?>
