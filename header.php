<style>
    /* --- NAVIGATION LOGIC FROM YOUR BACKUP --- */
    nav {
        width: 100%;
        padding: 0.8rem 3%;
        background: rgba(0, 31, 63, 0.4);
        backdrop-filter: blur(15px);
        border-bottom: 1px solid var(--glass-border);
        z-index: 1000;
    }

    .nav-container {
        max-width: 1600px; margin: 0 auto;
        display: flex; justify-content: space-between; align-items: center;
        flex-wrap: wrap; gap: 15px;
    }

    .nav-left-group { display: flex; align-items: center; gap: 40px; }

    .logo-static { 
        font-size: 1.8rem; font-weight: 900; letter-spacing: 4px; text-transform: uppercase;
        background: linear-gradient(to bottom, #fff 0%, #e0e0e0 45%, var(--brand-green) 50%, #fff 55%, #b0b0b0 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        filter: drop-shadow(0px 1px 0px #ffffff) drop-shadow(0px 3px 5px rgba(0,0,0,0.8)) drop-shadow(0px 0px 12px rgba(74, 222, 128, 0.4));
        display: inline-block;
    }

    .nav-links { display: flex; gap: 20px; align-items: center; }
    .nav-links a, .nav-links .dropdown-label { 
        color: #ffffff !important; text-decoration: none; font-weight: 600; 
        font-size: 0.8rem; text-transform: uppercase; transition: 0.3s; opacity: 0.9; 
        cursor: pointer;
    }
    .nav-links a:hover, .nav-links .dropdown:hover .dropdown-label { color: var(--brand-gold) !important; opacity: 1; }

    .dropdown { position: relative; display: inline-block; padding: 10px 0; }
    .dropdown-content { 
        display: none; position: absolute; background: rgba(0, 31, 63, 0.95); min-width: 240px; 
        border-top: 3px solid var(--brand-gold); top: 100%; left: 0; backdrop-filter: blur(20px); 
        box-shadow: 0 10px 30px rgba(0,0,0,0.5); padding: 10px 0; z-index: 1001;
    }
    .dropdown:hover .dropdown-content { display: block; animation: fadeIn 0.3s ease; }
    .dropdown-content a { display: block; padding: 12px 20px; border-bottom: 1px solid rgba(255,255,255,0.05); font-size: 0.75rem !important; }

    .nav-buttons { display: flex; gap: 10px; align-items: center; flex-wrap: wrap; justify-content: center; }
    .nav-btn-green { text-decoration: none; padding: 6px 14px; border-radius: 50px; border: 2px solid var(--brand-green); color: white !important; font-weight: 700; font-size: 0.65rem; transition: all 0.3s ease; text-transform: uppercase; white-space: nowrap; }
    .nav-btn-green:hover { background: rgba(74, 222, 128, 0.15); box-shadow: 0 0 10px rgba(74, 222, 128, 0.4); transform: translateY(-1px); }

    @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
</style>

<nav>
    <div class="nav-container">
        <div class="nav-left-group">
            <span class="logo-static">HOLISTIC DATA PRO</span>
            <div class="nav-links">
                <div class="dropdown">
                    <span class="dropdown-label">SERVICES <i class="fas fa-caret-down"></i></span>
                    <div class="dropdown-content">
                        <a href="services-home.php"><i class="fas fa-home"></i> HOME USERS</a>
                        <a href="services-corporate.php"><i class="fas fa-building"></i> SME & CORPORATE</a>
                    </div>
                </div>
                <a href="solutions.php">SOLUTIONS</a>
                <a href="neural-break.php">NEURAL BREAK</a>
            </div>
        </div>
        <div class="nav-buttons">
            <a href="index.php" class="nav-btn-green">HOME</a>
            <a href="subscribe.php" class="nav-btn-green">SUBSCRIBE</a>
            <a href="login.php" class="nav-btn-green">LOGIN</a>
            <a href="contact.php" class="nav-btn-green">CONNECT</a>
            <a href="Bartus-de-Paiva-CV.docx" class="nav-btn-green" download>PROFILE</a>
        </div>
    </div>
</nav>
