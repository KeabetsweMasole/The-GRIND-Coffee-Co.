<?php 
include 'header.php'; 

// Save order to session if it was just posted from order.php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['customer_name'])) {
    $_SESSION['active_order'] = [
        'number' => "GRND-" . rand(100, 999),
        'name' => $_POST['customer_name'],
        'item' => $_POST['item_name'],
        'time' => date('H:i')
    ];
}

$order = $_SESSION['active_order'] ?? null;
?>

<style>
    /* Ticket Container */
    .order-container {
        max-width: 500px;
        margin: 80px auto;
        text-align: center;
        border: 2px dashed var(--gold);
        padding: 50px 40px;
        background: #0a0a0a;
        box-shadow: 0 20px 50px rgba(0,0,0,0.5);
    }

    .ticket-header h2 {
        font-size: 1.8rem;
        letter-spacing: 3px;
        margin-bottom: 5px;
    }

    /* The Main Number Display */
    .ticket-box {
        background: #111;
        padding: 40px 20px;
        margin: 30px 0;
        border: 1px solid #222;
        position: relative;
    }

    .ticket-box::before, .ticket-box::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        background: #000; /* Cuts circles out of the side for ticket effect */
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
    }
    .ticket-box::before { left: -11px; border-right: 1px solid #222; }
    .ticket-box::after { right: -11px; border-left: 1px solid #222; }

    .ticket-number {
        font-size: 5rem;
        color: var(--gold);
        margin: 10px 0;
        font-weight: 900;
        line-height: 1;
    }

    /* Status Text */
    .status-row {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        padding: 15px 0;
        border-top: 1px solid #222;
    }

    .status-label {
        font-size: 0.7rem;
        color: #555;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .status-value {
        font-size: 0.75rem;
        color: white;
        font-weight: 700;
    }

    /* Cancel Section */
    .cancel-container {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid #222;
    }

    .btn-cancel {
        background: transparent;
        border: 1px solid #3d0000;
        color: #ff4444;
        padding: 12px 25px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        cursor: pointer;
        transition: var(--transition);
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-cancel:hover {
        background: #ff4444;
        color: white;
        border-color: #ff4444;
        box-shadow: 0 5px 15px rgba(255, 68, 68, 0.2);
    }

    .cancel-note {
        display: block;
        font-size: 0.6rem;
        color: #444;
        margin-top: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
</style>

<div class="workspace-scope"> <?php if (!$order): ?>
        <div class="order-container" style="border-style: solid; opacity: 0.8;">
            <i class="fas fa-coffee" style="font-size: 3rem; color: #222; margin-bottom: 20px;"></i>
            <h2 class="gold-text">No Active Orders</h2>
            <p style="margin-bottom: 30px;">Your queue is currently empty. Ready for a caffeine fix?</p>
            <a href="menu.php" class="btn btn-gold" style="width: 100%;">Browse Menu</a>
        </div>
    <?php else: ?>
        
        <div class="order-container">
            <div class="ticket-header">
                <h2 class="gold-text">Queue Ticket</h2>
                <p style="font-size: 0.9rem; color: #888;">Order for: <strong><?php echo htmlspecialchars($order['name']); ?></strong></p>
            </div>

            <div class="ticket-box">
                <span style="color: #666; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 3px;">Order Identifier</span>
                <h1 class="ticket-number"><?php echo $order['number']; ?></h1>
                <p style="color: var(--gold); font-size: 0.9rem; font-weight: 700; text-transform: uppercase;"><?php echo $order['item']; ?></p>
            </div>

            <div class="status-info">
                <div class="status-row">
                    <span class="status-label">Current Status</span>
                    <span class="status-value" style="color: #00ff00;">
                        <span class="live-dot" style="margin-right: 5px;"></span> Preparing
                    </span>
                </div>
                <div class="status-row" style="border-top: none; padding-top: 0;">
                    <span class="status-label">Time Placed</span>
                    <span class="status-value"><?php echo $order['time']; ?></span>
                </div>
            </div>

            <p style="font-size: 0.8rem; color: #666; margin-top: 20px; line-height: 1.5;">
                Please present this digital ticket at the counter for payment and collection.
            </p>
            
            <div class="cancel-container">
                <form method="POST" action="cancel-order.php" onsubmit="return confirm('Are you sure you want to cancel your order and leave the queue?');">
                    <button type="submit" class="btn-cancel">
                        <i class="fas fa-times"></i> Cancel Order
                    </button>
                    <span class="cancel-note">This will permanently remove you from the queue</span>
                </form>
            </div>
        </div>

    <?php endif; ?>

</div>

<?php include 'footer.php'; ?>