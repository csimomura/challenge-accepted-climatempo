### Funcionalidade

O usuário poderá consultar a previsão do tempo para os próximos dias em Osasco e São Paulo utilizando seu smartphone, basta digitar e selecionar o nome da cidade para realizar a consulta.

### Linguagens utilizadas

- PHP
- jQuery

### Instalação

Basta realizar o download do projeto e salva-lo no diretório raiz de um servidor com o PHP instalado. O nome do diretório deve ser "teste_climatempo".

Caso queira alterar o nome do diretório, acesse o arquivo:
	utils/variables.php
	
E altere a variável 
	_DIR_HOME_	

### API

Na API é possível realizar as seguintes operações: 
- Consultar nome da cidade;
- Consultar previsão para a cidade;

Local API:
	controller/getDataCity.php
	
## Como utilizar a API para Consultar nome da cidade:

| Argumento     | Tipo   | Descrição                           |
| ------------- |:------:| ------------------------------------|
| `search`      | String | Digitar parte do nome da cidade e serão retornadas todas as cidades que contenham o texto digitado      |

Retorno JSON 

| Propriedade   | Tipo   | Descrição                           |
| ------------- |:------:| ------------------------------------|
| `id`          | Number | Id da localidade                    |
| `name`        | String | Nome da localidade                  |
| `state`       | String | Sigla do estado da localidade       |
| `latitude`    | Number | Latitude do centro da localidade    |
| `longitude`   | Number | Longitude do centro da localidade   |


## Como utilizar a API para Consultar previsão para a cidade:

| Argumento     | Tipo   | Descrição                           |
| ------------- |:------:| ------------------------------------|
| `id_city`     | Number | Será retornada a cidade com o ID pesquisado    | 

Retorno JSON
 
| Propriedade                     | Tipo   | Descrição                                  |
| ------------------------------- |:------:| -------------------------------------------|
| `weather.date`                  | String | Data da previsão no formato AAAA-MM-DD     |
| `weather.text`                  | String | Texto sobre a previsão do dia              |
| `weather.temperature.min`       | Number | Temperatura mínima em graus celsius (°C)   |
| `weather.temperature.max`       | Number | Temperatura máxima em graus celsius (°C)   |
| `weather.rain.probability`      | Number | Probabilidade de chuva em porcentagem (%)  |
| `weather.rain.precipitation`    | Number | Precipitação de chuva em milímetros (mm)   |
