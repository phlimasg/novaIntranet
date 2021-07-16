var tipo, fabricante, modelo, ano;
    $('#tipo').change(function() {            
        tipo = $("#tipo").val();            
        if(tipo != ''){                
            $.getJSON("http://fipeapi.appspot.com/api/1/"+ tipo +"/marcas.json", function(data) {
                $('#ano').empty();
                $('#fabricante').empty();
                $('#modelo').empty();
                $('#fabricante').append("<option value=''></option>");
                $.each(data, function(index, element) {
                    $('#fabricante').append("<option value='"+ element.id +"'>" + element.fipe_name + "</option>");
                });
            });
        }
        else{
            $('#ano').empty();
            $('#fabricante').empty();
            $('#modelo').empty();
        }
    });

    $('#fabricante').change(function() {            
        fabricante = $("#fabricante").val();            
        if(fabricante != ''){                
            $.getJSON("http://fipeapi.appspot.com/api/1/"+ tipo +"/veiculos/"+fabricante+".json", function(data) {
                $('#ano').empty();                    
                $('#modelo').empty();
                $('#modelo').append("<option value=''></option>");
                $.each(data, function(index, element) {
                    $('#modelo').append("<option value='"+ element.id +"'>" + element.fipe_name + "</option>");
                });
            });
        }
        else{
            $('#ano').empty();                
            $('#modelo').empty();
        }
    });

    $('#modelo').change(function() {            
        modelo = $("#modelo").val();            
        if(modelo != ''){                
            $.getJSON("http://fipeapi.appspot.com/api/1/"+ tipo +"/veiculo/"+fabricante+"/"+modelo+".json", function(data) {
                $('#ano').empty();      
                $('#ano').append("<option value=''></option>");
                
                $.each(data, function(index, element) {
                    $('#ano').append("<option value='"+ element.id +"'>" + element.id.slice(0,4) + "</option>");
                });
            });
        }
        else{
            $('#ano').empty();  
        }
    });

    $('#ano').change(function() {            
        ano = $("#ano").val();            
        if(ano != ''){                
            $.getJSON("http://fipeapi.appspot.com/api/1/"+ tipo +"/veiculo/"+fabricante+"/"+modelo+"/"+ano+".json", function(data) {
                        
                $('#ano').empty();
                $('#fabricante').empty();
                $('#modelo').empty();                     
                console.log(data);
                //$.each(data, function(index, element) {
                    $('#fabricante').append("<option selected value='"+ data.marca +"'>" + data.marca + "</option>");
                    $('#modelo').append("<option selected value='"+ data.veiculo +"'>" + data.veiculo + "</option>");
                    $('#ano').append("<option selected value='"+ data.ano_modelo +"'>" + data.ano_modelo + "</option>");
                //});
            });
        }
        else{
            $('#ano').empty();  
        }
    });

    

    $("#cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#rua").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#uf").val("...");
                $("#ibge").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#rua").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#uf").val(dados.uf);
                        $("#ibge").val(dados.ibge);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });

    function carregaCep(cp){
        //Nova variável "cep" somente com dígitos.
        var cep = cp.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#rua").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#uf").val("...");
                $("#ibge").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#rua").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#uf").val(dados.uf);
                        $("#ibge").val(dados.ibge);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    }

    $(document).ready(function(){
        $(":input").inputmask();
        $('.js-example-basic-single').select2();
    });
    $("#enderecoCep").hide();
    $("#enderecoSemCep").hide();

    function habilitaCep(){
        var radio = $('[name="chkEnd"]:checked');
        //alert(radio.val());
        if($(radio).val() == "n"){        
            $("#enderecoCep").hide(1000);
            $("#enderecoSemCep").show(1000);
            $("#rua").val("");
            $("#cep").val("");
            $("#numero").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#uf").val("");
            $("#ibge").val("");
            
        }else{
            $("#enderecoCep").show(1000);
            $("#enderecoSemCep").hide(1000);
            
        }
    }
    
    //Habilita o calendário
    $('#datetimepicker').datetimepicker({        
        daysOfWeekDisabled: [0, 6],
        inline: true,
        sideBySide: true,
        defaultDate: new Date(),
        disabledDates: [            
            new Date(),            
        ],
        minDate: new Date(),

    });
    
    //Carrega os endereços pré definidos
    $("#destinos").change(function() {
        if($("#destinos").val() == "abelef"){            
            $("#cep").val("24230-150");            
            $("#numero").val("29");            
        }
        if($("#destinos").val() == "abelem"){            
            $("#cep").val("24220-400");            
            $("#numero").val("217");            
        }
        if($("#destinos").val() == "abelcc"){            
            $("#cep").val("24220-401");            
            $("#numero").val("107");            
        }
        if($("#destinos").val() == "uni"){
            
            $("#cep").val("24240-030");            
            $("#numero").val("79");            
        }
        if($("#destinos").val() == "uninj"){
            
            $("#cep").val("24220-400");            
            $("#numero").val("222");            
        }
        if($("#destinos").val() == "uniceplas"){            
            $("#cep").val("24240-030");            
            $("#numero").val("113");            
        }
        
        $("#enderecoCep").show(1000);
        carregaCep($("#cep").val());
        $("#chkEndSim").prop("checked", true);        
    });

    $('#form').submit(function(){        
        $("#myModal").modal("hide");
        $("#modalLoading").modal("show");  
        //alert("salvando dados");
    });