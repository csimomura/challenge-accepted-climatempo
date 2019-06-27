<?php    
    include("../utils/default.php");
    include("../controller/Class/classCity.php");

    $_utils = new classUtils();
    $_id_city = $_utils->getParameter("id_city");
    $_busca = $_utils->getParameter("search", 2);

    $_city = new classCity();
    if (!$_id_city and !$_busca){
        $_previsoes = $_city->getCity();
    }elseif ($_busca){
        $_previsoes = $_city->findCity($_busca);
    }else{
        $_previsoes = $_city->getWeatherForecast($_id_city);
    }

    header('Content-type: application/json');
    echo json_encode($_previsoes);

?>
