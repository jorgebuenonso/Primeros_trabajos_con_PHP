<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/styleNew.css">
  <title>Editar</title>
  <style>
    .enlaceBorrarFoto {
      width: 100%;
      padding: 5px;
      margin-left: 30px;
      background-color: #333;
      color: #fff;
      border: 0;
      border-radius: 5px;
      font-size: 14px;
      cursor: pointer;
      text-decoration: none;
    }

    .enlaceBorrarFoto:hover {
      color: red;
    }

    body {
      background-image: url(https://inmobiliariaham.es/wp-content/uploads/2021/08/Logo-HAM.svg);
      background-repeat: no-repeat;
      /* background-repeat: initial; */
      background-position: 150px 32px;

    }
    a{
      text-decoration: none;
      
    }
  </style>

</head>

<body>
  <a class='volver' href='../controlador/controller.php?m=viviendas' class='btn'>VOLVER</a>
  <h1 class="text-center">EDITAR</h1>
  <form class="formEditar" method="post" enctype="multipart/form-data">
    <?php
    require_once "../modelo/foto.php";
    $file = new Foto();
    // $fotoArray= $file->mostrar($dato['id']);

    foreach ($dato as $key => $value) :
      // print_r($dato);
      foreach ($value as $v) :
        $fotoArray = $file->mostrar($v['id']);
        // 
    ?>
        ID <input type="text" value="<?php echo $v['id'] ?>" name="id" readonly> <br>
        <div>Tipo <select name='tipo'>

            <?php
            $selected = $v['tipo'];
            $tipos = array("Casa", "Piso", "Chalet", "Adosado");
            foreach ($tipos as $tipo) {
              echo '<option value="' . $tipo . '"';
              if ($tipo == $selected) {
                echo ' selected';
              }
              echo '>' . $tipo . '</option>';
            }
            echo "</select></div>";
            echo "<div>Zona <select  name='zona'>";

            $zonas = array("Centro", "Norte", "Sur", "Este", "Oeste"); // valores manuales
            $selected = $v['zona'];
            foreach ($zonas as $zona) {
              echo '<option value="' . $zona . '"';
              if ($zona == $selected) {
                echo ' selected';
              }
              echo '>' . $zona . '</option>';
            }
            echo "</select></div>";
            ?>

            Dirección <input type="text" value="<?php echo $v['direccion'] ?>" name="direccion" maxlength="100" required> <br>
            <div>Dormitorios <select name='dormitorio'>
                <?php
                $numeros = array("1", "2", "3", "4", "5 o más"); // valores manuales
                $selected = $v['ndormitorios'];
                foreach ($numeros as $numero) {
                  echo '<option value="' . $numero . '"';
                  if ($numero == $selected) {
                    echo ' selected';
                  }
                  echo '>' . $numero . '</option>';
                }
                echo "</select></div>";
                ?>
                Precio <input type="text" value="<?php echo $v['precio'] ?>" name="precio" pattern="[0-9]{0,10}" required> <br>
                Tamaño <input type="text" value="<?php echo $v['tamano'] ?>" name="tamano" pattern="[0-9]{0,10}" required> <br>
                <div extras name='extras'>
                  <?php
                  $extras = array("Piscina", "Jardín", "Garage"); // valores manuales
                  $selected = explode(',', $v['extras']);
                  foreach ($extras as $extra) {
                    echo '<input type="checkbox" name="extras[]" value="' . $extra . '"';
                    if (in_array($extra, $selected)) {
                      echo ' checked';
                    }
                    echo '> ' . $extra . '<br>';
                  }

                  ?>
                </div>
                <br>
                <?php if (!empty($v['idFoto'])) { ?>
                  <p style="font-weight: bold;">Foto actual</p>
                  <div><?php echo $v['nombres_fotos']; ?> <a class="enlaceBorrarFoto" href='../controlador/controller.php?id=<?php echo $v['idFoto'] ?>&e=<?php echo $v['nombres_fotos'] ?>&idVi=<?php echo $v['idVi'] ?>'> Borrar foto</a></div><br>
                <?php } ?>
                Observaciones <input type="text" value="<?php echo $v['observaciones'] ?>" name="observaciones"> <br>
                Fecha <input type="date" value="<?php echo $v['fecha_anuncio'] ?>" name="fecha"> <br>
                Foto <input accept="image/*" type="file" name="foto[]"><br><br>
                <input type="hidden" name="m" value="actualizar">

                <?php
              endforeach;
            endforeach;

            foreach ($fotoArray as $key => $value) {
              foreach ($value as $v) :

                if (!empty($v['foto'])) { ?>
                  <p style="font-weight: bold;">Foto actual</p>
                  <div>
                  <a href="../fotos/<?php echo $v['foto']; ?>"><?php echo $v['foto']; ?></a>
                    <a class="enlaceBorrarFoto" href='../controlador/controller.php?id=<?php echo $v['id'] ?>&e=<?php echo $v['foto'] ?>&idVi=<?php echo $v['id_vivienda'] ?>'> Borrar foto</a>
                  </div>

            <?php }

              endforeach;
            } ?>
            </div><br> <input type="submit" class="btn" name="btn" value="ACTUALIZAR">
  </form>

</body>

</html>