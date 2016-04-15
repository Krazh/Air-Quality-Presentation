<?php



$arrData = array(
    "chart" => array(
        "caption"=> $titel . $stofTitel,
        "captionFontSize"=> "14",
        "paletteColors"=> $colors,
        "bgcolor"=> "#ffffff",
        "showBorder"=> "0",
        "showShadow"=> "0",
        "showCanvasBorder"=> "0",
        "usePlotGradientColor"=> "0",
        "legendBorderAlpha"=> "30",
        "legendShadow"=> "0",
        "showAxisLines"=> "0",
        "showAlternateHGridColor"=> "0",
        "divlineThickness"=> "1",
        "divLineIsDashed"=> "1",
        "divLineDashLen"=> "1",
        "divLineGapLen"=> "1",
        "xAxisName"=> $month,
        "showValues"=> "0"
        ),
    "categories" => array(),
    "dataset" => $dataset
    );
    
foreach ($OpstillingIdAndName as $value) {
    $tempArr = array();
    foreach ($result2->HentAnalyserGnsByMonthResult->Analyse as $analyse) {
        if ($analyse->Opstilling->Id == $value->Id) {
            array_push($tempArr, array(
                'value' => (float) $analyse->Resultat
            ));
            }
        }

    array_push($arrData['dataset'], array(
        'seriesname' => $value->Navn,
        'data' => $tempArr
    ));
}

$uniqueDate = array();
foreach ($duplicateDates as $date) {
    array_push($uniqueDate, array(
                'label' => $date
            ));
}
array_push($arrData['categories'], array(
    'category' => $uniqueDate
));

$jsonEncodedData = json_encode($arrData);
$columnChart = new FusionCharts("msline", "myFirstChart" , 1060, 400, "chart-1", "json",$jsonEncodedData);
$columnChart->render();

?>

<div id="chart-1" class="col-xs-12">
    
</div>