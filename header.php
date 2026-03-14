<?php
// header.php
?>
<style>
    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 30px;
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .logo {
        font-weight: 900;
        letter-spacing: 3px;
        color: #fff;
        text-decoration: none;
        font-size: 1.2rem;
        background: linear-gradient(to bottom, #fff, var(--brand-green, #4ade80));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* --- HAMBURGER MENU ALWAYS VISIBLE --- */
    .menu-toggle {
        display: flex; /* Changed from 'none' to 'flex' for desktop */
        flex-direction: column;
        gap: 5px;
        cursor: pointer;
        background: none;
        border: none;
        padding: 10px;
    }

    .menu-toggle span {
        display: block;
        width: 25px;
        height: 2px;
        background: white;
        transition: 0.3s;
        box-shadow: 0 0 8px rgba(74, 222, 128, 0.4);
    }

    /* --- NAVIGATION LINKS HIDDEN BY DEFAULT --- */
    .nav-links {
        display: none; 
        position: absolute;
        top: 100%;
        right: 0; /* Align to the right side of the screen */
        width: 300px;
        background: rgba(0, 11, 26, 0.98);
        flex-direction: column;
        padding: 30px 20px;
        gap: 15px;
        border-left: 1px solid rgba(255, 255, 255, 0.1);
        border-bottom: 2px solid var(--brand-green, #4ade80);
        box-shadow: -10px 10px 30px rgba(0,0,0,0.5);
    }

    .nav-links.active {
        display: flex;
        animation: fadeInDown 0.3s ease-out;
    }

    /* Mobile specific: make menu full width */
    @media (max-width: 600px) {
        .nav-links {
            width: 100%;
        }
    }

    .nav-links a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: bold;
        text-transform: uppercase;
        transition: 0.3s;
        padding: 12px 15px;
        border-radius: 5px;
        text-align: right; /* Text aligns with the hamburger position */
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .nav-links a:hover {
        color: var(--brand-green, #4ade80);
        background: rgba(255, 255, 255, 0.05);
        padding-right: 25px;
    }

    .btn-subscribe {
        background: var(--brand-green, #4ade80) !important;
        color: #000 !important;
        text-align: center !important;
    }

    .btn-login {
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
        text-align: center !important;
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<header>
    <a href="index.php" class="logo">HOLISTIC DATA PRO</a>
    
    <button class="menu-toggle" onclick="toggleMenu()" aria-label="Menu">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <nav class="nav-links" id="navLinks">
        <a href="index.php">Home</a>
        <a href="services.php">Services</a>
        <a href="solutions.php">Solutions</a>
        <a href="neuralbreak.php">Neural Break</a>
        <a href="contact.php">Connect</a>
        <div style="margin-top: 10px; display: flex; flex-direction: column; gap: 10px;">
            <a href="login.php" class="btn-login">Login</a>
            <a href="subscribe.php" class="btn-subscribe">Subscribe</a>
        </div>
    </nav>
</header>

<script>
    function toggleMenu() {
        const nav = document.getElementById('navLinks');
        nav.classList.toggle('active');
    }

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        const nav = document.getElementById('navLinks');
        const btn = document.querySelector('.menu-toggle');
        if (!nav.contains(event.target) && !btn.contains(event.target)) {
            nav.classList.remove('active');
        }
    });
</script>
