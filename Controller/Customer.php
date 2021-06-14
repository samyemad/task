<?php
namespace Controller;

use Model\CustomerModel;
use Core\Controller;
use Enums\Countries ;

class Customer extends Controller
{
    public function getHello()
    {
        echo "Hello, World!";
    }

    //http://localhost/Task/index.php/customer/all/
    public function getAll()
    {
        $countryKey=(isset($_GET["countries"]) && $_GET["countries"] != '') ? $_GET["countries"] : null;
        $valid=(isset($_GET["valid"]) && $_GET["valid"] != '') ? $_GET["valid"] : null;
        $casesArray=$this->getCountriesAndReqexCases($countryKey);
        $countryReqex=$this->checkValidNumbersRequest($countryKey, $casesArray, $valid);
        $result = $this->model->get($countryKey, $countryReqex, $casesArray['sub'], $casesArray['main']);
        $this->loadView('home', array('content'=>$result,'countryKey' => $countryKey,'valid' => $valid));
    }

    private function checkValidNumbersRequest($countryKey, $casesArray, $valid)
    {
        $countryReqex=null;
        if ($valid != null) {
            if (isset($casesArray['sub']['value'][$countryKey])) {
                $countryReqex['key'] = $casesArray['sub']['value'][$countryKey];

            }
            $countryReqex['valid'] = $valid;
        }
        return $countryReqex;
    }

    private function getCountriesAndReqexCases($countryKey = null)
    {
        $class = new \ReflectionClass(Countries::class);
        $constants = array_flip($class->getConstants());
        $subCountriesArray=[];
        if ($countryKey == null) {
            foreach ($constants as $key => $value) {
                $regexValue = $value . "REGEX";
                $subCountriesArray[$key] = constant("Enums\CountriesRegex::$regexValue");
            }
            $mainCasesCountries=$constants;

        } else {
            $regexValue=$constants[$countryKey]. "REGEX";
            $subCountriesArray[$countryKey]=constant("Enums\CountriesRegex::$regexValue");
            $mainCasesCountries[$countryKey]=$constants[$countryKey];
        }
        $subCaseArray['field']='phone';
        $subCaseArray['value']=$subCountriesArray;
        $subCaseArray['match']='ok';
        $subCaseArray['result']='state';

        $mainCaseArray['field']='phone';
        $mainCaseArray['value']=$mainCasesCountries;
        $mainCaseArray['result']='country';

        $casesArray['main']=$mainCaseArray;
        $casesArray['sub']=$subCaseArray;
        return $casesArray;
    }
}
