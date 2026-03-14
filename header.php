<style>
    header {
        width: 100%;
        padding: 1rem 5%;
        background: rgba(0, 31, 63, 0.4);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        justify-content: space-between; /* Changes to push buttons to the right */
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    /* Action Buttons for the Right Side */
    .header-actions {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .btn-login {
        color: white;
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: 600;
        letter-spacing: 1px;
        transition: 0.3s;
    }

    .btn-subscribe {
        padding: 8px 20px;
        background: var(--brand-green);
        color: #000 !important;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.8rem;
        border-radius: 5px;
        box-shadow: 0 0 15px rgba(74, 222, 128, 0.3);
        transition: 0.3s;
    }

    .btn-subscribe:hover {
        transform: scale(1.05);
        box-shadow: 0 0 20px rgba(74, 222, 128, 0.5);
    }

    /* --- THE REST OF YOUR EXISTING CSS --- */
    .menu-toggle {
        display: flex;
        flex-direction: column;
        gap: 6px;
        cursor: pointer;
        background: none;
        border: none;
        padding: 10px;
        z-index: 1100;
    }

    .menu-toggle span {
        display: block;
        width: 28px;
        height: 2px;
        background: var(--brand-green);
        transition: 0.3s ease;
        box-shadow: 0 0 8px rgba(74, 222, 128, 0.5);
    }

    .logo-static { 
        font-size: 1.6rem; 
        font-weight: 900; 
        letter-spacing: 3px; 
        text-transform: uppercase;
        background: linear-gradient(to bottom, #fff 0%, #e0e0e0 45%, var(--brand-green) 50%, #fff 55%, #b0b0b0 100%);
        -webkit-background-clip: text; 
        -webkit-text-fill-color: transparent;
        filter: drop-shadow(0px 1px 0px #ffffff) drop-shadow(0px 3px 5px rgba(0,0,0,0.8)) drop-shadow(0px 0px 12px rgba(74, 222, 128, 0.4));
        text-decoration: none;
    }

    .nav-links {
        display: none; 
        flex-direction: column;
        position: absolute;
        top: 100%;
        left: 0;
        width: 300px;
        background: rgba(0, 11, 26, 0.95);
        backdrop-filter: blur(20px);
        padding: 30px;
        gap: 20px;
        border-right: 1px solid var(--brand-green);
        border-bottom: 1px solid var(--brand-green);
    }

    .nav-links.active { display: flex; animation: slideInLeft 0.3s ease-out; }

    .nav-links a {
        color: #ffffff;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        transition: 0.3s;
        padding: 10px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    @keyframes slideInLeft {
        from { opacity: 0; transform: translateX(-20px); }
        to { opacity: 1; transform: translateX(0); }
    }
</style>

<header>
    <div class="header-left">
        <button class="menu-toggle" onclick="toggleMenu()" aria-label="Toggle Menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <a href="index.php" class="logo-static">HDP</a>
    </div>

    <div class="header-actions">
        <a href="login.php" class="btn-login">LOGIN</a>
        <a href="subscribe.php" class="btn-subscribe">SUBSCRIBE</a>
    </div>

    <nav class="nav-links" id="universalNav">
        <a href="index.php">Home</a>
        <a href="services.php">Services</a>
        <a href="solutions.php">Solutions</a>
        <a href="neuralbreak.php">Neural Break</a>
        <a href="contact.php">Connect</a>
        <a href="dashboard.php" style="border: 2px solid var(--brand-green); color: var(--brand-green); text-align: center; border-radius: 5px; margin-top: 10px;">Dashboard</a>
    </nav>
</header>
