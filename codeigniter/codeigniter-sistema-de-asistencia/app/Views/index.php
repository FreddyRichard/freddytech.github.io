<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" rel="shortcut icon" href="img/logo-mywebsite-urian-viera.svg"/>
  <title>Clientes</title>
 
  
</head>
<body>



<div class="container mt-5 p-5">

  
  <hr>


<div class="row text-center" style="background-color: #cecece">
  <div class="col-md-6"> 
    <strong>Registrar Cliente</strong>
  </div>
  <div class="col-md-6"> 
    <strong>Lista de Clientes </strong>
  </div>
</div>

<div class="row clearfix">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="body">
      <div class="row clearfix">

        <!----- formulario --->
        <div class="col-sm-5">
            <form name="formCliente" id="formCliente" action="<?= site_url('participantes/registrarCliente') ?>" method="POST">

              <div class="row">
                
                <div class="col-md-12 mt-2">
                    <label for="name" class="form-label">DNI</label>
                    <input type="number" class="form-control" name="id" id="id" required='true' autofocus>
                    <div id="respuesta"> </div>
                </div>

                <div class="col-md-12">
                    <label for="name" class="form-label">Nombre del Cliente</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" required='true' autofocus>
                </div>
                <div class="col-md-12 mt-2">
                    <label for="email" class="form-label">Correo</label>
                    <input type="email" class="form-control" name="correo" id="correo" required='true'>
                </div>
                <div class="col-md-12 mt-2">
                    <label for="celular" class="form-label">Celular</label>
                    <input type="number" class="form-control" name="celular" id="celular" required='true'>
                </div>

              </div>
                <div class="row justify-content-start text-center mt-5">
                    <div class="col-12">
                        <button class="btn btn-primary btn-block" value="Registrar Nuevo Cliente" id="btnEnviar">
                           <i class="zmdi zmdi-spinner zmdi-hc-lg zmdi-hc-spin"></i>
                            Registrar Nuevo Cliente
                        </button>
                    </div>
                </div>
          </form>
        </div>  
      <!--fin form -->

         

          <div class="col-sm-7">
              <div class="row" id="listClientes">
                  <?= $this->include('listClientes') ?>
              </div>
          </div>



        </div>
      </div>
  </div>
</div>
</div>


<script src="<?= base_url('js/jquery-2.2.4.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('js/popper.min.js') ?>"></script>


<script type="text/javascript">
    $(document).ready(function() {
      //Apenas cargue el La pagina cargara la lista de Clientes.
      $("#listClientes").load("listClientes.php"); //load es una funcion de Jquery
      $(".zmdi-hc-spin").hide(); //Oculto la animacion del boton enviar

      //Efecto Pre-Carga
      $(window).load(function() {
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


//Validando si existe la id en BD antes de enviar el Form
$("#id").on("keyup", function() {
  var id = $("#id").val(); //CAPTURANDO EL VALOR DE INPUT CON ID ID
  var longitudId = $("#id").val().length; //CUENTO LONGITUD

//Valido la longitud 
  if(longitudId >= 1){
    var dataString = 'id=' + id;

      $.ajax({
          url: 'participantes/verificarCedula',
          type: "GET",
          data: dataString,
          dataType: "JSON",

          success: function(datos){

                if( datos.success == 1){

                $("#respuesta").html(datos.message);

                $("input").attr('disabled',true); //Desabilito el input nombre
                $("input#id").attr('disabled',false); //Habilitando el input id
                $("#btnEnviar").attr('disabled',true); //Desabilito el Botton

                }else{

                $("#respuesta").html(datos.message);

                $("input").attr('disabled',false); //Habilito el input nombre
                $("#btnEnviar").attr('disabled',false); //Habilito el Botton

                    }
                  }
                });
              }
          });


        //Funcion para enviar el formulario de registro.
        $('#btnEnviar').click(function(e){
            e.preventDefault();

          //Muestro el efecto cargando en el boton
          $(".zmdi-hc-spin").show();  

          setTimeout(function() {
            $(".zmdi-hc-spin").hide();
            $("#btnEnviar").attr('disabled',false); //Desabilito el boton enviar
          }, 1000);

          url = "nuevoCliente.php";
          $.ajax({
              type: "POST",
              url: url,
              data: $("#formCliente").serialize(),
              success: function(datos)
              {
                $("#listClientes").load("listClientes.php"); //Cargo nuevamenta la lista de Clientes, pero ya actualizada.
                $("#formCliente")[0].reset(); //Limpio todos los input de mi formulario
              }
          });
        });


 });
      
</script>

