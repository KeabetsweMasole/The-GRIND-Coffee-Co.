<?php include 'header.php'; ?>

<style>
    /* Internal Fixes for Workspace Page */
    .workspace-scope {
        max-width: 1200px;
        margin: 0 auto;
        padding: 60px 10%;
    }

    /* Amenities Grid */
    .amenity-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 40px;
        margin: 50px 0;
        text-align: center;
    }

    .amenity-item {
        padding: 20px;
    }

    .amenity-item i {
        font-size: 3rem;
        color: var(--gold);
        margin-bottom: 20px;
        display: block;
    }

    .amenity-item h3 {
        margin-bottom: 10px;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    /* Pricing Section */
    .pricing-container {
        display: flex;
        justify-content: center;
        align-items: stretch;
        gap: 30px;
        margin-top: 50px;
        flex-wrap: wrap;
    }

    .price-card {
        background: #111; /* Slightly lighter than body for depth */
        border: 1px solid var(--gray-medium);
        padding: 50px 40px;
        flex: 1;
        max-width: 400px;
        min-width: 300px;
        transition: var(--transition);
        display: flex;
        flex-direction: column;
    }

    .price-card.featured {
        border: 1px solid var(--gold);
        transform: scale(1.05);
        background: #0a0a0a;
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    }

    .price-card .plan {
        color: var(--gold);
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 0.8rem;
        font-weight: 700;
    }

    .price-card .cost {
        font-size: 3.5rem;
        margin: 20px 0;
        font-weight: 900;
    }

    .price-card ul {
        list-style: none;
        padding: 0;
        margin-bottom: 40px;
        flex-grow: 1;
    }

    .price-card ul li {
        padding: 12px 0;
        border-bottom: 1px solid #222;
        font-size: 0.9rem;
        text-align: left;
    }

    /* Button Layout Fix */
    .price-card .btn {
        width: 100%;
        margin: 0 !important; /* Forces center alignment */
    }

    @media (max-width: 768px) {
        .price-card.featured { transform: scale(1); }
        .workspace-scope { padding: 40px 5%; }
    }
</style>

<header class="hero" style="height: 45vh; background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.9)), url('https://images.unsplash.com/photo-1521737711867-e3b97375f902?q=80&w=2000'); background-size: cover; background-position: center; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
    <h1>The Workspace</h1>
    <p class="gold-text">WHERE CODE MEETS CAFFEINE</p>
</header>

<div class="workspace-scope">
    <section class="amenities">
        <h2 class="gold-text">Designed for Flow</h2>
        <p>A premium environment optimized for software developers, designers, and digital nomads.</p>
        
        <div class="amenity-grid">
            <div class="amenity-item">
                <i class="fas fa-wifi"></i>
                <h3>Gigabit Fiber</h3>
                <p>Uninterrupted high-speed internet for seamless deployments and calls.</p>
            </div>
            <div class="amenity-item">
                <i class="fas fa-plug"></i>
                <h3>Power Zones</h3>
                <p>Every seat is equipped with universal power outlets and USB-C ports.</p>
            </div>
            <div class="amenity-item">
                <i class="fas fa-couch"></i>
                <h3>Ergonomic Seating</h3>
                <p>Choose between focus booths, standing desks, or communal tables.</p>
            </div>
        </div>
    </section>

    <section class="pricing-section">
        <div class="pricing-container">
            <div class="price-card">
                <span class="plan">Day Pass</span>
                <h2 class="cost">R150</h2>
                <ul>
                    <li>Unlimited Coffee</li>
                    <li>High-Speed WiFi</li>
                    <li>Open Desk Seating</li>
                </ul>
                <a href="book-workspace.php?plan=daypass" class="btn btn-outline">Book Desk</a>
            </div>

            <div class="price-card featured">
                <span class="plan">Full Stack</span>
                <h2 class="cost">R2500<span>/mo</span></h2>
                <ul>
                    <li>Dedicated Locker</li>
                    <li>Meeting Room Access</li>
                    <li>24/7 Access Pass</li>
                    <li>Premium Perks</li>
                </ul>
                <a href="book-workspace.php?plan=fullstack" class="btn btn-gold">Join Hub</a>
            </div>
        </div>
    </section>
</div>

<?php include 'footer.php'; ?>