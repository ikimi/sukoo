<?php
class Item
{
	private $img;
	private $title;
	private $isbn;
	private $author;
	private $pirce;
	private $publisher;
	private $pubdate;
	private $binding;
	private $translator;
	private $pages;
	private $summary;
	private $apikey = '0954fe4c5321aaea1bfefae4f96500be';
	
	function __construct( $isbn )
	{
		$this->isbn = $isbn;
	}

	public function getInfo()
	{	
		$ch = curl_init( API.$this->isbn."?apikey=$this->apikey" );
		curl_setopt( $ch , CURLOPT_RETURNTRANSFER , true );
		curl_setopt( $ch , CURLOPT_BINARYTRANSFER , true );
		$info = curl_exec( $ch );
		
		$fh = fopen( 'book.xml' , 'w' );
		fwrite( $fh , $info );
		fclose( $fh );

		$book = simplexml_load_string( $info );

		foreach( $book->link as $link )
		{
			if( $link['rel'] == 'image' )
				$this->img .= $link['href'];
		}

		$this->summary = $book->summary;
		$db = $book->children( 'db' , TRUE );
		foreach( $db->attribute as $value )
		{
			if( $value->attributes() == 'isbn13' )
				$this->isbn13 .= $value;
			if( $value->attributes() == 'title' )
				$this->title .= $value;
			if( $value->attributes() == 'author' )
				$this->author .= $value.'/';
			if( $value->attributes() == 'translator' )
				$this->translator .= $value.'/';
			if( $value->attributes() == 'pages' )
				$this->pages .= $value;
			if( $value->attributes() == 'price' )
				$this->price .= $value;
			if( $value->attributes() == 'publisher' )
				$this->publisher .= $value;
			if( $value->attributes() == 'binding' )
				$this->binding .= $value;
			if( $value->attributes() == 'pubdate')
				$this->pubdate .= $value;
		}
	}

	public function show()
	{
		$item = array();
		$item['img'] = $this->getImg();
		$item['isbn'] = $this->getIsbn();
		$item['title'] = $this->getTitle();
		$item['author'] = $this->getAuthor();
		$item['publisher'] = $this->getPublisher();
		$item['price'] = $this->getPrice();
		$item['pubdate'] = $this->getPubdate();
		$item['translator'] = $this->getTranslator();
		$item['binding'] = $this->getBinding();
		$item['pages'] = $this->getPages();
		$item['summary'] = $this->getSummary();
		return $item;
	}

	private function getImg()
	{
		return $this->img;	
	}

	private function getIsbn()
	{
		return $this->isbn13;
	}

	private function getTitle()
	{
		return $this->title;
	}

	private function getPages()
	{
		return $this->pages;
	}

	private function getAuthor()
	{
		return $this->author;
	}

	private function getTranslator()
	{
		return $this->translator;
	}

	private function getPublisher()
	{
		return $this->publisher;
	}

	private function getBinding()
	{
		return $this->binding;
	}

	private function getPrice()
	{
		return $this->price;
	}

	private function getPubdate()
	{
		return $this->pubdate;
	}

	private function getSummary()
	{
		return $this->summary;
	}
}
?>
