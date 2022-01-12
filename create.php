<?php
include_once('config.php');
include_once('db.php');

if (isset($_POST['submit'])) {
    ////////GET VALUES FROM INPUT FIELD
    $title = $_POST['title'];
    $author = $_POST['author'];
    $available = $_POST['available'] === "true";
    $pages = $_POST['pages'];
    $isbn = $_POST['isbn'];

    ////MAKE QUERY
    $query = <<<SQL
    INSERT INTO books (title, author,available, pages, isbn)
    VALUES (:title, :author, :available , :pages, :isbn)
    SQL;

    ////PREPARE QUERY
    $statement = $conn->prepare($query);
    $params = [
        'title' => $title,
        'author' => $author,
        'available' => $available,
        'pages' => $pages,
        'isbn' => $pages
    ];

    ///EXECUTE QUERY
    if ($statement->execute($params)) {
        header("Location: index.php");
    }
    echo $conn->lastInsertId();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Create Book</title>
    <link rel="stylesheet" href="styles/create.css">
</head>

<body>
    <h1 class="title">Upload Book</h1>
    <form action="" method="post" class="upload_book_form">
        <div class="input-group mb-3">
            <input type="text" class="form-control form-control-lg" placeholder="Title" name="title">
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control form-control-lg" placeholder="Author" name="author">
        </div>
        <div class="input-group mb-3">
            <input type="number" class="form-control form-control-lg" placeholder="Pages" name="pages">
        </div>
        <div class="input-group mb-3">
            <input type="number" class="form-control form-control-lg" placeholder="Isbn" name="isbn">
        </div>
        <div style="display: flex;">
            <p class="available">Available</p>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="available" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                    YES
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="available" id="flexRadioDefault2" checked>
                <label class="form-check-label" for="flexRadioDefault2">
                    NO
                </label>
            </div>
        </div>
        <input type="submit" value="submit" name="submit" class="submit_book">
    </form>
</body>

</html>

<?php
// include_once('config.php');
// include_once('db.php');
// $books = array();
// if (file_exists('books.json')) {
//     $json = file_get_contents('books.json');
//     $books = json_decode($json, true);
// }

// if (isset($_POST['submit'])) {
//     $ele = end($books);
//     $id =  $ele['id'];
//     $id++;
//     $data = array(
//         'id' => $id,
//         'title' => htmlspecialchars($_POST['title']),
//         'author' => $_POST['author'],
//         'available' => $_POST['available'] === "true",
//         'pages' => $_POST['pages'],
//         'isbn' => $_POST['isbn']
//     );
//     $title = $_POST['title'];
//     $author = $_POST['author'];
//     $available = $_POST['available'] === "true";
//     $pages = $_POST['pages'];
//     $isbn = $_POST['isbn'];
//     $query = <<<SQL
//     INSERT INTO books (title, author,available, pages, isbn)
//     VALUES (:title, :author, :available , :pages, :isbn)
//     SQL;
//     $statement = $conn->prepare($query);
//     $params = [
//         'title' => $title,
//         'author' => $author,
//         'available' => $available,
//         'pages' => $pages,
//         'isbn' => $pages
//     ];
//     $statement->execute($params);
//     echo $conn->lastInsertId();
//     if ($data['title'] == '' || $data['title'] == '' || $data['pages'] == '' || $data['isbn'] == '') {
//         echo '<script>alert("All Field is Required.")</script>';
//     } else {
//         array_push($books, $data);
//         $books = json_encode($books);
//         file_put_contents('books.json', $books);
//         header("Location: index.php");
//     }
// }

?>