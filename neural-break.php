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
        .video-container {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -2;
        }
        #bg-video { width: 100%; height: 100%; object-fit: cover; }
        .video-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle, rgba(0, 40, 80, 0.2) 0%, rgba(0, 20, 40, 0.8) 100%);
            z-index: -1;
        }

        /* --- THREE-GAME GRID SYSTEM (STRICT MATCH TO IMAGE 1) --- */
        .main-stage {
            flex: 1;
            display: flex;
            padding: 20px 50px;
            gap: 20px;
            align-items: stretch;
        }

        .game-column-left {
            flex: 2; 
            display: flex;
        }

        .game-column-right {
            flex: 1; 
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .glass-panel {
            background: var(--glass-bg);
            border: 2px solid #ffffff; /* Those exact white lines */
            border-radius: 4px;
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }

        .game-1 { width: 100%; }
        .game-2, .game-3 { flex: 1; }

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

        /* --- GAME ELEMENT STYLES (NO IMPACT ON BOX LINES) --- */
        .snakes-grid {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            width: 100%;
            max-width: 480px;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .s-cell {
            aspect-ratio: 1/1;
            border: 0.1px solid rgba(0,0,0,0.1);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.6rem; font-weight: bold; color: rgba(0,0,0,0.6);
        }
        .s-cell:nth-child(5n+1) { background: #ff7675; }
        .s-cell:nth-child(5n+2) { background: #fdcb6e; }
        .s-cell:nth-child(5n+3) { background: #55efc4; }
        .s-cell:nth-child(5n+4) { background: #81ecec; }
        .s-cell:nth-child(5n+5) { background: #a29bfe; }

        .ttt-grid {
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 10px; width: 150px; margin-top: 20px;
        }
        .ttt-box {
            aspect-ratio: 1/1; border: 1px solid rgba(255,255,255,0.2);
            background: rgba(255,255,255,0.05); border-radius: 4px;
        }

        .btn-neural {
            margin-top: 20px; background: transparent; border: 1px solid var(--brand-green);
            color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.7rem; cursor: pointer;
        }

        /* --- TICKER (Footer) --- */
        .ticker-bar {
            height: 50px;
            background: rgba(0,0,0,0.8);
            border-top: 2px solid #ffffff;
            display: flex;
            align-items: center;
            overflow: hidden;
        }
        .ticker-text { display: flex; animation: scroll 40s linear infinite; }
        .ticker-item { 
            padding: 0 40px; 
            font-size: 0.75rem; 
            color: #ffffff; 
            white-space: nowrap; 
            display: flex; 
            align-items: center;
        }
        .ticker-item i { margin-right: 10px; color: var(--brand-green); }

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
            <div class="glass-panel game-1">
                <span class="label">Primary Module: Data Pipeline</span>
                <div class="snakes-grid">
                    <?php for($i=100; $i>=1; $i--) echo "<div class='s-cell'>$i</div>"; ?>
                </div>
                <button class="btn-neural">EXECUTE ROLL</button>
            </div>
        </div>

        <div class="game-column-right">
            <div class="glass-panel game-2">
                <span class="label">Secondary: Neural Logic</span>
                <div class="ttt-grid">
                    <div class="ttt-box"></div><div class="ttt-box"></div><div class="ttt-box"></div>
                    <div class="ttt-box"></div><div class="ttt-box"></div><div class="ttt-box"></div>
                    <div class="ttt-box"></div><div class="ttt-box"></div><div class="ttt-box"></div>
                </div>
                <button class="btn-neural">RESET LOGIC</button>
            </div>
            
            <div class="glass-panel game-3">
                <span class="label">Tertiary: System Choice</span>
                <i class="fas fa-lock" style="font-size: 1.5rem; opacity: 0.2; margin-bottom: 10px;"></i>
                <p style="font-size: 0.6rem; color: var(--brand-gold);">AWAITING CORE INITIALIZATION...</p>
            </div>
        </div>

    </main>

    <footer class="ticker-bar">
        <div class="ticker-text">
            <div class="ticker-item"><i class="fas fa-microchip"></i> HIGH-PERFORMANCE T-SQL</div>
            <div class="ticker-item"><i class="fas fa-code-branch"></i> LEGACY REVERSE ENGINEERING</div>
            <div class="ticker-item"><i class="fas fa-database"></i> END-TO-END DATA WAREHOUSING</div>
            <div class="ticker-item"><i class="fas fa-network-wired"></i> SCALABLE DATA INTEGRATION</div>
            <div class="ticker-item"><i class="fas fa-microchip"></i> HIGH-PERFORMANCE T-SQL</div>
            <div class="ticker-item"><i class="fas fa-code-branch"></i> LEGACY REVERSE ENGINEERING</div>
            <div class="ticker-item"><i class="fas fa-database"></i> END-TO-END DATA WAREHOUSING</div>
            <div class="ticker-item"><i class="fas fa-network-wired"></i> SCALABLE DATA INTEGRATION</div>
        </div>
    </footer>

</body>
</html>
