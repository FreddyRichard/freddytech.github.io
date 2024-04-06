
/**************************************************************/
/**************************************************************/
/**************************************************************/
/* Validar que no se ingrese un campo repetido, en este caso DNI */      
/**************************************************************/
$(document).ready(function () {
  //Apenas cargue el La pagina cargara la lista de Clientes.
  $("#listClientes").load("listClientes.php"); //load es una funcion de Jquery
  $(".zmdi-hc-spin").hide(); //Oculto la animacion del boton enviar

  //Efecto Pre-Carga
  $(window).load(function () {
    $(".cargando").fadeOut(500);
  });


  //Codigo para limitar la cantidad maxima que tendra dicho Input
  $('input#id').keypress(function (event) {
    if (event.which < 48 || event.which > 57 || this.value.length === 8) {
      return false;
    }
  });


  //Validar la cantidad maxima en el campo celular
  $('input#celular').keypress(function (event) {
    if (event.which < 48 || event.which > 57 || this.value.length === 10) {
      return false;
    }
  });


  // Validando si existe el dni en BD antes de enviar el formulario
  var dniField = $("#dni").length ? $("#dni") : $("#dni-editar");
  dniField.on("keyup", function () {
    var dni = dniField.val(); // CAPTURANDO EL VALOR DEL INPUT CON ID DNI
    var longitudDni = $("#dni").val().length; // CUENTO LONGITUD

    // Valido la longitud
    if (longitudDni >= 1) {
      var dataString = 'dni=' + dni;

      $.ajax({
        url: 'participantes/verificarCedula',
        type: "GET",
        data: dataString,
        dataType: "JSON",

        success: function (datos) {
          if (datos.success == 1) {
            $("#respuesta").html(datos.message);
            $("input").attr('disabled', true); // Desabilito el input nombre
            $("select").attr('disabled', true); // Desabilito los select
            $("input#dni").attr('disabled', false); // Habilitando el input dni
            $("#btnEnviar").attr('disabled', true); // Desabilito el botón
          } else {
            $("#respuesta").html(datos.message);
            $("input").attr('disabled', false); // Habilito los input
            $("select").attr('disabled', false); // Habilito los select
            $("#btnEnviar").attr('disabled', false); // Habilito el botón
          }
        }
      });
    }
  });

  

});




/**************************************************************/
/**************************************************************/
/**************************************************************/
/* Aplicar filtro al campo Telefono */      
/**************************************************************/
$(document).ready(function () {
  // Validar la cantidad máxima de dígitos en el campo de teléfono
  $("#telefono").on("input", function (e) {
    var telefono = $(this).val();
    if (telefono.length > 9) {
      $(this).css("border-color", "red");
      $("#telefono-error").text("Este no es un número de teléfono válido").css("color", "red").show();
      $(this).prop("readonly", true);
    } else {
      $(this).css("border-color", "initial");
      $("#telefono-error").text("").hide();
      $(this).prop("readonly", false);
    }
  });

  // Habilitar la edición cuando se presiona la tecla de retroceso
  $("#telefono").on("keydown", function (e) {
    if ($(this).val().length >= 9 && e.keyCode === 8) {
      $(this).css("border-color", "initial");
      $("#telefono-error").text("").hide();
      $(this).prop("readonly", false);
    }
  });
});




/**************************************************************/
/**************************************************************/
/**************************************************************/
/* Aplicar filtro a una tabla de listado */      
/**************************************************************/
// Para los campos de usuario en general
document.addEventListener('DOMContentLoaded', function() { 
  var filtroId = document.getElementById('filtroId');
  var filtroNombres = document.getElementById('filtroNombres');
  var filtroApellidoPaterno = document.getElementById('filtroApellidoPaterno');
  var filtroApellidoMaterno = document.getElementById('filtroApellidoMaterno');

  function obtenerFiltroActual() {
      var url = window.location.href;
      var partesUrl = url.split('/');
      var filtro = partesUrl[partesUrl.length - 1];
      return filtro;
  }

  function redirigirConFiltro(filtro) {
      var filtroActual = obtenerFiltroActual();
      var url;

      if (filtroActual === filtro) {
          url = listarUsuarios;
      } else {
          url = listarUsuarios + '/' + filtro;
      }

      window.location.href = url;
  }

  function redirigirSinFiltro() {
      window.location.href = listarUsuarios;
  }
 
  if (filtroId) {
    filtroId.addEventListener('click', function(e) {
        e.preventDefault();
        var filtroActual = obtenerFiltroActual();
        if (filtroActual && filtroActual === 'id') {
            redirigirSinFiltro();
        } else {
            redirigirConFiltro('id');
        }
    });
  }

  if (filtroNombres) {
    filtroNombres.addEventListener('click', function(e) {
        e.preventDefault();
        var filtroActual = obtenerFiltroActual();
        if (filtroActual && filtroActual === 'nombres') {
            redirigirSinFiltro();
        } else {
            redirigirConFiltro('nombres');
        }
    });
  }

  if (filtroApellidoPaterno) {
    filtroApellidoPaterno.addEventListener('click', function(e) {
        e.preventDefault();
        var filtroActual = obtenerFiltroActual();
        if (filtroActual && filtroActual === 'apellidopaterno') {
            redirigirSinFiltro();
        } else {
            redirigirConFiltro('apellidopaterno');
        }
    });
  }

  if (filtroApellidoMaterno) {
    filtroApellidoMaterno.addEventListener('click', function(e) {
        e.preventDefault();
        var filtroActual = obtenerFiltroActual();
        if (filtroActual && filtroActual === 'apellidomaterno') {
            redirigirSinFiltro();
        } else {
            redirigirConFiltro('apellidomaterno');
        }
    });
  }

});

/* ************************************************** */

// Para los campos de la tabla docente
document.addEventListener('DOMContentLoaded', function() { 
  var filtroCurso = document.getElementById('filtroCurso');

  function obtenerFiltroActual() {
      var url = window.location.href;
      var partesUrl = url.split('/');
      var filtro = partesUrl[partesUrl.length - 1];
      return filtro;
  }

  function redirigirConFiltro(filtro) {
      var filtroActual = obtenerFiltroActual();
      var url;

      if (filtroActual === filtro) {
          url = listarUsuarios;
      } else {
          url = listarUsuarios + '/' + filtro;
      }

      window.location.href = url;
  }

  function redirigirSinFiltro() {
      window.location.href = listarUsuarios;
  }
 
  // Verifica si el elemento de filtro está presente en la vista actual
  if (filtroCurso) {
    filtroCurso.addEventListener('click', function(e) {
        e.preventDefault();
        var filtroActual = obtenerFiltroActual();
        if (filtroActual && filtroActual === 'curso') {
            redirigirSinFiltro();
        } else {
            redirigirConFiltro('curso');
        }
    });
  }

});