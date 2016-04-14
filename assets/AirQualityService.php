<?php
class Analyse {
  public $Datomaerke; // dateTime
  public $Enhed; // Enhed
  public $Id; // int
  public $Opstilling; // Opstilling
  public $Resultat; // string
  public $Stof; // Stof
  public $Udstyr; // Udstyr
}

class Enhed {
  public $Id; // int
  public $Navn; // string
}

class Opstilling {
  public $Id; // int
  public $Maalested; // Maalested
  public $Navn; // string
}

class Maalested {
  public $Easting_32; // string
  public $Id; // int
  public $Navn; // string
  public $Northing_32; // string
}

class Stof {
  public $Id; // int
  public $Navn; // string
}

class Udstyr {
  public $Id; // int
  public $Navn; // string
}

class HentAnalyser {
  public $month; // int
  public $maxRows; // int
  public $enhedId; // int
  public $stofId; // int
  public $udstyrId; // int
  public $opstillingId; // int
}

class HentAnalyserResponse {
  public $HentAnalyserResult; // ArrayOfAnalyse
}

class HentAnalyserGnsByMonth {
  public $month; // int
  public $stofId; // int
}

class HentAnalyserGnsByMonthResponse {
  public $HentAnalyserGnsByMonthResult; // ArrayOfAnalyse
}

class char {
}

class duration {
}

class guid {
}


/**
 * AirQualityService class
 * 
 *  
 * 
 * @author    {author}
 * @copyright {copyright}
 * @package   {package}
 */
class AirQualityService extends SoapClient {

  private static $classmap = array(
                                    'Analyse' => 'Analyse',
                                    'Enhed' => 'Enhed',
                                    'Opstilling' => 'Opstilling',
                                    'Maalested' => 'Maalested',
                                    'Stof' => 'Stof',
                                    'Udstyr' => 'Udstyr',
                                    'HentAnalyser' => 'HentAnalyser',
                                    'HentAnalyserResponse' => 'HentAnalyserResponse',
                                    'HentAnalyserGnsByMonth' => 'HentAnalyserGnsByMonth',
                                    'HentAnalyserGnsByMonthResponse' => 'HentAnalyserGnsByMonthResponse',
                                    'char' => 'char',
                                    'duration' => 'duration',
                                    'guid' => 'guid',
                                   );

  public function AirQualityService($wsdl = "http://localhost:21702/AirQualityService.svc?wsdl", $options = array()) {
    foreach(self::$classmap as $key => $value) {
      if(!isset($options['classmap'][$key])) {
        $options['classmap'][$key] = $value;
      }
    }
    parent::__construct($wsdl, $options);
  }

  /**
   *  
   *
   * @param HentAnalyser $parameters
   * @return HentAnalyserResponse
   */
  public function HentAnalyser(HentAnalyser $parameters) {
    return $this->__soapCall('HentAnalyser', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param HentAnalyserGnsByMonth $parameters
   * @return HentAnalyserGnsByMonthResponse
   */
  public function HentAnalyserGnsByMonth(HentAnalyserGnsByMonth $parameters) {
    return $this->__soapCall('HentAnalyserGnsByMonth', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

}

?>
