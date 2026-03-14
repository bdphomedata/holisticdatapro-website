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

        /* --- THREE-GAME GRID SYSTEM (Matches your image) --- */
        .main-stage {
            flex: 1;
            display: flex;
            padding: 20px 50px;
            gap: 20px;
            align-items: stretch;
        }

        /* Left Side - Game 1 (Large) */
        .game-column-left {
            flex: 2; /* Takes more width */
            display: flex;
        }

        /* Right Side - Game 2 & 3 (Stacked) */
        .game-column-right {
            flex: 1; /* Takes less width */
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .glass-panel {
            background: var(--glass-bg);
            border: 2px solid #ffffff; /* Exact white box lines from mockup */
            border-radius: 4px; /* Sharper corners to match drawing */
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
                <h2 style="color: var(--brand-gold);">GAME 1 SLOT</h2>
                <p style="font-size: 0.8rem; opacity: 0.6;">Awaiting Core Initialization...</p>
            </div>
        </div>

        <div class="game-column-right">
            <div class="glass-panel game-2">
                <span class="label">Secondary: Neural Logic</span>
                <h3 style="color: var(--brand-gold);">GAME 2 SLOT</h3>
            </div>
            
            <div class="glass-panel game-3">
                <span class="label">Tertiary: System Choice</span>
                <h3 style="color: var(--brand-gold);">GAME 3 SLOT</h3>
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
