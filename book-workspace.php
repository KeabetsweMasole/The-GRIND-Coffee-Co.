<?php 
session_start();
include 'header.php'; 

// Check which plan was selected
$plan = $_GET['plan'] ?? 'daypass'; 
$planName = ($plan == 'fullstack') ? 'Full Stack Monthly' : 'Standard Day Pass';
$price = ($plan == 'fullstack') ? 'R2500' : 'R150';

// Pre-fill user data if they are logged in
$userName = $_SESSION['user_name'] ?? "";
$userEmail = $_SESSION['user_email'] ?? "";
?>

<style>
    .booking-container {
        min-height: 80vh;
        background: #050505;
        color: white;
        padding: 80px 10%;
        display: flex;
        justify-content: center;
        font-family: 'Montserrat', sans-serif;
    }

    .booking-card {
        width: 100%;
        max-width: 600px;
        background: #0a0a0a;
        padding: 40px;
        border: 1px solid #111;
        border-radius: 12px;
    }

    .plan-summary {
        background: #111;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 30px;
        border-left: 4px solid var(--gold, #C4A484);
    }

    .form-group { margin-bottom: 20px; }
    .form-group label { 
        display: block; 
        font-size: 0.7rem; 
        color: var(--gold, #C4A484); 
        text-transform: uppercase; 
        margin-bottom: 8px; 
        letter-spacing: 1px; 
    }

    .form-group input, .form-group select { 
        width: 100%; 
        background: #000; 
        border: 1px solid #222; 
        padding: 12px; 
        color: white; 
        border-radius: 5px; 
        outline: none; 
    }

    .form-group input:focus { border-color: var(--gold, #C4A484); }

    .confirm-btn { 
        background: var(--gold, #C4A484); 
        color: #000; 
        border: none; 
        padding: 15px; 
        font-weight: 900; 
        text-transform: uppercase; 
        cursor: pointer; 
        width: 100%; 
        border-radius: 5px; 
        margin-top: 10px;
    }
</style>

<div class="booking-container">
    <div class="booking-card">
        <h2 style="margin-bottom: 10px;">Complete Your Booking</h2>
        <p style="color: #666; margin-bottom: 30px;">Provide your details to secure your workspace.</p>

        <div class="plan-summary">
            <p style="font-size: 0.7rem; text-transform: uppercase; color: #888;">Selected Plan</p>
            <h3 style="margin: 5px 0;"><?php echo $planName; ?></h3>
            <p style="font-weight: 900; color: var(--gold, #C4A484);"><?php echo $price; ?></p>
        </div>
<?php if(isset($_SESSION['error_msg'])): ?>
    <div style="color: #ff4444; background: rgba(255,0,0,0.1); padding: 10px; border-radius: 5px; margin-bottom: 20px; font-size: 0.8rem;">
        <?php 
            echo $_SESSION['error_msg']; 
            unset($_SESSION['error_msg']); 
        ?>
    </div>
<?php endif; ?>
        <form action="process-booking.php" method="POST">
            <input type="hidden" name="plan_type" value="<?php echo $plan; ?>">

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" value="<?php echo $userName; ?>" required placeholder="Enter your name">
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="<?php echo $userEmail; ?>" required placeholder="email@example.com">
            </div>

            <div class="form-group">
                <label>Booking Date</label>
                <input type="date" name="booking_date" required value="<?php echo date('Y-m-d'); ?>">
            </div>

            <?php if($plan == 'daypass'): ?>
            <div class="form-group">
                <label>Seating Preference</label>
                <select name="seating">
                    <option value="focus-booth">Focus Booth</option>
                    <option value="standing-desk">Standing Desk</option>
                    <option value="communal">Communal Table</option>
                </select>
            </div>
            <?php endif; ?>

            <button type="submit" class="confirm-btn">Confirm & Pay</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>