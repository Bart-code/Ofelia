<?php

namespace App\Models;

use PDO;
use \Core\View;

class Book extends \Core\Model
{
	public $id, $author, $title, $cover, $isBought;

    public function __construct()
    {
      
    }
	
	public function getAllBooks()
	{
		$sql="SELECT * FROM books_table"; 
		
		$db = static::getDB();
		$stmt = $db->prepare($sql);
		
		$books = array();
		
		$stmt->execute();
		if($stmt->rowCount())
		{
			$rowsCount=$stmt->rowCount();
			for( $i=0 ; $i < $rowsCount ; $i++ )
			{
				$row =  $stmt->fetch(PDO::FETCH_ASSOC);
				$book = new Book();
				$book->id = $row['id'];
				$book->author = $row['author'];
				$book->title = $row['title'];
				$book->cover = $row['cover'];
				$book->isBought = $row['isBought'];
				
				array_push($books, $book);
			}
		}
		
		return $books;
	}
	
	public function saveBookToDbAsBought($bookId)
	{
			$sql="UPDATE `books_table` SET `isBought` = '1' WHERE `books_table`.`id` = :bookId"; 
			
			$db = static::getDB();
			$stmt = $db->prepare($sql);
			$stmt->bindValue(':bookId', $bookId, PDO::PARAM_STR);

			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			return true;
	}
}
