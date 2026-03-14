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
            /* High-transparency glass for the floating effect */
            --glass-bg: rgba(255, 255, 255, 0.04);
            --glass-border: rgba(255, 255, 255, 0.15);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--brand-blue-dark);
            color: white;
            height: 100vh;
            display: flex;
            flex-direction: column; /* Stacks Image 2 (Top), Image 1 (Mid), and Image 3 (Bottom) */
            overflow: hidden;
        }

        /* --- BACKGROUND LAYER --- */
        .video-container {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -2;
        }
        #bg-video {
            width: 100%; height: 100%; object-fit: cover;
        }
        .video-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle, rgba(0, 119, 200, 0.2) 0%, rgba(0, 31, 63, 0.85) 100%);
            z-index: -1;
        }

        /* --- MAIN CONTENT AREA (Image 1 Space) --- */
        .neural-container {
            flex: 1; /* Automatically expands to fit between Header and Ticker */
            display: flex;
            align-items: center; 
            justify-content: flex-start; /* Aligns boxes to the left */
            padding: 0 5%;
            gap: 30px;
        }

        /* Foundational Glass Boxes */
        .content-placeholder {
            background: var(--glass-bg);
            /* White box lines as requested */
            border: 2px solid #ffffff; 
            border-radius: 12px;
            padding: 40px;
            backdrop-filter: blur(10px);
            text-align: center;
            box-shadow: 0 8px 32px 0 rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            transition: transform 0.3s ease;
        }

        .large-slot { width: 520px; min-height: 450px; }
        .small-slot { width: 360px; min-height: 450px; }

        .slot-title {
            color: var(--brand-green);
            font-size: 1.2rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        /* --- TICKER AREA (Image 3) --- */
        .ticker-wrapper {
            height: 45px; 
            background: rgba(0, 15, 30, 0.9);
            border-top: 1px solid #ffffff; /* White line for ticker border */
            display: flex; 
            align-items: center; 
            overflow: hidden;
        }
        .ticker-track { display: flex; animation: scrollText 30s linear infinite; width: max-content; }
        .ticker-item { padding: 0 40px; font-size: 0.75rem; color: #ffffff; white-space: nowrap; text-transform: uppercase; font-weight: 600; }
        .ticker-item i { color: var(--brand-green); margin-right: 10px; }

        @keyframes scrollText { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
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

    <main class="neural-container">
        <div class="content-placeholder large-slot">
            <h2 class="slot-title">DATA PIPELINE</h2>
            <p style="color: var(--brand-gold); font-size: 0.9rem;">STRUCTURAL FRAMEWORK READY</p>
        </div>

        <div class="content-placeholder small-slot">
            <h2 class="slot-title">NEURAL LOGIC</h2>
            <p style="color: var(--brand-gold); font-size: 0.9rem;">STRUCTURAL FRAMEWORK READY</p>
        </div>
    </main>

    <footer class="ticker-wrapper">
        <div class="ticker-track">
            <div class="ticker-item"><i class="fas fa-server"></i> AZURE SQL LINK STABLE</div>
            <div class="ticker-item"><i class="fas fa-code-branch"></i> REPOSITORY V1.0.2</div>
            <div class="ticker-item"><i class="fas fa-microchip"></i> NEURAL ENGINE ACTIVE</div>
            <div class="ticker-item"><i class="fas fa-network-wired"></i> LPTMYBUSINESS CONNECTED</div>
            <div class="ticker-item"><i class="fas fa-server"></i> AZURE SQL LINK STABLE</div>
            <div class="ticker-item"><i class="fas fa-code-branch"></i> REPOSITORY V1.0.2</div>
            <div class="ticker-item"><i class="fas fa-microchip"></i> NEURAL ENGINE ACTIVE</div>
            <div class="ticker-item"><i class="fas fa-network-wired"></i> LPTMYBUSINESS CONNECTED</div>
        </div>
    </footer>

</body>
</html>
