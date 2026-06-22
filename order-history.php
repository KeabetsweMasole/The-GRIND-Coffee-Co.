<?php 
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
include 'header.php'; 

// Mock Data
$orders = [
    ['id' => '#GRND-8821', 'date' => '14 May 2026', 'item' => 'Flat White (Large)', 'status' => 'In Progress', 'total' => 'R45.00'],
    ['id' => '#GRND-8750', 'date' => '12 May 2026', 'item' => 'Workspace Day Pass', 'status' => 'Completed', 'total' => 'R150.00'],
    ['id' => '#GRND-8612', 'date' => '10 May 2026', 'item' => 'Cortado + Croissant', 'status' => 'Completed', 'total' => 'R85.00']
];
?>

<style>
    .history-container { 
        min-height: 80vh; 
        background: #050505; 
        color: white; 
        padding: 60px 10%; 
        font-family: 'Montserrat', sans-serif; 
    }

    /* --- Back Button Styling --- */
    .back-dash {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #555;
        text-decoration: none;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 700;
        margin-bottom: 20px;
        transition: 0.3s;
    }

    .back-dash:hover { 
        color: var(--gold, #C4A484); 
        transform: translateX(-5px);
    }

    .page-title { 
        font-size: 2.2rem; 
        font-weight: 900; 
        margin-bottom: 40px; 
        border-left: 4px solid var(--gold, #C4A484); 
        padding-left: 20px; 
    }
    
    .history-card { background: #0a0a0a; border: 1px solid #111; border-radius: 8px; overflow: hidden; }
    .history-table { width: 100%; border-collapse: collapse; }
    .history-table th { background: #0d0d0d; text-align: left; padding: 20px; color: var(--gold, #C4A484); font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; }
    .history-table td { padding: 20px; border-bottom: 1px solid #111; font-size: 0.85rem; color: #888; }
    
    .status-pill { padding: 5px 12px; border-radius: 4px; font-size: 0.6rem; font-weight: 900; text-transform: uppercase; }
    .status-completed { background: rgba(0, 255, 0, 0.05); color: #00ff00; border: 1px solid rgba(0, 255, 0, 0.2); }
    .status-progress { background: rgba(196, 164, 132, 0.05); color: var(--gold, #C4A484); border: 1px solid rgba(196, 164, 132, 0.2); }
</style>

<div class="history-container">
    <a href="profile.php" class="back-dash">
        <i class="fas fa-chevron-left"></i> Back to Dashboard
    </a>

    <h1 class="page-title">Order Ledger</h1>
    
    <div class="history-card">
        <table class="history-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Item</th>
                    <th>Status</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($orders as $order): ?>
                <tr>
                    <td style="color: #fff; font-weight: 700;"><?php echo $order['id']; ?></td>
                    <td><?php echo $order['date']; ?></td>
                    <td><?php echo $order['item']; ?></td>
                    <td>
                        <span class="status-pill <?php echo ($order['status'] == 'Completed') ? 'status-completed' : 'status-progress'; ?>">
                            <?php echo $order['status']; ?>
                        </span>
                    </td>
                    <td style="color: #fff; font-weight: 900;"><?php echo $order['total']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>