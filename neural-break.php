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

        /* --- THREE-GAME GRID SYSTEM --- */
        .main-stage {
            flex: 1;
            display: flex;
            padding: 20px 50px;
            gap: 20px;
            align-items: stretch;
        }

        .game-column-left { flex: 2; display: flex; }
        .game-column-right { flex: 1; display: flex; flex-direction: column; gap: 20px; }

        .glass-panel {
            background: var(--glass-bg);
            border: 2px solid #ffffff; 
            border-radius: 4px;
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
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

        /* --- THE BOARD --- */
        .snakes-grid {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            width: 100%;
            max-width: 450px;
            border: 1px solid rgba(255,255,255,0.3);
        }
        .s-cell {
            aspect-ratio: 1/1;
            border: 0.1px solid rgba(0,0,0,0.1);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.6rem; font-weight: bold; color: rgba(255,255,255,0.8);
        }
        /* Vibrant Break Pattern */
        .s-cell:nth-child(5n+1) { background: #ff7675; }
        .s-cell:nth-child(5n+2) { background: #fdcb6e; }
        .s-cell:nth-child(5n+3) { background: #55efc4; }
        .s-cell:nth-child(5n+4) { background: #81ecec; }
        .s-cell:nth-child(5n+5) { background: #a29bfe; }

        .btn-neural {
            margin-top: 20px; background: transparent; border: 1px solid var(--brand-green);
            color: white; padding: 5px 20px; border-radius: 20px; font-size: 0.7rem; 
            cursor: pointer; text-transform: uppercase; transition: 0.3s;
        }
        .btn-neural:hover { background: var(--brand-green); color: var(--brand-blue-dark); }

        /* --- TICKER (THE BREAK MESSAGE) --- */
        .ticker-bar {
            height: 50px; background: rgba(0,0,0,0.8);
            border-top: 2px solid #ffffff;
            display: flex; align-items: center; overflow: hidden;
        }
        .ticker-text { display: flex; animation: scroll 30s linear infinite; }
        .ticker-item { 
            padding: 0 40px; font-size: 0.75rem; color: #ffffff; 
            white-space: nowrap; display: flex; align-items: center;
        }
        .ticker-item i { margin-right: 10px; color: var(--brand-gold); }

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
                    <?php for($i=100; $i>=1; $i--) echo "<div class='s-cell'>$i</div>"; ?>
                </div>
                <button class="btn-neural">EXECUTE ROLL</button>
            </div>
        </div>

        <div class="game-column-right">
            <div class="glass-panel" style="flex:1;">
                <span class="label">Secondary: Neural Logic</span>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; width: 120px;">
                    <?php for($i=0; $i<9; $i++) echo "<div style='aspect-ratio:1/1; border:1px solid #fff; background:rgba(255,255,255,0.05);'></div>"; ?>
                </div>
                <button class="btn-neural">RESET LOGIC</button>
            </div>
            
            <div class="glass-panel" style="flex:1;">
                <span class="label">Tertiary: Zen State</span>
                <i class="fas fa-mug-hot" style="font-size: 1.5rem; color: var(--brand-gold); margin-bottom: 10px;"></i>
                <p style="font-size: 0.6rem; text-align: center; color: rgba(255,255,255,0.6);">SYSTEM PAUSED.<br>REST PROTOCOL ACTIVE.</p>
            </div>
        </div>

    </main>

    <footer class="ticker-bar">
        <div class="ticker-text">
            <div class="ticker-item"><i class="fas fa-gamepad"></i> NO WORK ALLOWED</div>
            <div class="ticker-item"><i class="fas fa-coffee"></i> TAKE A BREAK</div>
            <div class="ticker-item"><i class="fas fa-battery-three-quarters"></i> RECHARGE YOUR BRAIN</div>
            <div class="ticker-item"><i class="fas fa-smile"></i> ENJOY THE GAME</div>
            <div class="ticker-item"><i class="fas fa-gamepad"></i> NO WORK ALLOWED</div>
            <div class="ticker-item"><i class="fas fa-coffee"></i> TAKE A BREAK</div>
            <div class="ticker-item"><i class="fas fa-battery-three-quarters"></i> RECHARGE YOUR BRAIN</div>
            <div class="ticker-item"><i class="fas fa-smile"></i> ENJOY THE GAME</div>
        </div>
    </footer>

</body>
</html>
