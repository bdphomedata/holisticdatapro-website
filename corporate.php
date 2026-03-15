<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SME & Corporate | Holistic Data Pro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* Shared variables from index.php */
        :root {
            --brand-blue-light: #0077c8;
            --brand-blue-dark: #001f3f;
            --brand-green: #4ade80;
            --text-white: #ffffff;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-white);
            background: var(--brand-blue-dark);
            overflow-x: hidden;
            overflow-y: auto;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        @media (min-width: 1024px) { body { overflow: hidden; } }

        /* --- VIDEO BACKGROUND --- */
        .video-container {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -2; overflow: hidden;
        }
        #bg-video {
            min-width: 100%; min-height: 100%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); object-fit: cover;
        }
        .video-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, rgba(0, 119, 200, 0.7) 0%, rgba(0, 31, 63, 0.9) 100%);
            z-index: -1; 
        }

        /* --- HERO --- */
        .main-hero { flex: 1; padding: 20px 5%; max-width: 1500px; margin: 0 auto; text-align: center; display: flex; flex-direction: column; justify-content: center; }
        h1 { font-size: 2.2rem; margin-bottom: 0.4rem; text-shadow: 0 4px 10px rgba(0,0,0,0.3); }
        .description { font-size: 0.95rem; max-width: 900px; margin: 0 auto 20px auto; line-height: 1.5; color: #f0f4f8; }
        .description strong { color: var(--brand-green); }

        /* --- SINGLE PANEL FOCUS --- */
        .focus-container { display: flex; justify-content: center; min-height: 50vh; margin-bottom: 20px; }
        .control-panel {
            background: var(--glass-bg); border: 1px solid var(--glass-border);
            border-radius: 15px; padding: 25px; backdrop-filter: blur(10px);
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            width: 100%; max-width: 600px;
        }
        .panel-header {
            font-size: 1.1rem; font-weight: 800; color: var(--brand-green);
            text-transform: uppercase; letter-spacing: 2px;
            margin-bottom: 25px; border-bottom: 1px solid rgba(74, 222, 128, 0.3);
            width: 100%; padding-bottom: 8px; text-align: center;
        }

        /* --- CIRCULAR NETWORK --- */
        .circular-network { position: relative; width: 360px; height: 360px; display: flex; justify-content: center; align-items: center; }
        .svg-lines { position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 1; }
        .hub-center {
            width: 110px; height: 110px; border-radius: 50%;
            background: rgba(74, 222, 128, 0.1); border: 2px solid var(--brand-green);
            display: flex; flex-direction: column; justify-content: center; align-items: center;
            text-align: center; z-index: 10; box-shadow: 0 0 20px rgba(74, 222, 128, 0.2);
            animation: pulse-green 3s infinite;
        }
        .node {
            position: absolute; width: 85px; height: 85px; border-radius: 50%;
            background: var(--glass-bg); border: 1px solid var(--glass-border);
            display: flex; flex-direction: column; justify-content: center; align-items: center;
            text-align: center; padding: 5px; transition: 0.3s; z-index: 5;
        }
        .node:hover { border-color: var(--brand-green); transform: scale(1.1); background: rgba(74, 222, 128, 0.05); }
        .node-title { font-size: 0.6rem; font-weight: 800; color: var(--brand-green); text-transform: uppercase; margin-bottom: 2px; }
        .node-desc { font-size: 0.45rem; text-transform: uppercase; opacity: 0.8; }

        .n1 { top: 10%; left: 50%; transform: translate(-50%, -50%); } 
        .n2 { top: 25%; right: 5%; transform: translate(50%, -50%); } 
        .n3 { bottom: 25%; right: 5%; transform: translate(50%, 50%); } 
        .n4 { bottom: 10%; left: 50%; transform: translate(-50%, 50%); } 
        .n5 { bottom: 25%; left: 5%; transform: translate(-50%, 50%); } 
        .n6 { top: 25%; left: 5%; transform: translate(-50%, -50%); } 

        footer { padding: 15px; background: #000b1a; text-align: center; font-size: 0.65rem; color: rgba(255,255,255,0.4); }

        @keyframes pulse-green {
            0% { box-shadow: 0 0 0 0 rgba(74, 222, 128, 0.4); }
            70% { box-shadow: 0 0 0 15px rgba(74, 222, 128, 0); }
            100% { box-shadow: 0 0 0 0 rgba(74, 222, 128, 0); }
        }

        @media (max-width: 900px) { .circular-network { transform: scale(0.8); } h1 { font-size: 1.6rem; } }
    </style>
</head>
<body>
    <div class="video-container">
        <video id="bg-video" autoplay loop muted playsinline>
            <source src="assets/video/WebsiteVideo.mp4" type="video/mp4">
        </video>
    </div>
    <div class="video-overlay"></div>

    <?php include 'header.php'; ?>

    <div class="main-hero">
        <h1>SME & Corporate Solutions</h1>
        <p class="description">
            Leverage <strong>25 years of specialized experience</strong> to optimize your business intelligence. From ETL pipelines to reverse engineering legacy modules, we build for performance.
        </p>

        <div class="focus-container">
            <div class="control-panel">
                <div class="panel-header">Enterprise Infrastructure</div>
                <div class="circular-network">
                    <svg class="svg-lines">
                        <line x1="50%" y1="50%" x2="50%" y2="10%" stroke="rgba(74,222,128,0.2)" stroke-width="1"/>
                        <line x1="50%" y1="50%" x2="95%" y2="25%" stroke="rgba(74,222,128,0.2)" stroke-width="1"/>
                        <line x1="50%" y1="50%" x2="95%" y2="75%" stroke="rgba(74,222,128,0.2)" stroke-width="1"/>
                        <line x1="50%" y1="50%" x2="50%" y2="90%" stroke="rgba(74,222,128,0.2)" stroke-width="1"/>
                        <line x1="50%" y1="50%" x2="5%" y2="75%" stroke="rgba(74,222,128,0.2)" stroke-width="1"/>
                        <line x1="50%" y1="50%" x2="5%" y2="25%" stroke="rgba(74,222,128,0.2)" stroke-width="1"/>
                    </svg>
                    <div class="hub-center">
                        <div class="node-title" style="font-size: 0.75rem;">LEGACY MOD</div>
                        <div class="node-desc">Reverse Engineering</div>
                    </div>
                    <div class="node n1"><div class="node-title">Data Eng.</div><div class="node-desc">Pipelines</div></div>
                    <div class="node n2"><div class="node-title">Architecture</div><div class="node-desc">Dimensional</div></div>
                    <div class="node n3"><div class="node-title">Strategic</div><div class="node-desc">Analytics</div></div>
                    <div class="node n4"><div class="node-title">GOVERNANCE</div><div class="node-desc">Integrity</div></div>
                    <div class="node n5"><div class="node-title">SCALABLE</div><div class="node-desc">Integration</div></div>
                    <div class="node n6"><div class="node-title">WAREHOUSE</div><div class="node-desc">Design</div></div>
                </div>
            </div>
        </div>
    </div>

    <footer><p>&copy; 2026 Holistic Data Pro. All rights reserved.</p></footer>
</body>
</html>
