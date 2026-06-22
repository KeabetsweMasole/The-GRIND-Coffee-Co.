<?php 
session_start();
include 'header.php'; 

$message = $_SESSION['booking_success'] ?? "Your booking has been processed.";
// Clear the message so it doesn't show again on refresh
unset($_SESSION['booking_success']);
?>

<style>
    .success-container {
        min-height: 80vh;
        background: #050505;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        font-family: 'Montserrat', sans-serif;
    }
    .success-card {
        padding: 60px;
        background: #0a0a0a;
        border: 1px solid #111;
        border-radius: 15px;
        max-width: 500px;
    }
    .success-icon {
        font-size: 4rem;
        color: #00ff00;
        margin-bottom: 20px;
    }
    .btn-dash {
        display: inline-block;
        margin-top: 30px;
        padding: 12px 30px;
        background: var(--gold, #C4A484);
        color: #000;
        text-decoration: none;
        font-weight: 900;
        text-transform: uppercase;
        border-radius: 5px;
    }
</style>

<div class="success-container">
    <div class="success-card">
        <i class="fas fa-check-circle success-icon"></i>
        <h2 style="color: white; margin-bottom: 10px;">Booking Secured</h2>
        <p style="color: #888;"><?php echo $message; ?></p>
        
        <a href="profile.php" class="btn-dash">View My Dashboard</a>
    </div>
</div>

<?php include 'footer.php'; ?>