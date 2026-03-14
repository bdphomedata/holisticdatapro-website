<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neural Break | Holistic Data Pro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* --- BRAND VARIABLES --- */
        :root {
            --brand-blue-light: #0077c8;
            --brand-blue-dark: #001f3f;
            --brand-gold: #ffc629;
            --brand-green: #4ade80;
            --text-white: #ffffff;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-white);
            background: var(--brand-blue-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* --- VIDEO BACKGROUND --- */
        .video-container { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -2; overflow: hidden; }
        #bg-video { min-width: 100%; min-height: 100%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); object-fit: cover; }
        .video-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(0, 119, 200, 0.7) 0%, rgba(0, 31, 63, 0.9) 100%); z-index: -1; }

        /* --- DASHBOARD LAYOUT --- */
        .neural-header { text-align: center; padding: 40px 0 10px; }
        .neural-header h1 { font-size: 2.5rem; text-transform: uppercase; letter-spacing: 4px; }

        .neural-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            padding: 20px 5% 60px;
            max-width: 1400px;
            margin: 0 auto;
            align-items: start;
            flex: 1;
        }

        .game-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 25px;
            backdrop-filter: blur(15px);
            text-align: center;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
        }

        .game-title {
            font-size: 1rem;
            font-weight: 800;
            color: var(--brand-green);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 15px;
            border-bottom: 1px solid rgba(74, 222, 128, 0.2);
            padding-bottom: 8px;
        }

        .status-text { font-size: 0.8rem; color: var(--brand-gold); font-weight: 700; margin-bottom: 20px; min-height: 1.2rem; }

        /* --- TIC TAC TOE GRID --- */
        .ttt-grid {
            display: grid;
            grid-template-columns: repeat(3, 90px);
            grid-gap: 10px;
            justify-content: center;
            margin-bottom: 20px;
        }
        .cell {
            width: 90px; height: 90px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 2rem; font-weight: 900; cursor: pointer; transition: 0.2s;
        }
        .cell:hover { background: rgba(74, 222, 128, 0.1); border-color: var(--brand-green); }
        .cell.x { color: var(--brand-gold); }
        .cell.o { color: var(--brand-green); }

        /* --- SNAKES & LADDERS BOARD --- */
        .snakes-grid {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            border: 1px solid rgba(74, 222, 128, 0.3);
            width: 100%;
            max-width: 400px;
            margin: 0 auto 20px;
        }
        .s-cell {
            aspect-ratio: 1/1;
            border: 1px solid rgba(255,255,255,0.05);
            font-size: 0.5rem;
            display: flex; align-items: center; justify-content: center;
            position: relative; color: rgba(255,255,255,0.3);
        }
        .player-pawn {
            width: 15px; height: 15px;
            background: var(--brand-gold);
            border-radius: 50%;
            position: absolute; z-index: 10;
            box-shadow: 0 0 10px var(--brand-gold);
            transition: all 0.4s ease-in-out;
        }
        .ladder-cell { color: var(--brand-green) !important; font-weight: bold; }
        .snake-cell { color: #ff4a4a !important; font-weight: bold; }

        /* --- 3D DICE --- */
        .dice-scene { width: 50px; height: 50px; perspective: 300px; margin: 20px auto; cursor: pointer; }
        .dice { width: 100%; height: 100%; position: relative; transform-style: preserve-3d; transition: transform 0.8s ease; }
        .dice-face {
            position: absolute; width: 50px; height: 50px;
            background: rgba(255, 255, 255, 0.1); border: 1px solid var(--brand-green);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; font-weight: bold; color: var(--brand-gold);
            backdrop-filter: blur(5px);
        }
        .face-1 { transform: rotateY(0deg) translateZ(25px); }
        .face-2 { transform: rotateY(90deg) translateZ(25px); }
        .face-3 { transform: rotateY(180deg) translateZ(25px); }
        .face-4 { transform: rotateY(-90deg) translateZ(25px); }
        .face-5 { transform: rotateX(90deg) translateZ(25px); }
        .face-6 { transform: rotateX(-90deg) translateZ(25px); }

        .roll-1 { transform: rotateX(0deg) rotateY(0deg); }
        .roll-2 { transform: rotateX(0deg) rotateY(-90deg); }
        .roll-3 { transform: rotateX(0deg) rotateY(-180deg); }
        .roll-4 { transform: rotateX(0deg) rotateY(90deg); }
        .roll-5 { transform: rotateX(-90deg) rotateY(0deg); }
        .roll-6 { transform: rotateX(90deg) rotateY(0deg); }

        .reboot-btn {
            background: transparent; border: 2px solid var(--brand-green); color: white;
            padding: 10px 25px; border-radius: 50px; font-weight: 800; font-size: 0.7rem;
            text-transform: uppercase; cursor: pointer; transition: 0.3s;
        }
        .reboot-btn:hover { background: var(--brand-green); color: var(--brand-blue-dark); }

        /* --- TICKER & FOOTER --- */
        .ticker-wrapper { width: 100vw; height: 40px; background: rgba(0, 31, 63, 0.9); border-top: 1px solid rgba(74, 222, 128, 0.3); overflow: hidden; display: flex; align-items: center; }
        .ticker-track { display: flex; animation: scrollText 40s linear infinite; width: max-content; }
        .ticker-item { display: flex; align-items: center; padding: 0 30px; font-size: 0.7rem; text-transform: uppercase; }
        @keyframes scrollText { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        footer { padding: 15px; background: #000b1a; text-align: center; font-size: 0.65rem; color: rgba(255,255,255,0.4); }

        @media (max-width: 1000px) {
            .neural-container { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <div class="video-container">
        <video id="bg-video" autoplay loop muted playsinline>
            <source src="assets/video/WebsiteVideo.mp4" type="video/mp4">
        </video>
    </div>
    <div class="video-overlay"></div>

    <?php include 'header.php'; ?>

    <div class="neural-header">
        <h1>Neural Break</h1>
    </div>

    <main class="neural-container">
        
        <div class="game-card">
            <div class="game-title">Data Pipeline (Snakes & Ladders)</div>
            <div id="status-snakes" class="status-text">INITIALIZING PATHWAY...</div>
            
            <div class="snakes-grid" id="snakes-board"></div>

            <div class="dice-scene" id="dice-container" onclick="rollDice()">
                <div class="dice" id="dice">
                    <div class="dice-face face-1">1</div>
                    <div class="dice-face face-2">2</div>
                    <div class="dice-face face-3">3</div>
                    <div class="dice-face face-4">4</div>
                    <div class="dice-face face-5">5</div>
                    <div class="dice-face face-6">6</div>
                </div>
            </div>
            <button class="reboot-btn" onclick="rollDice()">Execute Roll</button>
        </div>

        <div class="game-card">
            <div class="game-title">Neural Logic (Tic Tac Toe)</div>
            <div id="status-ttt" class="status-text">HUMAN INPUT REQUIRED (X)</div>
            
            <div class="ttt-grid">
                <div class="cell" onclick="handleTTTClick(0)"></div>
                <div class="cell" onclick="handleTTTClick(1)"></div>
                <div class="cell" onclick="handleTTTClick(2)"></div>
                <div class="cell" onclick="handleTTTClick(3)"></div>
                <div class="cell" onclick="handleTTTClick(4)"></div>
                <div class="cell" onclick="handleTTTClick(5)"></div>
                <div class="cell" onclick="handleTTTClick(6)"></div>
                <div class="cell" onclick="handleTTTClick(7)"></div>
                <div class="cell" onclick="handleTTTClick(8)"></div>
            </div>
            <button class="reboot-btn" onclick="resetTTT()">System Reboot</button>
        </div>

    </main>

    <div class="ticker-wrapper">
        <div class="ticker-track">
            <div class="ticker-item"><i class="fas fa-sync-alt"></i> Legacy Reverse Engineering</div>
            <div class="ticker-item"><i class="fas fa-infinity"></i> End-to-End Data Warehousing</div>
            <div class="ticker-item"><i class="fas fa-network-wired"></i> Scalable Data Integration</div>
            <div class="ticker-item"><i class="fas fa-microchip"></i> High-Performance T-SQL</div>
            <div class="ticker-item"><i class="fas fa-sync-alt"></i> Legacy Reverse Engineering</div>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 Holistic Data Pro. All rights reserved.</p>
    </footer>

    <script>
        /* --- TIC TAC TOE LOGIC --- */
        let tttBoard = ["", "", "", "", "", "", "", "", ""];
        let tttActive = true;
        const tttStatus = document.getElementById('status-ttt');

        function handleTTTClick(idx) {
            if (tttBoard[idx] !== "" || !tttActive) return;
            tttBoard[idx] = "X";
            updateTTT();
            if (checkTTTWin()) return;
            
            tttStatus.innerText = "SYSTEM ANALYZING...";
            setTimeout(computerTTT, 600);
        }

        function computerTTT() {
            let empty = tttBoard.map((v, i) => v === "" ? i : null).filter(v => v !== null);
            if (empty.length > 0) {
                let move = empty[Math.floor(Math.random() * empty.length)];
                tttBoard[move] = "O";
                updateTTT();
                if (!checkTTTWin()) tttStatus.innerText = "HUMAN INPUT REQUIRED (X)";
            }
        }

        function updateTTT() {
            const cells = document.querySelectorAll('.cell');
            tttBoard.forEach((v, i) => {
                cells[i].innerText = v;
                cells[i].className = 'cell ' + (v ? v.toLowerCase() : '');
            });
        }

        function checkTTTWin() {
            const wins = [[0,1,2],[3,4,5],[6,7,8],[0,3,6],[1,4,7],[2,5,8],[0,4,8],[2,4,6]];
            for (let w of wins) {
                if (tttBoard[w[0]] && tttBoard[w[0]] === tttBoard[w[1]] && tttBoard[w[0]] === tttBoard[w[2]]) {
                    tttStatus.innerText = "WINNER DETECTED: " + tttBoard[w[0]];
                    tttActive = false; return true;
                }
            }
            if (!tttBoard.includes("")) { tttStatus.innerText = "DATA STALEMATE."; tttActive = false; return true; }
            return false;
        }

        function resetTTT() {
            tttBoard = ["", "", "", "", "", "", "", "", ""];
            tttActive = true;
            tttStatus.innerText = "HUMAN INPUT REQUIRED (X)";
            updateTTT();
        }

        /* --- SNAKES & LADDERS LOGIC --- */
        let playerPos = 1;
        let isRolling = false;
        const snakesBoard = document.getElementById('snakes-board');
        const shortcuts = { 3:22, 5:8, 11:26, 20:29, 27:1, 21:9, 17:4, 29:19 }; // Sample shortcuts

        function createSnakesBoard() {
            for (let i = 100; i >= 1; i--) {
                let cell = document.createElement('div');
                cell.className = 's-cell';
                cell.id = 'scell-' + i;
                cell.innerText = i;
                if (shortcuts[i]) {
                    if (shortcuts[i] > i) cell.classList.add('ladder-cell');
                    else cell.classList.add('snake-cell');
                }
                snakesBoard.appendChild(cell);
            }
            updatePawn();
            document.getElementById('status-snakes').innerText = "SYSTEM READY: ROLL DICE";
        }

        function rollDice() {
            if (isRolling) return;
            isRolling = true;
            const res = Math.floor(Math.random() * 6) + 1;
            const dice = document.getElementById('dice');
            dice.className = 'dice roll-' + res;
            
            setTimeout(() => {
                playerPos += res;
                if (playerPos > 100) playerPos = 100;
                
                if (shortcuts[playerPos]) {
                    let isLadder = shortcuts[playerPos] > playerPos;
                    document.getElementById('status-snakes').innerText = isLadder ? "OPTIMIZING PATH..." : "DATA CORRUPTION!";
                    playerPos = shortcuts[playerPos];
                } else {
                    document.getElementById('status-snakes').innerText = "MOVED TO NODE " + playerPos;
                }
                
                updatePawn();
                if (playerPos === 100) document.getElementById('status-snakes').innerText = "DEPLOYMENT SUCCESS!";
                isRolling = false;
            }, 800);
        }

        function updatePawn() {
            const old = document.querySelector('.player-pawn');
            if (old) old.remove();
            const cell = document.getElementById('scell-' + playerPos);
            const pawn = document.createElement('div');
            pawn.className = 'player-pawn';
            cell.appendChild(pawn);
        }

        createSnakesBoard();
    </script>
</body>
</html>
