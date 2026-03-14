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
            overflow-x: hidden;
        }

        /* --- VIDEO BACKGROUND --- */
        .video-container { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -2; overflow: hidden; }
        #bg-video { min-width: 100%; min-height: 100%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); object-fit: cover; }
        .video-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(0, 119, 200, 0.7) 0%, rgba(0, 31, 63, 0.9) 100%); z-index: -1; }

        .neural-header { text-align: center; padding: 30px 0 10px; }
        .neural-header h1 { font-size: 2.2rem; text-transform: uppercase; letter-spacing: 4px; }

        /* --- STRETCHED LAYOUT --- */
        .neural-container {
            display: grid;
            grid-template-columns: 1.5fr 1fr; /* Stretches the left side */
            gap: 20px;
            padding: 20px 3%;
            max-width: 1800px; /* Wider container for the stretch */
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
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .game-title { color: var(--brand-green); text-transform: uppercase; font-weight: 800; margin-bottom: 15px; font-size: 1rem; }
        .status-text { font-size: 0.9rem; color: var(--brand-gold); margin-bottom: 15px; height: 1.5rem; font-weight: bold; }

        /* --- FULL-WIDTH SNAKES BOARD --- */
        .snakes-grid {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            width: 100%;
            max-width: none; /* Allows it to fill the card */
            margin: 0 auto 20px;
            border: 4px solid #222;
        }
        .s-cell {
            aspect-ratio: 1/1;
            border: 1px solid rgba(0,0,0,0.1);
            font-size: clamp(0.6rem, 1vw, 0.9rem); /* Responsive text size */
            font-weight: bold;
            display: flex; align-items: center; justify-content: center;
            position: relative; color: #333;
        }

        .s-cell:nth-child(4n+1) { background: #ff6b6b; } 
        .s-cell:nth-child(4n+2) { background: #4ecdc4; } 
        .s-cell:nth-child(4n+3) { background: #ffe66d; } 
        .s-cell:nth-child(4n+4) { background: #ff9ff3; } 

        .special-icon { position: absolute; font-size: 1.5rem; opacity: 0.6; pointer-events: none; }
        .player-pawn {
            width: 60%; height: 60%;
            background: white; border: 3px solid var(--brand-blue-dark);
            border-radius: 50%; position: absolute; z-index: 10;
            box-shadow: 0 4px 10px rgba(0,0,0,0.5);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* --- TIC TAC TOE --- */
        .ttt-grid { display: grid; grid-template-columns: repeat(3, 100px); gap: 15px; justify-content: center; margin-bottom: 20px; }
        .cell {
            width: 100px; height: 100px; background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border); border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 2.5rem; font-weight: 900; cursor: pointer;
        }

        .reboot-btn {
            background: transparent; border: 2px solid var(--brand-green); color: white;
            padding: 12px 30px; border-radius: 50px; font-weight: 800; font-size: 0.8rem;
            text-transform: uppercase; cursor: pointer; transition: 0.3s;
            align-self: center;
        }
        .reboot-btn:hover { background: var(--brand-green); color: var(--brand-blue-dark); }

        @media (max-width: 1100px) { 
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
            <div class="game-title">Data Pipeline</div>
            <div id="status-snakes" class="status-text">INITIALIZING NODES...</div>
            <div class="snakes-grid" id="snakes-board"></div>
            <button class="reboot-btn" onclick="rollDice()">Execute Roll</button>
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
        /* --- LOGIC REMAINS THE SAME --- */
        let playerPos = 1;
        let isRolling = false;
        const shortcuts = {
            2: 38, 7: 14, 8: 31, 15: 26, 21: 42, 28: 84, 36: 44, 51: 67, 71: 91, 78: 98, 87: 94,
            16: 6, 46: 25, 49: 11, 62: 19, 64: 60, 74: 53, 89: 68, 92: 88, 95: 75, 99: 80
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
            document.getElementById('status-snakes').innerText = "SYSTEM ROLLED: " + res;
            
            setTimeout(() => {
                playerPos += res;
                if (playerPos >= 100) { playerPos = 100; document.getElementById('status-snakes').innerText = "PIPELINE COMPLETE!"; }
                if (shortcuts[playerPos]) playerPos = shortcuts[playerPos];
                updatePawn();
                isRolling = false;
            }, 600);
        }

        function updatePawn() {
            const old = document.querySelector('.player-pawn');
            if (old) old.remove();
            const pawn = document.createElement('div');
            pawn.className = 'player-pawn';
            document.getElementById('scell-' + playerPos).appendChild(pawn);
        }

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
            if (!ttt.includes("")) { document.getElementById('status-ttt').innerText = "STALEMATE"; return true; }
            return false;
        }
        function resetTTT() { ttt = Array(9).fill(""); active = true; renderTTT(); document.getElementById('status-ttt').innerText = "YOUR TURN (X)"; }

        createBoard();
    </script>
</body>
</html>
