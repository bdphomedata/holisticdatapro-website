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

    // 2. FETCH & PROVISION LOGIC
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
        } catch (Exception $e) {
            $conn->rollBack();
        }
    }

    // 3. FETCH REMAINING TABLES (Explicit Columns)
    $stmt = $conn->prepare("SELECT UI_Language, Notify_Email, Privacy_Level, Theme FROM Subscriber_Settings WHERE SubscriberID = ?");
    $stmt->execute([$subID]);
    $settings = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $conn->prepare("SELECT Skills, Education, Experience, PortfolioURL FROM Subscriber_Professional WHERE SubscriberID = ?");
    $stmt->execute([$subID]);
    $pro = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $conn->prepare("SELECT AccountRole, MembershipTier, LastLogin, IsActive FROM Subscriber_Account_Status WHERE SubscriberID = ?");
    $stmt->execute([$subID]);
    $status = $stmt->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Holistic Data Pro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --brand-green: #4ade80; --brand-gold: #ffc629; --glass: rgba(255,255,255,0.05); --border: rgba(255,255,255,0.1); }
        body { margin: 0; font-family: 'Segoe UI', sans-serif; background: #000b1a; color: white; display: flex; min-height: 100vh; }
        
        .sidebar { width: 300px; background: rgba(0, 31, 63, 0.95); padding: 25px; height: 100vh; position: fixed; border-right: 1px solid var(--border); z-index: 1000; }
        .nav-item { padding: 15px; color: rgba(255,255,255,0.6); display: block; text-decoration: none; border-radius: 12px; margin-bottom: 8px; cursor: pointer; transition: 0.3s; }
        .nav-item.active { background: rgba(74, 222, 128, 0.1); color: var(--brand-green); border: 1px solid rgba(74, 222, 128, 0.2); }
        
        .main-panel { flex: 1; margin-left: 300px; padding: 40px; }
        
        /* RESTORED HERO HEADER STYLE */
        .profile-hero { background: var(--glass); border: 1px solid var(--border); border-radius: 24px; padding: 35px; display: flex; align-items: center; gap: 35px; margin-bottom: 30px; }
        .profile-circle { width: 100px; height: 100px; border-radius: 50%; border: 3px solid var(--brand-green); display: flex; align-items: center; justify-content: center; font-size: 40px; color: var(--brand-green); }
        
        .content-section { display: none; }
        .content-section.active { display: block; animation: fadeIn 0.4s ease-out; }
        
        .data-card { background: var(--glass); border: 1px solid var(--border); padding: 30px; border-radius: 20px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .label { color: var(--brand-green); font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; }
        .value { font-size: 1.1rem; color: #fff; margin-bottom: 10px; display: block; }
        .full { grid-column: span 2; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2 style="color: var(--brand-green); text-align: center; margin-bottom: 30px;">HDP CORE</h2>
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
                <div><span class="label">Location</span><span class="value"><?php echo htmlspecialchars($sub['Country']); ?></span></div>
                <div><span class="label">Primary Email</span><span class="value" style="color: var(--brand-green);"><?php echo htmlspecialchars($userEmail); ?></span></div>
            </div>
        </div>

        <div id="sec-2" class="content-section">
            <div class="data-card">
                <div><span class="label">Job Title</span><span class="value"><?php echo htmlspecialchars($personal['JobTitle'] ?? 'N/A'); ?></span></div>
                <div><span class="label">Department</span><span class="value"><?php echo htmlspecialchars($personal['Department'] ?? 'N/A'); ?></span></div>
                <div><span class="label">DOB</span><span class="value"><?php echo htmlspecialchars($personal['DOB'] ?? 'N/A'); ?></span></div>
                <div><span class="label">Phone</span><span class="value"><?php echo htmlspecialchars($personal['Phone'] ?? 'N/A'); ?></span></div>
                <div class="full"><span class="label">Biography</span><span class="value"><?php echo htmlspecialchars($personal['Bio'] ?? 'N/A'); ?></span></div>
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
