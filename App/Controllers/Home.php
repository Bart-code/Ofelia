<?php

namespace App\Controllers;

use \App\Models\Book;
use \Core\View;

class Home extends \Core\Controller
{

    protected function before()
    {
		
    }

    public function indexAction()
    {
		$books = (new Book())->getAllBooks();
        View::renderTemplate('Home/index.html', ['books' =>$books]);
    }
	
	public function saveAction()
    {
		$books = (new Book())->saveBookToDbAsBought($_POST['selectedBookId']);
		
	}
}
