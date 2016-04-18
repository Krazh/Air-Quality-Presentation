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
        <script src="js/themes/fusioncharts.theme.fint.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                    $('#loadButton').click(function () {
                        var f = $(this.form);
                        var height = 450;
                        var width = $("#mainContainer").width();
                        info = [];
                        info.push({name: "width", value: width});
                        info.push(f.serializeArray(f));

                        $.ajax({
                            type: "POST",
                            url: "pages/contentloader.php",
                            data: {data: info},
                            success: function (data) {
                                var chart = new FusionCharts({
                                    "type": "msline",
                                    "renderAt": "chartDiv",
                                    "width": width,
                                    "height": height,
                                    "dataFormat": "json",
                                    "dataSource": data
                                });
                                chart.render();
//                                $('#chartDiv').html(data);
                            }
                        });
                    });
                });
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
                <span class="navbar-brand"><a href="/airquality/" style="font-family: 'Montserrat', sans-serif;">Air Quality 2015</a></span>
            </div>
            </div>
        </div>
        
        <?php 
        require_once 'includes/functions.php';
        require_once 'includes/global_variables.php';
        $months = array();
        
        for($i = 1; $i < 13; $i++) {
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
                    if ($value == 1) {
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
                    if ($value->Id == 68) {
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
            <div class="col-xs-6">
                By Søren Carlsen and Morten Pedersen
            </div>
        </div>
    </body>
</html>
