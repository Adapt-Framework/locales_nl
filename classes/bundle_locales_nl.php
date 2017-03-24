<?php

namespace adapt\locales\nl{
    
    /* Prevent Direct Access */
    defined('ADAPT_STARTED') or die;
    
    class bundle_locales_nl extends \adapt\bundle{
        
        public function __construct($data){
            parent::__construct('locales_nl', $data);
        }
        
        public function boot(){
            if (parent::boot()){
                
                /* Add the validators */
                $this->sanitize->add_validator('nl_phone', "^(\+31|0)[0-9]{8,8}$");
                $this->sanitize->add_validator('nl_phone_mobile', "^(\+31|0)6[123458][0-9]{6,6}$");
                $this->sanitize->add_validator('nl_postcode', "^[0-9]{4,4}[A-Z]{2,2}$");
                
                /* Add formatters */
                $this->sanitize->add_format('nl_phone', function($value){
                    return substr($value, 0, 3) . ' ' . substr($value, 3, 3) . ' ' . substr($value, 6, 3);
                    
                }, "function(value){
                    return value.substr(0,3) + ' ' + value.substr(3,3) + ' ' + value.substr(6,3);
                }");
                
                $this->sanitize->add_format('nl_postcode',
                    function($value){
                        return substr($value, 0, 4) . " " . strtoupper(substr($value, 4, 2));
                    }, "function(value){
                        value = value.toUpperCase();
                        return value.substr(0, 4) + ' ' + value.substr(4, 2);
                    }"
                );
                
                $this->sanitize->add_format('nl_date',
                    function($value){
                        if ($value === null  || $value == '') return null;
                        return \adapt\date::convert_date('Y-m-d', 'd-m-Y', $value);
                    },
                    "function(value){
                        return adapt.date.convert_date('Y-m-d', 'd-m-Y', value);
                    }"
                );
                
                $this->sanitize->add_format('nl_time',
                    function($value){
                        if ($value === null  || $value == '') return null;
                        return \adapt\date::convert_date('H:i:s', 'H:i', $value);
                    },
                    "function(value){
                        return adapt.date.convert_date('H:i:s', 'H:i', value);
                    }"
                );
                
                $this->sanitize->add_format('nl_datetime',
                    function($value){
                        if ($value === null  || $value == '') return null;
                        return \adapt\date::convert_date('Y-m-d H:i:s', 'd-m-Y H:i', $value);
                    },
                    "function(value){
                        return adapt.date.convert_date('Y-m-d H:i:s', 'd-m-Y H:i', value);
                    }"
                );
                
                
                /* Add unformatters */
                $this->sanitize->add_unformat('nl_postcode',
                    function($value){
                        return strtoupper(preg_replace("/[^A-Za-z0-9]/", "", $value));
                    }, "function(value){
                        value = value.replace(/[^A-Za-z0-9]/, '');
                        return value.toUpperCase();
                    }"
                );
                
                $this->sanitize->add_unformat('nl_date',
                    function($value){
                        if ($value === null  || $value == '') return null;
                        $value = preg_replace("/[^0-9]/", '', $value);
                        return \adapt\date::convert_date('dmY', 'Y-m-d', $value);
                    },
                    "function(value){
                        value = value.replace(/[^0-9]/g, '');
                        return adapt.date.convert_date('dmY', 'Y-m-d', value);
                    }"
                );
                
                $this->sanitize->add_unformat('nl_time',
                    function($value){
                        if ($value === null  || $value == '') return null;
                        $value = preg_replace("/[^0-9]/", '', $value);
                        return \adapt\date::convert_date('Hi', 'H:i:s', $value);
                    },
                    "function(value){
                        value = value.replace(/[^0-9]/g, '');
                        return adapt.date.convert_date('Hi', 'H:i:s', value);
                    }"
                );
                
                $this->sanitize->add_unformat('nl_datetime',
                    function($value){
                        if ($value === null  || $value == '') return null;
                        $value = preg_replace("/[^0-9]/", '', $value);
                        return \adapt\date::convert_date('dmYHi', 'Y-m-d H:i:s', $value);
                    },
                    "function(value){
                        value = value.replace(/[^0-9]/g, '');
                        return adapt.date.convert_date('dmYHi', 'Y-m-d H:i:s', value);
                    }"
                );

                
                return true;
            }
            
            return false;
        }
        
    }
    
    
}

?>