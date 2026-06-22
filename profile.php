<?php 
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Data Setup
$userName = $_SESSION['user_name'] ?? "Amogelang Matlhaga"; 
$loyaltyPoints = $_SESSION['loyalty'] ?? 0;
$memberSince = $_SESSION['member_since'] ?? "October 2024";
$hasActiveOrder = true; 

include 'header.php'; 
?>

<style>
    /* --- Dashboard Layout --- */
    .profile-container {
        display: grid;
        grid-template-columns: 280px 1fr;
        min-height: 100vh;
        background: #050505;
        color: white;
        font-family: 'Montserrat', sans-serif;
    }

    /* --- Sidebar --- */
    .profile-sidebar {
        background: #0a0a0a;
        padding: 60px 30px;
        border-right: 1px solid #111;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .profile-avatar-large {
        width: 80px;
        height: 80px;
        background: var(--gold, #C4A484);
        color: #000;
        border-radius: 15px; /* Squircle */
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 900;
        margin-bottom: 20px;
    }

    .profile-name { font-size: 1.1rem; margin-bottom: 5px; text-align: center; }
    .member-tag { font-size: 0.65rem; color: var(--gold, #C4A484); text-transform: uppercase; letter-spacing: 2px; margin-bottom: 40px; }

    .profile-nav { width: 100%; display: flex; flex-direction: column; gap: 10px; }
    .profile-nav a {
        color: #666;
        text-decoration: none;
        font-size: 0.8rem;
        padding: 12px 15px;
        border-radius: 6px;
        transition: 0.3s;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .profile-nav a:hover, .profile-nav a.active {
        background: #111;
        color: var(--gold, #C4A484);
    }

    /* --- Main Content --- */
    .profile-main { padding: 60px 8%; }
    .dashboard-title { font-size: 2.2rem; font-weight: 900; margin-bottom: 10px; }
    .dashboard-subtitle { color: #555; margin-bottom: 40px; }

    /* --- Stats Grid --- */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: #0a0a0a;
        padding: 30px;
        border: 1px solid #1a1a1a;
        border-radius: 8px;
    }

    .stat-label { font-size: 0.7rem; color: var(--gold, #C4A484); text-transform: uppercase; letter-spacing: 1px; }
    .stat-value { font-size: 2.5rem; margin: 10px 0; font-weight: 900; }
    .stat-desc { font-size: 0.8rem; color: #444; }

    /* --- Tracker Card --- */
    .active-order-card {
        background: linear-gradient(145deg, #0a0a0a, #000);
        border: 1px solid #222;
        padding: 30px;
        border-radius: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 50px;
    }

    .tracker-btn {
        background: var(--gold, #C4A484);
        color: #000;
        padding: 12px 25px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.75rem;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* --- Table --- */
    .activity-section { margin-top: 40px; }
    .section-title { font-size: 1.2rem; margin-bottom: 20px; color: #eee; }
    .history-table { width: 100%; border-collapse: collapse; }
    .history-table th { text-align: left; padding: 15px; color: var(--gold, #C4A484); font-size: 0.7rem; text-transform: uppercase; border-bottom: 1px solid #222; }
    .history-table td { padding: 15px; font-size: 0.85rem; border-bottom: 1px solid #111; color: #888; }

    /* --- Responsive --- */
    @media (max-width: 992px) {
        .profile-container { grid-template-columns: 1fr; }
        .profile-sidebar { padding: 40px; border-right: none; border-bottom: 1px solid #111; }
        .active-order-card { flex-direction: column; text-align: center; gap: 20px; }
    }
</style>

<div class="profile-container">
    <aside class="profile-sidebar">
        <div class="profile-avatar-large">
            <?php echo strtoupper(substr($userName, 0, 1)); ?>
        </div>
        <h3 class="profile-name"><?php echo $userName; ?></h3>
        <p class="member-tag">Elite Member</p>
        
        <nav class="profile-nav">
            <a href="#" class="active"><i class="fas fa-chart-line"></i> Overview</a>
            <a href="track-order.php"><i class="fas fa-box"></i> Active Orders</a>
            <a href="order-history.php"><i class="fas fa-history"></i> Order History</a>
            <a href="settings.php"><i class="fas fa-user-cog"></i> Settings</a>
            <a href="logout.php" style="color: #ff4444;"><i class="fas fa-power-off"></i> Logout</a>
        </nav>
    </aside>

    <main class="profile-main">
        <div class="profile-header-content">
            <h1 class="dashboard-title">User Dashboard</h1>
            <p class="dashboard-subtitle">Welcome back to the grind.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <span class="stat-label">Loyalty Points</span>
                <h2 class="stat-value"><?php echo $loyaltyPoints; ?></h2>
                <p class="stat-desc">Next reward at 200 pts</p>
            </div>
            <div class="stat-card">
                <span class="stat-label">Member Status</span>
                <h2 class="stat-value">Premium</h2>
                <p class="stat-desc">Since <?php echo $memberSince; ?></p>
            </div>
        </div>

        <?php if($hasActiveOrder): ?>
        <div class="active-order-card">
            <div class="order-info">
                <h3 style="margin-bottom: 5px;">Active Order in Progress</h3>
                <p style="color: #666; font-size: 0.85rem;">Your Espresso is being prepared (8 mins est.)</p>
            </div>
            <a href="track-order.php" class="tracker-btn">
                <span class="live-dot"></span>
                Live Tracker
            </a>
        </div>
        <?php endif; ?>

        <div class="activity-section">
            <h3 class="section-title">Recent Activity</h3>
            <table class="history-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Date</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Flat White (Large)</td>
                        <td>14 May 2026</td>
                        <td>R45.00</td>
                    </tr>
                    <tr>
                        <td>Workspace - Day Pass</td>
                        <td>12 May 2026</td>
                        <td>R150.00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>

<?php include 'footer.php'; ?>