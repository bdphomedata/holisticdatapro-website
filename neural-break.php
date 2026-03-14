<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neural Break | Holistic Data Pro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* --- GLOBAL BRAND STYLES --- */
        :root {
            --brand-blue-light: #0077c8;
            --brand-blue-dark: #001f3f;
            --brand-gold: #ffc629;
            --brand-green: #4ade80;
            --text-white: #ffffff;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --cyan-glow: #00f2ff;
            --green-glow: #39ff14;
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

        /* --- NAVIGATION (Matches Index) --- */
        nav {
            width: 100%;
            padding: 0.8rem 3%;
            background: rgba(0, 31, 63, 0.4);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid var(--glass-border);
            z-index: 1000;
        }

        .nav-container {
            max-width: 1600px; margin: 0 auto;
            display: flex; justify-content: space-between; align-items: center;
            flex-wrap: wrap; gap: 15px;
        }

        .nav-left-group { display: flex; align-items: center; gap: 40px; }

        .logo-static { 
            font-size: 1.8rem; font-weight: 900; letter-spacing: 4px; text-transform: uppercase;
            background: linear-gradient(to bottom, #fff 0%, #e0e0e0 45%, var(--brand-green) 50%, #fff 55%, #b0b0b0 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            filter: drop-shadow(0px 1px 0px #ffffff) drop-shadow(0px 3px 5px rgba(0,0,0,0.8));
        }

        .nav-links { display: flex; gap: 20px; align-items: center; }
        .nav-links a, .nav-links .dropdown-label { 
            color: #ffffff !important; text-decoration: none; font-weight: 600; 
            font-size: 0.8rem; text-transform: uppercase; transition: 0.3s; opacity: 0.9; 
        }
        .nav-links a:hover { color: var(--brand-gold) !important; opacity: 1; }

        .nav-buttons { display: flex; gap: 10px; align-items: center; }
        .nav-btn-green { 
            text-decoration: none; padding: 6px 14px; border-radius: 50px; 
            border: 2px solid var(--brand-green); color: white !important; 
            font-weight: 700; font-size: 0.65rem; text-transform: uppercase; 
        }

        /* --- GAME LAYOUT & RESPONSIVENESS --- */
        .game-hero {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            text-align: center;
        }

        h1 {
            font-size: 2rem;
            color: var(--cyan-glow);
            text-shadow: 0 0 15px rgba(0, 242, 255, 0.5);
            text-transform: uppercase;
            letter-spacing: 4px;
            margin-bottom: 10px;
        }

        .status {
            font-size: 1.1rem;
            margin-bottom: 25px;
            color: var(--text-white);
            opacity: 0.8;
            font-weight: 300;
            letter-spacing: 1px;
        }

        .board {
            display: grid;
            grid-template-columns: repeat(3, min(100px, 25vw));
            grid-template-rows: repeat(3, min(100px, 25vw));
            gap: 15px;
            background: var(--glass-bg);
            padding: 20px;
            border-radius: 20px;
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
        }

        .cell {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: min(3rem, 12vw);
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .cell:hover { background: rgba(0, 242, 255, 0.05); border-color: var(--cyan-glow); }
        .cell.x { color: var(--cyan-glow); text-shadow: 0 0 20px var(--cyan-glow); }
        .cell.o { color: var(--brand-green); text-shadow: 0 0 20px var(--brand-green); }

        .reboot-btn {
            margin-top: 30px;
            padding: 12px 30px;
            background: transparent;
            color: var(--brand-green);
            border: 1px solid var(--brand-green);
            border-radius: 50px;
            font-weight: 800;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.3s;
            letter-spacing: 1px;
        }

        .reboot-btn:hover {
            background: rgba(74, 222, 128, 0.1);
            box-shadow: 0 0 20px rgba(74, 222, 128, 0.3);
        }

        footer { padding: 20px; background: #000b1a; text-align: center; font-size: 0.65rem; color: rgba(255,255,255,0.4); }

        @media (max-width: 768px) {
            .nav-container { justify-content: center; }
            .nav-left-group { flex-direction: column; gap: 5px; }
            .logo-static { font-size: 1.4rem; }
            h1 { font-size: 1.4rem; }
        }
    </style>
</head>
<body>

    <nav>
        <div class="nav-container">
            <div class="nav-left-group">
                <span class="logo-static">HOLISTIC DATA PRO</span>
                <div class="nav-links">
                    <a href="solutions.html">SOLUTIONS</a>
                    <a href="neural-break.php" style="color: var(--brand-gold) !important;"><i class="fas fa-brain"></i> NEURAL BREAK</a>
                </div>
            </div>
            <div class="nav-buttons">
                <a href="index.html" class="nav-btn-green">HOME</a>
                <a href="login.html" class="nav-btn-green">LOGIN</a>
            </div>
        </div>
    </nav>

    <div class="game-hero">
        <h1>Neural Break</h1>
        <div class="status" id="status">System Ready. Your Turn (X)</div>
        
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

        <button class="reboot-btn" onclick="resetGame()">System Reboot</button>
    </div>

    <footer>
        <p>&copy; 2026 Holistic Data Pro. All rights reserved.</p>
    </footer>

    <script>
        const boardElement = document.getElementById('board');
        const statusElement = document.getElementById('status');
        let board = ["", "", "", "", "", "", "", "", ""];
        let gameActive = true;

        const winPatterns = [
            [0,1,2], [3,4,5], [6,7,8], [0,3,6], [1,4,7], [2,5,8], [0,4,8], [2,4,6]
        ];

        function handleCellClick(e) {
            const idx = e.target.getAttribute('data-index');
            if (board[idx] !== "" || !gameActive) return;

            executeMove(idx, "X");
            if (gameActive) setTimeout(aiMove, 600);
        }

        function executeMove(idx, player) {
            board[idx] = player;
            const cell = document.querySelector(`[data-index='${idx}']`);
            cell.innerText = player;
            cell.classList.add(player.toLowerCase());
            validateGame();
        }

        function aiMove() {
            const available = board.map((v, i) => v === "" ? i : null).filter(v => v !== null);
            if (available.length > 0 && gameActive) {
                const move = available[Math.floor(Math.random() * available.length)];
                executeMove(move, "O");
            }
        }

        function validateGame() {
            let won = false;
            for (let p of winPatterns) {
                if (board[p[0]] && board[p[0]] === board[p[1]] && board[p[0]] === board[p[2]]) {
                    won = true; break;
                }
            }

            if (won) {
                statusElement.innerText = "Neural Logic Complete: Winner!";
                statusElement.style.color = "var(--brand-green)";
                gameActive = false;
            } else if (!board.includes("")) {
                statusElement.innerText = "Data Parity: It's a Draw!";
                gameActive = false;
            } else {
                statusElement.innerText = board.filter(x => x !== "").length % 2 === 0 ? "Your Turn (X)" : "Processing AI (O)...";
            }
        }

        function resetGame() {
            board = ["", "", "", "", "", "", "", "", ""];
            gameActive = true;
            statusElement.innerText = "System Ready. Your Turn (X)";
            statusElement.style.color = "white";
            document.querySelectorAll('.cell').forEach(c => {
                c.innerText = "";
                c.classList.remove('x', 'o');
            });
        }

        boardElement.addEventListener('click', handleCellClick);
    </script>
</body>
</html>
