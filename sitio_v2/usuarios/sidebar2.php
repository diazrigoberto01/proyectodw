<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: "Lato", sans-serif;
        }
        /* Fixed sidenav, full height */
        
        .sidenav {
            height: 100%;
            width: 200px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #343A40;
            overflow-x: hidden;
            padding-top: 20px;
        }
        /* Style the sidenav links and the dropdown button */
        
        .sidenav a,
        .dropdown-btn {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 20px;
            color: #f1f1f1;
            display: block;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            outline: none;
        }
        /* On mouse-over */
        
        .sidenav a:hover,
        .dropdown-btn:hover {
            color: #818181;
        }
        /* Main content */
        
        .main {
            margin-left: 200px;
            /* Same as the width of the sidenav */
            font-size: 20px;
            /* Increased text to enable scrolling */
            padding: 0px 10px;
        }
        /* Add an active class to the active dropdown button */
        
        .active {
            background-color: #343A40;
            color: white;
        }
        /* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
        
        .dropdown-container {
            display: none;
            background-color: #343A40;
            padding-left: 8px;
        }
        /* Optional: Style the caret down icon */
        
        .fa-caret-down {
            float: right;
            padding-right: 8px;
        }
        /* Some media queries for responsiveness */
        
        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }
            .sidenav a {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>

    <div class="sidenav col-md-2">
      <!--Facturas-->
      <div class="dropdown mt-5 ">
        <button class="btn bg-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span style="color:#fff">Facturas</span>
        </button>
        <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="facturas.php"><span style="color:#fff">Ver</span></a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="crear-factura.php"><span style="color:#fff">Nueva Factura</span></a>
        </div>
      </div>
        <!--Empresas-->
        <div class="dropdown mt-4">
          <button class="btn bg-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span style="color:#fff">Empresas</span>
          </button>
          <div class="dropdown-menu bg-dark " aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="empresas.php"><span style="color:#fff">Ver</span></a>
            <a class="dropdown-item" href="agregar-empresa.php"><span style="color:#fff">Agregar</span></a>
          </div>
        </div>
        <!--Clientes-->
        <div class="dropdown mt-4">
            <button class="btn bg-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span style="color:#fff">Clientes</span>
            </button>
            <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="clientes.php"><span style="color:#fff">Ver</span></a>
              <a class="dropdown-item" href="agregar-cliente.php"><span style="color:#fff">Agregar</span></a>
            </div>
        </div>
        <!--Servicios-->
        <div class="dropdown mt-4">
            <button class="btn bg-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <span style="color:#fff">Servicios</span>
            </button>
            <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="servicios.php"><span style="color:#fff">Ver</span></a>
              <a class="dropdown-item" href="agregar-servicio.php"><span style="color:#fff">Agregar</span></a>
            </div>
        </div>
        <!--Usuarios-->

        <div class="dropdown mt-4">
          <button class="btn bg-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span style="color:#fff">Usuarios</span>
          </button>
          <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="usuarios.php"><span style="color:#fff">Ver</span></a>
            <?php
              if ($_SESSION['tipo_usuario'] == "admin") {
            ?>
            <a class="dropdown-item" href="agregar-usuario.php"><span style="color:#fff">Agregar</span></a>
            <?php
            }
            ?>
          </div>
        </div>
    
        <!--Reportes-->

        <?php
      if ($_SESSION['tipo_usuario'] == "admin") {
    ?>
    <div class="dropdown mt-4">
      <button class="btn bg-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span style="color:#fff">Reportes</span>
      </button>
      <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="reportes.php"><span style="color:#fff">Ver</span></a>
      </div>
    </div>
    <?php
      }
    ?>








        
      
    </div>


        <script>
            /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
            var dropdown = document.getElementsByClassName("dropdown-btn");
            var i;

            for (i = 0; i < dropdown.length; i++) {
                dropdown[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var dropdownContent = this.nextElementSibling;
                    if (dropdownContent.style.display === "block") {
                        dropdownContent.style.display = "none";
                    } else {
                        dropdownContent.style.display = "block";
                    }
                });
            }
        </script>

</body>

</html>