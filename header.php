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
        position: sticky; /* Changed to sticky so it stays at the top */
        top: 0;
        z-index: 1000;
    }

    .logo {
        font-weight: 900;
        letter-spacing: 3px;
        color: #fff;
        text-decoration: none;
        font-size: 1.2rem;
        /* Using your brand gradient if available */
        background: linear-gradient(to bottom, #fff, var(--brand-green, #4ade80));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Desktop Nav */
    .nav-links {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .nav-links a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        font-size: 0.75rem;
        font-weight: bold;
        text-transform: uppercase;
        transition: 0.3s;
        padding: 8px 15px;
        border: 1px solid transparent;
        border-radius: 20px;
    }

    .nav-links a:hover {
        color: var(--brand-green, #4ade80);
        border-color: var(--brand-green, #4ade80);
    }

    /* Special Styling for New Buttons */
    .btn-subscribe {
        background: var(--brand-green, #4ade80) !important;
        color: #000 !important;
        border-color: var(--brand-green, #4ade80) !important;
    }

    .btn-login {
        border-color: rgba(255, 255, 255, 0.3) !important;
    }

    /* Mobile Menu Toggle */
    .menu-toggle {
        display: none;
        flex-direction: column;
        gap: 5px;
        cursor: pointer;
        background: none;
        border: none;
        padding: 5px;
    }

    .menu-toggle span {
        display: block;
        width: 25px;
        height: 2px;
        background: white;
        transition: 0.3s;
    }

    /* Mobile Specific Styles */
    @media (max-width: 992px) { /* Increased breakpoint to accommodate more links */
        .menu-toggle { display: flex; }

        .nav-links {
            display: none; 
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: rgba(0, 11, 26, 0.98); /* Slightly darker for readability */
            flex-direction: column;
            padding: 30px 20px;
            gap: 15px;
            border-bottom: 2px solid var(--brand-green, #4ade80);
        }

        .nav-links.active {
            display: flex;
        }

        .nav-links a {
            width: 100%;
            text-align: center;
            padding: 12px;
        }
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
        <a href="login.php" class="btn-login">Login</a>
        <a href="subscribe.php" class="btn-subscribe">Subscribe</a>
    </nav>
</header>

<script>
    function toggleMenu() {
        const nav = document.getElementById('navLinks');
        nav.classList.toggle('active');
    }

    // Close menu when clicking a link
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', () => {
            document.getElementById('navLinks').classList.remove('active');
        });
    });
</script>
