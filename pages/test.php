<?php
$root = $_SERVER['DOCUMENT_ROOT'] . "/airquality/";
require_once $root . 'includes/functions.php';
require_once $root . 'includes/global_variables.php';
require_once $root . 'assets/php-wrapper/fusioncharts.php';

$colors = "#0075c2,#1aaf5d, #808080, #800000, #FF00FF, #808000, #800080";
$titel = "Average per day for ";
$month = $_POST['data']['form'][0]['value'];
$stof = $_POST['data']['form'][1]['value'];
$limit = GetLimitValue($stof);

$param2 = new HentAnalyserGnsByMonth;
$param2->month = $month;
$param2->stofId = $stof;

$result2 = $airS->HentAnalyserGnsByMonth($param2);
$analyseArray = $result2->HentAnalyserGnsByMonthResult->Analyse;
$opstillingId = array();
$OpstillingName = array();
$dateArray = array();
foreach ($analyseArray as $value) {                                             // Gets data from array and pushes to seperate arrays
    array_push($opstillingId, $value->Opstilling->Id);
    array_push($OpstillingName, $value->Opstilling->Maalested->Navn);
    $d2 = new DateTime($value->Datomaerke);
    array_push($dateArray, $d2->format("d"));
}



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
$line = array();
$line[0] = array(
            "startvalue" => $limit,
            "color" => "#1aaf5d",
            "displayvalue" => $limit
        );
$trend = array();
$trend[0] = array(
    "line" => $line
);

$unit = $analyseArray[0]->Enhed->Navn;
$stofTitel = $analyseArray[0]->Stof->Navn;

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
        "xAxisName"=> GetMonth($month),
        "yAxisName"=> $unit,
        "showValues"=> "0",
        "anchorRadius"=> "4"
        ),
    "categories" => array(),
    "dataset" => $dataset,
    "trendlines" => $trend
    );
    
foreach ($OpstillingIdAndName as $value) {
    $tempArr = array();
    foreach ($analyseArray as $analyse) {
        if ($analyse->Opstilling->Id == $value->Id) {
            array_push($tempArr, array(
                'value' =>  $analyse->Resultat
            ));
            }
        }

    array_push($arrData['dataset'], array(
        'seriesname' => $value->Navn,
        'data' => $tempArr
    ));
}
$duplicateDates = array_unique($dateArray);
$uniqueDate = array();
foreach ($duplicateDates as $date) {
    array_push($uniqueDate, array(
                'label' => $date
            ));
}
array_push($arrData['categories'], array(
    'category' => $uniqueDate
));

//echo $arrData;

$jsonEncodedData = json_encode($arrData);
echo $jsonEncodedData;
//?>
