<?php
// header.php
?>
<style>
    header {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        padding: 15px 30px;
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        position: sticky;
        top: 0;
        z-index: 1000;
        gap: 20px;
    }

    .logo {
        font-weight: 900;
        letter-spacing: 3px;
        color: #fff;
        text-decoration: none;
        font-size: 1.4rem;
        background: linear-gradient(to bottom, #fff, var(--brand-green, #4ade80));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-transform: uppercase;
    }

    .menu-toggle {
        display: flex;
        flex-direction: column;
        gap: 6px;
        cursor: pointer;
        background: none;
        border: none;
        padding: 5px;
    }

    .menu-toggle span {
        display: block;
        width: 28px;
        height: 2px;
        background: var(--brand-green, #4ade80);
        transition: 0.3s;
        box-shadow: 0 0 8px rgba(74, 222, 128, 0.4);
    }

    .nav-links {
        display: none; 
        position: absolute;
        top: 100%;
        left: 0;
        width: 300px;
        height: auto; 
        background: rgba(0, 11, 26, 0.98);
        flex-direction: column;
        padding: 40px 20px;
        gap: 10px;
        border-right: 1px solid var(--brand-green, #4ade80);
        border-bottom: 1px solid var(--brand-green, #4ade80);
        box-shadow: 10px 10px 30px rgba(0,0,0,0.5);
    }

    .nav-links.active {
        display: flex;
        animation: slideInLeft 0.3s ease-out;
    }

    .nav-links a, .dropdown-btn {
        color: #fff;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;
        transition: 0.3s;
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        cursor: pointer;
        background: none;
        border-top: none;
        border-left: none;
        border-right: none;
        width: 100%;
        display: flex;
        align-items: center;
    }

    /* Icon Spacing */
    .nav-links a i, .dropdown-btn i:first-child {
        margin-right: 15px;
        width: 20px; /* Keeps icons aligned even if widths differ */
        color: var(--brand-green, #4ade80);
        text-align: center;
    }

    /* Caret Alignment for Dropdown */
    .dropdown-btn .fa-caret-down {
        margin-left: auto;
        margin-right: 0;
    }

    /* --- DROPDOWN SUB-MENU --- */
    .dropdown-container {
        display: none;
        background: rgba(255, 255, 255, 0.03);
        flex-direction: column;
    }

    .dropdown-container a {
        font-size: 0.75rem;
        color: var(--brand-green, #4ade80);
        border-bottom: 1px solid rgba(255, 255, 255, 0.02);
        padding-left: 50px; /* Pushed further to clear the main icons */
    }

    .dropdown-container.show {
        display: flex;
    }

    /* --- BUTTON STYLES --- */
    .btn-login {
        border: 1px solid rgba(255, 255, 255, 0.5) !important;
        margin-top: 10px;
        justify-content: center !important;
    }

    .btn-login i { margin-right: 10px; }

    .btn-subscribe {
        border: 2px solid var(--brand-green, #4ade80) !important;
        color: var(--brand-green, #4ade80) !important;
        justify-content: center !important;
    }

    .btn-subscribe i { margin-right: 10px; }

    @keyframes slideInLeft {
        from { opacity: 0; transform: translateX(-30px); }
        to { opacity: 1; transform: translateX(0); }
    }
</style>

<header>
    <button class="menu-toggle" onclick="toggleMenu()" aria-label="Menu">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <a href="index.php" class="logo">HOLISTIC DATA PRO</a>
    
    <nav class="nav-links" id="navLinks">
        <a href="index.php"><i class="fas fa-home"></i> Home</a>
        
        <button class="dropdown-btn" onclick="toggleDropdown()">
            <i class="fas fa-layer-group"></i> Services 
            <i class="fas fa-caret-down"></i>
        </button>
        <div class="dropdown-container" id="servicesDropdown">
            <a href="homeusers.php"><i class="fas fa-house-user"></i> Home Users</a>
            <a href="corporate.php"><i class="fas fa-building"></i> SME & Corporate</a>
        </div>

        <a href="solutions.php"><i class="fas fa-lightbulb"></i> Solutions</a>
        <a href="neuralbreak.php"><i class="fas fa-brain"></i> Neural Break</a>
        <a href="contact.php"><i class="fas fa-link"></i> Connect</a>
        
        <a href="login.php" class="btn-login"><i class="fas fa-sign-in-alt"></i> Login</a>
        <a href="subscribe.php" class="btn-subscribe"><i class="fas fa-bell"></i> Subscribe</a>
    </nav>
</header>

<script>
    function toggleMenu() {
        const nav = document.getElementById('navLinks');
        nav.classList.toggle('active');
        if(!nav.classList.contains('active')) {
            document.getElementById('servicesDropdown').classList.remove('show');
        }
    }

    function toggleDropdown() {
        const dropdown = document.getElementById('servicesDropdown');
        dropdown.classList.toggle('show');
    }

    document.addEventListener('click', function(event) {
        const nav = document.getElementById('navLinks');
        const btn = document.querySelector('.menu-toggle');
        
        if (nav.classList.contains('active') && 
            !nav.contains(event.target) && 
            !btn.contains(event.target)) {
            nav.classList.remove('active');
            document.getElementById('servicesDropdown').classList.remove('show');
        }
    });
</script>
