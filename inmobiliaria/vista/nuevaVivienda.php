
<!DOCTYPE html>
<html>
<head>

</head>
<body>
  <a class='volver' href='../controlador/controller.php?m=viviendas'class='btn'>VOLVER</a>
  <form method="post" enctype="multipart/form-data">
    <link rel="stylesheet" href="../css/nuevaVivienda.css">
    <h2>Formulario de Propiedad</h2>

    <!-- pongo el la descripción el valor por defecto marcado en la BBDD por si no marcaran ninguno, se amrca este -->
    <select name="tipo">
      <option value="piso">Tipo</option>
      <option value="piso">Piso</option>
      <option value="adosado">Adosado</option>
      <option value="chalet">Chalet</option>
      <option value="casa">Casa</option>
    </select>
    <br>
    <select name="zona">
      <option value="centro">Zona</option>
      <option value="centro">Centro</option>
      <option value="norte">Norte</option>
      <option value="sur">Sur</option>
      <option value="este">Este</option>
      <option value="oeste">Oeste</option>
    </select>
    
    <select name="dormi">
      <option value="3">Número dormitorios</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5 o más">5 o más</option>
    </select>
    <br>
    <input type="text" placeholder="Dirección" name ="dire" maxlength="100" required >
    <br>
    <input type="text" placeholder="Precio" name="precio" required pattern="[0-9]{0,10}">
    <br>
    <input type="text" placeholder="Tamaño" name ="tamano" required pattern="[0-9]{0,10}">
    <br>
    <div class="extras-box">
      <h3>Extras</h3>
      <input class="checknewVivienda" type="checkbox" name="extras[]" value="piscina"><p class="pCheck">Piscina</p>
      <input class="checknewVivienda" type="checkbox" name="extras[]" value="jardin"><p class="pCheck">Jardín</p>
      <input class="checknewVivienda" type="checkbox" name="extras[]" value="garaje"><p class="pCheck">Garaje</p>
    </div>
    <br>
    <div class="foto-box">
    <h3>Foto</h3>
    <input accept="image/*" type="file" name="foto[]" placeholder="foto" multiple >
    </div>
    
    <br>
    <textarea rows="4" name="obs" placeholder="Observaciones (opcional)" style="width: 100%;"></textarea>
    <br>
    <input type="date" name="fecha" placeholder="Fecha" required>
    <br>
    <input type="hidden" name="m" value="guardarVivienda">
    <input class="botonNewVivienda" type="submit" value="Guardar">
   
  </form>
</body>
</html>
