<?php
namespace Model;

use Core\Model;

class CustomerModel extends Model
{
    public function __contruct()
    {
        parent::__contruct();
    }

    public function getAll($subCases = null, $mainCases=null)
    {
        return $this->read('customer', array('id,name,phone'), null, $subCases, $mainCases);
    }

    public function get($countryKey = null, $countryReqex = null, $subCases = null, $mainCases=null)
    {
        $countriesConditions=$this->getConditionsCountries($countryKey, $countryReqex, $subCases['value']);
        return $this->read('customer', array('*'), $countriesConditions, $subCases, $mainCases);
    }
    private function getConditionsCountries($countryKey, $countryRegex, $allSubCasesValue)
    {
        $conditonsArray=[];
        if ($countryKey != null) {
            $conditonsArray[] = ['element' => 'phone', 'value' => "(" . $countryKey . ")", 'operator' => 'LIKE', 'argument' => '%','union' => 'AND'];
        }
        if ($countryRegex != null) {
            $operatorRegex = ($countryRegex['valid'] == 1) ? 'REGEXP' : 'NOT REGEXP';
            if (isset($countryRegex['key'])) {
                $conditonsArray[] = ['element' => 'phone', 'value' => $countryRegex['key'], 'operator' => $operatorRegex, 'argument' => '','union' => 'AND'];
            } else {
                $union=($countryRegex['valid'] == 0) ? 'AND' : 'OR';
                foreach ($allSubCasesValue as $allSubCaseValue) {
                    $conditonsArray[] = ['element' => 'phone', 'value' => $allSubCaseValue, 'operator' => $operatorRegex, 'argument' => '','union' => $union];
                }
            }
        }
        return $conditonsArray;
    }
}
