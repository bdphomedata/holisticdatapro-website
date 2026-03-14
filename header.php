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

    /* --- SIDEBAR MENU (FIXED HEIGHT) --- */
    .nav-links {
        display: none; 
        position: absolute;
        top: 100%;
        left: 0;
        width: 300px;
        /* CHANGED: height auto ensures it ends after the buttons */
        height: auto; 
        background: rgba(0, 11, 26, 0.98);
        flex-direction: column;
        padding: 40px 20px;
        gap: 15px; /* Tighter gap to match the image */
        border-right: 1px solid var(--brand-green, #4ade80);
        border-bottom: 1px solid var(--brand-green, #4ade80); /* Added bottom border to close the box */
        box-shadow: 10px 10px 30px rgba(0,0,0,0.5);
    }

    .nav-links.active {
        display: flex;
        animation: slideInLeft 0.3s ease-out;
    }

    .nav-links a {
        color: #fff;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;
        transition: 0.3s;
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    /* --- BUTTON STYLES MATCHING YOUR IMAGE --- */
    .btn-login {
        border: 1px solid rgba(255, 255, 255, 0.5) !important;
        margin-top: 10px;
    }

    .btn-subscribe {
        border: 2px solid var(--brand-green, #4ade80) !important;
        color: var(--brand-green, #4ade80) !important;
    }

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
        <a href="index.php">Home</a>
        <a href="services.php">Services</a>
        <a href="solutions.php">Solutions</a>
        <a href="neuralbreak.php">Neural Break</a>
        <a href="contact.php">Connect</a>
        
        <a href="login.php" class="btn-login">Login</a>
        <a href="subscribe.php" class="btn-subscribe">Subscribe</a>
    </nav>
</header>

<script>
    function toggleMenu() {
        const nav = document.getElementById('navLinks');
        nav.classList.toggle('active');
    }

    document.addEventListener('click', function(event) {
        const nav = document.getElementById('navLinks');
        const btn = document.querySelector('.menu-toggle');
        if (nav.classList.contains('active') && !nav.contains(event.target) && !btn.contains(event.target)) {
            nav.classList.remove('active');
        }
    });
</script>
