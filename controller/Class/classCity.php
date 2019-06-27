<?php
    
    class ClassCity 
    {
        protected $_local_json_city =  _DIR_ABSOLUTE_HOME_ . "/json/city.json";
        protected $_local_option_city =  _DIR_ABSOLUTE_HOME_ . "/view/city/option.html";

        protected $_local_json_weather_forecast = _DIR_ABSOLUTE_HOME_ . "/json/weather_forecast.json";

        protected $_utils;

        public function __construct() {
            $this->_utils = new ClassUtils();
        }

         /**Método para retorno das cidades
         * @author Cristiano Simomura
         * @return json
         */        
        public function getCity(){
            $_json = $this->_utils->getFileJson($this->_local_json_city);    
            return $_json;            
        }

         /**Método para pesquisar cidades
         * @author Cristiano Simomura
         * @param $_name string - parte do nome da cidade
         * @return json
         */        
        public function findCity($_name){
            $_array_result = array();
            $_json = $this->getCity();   
            foreach ($_json as $_itens) {
                if(stripos($_itens["name"],$_name)!==false){
                    $_array_result[] = array("id" => $_itens["id"], "name" => $_itens["name"], "state" => $_itens["state"], "latitude" => $_itens["latitude"], "longitude" => $_itens["longitude"]);
                }        
            }        
            return json_encode($_array_result);
        }

         /**Método para consulta da previsao da cidade
         * @author Cristiano Simomura
         * @param $_id_city integer - id da cidade
         * @return json previsoes
         */        
        public function getWeatherForecast($_id_city){
            $_itens_return = "";
            if (is_numeric($_id_city)){
                $_json = $this->_utils->getFileJson($this->_local_json_weather_forecast);
                foreach ($_json as $_itens){
                    if ( $_itens["locale"]["id"] == $_id_city) {
                       $_itens_return = $_itens;
                       break;
                    }
                }
            }
            return $_itens_return;
        }        

    }
?>
