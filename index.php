!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title>Air Quality Control</title>
        <link href="mycss/style.css" rel="stylesheet" type="text/css"/>
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href='https://fonts.googleapis.com/css?family=Lato|Oswald|Indie+Flower|Playfair+Display|Shadows+Into+Light' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <script src="assets/pChart2.1.4/examples/imageMap/imagemap.js" type="text/javascript"></script>
        <script src="assets/jquery-1.11.3.js" type="text/javascript"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/fusioncharts.js" type="text/javascript"></script>
        <div class="menu topBar navbar navbar-default" >
            <!-- container -->
            <div class="container">
                <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <span class="navbar-brand"><a href="/" style="font-family: 'Montserrat', sans-serif;">Air Quality 2015</a></span>
            </div>

            <div class="navbar-collapse collapse pull-right">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="?page=dummy1">Dummy Link 1</a>
                    </li>
                    <li>
                        <a href="?page=dummy2">Dummy Link 2</a>
                    </li>
                    <li>
                        <a href="?page=dummy3">Dummy Link 3</a>
                    </li>
                    <li class="visible-xs">
                        <a href="?page=dummy4">Dummy Link On Small Screen</a>
                    </li>

                </ul>
            </div>
            </div>
        </div>
        
        <?php 
        
        require_once 'assets/AirQualityService.php';

        ?>
        <!-- container -->
        <div class="container">
            <?php include 'assets/php-wrapper/fusioncharts.php'; ?>
            <?php include 'pages/front.php'; ?>
        </div>
        
    </body>
</html>
