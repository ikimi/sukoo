<?php

include_once( 'Item.class.php' );

class Search
{
	private $keyword;
	private $total;
	private $curPage;
	private $pageField;
	private $path = "http://api.douban.com/book/subjects";
	private $apikey = '0954fe4c5321aaea1bfefae4f96500be';
	private $result;
	private $items;
	
	function __construct( $keyword , $curPage = 1 )
	{
		$this->keyword = $keyword;
		$this->total = 0;
		$this->curPage = $curPage;
		$this->pageField = 10;
		$this->items = array();
	}

	function search()
	{
		$this->get();
		$this->parser();
		return $this->items;
	}

	public  function getMore()
	{
		return 	$this->total - ( ($this->curPage - 1) * $this->pageField );
	}

	private function get( )
	{
		$start = ( $this->curPage-1 ) * $this->pageField + 1;
		$ch = curl_init( "{$this->path}?q={$this->keyword}&start-index=$start&max-results={$this->pageField}&apikey={$this->apikey}" );
		curl_setopt( $ch , CURLOPT_RETURNTRANSFER , true );
		curl_setopt( $ch , CURLOPT_BINARYTRANSFER , true );
		$this->result = curl_exec( $ch );
	}

	private function parser( )
	{
		$fh = fopen( 'out.xml' , 'w' );
		fwrite( $fh,$this->result );
		fclose( $fh );

		$results = simplexml_load_string( $this->result );

		$atom = $results->children( 'http://www.w3.org/2005/Atom' );
		$opensearch = $results->children( 'opensearch' , TRUE );

		$this->total = $opensearch->totalResults;
		$this->curPage = $this->curPage + 1;

		$entries = $atom->entry;
		foreach( $entries as $entry )
		{
			$db = $entry->children( 'db' , TRUE );
			$info = array();
			foreach( $db->attribute as $value )
			{
				if( $value->attributes() == 'isbn10' )
					$info['isbn'] .= $value;
				if( $value->attributes() == 'translator' )
					$info['translator'] .= $value;
				if( $value->attributes() == 'price' )
					$info['price'] .= $value;
				if( $value->attributes() == 'publisher' )
					$info['publisher'] .= $value;
				if( $value->attributes() == 'pubdate' )
					$info['pubdate'] .= $value;
			}
			$info['title'] .= $entry->title;
			$info['author'] .= $entry->author->name;
			$this->items[] = $info;
		}
	}
}
?>
