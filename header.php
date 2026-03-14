<style>
    /* Navigation Bar Base */
    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 5%;
        background: rgba(0, 31, 63, 0.8);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        position: sticky;
        top: 0;
        z-index: 1000;
        width: 100%;
    }

    .logo {
        font-weight: 800;
        letter-spacing: 2px;
        color: #fff;
        text-decoration: none;
        font-size: 1.1rem;
        text-transform: uppercase;
    }

    /* Desktop Navigation */
    .nav-links {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .nav-links a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        padding: 8px 16px;
        border: 1px solid transparent;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .nav-links a:hover, .nav-links a.active-link {
        color: var(--brand-green);
        border-color: var(--brand-green);
        background: rgba(74, 222, 128, 0.05);
    }

    /* Hamburger Toggle Button */
    .menu-toggle {
        display: none;
        flex-direction: column;
        justify-content: space-between;
        width: 24px;
        height: 18px;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        z-index: 1100;
    }

    .menu-toggle span {
        width: 100%;
        height: 2px;
        background-color: #fff;
        transition: all 0.3s ease;
    }

    /* Mobile Logic (Phones) */
    @media (max-width: 768px) {
        .menu-toggle {
            display: flex;
        }

        .nav-links {
            display: none; /* Hidden by default */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: var(--brand-blue-dark);
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 25px;
            z-index: 1050;
        }

        .nav-links.show {
            display: flex;
        }

        .nav-links a {
            font-size: 1.2rem;
            width: 80%;
            text-align: center;
        }
    }
</style>

<header>
    <a href="index.php" class="logo">Holistic Data Pro</a>
    
    <button class="menu-toggle" id="mobile-menu-btn" onclick="toggleMobileMenu()">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <nav class="nav-links" id="nav-menu">
        <a href="index.php">Home</a>
        <a href="services.php">Services</a>
        <a href="solutions.php">Solutions</a>
        <a href="neural_break.php">Neural Break</a>
        <a href="contact.php">Connect</a>
        <a href="profile.php" style="color: var(--brand-green); border-color: var(--brand-green);">Profile</a>
    </nav>
</header>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('nav-menu');
        const btn = document.getElementById('mobile-menu-btn');
        menu.classList.toggle('show');
        
        // Optional: Animate hamburger to X
        btn.classList.toggle('open');
    }
</script>
