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
            --text-white: #ffffff;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', sans-serif;
            color: var(--text-white);
            background: var(--brand-blue-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* --- VIDEO BACKGROUND --- */
        .video-container { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -2; overflow: hidden; }
        #bg-video { min-width: 100%; min-height: 100%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); object-fit: cover; }
        .video-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(0, 119, 200, 0.7) 0%, rgba(0, 31, 63, 0.9) 100%); z-index: -1; }

        .neural-header { text-align: center; padding: 30px 0 10px; }
        .neural-header h1 { font-size: 2.2rem; text-transform: uppercase; letter-spacing: 4px; }

        .neural-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            padding: 20px 5%;
            max-width: 1400px;
            margin: 0 auto;
            align-items: start;
            flex: 1;
        }

        .game-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 20px;
            backdrop-filter: blur(15px);
            text-align: center;
        }

        .game-title { color: var(--brand-green); text-transform: uppercase; font-weight: 800; margin-bottom: 15px; font-size: 0.9rem; }
        .status-text { font-size: 0.8rem; color: var(--brand-gold); margin-bottom: 15px; height: 1.2rem; font-weight: bold; }

        /* --- RETRO SNAKES BOARD --- */
        .snakes-grid {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            width: 100%;
            max-width: 450px;
            margin: 0 auto 20px;
            border: 4px solid #222;
        }
        .s-cell {
            aspect-ratio: 1/1;
            border: 1px solid rgba(0,0,0,0.1);
            font-size: 0.7rem;
            font-weight: bold;
            display: flex; align-items: center; justify-content: center;
            position: relative; color: #333;
        }

        /* Logic to mimic the image colors */
        .s-cell:nth-child(4n+1) { background: #ff6b6b; } /* Soft Red */
        .s-cell:nth-child(4n+2) { background: #4ecdc4; } /* Teal/Blue */
        .s-cell:nth-child(4n+3) { background: #ffe66d; } /* Yellow */
        .s-cell:nth-child(4n+4) { background: #ff9ff3; } /* Pink */

        .special-icon { position: absolute; font-size: 1.2rem; opacity: 0.6; pointer-events: none; }
        .player-pawn {
            width: 22px; height: 22px;
            background: white; border: 3px solid var(--brand-blue-dark);
            border-radius: 50%; position: absolute; z-index: 10;
            box-shadow: 0 4px 10px rgba(0,0,0,0.5);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* --- 3D DICE --- */
        .dice-scene { width: 50px; height: 50px; perspective: 300px; margin: 15px auto; cursor: pointer; }
        .dice { width: 100%; height: 100%; position: relative; transform-style: preserve-3d; transition: transform 0.8s ease; }
        .dice-face {
            position: absolute; width: 50px; height: 50px;
            background: white; border: 1px solid #333;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; font-weight: bold; color: #333;
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

        /* --- TIC TAC TOE --- */
        .ttt-grid { display: grid; grid-template-columns: repeat(3, 90px); gap: 10px; justify-content: center; margin-bottom: 20px; }
        .cell {
            width: 90px; height: 90px; background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border); border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 2rem; font-weight: 900; cursor: pointer;
        }
        .cell.x { color: var(--brand-gold); }
        .cell.o { color: var(--brand-green); }

        .reboot-btn {
            background: transparent; border: 2px solid var(--brand-green); color: white;
            padding: 8px 20px; border-radius: 50px; font-weight: 800; font-size: 0.7rem;
            cursor: pointer; transition: 0.3s;
        }
        .reboot-btn:hover { background: var(--brand-green); color: var(--brand-blue-dark); }

        @media (max-width: 1000px) { .neural-container { grid-template-columns: 1fr; } }
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
            <div class="game-title">Data Pipeline</div>
            <div id="status-snakes" class="status-text">CLICK DICE TO ROLL</div>
            <div class="snakes-grid" id="snakes-board"></div>
            <div class="dice-scene" onclick="rollDice()">
                <div class="dice" id="dice">
                    <div class="dice-face face-1">1</div>
                    <div class="dice-face face-2">2</div>
                    <div class="dice-face face-3">3</div>
                    <div class="dice-face face-4">4</div>
                    <div class="dice-face face-5">5</div>
                    <div class="dice-face face-6">6</div>
                </div>
            </div>
            <button class="reboot-btn" onclick="rollDice()">Roll Dice</button>
        </div>

        <div class="game-card">
            <div class="game-title">Neural Logic</div>
            <div id="status-ttt" class="status-text">YOUR TURN (X)</div>
            <div class="ttt-grid">
                <div class="cell" onclick="handleTTT(0)"></div>
                <div class="cell" onclick="handleTTT(1)"></div>
                <div class="cell" onclick="handleTTT(2)"></div>
                <div class="cell" onclick="handleTTT(3)"></div>
                <div class="cell" onclick="handleTTT(4)"></div>
                <div class="cell" onclick="handleTTT(5)"></div>
                <div class="cell" onclick="handleTTT(6)"></div>
                <div class="cell" onclick="handleTTT(7)"></div>
                <div class="cell" onclick="handleTTT(8)"></div>
            </div>
            <button class="reboot-btn" onclick="resetTTT()">Reset Logic</button>
        </div>
    </main>

    <script>
        /* --- SNAKES LOGIC (Aligned to Image) --- */
        let playerPos = 1;
        let isRolling = false;
        const shortcuts = {
            2: 38, 7: 14, 8: 31, 15: 26, 21: 42, 28: 84, 36: 44, 51: 67, 71: 91, 78: 98, 87: 94, // Ladders
            16: 6, 46: 25, 49: 11, 62: 19, 64: 60, 74: 53, 89: 68, 92: 88, 95: 75, 99: 80  // Snakes
        };

        function createBoard() {
            const board = document.getElementById('snakes-board');
            for (let i = 100; i >= 1; i--) {
                let cell = document.createElement('div');
                cell.className = 's-cell';
                cell.id = 'scell-' + i;
                cell.innerText = i;
                if (shortcuts[i]) {
                    let icon = document.createElement('span');
                    icon.className = 'special-icon';
                    icon.innerHTML = shortcuts[i] > i ? '🪜' : '🐍';
                    cell.appendChild(icon);
                }
                board.appendChild(cell);
            }
            updatePawn();
        }

        function rollDice() {
            if (isRolling) return;
            isRolling = true;
            const res = Math.floor(Math.random() * 6) + 1;
            document.getElementById('dice').className = 'dice roll-' + res;
            
            setTimeout(() => {
                playerPos += res;
                if (playerPos >= 100) { playerPos = 100; alert("Goal Reached!"); }
                if (shortcuts[playerPos]) playerPos = shortcuts[playerPos];
                updatePawn();
                isRolling = false;
            }, 800);
        }

        function updatePawn() {
            const old = document.querySelector('.player-pawn');
            if (old) old.remove();
            const pawn = document.createElement('div');
            pawn.className = 'player-pawn';
            document.getElementById('scell-' + playerPos).appendChild(pawn);
        }

        /* --- TTT LOGIC --- */
        let ttt = Array(9).fill("");
        let active = true;
        function handleTTT(i) {
            if (!active || ttt[i]) return;
            ttt[i] = "X"; renderTTT();
            if (!checkWin()) setTimeout(compTTT, 500);
        }
        function compTTT() {
            let empty = ttt.map((v, i) => v === "" ? i : null).filter(v => v !== null);
            if (empty.length) { ttt[empty[Math.floor(Math.random()*empty.length)]] = "O"; renderTTT(); checkWin(); }
        }
        function renderTTT() {
            const cells = document.querySelectorAll('.cell');
            ttt.forEach((v, i) => { cells[i].innerText = v; cells[i].className = 'cell ' + v.toLowerCase(); });
        }
        function checkWin() {
            const lines = [[0,1,2],[3,4,5],[6,7,8],[0,3,6],[1,4,7],[2,5,8],[0,4,8],[2,4,6]];
            for (let l of lines) {
                if (ttt[l[0]] && ttt[l[0]] === ttt[l[1]] && ttt[l[0]] === ttt[l[2]]) {
                    document.getElementById('status-ttt').innerText = "WINNER: " + ttt[l[0]];
                    active = false; return true;
                }
            }
            return false;
        }
        function resetTTT() { ttt = Array(9).fill(""); active = true; renderTTT(); document.getElementById('status-ttt').innerText = "YOUR TURN (X)"; }

        createBoard();
    </script>
</body>
</html>
