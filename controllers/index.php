<?php


$books = [
	[
		'name' => 'The Great Gatsby',
		'author' => 'F. Scott Fitzgerald',
		'year' => 1925
	],
	[
		'name' => 'To Kill a Mockingbird',
		'author' => 'Harper Lee',
		'year' => 1960
	],
	[
		'name' => '1984',
		'author' => 'George Orwell',
		'year' => 1949
	],
	[
		'name' => 'Pride and Prejudice',
		'author' => 'Jane Austen',
		'year' => 1813
	],
	[
		'name' => 'The Catcher in the Rye',
		'author' => 'J.D. Salinger',
		'year' => 1951

	]
];

$filteredBooks = array_filter($books, function ($book) {
	return $book['year'] >= 1900 && $book['year'] < 2000;
});

$heading = 'My Home Page';


include 'views/index.view.php';
