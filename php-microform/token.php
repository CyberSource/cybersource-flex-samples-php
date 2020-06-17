<html lang="en">
    <head>
        <title>Token</title>
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
                 <form action="receipt.php" id="my-token-form" method="post">
                    <h1>Token</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Key</th>
                                <th scope="col">value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr scope="row">
                                <td>Transient Token</td>
                                <td>
                                <?php echo $arrDump; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="button" id="pay-button" class="btn btn-primary">Make a Payment with Transient Token</button>
                    <input type="hidden" id="flexresponse" name="flexresponse">
                </form>
            </div>
        </div>
        <script>
            var payButton = document.querySelector('#pay-button');
            var flexResponse = document.querySelector('#flexresponse');
            var form = document.querySelector('#my-token-form');

            payButton.addEventListener('click', function() {  
                  
                  var token = '<?php echo $arrDump; ?>' ;
                  console.log(JSON.stringify(token));
                  flexResponse.value = JSON.stringify(token);
                  form.submit();
            });
        </script>

    </body>
</html>