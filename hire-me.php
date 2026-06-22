<?php include 'header.php'; ?>

<style>
    /* Internal Styles for Hire Page */
    .booking-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 80px 10%;
    }

    .booking-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: start;
    }

    .booking-info {
        text-align: left;
    }

    .booking-info h2 {
        font-size: 2.5rem;
        margin-bottom: 20px;
    }

    .booking-info p {
        font-size: 1.1rem;
        color: #ccc;
        margin-bottom: 30px;
        line-height: 1.8;
    }

    .service-list {
        list-style: none;
        padding: 0;
    }

    .service-list li {
        margin-bottom: 20px;
        padding-left: 30px;
        position: relative;
    }

    .service-list li::before {
        content: '→';
        position: absolute;
        left: 0;
        color: var(--gold);
        font-weight: bold;
    }

    .service-list strong {
        color: var(--gold);
        display: block;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 1px;
    }

    /* Form Card Styling */
    .booking-form-card {
        background: var(--gray-dark);
        padding: 40px;
        border: 1px solid var(--gray-medium);
        border-radius: 4px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    }

    .form-group {
        margin-bottom: 20px;
        text-align: left;
    }

    .form-group label {
        display: block;
        font-size: 0.75rem;
        color: var(--gold);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 8px;
        font-weight: 700;
    }

    input, select, textarea {
        width: 100%;
        padding: 12px 15px;
        background: #050505;
        border: 1px solid #333;
        color: white;
        font-family: 'Montserrat', sans-serif;
        outline: none;
        transition: var(--transition);
    }

    input:focus, select:focus, textarea:focus {
        border-color: var(--gold);
    }

    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .booking-grid {
            grid-template-columns: 1fr;
            gap: 40px;
        }
        
        .booking-container {
            padding: 60px 5%;
        }
    }
</style>

<header class="hero" style="height: 40vh; background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.9)), url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=2000'); background-size: cover; background-position: center; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
    <h1>Hire The Grind</h1>
    <p class="gold-text">BRING THE EXPERIENCE TO YOUR EVENT</p>
</header>

<section class="booking-container">
    <div class="booking-grid">
        
        <div class="booking-info">
            <h2 class="gold-text">Event Services</h2>
            <p>Whether it's a corporate launch, a private wedding, or a creative workshop, our mobile barista team provides world-class service.</p>
            
            <ul class="service-list">
                <li><strong>Mobile Espresso Bar</strong> Full service with professional baristas.</li>
                <li><strong>Catering</strong> Curated snacks and light cuisine.</li>
                <li><strong>Space Hire</strong> Book our creative hub for your private session.</li>
            </ul>
        </div>

        <div class="booking-form-card">
            <form action="process-booking.php" method="POST">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="email@example.com" required>
                </div>
                <div class="form-group">
                    <label>Event Type</label>
                    <select name="event_type">
                        <option value="corporate">Corporate Event</option>
                        <option value="private">Private Party</option>
                        <option value="workshop">Creative Workshop</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Message / Details</label>
                    <textarea name="message" rows="5" placeholder="Tell us about your event..."></textarea>
                </div>
                <button type="submit" class="btn btn-gold" style="width: 100%;">Send Inquiry</button>
            </form>
        </div>

    </div>
</section>

<?php include 'footer.php'; ?>