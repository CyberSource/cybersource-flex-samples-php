<html lang="en">
    <head>
        <title>Receipt</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

        <style>
            .td-1 {
                word-break: break-all;
                word-wrap: break-word;
            }
        </style>
    </head>
    <?php $arrDump = json_decode($_POST["flexresponse"], true); ?>
    <body>
        <div class="container card">
            <div class="card-body">
                <h1>Receipt</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Key</th>
                            <th scope="col">value</th>
                        </tr>
                        <tr>
                            <th scope="col">token</th>
                            <th scope="col"><?php echo $arrDump['token']; ?></th>
                        </tr>
                        <tr>
                            <th scope="col">Masked PAN</th>
                            <th scope="col"><?php echo $arrDump['maskedPan']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        FLEX TOKEN : 
                        <tr scope="row">
                            <td>Signature validation</td>
                            <td>
                                <?php echo $arrDump['signature']; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a href="/checkout.php" class="btn btn-primary">Repeat checkout process</a>
            </div>
        </div>
    </body>
</html>