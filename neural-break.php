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
            padding: 30px 50px;
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
            font-size: 0.75rem;
            letter-spacing: 2px;
            color: var(--brand-green);
            font-weight: bold;
            text-transform: uppercase;
        }

        /* --- THE CLASSIC BOARD OVERLAY --- */
        .snakes-grid {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            width: 100%;
            height: auto;
            max-width: 600px;
            margin: 0 auto;
            border: 2px solid #fff;
            position: relative;
            /* Update the path below to your uploaded image */
            background: url('image_232adb.jpg'); 
            background-size: cover;
            background-position: center;
        }

        .s-cell {
            aspect-ratio: 1/1;
            border: 0.5px solid rgba(255,255,255,0.1);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.8rem; font-weight: 900; 
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
            background: rgba(0,0,0,0.1); /* Subtle tint to see image better */
        }

        .btn-neural {
            margin: 20px auto 0;
            background: transparent; border: 1px solid var(--brand-green);
            color: white; padding: 8px 30px; border-radius: 20px; font-size: 0.75rem;
            cursor: pointer; text-transform: uppercase; letter-spacing: 1px;
        }

        .ttt-grid {
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 15px; width: 160px; margin: 0 auto;
        }
        .ttt-box {
            aspect-ratio: 1/1; border: 2px solid rgba(255,255,255,0.2);
            background: rgba(255,255,255,0.05); border-radius: 4px;
        }

        .ticker-bar {
            height: 40px; background: #000;
            border-top: 2px solid var(--border-glow);
            display: flex; align-items: center; overflow: hidden;
        }
        .status-links { display: flex; animation: scroll 40s linear infinite; }
        .status-item { 
            padding: 0 30px; font-size: 0.7rem; color: #fff; 
            white-space: nowrap; display: flex; align-items: center;
        }
        .status-item i { margin-right: 8px; color: var(--brand-green); font-size: 0.6rem; }

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
                <div class="snakes-grid">
                    <?php 
                    // Zig-Zag (Boustrophedon) Logic for 10x10 Board
                    for ($row = 9; $row >= 0; $row--) {
                        if ($row % 2 != 0) {
                            // Odd rows (counting from bottom 0) go Right to Left
                            for ($col = 1; $col <= 10; $col++) {
                                $num = ($row * 10) + $col;
                                echo "<div class='s-cell'>$num</div>";
                            }
                        } else {
                            // Even rows go Left to Right
                            for ($col = 10; $col >= 1; $col--) {
                                $num = ($row * 10) + $col;
                                echo "<div class='s-cell'>$num</div>";
                            }
                        }
                    }
                    ?>
                </div>
                <button class="btn-neural">EXECUTE ROLL</button>
            </div>
        </div>

        <div class="game-column-right">
            <div class="glass-panel" style="flex: 1.5;">
                <span class="label">Secondary: Neural Logic</span>
                <div class="ttt-grid">
                    <?php for($i=0; $i<9; $i++) echo "<div class='ttt-box'></div>"; ?>
                </div>
                <button class="btn-neural" style="margin-top: 30px;">RESET LOGIC</button>
            </div>
            
            <div class="glass-panel" style="flex: 1;">
                <span class="label">Tertiary: System Choice</span>
                <div style="text-align: center; margin: auto;">
                    <i class="fas fa-lock" style="font-size: 1.5rem; opacity: 0.3; margin-bottom: 15px;"></i>
                    <p style="font-size: 0.65rem; color: var(--brand-gold); letter-spacing: 1px;">AWAITING SELECTION...</p>
                </div>
            </div>
        </div>

    </main>

    <footer class="ticker-bar">
        <div class="status-links">
            <div class="status-item"><i class="fas fa-circle"></i> NEURAL ENGINE ACTIVE</div>
            <div class="status-item"><i class="fas fa-circle"></i> AZURE SQL LINK STABLE</div>
            <div class="status-item"><i class="fas fa-circle"></i> LPTMYBUSINESS CONNECTED</div>
            <div class="status-item"><i class="fas fa-circle"></i> DATA PIPELINE READY</div>
        </div>
    </footer>

</body>
</html>
