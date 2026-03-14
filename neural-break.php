<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --bg-color: #031d33; /* Matches your site background */
            --cyan-glow: #00f2ff;
            --green-glow: #39ff14;
            --glass-bg: rgba(255, 255, 255, 0.05);
        }

        body {
            background-color: var(--bg-color);
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        h2 {
            text-transform: uppercase;
            letter-spacing: 3px;
            color: var(--cyan-glow);
            text-shadow: 0 0 10px var(--cyan-glow);
        }

        .board {
            display: grid;
            grid-template-columns: repeat(3, 100px);
            grid-template-rows: repeat(3, 100px);
            gap: 10px;
            background: var(--glass-bg);
            padding: 15px;
            border-radius: 15px;
            border: 1px solid rgba(0, 242, 255, 0.3);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        .cell {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(0, 242, 255, 0.1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .cell:hover {
            background: rgba(0, 242, 255, 0.1);
        }

        .cell.x { color: var(--cyan-glow); text-shadow: 0 0 15px var(--cyan-glow); }
        .cell.o { color: var(--green-glow); text-shadow: 0 0 15px var(--green-glow); }

        .status {
            margin-top: 20px;
            font-size: 1.2rem;
            height: 1.5rem;
        }

        button {
            margin-top: 20px;
            padding: 10px 25px;
            background: transparent;
            color: var(--cyan-glow);
            border: 1px solid var(--cyan-glow);
            border-radius: 5px;
            cursor: pointer;
            text-transform: uppercase;
            transition: 0.3s;
        }

        button:hover {
            background: var(--cyan-glow);
            color: var(--bg-color);
            box-shadow: 0 0 15px var(--cyan-glow);
        }
    </style>
</head>
<body>

    <h2>Neural Break: Tic-Tac-Toe</h2>
    <div class="status" id="status">Your Turn (X)</div>
    
    <div class="board" id="board">
        <div class="cell" data-index="0"></div>
        <div class="cell" data-index="1"></div>
        <div class="cell" data-index="2"></div>
        <div class="cell" data-index="3"></div>
        <div class="cell" data-index="4"></div>
        <div class="cell" data-index="5"></div>
        <div class="cell" data-index="6"></div>
        <div class="cell" data-index="7"></div>
        <div class="cell" data-index="8"></div>
    </div>

    <button onclick="resetGame()">System Reboot</button>

    <script>
        const boardElement = document.getElementById('board');
        const statusElement = document.getElementById('status');
        let board = ["", "", "", "", "", "", "", "", ""];
        let gameActive = true;

        const winningConditions = [
            [0, 1, 2], [3, 4, 5], [6, 7, 8],
            [0, 3, 6], [1, 4, 7], [2, 5, 8],
            [0, 4, 8], [2, 4, 6]
        ];

        function handleCellClick(e) {
            const clickedCell = e.target;
            const index = clickedCell.getAttribute('data-index');

            if (board[index] !== "" || !gameActive) return;

            makeMove(index, "X");
            
            if (gameActive) {
                setTimeout(computerMove, 500);
            }
        }

        function makeMove(index, player) {
            board[index] = player;
            const cell = document.querySelector(`[data-index='${index}']`);
            cell.innerText = player;
            cell.classList.add(player.toLowerCase());
            checkResult();
        }

        function computerMove() {
            const emptyIndices = board.map((val, idx) => val === "" ? idx : null).filter(val => val !== null);
            if (emptyIndices.length > 0 && gameActive) {
                const randomIndex = emptyIndices[Math.floor(Math.random() * emptyIndices.length)];
                makeMove(randomIndex, "O");
            }
        }

        function checkResult() {
            let roundWon = false;
            for (let i = 0; i < winningConditions.length; i++) {
                const [a, b, c] = winningConditions[i];
                if (board[a] && board[a] === board[b] && board[a] === board[c]) {
                    roundWon = true;
                    break;
                }
            }

            if (roundWon) {
                statusElement.innerText = `System Error: Winner Identified!`;
                gameActive = false;
                return;
            }

            if (!board.includes("")) {
                statusElement.innerText = "Data Parity: It's a Draw!";
                gameActive = false;
                return;
            }
        }

        function resetGame() {
            board = ["", "", "", "", "", "", "", "", ""];
            gameActive = true;
            statusElement.innerText = "Your Turn (X)";
            document.querySelectorAll('.cell').forEach(cell => {
                cell.innerText = "";
                cell.classList.remove('x', 'o');
            });
        }

        boardElement.addEventListener('click', handleCellClick);
    </script>
</body>
</html>
