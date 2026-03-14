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
            --glass-bg: rgba(255, 255, 255, 0.03);
            --border-glow: #ffffff;
            
            /* Core Game Colors from Image */
            --tile-orange: #ff9f43;
            --tile-purple: #9b59b6;
            --tile-green: #27ae60;
            --tile-blue: #3498db;
            --tile-yellow: #f1c40f;
            --tile-teal: #16a085;
            --tile-magenta: #e056fd;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--brand-blue-dark);
            color: white;
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* --- BACKGROUND (Restored Structure) --- */
        .video-container { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -2; }
        #bg-video { width: 100%; height: 100%; object-fit: cover; }
        .video-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle, rgba(0, 40, 80, 0.2) 0%, rgba(0, 20, 40, 0.8) 100%);
            z-index: -1;
        }

        .main-stage {
            flex: 1;
            display: flex;
            padding: 20px 50px;
            gap: 25px;
            align-items: stretch;
        }

        .game-column-left { flex: 2; display: flex; }
        .game-column-right { flex: 1; display: flex; flex-direction: column; gap: 20px; }

        .glass-panel {
            background: var(--glass-bg);
            border: 2px solid var(--border-glow);
            border-radius: 4px;
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            padding: 40px 20px 20px 20px;
            position: relative;
            width: 100%;
        }

        .label {
            position: absolute;
            top: 15px;
            left: 20px;
            font-size: 0.7rem;
            letter-spacing: 2px;
            color: var(--brand-green);
            font-weight: bold;
            text-transform: uppercase;
        }

        /* --- DATA PIPELINE BOARD: COLOR BLOCKING & STYLING --- */
        .snakes-grid {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            border: 3px solid #ffffff; /* Explicit white box border */
            background: #111; /* Grounding color */
        }

        .s-cell {
            aspect-ratio: 1/1;
            border: 0.5px solid rgba(255, 255, 255, 0.15); /* White grid lines */
            display: flex; align-items: center; justify-content: center;
            font-size: 0.8rem; font-weight: 800; 
            /* Enhanced readable numbers (not office jargon) */
            color: rgba(0, 0, 0, 0.8);
            position: relative;
        }

        /* --- Specific Cell Color Blocks --- */
        .s-cell.c-o { background: var(--tile-orange); }
        .s-cell.c-p { background: var(--tile-purple); }
        .s-cell.c-g { background: var(--tile-green); }
        .s-cell.c-b { background: var(--tile-blue); }
        .s-cell.c-y { background: var(--tile-yellow); }
        .s-cell.c-t { background: var(--tile-teal); }
        .s-cell.c-m { background: var(--tile-magenta); }

        .player-token {
            width: 75%; height: 75%;
            background: white; border-radius: 50%;
            border: 3px solid #000; z-index: 10;
            display: flex; align-items: center; justify-content: center;
            color: #000; font-size: 0.7rem; box-shadow: 0 0 10px rgba(255,255,255,0.8);
        }

        .btn-neural {
            margin: 20px auto 0;
            background: transparent; border: 1px solid var(--brand-green);
            color: white; padding: 8px 30px; border-radius: 20px; font-size: 0.7rem;
            cursor: pointer; text-transform: uppercase; letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        .btn-neural:hover { background: var(--brand-green); color: black; }

        .ticker-bar {
            height: 40px; background: #000;
            border-top: 2px solid var(--border-glow);
            display: flex; align-items: center; overflow: hidden;
        }
        .status-links { display: flex; animation: scroll 40s linear infinite; }
        .status-item { padding: 0 30px; font-size: 0.7rem; color: #fff; white-space: nowrap; }

        @keyframes scroll { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
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

    <main class="main-stage">
        
        <div class="game-column-left">
            <div class="glass-panel">
                <span class="label">Primary Module: Data Pipeline</span>
                <div class="snakes-grid" id="board">
                    <?php 
                    // Zig-Zag Logic for pathing
                    for ($row = 9; $row >= 0; $row--) {
                        if ($row % 2 != 0) { // L to R
                            for ($col = 1; $col <= 10; $col++) {
                                $num = ($row * 10) + $col;
                                $c_class = getColorClass($num);
                                echo "<div class='s-cell $c_class' id='cell-$num'>$num</div>";
                            }
                        } else { // R to L
                            for ($col = 10; $col >= 1; $col--) {
                                $num = ($row * 10) + $col;
                                $c_class = getColorClass($num);
                                echo "<div class='s-cell $c_class' id='cell-$num'>$num</div>";
                            }
                        }
                    }

                    // Helper to map color to number
                    function getColorClass($num) {
                        // Color indices: Orange, Purple, Green, Blue, Yellow, Teal, Magenta
                        $colorArray = ['c-o','c-p','c-g','c-b','c-y','c-t','c-m'];
                        $index = ($num - 1) % 7;
                        return $colorArray[$index];
                    }
                    ?>
                </div>
                <button class="btn-neural" onclick="executeRoll()">EXECUTE ROLL</button>
            </div>
        </div>

        <div class="game-column-right">
            <div class="glass-panel" style="flex: 1.5;">
                <span class="label">Secondary: Neural Logic</span>
                <div style="text-align: center; margin: auto;">AWAITING LOGIC...</div>
            </div>
            
            <div class="glass-panel" style="flex: 1;">
                <span class="label">Tertiary: System Choice</span>
                <div style="text-align: center; margin: auto;">LOCKED</div>
            </div>
        </div>

    </main>

    <footer class="ticker-bar">
        <div class="status-links">
            <div class="status-item">NO WORK ALLOWED</div>
            <div class="status-item">RECHARGE YOUR BRAIN</div>
            <div class="status-item">SYSTEM PAUSED. ENJOY THE GAME</div>
        </div>
    </footer>

    <script>
        let playerPos = 1;
        const totalCells = 100;

        function executeRoll() {
            const roll = Math.floor(Math.random() * 6) + 1;
            console.log("System Roll: " + roll);
            
            let newPos = playerPos + roll;
            if (newPos > totalCells) return; 

            movePlayer(newPos);
            playerPos = newPos;
        }

        function movePlayer(pos) {
            const oldToken = document.querySelector('.player-token');
            if (oldToken) oldToken.remove();

            const targetCell = document.getElementById('cell-' + pos);
            const token = document.createElement('div');
            token.className = 'player-token';
            token.innerHTML = '<i class="fas fa-microchip"></i>';
            targetCell.appendChild(token);
        }

        window.onload = () => movePlayer(1);
    </script>
</body>
</html>
