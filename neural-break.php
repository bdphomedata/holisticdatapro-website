<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neural Break | Fun Zone</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --brand-blue-dark: #001f3f;
            --brand-gold: #ffc629;
            --brand-green: #4ade80;
            --glass-bg: rgba(255, 255, 255, 0.03);
            /* Game Colors */
            --tile-red: #ff5e57;
            --tile-blue: #34e7e4;
            --tile-yellow: #f7d794;
            --tile-green: #58b19f;
            --tile-purple: #c56cf0;
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

        /* --- STRUCTURE (HAPPY IMAGE 1) --- */
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

        .label {
            position: absolute;
            top: 15px;
            left: 20px;
            font-size: 0.7rem;
            letter-spacing: 2px;
            color: var(--brand-gold);
            font-weight: bold;
            text-transform: uppercase;
        }

        /* --- COOL SNAKES & LADDERS BOARD --- */
        .snakes-grid {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            width: 100%;
            max-width: 500px;
            border: 2px solid #ffffff;
            box-shadow: 0 0 30px rgba(0,0,0,0.5);
        }

        .s-cell {
            aspect-ratio: 1/1;
            border: 1px solid rgba(255,255,255,0.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.7rem; font-weight: 900; color: #fff;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }

        /* Vibrant Game Pattern */
        .s-cell:nth-child(5n+1) { background-color: var(--tile-red); }
        .s-cell:nth-child(5n+2) { background-color: var(--tile-blue); }
        .s-cell:nth-child(5n+3) { background-color: var(--tile-yellow); }
        .s-cell:nth-child(5n+4) { background-color: var(--tile-green); }
        .s-cell:nth-child(5n+5) { background-color: var(--tile-purple); }

        .pawn {
            width: 25px; height: 25px;
            background: #fff; border: 3px solid #333;
            border-radius: 50%; box-shadow: 0 4px 10px rgba(0,0,0,0.5);
        }

        .btn-play {
            margin-top: 20px;
            padding: 10px 30px;
            background: var(--brand-green);
            border: none;
            border-radius: 50px;
            color: var(--brand-blue-dark);
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(74, 222, 128, 0.3);
        }

        /* --- TICKER --- */
        .ticker-bar {
            height: 50px; background: rgba(0,0,0,0.8);
            border-top: 2px solid #ffffff;
            display: flex; align-items: center; overflow: hidden;
        }
        .ticker-text { display: flex; animation: scroll 40s linear infinite; }
        .ticker-item { padding: 0 40px; font-size: 0.75rem; color: #ffffff; white-space: nowrap; }

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
                <span class="label">Snakes & Ladders Classic</span>
                <div class="snakes-grid">
                    <?php 
                    // Generate 100 tiles in the correct board order
                    for($i=100; $i>=1; $i--) {
                        echo "<div class='s-cell' id='tile-$i'>$i</div>";
                    }
                    ?>
                </div>
                <button class="btn-play">ROLL DICE</button>
            </div>
        </div>

        <div class="game-column-right">
            <div class="glass-panel game-2">
                <span class="label">Quick Match: Tic-Tac-Toe</span>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; width: 120px;">
                    <?php for($i=0; $i<9; $i++) echo "<div style='aspect-ratio:1/1; background:rgba(255,255,255,0.1); border:1px solid #fff;'></div>"; ?>
                </div>
            </div>
            
            <div class="glass-panel game-3">
                <span class="label">Daily High Scores</span>
                <i class="fas fa-trophy" style="font-size: 2rem; color: var(--brand-gold); margin-bottom: 10px;"></i>
                <p style="font-size: 0.7rem;">Player 1: 100 pts</p>
            </div>
        </div>

    </main>

    <footer class="ticker-bar">
        <div class="ticker-text">
            <div class="ticker-item">★ TAKE A BREAK ★ RELAX ★ RECHARGE ★ NO WORK ALLOWED ★ JUST PLAY ★</div>
            <div class="ticker-item">★ TAKE A BREAK ★ RELAX ★ RECHARGE ★ NO WORK ALLOWED ★ JUST PLAY ★</div>
        </div>
    </footer>

</body>
</html>
