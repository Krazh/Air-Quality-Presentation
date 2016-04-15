<!--
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
    <script src="assets/jquery-1.11.3.js" type="text/javascript"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/fusioncharts.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $("#loadButton").click(function() {
                    var f = $(this.form);
                    var height = 450;
                    var width = $("#mainContainer").width();
                    info = [];
                    info.push({name: "width", value: width});
                    info.push(f.serializeArray(f));
                    $("#chart-1").empty()
                    
                    $.ajax({
                        type: "POST",
                        url: "pages/contentLoader.php",
                        data: {data: info},
                        success: function (data) {
                            $('#chartDiv').html(data);
                        }, 
                        error: function (das) {
                            alert(das);
                        }
                    });
                });
            })
        </script>
    <body>
        
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
        require_once 'includes/functions.php';
        require_once 'includes/global_variables.php';
        $months = array();
        
        for($i = 1; $i < 5; $i++) {
            array_push($months, $i);
        }
        
        
        
        
        ?>
        <!-- container -->
        <div class="container" id="mainContainer">
            
            <?php 
                $units = $airS->GetAllEnhed(new GetAllEnhed())->GetAllEnhedResult;
                $chartWidth = 0;
                $chartHeight = 0;
                $enheder = array();
                
                foreach ($units->Enhed as $value) {
                    $enhed = new Enhed();
                    $enhed->Id = $value->Id;
                    $enhed->Navn = $value->Navn;
                    array_push($enheder, $enhed);
                }
                
                $selectedMonth = 0;
                
                $compounds = $airS->GetAllStof(new GetAllStof());
                $stoffer = array();
                echo '<div class="col-xs-12">';
                echo '<form method="POST" id="submitForm" action="">';
                echo '<table>';
                echo '<tr><label>Month:';
                foreach ($months as $value) {
                    echo '<td style="padding: 5px;"><label style="font-weight: normal !important;"><input type="radio" name="month" value="' . $value . '"';
                    if ($selectedMonth == $value) {
                        echo 'checked';
                    }
                    echo '>  ' . getMonth($value) . "</label>";
                    echo '</td>';
                }
                echo '</tr></table><br/></div>';
                echo '<div class="col-xs-12">';
                echo '<table>';
                echo '<tr><label>Compounds:';
                foreach ($compounds->GetAllStofResult->Stof as $value) {
                    echo '<td style="padding: 5px;"><label style="font-weight: normal !important;"><input type="radio" name="stoffer" value="' . $value->Id . '"';
                    if (in_array($value->Id, $stoffer)) {
                        echo 'checked';
                    }
                    echo '>  ' . $value->Navn . "</label>";
                    echo '</td>';
                }
                echo '</tr></table>';
                echo '<input id="loadButton" type="button" name="submit" value="Load data">';
                echo '</table></form></div>';
            
            ?>
            <div class="col-xs-12" id="chartDiv">
                
            </div>
            
        </div>
        
    </body>
</html>
