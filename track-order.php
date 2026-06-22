<?php 
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'header.php'; 

// Logic: In a real scenario, you'd fetch the status from your 'orders' table
// Status levels: 1 (Received), 2 (Preparing), 3 (Quality Check), 4 (Ready)
$orderStatus = 2; 
$orderID = "#GRND-8821";
?>

<style>
    .tracker-container {
        min-height: 80vh;
        background: #050505;
        color: white;
        padding: 80px 10%;
        font-family: 'Montserrat', sans-serif;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .tracker-header { text-align: center; margin-bottom: 60px; }
    .tracker-header h1 { font-size: 2.5rem; font-weight: 900; margin-bottom: 10px; }
    .tracker-header p { color: var(--gold, #C4A484); letter-spacing: 2px; text-transform: uppercase; font-size: 0.8rem; }

    /* --- Progress Bar --- */
    .progress-wrapper {
        width: 100%;
        max-width: 800px;
        display: flex;
        justify-content: space-between;
        position: relative;
        margin-bottom: 100px;
    }

    /* Background Line */
    .progress-wrapper::before {
        content: '';
        position: absolute;
        top: 25px;
        left: 0;
        width: 100%;
        height: 2px;
        background: #222;
        z-index: 1;
    }

    /* Active Gold Line */
    .progress-line-active {
        position: absolute;
        top: 25px;
        left: 0;
        height: 2px;
        background: var(--gold, #C4A484);
        z-index: 2;
        transition: 1s ease;
        /* Calculate width based on status (Status 2 = 33%, Status 3 = 66%, Status 4 = 100%) */
        width: <?php echo (($orderStatus - 1) / 3) * 100; ?>%;
    }

    .step {
        position: relative;
        z-index: 3;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }

    .step-circle {
        width: 50px;
        height: 50px;
        background: #111;
        border: 2px solid #222;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        transition: 0.5s;
        color: #444;
    }

    .step.active .step-circle {
        border-color: var(--gold, #C4A484);
        background: #000;
        color: var(--gold, #C4A484);
        box-shadow: 0 0 15px rgba(196, 164, 132, 0.3);
    }

    .step.completed .step-circle {
        background: var(--gold, #C4A484);
        border-color: var(--gold, #C4A484);
        color: #000;
    }

    .step-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 1px;
        color: #444;
    }

    .step.active .step-label { color: #fff; }

    /* --- Info Card --- */
    .order-details-card {
        background: #0a0a0a;
        border: 1px solid #111;
        padding: 40px;
        width: 100%;
        max-width: 600px;
        border-radius: 12px;
        text-align: center;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 15px;
        background: rgba(0, 255, 0, 0.1);
        color: #00ff00;
        font-size: 0.7rem;
        border-radius: 50px;
        margin-bottom: 20px;
        text-transform: uppercase;
        font-weight: 700;
    }

    .back-btn {
        margin-top: 30px;
        color: #555;
        text-decoration: none;
        font-size: 0.8rem;
        transition: 0.3s;
    }
    .back-btn:hover { color: #fff; }
</style>

<div class="tracker-container">
    <div class="tracker-header">
        <p>Order ID: <?php echo $orderID; ?></p>
        <h1>Live Order Status</h1>
    </div>

    <div class="progress-wrapper">
        <div class="progress-line-active"></div>

        <div class="step <?php echo ($orderStatus >= 1) ? ($orderStatus > 1 ? 'completed' : 'active') : ''; ?>">
            <div class="step-circle"><i class="fas fa-receipt"></i></div>
            <span class="step-label">Received</span>
        </div>

        <div class="step <?php echo ($orderStatus >= 2) ? ($orderStatus > 2 ? 'completed' : 'active') : ''; ?>">
            <div class="step-circle"><i class="fas fa-mug-hot"></i></div>
            <span class="step-label">Preparing</span>
        </div>

        <div class="step <?php echo ($orderStatus >= 3) ? ($orderStatus > 3 ? 'completed' : 'active') : ''; ?>">
            <div class="step-circle"><i class="fas fa-check-double"></i></div>
            <span class="step-label">Quality Check</span>
        </div>

        <div class="step <?php echo ($orderStatus >= 4) ? 'active' : ''; ?>">
            <div class="step-circle"><i class="fas fa-walking"></i></div>
            <span class="step-label">Ready</span>
        </div>
    </div>

    <div class="order-details-card">
        <div class="status-badge">
            <span class="live-dot"></span> In Progress
        </div>
        <h3 style="margin-bottom: 10px;">The baristas are crafting your order.</h3>
        <p style="color: #666; font-size: 0.9rem;">Estimated wait time: <strong>~5-8 minutes</strong></p>
        
        <hr style="border: 0; border-top: 1px solid #222; margin: 30px 0;">
        
        <p style="font-size: 0.8rem; color: #888;">Grab a seat in the workspace. We'll alert you here when it's ready.</p>
    </div>

    <a href="profile.php" class="back-btn"><i class="fas fa-arrow-left"></i> Return to Dashboard</a>
</div>

<?php include 'footer.php'; ?>