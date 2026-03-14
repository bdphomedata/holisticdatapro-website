<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neural Break | Holistic Data Pro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* --- BRAND VARIABLES & RESET --- */
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

        /* --- MAIN LAYOUT --- */
        .main-hero { 
            flex: 1; 
            padding: 40px 5%; 
            max-width: 1200px; 
            margin: 0 auto; 
            text-align: center; 
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            align-items: center;
        }

        h1 { font-size: 2.5rem; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 3px; }
        .status-text { font-size: 1rem; color: var(--brand-gold); font-weight: 700; margin-bottom: 30px; letter-spacing: 1px; }

        /* --- GAME PANEL (GLASS UI) --- */
        .game-container {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 40px;
            backdrop-filter: blur(15px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: 0.3s;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, 100px);
            grid-gap: 15px;
            margin-bottom: 30px;
        }

        .cell {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            font-weight: 900;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .cell:hover { background: rgba(74, 222, 128, 0.1); border-color: var(--brand-green); }
        .cell.x { color: var(--brand-gold); }
        .cell.o { color: var(--brand-green); }

        .reboot-btn {
            background: transparent;
            border: 2px solid var(--brand-green);
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 800;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.3s;
            letter-spacing: 1px;
        }
        .reboot-btn:hover { background: var(--brand-green); color: var(--brand-blue-dark); box-shadow: 0 0 20px rgba(74, 222, 128, 0.4); }

        /* --- TICKER --- */
        .ticker-wrapper { width: 100vw; height: 50px; background: rgba(0, 31, 63, 0.9); border-top: 1px solid rgba(74, 222, 128, 0.3); overflow: hidden; display: flex; align-items: center; }
        .ticker-track { display: flex; animation: scrollText 40s linear infinite; width: max-content; }
        .ticker-item { display: flex; align-items: center; padding: 0 30px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; }
        .ticker-item i { color: var(--brand-green); margin-right: 10px; }

        /* --- MOBILE ADAPTATION --- */
        @media (max-width: 768px) {
            h1 { font-size: 1.8rem; }
            .game-container { padding: 20px; transform: scale(0.9); }
            .grid { grid-template-columns: repeat(3, 85px); grid-gap: 10px; }
            .cell { width: 85px; height: 85px; font-size: 2rem; }
        }

        @keyframes scrollText { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        
        footer { padding: 15px; background: #000b1a; text-align: center; font-size: 0.65rem; color: rgba(255,255,255,0.4); }
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

    <main class="main-hero">
        <h1>Neural Break</h1>
        <div class="status-text" id="status">HUMAN INPUT REQUIRED (X)</div>

        <div class="game-container">
            <div class="grid">
                <div class="cell" onclick="handleCellClick(0)"></div>
                <div class="cell" onclick="handleCellClick(1)"></div>
                <div class="cell" onclick="handleCellClick(2)"></div>
                <div class="cell" onclick="handleCellClick(3)"></div>
                <div class="cell" onclick="handleCellClick(4)"></div>
                <div class="cell" onclick="handleCellClick(5)"></div>
                <div class="cell" onclick="handleCellClick(6)"></div>
                <div class="cell" onclick="handleCellClick(7)"></div>
                <div class="cell" onclick="handleCellClick(8)"></div>
            </div>
            <button class="reboot-btn" onclick="resetGame()">System Reboot</button>
        </div>
    </main>

    <div class="ticker-wrapper">
        <div class="ticker-track">
            <div class="ticker-item"><i class="fas fa-sync-alt"></i> Legacy Reverse Engineering</div>
            <div class="ticker-item"><i class="fas fa-infinity"></i> End-to-End Data Warehousing</div>
            <div class="ticker-item"><i class="fas fa-network-wired"></i> Scalable Data Integration</div>
            <div class="ticker-item"><i class="fas fa-cloud-upload-alt"></i> Cloud Data Migration</div>
            <div class="ticker-item"><i class="fas fa-sitemap"></i> Dimensional Data Modeling</div>
            <div class="ticker-item"><i class="fas fa-microchip"></i> High-Performance T-SQL</div>
            <div class="ticker-item"><i class="fas fa-sync-alt"></i> Legacy Reverse Engineering</div>
            <div class="ticker-item"><i class="fas fa-infinity"></i> End-to-End Data Warehousing</div>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 Holistic Data Pro. All rights reserved.</p>
    </footer>

    <script>
        let board = ["", "", "", "", "", "", "", "", ""];
        let gameActive = true;
        const statusDisplay = document.getElementById('status');

        function handleCellClick(index) {
            if (board[index] !== "" || !gameActive) return;
            
            board[index] = "X";
            updateBoard();
            checkResult();
            
            if (gameActive) {
                statusDisplay.innerText = "SYSTEM ANALYZING...";
                setTimeout(computerMove, 500);
            }
        }

        function computerMove() {
            let emptyCells = board.map((val, idx) => val === "" ? idx : null).filter(val => val !== null);
            if (emptyCells.length > 0) {
                let randomIdx = emptyCells[Math.floor(Math.random() * emptyCells.length)];
                board[randomIdx] = "O";
                updateBoard();
                checkResult();
                if (gameActive) statusDisplay.innerText = "HUMAN INPUT REQUIRED (X)";
            }
        }

        function updateBoard() {
            const cells = document.querySelectorAll('.cell');
            board.forEach((val, idx) => {
                cells[idx].innerText = val;
                cells[idx].classList.remove('x', 'o');
                if (val === "X") cells[idx].classList.add('x');
                if (val === "O") cells[idx].classList.add('o');
            });
        }

        function checkResult() {
            const winConditions = [
                [0, 1, 2], [3, 4, 5], [6, 7, 8],
                [0, 3, 6], [1, 4, 7], [2, 5, 8],
                [0, 4, 8], [2, 4, 6]
            ];

            let roundWon = false;
            for (let condition of winConditions) {
                let [a, b, c] = condition;
                if (board[a] && board[a] === board[b] && board[a] === board[c]) {
                    roundWon = true;
                    break;
                }
            }

            if (roundWon) {
                statusDisplay.innerText = "SEQUENCE COMPLETE. WINNER DETECTED.";
                gameActive = false;
                return;
            }

            if (!board.includes("")) {
                statusDisplay.innerText = "DATA STALEMATE. REBOOT REQUIRED.";
                gameActive = false;
            }
        }

        function resetGame() {
            board = ["", "", "", "", "", "", "", "", ""];
            gameActive = true;
            statusDisplay.innerText = "HUMAN INPUT REQUIRED (X)";
            updateBoard();
        }
    </script>
</body>
</html>
