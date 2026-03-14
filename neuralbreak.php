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
            
            /* Core Game Colors */
            --tile-orange: #ff9f43;
            --tile-purple: #9b59b6;
            --tile-green: #27ae60;
            --tile-blue: #3498db;
            --tile-yellow: #f1c40f;
            --tile-teal: #16a085;
            --tile-magenta: #e056fd;
            --snake-red: #ff4757;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background: var(--brand-blue-dark); color: white; min-height: 100vh; display: flex; flex-direction: column; overflow-x: hidden; }
        
        .video-container { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -2; }
        #bg-video { width: 100%; height: 100%; object-fit: cover; }
        .video-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle, rgba(0, 40, 80, 0.2) 0%, rgba(0, 20, 40, 0.8) 100%); z-index: -1; }
        
        .main-stage { flex: 1; display: flex; padding: 20px 50px; gap: 25px; align-items: stretch; }

        /* --- MOBILE RESPONSIVE OVERRIDES --- */
        @media (max-width: 768px) {
            body { overflow-y: auto; }
            .main-stage { flex-direction: column; padding: 10px; gap: 15px; }
            .game-column-left, .game-column-right { width: 100%; flex: none; }
            .board-container { max-width: 100%; }
            .s-cell { font-size: 0.6rem; }
            .glass-panel { padding: 35px 15px 15px 15px; }
        }

        .game-column-left { flex: 2; display: flex; }
        .game-column-right { flex: 1; display: flex; flex-direction: column; gap: 20px; }
        .glass-panel { background: var(--glass-bg); border: 2px solid var(--border-glow); border-radius: 4px; backdrop-filter: blur(10px); display: flex; flex-direction: column; padding: 40px 20px 20px 20px; position: relative; width: 100%; }
        .label { position: absolute; top: 15px; left: 20px; font-size: 0.7rem; letter-spacing: 2px; color: var(--brand-green); font-weight: bold; text-transform: uppercase; }
        .board-container { position: relative; width: 100%; max-width: 600px; margin: 0 auto; }
        .snakes-grid { display: grid; grid-template-columns: repeat(10, 1fr); width: 100%; border: 3px solid #ffffff; background: #111; }
        #game-svg { position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 5; }

        .s-cell { aspect-ratio: 1/1; border: 0.5px solid rgba(255, 255, 255, 0.15); display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 800; color: rgba(0, 0, 0, 0.8); position: relative; }
        .s-cell.c-o { background: var(--tile-orange); }
        .s-cell.c-p { background: var(--tile-purple); }
        .s-cell.c-g { background: var(--tile-green); }
        .s-cell.c-b { background: var(--tile-blue); }
        .s-cell.c-y { background: var(--tile-yellow); }
        .s-cell.c-t { background: var(--tile-teal); }
        .s-cell.c-m { background: var(--tile-magenta); }
        .player-token { width: 75%; height: 75%; background: white; border-radius: 50%; border: 3px solid #000; z-index: 10; display: flex; align-items: center; justify-content: center; color: #000; font-size: 0.7rem; box-shadow: 0 0 10px rgba(255,255,255,0.8); transition: all 0.5s ease; }

        /* --- 3D DICE STYLES --- */
        .dice-scene { width: 60px; height: 60px; margin: 20px auto 0; perspective: 600px; cursor: pointer; }
        .dice { width: 100%; height: 100%; position: relative; transform-style: preserve-3d; transition: transform 1s cubic-bezier(0.17, 0.67, 0.83, 0.67); }
        .dice-face { position: absolute; width: 60px; height: 60px; background: white; border: 2px solid #ccc; line-height: 56px; font-size: 24px; font-weight: bold; color: #333; text-align: center; border-radius: 6px; }
        .face-1 { transform: rotateY(0deg) translateZ(30px); }
        .face-2 { transform: rotateY(90deg) translateZ(30px); }
        .face-3 { transform: rotateX(90deg) translateZ(30px); }
        .face-4 { transform: rotateX(-90deg) translateZ(30px); }
        .face-5 { transform: rotateY(-90deg) translateZ(30px); }
        .face-6 { transform: rotateY(180deg) translateZ(30px); }

        .ticker-bar { height: 40px; background: #000; border-top: 2px solid var(--border-glow); display: flex; align-items: center; overflow: hidden; }
        .status-links { display: flex; animation: scroll 40s linear infinite; }
        .status-item { padding: 0 30px; font-size: 0.7rem; color: #fff; white-space: nowrap; }
        @keyframes scroll { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

        /* --- NEURAL DRIFT GAME STYLES --- */
        #drift-canvas { background: rgba(0, 0, 0, 0.4); width: 100%; height: 100%; border-radius: 4px; display: block; cursor: crosshair; }
        .game-stats { position: absolute; top: 15px; right: 20px; font-family: 'Courier New', monospace; font-size: 0.8rem; color: var(--brand-green); text-shadow: 0 0 5px var(--brand-green); z-index: 10; }
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
                
                <div class="board-container">
                    <svg id="game-svg" viewBox="0 0 100 100" preserveAspectRatio="none"></svg>

                    <div class="snakes-grid" id="board">
                        <?php 
                        for ($row = 9; $row >= 0; $row--) {
                            if ($row % 2 != 0) {
                                for ($col = 1; $col <= 10; $col++) {
                                    $num = ($row * 10) + $col;
                                    $c_class = getColorClass($num);
                                    echo "<div class='s-cell $c_class' id='cell-$num'>$num</div>";
                                }
                            } else {
                                for ($col = 10; $col >= 1; $col--) {
                                    $num = ($row * 10) + $col;
                                    $c_class = getColorClass($num);
                                    echo "<div class='s-cell $c_class' id='cell-$num'>$num</div>";
                                }
                            }
                        }

                        function getColorClass($num) {
                            $colorArray = ['c-o','c-p','c-g','c-b','c-y','c-t','c-m'];
                            $index = ($num - 1) % 7;
                            return $colorArray[$index];
                        }
                        ?>
                    </div>
                </div>

                <div class="dice-scene" onclick="executeRoll()">
                    <div class="dice" id="dice">
                        <div class="dice-face face-1">1</div>
                        <div class="dice-face face-2">2</div>
                        <div class="dice-face face-3">3</div>
                        <div class="dice-face face-4">4</div>
                        <div class="dice-face face-5">5</div>
                        <div class="dice-face face-6">6</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="game-column-right">
            <div class="glass-panel" style="flex: 1.5;">
                <span class="label">Secondary: Neural Logic</span>
                <div style="text-align: center; margin: auto;">AWAITING LOGIC...</div>
            </div>
            
            <div class="glass-panel" style="flex: 1; overflow: hidden;" id="gemini-module">
                <span class="label">Tertiary: Neural Drift (v1.0)</span>
                <div class="game-stats">BIT-RATE: <span id="score">0</span></div>
                <canvas id="drift-canvas"></canvas>
                <div id="game-overlay" style="position: absolute; top:0; left:0; width:100%; height:100%; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.8); cursor: pointer; z-index: 20; text-align: center; padding: 20px;">
                    <span style="color: var(--brand-green); font-weight: bold; letter-spacing: 2px;">CONNECTION READY<br>CLICK TO INJECT DATA</span>
                </div>
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
        // --- SNAKES & LADDERS LOGIC ---
        let playerPos = 1;
        const totalCells = 100;
        let isRolling = false;

        const ladders = { 4: 14, 9: 31, 20: 38, 28: 84, 40: 59, 51: 67, 63: 81, 71: 91 };
        const snakes = { 17: 7, 54: 34, 62: 19, 64: 60, 87: 24, 93: 73, 95: 75, 99: 78 };

        function getCoords(cellId) {
            const board = document.getElementById('board');
            const el = document.getElementById('cell-' + cellId);
            return {
                x: (el.offsetLeft + el.offsetWidth / 2) / board.offsetWidth * 100,
                y: (el.offsetTop + el.offsetHeight / 2) / board.offsetHeight * 100
            };
        }

        function drawElements() {
            const svg = document.getElementById('game-svg');
            svg.innerHTML = ''; 

            Object.keys(ladders).forEach(start => {
                const s = getCoords(start);
                const e = getCoords(ladders[start]);
                const line = document.createElementNS("http://www.w3.org/2000/svg", "line");
                line.setAttribute("x1", s.x); line.setAttribute("y1", s.y);
                line.setAttribute("x2", e.x); line.setAttribute("y2", e.y);
                line.setAttribute("stroke", "rgba(255,255,255,0.7)");
                line.setAttribute("stroke-width", "1.5");
                line.setAttribute("stroke-dasharray", "1, 2");
                svg.appendChild(line);
            });

            Object.keys(snakes).forEach(head => {
                const s = getCoords(head);
                const e = getCoords(snakes[head]);
                const cpX = (s.x + e.x) / 2 + 10; 
                const cpY = (s.y + e.y) / 2;
                const path = document.createElementNS("http://www.w3.org/2000/svg", "path");
                path.setAttribute("d", `M ${s.x} ${s.y} Q ${cpX} ${cpY} ${e.x} ${e.y}`);
                path.setAttribute("stroke", "var(--snake-red)");
                path.setAttribute("stroke-width", "2");
                path.setAttribute("fill", "none");
                path.setAttribute("stroke-linecap", "round");
                svg.appendChild(path);
            });
        }

        function executeRoll() {
            if (isRolling) return;
            isRolling = true;
            const dice = document.getElementById('dice');
            const roll = Math.floor(Math.random() * 6) + 1;
            const rollMap = { 1: "rotateX(0deg) rotateY(0deg)", 2: "rotateX(0deg) rotateY(-90deg)", 3: "rotateX(-90deg) rotateY(0deg)", 4: "rotateX(90deg) rotateY(0deg)", 5: "rotateX(0deg) rotateY(90deg)", 6: "rotateX(180deg) rotateY(0deg)" };
            dice.style.transform = `rotateX(${Math.random() * 720}deg) rotateY(${Math.random() * 720}deg)`;
            setTimeout(() => {
                dice.style.transform = rollMap[roll];
                setTimeout(() => {
                    let newPos = playerPos + roll;
                    if (newPos > totalCells) { isRolling = false; return; }
                    if (ladders[newPos]) newPos = ladders[newPos];
                    else if (snakes[newPos]) newPos = snakes[newPos];
                    movePlayer(newPos);
                    playerPos = newPos;
                    isRolling = false;
                }, 1000); 
            }, 100);
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

        window.onload = () => {
            movePlayer(1);
            drawElements();
            initDriftGame();
        };
        window.onresize = () => { drawElements(); initDriftGame(); };

        // --- NEURAL DRIFT LOGIC ---
        const driftCanvas = document.getElementById('drift-canvas');
        const driftCtx = driftCanvas.getContext('2d');
        const driftContainer = document.getElementById('gemini-module');
        const driftOverlay = document.getElementById('game-overlay');
        const driftScoreEl = document.getElementById('score');

        let driftScore = 0;
        let driftActive = false;
        let driftPlayer = { x: 0, y: 0, size: 8 };
        let obstacles = [];
        let powerups = [];
        let driftAnimationId;

        function initDriftGame() {
            driftCanvas.width = driftContainer.clientWidth;
            driftCanvas.height = driftContainer.clientHeight - 40;
            driftPlayer.x = driftCanvas.width / 2;
            driftPlayer.y = driftCanvas.height - 30;
        }

        driftContainer.addEventListener('mousemove', (e) => {
            const rect = driftCanvas.getBoundingClientRect();
            driftPlayer.x = e.clientX - rect.left;
            if(driftPlayer.x < 5) driftPlayer.x = 5;
            if(driftPlayer.x > driftCanvas.width - 5) driftPlayer.x = driftCanvas.width - 5;
        });

        driftOverlay.addEventListener('click', () => {
            driftOverlay.style.display = 'none';
            driftScore = 0;
            driftScoreEl.innerText = driftScore;
            obstacles = [];
            powerups = [];
            driftActive = true;
            initDriftGame();
            animateDrift();
        });

        function animateDrift() {
            if (!driftActive) return;
            driftCtx.clearRect(0, 0, driftCanvas.width, driftCanvas.height);

            // Draw Player
            driftCtx.shadowBlur = 15;
            driftCtx.shadowColor = '#4ade80';
            driftCtx.fillStyle = '#4ade80';
            driftCtx.beginPath();
            driftCtx.arc(driftPlayer.x, driftPlayer.y, driftPlayer.size, 0, Math.PI * 2);
            driftCtx.fill();

            // Spawn Logic
            if (Math.random() < 0.05) {
                obstacles.push({ x: Math.random() * driftCanvas.width, y: -10, speed: 2 + Math.random() * 3, size: 10 });
            }
            if (Math.random() < 0.01) {
                powerups.push({ x: Math.random() * driftCanvas.width, y: -10, speed: 2 });
            }

            // Update Obstacles
            driftCtx.shadowBlur = 5;
            driftCtx.shadowColor = '#ff4757';
            driftCtx.fillStyle = '#ff4757';
            obstacles.forEach((ob, index) => {
                ob.y += ob.speed;
                driftCtx.fillRect(ob.x, ob.y, ob.size, ob.size);
                if (Math.hypot(driftPlayer.x - ob.x, driftPlayer.y - ob.y) < driftPlayer.size + 5) {
                    driftGameOver();
                }
                if (ob.y > driftCanvas.height) obstacles.splice(index, 1);
            });

            // Update Powerups
            driftCtx.shadowColor = '#ffc629';
            driftCtx.fillStyle = '#ffc629';
            powerups.forEach((p, index) => {
                p.y += p.speed;
                driftCtx.beginPath();
                driftCtx.arc(p.x, p.y, 5, 0, Math.PI * 2);
                driftCtx.fill();
                if (Math.hypot(driftPlayer.x - p.x, driftPlayer.y - p.y) < driftPlayer.size + 5) {
                    driftScore += 10;
                    driftScoreEl.innerText = driftScore;
                    powerups.splice(index, 1);
                }
                if (p.y > driftCanvas.height) powerups.splice(index, 1);
            });

            driftAnimationId = requestAnimationFrame(animateDrift);
        }

        function driftGameOver() {
            driftActive = false;
            cancelAnimationFrame(driftAnimationId);
            driftOverlay.style.display = 'flex';
            driftOverlay.innerHTML = `<span style="color: #ff4757; font-weight: bold; letter-spacing: 1px;">CONNECTION LOST<br>BIT-RATE: ${driftScore}<br>CLICK TO REBOOT</span>`;
        }
    </script>
</body>
</html>
