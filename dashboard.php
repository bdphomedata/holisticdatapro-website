<?php
session_start();
include 'config/db_connect.php'; 

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$userEmail = $_SESSION['user_email']; 

try {
    // 1. FETCH MAIN SUBSCRIBER DATA
    $stmt = $conn->prepare("SELECT SubscriberID, FirstName, Surname, Gender, EthnicGroup, Country, CreatedDate FROM subscribers WHERE Email = ?");
    $stmt->execute([$userEmail]);
    $sub = $stmt->fetch(PDO::FETCH_ASSOC);
    $subID = $sub['SubscriberID'];

    // 2. FETCH PERSONAL & PROVISIONING
    $stmt = $conn->prepare("SELECT Bio, DOB, Phone, JobTitle, Department FROM Subscriber_Personal WHERE SubscriberID = ?");
    $stmt->execute([$subID]);
    $personal = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$personal) {
        $conn->beginTransaction();
        try {
            $conn->prepare("INSERT INTO Subscriber_Personal (SubscriberID, Bio, JobTitle, Department) VALUES (?, 'New Dossier', 'Developer', 'General')")->execute([$subID]);
            $conn->prepare("INSERT INTO Subscriber_Settings (SubscriberID, UI_Language, Theme) VALUES (?, 'en', 'Dark')")->execute([$subID]);
            $conn->prepare("INSERT INTO Subscriber_Professional (SubscriberID, Skills) VALUES (?, 'PHP, Azure, SQL')")->execute([$subID]);
            $conn->prepare("INSERT INTO Subscriber_Account_Status (SubscriberID, AccountRole, LastLogin) VALUES (?, 'Member', CURRENT_TIMESTAMP)")->execute([$subID]);
            $conn->commit();
            $stmt->execute([$subID]);
            $personal = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) { $conn->rollBack(); }
    }

    // 3. FETCH PREFERENCES, PROFESSIONAL, & STATUS
    $stmt = $conn->prepare("SELECT UI_Language, Notify_Email, Privacy_Level, Theme FROM Subscriber_Settings WHERE SubscriberID = ?");
    $stmt->execute([$subID]);
    $settings = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $conn->prepare("SELECT Skills, Education, Experience, PortfolioURL FROM Subscriber_Professional WHERE SubscriberID = ?");
    $stmt->execute([$subID]);
    $pro = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $conn->prepare("SELECT AccountRole, MembershipTier, LastLogin, IsActive FROM Subscriber_Account_Status WHERE SubscriberID = ?");
    $stmt->execute([$subID]);
    $status = $stmt->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) { error_log("Database Error: " . $e->getMessage()); }
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
            --brand-blue-dark: #001f3f;
            --brand-gold: #ffc629;
            --brand-green: #4ade80;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--brand-blue-dark);
            color: #fff;
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }

        /* VIDEO BACKGROUND */
        .video-container { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -2; overflow: hidden; }
        #bg-video { min-width: 100%; min-height: 100%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); object-fit: cover; }
        .video-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(0, 31, 63, 0.8) 0%, rgba(0, 11, 26, 0.95) 100%); z-index: -1; }

        /* SIDEBAR NAVIGATION */
        .sidebar { 
            width: 300px; height: 100vh; position: fixed; 
            background: rgba(0, 11, 26, 0.8); backdrop-filter: blur(15px);
            border-right: 1px solid var(--glass-border); padding: 30px; z-index: 1000;
        }

        .nav-item {
            padding: 15px; color: rgba(255,255,255,0.6); display: block; 
            text-decoration: none; border-radius: 12px; margin-bottom: 10px; 
            cursor: pointer; transition: 0.3s; border: 1px solid transparent;
        }
        .nav-item.active { background: rgba(74, 222, 128, 0.1); color: var(--brand-green); border: 1px solid var(--brand-green); }

        /* MAIN CONTENT PANEL */
        .main-panel { flex: 1; margin-left: 300px; padding: 40px 5%; position: relative; }

        .profile-hero {
            background: var(--glass-bg); border: 1px solid var(--glass-border);
            border-radius: 20px; padding: 35px; display: flex; align-items: center; 
            gap: 30px; margin-bottom: 30px; backdrop-filter: blur(10px);
        }
        .profile-circle {
            width: 90px; height: 90px; border-radius: 50%; border: 2px solid var(--brand-green);
            display: flex; align-items: center; justify-content: center; font-size: 35px; color: var(--brand-green);
            box-shadow: 0 0 20px rgba(74, 222, 128, 0.2);
        }

        .content-section { display: none; }
        .content-section.active { display: block; animation: fadeIn 0.4s ease-out; }

        .data-card {
            background: var(--glass-bg); border: 1px solid var(--glass-border);
            padding: 30px; border-radius: 20px; display: grid; grid-template-columns: 1fr 1fr; 
            gap: 20px; backdrop-filter: blur(10px);
        }

        .label { color: var(--brand-green); font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; display: block; }
        .value { font-size: 1.1rem; color: #fff; word-break: break-all; }
        .full { grid-column: span 2; }

        /* MOBILE RESPONSIVE ENGINE */
        @media (max-width: 1024px) {
            body { flex-direction: column; }
            .sidebar { 
                width: 100%; height: auto; position: relative; padding: 15px; 
                display: flex; overflow-x: auto; gap: 10px; border-right: none; border-bottom: 1px solid var(--glass-border);
            }
            .sidebar h2 { display: none; }
            .nav-item { margin-bottom: 0; padding: 10px 20px; white-space: nowrap; }
            .main-panel { margin-left: 0; padding: 20px; }
            .profile-hero { flex-direction: column; text-align: center; }
            .data-card { grid-template-columns: 1fr; }
            .full { grid-column: span 1; }
        }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>

    <div class="video-container">
        <video id="bg-video" autoplay loop muted playsinline>
            <source src="assets/video/WebsiteVideo.mp4" type="video/mp4">
        </video>
    </div>
    <div class="video-overlay"></div>

    <div class="sidebar">
        <h2 style="color: var(--brand-green); text-align: center; margin-bottom: 30px; font-size: 1.2rem; letter-spacing: 2px;">HDP CORE</h2>
        <a class="nav-item active" data-target="sec-1"><i class="fas fa-id-card"></i> <span>1. Basic Info</span></a>
        <a class="nav-item" data-target="sec-2"><i class="fas fa-user"></i> <span>2. Personal Details</span></a>
        <a class="nav-item" data-target="sec-3"><i class="fas fa-cog"></i> <span>3. Preferences</span></a>
        <a class="nav-item" data-target="sec-4"><i class="fas fa-briefcase"></i> <span>4. Professional</span></a>
        <a class="nav-item" data-target="sec-5"><i class="fas fa-shield-alt"></i> <span>5. Account Status</span></a>
    </div>

    <main class="main-panel">
        <div class="profile-hero">
            <div class="profile-circle"><i class="fas fa-user-secret"></i></div>
            <div>
                <h1 style="margin: 0;">Intelligence Dossier: <span style="color: var(--brand-green);"><?php echo htmlspecialchars($sub['FirstName']); ?></span></h1>
                <p style="margin-top: 5px; color: rgba(255,255,255,0.7);">Subscriber #<?php echo $subID; ?> | Joined <?php echo date('M Y', strtotime($sub['CreatedDate'])); ?></p>
            </div>
        </div>

        <div id="sec-1" class="content-section active">
            <div class="data-card">
                <div><span class="label">First Name</span><span class="value" style="color: var(--brand-gold);"><?php echo htmlspecialchars($sub['FirstName']); ?></span></div>
                <div><span class="label">Surname</span><span class="value" style="color: var(--brand-gold);"><?php echo htmlspecialchars($sub['Surname']); ?></span></div>
                <div><span class="label">Gender</span><span class="value"><?php echo htmlspecialchars($sub['Gender'] ?? 'N/A'); ?></span></div>
                <div><span class="label">Ethnic Group</span><span class="value"><?php echo htmlspecialchars($sub['EthnicGroup'] ?? 'N/A'); ?></span></div>
                <div><span class="label">Country</span><span class="value"><?php echo htmlspecialchars($sub['Country']); ?></span></div>
                <div><span class="label">Primary Email</span><span class="value" style="color: var(--brand-green);"><?php echo htmlspecialchars($userEmail); ?></span></div>
            </div>
        </div>

        <div id="sec-2" class="content-section">
            <div class="data-card">
                <div><span class="label">Job Title</span><span class="value"><?php echo htmlspecialchars($personal['JobTitle'] ?? 'N/A'); ?></span></div>
                <div><span class="label">Department</span><span class="value"><?php echo htmlspecialchars($personal['Department'] ?? 'N/A'); ?></span></div>
                <div><span class="label">DOB</span><span class="value"><?php echo htmlspecialchars($personal['DOB'] ?? 'N/A'); ?></span></div>
                <div><span class="label">Phone</span><span class="value"><?php echo htmlspecialchars($personal['Phone'] ?? 'N/A'); ?></span></div>
                <div class="full"><span class="label">Biography</span><span class="value"><?php echo htmlspecialchars($personal['Bio'] ?? 'No dossier entry.'); ?></span></div>
            </div>
        </div>

        <div id="sec-3" class="content-section">
            <div class="data-card">
                <div><span class="label">UI Language</span><span class="value"><?php echo htmlspecialchars($settings['UI_Language'] ?? 'en'); ?></span></div>
                <div><span class="label">Active Theme</span><span class="value"><?php echo htmlspecialchars($settings['Theme'] ?? 'Dark'); ?></span></div>
                <div><span class="label">Email Alerts</span><span class="value"><?php echo ($settings['Notify_Email'] ?? 1) ? 'Enabled' : 'Disabled'; ?></span></div>
                <div><span class="label">Privacy Level</span><span class="value"><?php echo htmlspecialchars($settings['Privacy_Level'] ?? 'Private'); ?></span></div>
            </div>
        </div>

        <div id="sec-4" class="content-section">
            <div class="data-card">
                <div class="full"><span class="label">Technical Stack</span><span class="value" style="color: var(--brand-gold);"><?php echo htmlspecialchars($pro['Skills'] ?? 'N/A'); ?></span></div>
                <div class="full"><span class="label">Education</span><span class="value"><?php echo htmlspecialchars($pro['Education'] ?? 'N/A'); ?></span></div>
                <div class="full"><span class="label">Experience</span><span class="value"><?php echo htmlspecialchars($pro['Experience'] ?? 'N/A'); ?></span></div>
                <div class="full"><span class="label">Portfolio URL</span><span class="value" style="color: var(--brand-green);"><?php echo htmlspecialchars($pro['PortfolioURL'] ?? 'N/A'); ?></span></div>
            </div>
        </div>

        <div id="sec-5" class="content-section">
            <div class="data-card">
                <div><span class="label">Role</span><span class="value"><?php echo htmlspecialchars($status['AccountRole'] ?? 'Member'); ?></span></div>
                <div><span class="label">Tier</span><span class="value" style="color: var(--brand-gold);"><?php echo htmlspecialchars($status['MembershipTier'] ?? 'Free'); ?></span></div>
                <div><span class="label">Status</span><span class="value"><?php echo ($status['IsActive'] ?? 1) ? 'Active' : 'Suspended'; ?></span></div>
                <div class="full"><span class="label">Last Activity</span><span class="value"><?php echo htmlspecialchars($status['LastLogin'] ?? 'N/A'); ?></span></div>
            </div>
        </div>
    </main>

    <script>
        document.querySelectorAll('.nav-item').forEach(btn => {
            btn.onclick = () => {
                document.querySelectorAll('.nav-item, .content-section').forEach(el => el.classList.remove('active'));
                btn.classList.add('active');
                document.getElementById(btn.dataset.target).classList.add('active');
            }
        });
    </script>
</body>
</html>
