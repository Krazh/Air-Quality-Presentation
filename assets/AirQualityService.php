<?php
class Analyse {
  public $Datomaerke; // dateTime
  public $Enhed; // Enhed
  public $Id; // int
  public $Opstilling; // Opstilling
  public $Resultat; // double
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

class GetResultsForDayByCompound {
  public $day; // int
  public $month; // int
  public $stofId; // int
}

class GetResultsForDayByCompoundResponse {
  public $GetResultsForDayByCompoundResult; // ArrayOfAnalyse
}

class GetAllStof {
}

class GetAllStofResponse {
  public $GetAllStofResult; // ArrayOfStof
}

class GetAllUdstyr {
}

class GetAllUdstyrResponse {
  public $GetAllUdstyrResult; // ArrayOfUdstyr
}

class GetAllEnhed {
}

class GetAllEnhedResponse {
  public $GetAllEnhedResult; // ArrayOfEnhed
}

class GetAllOpstilling {
}

class GetAllOpstillingResponse {
  public $GetAllOpstillingResult; // ArrayOfOpstilling
}

class GetAllMaalested {
}

class GetAllMaalestedResponse {
  public $GetAllMaalestedResult; // ArrayOfMaalested
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
                                    'GetResultsForDayByCompound' => 'GetResultsForDayByCompound',
                                    'GetResultsForDayByCompoundResponse' => 'GetResultsForDayByCompoundResponse',
                                    'GetAllStof' => 'GetAllStof',
                                    'GetAllStofResponse' => 'GetAllStofResponse',
                                    'GetAllUdstyr' => 'GetAllUdstyr',
                                    'GetAllUdstyrResponse' => 'GetAllUdstyrResponse',
                                    'GetAllEnhed' => 'GetAllEnhed',
                                    'GetAllEnhedResponse' => 'GetAllEnhedResponse',
                                    'GetAllOpstilling' => 'GetAllOpstilling',
                                    'GetAllOpstillingResponse' => 'GetAllOpstillingResponse',
                                    'GetAllMaalested' => 'GetAllMaalested',
                                    'GetAllMaalestedResponse' => 'GetAllMaalestedResponse',
                                    'char' => 'char',
                                    'duration' => 'duration',
                                    'guid' => 'guid',
                                   );

  public function AirQualityService($wsdl = "http://192.168.1.41:8080/AirQualityService.svc?wsdl", $options = array()) {
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

  /**
   *  
   *
   * @param GetResultsForDayByCompound $parameters
   * @return GetResultsForDayByCompoundResponse
   */
  public function GetResultsForDayByCompound(GetResultsForDayByCompound $parameters) {
    return $this->__soapCall('GetResultsForDayByCompound', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param GetAllStof $parameters
   * @return GetAllStofResponse
   */
  public function GetAllStof(GetAllStof $parameters) {
    return $this->__soapCall('GetAllStof', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param GetAllUdstyr $parameters
   * @return GetAllUdstyrResponse
   */
  public function GetAllUdstyr(GetAllUdstyr $parameters) {
    return $this->__soapCall('GetAllUdstyr', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param GetAllEnhed $parameters
   * @return GetAllEnhedResponse
   */
  public function GetAllEnhed(GetAllEnhed $parameters) {
    return $this->__soapCall('GetAllEnhed', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param GetAllOpstilling $parameters
   * @return GetAllOpstillingResponse
   */
  public function GetAllOpstilling(GetAllOpstilling $parameters) {
    return $this->__soapCall('GetAllOpstilling', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param GetAllMaalested $parameters
   * @return GetAllMaalestedResponse
   */
  public function GetAllMaalested(GetAllMaalested $parameters) {
    return $this->__soapCall('GetAllMaalested', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

}

?>
