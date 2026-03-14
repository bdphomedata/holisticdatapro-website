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
            min-height: 100vh;
        }

        /* Video Background Logic */
        .video-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, rgba(0, 119, 200, 0.4) 0%, rgba(0, 31, 63, 0.8) 100%);
            z-index: -1;
        }

        /* --- NAVIGATION BAR FIX --- */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 5%;
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
        }

        .nav-links {
            display: flex;
            gap: 20px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 0.85rem;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: var(--brand-green);
        }

        /* --- MAIN CONTENT --- */
        .neural-container {
            display: grid;
            grid-template-columns: 1.8fr 1fr; /* Stretches Data Pipeline */
            gap: 25px;
            padding: 40px 3%;
            max-width: 1850px;
            margin: 0 auto;
        }

        .game-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 30px;
            backdrop-filter: blur(15px);
            text-align: center;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
        }

        .game-title { color: var(--brand-green); letter-spacing: 3px; font-weight: 800; margin-bottom: 5px; }
        .status-text { color: var(--brand-gold); font-size: 0.85rem; margin-bottom: 25px; text-transform: uppercase; font-weight: bold; }

        /* Retro Board Grid */
        .snakes-grid {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            width: 100%;
            border: 6px solid #111;
            margin-bottom: 25px;
            background: #222;
        }

        .s-cell {
            aspect-ratio: 1/1;
            border: 1px solid rgba(0,0,0,0.2);
            display: flex; align-items: center; justify-content: center;
            font-weight: 900; font-size: 1.1rem; color: #333;
            position: relative;
        }

        /* Colors matching the board mockup */
        .s-cell:nth-child(4n+1) { background: #ff6b6b; } 
        .s-cell:nth-child(4n+2) { background: #4ecdc4; } 
        .s-cell:nth-child(4n+3) { background: #ffe66d; } 
        .s-cell:nth-child(4n+4) { background: #ff9ff3; }

        .special-icon { position: absolute; font-size: 1.8rem; opacity: 0.6; pointer-events: none; }
        
        .player-pawn {
            width: 35px; height: 35px;
            background: white; border: 4px solid #000;
            border-radius: 50%; position: absolute; z-index: 10;
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 4px 8px rgba(0,0,0,0.5);
        }

        .btn-action {
            background: transparent; border: 2.5px solid var(--brand-green);
            color: white; padding: 12px 40px; border-radius: 30px;
            cursor: pointer; font-weight: 900; text-transform: uppercase;
            letter-spacing: 1px; transition: 0.3s;
        }

        .btn-action:hover { background: var(--brand-green); color: var(--brand-blue-dark); transform: scale(1.05); }

        /* Tic-Tac-Toe Grid */
        .ttt-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; max-width: 320px; margin: 0 auto 25px; }
        .ttt-cell {
            aspect-ratio: 1/1; background: rgba(255,255,255,0.04);
            border: 1px solid var(--glass-border); border-radius: 15px;
            display: flex; align-items: center; justify-content: center;
            font-size: 2.5rem; cursor: pointer; transition: 0.2s;
        }
        .ttt-cell:hover { background: rgba(255,255,255,0.1); }
    </style>
</head>
<body>
    <div class="video-overlay"></div>

    <nav>
        <div class="logo" style="font-weight: 900; letter-spacing: 2px;">HOLISTIC DATA PRO</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="solutions.php">Solutions</a></li>
            <li><a href="neural-break.php" style="color: var(--brand-green);">Neural Break</a></li>
            <li><a href="connect.php">Connect</a></li>
        </ul>
    </nav>

    <main class="neural-container">
        <div class="game-card">
            <h2 class="game-title">DATA PIPELINE</h2>
            <div id="snakes-status" class="status-text">SYSTEM READY... INITIALIZING NODES</div>
            <div id="snakes-board" class="snakes-grid"></div>
            <button class="btn-action" onclick="rollDice()">Execute Roll</button>
        </div>

        <div class="game-card">
            <h2 class="game-title">NEURAL LOGIC</h2>
            <div id="ttt-status" class="status-text">Awaiting User Input (X)</div>
            <div class="ttt-grid" id="ttt-board">
                <div class="ttt-cell" onclick="playTTT(0)"></div>
                <div class="ttt-cell" onclick="playTTT(1)"></div>
                <div class="ttt-cell" onclick="playTTT(2)"></div>
                <div class="ttt-cell" onclick="playTTT(3)"></div>
                <div class="ttt-cell" onclick="playTTT(4)"></div>
                <div class="ttt-cell" onclick="playTTT(5)"></div>
                <div class="ttt-cell" onclick="playTTT(6)"></div>
                <div class="ttt-cell" onclick="playTTT(7)"></div>
                <div class="ttt-cell" onclick="playTTT(8)"></div>
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
            if (currentPos >= 100) {
                currentPos = 100;
                document.getElementById('snakes-status').innerText = "DATA PIPELINE COMPLETE!";
            }
            if (shortcuts[currentPos]) currentPos = shortcuts[currentPos];
            setTimeout(() => placePawn(currentPos), 400);
        }

        initBoard();

        // Simple TTT Logic for display
        function playTTT(index) {
            const cells = document.querySelectorAll('.ttt-cell');
            if (!cells[index].innerText) {
                cells[index].innerText = 'X';
                cells[index].style.color = 'var(--brand-gold)';
            }
        }
        function resetTTT() {
            document.querySelectorAll('.ttt-cell').forEach(c => c.innerText = '');
        }
    </script>
</body>
</html>
