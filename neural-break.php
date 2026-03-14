<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neural Break | Holistic Data Pro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --brand-blue-dark: #001f3f;
            --brand-gold: #ffc629;
            --brand-green: #4ade80;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--brand-blue-dark);
            color: white;
            margin: 0;
            overflow-x: hidden;
        }

        /* Video Background Logic */
        .video-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, rgba(0, 119, 200, 0.4) 0%, rgba(0, 31, 63, 0.8) 100%);
            z-index: -1;
        }

        /* Main Container - 70/30 Split */
        .neural-container {
            display: grid;
            grid-template-columns: 1.8fr 1fr; /* Stretches Data Pipeline */
            gap: 20px;
            padding: 40px 2%;
            max-width: 1800px;
            margin: 0 auto;
        }

        .game-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            padding: 25px;
            backdrop-filter: blur(10px);
            text-align: center;
        }

        .game-title { color: var(--brand-green); letter-spacing: 2px; font-weight: 800; margin-bottom: 5px; }
        .status-text { color: var(--brand-gold); font-size: 0.8rem; margin-bottom: 20px; text-transform: uppercase; }

        /* Retro Board Grid */
        .snakes-grid {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            width: 100%;
            border: 5px solid #111;
            margin-bottom: 20px;
        }

        .s-cell {
            aspect-ratio: 1/1;
            border: 1px solid rgba(0,0,0,0.1);
            display: flex; align-items: center; justify-content: center;
            font-weight: bold; font-size: 0.9rem; color: #333;
            position: relative;
        }

        /* Colors based on your mockup */
        .s-cell:nth-child(4n+1) { background: #ff6b6b; } 
        .s-cell:nth-child(4n+2) { background: #4ecdc4; } 
        .s-cell:nth-child(4n+3) { background: #ffe66d; } 
        .s-cell:nth-child(4n+4) { background: #ff9ff3; }

        .special-icon { position: absolute; font-size: 1.4rem; opacity: 0.5; pointer-events: none; }
        
        .player-pawn {
            width: 30px; height: 30px;
            background: white; border: 3px solid #000;
            border-radius: 50%; position: absolute; z-index: 5;
            transition: all 0.4s ease-in-out;
        }

        .btn-action {
            background: transparent; border: 2px solid var(--brand-green);
            color: white; padding: 10px 30px; border-radius: 20px;
            cursor: pointer; font-weight: bold; text-transform: uppercase;
        }

        .btn-action:hover { background: var(--brand-green); color: black; }

        /* Tic-Tac-Toe Grid */
        .ttt-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; max-width: 300px; margin: 0 auto 20px; }
        .ttt-cell {
            aspect-ratio: 1/1; background: rgba(255,255,255,0.03);
            border: 1px solid var(--glass-border); border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 2rem; cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="video-overlay"></div>
    <?php include 'header.php'; ?>

    <main class="neural-container">
        <div class="game-card">
            <h2 class="game-title">DATA PIPELINE</h2>
            <div id="snakes-status" class="status-text">Initializing Nodes...</div>
            <div id="snakes-board" class="snakes-grid"></div>
            <button class="btn-action" onclick="rollDice()">Execute Roll</button>
        </div>

        <div class="game-card">
            <h2 class="game-title">NEURAL LOGIC</h2>
            <div id="ttt-status" class="status-text">Your Turn (X)</div>
            <div class="ttt-grid" id="ttt-board">
                </div>
            <button class="btn-action" onclick="resetTTT()">Reset Logic</button>
        </div>
    </main>

    <script>
        const shortcuts = {
            2:38, 7:14, 8:31, 15:26, 16:6, 21:42, 28:84, 36:44, 46:25, 49:11, 51:67, 
            62:19, 64:60, 71:91, 74:53, 78:98, 87:94, 89:68, 92:88, 95:75, 99:80
        };

        function initBoard() {
            const board = document.getElementById('snakes-board');
            for (let i = 100; i >= 1; i--) {
                const cell = document.createElement('div');
                cell.className = 's-cell';
                cell.id = `cell-${i}`;
                cell.innerText = i;
                if (shortcuts[i]) {
                    const icon = document.createElement('span');
                    icon.className = 'special-icon';
                    icon.innerHTML = shortcuts[i] > i ? '🪜' : '🐍';
                    cell.appendChild(icon);
                }
                board.appendChild(cell);
            }
            placePawn(1);
        }

        let currentPos = 1;
        function placePawn(pos) {
            const oldPawn = document.querySelector('.player-pawn');
            if (oldPawn) oldPawn.remove();
            const pawn = document.createElement('div');
            pawn.className = 'player-pawn';
            document.getElementById(`cell-${pos}`).appendChild(pawn);
        }

        function rollDice() {
            const roll = Math.floor(Math.random() * 6) + 1;
            document.getElementById('snakes-status').innerText = `System Rolled: ${roll}`;
            currentPos += roll;
            if (currentPos >= 100) currentPos = 100;
            if (shortcuts[currentPos]) currentPos = shortcuts[currentPos];
            setTimeout(() => placePawn(currentPos), 300);
        }

        initBoard();
        // Tic-Tac-Toe JS logic remains standard...
    </script>
</body>
</html>
