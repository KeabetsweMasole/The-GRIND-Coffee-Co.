<?php 
include 'header.php'; 

// Get the item details from the URL
$item = isset($_GET['item']) ? urldecode($_GET['item']) : "Select an Item";
$price = isset($_GET['price']) ? $_GET['price'] : "0.00";
?>

<style>
    .order-container {
        max-width: 600px;
        margin: 60px auto;
        padding: 40px;
        background: var(--gray-dark);
        border: 1px solid var(--gray-medium);
        text-align: center;
    }

    .order-summary {
        border-bottom: 1px solid #333;
        padding-bottom: 20px;
        margin-bottom: 30px;
    }

    .item-name { font-size: 1.5rem; color: var(--gold); font-weight: 700; }
    .item-price { font-size: 1.2rem; color: #fff; margin-top: 10px; }

    .payment-options {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin: 30px 0;
    }

    /* Custom Radio Buttons */
    .pay-opt {
        border: 1px solid #333;
        padding: 20px;
        cursor: pointer;
        transition: var(--transition);
        border-radius: 4px;
    }

    .pay-opt:hover { border-color: var(--gold); }

    input[type="radio"] { display: none; }

    input[type="radio"]:checked + .pay-opt {
        background: var(--gold);
        color: black;
        border-color: var(--gold);
    }

    .pay-opt i { font-size: 1.5rem; display: block; margin-bottom: 10px; }

    .note { font-size: 0.8rem; color: #888; margin-top: 20px; font-style: italic; }
</style>

<section class="order-container">
    <div class="order-summary">
        <h2 class="gold-text">Confirm Order</h2>
        <p class="item-name"><?php echo htmlspecialchars($item); ?></p>
        <p class="item-price">Total: R <?php echo number_format($price, 2); ?></p>
    </div>

    <form action="queue-ticket.php" method="POST">
        <input type="hidden" name="item_name" value="<?php echo $item; ?>">
        <input type="hidden" name="price" value="<?php echo $price; ?>">

        <p style="text-align: left; font-size: 0.8rem; color: var(--gold); text-transform: uppercase; letter-spacing: 1px;">Select Payment Method</p>
        
        <div class="payment-options">
            <label>
                <input type="radio" name="payment_method" value="Card" required>
                <div class="pay-opt">
                    <i class="fas fa-credit-card"></i>
                    <span>Pay with Card</span>
                </div>
            </label>
            
            <label>
                <input type="radio" name="payment_method" value="Cash" required>
                <div class="pay-opt">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Pay Cash at Counter</span>
                </div>
            </label>
        </div>

        <div class="form-group" style="text-align: left; margin-bottom: 20px;">
            <label style="color: var(--gold); font-size: 0.7rem; text-transform: uppercase;">Your Name (For the Queue)</label>
            <input type="text" name="customer_name" placeholder="Enter your name" required style="width: 100%; padding: 15px; background: #000; border: 1px solid #333; color: white;">
        </div>

        <button type="submit" class="btn btn-gold" style="width: 100%;">Place Order & Join Queue</button>
        <p class="note">Please note: You must collect your order at the store counter.</p>
    </form>
</section>

<?php include 'footer.php'; ?>