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
        position: relative;
        z-index: 1000;
    }

    .logo {
        font-weight: 900;
        letter-spacing: 3px;
        color: #fff;
        text-decoration: none;
        font-size: 1.2rem;
    }

    /* Desktop Nav */
    .nav-links {
        display: flex;
        gap: 20px;
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
        color: var(--brand-green);
        border-color: var(--brand-green);
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
    @media (max-width: 768px) {
        .menu-toggle { display: flex; }

        .nav-links {
            display: none; /* Hidden by default on mobile */
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: rgba(0, 31, 63, 0.95);
            flex-direction: column;
            padding: 20px;
            gap: 15px;
            border-bottom: 2px solid var(--brand-green);
        }

        .nav-links.active {
            display: flex;
        }

        .nav-links a {
            width: 100%;
            text-align: center;
        }
    }
</style>

<header>
    <a href="index.php" class="logo">HOLISTIC DATA PRO</a>
    
    <button class="menu-toggle" onclick="toggleMenu()">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <nav class="nav-links" id="navLinks">
        <a href="index.php">Home</a>
        <a href="services.php">Services</a>
        <a href="solutions.php">Solutions</a>
        <a href="neural_break.php">Neural Break</a>
        <a href="contact.php">Connect</a>
        <a href="profile.php" style="border-color: var(--brand-green); color: var(--brand-green);">Profile</a>
    </nav>
</header>

<script>
    function toggleMenu() {
        const nav = document.getElementById('navLinks');
        nav.classList.toggle('active');
    }
</script>
