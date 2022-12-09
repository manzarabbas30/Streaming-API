<?php
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://rest.coinapi.io/v1/exchanges');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


$headers = array();
$headers[] = 'X-Coinapi-Key: CD585B5B-B391-4268-AE8F-31C8F822D479';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
$data = json_decode($response);
echo "<pre>";
// echo $response;
// print_r($data);

echo "</pre>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Dynamic Table</title>
        <link rel="stylesheet" href="stylesheet.css">
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    </head>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
        }


        h2 {
            margin-top: 0 !important;
        }

        #crypto-table {
            margin-top: 10%;
        }

        ul {
            margin-top: 50px;
        }

        .active {
            background-color: #ffa726 !important;
        }

        .bold {
            font-weight: 600;
        }
        ul{
            display: flex;
        }
    </style>

    <body class="">
        <main>
            <section id="crypto-section" class="container center-align">
                <header>
                    <h2>CryptoCurrency Table</h2>
                </header>
                <table id="crypto-table" class="highlight centered">
                    <thead>
                        <th>Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Volume 1hrs USD</th>
                    </thead>
                    <tbody id="crypto-table-body">
                        <?php for($i=0;$i<count($data);$i++){?>
                        <tr>
                            <td><a href="<?php echo $data[$i]->website; ?>"><?php echo $data[$i]->name; ?></a></td>
                            <td><?php echo $data[$i]->data_start; ?></td>
                            <td><?php echo $data[$i]->data_end; ?></td>
                            <td>$ <?php echo $data[$i]->volume_1hrs_usd; ?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
                <footer id="pagination">
                    <ul class="pagination">
                        <li class="disabled arrow-left"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                        <li class="active"><a>1</a></li>
                        <li class="waves-effect"><a>2</a></li>
                        <li class="waves-effect"><a>3</a></li>
                        <li class="waves-effect"><a>4</a></li>
                        <li class="waves-effect"><a>5</a></li>
                        <li class="waves-effect"><a>6</a></li>
                        <li class="waves-effect"><a>7</a></li>
                        <li class="waves-effect"><a>8</a></li>
                        <li class="waves-effect"><a>9</a></li>
                        <li class="waves-effect"><a>10</a></li>
                        <li class="waves-effect arrow-right"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
                    </ul>
                </footer>
            </section>
        </main>

        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script src="index.js"></script>
    </body>

    </html>
</body>

</html>