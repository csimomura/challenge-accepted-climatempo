<?php
    
    class ClassUtils 
    {

         /**Método para retorno de um arquivo json
         * @author Cristiano Simomura
         * @param $_file string - local completo e nome do arquivo json.
         * @return objeto json
         */        
        public function getFileJson($_file){
            $json = $this->getFile($_file);
            $json = json_decode($json, true);
            return $json;
        }
        

         /**Método para retorno de um arquivo
         * @author Cristiano Simomura
         * @param $_file string - local completo e nome do arquivo json.
         * @return o conteúdo do arquivo
         */        
        public function getFile($_file){
            if (!file_exists($_file)){
                echo _MSG_ERROR_;
                exit(0);
            }
            $_content = file_get_contents($_file);
            return $_content;            
        }


         /**Método para capturar dados enviados via formulario
         * @author Cristiano Simomura
         * @param $_var string - nome da variavel
         * @_type $_type int - 1: Post 2: Get
         * @return o texto da variavel
         */     
	    public function getParameter($_var, $_type = 1){		
		    if ($_type == 1){
			    $_text = isset($_POST[$_var]) ? $_POST[$_var] : "";
		    }elseif ($_type == 2){
			    $_text = isset($_GET[$_var]) ? $_GET[$_var] : "";
		    }
		    $_text = $this->anti_sql_injection($_text);

		    $_text = $this->verifyEncoding($_text);
		    return $_text;
	    }


         /**Método para verificar a codificação do texto
         * @author Cristiano Simomura
         * @param $_text string - texto
         * @return o texto
         */     
	    public function verifyEncoding($_text){
		    if (is_array($_text)){
			    return $_text;
		    }
		    if (preg_match('!!u', $_text)){
			    $_texto = utf8_decode($_text);
            }
		    return $_text;
	    }


         /**Método para verificar e eliminar possíveis tentativas de ataques via transmissão de dados de formulários/requisições
         * @author Cristiano Simomura
         * @param $_text string - texto
         * @return o texto tratado
         */
	    public function anti_sql_injection($_text) {
		    if (!is_numeric($_text)) {
			    $_text = str_replace("'","`",$_text);			
			    $_text = get_magic_quotes_gpc() ? stripslashes($_text) : $_text;						

			    $_text = $this->verifyEncoding($_text);
		    }
		
		    return $_text;
	    }

    }

?>
