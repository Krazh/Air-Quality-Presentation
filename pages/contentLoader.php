<?php
$root = $_SERVER['DOCUMENT_ROOT'] . "/airquality/";
require_once $root . 'includes/functions.php';
require_once $root . 'includes/global_variables.php';
require_once $root . 'assets/php-wrapper/fusioncharts.php';

$colors = "#0075c2,#1aaf5d, #808080, #5DA5DA, #800000, #FF00FF, #4D4D4D, #F17CB0, #B2912F, #B276B2, #DECF3F, #F15854, #9ebcda, #4d004b";

$month = $_POST['data']['form'][0]['value'];
$stof = $_POST['data']['form'][1]['value'];
$result2;
$analyseArray;
$stofTitel;
$titel;


if (isset($_POST['data']['date'])) {
    $day = $_POST['data']['date'];
    
    $p = new GetResultsForDayByCompound;
    $p->day = $day;
    $p->month = $month;
    $p->stofId = $stof;
    
    
    try {
        $result2 = $airS->GetResultsForDayByCompound($p);
        $analyseArray = $result2->GetResultsForDayByCompoundResult->Analyse;
        $stofTitel = $analyseArray[0]->Stof->Navn;
        $titel = "Daily measurements for " . $stofTitel;
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }

}
 else {
    
    $p = new HentAnalyserGnsByMonth;
    $p->month = $month;
    $p->stofId = $stof;

    $result2 = $airS->HentAnalyserGnsByMonth($p);
    $analyseArray = $result2->HentAnalyserGnsByMonthResult->Analyse;
    $stofTitel = $analyseArray[0]->Stof->Navn;
    $titel = "Average per day for " . $stofTitel;
}

$limit = GetLimitValue($stof);

$opstillingId = array();
$OpstillingName = array();
$category = array();
foreach ($analyseArray as $value) {                                             // Gets data from array and pushes to seperate arrays
    array_push($opstillingId, $value->Opstilling->Id);
    array_push($OpstillingName, $value->Opstilling->Maalested->Navn);
    $d2 = new DateTime($value->Datomaerke);
    if (isset($_POST['data']['date'])) {
        array_push($category, $d2->format("H:i"));
    } else {
        array_push($category, $d2->format("d"));
    }
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


$arrData = array(
    "chart" => array(
        "caption"=> $titel,
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
$uniqueCategories = array_unique($category);
$uniqueLabels = array();
foreach ($uniqueCategories as $date) {
    array_push($uniqueLabels, array(
                'label' => $date
            ));
}
array_push($arrData['categories'], array(
    'category' => $uniqueLabels
));

//echo $arrData;

$jsonEncodedData = json_encode($arrData);
echo $jsonEncodedData;
//?>
