<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holistic Data Pro | Expert Data Solutions</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* --- BRAND VARIABLES & RESET --- */
        :root {
            --brand-blue-light: #0077c8;
            --brand-blue-dark: #001f3f;
            --brand-gold: #ffc629;
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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* Desktop specific lock for that 'Dashboard' feel */
        @media (min-width: 1024px) {
            body { overflow-y: hidden; }
        }

        /* --- VIDEO BACKGROUND --- */
        .video-container { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -2; overflow: hidden; }
        #bg-video { min-width: 100%; min-height: 100%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); object-fit: cover; }
        .video-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(0, 119, 200, 0.7) 0%, rgba(0, 31, 63, 0.9) 100%); z-index: -1; }

        /* --- HEADER STABILIZER --- 
           This prevents the 'bonkers' look by forcing the included header to behave */
        header {
            width: 100%;
            padding: 15px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(0, 31, 63, 0.4);
            backdrop-filter: blur(10px);
            z-index: 1000;
        }

        /* --- HERO SECTION --- */
        .main-hero {
            flex: 1; padding: 10px 5%; max-width: 1500px; margin: 0 auto;
            text-align: center; display: flex; flex-direction: column; justify-content: center;
        }

        h1 { font-size: 2.2rem; margin-bottom: 0.4rem; text-shadow: 0 4px 10px rgba(0,0,0,0.3); }
        .description { font-size: 0.95rem; max-width: 900px; margin: 0 auto 20px auto; line-height: 1.5; color: #f0f4f8; }
        .description strong { color: var(--brand-green); }

        /* --- DUAL CONTROL PANELS --- */
        .dual-command-container {
            display: grid; grid-template-columns: 1fr 1fr; gap: 20px;
            min-height: 45vh; margin-bottom: 20px;
        }

        .control-panel {
            background: var(--glass-bg); border: 1px solid var(--glass-border);
            border-radius: 15px; padding: 15px; backdrop-filter: blur(10px);
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            overflow: hidden;
        }

        .panel-header {
            font-size: 1.1rem; font-weight: 800; color: var(--brand-green);
            text-transform: uppercase; letter-spacing: 2px;
            margin-bottom: 15px; border-bottom: 1px solid rgba(74, 222, 128, 0.3);
            width: 100%; padding-bottom: 8px;
        }

        /* --- CIRCULAR NETWORK --- */
        .circular-network { position: relative; width: 360px; height: 360px; display: flex; justify-content: center; align-items: center; }
        .svg-lines { position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 1; }
        .hub-center {
            width: 110px; height: 110px; border-radius: 50%;
            background: rgba(74, 222, 128, 0.1); border: 2px solid var(--brand-green);
            display: flex; flex-direction: column; justify-content: center; align-items: center;
            z-index: 10; animation: pulse-green 3s infinite;
        }

        .node {
            position: absolute; width: 85px; height: 85px; border-radius: 50%;
            background: var(--glass-bg); border: 1px solid var(--glass-border);
            display: flex; flex-direction: column; justify-content: center; align-items: center;
            text-align: center; padding: 5px; transition: 0.3s; z-index: 5;
        }
        .node:hover { border-color: var(--brand-green); transform: scale(1.1); background: rgba(74, 222, 128, 0.05); }
        .node-title { font-size: 0.6rem; font-weight: 800; color: var(--brand-green); text-transform: uppercase; }
        .node-desc { font-size: 0.45rem; text-transform: uppercase; opacity: 0.8; }

        /* Node Positions */
        .n1 { top: 10%; left: 50%; transform: translate(-50%, -50%); } 
        .n2 { top: 25%; right: 5%; transform: translate(50%, -50%); } 
        .n3 { bottom: 25%; right: 5%; transform: translate(50%, 50%); } 
        .n4 { bottom: 10%; left: 50%; transform: translate(-50%, 50%); } 
        .n5 { bottom: 25%; left: 5%; transform: translate(-50%, 50%); } 
        .n6 { top: 25%; left: 5%; transform: translate(-50%, -50%); } 

        /* --- TICKER --- */
        .ticker-wrapper { width: 100vw; height: 50px; background: rgba(0, 31, 63, 0.9); border-top: 1px solid rgba(74, 222, 128, 0.3); overflow: hidden; display: flex; align-items: center; }
        .ticker-track { display: flex; animation: scrollText 40s linear infinite; width: max-content; }
        .ticker-item { display: flex; align-items: center; padding: 0 30px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; }
        .ticker-item i { color: var(--brand-green); margin-right: 10px; }

        /* --- MOBILE & TABLET ADAPTATION --- */
        @media (max-width: 1024px) {
            body { overflow-y: auto !important; }
            .dual-command-container { grid-template-columns: 1fr; gap: 40px; }
            .circular-network { transform: scale(0.85); margin: 20px 0; }
            .main-hero { padding-top: 40px; }
        }

        @keyframes scrollText { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        @keyframes pulse-green {
            0% { box-shadow: 0 0 0 0 rgba(74, 222, 128, 0.4); }
            70% { box-shadow: 0 0 0 15px rgba(74, 222, 128, 0); }
            100% { box-shadow: 0 0 0 0 rgba(74, 222, 128, 0); }
        }
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
    
    <main class="main-hero">
        <h1>Expert Data-Driven Business Intelligence</h1>
        <p class="description">
            Holistic Data Pro is led by Bartus de Paiva, a Senior BI Developer with <strong>over 25 years of specialized experience</strong>. We specialize in engineering end-to-end intelligence solutions.
        </p>

        <div class="dual-command-container">
            <div class="control-panel">
                <div class="panel-header">Home Users</div>
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
                        <div class="node-title" style="font-size: 0.75rem;">DIGITAL CALM</div>
                        <div class="node-desc">Home Integration</div>
                    </div>
                    <div class="node n1"><div class="node-title">HOME DATA</div><div class="node-desc">Architecture</div></div>
                    <div class="node n2"><div class="node-title">FINANCES</div><div class="node-desc">Dashboards</div></div>
                    <div class="node n3"><div class="node-title">NETWORKS</div><div class="node-desc">Performance</div></div>
                    <div class="node n4"><div class="node-title">LEGACY MEDIA</div><div class="node-desc">Modernization</div></div>
                    <div class="node n5"><div class="node-title">SMART HOME</div><div class="node-desc">Governance</div></div>
                    <div class="node n6"><div class="node-title">HOUSEHOLD</div><div class="node-desc">Strategic Insights</div></div>
                </div>
            </div>

            <div class="control-panel">
                <div class="panel-header">SME & Corporate</div>
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
    </main>

    <div class="ticker-wrapper">
        <div class="ticker-track">
            <div class="ticker-item"><i class="fas fa-sync-alt"></i> Legacy Reverse Engineering</div>
            <div class="ticker-item"><i class="fas fa-infinity"></i> End-to-End Data Warehousing</div>
            <div class="ticker-item"><i class="fas fa-network-wired"></i> Scalable Data Integration</div>
            <div class="ticker-item"><i class="fas fa-cloud-upload-alt"></i> Cloud Data Migration</div>
            <div class="ticker-item"><i class="fas fa-sitemap"></i> Dimensional Data Modeling</div>
            <div class="ticker-item"><i class="fas fa-microchip"></i> High-Performance T-SQL</div>
            <div class="ticker-item"><i class="fas fa-sync-alt"></i> Legacy Reverse Engineering</div>
            <div class="ticker-item"><i class="fas fa-infinity"></i> End-to-End Data Warehousing</div>
        </div>
    </div>

    <footer style="padding: 15px; background: #000b1a; text-align: center; font-size: 0.65rem; color: rgba(255,255,255,0.4);">
        <p>&copy; 2026 Holistic Data Pro. All rights reserved.</p>
    </footer>

</body>
</html>
