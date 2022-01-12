<?php
include_once('db.php');

$id = $_GET['id'];
////MAKE QUERY
$query = 'DELETE FROM books WHERE id= :id';
$statement = $conn->prepare($query);
if ($statement->execute(['id' => $id])) {
    header("Location: index.php");
}
