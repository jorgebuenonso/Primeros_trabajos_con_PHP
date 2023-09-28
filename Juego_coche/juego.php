<!DOCTYPE html>
<html>
<head>
  <title>Juego</title>
  <style>
    /* Estilos para centrar el contenido en la pantalla */
    body {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh; /* 100% de la altura de la ventana */
    }
    table {
      border-collapse: collapse;
    }
    td {
      width: 30px;
      height: 30px;
      text-align: center;
      border: 1px solid #ccc;
      font-size: 24px; /* Tamaño del texto */
      font-weight: bold; /* Texto en negrita */
    }
  </style>
</head>
<body>
<h1>Juego con PHP</h1>
  <form method="post" action="juego.php">
    Mover (w, a, s, d): 
    <input type="text" name="direction">
    <input type="submit" value="Mover">
  </form>

  <?php
  // Iniciar la sesión de PHP
  session_start();

  // Definir el tamaño del tablero
  $size = 10;

  // Crear el tablero
  $board = array();
  for ($i = 0; $i < $size; $i++) {
    $board[$i] = array();
    for ($j = 0; $j < $size; $j++) {
      $board[$i][$j] = 0;
    }
  }

  // Colocar las minas
  $mines = 10;
  for ($i = 0; $i < $mines; $i++) {
    $x = rand(0, $size - 1);
    $y = rand(0, $size - 1);
    $board[$x][$y] = 1;
  }

  // Obtener la posición del jugador desde la sesión o inicializarla
  if (isset($_SESSION['player'])) {
    $player = $_SESSION['player'];
  } else {
    $player = array('x' => 0, 'y' => 0);
  }

  // Obtener la dirección del formulario
  $input = isset($_POST['direction']) ? $_POST['direction'] : '';

  // Mover el jugador según la entrada
  if ($input === "w" && $player['y'] > 0) {
    $player['y']--;
  } elseif ($input === "a" && $player['x'] > 0) {
    $player['x']--;
  } elseif ($input === "s" && $player['y'] < $size - 1) {
    $player['y']++;
  } elseif ($input === "d" && $player['x'] < $size - 1) {
    $player['x']++;
  }

  // Guardar la posición del jugador en la sesión
  $_SESSION['player'] = $player;

  // Coordenadas de la meta (esquina inferior derecha)
  $metaX = $size - 1;
  $metaY = $size - 1;

  // Mostrar el tablero
  echo "<table>";
  for ($i = 0; $i < $size; $i++) {
    echo "<tr>";
    for ($j = 0; $j < $size; $j++) {
      echo "<td>";
      if ($i == $player['y'] && $j == $player['x']) {
        echo "P";
      } elseif ($board[$i][$j] == 1) {
        echo "X";
      } elseif ($i == $metaY && $j == $metaX) {
        echo "M";
      } else {
        echo "0";
      }
      echo "</td>";
    }
    echo "</tr>";
  }
  echo "</table>";

  // Comprobar si el jugador ha ganado o perdido
  if ($board[$player['y']][$player['x']] == 1) {
    echo "Has perdido.\n";
    session_destroy(); // Limpiar la sesión
  } elseif ($player['x'] == $size - 1 && $player['y'] == $size - 1) {
    echo "Has ganado.\n";
    session_destroy(); // Limpiar la sesión
  }
  ?>

</body>
</html>
