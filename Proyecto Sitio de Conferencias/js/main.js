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

            function mostrarDias(){

                document.getElementById("viernes").style.display = "none";
                document.getElementById("sabado").style.display = "none";
                document.getElementById("domingo").style.display = "none";

                if(pasePorDia.value > 0){
                    document.getElementById("viernes").style.display = "block";
                };
                if(paseDosDias.value > 0){
                    document.getElementById("viernes").style.display = "block";
                    document.getElementById("sabado").style.display = "block";
                };
                if(paseCompleto.value > 0){
                    document.getElementById("viernes").style.display = "block";
                    document.getElementById("sabado").style.display = "block";
                    document.getElementById("domingo").style.display = "block";
                };
            };

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

    }); // DOMContentLoaded
})();


$(function(){

    // Tuneando gdlWebCamp
    $(".nombre-sitio").lettering();

    // Agregar clases al Menú
    $('body.conferencia .navegacion-principal a:contains("Conferencia")') .addClass('activo');
    $('body.calendario .navegacion-principal a:contains("Calendario")') .addClass('activo');
    $('body.invitados .navegacion-principal a:contains("Invitados")') .addClass('activo' )


    // Fijando la barra top al hacer scroll
    var windowHeight = $(window).height();
    var barraHeight = $(".barra").innerHeight();
    $(window).scroll(function(){
        var scroll = $(window).scrollTop();

        if(scroll > windowHeight){
            $(".barra").addClass("fixed");
            $("body").css({"margin-top": barraHeight + "px"});
        } else {
            $(".barra").removeClass("fixed");
            $("body").css({"margin-top": "0px"});
        };
    });


    // Menú Responsivo para móviles
    $(".menu-movil").click(function(){
        if( $(".navegacion-principal").hasClass("hidden") ){
            $(".navegacion-principal").removeClass("hidden");
        } else {
            $(".navegacion-principal").addClass("hidden");
        };
    });

    // Programa de Conferencias
    $(".programa-evento .info-curso:first").show();
    $(".menu-programa a:first").addClass("activo");
    $(".menu-programa a").on("click", function(){

        $(".menu-programa a").removeClass("activo");
        $(this).addClass("activo");
        $(".ocultar").hide();
        var enlace = $(this).attr("href");
        $(enlace).fadeIn(1000);

        return false;
    });

    // Animaciones para los números
    var resumenLista = $(".resumen-evento");
    if(resumenLista.length > 0){
        $(".resumen-evento").waypoint(function(){
            $(".resumen-evento li:nth-child(1) p").animateNumber({ number: 6}, 1200);
            $(".resumen-evento li:nth-child(2) p").animateNumber({ number: 15}, 1200);
            $(".resumen-evento li:nth-child(3) p").animateNumber({ number: 3}, 1200);
            $(".resumen-evento li:nth-child(4) p").animateNumber({ number: 9}, 1200);
        }, {
            offset: "50%" // Hace que se active cuando se scrolleó al 50% de la página
        });
    };

    // Animación cuenta regresiva
    $(".cuenta-regresiva").countdown("2018/12/24", function(event){
        $("#dias").html(event.strftime("%D"));
        $("#horas").html(event.strftime("%H"));
        $("#min").html(event.strftime("%M"));
        $("#seg").html(event.strftime("%S"));
    });

    // Colorbox
    $('.invitado-info').colorbox({inline:true, width:"50%"});
    $('.button_newsletter').colorbox({inline:true, width:"50%"});
});


