<?php
session_start();
include 'config/db_connect.php'; 

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$userEmail = $_SESSION['user_email']; 
$subscriberID = $firstName = $surname = $gender = $ethnicGroup = $country = $createdDate = "";
$bio = "New Dossier"; 
$jobTitle = "Member";
$skills = "Not listed";

try {
    // 1. FETCH MAIN SUBSCRIBER DATA
    $query = "SELECT SubscriberID, FirstName, Surname, Gender, EthnicGroup, Country, CreatedDate FROM subscribers WHERE Email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $userEmail);
    $stmt->execute();
    $subscriber = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($subscriber) {
        $subscriberID = $subscriber['SubscriberID'];
        $firstName    = $subscriber['FirstName'];
        $surname      = $subscriber['Surname'];
        $gender       = $subscriber['Gender'];
        $ethnicGroup  = $subscriber['EthnicGroup'];
        $country      = $subscriber['Country'];
        $createdDate  = $subscriber['CreatedDate'];

        // 2. PROVISIONING & DATA RETRIEVAL LOGIC
        // Check if extended profile exists
        $checkStmt = $conn->prepare("SELECT Bio, JobTitle FROM Subscriber_Personal WHERE SubscriberID = ?");
        $checkStmt->execute([$subscriberID]);
        $personal = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if (!$personal) {
            // First time login: Insert rows into all related tables
            $conn->beginTransaction();
            try {
                $conn->prepare("INSERT INTO Subscriber_Personal (SubscriberID, Bio, JobTitle) VALUES (?, 'New Dossier', 'Developer')")->execute([$subscriberID]);
                $conn->prepare("INSERT INTO Subscriber_Settings (SubscriberID, Theme, UI_Language) VALUES (?, 'Dark', 'en')")->execute([$subscriberID]);
                $conn->prepare("INSERT INTO Subscriber_Professional (SubscriberID, Skills) VALUES (?, 'PHP, Azure, SQL')")->execute([$subscriberID]);
                $conn->prepare("INSERT INTO Subscriber_Account_Status (SubscriberID, AccountRole, LastLogin) VALUES (?, 'Member', CURRENT_TIMESTAMP)")->execute([$subscriberID]);
                $conn->commit();
            } catch (Exception $e) {
                $conn->rollBack();
                error_log("Provisioning Failed: " . $e->getMessage());
            }
        } else {
            // Existing user: Fetch their specific details
            $bio = $personal['Bio'];
            $jobTitle = $personal['JobTitle'];
            
            $profStmt = $conn->prepare("SELECT Skills FROM Subscriber_Professional WHERE SubscriberID = ?");
            $profStmt->execute([$subscriberID]);
            $prof = $profStmt->fetch(PDO::FETCH_ASSOC);
            $skills = $prof['Skills'] ?? $skills;

            // Update last login activity
            $conn->prepare("UPDATE Subscriber_Account_Status SET LastLogin = CURRENT_TIMESTAMP WHERE SubscriberID = ?")->execute([$subscriberID]);
        }
    }
} catch (PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
}
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
            --brand-green: #4ade80;
            --brand-gold: #ffc629;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
        }
        body { margin: 0; font-family: 'Segoe UI', sans-serif; background: #000b1a; color: white; display: flex; min-height: 100vh; }
        
        /* SIDEBAR */
        .sidebar { width: 300px; background: rgba(0, 31, 63, 0.95); backdrop-filter: blur(20px); border-right: 1px solid var(--glass-border); padding: 25px; position: fixed; height: 100vh; z-index: 1000; }
        .sidebar h2 { color: var(--brand-green); text-align: center; letter-spacing: 3px; border-bottom: 1px solid var(--glass-border); padding-bottom: 20px; }
        .nav-item { padding: 14px 18px; color: rgba(255,255,255,0.6); text-decoration: none; display: flex; align-items: center; gap: 15px; border-radius: 12px; margin-bottom: 8px; cursor: pointer; transition: 0.3s; }
        .nav-item.active, .nav-item:hover { background: rgba(74, 222, 128, 0.1); color: var(--brand-green); border: 1px solid rgba(74, 222, 128, 0.2); }
        
        /* MAIN CONTENT */
        .main-panel { flex: 1; margin-left: 300px; padding: 40px; }
        .content-section { display: none; animation: fadeIn 0.3s ease-in; }
        .content-section.active { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        /* CARDS */
        .profile-hero { background: var(--glass-bg); border: 1px solid var(--glass-border); border-radius: 24px; padding: 35px; display: flex; align-items: center; gap: 35px; margin-bottom: 30px; }
        .profile-img { width: 120px; height: 120px; border-radius: 50%; border: 3px solid var(--brand-green); }
        .data-card { background: var(--glass-bg); border: 1px solid var(--glass-border); padding: 30px; border-radius: 20px; }
        .label { color: var(--brand-green); font-size: 0.7rem; font-weight: 800; text-transform: uppercase; display: block; margin-top: 15px; }
        .value { font-size: 1.1rem; color: #fff; display: block; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>HDP CORE</h2>
        <a class="nav-item active" data-target="sec-basic"><i class="fas fa-id-card"></i> <span>1. Basic Information</span></a>
        <a class="nav-item" data-target="sec-personal"><i class="fas fa-user-tag"></i> <span>2. Personal Details</span></a>
        <a class="nav-item" data-target="sec-pro"><i class="fas fa-briefcase"></i> <span>3. Professional Info</span></a>
        <a class="nav-item" data-target="sec-account"><i class="fas fa-history"></i> <span>4. Account & Activity</span></a>
    </div>

    <main class="main-panel">
        <div class="profile-hero">
            <img src="assets/images/default-avatar.png" class="profile-img">
            <div>
                <h1 style="margin: 0;">Intelligence Dossier: <span style="color: var(--brand-green);"><?php echo $firstName; ?></span></h1>
                <p>Subscriber #<?php echo $subscriberID; ?> | Joined <?php echo date('M Y', strtotime($createdDate)); ?></p>
            </div>
        </div>

        <div id="sec-basic" class="content-section active">
            <div class="data-card">
                <span class="label">Full Name</span>
                <span class="value"><?php echo "$firstName $surname"; ?></span>
                <span class="label">Location</span>
                <span class="value"><?php echo $country; ?></span>
                <span class="label">Email</span>
                <span class="value"><?php echo $userEmail; ?></span>
            </div>
        </div>

        <div id="sec-personal" class="content-section">
            <div class="data-card">
                <span class="label">Job Title</span>
                <span class="value"><?php echo htmlspecialchars($jobTitle); ?></span>
                <span class="label">Bio</span>
                <p class="value"><?php echo htmlspecialchars($bio); ?></p>
            </div>
        </div>

        <div id="sec-pro" class="content-section">
            <div class="data-card">
                <span class="label">Technical Stack</span>
                <span class="value"><?php echo htmlspecialchars($skills); ?></span>
            </div>
        </div>
    </main>

    <script>
    document.querySelectorAll('.nav-item').forEach(link => {
        link.addEventListener('click', function() {
            document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
            document.querySelectorAll('.content-section').forEach(sec => sec.classList.remove('active'));
            
            this.classList.add('active');
            document.getElementById(this.getAttribute('data-target')).classList.add('active');
        });
    });
    </script>
</body>
</html>
