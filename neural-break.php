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
            padding: 20px 40px;
            gap: 20px;
            align-items: stretch;
        }

        .game-column-left { flex: 1.8; display: flex; }
        .game-column-right { flex: 1; display: flex; flex-direction: column; gap: 20px; }

        .glass-panel {
            background: var(--glass-bg);
            border: 2px solid #ffffff; /* Explicit white box lines */
            border-radius: 4px;
            backdrop-filter: blur(10px);
            padding: 20px;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .label {
            font-size: 0.65rem;
            letter-spacing: 2px;
            color: var(--brand-green);
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        /* --- DATA PIPELINE GRID --- */
        .snakes-container { flex: 1; display: flex; flex-direction: column; justify-content: center; align-items: center; }
        .snakes-grid {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            width: 100%;
            max-width: 450px;
            border: 1px solid #ffffff;
            background: rgba(0,0,0,0.3);
        }
        .s-cell {
            aspect-ratio: 1/1;
            border: 0.5px solid rgba(255,255,255,0.3);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.6rem; font-weight: bold; color: rgba(0,0,0,0.7);
        }
        /* Sequential Colors */
        .s-cell:nth-child(5n+1) { background: #ff7675; }
        .s-cell:nth-child(5n+2) { background: #fdcb6e; }
        .s-cell:nth-child(5n+3) { background: #55efc4; }
        .s-cell:nth-child(5n+4) { background: #81ecec; }
        .s-cell:nth-child(5n+5) { background: #a29bfe; }

        /* --- NEURAL LOGIC (Tic-Tac-Toe) --- */
        .ttt-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            margin: auto;
            width: 180px;
        }
        .ttt-box {
            aspect-ratio: 1/1;
            border: 1px solid rgba(255,255,255,0.2);
            background: rgba(255,255,255,0.05);
            border-radius: 4px;
        }

        .btn-action {
            margin-top: 15px;
            background: transparent;
            border: 1px solid var(--brand-green);
            color: white;
            padding: 6px 20px;
            font-size: 0.7rem;
            border-radius: 20px;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-action:hover { background: var(--brand-green); color: var(--brand-blue-dark); }

        /* --- TICKER --- */
        .ticker-bar {
            height: 40px; background: rgba(0,0,0,0.9);
            border-top: 1px solid #ffffff;
            display: flex; align-items: center; overflow: hidden;
        }
        .ticker-track { display: flex; animation: scroll 30s linear infinite; }
        .ticker-item { padding: 0 30px; font-size: 0.7rem; white-space: nowrap; color: #fff; opacity: 0.8; }
        .ticker-item i { color: var(--brand-green); margin-right: 8px; }

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
            <div class="glass-panel" style="width: 100%;">
                <span class="label">Primary Module: Data Pipeline</span>
                <div class="snakes-container">
                    <div class="snakes-grid">
                        <?php for($i=100; $i>=1; $i--) echo "<div class='s-cell'>$i</div>"; ?>
                    </div>
                    <button class="btn-action">EXECUTE ROLL</button>
                </div>
            </div>
        </div>

        <div class="game-column-right">
            <div class="glass-panel">
                <span class="label">Secondary: Neural Logic</span>
                <div class="ttt-grid">
                    <div class="ttt-box"></div><div class="ttt-box"></div><div class="ttt-box) "></div>
                    <div class="ttt-box"></div><div class="ttt-box"></div><div class="ttt-box"></div>
                    <div class="ttt-box"></div><div class="ttt-box"></div><div class="ttt-box"></div>
                </div>
                <button class="btn-action" style="width: fit-content; align-self: center;">RESET CORE</button>
            </div>
            
            <div class="glass-panel">
                <span class="label">Tertiary: System Choice</span>
                <div style="margin: auto; text-align: center;">
                    <i class="fas fa-lock" style="font-size: 2rem; opacity: 0.2; margin-bottom: 10px;"></i>
                    <p style="font-size: 0.6rem; color: var(--brand-gold);">AWAITING SELECTION...</p>
                </div>
            </div>
        </div>
    </main>

    <footer class="ticker-bar">
        <div class="ticker-track">
            <div class="ticker-item"><i class="fas fa-server"></i> AZURE SQL LINK STABLE</div>
            <div class="ticker-item"><i class="fas fa-network-wired"></i> LPTMYBUSINESS CONNECTED</div>
            <div class="ticker-item"><i class="fas fa-microchip"></i> NEURAL ENGINE ACTIVE</div>
            <div class="ticker-item"><i class="fas fa-server"></i> AZURE SQL LINK STABLE</div>
            <div class="ticker-item"><i class="fas fa-network-wired"></i> LPTMYBUSINESS CONNECTED</div>
            <div class="ticker-item"><i class="fas fa-microchip"></i> NEURAL ENGINE ACTIVE</div>
        </div>
    </footer>

</body>
</html>
