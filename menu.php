<?php 
include 'header.php'; 
require_once 'db_connect.php'; 
?>

<header class="hero menu-hero">
    <h1>Our Menu</h1>
    <p class="gold-text">CRAFTED COFFEE • SEASONAL CUISINE</p>
</header>

<section class="menu-section">

    <div class="menu-filters">
        <span class="filter-btn active" data-filter="all">All</span>
        <span class="filter-btn" data-filter="Hot Drinks">Coffee</span>
        <span class="filter-btn" data-filter="Food">Breakfast</span>
        <span class="filter-btn" data-filter="Cold Drinks">Cold Brews</span>
    </div>

    <div class="menu-grid">
        <?php
        $stmt = $pdo->query("SELECT * FROM products WHERE is_available = 1");
        
        while ($row = $stmt->fetch()) {
            
            // 1. Point to your sub-folder
            $folder = "images/";
            $extension = ".jpeg"; // Change to .png if your files use that extension

            // 2. Format the filename to match your folder (lowercase, hyphens)
            $safeName = strtolower(str_replace(' ', '-', $row['name']));
            $specificImage = $folder . $safeName . $extension; 

            // 3. Category Fallbacks (e.g., images/food.jpg)
            $categorySafe = strtolower(str_replace(' ', '-', $row['category']));
            $categoryFallback = $folder . $categorySafe . $extension;

            // 4. Final Path Selection
            if (file_exists($specificImage)) {
                $displayImage = $specificImage;
            } elseif (file_exists($categoryFallback)) {
                $displayImage = $categoryFallback;
            } else {
                // If no specific or category image exists, use this
                $displayImage = $folder . "placeholder" . $extension; 
            }

            $productName = urlencode($row['name']);

            echo "
            <div class='menu-card' data-category='{$row['category']}'>
                <div class='menu-image' style='background-image: url(\"{$displayImage}\"); background-size: cover; background-position: center;'></div>
                <div class='menu-info'>
                    <div class='menu-title-row'>
                        <h3>{$row['name']}</h3>
                        <span class='price'>R " . number_format($row['price'], 2) . "</span>
                    </div>
                    <p>{$row['description']}</p>
                    
                    <div style='display: flex; justify-content: space-between; align-items: center; margin-top: 15px;'>
                        <span class='tag'>{$row['category']}</span>
                        <a href='order.php?item={$productName}&price={$row['price']}' class='btn-text' style='color: var(--gold);'>Order Now →</a>
                    </div>
                </div>
            </div>";
        }
        ?>
    </div>
</section>

<script src="filter.js"></script>

<?php include 'footer.php'; ?>