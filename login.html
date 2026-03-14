<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Holistic Data Pro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* MODERN RESET & VARIABLES */
        :root {
            --brand-blue-light: #0077c8;
            --brand-blue-dark: #001f3f;
            --brand-gold: #ffc629;
            --brand-green: #4ade80;
            --text-white: #ffffff;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --error-red: #ff4b2b;
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
        .video-container {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -2; overflow: hidden;
        }
        #bg-video {
            min-width: 100%; min-height: 100%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); object-fit: cover;
        }
        .video-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, rgba(0, 119, 200, 0.7) 0%, rgba(0, 31, 63, 0.9) 100%);
            z-index: -1; 
        }

        /* --- NAVIGATION --- */
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
        .dropdown:hover .dropdown-content { display: block; animation: dropdownFade 0.3s ease; }
        .dropdown-content a { display: block; padding: 12px 20px; border-bottom: 1px solid rgba(255,255,255,0.05); font-size: 0.75rem !important; }
        .dropdown-content a i { margin-right: 10px; color: var(--brand-green); width: 15px; text-align: center; }

        .dropdown-header { padding: 10px 20px 5px 20px; font-size: 0.6rem; color: var(--brand-green); letter-spacing: 2px; text-transform: uppercase; opacity: 0.7; }

        .nav-buttons { display: flex; gap: 10px; align-items: center; }
        .nav-btn-green { text-decoration: none; padding: 6px 14px; border-radius: 50px; border: 2px solid var(--brand-green); color: white !important; font-weight: 700; font-size: 0.65rem; transition: all 0.3s ease; text-transform: uppercase; white-space: nowrap; }
        .nav-btn-green:hover { background: rgba(74, 222, 128, 0.15); box-shadow: 0 0 10px rgba(74, 222, 128, 0.4); transform: translateY(-1px); }

        /* --- LOGIN CARD --- */
        .main-content {
            flex: 1; display: flex; justify-content: center; align-items: center;
            padding: 40px 5%;
        }

        .login-card {
            background: rgba(0, 31, 63, 0.7); backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px);
            padding: 40px; border-radius: 20px; border: 1px solid var(--glass-border);
            text-align: center; width: 380px; max-width: 100%;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            animation: cardEntrance 0.8s ease-out;
        }

        @keyframes cardEntrance { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes dropdownFade { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }

        h2 { color: var(--brand-green); font-size: 1.8rem; margin-bottom: 25px; font-weight: 400; letter-spacing: 2px; text-transform: uppercase; }

        #error-msg { color: var(--error-red); font-size: 0.85rem; margin-bottom: 15px; display: none; }

        input[type="email"], input[type="password"] {
            width: 100%; padding: 14px; margin: 12px 0; border-radius: 8px;
            border: 1px solid var(--glass-border); background: rgba(0, 31, 63, 0.5);
            color: white; font-size: 1rem; outline: none; transition: 0.3s;
        }

        input:focus { border-color: var(--brand-gold); background: rgba(0, 31, 63, 0.8); box-shadow: 0 0 10px rgba(255, 198, 41, 0.2); }

        .show-password-container { display: flex; align-items: center; gap: 10px; margin: 5px 0 15px 5px; cursor: pointer; }
        .show-password-container input[type="checkbox"] { width: 18px; height: 18px; cursor: pointer; accent-color: var(--brand-green); }
        .show-password-container label { font-size: 0.85rem; color: rgba(255,255,255,0.8); cursor: pointer; user-select: none; }

        .btn-login {
            width: 100%; padding: 15px; margin-top: 10px; border: none; border-radius: 50px;
            background: var(--brand-green); color: #002d58; font-weight: 800;
            text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: 0.3s;
            box-shadow: 0 10px 20px rgba(74, 222, 128, 0.2);
        }

        .btn-login:hover { transform: translateY(-3px); background: #ffffff; box-shadow: 0 15px 30px rgba(255, 255, 255, 0.2); }

        .back-link { display: inline-block; margin-top: 25px; color: var(--brand-gold); text-decoration: none; font-size: 0.9rem; transition: 0.3s; }
        .back-link:hover { color: #ffffff; text-decoration: underline; }

        footer { padding: 20px; background: #000b1a; text-align: center; font-size: 0.65rem; color: rgba(255,255,255,0.4); border-top: 1px solid rgba(255,255,255,0.05); }

        /* --- MOBILE RESPONSIVENESS --- */
        @media (max-width: 900px) {
            .nav-container { justify-content: center; }
            .nav-left-group { flex-direction: column; gap: 10px; }
            .nav-buttons { 
                display: grid; grid-template-columns: 1fr 1fr; 
                gap: 12px; width: 100%; max-width: 500px; margin-top: 10px;
            }
            .nav-btn-green { text-align: center; padding: 10px; font-size: 0.6rem; }
        }
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

    <div class="main-content">
        <div class="login-card">
            <h2>CLIENT ACCESS</h2>
            <div id="error-msg">Invalid email or password. Please try again.</div>

            <form action="https://www.holisticdatapro.com/api/login_process.php" method="POST">
                <input type="email" name="user_email" placeholder="Email Address" required>
                <input type="password" name="user_password" id="loginPassword" placeholder="Password" required>
                
                <div class="show-password-container">
                    <input type="checkbox" id="togglePassword">
                    <label for="togglePassword">Show Password</label>
                </div>

                <button type="submit" class="btn-login">Unlock Dashboard</button>
            </form>
            <a href="index.html" class="back-link"><i class="fas fa-arrow-left"></i> Back to Home</a>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 Holistic Data Pro. All rights reserved.</p>
    </footer>

    <script>
        const passwordInput = document.getElementById('loginPassword');
        const toggleCheckbox = document.getElementById('togglePassword');

        toggleCheckbox.addEventListener('change', function() {
            passwordInput.type = this.checked ? 'text' : 'password';
        });

        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('error')) {
            document.getElementById('error-msg').style.display = 'block';
        }
    </script>
</body>
</html>
