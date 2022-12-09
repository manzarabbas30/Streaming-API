<?php
$ch = curl_init();
$key='b726472f4ac79d09104ac7212bb11d5a';
curl_setopt($ch, CURLOPT_URL, 'http://api.coinlayer.com/api/live?access_key='.$key);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

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
                        <th>Coin</th>
                        <th>Value</th>

                    </thead>
                    <tbody id="crypto-table-body">
                        <?php //for($i=0;$i<count(rates);$i++){?>
                        <?php foreach($data->rates as $key => $value){?>
                        <tr>
                            <td><?php echo $key; ?></td>
                            <td><?php echo $value; ?></td>

                        </tr>
                        <?php }?>
                    </tbody>
                </table>

            </section>
        </main>

        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script src="index.js"></script>
    </body>

    </html>
</body>

</html>