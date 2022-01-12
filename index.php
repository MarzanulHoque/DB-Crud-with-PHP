<?php
include_once('config.php');
include_once('db.php');
$books = array();
if (file_exists('books.json')) {
    $json = file_get_contents('books.json');
    $books = json_decode($json, true);
}
////MAKE QUERY
$query = <<<SQL
    SELECT * FROM  books
    SQL;
$statement = $conn->prepare($query);
$statement->execute();
$rows = $statement->fetchAll();
$books = $rows;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CURD OPERATION USING FILE SYSTEM</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/index.css">
</head>

<body>
    <h1 style="text-align: center;">File Based CURD Application</h1>
    <div class="index_search_div">
        <a href="/CURD/create.php" class="create_btn">Create</a>
        <?php
        if (isset($_POST['submit'])) {
            $searchBy = $_POST['search'];
            $query = "SELECT * FROM  books WHERE title = :value";
            $statement = $conn->prepare($query);
            $statement->bindParam(':value', $searchBy);
            $statement->execute();
            $rows = $statement->fetchAll();
            $books = $rows;
        }

        // $newBooks = array();
        // if (isset($_POST['submit'])) {

        //     if (strlen($searchBy) > 0) {
        //         foreach ($books as $key => $value) {
        //             if ($value['title'] == $searchBy) {
        //                 array_push($newBooks, $value);
        //             }
        //         }
        //         $books = $newBooks;
        //     }
        // }
        ?>
        <form method="post" class="index_search_div_inner">
            <input class="search_box" id="search_input" name="search" type="search" placeholder="Seach.......">
            <input class="create_btn" type="submit" value="submit" name="submit">
        </form>
        <!-- <button onclick="search()">CLICK</button> -->
        <!-- <div class="index_search_div_inner">      
        </div> -->
    </div>

    <table class="table  table-hover" style="width: 80%;margin:1rem auto;  background-color: rgb(241, 241, 241);">
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Available</th>
            <th>Pages</th>
            <th>Isbn</th>
            <th>Action</th>
        </tr>
        <?php foreach ($books as $key => $value) :  ?>
            <tr>
                <td><?php echo $value['title'] ?></td>
                <td><?php echo $value['author'] ?></td>
                <td><?php if ($value['available']) {
                        echo "YES";
                    } else {
                        echo "NO";
                    }  ?></td>
                <td><?php echo $value['pages'] ?></td>
                <td><?php echo $value['isbn'] ?></td>
                <td>
                    <a type='button' class='btn btn-danger' href="<?php echo $BASE_URL . '/CURD' . '/delete.php?id=' . $value['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>