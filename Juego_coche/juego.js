  // Tamaño del tablero
    const size = 10;

    // Crear el tablero
    const board = [];
    const gameBoard = document.getElementById("game-board");

    for (let i = 0; i < size; i++) {
      const row = [];
      const rowElement = document.createElement("tr");

      for (let j = 0; j < size; j++) {
        const cell = document.createElement("td");
        cell.textContent = "0";
        row.push(cell);
        rowElement.appendChild(cell);
      }

      board.push(row);
      gameBoard.appendChild(rowElement);
    }

    // Posición inicial del jugador (coche)
    let playerX = 0;
    let playerY = 0;
    board[playerY][playerX].textContent = "🚗"; // Emoticono de coche

    // Colocar algunas bombas negras (minas)
    const bombs = [
      { x: 2, y: 2 },
      { x: 4, y: 6 },
      { x: 7, y: 5 },
      { x: 8, y: 4 },
      { x: 6, y: 5 }
    ];

    // Coordenadas de la meta (esquina inferior derecha)
    const metaX = size - 1;
    const metaY = size - 1;

    // Emoticono de meta (añadido en la esquina inferior derecha)
    board[metaY][metaX].textContent = "🏁";

    // Agregar un evento de escucha para las teclas de flecha
    document.addEventListener("keydown", function(event) {
      // Borrar la posición actual del jugador
      board[playerY][playerX].textContent = "0";

      switch (event.key) {
        case "ArrowUp":
          if (playerY > 0) playerY--;
          break;
        case "ArrowLeft":
          if (playerX > 0) playerX--;
          break;
        case "ArrowDown":
          if (playerY < size - 1) playerY++;
          break;
        case "ArrowRight":
          if (playerX < size - 1) playerX++;
          break;
      }

      // Dibujar al jugador (coche) en la nueva posición
      board[playerX][playerY].textContent = "🚗";

      // Comprobar si el jugador ha llegado a la meta
      if (playerX === metaX && playerY === metaY) {
        alert("¡Has ganado!");
        resetGame();
      }
      // Mover las bombas aleatoriamente
      bombs.forEach(bomb => {
        const dx = Math.floor(Math.random() * 3) - 1; // -1, 0 o 1
        const dy = Math.floor(Math.random() * 3) - 1; // -1, 0 o 1

        const newX = bomb.x + dx;
        const newY = bomb.y + dy;

        // Verificar si la nueva posición es válida dentro del tablero
        if (newX >= 0 && newX < size && newY >= 0 && newY < size && !(newX === metaX && newY === metaY)) {
          // Verificar si el jugador ha perdido al chocar con una bomba
          if (playerX === bomb.x && playerY === bomb.y) {
            alert("¡Has perdido!");
            resetGame();
          }else{ 
            board[bomb.y][bomb.x].textContent = "0";
            // Actualizar la posición de la bomba
            bomb.x = newX;
            bomb.y = newY;

            board[bomb.y][bomb.x].textContent = "💣";
            
          }
        }
      });

    });

      // Función para reiniciar el juego
      function resetGame() {
      // Recargar la página para reiniciar el juego
        window.location.reload();
      }
