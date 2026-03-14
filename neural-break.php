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
            --glass-bg: rgba(255, 255, 255, 0.03); /* Lighter for Image 1 effect */
            --glass-border: rgba(255, 255, 255, 0.08);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--brand-blue-dark);
            color: white;
            overflow: hidden; 
            height: 100vh;
            display: flex;
            flex-direction: column; /* Stack: Header -> Main -> Ticker */
        }

        /* --- VIDEO BACKGROUND --- */
        .video-container {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -2;
        }
        #bg-video {
            min-width: 100%; min-height: 100%; position: absolute; top: 50%; left: 50%; 
            transform: translate(-50%, -50%); object-fit: cover;
        }
        .video-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle, rgba(0, 119, 200, 0.2) 0%, rgba(0, 31, 63, 0.85) 100%);
            z-index: -1;
        }

        /* --- MAIN CONTENT AREA (Image 1 Effect) --- */
        .neural-container {
            display: flex;
            flex: 1; /* Fills space between Image 2 (Header) and Image 3 (Ticker) */
            align-items: center; 
            justify-content: flex-start;
            padding: 0 5%;
            gap: 30px;
        }

        .game-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            padding: 20px;
            backdrop-filter: blur(8px); /* Image 1 soft glass effect */
            text-align: center;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .pipeline-card { width: 520px; }
        .logic-card { width: 340px; }

        .game-title { color: var(--brand-green); font-size: 1.2rem; letter-spacing: 2px; margin-bottom: 5px; text-transform: uppercase; }
        .status-text { color: var(--brand-gold); font-size: 0.75rem; margin-bottom: 12px; font-weight: bold; }

        /* --- BOARD GRID (Matching Image 1 Colors) --- */
        .snakes-grid {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            width: 100%;
            border: 2px solid #000;
            margin-bottom: 15px;
            background: #111;
        }

        .s-cell {
            aspect-ratio: 1/1;
            border: 0.5px solid rgba(0,0,0,0.1);
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 0.75rem; color: #222;
            position: relative;
        }

        /* Colors sequence: Red, Teal, Yellow, Pink */
        .s-cell:nth-child(4n+1) { background: #ff6b6b; } 
        .s-cell:nth-child(4n+2) { background: #4ecdc4; } 
        .s-cell:nth-child(4n+3) { background: #ffe66d; } 
        .s-cell:nth-child(4n+4) { background: #ff9ff3; }

        .player-pawn {
            width: 18px; height: 18px;
            background: white; border: 2px solid #000;
            border-radius: 50%; position: absolute; z-index: 10;
        }

        /* --- TIC TAC TOE --- */
        .ttt-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; max-width: 220px; margin: 0 auto 15px; }
        .ttt-cell {
            aspect-ratio: 1/1; background: rgba(255,255,255,0.03);
            border: 1px solid var(--glass-border); border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.8rem; cursor: pointer; color: var(--brand-gold);
        }

        .btn-action {
            background: transparent; border: 1.5px solid var(--brand-green);
            color: white; padding: 8px 20px; border-radius: 20px;
            cursor: pointer; font-size: 0.8rem; font-weight: bold; text-transform: uppercase;
        }

        /* --- TICKER (Image 3 Area) --- */
        .ticker-wrapper {
            height: 40px; background: rgba(0, 15, 30, 0.9);
            border-top: 1px solid var(--glass-border);
            display: flex; align-items: center; overflow: hidden;
        }
        .ticker-track { display: flex; animation: scrollText 25s linear infinite; width: max-content; }
        .ticker-item { padding: 0 30px; font-size: 0.7rem; color: #aaa; }
        .ticker-item i { color: var(--brand-green); margin-right: 8px; }

        @keyframes scrollText { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
    </style>
</head>
<body>

    <div class="video-container">
        <video id="bg-video" autoplay loop muted playsinline>
            <source src="/assets/video/WebsiteVideo.mp4" type="video/mp4">
        </video>
    </div>
    <div class="video-overlay"></div>

    <?php include 'header.php'; ?>

    <main class="neural-container">
        <div class="game-card pipeline-card">
            <h2 class="game-title">DATA PIPELINE</h2>
            <div id="snakes-status" class="status-text">INITIALIZING NODES...</div>
            <div id="snakes-board" class="snakes-grid"></div>
            <button class="btn-action" onclick="rollDice()">Execute Roll</button>
        </div>

        <div class="game-card logic-card">
            <h2 class="game-title">NEURAL LOGIC</h2>
            <div id="ttt-status" class="status-text">USER TURN (X)</div>
            <div class="ttt-grid" id="ttt-board">
                <?php for($i=0; $i<9; $i++) echo "<div class='ttt-cell' onclick='markCell($i)'></div>"; ?>
            </div>
            <button class="btn-action" onclick="resetTTT()">Reset Logic</button>
        </div>
    </main>

    <div class="ticker-wrapper">
        <div class="ticker-track">
            <div class="ticker-item"><i class="fas fa-microchip"></i> NEURAL ENGINE ACTIVE</div>
            <div class="ticker-item"><i class="fas fa-database"></i> AZURE SQL LINK STABLE</div>
            <div class="ticker-item"><i class="fas fa-shield-alt"></i> SOURCE CONTROL V1.0.2</div>
            <div class="ticker-item"><i class="fas fa-microchip"></i> NEURAL ENGINE ACTIVE</div>
            <div class="ticker-item"><i class="fas fa-database"></i> AZURE SQL LINK STABLE</div>
        </div>
    </div>

    <script>
        function initBoard() {
            const board = document.getElementById('snakes-board');
            for (let i = 100; i >= 1; i--) {
                const cell = document.createElement('div');
                cell.className = 's-cell';
                cell.id = `cell-${i}`;
                cell.innerText = i;
                board.appendChild(cell);
            }
            updatePawn(1);
        }

        let currentPos = 1;
        function updatePawn(pos) {
            const old = document.querySelector('.player-pawn');
            if (old) old.remove();
            const pawn = document.createElement('div');
            pawn.className = 'player-pawn';
            document.getElementById(`cell-${pos}`).appendChild(pawn);
        }

        function rollDice() {
            const roll = Math.floor(Math.random() * 6) + 1;
            document.getElementById('snakes-status').innerText = `EXECUTED ROLL: ${roll}`;
            currentPos += roll;
            if (currentPos >= 100) currentPos = 100;
            updatePawn(currentPos);
        }

        function markCell(idx) {
            const cells = document.querySelectorAll('.ttt-cell');
            if(!cells[idx].innerText) cells[idx].innerText = 'X';
        }

        function resetTTT() {
            document.querySelectorAll('.ttt-cell').forEach(c => c.innerText = '');
        }

        initBoard();
    </script>
</body>
</html>
