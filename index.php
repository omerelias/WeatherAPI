<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <title>Build an API</title>
</head>

<body>

    <!-- SECTION LOGO -->
    
    <div class="col omer ">
     <div class="d-flex justify-content-center">
    <img src="logo.png" alt="">
    </div>

     <!-- SECTION HEADER -->

    <div class="container md-form form-lg" style="font-size:2rem">
    <input type="text" class="col-5" name="name" id="name" placeholder="Enter city name">
    <div class="btn btn-info col-3" id="getfromapi" style="font-size:1.5rem">Send Data</div>
    <div class="btn btn-warning col-3" id="getfromdb" style="font-size:1.5rem">Get from DB</div>
    </div>


    <!-- SECTION DATA FROM API -->

    <div id="apioutput">
    <div class="container text-center border border-primary mt-3 p-3" id="details">
    <h1 class="text-primary" id="apicityname"></h1>
    <div class="btn btn-success" id="savetodb">Save Forecast</div> 
    </div>
    <table class="table table-hover table-bordered mt-4">
                <thead class="thead">
                    <tr class="text-primary">
                        <th scope="col">Datetime</th>
                        <th scope="col">Min temp</th>
                        <th scope="col">Max temp</th>
                        <th scope="col">Wind</th>
                    </tr>
                </thead>
                <tbody id="resultsfromapi"></tbody>
            </table>
    </div>

    <!-- SECTION DATA FROM DB -->

    <div id="dboutput">
    <table class="table table-hover table-bordered mt-4">
                <thead class="thead">
                    <tr class="text-primary">
                        <th scope="col">Datetime</th>
                        <th scope="col">Min temp</th>
                        <th scope="col">Max temp</th>
                        <th scope="col">Wind</th>
                    </tr>
                </thead>
                <tbody id="resultsfromdb"></tbody>
            </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="functions.js"></script>
</body>
</html>