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

        /* --- BACKGROUND --- */
        .video-container { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -2; }
        #bg-video { width: 100%; height: 100%; object-fit: cover; }
        .video-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle, rgba(0, 40, 80, 0.2) 0%, rgba(0, 20, 40, 0.8) 100%);
            z-index: -1;
        }

        /* --- LAYOUT --- */
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
            padding: 35px 20px 15px 20px;
            position: relative;
            width: 100%;
        }

        .label {
            position: absolute;
            top: 12px;
            left: 20px;
            font-size: 0.7rem;
            letter-spacing: 2px;
            color: var(--brand-green);
            font-weight: bold;
            text-transform: uppercase;
        }

        /* --- BOARD DESIGN --- */
        .snakes-grid {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            width: 100%;
            max-width: 580px;
            margin: 0 auto;
            border: 2px solid #fff;
            background: url('image_232adb.jpg'); /* References classic board style */
            background-size: cover;
            background-position: center;
        }

        .s-cell {
            aspect-ratio: 1/1;
            border: 0.5px solid rgba(255,255,255,0.15);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.8rem; font-weight: 900; 
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
            position: relative;
        }

        .player-token {
            width: 75%;
            height: 75%;
            background: var(--brand-gold);
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 0 12px var(--brand-gold);
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
        }

        .btn-neural {
            margin: 15px auto 0;
            background: transparent; border: 1px solid var(--brand-green);
            color: white; padding: 8px 30px; border-radius: 20px; font-size: 0.7rem;
            cursor: pointer; text-transform: uppercase; letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        .btn-neural:hover { background: var(--brand-green); color: black; }

        /* --- STATUS TICKER --- */
        .ticker-bar {
            height: 35px; background: #000;
            border-top: 2px solid var(--border-glow);
            display: flex; align-items: center; overflow: hidden;
        }
        .status-links { display: flex; animation: scroll 40s linear infinite; }
        .status-item { 
            padding: 0 30px; font-size: 0.65rem; color: #fff; 
            white-space: nowrap; display: flex; align-items: center;
        }
        .status-item i { margin-right: 8px; color: var(--brand-green); }

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
                    // Zig-Zag Logic for correct pathing
                    for ($row = 9; $row >= 0; $row--) {
                        if ($row % 2 != 0) { 
                            for ($col = 1; $col <= 10; $col++) {
                                $num = ($row * 10) + $col;
                                echo "<div class='s-cell' id='cell-$num'>$num</div>";
                            }
                        } else { 
                            for ($col = 10; $col >= 1; $col--) {
                                $num = ($row * 10) + $col;
                                echo "<div class='s-cell' id='cell-$num'>$num</div>";
                            }
                        }
                    }
                    ?>
                </div>
                <button class="btn-neural" onclick="executeRoll()">EXECUTE ROLL</button>
            </div>
        </div>

        <div class="game-column-right">
            <div class="glass-panel" style="flex: 1.5;">
                <span class="label">Secondary: Neural Logic</span>
                <div style="text-align: center; margin: auto; opacity: 0.5; font-size: 0.8rem;">
                    <i class="fas fa-brain" style="display:block; font-size: 2rem; margin-bottom: 10px;"></i>
                    AWAITING LOGIC...
                </div>
            </div>
            
            <div class="glass-panel" style="flex: 1;">
                <span class="label">Tertiary: System Choice</span>
                <div style="text-align: center; margin: auto; color: var(--brand-gold); font-size: 0.7rem;">
                    <i class="fas fa-lock" style="display:block; font-size: 1.5rem; margin-bottom: 10px; opacity: 0.3;"></i>
                    LOCKED
                </div>
            </div>
        </div>

    </main>

    <footer class="ticker-bar">
        <div class="status-links">
            <div class="status-item"><i class="fas fa-circle"></i> DATA PIPELINE READY</div>
            <div class="status-item"><i class="fas fa-circle"></i> NEURAL ENGINE ACTIVE</div>
            <div class="status-item"><i class="fas fa-circle"></i> AZURE SQL LINK STABLE</div>
            <div class="status-item"><i class="fas fa-circle"></i> LPTMYBUSINESS CONNECTED</div>
            <div class="status-item"><i class="fas fa-circle"></i> DATA PIPELINE READY</div>
            <div class="status-item"><i class="fas fa-circle"></i> NEURAL ENGINE ACTIVE</div>
            <div class="status-item"><i class="fas fa-circle"></i> AZURE SQL LINK STABLE</div>
            <div class="status-item"><i class="fas fa-circle"></i> LPTMYBUSINESS CONNECTED</div>
        </div>
    </footer>

    <script>
        let playerPos = 1;
        
        // Map based on the classic board snakes and ladders
        const neuralMap = {
            1: 38, 4: 14, 9: 31, 21: 42, 28: 84, 36: 44, 51: 67, 71: 91, 80: 100, // Ladders
            16: 6, 47: 26, 49: 11, 56: 53, 62: 19, 64: 60, 87: 24, 93: 73, 95: 75, 98: 78 // Snakes
        };

        function executeRoll() {
            const roll = Math.floor(Math.random() * 6) + 1;
            console.log("System Roll: " + roll);
            
            let newPos = playerPos + roll;
            if (newPos > 100) return; 

            movePlayer(newPos);
            playerPos = newPos;

            // Handle Neural Warp
            setTimeout(() => {
                if (neuralMap[playerPos]) {
                    playerPos = neuralMap[playerPos];
                    movePlayer(playerPos);
                }
            }, 500);
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
