<?php
class Item
{
	private $title;
	private $isbn;
	private $author;
	private $pirce;
	private $publisher;
	private $pubdate;

	function __construct( $isbn )
	{
		$this->isbn = $isbn;
	}

	public function getInfo()
	{	
		$ch = curl_init( API.$this->isbn );
		curl_setopt( $ch , CURLOPT_RETURNTRANSFER , true );
		curl_setopt( $ch , CURLOPT_BINARYTRANSFER , true );
		$info = curl_exec( $ch );
		
		$fh = fopen( 'book.xml' , 'w' );
		fwrite( $fh , $info );
		fclose( $fh );
	}

	public function show()
	{
		$item = array();
		$item['title'] = $this->getTitle();
		$item['author'] = $this->getAuthor();
		$item['publisher'] = $this->getPublisher();
		$item['price'] = $this->getPrice();
		$item['pubdate'] = $this->getPubdate();
	}

	private function getTitle()
	{
		return $this->title;
	}

	private function getAuthor()
	{
		return $this->author;
	}

	private function getPublisher()
	{
		return $this->publisher;
	}

	private function getPrice()
	{
		return $this->price;
	}

	private function getPubdate()
	{
		return $this->pubdate;
	}
}
?>
