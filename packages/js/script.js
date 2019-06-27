var _return = "";
var _cidade_selecionada = "";

$(document).ready(function(){    
   createSelectCity();
});

$(window).resize(function(){    
    ajustHeightDivPrevisao();
});

function formatRepo (obj) {
    if (!obj.name){
        return "Digite o nome de uma cidade...";
    }

    _cidade_selecionada = obj.name + "/" + obj.state;
    return _cidade_selecionada;
}

function ajustHeightDivPrevisao(){
    var $_objDivPrevisao = $("div.divTextoPrevisao");

    var heights = $_objDivPrevisao.map(function ()
    {
        return $(this).height();
    }).get();

    maxHeight = Math.max.apply(null, heights);
    $_objDivPrevisao.height(0); 
    $_objDivPrevisao.height(maxHeight); 
}

function requestAjax(_type, _url, _data){
    $.ajax({
        type: _type,            
        url: $("#txt_dir_home").val() + _url,
        async: false,
        data: _data,
        success: function(content) {
            _return = content;            
        }
    })
    return _return;
}

function createSelectCity(){
    var $_objSelect = $("#selectCidades");
    $_objSelect.append($("<option></option>")); 

    $_objSelect.select2({
      ajax: {
        url: $("#txt_dir_home").val() + "/controller/getDataCity.php",
        dataType: 'json',
        data: function (params) {
          return {
            search: params.term, // search term
            page: params.page
          };
        },
        processResults: function (data, params) {
          // parse the results into the format expected by Select2
          // since we are using custom formatting functions we do not need to
          // alter the remote JSON data, except to indicate that infinite
          // scrolling can be used
          params.page = params.page || 1;
          var obj = jQuery.parseJSON( data );
          return {
            results: obj
          };
        },
        cache: true
      },
      language: "pt-BR",
      width: '100%',
      minimumInputLength: 1,
      placeholder: 'Digite o nome de uma cidade...',
      escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
      templateResult: formatRepo,
      templateSelection: formatRepo
    });

    $_objSelect.on("select2:select", function (e) { 
        _return = requestAjax("POST", "/controller/getDataCity.php", {id_city: this.value});

        $('#divPrevisoes').html("");
        var temp = $.trim($('#template_previsao').html());
        $.each(_return.weather, function (key, item) {
            var x = temp.replace(/{{date}}/ig, $.format.date(item.date + " 00:00:00.000", "dd/MM/yyyy"));
            x = x.replace(/{{text}}/ig, item.text);
            x = x.replace(/{{temperature.max}}/ig, item.temperature.max);
            x = x.replace(/{{temperature.min}}/ig, item.temperature.min);
            x = x.replace(/{{rain.precipitation}}/ig, item.rain.precipitation);
            x = x.replace(/{{rain.probability}}/ig, item.rain.probability);

            $('#divPrevisoes').append(x);
        });
        $("#divDescricaoCidade").html("Previs&#227;o para " + _cidade_selecionada);
        ajustHeightDivPrevisao();
    });
   
}



