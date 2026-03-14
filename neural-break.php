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

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--brand-blue-dark);
            color: white;
            margin: 0;
            overflow: hidden; /* Critical: Stops the scrolling */
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* --- VIDEO BACKGROUND --- */
        .video-container {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -2; overflow: hidden;
        }
        #bg-video {
            min-width: 100%; min-height: 100%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); object-fit: cover;
        }
        .video-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, rgba(0, 119, 200, 0.4) 0%, rgba(0, 31, 63, 0.8) 100%);
            z-index: -1;
        }

        /* --- MAIN LAYOUT (STRETCHED 70/30) --- */
        .neural-container {
            display: grid;
            grid-template-columns: 1.8fr 1fr; 
            gap: 25px;
            padding: 20px 3%;
            max-width: 1800px;
            margin: 0 auto;
            flex: 1;
            align-items: center; /* Centers cards vertically in the viewport */
        }

        .game-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 25px;
            backdrop-filter: blur(15px);
            text-align: center;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
        }

        .game-title { color: var(--brand-green); letter-spacing: 3px; font-weight: 800; margin-bottom: 5px; text-transform: uppercase; }
        .status-text { color: var(--brand-gold); font-size: 0.85rem; margin-bottom: 20px; text-transform: uppercase; font-weight: bold; }

        /* --- DATA PIPELINE BOARD --- */
        .snakes-grid {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            width: 100%;
            border: 5px solid #111;
            margin-bottom: 20px;
            background: #222;
        }

        .s-cell {
            aspect-ratio: 1/1;
            border: 1px solid rgba(0,0,0,0.2);
            display: flex; align-items: center; justify-content: center;
            font-weight: 900; font-size: 1rem; color: #333;
            position: relative;
        }

        /* Color sequence from mockup */
        .s-cell:nth-child(4n+1) { background: #ff6b6b; } 
        .s-cell:nth-child(4n+2) { background: #4ecdc4; } 
        .s-cell:nth-child(4n+3) { background: #ffe66d; } 
        .s-cell:nth-child(4n+4) { background: #ff9ff3; }

        .player-pawn {
            width: 30px; height: 30px;
            background: white; border: 4px solid #000;
            border-radius: 50%; position: absolute; z-index: 10;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* --- NEURAL LOGIC GRID --- */
        .ttt-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; max-width: 300px; margin: 0 auto 20px; }
        .ttt-cell {
            aspect-ratio: 1/1; background: rgba(255,255,255,0.05);
            border: 1px solid var(--glass-border); border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 2.5rem; cursor: pointer; color: var(--brand-gold);
        }

        .btn-action {
            background: transparent; border: 2.5px solid var(--brand-green);
            color: white; padding: 12px 35px; border-radius: 25px;
            cursor: pointer; font-weight: bold; text-transform: uppercase;
            transition: 0.3s;
        }
        .btn-action:hover { background: var(--brand-green); color: var(--brand-blue-dark); }

        /* --- TICKER --- */
        .ticker-wrapper {
            width: 100vw; height: 45px; background: rgba(0, 31, 63, 0.95);
            border-top: 1px solid rgba(74, 222, 128, 0.3);
            overflow: hidden; display: flex; align-items: center;
        }
        .ticker-track { display: flex; animation: scrollText 30s linear infinite; width: max-content; }
        .ticker-item { display: flex; align-items: center; padding: 0 40px; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; }
        .ticker-item i { color: var(--brand-green); margin-right: 12px; }

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
        <div class="game-card">
            <h2 class="game-title">DATA PIPELINE</h2>
            <div id="snakes-status" class="status-text">SYSTEM STANDBY... AWAITING EXECUTION</div>
            <div id="snakes-board" class="snakes-grid"></div>
            <button class="btn-action" onclick="rollDice()">Execute Roll</button>
        </div>

        <div class="game-card">
            <h2 class="game-title">NEURAL LOGIC</h2>
            <div id="ttt-status" class="status-text">USER TURN (X)</div>
            <div class="ttt-grid" id="ttt-board">
                <div class="ttt-cell" onclick="markCell(0)"></div>
                <div class="ttt-cell" onclick="markCell(1)"></div>
                <div class="ttt-cell" onclick="markCell(2)"></div>
                <div class="ttt-cell" onclick="markCell(3)"></div>
                <div class="ttt-cell" onclick="markCell(4)"></div>
                <div class="ttt-cell" onclick="markCell(5)"></div>
                <div class="ttt-cell" onclick="markCell(6)"></div>
                <div class="ttt-cell" onclick="markCell(7)"></div>
                <div class="ttt-cell" onclick="markCell(8)"></div>
            </div>
            <button class="btn-action" onclick="resetTTT()">Reset Logic</button>
        </div>
    </main>

    <div class="ticker-wrapper">
        <div class="ticker-track">
            <div class="ticker-item"><i class="fas fa-check-circle"></i> NEURAL ENGINE ACTIVE</div>
            <div class="ticker-item"><i class="fas fa-server"></i> AZURE SQL LINK STABLE</div>
            <div class="ticker-item"><i class="fas fa-code-branch"></i> REPOSITORY V1.0.2</div>
            <div class="ticker-item"><i class="fas fa-check-circle"></i> NEURAL ENGINE ACTIVE</div>
            <div class="ticker-item"><i class="fas fa-server"></i> AZURE SQL LINK STABLE</div>
        </div>
    </div>

    <script>
        // Board Logic
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
