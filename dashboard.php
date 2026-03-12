<?php
session_start();

// THE GATEKEEPER: If the user isn't logged in, kick them back to the login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit;
}

// Get the user's name from the session we set in login_process.php
$displayName = htmlspecialchars($_SESSION['user_name']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Holistic Data Pro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --brand-blue-light: #0077c8;
            --brand-blue-dark: #001f3f;
            --brand-gold: #ffc629;
            --brand-green: #4ade80;
            --text-white: #ffffff;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #000b1a; /* Dark professional background */
            color: white;
            display: flex;
            min-height: 100vh;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 260px;
            background: rgba(0, 31, 63, 0.8);
            backdrop-filter: blur(10px);
            border-right: 1px solid var(--glass-border);
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .sidebar h2 {
            color: var(--brand-green);
            font-size: 1.2rem;
            letter-spacing: 2px;
            margin-bottom: 40px;
        }

        .nav-item {
            padding: 15px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: 0.3s;
            border-radius: 8px;
        }

        .nav-item:hover, .nav-item.active {
            background: rgba(74, 222, 128, 0.1);
            color: var(--brand-green);
        }

        /* --- MAIN PANEL --- */
        .main-panel {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .welcome-text h1 {
            margin: 0;
            font-weight: 300;
        }

        .welcome-text span {
            color: var(--brand-green);
            font-weight: 700;
        }

        .logout-btn {
            padding: 10px 20px;
            border: 1px solid var(--brand-gold);
            color: var(--brand-gold);
            text-decoration: none;
            border-radius: 50px;
            font-size: 0.8rem;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: var(--brand-gold);
            color: #000;
        }

        /* --- DASHBOARD CARDS --- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            padding: 30px;
            border-radius: 15px;
            text-align: left;
        }

        .card i {
            font-size: 2rem;
            color: var(--brand-green);
            margin-bottom: 15px;
        }

        .card h3 { margin: 0; font-size: 0.9rem; opacity: 0.6; }
        .card p { font-size: 1.8rem; margin: 10px 0 0; font-weight: 700; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>HDP CORE</h2>
        <a href="#" class="nav-item active"><i class="fas fa-chart-line"></i> Overview</a>
        <a href="#" class="nav-item"><i class="fas fa-database"></i> Data Sets</a>
        <a href="#" class="nav-item"><i class="fas fa-user-shield"></i> Security</a>
        <a href="#" class="nav-item"><i class="fas fa-cog"></i> Settings</a>
    </div>

    <div class="main-panel">
        <div class="header">
            <div class="welcome-text">
                <h1>Welcome back, <span><?php echo $displayName; ?></span></h1>
                <p>System status: <span style="color: var(--brand-green);">Operational</span></p>
            </div>
            <a href="api/logout.php" class="logout-btn">SECURE LOGOUT</a>
        </div>

        <div class="stats-grid">
            <div class="card">
                <i class="fas fa-server"></i>
                <h3>Active Connections</h3>
                <p>1,284</p>
            </div>
            <div class="card">
                <i class="fas fa-microchip"></i>
                <h3>System Load</h3>
                <p>14%</p>
            </div>
            <div class="card">
                <i class="fas fa-shield-alt"></i>
                <h3>Security Patches</h3>
                <p>Up to Date</p>
            </div>
        </div>
    </div>

</body>
</html>
