<?php

    include("utils/default.php");
    include("controller/Class/classCity.php");

    $_utils = new classUtils();
    $_index = $_utils->getFile("view/index.html");

    $_content = $_utils->getFile("view/home/content_home.html");

	$_ARRAY_CONTEUDO_HOME_ = array("{{DIR_HOME}}");
    $_replaces = array(_DIR_HOME_);
    $_content = @preg_replace($_ARRAY_CONTEUDO_HOME_, $_replaces, $_content);

	$_ARRAY_CONTEUDO_HOME_ = array("{{DIR_HOME}}", "{{CONTENT}}");
    $_replaces = array(_DIR_HOME_, $_content);
    $_index = @preg_replace($_ARRAY_CONTEUDO_HOME_, $_replaces, $_index);
    
    echo $_index;
?>
