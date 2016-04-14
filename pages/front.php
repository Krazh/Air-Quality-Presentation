<?php

$colors = "#0075c2,#1aaf5d, #808080, #800000, #FF00FF, #808000, #800080";
$titel = "Average per day for ";

$airS = new AirQualityService();
$param2 = new HentAnalyserGnsByMonth;
$param2->month = 1;
$param2->stofId = 147;

$result2 = $airS->HentAnalyserGnsByMonth($param2);
$opstillingId = array();
$OpstillingName = array();
$d = array();
foreach ($result2->HentAnalyserGnsByMonthResult->Analyse as $value) {
    array_push($opstillingId, $value->Opstilling->Id);
    array_push($OpstillingName, $value->Opstilling->Maalested->Navn);
    $d2 = new DateTime($value->Datomaerke);
    array_push($d, $d2->format("d"));
}

$duplicateDates = array_unique($d);

$OpstillingIdAndName = array();


$unikOpstillingId = array_unique($opstillingId);
$unikOpstillingNavn = array_unique($OpstillingName);

for ($i = 0; $i < count($unikOpstillingId); $i++) {

    if (!empty($unikOpstillingId[$i])) {
        $ops = new Opstilling();
        $ops->Id = $unikOpstillingId[$i];
        $ops->Navn = $unikOpstillingNavn[$i];
        array_push($OpstillingIdAndName, $ops);
    }
}

$dataset = array();




$month = "January";
$unit = $result2->HentAnalyserGnsByMonthResult->Analyse[0]->Enhed->Navn;
$stof = $result2->HentAnalyserGnsByMonthResult->Analyse[0]->Stof->Navn;

$arrData = array(
    "chart" => array(
        "caption"=> $titel . $stof,
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