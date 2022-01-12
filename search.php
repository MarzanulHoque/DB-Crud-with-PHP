<?php

$searchBy = '';
if (isset($_REQUEST)) {
    $searchBy = $_REQUEST['searcValue'];
    echo $searchBy;
}
$books = array();
if (file_exists('books.json')) {
    $json = file_get_contents('books.json');
    $books = json_decode($json, true);
}

$newBooks = array();
foreach ($books as $key => $value) {
    if ($value['title'] == $searchBy) {
        array_push($newBooks, $value);
    }
}

var_dump($newBooks);
