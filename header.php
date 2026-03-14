<style>
    header {
        width: 100%;
        padding: 1rem 5%;
        background: rgba(0, 31, 63, 0.4);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    /* Your Signature Chrome/Green Logo */
    .logo-static { 
        font-size: 1.8rem; 
        font-weight: 900; 
        letter-spacing: 4px; 
        text-transform: uppercase;
        background: linear-gradient(to bottom, #fff 0%, #e0e0e0 45%, var(--brand-green) 50%, #fff 55%, #b0b0b0 100%);
        -webkit-background-clip: text; 
        -webkit-text-fill-color: transparent;
        filter: drop-shadow(0px 1px 0px #ffffff) drop-shadow(0px 3px 5px rgba(0,0,0,0.8)) drop-shadow(0px 0px 12px rgba(74, 222, 128, 0.4));
        text-decoration: none;
    }

    /* The Hamburger Button - Always Visible Now */
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
        width: 30px;
        height: 2px;
        background: var(--brand-green);
        transition: 0.3s ease;
        box-shadow: 0 0 8px rgba(74, 222, 128, 0.5);
    }

    /* The Dropdown Menu (Hidden by default) */
    .nav-links {
        display: none; 
        flex-direction: column;
        position: absolute;
        top: 100%;
        right: 0;
        width: 300px;
        background: rgba(0, 11, 26, 0.95);
        backdrop-filter: blur(20px);
        padding: 30px;
        gap: 20px;
        border-left: 1px solid var(--brand-green);
        border-bottom: 1px solid var(--brand-green);
        box-shadow: -10px 10px 30px rgba(0,0,0,0.5);
    }

    .nav-links.active {
        display: flex;
        animation: slideIn 0.3s ease-out;
    }

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

    .nav-links a:hover {
        color: var(--brand-green);
        padding-left: 10px;
    }

    /* Profile Button inside the Menu */
    .nav-btn-green {
        border: 2px solid var(--brand-green) !important;
        color: var(--brand-green) !important;
        text-align: center;
        border-radius: 5px;
        margin-top: 10px;
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateX(20px); }
        to { opacity: 1; transform: translateX(0); }
    }

    /* Small adjustments for actual mobile phones */
    @media (max-width: 600px) {
        .logo-static { font-size: 1.2rem; letter-spacing: 2px; }
        .nav-links { width: 100%; border-left: none; }
    }
</style>

<header>
    <a href="index.php" class="logo-static">HOLISTIC DATA PRO</a>
    
    <button class="menu-toggle" onclick="toggleMenu()" aria-label="Toggle Menu">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <nav class="nav-links" id="universalNav">
        <a href="index.php">Home</a>
        <a href="services.php">Services</a>
        <a href="solutions.php">Solutions</a>
        <a href="neural_break.php">Neural Break</a>
        <a href="contact.php">Connect</a>
        <a href="profile.php" class="nav-btn-green">View Profile</a>
    </nav>
</header>

<script>
function toggleMenu() {
    const nav = document.getElementById('universalNav');
    nav.classList.toggle('active');
}

// Close menu if clicking outside
document.addEventListener('click', function(event) {
    const nav = document.getElementById('universalNav');
    const btn = document.querySelector('.menu-toggle');
    if (!nav.contains(event.target) && !btn.contains(event.target)) {
        nav.classList.remove('active');
    }
});
</script>
