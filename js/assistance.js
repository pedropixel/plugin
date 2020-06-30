jQuery(function($){
    
    
    $('.form-check-label').click(function() {
        $(this).addClass('selected').siblings().removeClass('selected');
        $(this).children('input').prop('checked', true);
    });
    $('#request').submit(SendRequest);
        function SendRequest(){ 
            var cedula = document.getElementById('cedula').value;
            var fecha = document.getElementById('fecha').value;
            var selected = "";
            var size=0;
            var i=0;
            
            $("#request input[type=radio]").each(function(){
                if (this.checked) {
                size++;
                }
            });
            $("#request input[type=radio]").each(function(){
                if (this.checked) {
                selected += $(this).val();
                }
                i++;
                if(i<size){
                selected +=",";
                }
            });
            hora = selected;
            $.ajax ({
                type:"POST",
                url: "../wp-content/plugins/evo-assistance/request.php",
                data:('cedula='+cedula+'&fecha='+fecha+'&hora='+hora),           
            }).done(function (respuesta){
			
                mostrar_mensaje( respuesta );
            });

        }
        
        var mostrar_mensaje = function (respuesta){
		var texto = "", color = "";
	
                    if( respuesta == 1 ){
                            texto = 'Listo! recibiras un correo con la fecha y hora';
                            color = "#379911";
                    }else if( respuesta == "cedula"){
                            texto = "No te encuentra en la base de datos";
                            color = "#C9302C";
                    }else if( respuesta == 3 ){
                            texto = "Te encuentras bloqueado por favor comunicarte al 0992824763";
                            color = "#5b94c5";
                    }else if( respuesta == "repetido" ){
                            texto = "Ya agendaste para esta fecha, selecciona otra";
                            color = "#ddb11d";
                    }else if( respuesta == "nodisponible" ){
                            texto = "Aforo agotado para la hora que seleccionaste";
                            color = "#ddb11d";
                    }else if( respuesta == "datos" ){
                        texto = "Debes ingresar cédula, fecha y hora";
                        color = "#ddb11d";
                    }else{
                        texto = "Agendado! recibiras un correo con la fecha y hora";
                        color = "#ddb11d";
                    }
                    $(".mensaje").html(texto).css({"color": color });
                    $(".mensaje").fadeOut(5000, function(){
                        $(this).html("");
                        $(this).fadeIn(3000);
                    });
        }
  
});