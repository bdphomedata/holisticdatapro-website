<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solutions | Holistic Data Pro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* REUSING YOUR BRAND VARIABLES */
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

        /* --- VIDEO BACKGROUND --- */
        .video-container { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -2; overflow: hidden; }
        #bg-video { min-width: 100%; min-height: 100%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); object-fit: cover; }
        .video-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(0, 119, 200, 0.7) 0%, rgba(0, 31, 63, 0.9) 100%); z-index: -1; }

        /* --- SOLUTIONS HERO (Optimized for Mobile) --- */
        .solutions-hero { 
            padding: 60px 5% 20px 5%;
            text-align: center; 
            max-width: 1200px; 
            margin: 0 auto; 
            background: transparent;
        }
        
        .solutions-hero h1 { 
            font-size: 3.5rem; 
            line-height: 1.1;
            margin-bottom: 20px;
            text-transform: uppercase; 
            letter-spacing: 4px; 
            color: #ffffff;
            display: block;
            width: 100%;
        }

        /* --- SOLUTIONS GRID --- */
        .solutions-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); 
            gap: 25px; 
            padding: 20px 5% 100px 5%; 
            max-width: 1600px; 
            margin: 0 auto; 
        }

        .solution-card { 
            background: var(--glass-bg); 
            border: 1px solid var(--glass-border); 
            border-radius: 20px; 
            padding: 40px; 
            backdrop-filter: blur(15px); 
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
            display: flex; 
            flex-direction: column; 
            gap: 20px; 
            position: relative; 
            overflow: hidden; 
        }

        .solution-card:hover { 
            border-color: var(--brand-green); 
            transform: translateY(-10px); 
            background: rgba(255, 255, 255, 0.08); 
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4); 
        }
        
        .card-icon { font-size: 3rem; color: var(--brand-green); text-shadow: 0 0 15px rgba(74, 222, 128, 0.3); }
        .tag { font-size: 0.7rem; font-weight: 900; background: rgba(74, 222, 128, 0.2); color: var(--brand-green); padding: 5px 12px; border-radius: 50px; width: fit-content; text-transform: uppercase; }
        .solution-card h3 { font-size: 1.6rem; color: var(--brand-gold); letter-spacing: 1px; }
        .solution-card p { font-size: 0.95rem; line-height: 1.6; color: #d1d9e0; }
        
        .feature-list { list-style: none; margin-top: 10px; }
        .feature-list li { font-size: 0.85rem; margin-bottom: 8px; display: flex; align-items: center; gap: 10px; color: var(--brand-green); font-weight: 600; }
        
        .automation-bar { 
            background: rgba(37, 211, 102, 0.1); 
            border: 1px solid rgba(37, 211, 102, 0.3); 
            border-radius: 15px; 
            padding: 20px; 
            margin-top: auto; 
            display: flex; 
            align-items: center; 
            gap: 15px; 
        }
        .automation-bar i { color: #25D366; font-size: 1.5rem; }
        .automation-text { font-size: 0.75rem; font-weight: 700; color: #fff; text-transform: uppercase; }
        
        footer { padding: 20px; background: #000b1a; text-align: center; font-size: 0.6rem; color: rgba(255,255,255,0.4); border-top: 1px solid rgba(255,255,255,0.05); }

        /* --- RESPONSIVE FIXES (THE "GET IT RIGHT" SECTION) --- */
        @media (max-width: 768px) {
            .solutions-hero { padding: 40px 5% 10px 5%; }
            .solutions-hero h1 { 
                font-size: 2.2rem; 
                letter-spacing: 2px; 
            }
            .solutions-grid { 
                grid-template-columns: 1fr; 
                padding-bottom: 60px;
            }
            .solution-card { padding: 30px; }
        }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
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

    <header class="solutions-hero">
        <h1>The Intelligence Suite</h1>
    </header>

    <main class="solutions-grid">
        
        <div class="solution-card">
            <div class="tag">Flagship Ecosystem</div>
            <i class="fas fa-hubspot card-icon"></i>
            <h3>Holistic Data Core</h3>
            <p>A unified command center replacing fragmented tools. Integrated CRM, Deal Tracking, and Project Management built on Azure SQL.</p>
            <ul class="feature-list">
                <li><i class="fas fa-check"></i> 360° Lead Management</li>
                <li><i class="fas fa-check"></i> Visual Kanban Pipelines</li>
                <li><i class="fas fa-check"></i> Real-time DB Syncing</li>
            </ul>
            <div class="automation-bar">
                <i class="fab fa-whatsapp"></i>
                <div class="automation-text">WhatsApp Instant Lead Notification Integrated</div>
            </div>
        </div>

        <div class="solution-card">
            <div class="tag">Governance & Audit</div>
            <i class="fas fa-clipboard-check card-icon"></i>
            <h3>Protocol Pro</h3>
            <p>Digitalize your Standard Operating Procedures. A live environment for version-controlled documentation and technical compliance auditing.</p>
            <ul class="feature-list">
                <li><i class="fas fa-check"></i> Version 1.0 Release Tracking</li>
                <li><i class="fas fa-check"></i> Automated Audit Trails</li>
                <li><i class="fas fa-check"></i> Digital SOP Sign-off</li>
            </ul>
            <div class="automation-bar">
                <i class="fab fa-whatsapp"></i>
                <div class="automation-text">WhatsApp Compliance Alerts Integrated</div>
            </div>
        </div>

        <div class="solution-card">
            <div class="tag">Education Tech</div>
            <i class="fas fa-user-graduate card-icon"></i>
            <h3>Learner Matrix</h3>
            <p>High-capacity student management. Engineered to handle 5,000+ registrations with specialized portals for learners and administrators.</p>
            <ul class="feature-list">
                <li><i class="fas fa-check"></i> 5K+ Scalable Architecture</li>
                <li><i class="fas fa-check"></i> Automated Enrollment</li>
                <li><i class="fas fa-check"></i> Performance Dashboards</li>
            </ul>
            <div class="automation-bar">
                <i class="fab fa-whatsapp"></i>
                <div class="automation-text">WhatsApp Credential Delivery Integrated</div>
            </div>
        </div>

    </main>

    <footer>
        <p>&copy; 2026 Holistic Data Pro. All rights reserved.</p>
    </footer>

</body>
</html>
