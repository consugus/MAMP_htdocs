(function(){
    "use strict"

    var regalo = document.getElementById("regalo");

    document.addEventListener("DOMContentLoaded", function(){

        // Variables de Datos de Usuario
        var nombre = document.getElementById("nombre");
        var apellido = document.getElementById("apellido");
        var email = document.getElementById("eMail");

        // Variables de los pases
        var pasePorDia = document.getElementById("pase_dia");
        var paseCompleto = document.getElementById("pase_completo");
        var paseDosDias = document.getElementById("pase_dos_dias");

        var formulario_editar = document.getElementsByClassName('editar-registrado');
        if(formulario_editar){
            if( parseInt(pasePorDia.value, 10) || parseInt(paseDosDias.value, 10) || parseInt(paseCompleto.value, 10) ){
                mostrarDias();
            };
        };


        // Botones y Divs
        var calcular = document.getElementById("calcular");
        var errorDiv = document.getElementById("error");
        var botonRegistro = document.getElementById("btnRegistro");
        var resultado = document.getElementById("lista-productos");

        // Variables de Extras
        var camisas = document.getElementById("camisa_evento");
        var etiquetas = document.getElementById("etiquetas");
        var sumaTotal = document.getElementById("suma-total");

        document.getElementById("btnRegistro").disabled = true;

        if(document.getElementById("calcular") ){

            calcular.addEventListener("click", function(event){
                event.preventDefault();

                var total = 0;
                var listadoCompra = [];

                if(regalo.value === ""){
                    alert("Debes elegir un regalo");
                    regalo.focus();
                } else{
                    var subTotal1 = pasePorDia.value*30 + paseDosDias.value*45 + paseCompleto.value*50;
                    var subtotal2 = camisas.value * 10 * .93 + etiquetas.value * 2;
                    total = subTotal1 + subtotal2;
                };

                if(pasePorDia.value != 0){
                    if( parseInt(pasePorDia.value) === 1){
                        listadoCompra.push(pasePorDia.value + " pase por dia");
                    } else {
                        listadoCompra.push(pasePorDia.value + " pases por dia");
                    };
                };

                if(paseDosDias.value != 0){
                    if( parseInt(paseDosDias.value) === 1){
                        listadoCompra.push(paseDosDias.value + " pase por 2 dias");
                    } else{
                        listadoCompra.push(paseDosDias.value + " pases por 2 dias");
                    };
                };

                if(paseCompleto.value != 0){
                    if( parseInt(paseCompleto.value) === 1){
                        listadoCompra.push(paseCompleto.value + " pase completo");
                    } else{
                        listadoCompra.push(paseCompleto.value + " pases completo");
                    };
                };

                if(camisas.value != 0){
                    if( parseInt(camisas.value) === 1){
                        listadoCompra.push(camisas.value + " camisa del evento");
                    } else{
                        listadoCompra.push(camisas.value + " camisas del evento");
                    };
                };

                if(etiquetas.value != 0){
                    if( parseInt(camisas.value) === 1){
                        listadoCompra.push(etiquetas.value + " juego de etiquetas");
                    } else{
                        listadoCompra.push(etiquetas.value + " juegos de etiquetas");
                    };
                };

                resultado.innerHTML = "";
                for(var i = 0 ; i < listadoCompra.length ; i++){
                    resultado.innerHTML += listadoCompra[i];
                    if(i < listadoCompra.length - 1){
                        resultado.innerHTML += "</br>";
                    };
                };

                sumaTotal.innerHTML = "$ " + total.toFixed(2);

                if (total > 0){
                    document.getElementById("btnRegistro").disabled = false;
                    document.getElementById("total_pedido").value = total.toFixed(2);
                };



            });

            pasePorDia.addEventListener("blur", mostrarDias );
            paseDosDias.addEventListener("blur", mostrarDias );
            paseCompleto.addEventListener("blur", mostrarDias );

            // acá estaba

            nombre.addEventListener("blur", function(){
                if(this.value == ""){
                    errorDiv.style.display = "block";
                    errorDiv.innerHTML += "El nombre es obligatorio" + "</br>";
                } else{
                    errorDiv.innerHTML = "";
                };
            });

            apellido.addEventListener("blur", function(){
                if(this.value == ""){
                    errorDiv.style.display = "block";
                    errorDiv.innerHTML += "El apellido es obligatorio" + "</br>";
                } else{
                    errorDiv.innerHTML = "";
                };
            });

            email.addEventListener("blur", function(){
                if(this.value == ""){
                    errorDiv.style.display = "block";
                    errorDiv.innerHTML += "El eMail es obligatorio" + "</br>";
                } else{
                    errorDiv.innerHTML = "";
                };
            });

            email.addEventListener("blur", function(){
                if(this.value.indexOf("@") == -1){
                    errorDiv.innerHTML += "El eMail debe ser válido";
                };
            });

        };

        function mostrarDias(){

            document.getElementById("viernes").style.display = "none";
            document.getElementById("sabado").style.display = "none";
            document.getElementById("domingo").style.display = "none";

            if(parseInt(pasePorDia.value, 10) > 0){
                document.getElementById("viernes").style.display = "block";
            };
            if( parseInt(paseDosDias.value, 10) > 0){
                document.getElementById("viernes").style.display = "block";
                document.getElementById("sabado").style.display = "block";
            };
            if( parseInt(paseCompleto.value, 10) > 0){
                document.getElementById("viernes").style.display = "block";
                document.getElementById("sabado").style.display = "block";
                document.getElementById("domingo").style.display = "block";
            };
        };

    }); // DOMContentLoaded
})();