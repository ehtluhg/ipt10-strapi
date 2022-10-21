<?php
require 'vendor/autoload.php';

// Initialize Guzzle HTTP Client integration with Dummy JSON
use GuzzleHttp\Client;

function getBooks()
{
    $token = 'aeb96f8624b7e97835bd26546b7c3134e9322b0526e42ee21ef33a907f920a0ee1d321604345d3fa2113f31c372a18e9d34a3fdff56ec6d8ff06d6620391cbcaeb92b71014e786ca5742af94aa49556eb6e147d571a10fa53de6d6a1703d86871f4afc827cdb1431d85f57c5f2234e1e10d0fa17d9179c5f81259dff5ee74d65';
    $client = new Client([
        'base_uri' => 'http://localhost:1337/api/',
    ]);

    $headers = [
        'Authorization' => 'Bearer ' . $token,
        'Accept'        => 'application/json',
    ];

    $response = $client->request('GET', 'books?pagination[pageSize]=66', [
        'headers' => $headers
    ]);

    $body = $response->getBody();
    $all_books = json_decode($body);
    return $all_books;
}

$books = getBooks();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IPT10 - Strapi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <div class="m-3 p-2">
        <div class="card mb-4 shadow">
            <div class="card-header">
                Book List
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Book Name</th>
                            <th>Book Author</th>
                            <th>Category</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($books->data as $bookData) {
                        $book = $bookData->attributes; ?>
                        <tbody>
                            <tr>
                                <th scope="row"><?php echo $bookData->id ?></th>
                                <th><?php echo $book->name ?></th>
                                <th><?php echo $book->author ?></th>
                                <th><?php echo $book->category ?></th>
                            </tr>
                        </tbody>

                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>