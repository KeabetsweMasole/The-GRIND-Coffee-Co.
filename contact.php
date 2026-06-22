<?php include 'header.php'; ?>

<style>
    /* Internal Styles for Contact Page */
    .contact-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 80px 10%;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 80px;
        align-items: start;
    }

    .contact-details {
        text-align: left;
    }

    .contact-details h2 {
        font-size: 2.5rem;
        margin-bottom: 20px;
    }

    .contact-details p {
        font-size: 1.1rem;
        color: #888;
        margin-bottom: 40px;
        line-height: 1.8;
    }

    /* Info Blocks */
    .info-block {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    .info-item strong {
        display: block;
        color: var(--gold);
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 2px;
        margin-bottom: 5px;
    }

    .info-item p {
        color: white;
        font-size: 1rem;
        margin-bottom: 0;
    }

    /* Form Card */
    .contact-form-card {
        background: var(--gray-dark);
        padding: 40px;
        border: 1px solid var(--gray-medium);
        border-radius: 4px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    }

    .form-group {
        margin-bottom: 25px;
        text-align: left;
    }

    .form-group label {
        display: block;
        font-size: 0.7rem;
        color: var(--gold);
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 10px;
        font-weight: 700;
    }

    input, textarea {
        width: 100%;
        padding: 15px;
        background: #050505;
        border: 1px solid #333;
        color: white;
        font-family: 'Montserrat', sans-serif;
        outline: none;
        transition: var(--transition);
    }

    input:focus, textarea:focus {
        border-color: var(--gold);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .contact-grid {
            grid-template-columns: 1fr;
            gap: 60px;
        }

        .contact-container {
            padding: 60px 5%;
        }

        .contact-details {
            text-align: center;
        }
    }
</style>

<header class="hero" style="height: 40vh; background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.9)), url('https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2000'); background-size: cover; background-position: center; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
    <h1>Contact Us</h1>
    <p class="gold-text">GET IN TOUCH WITH THE TEAM</p>
</header>

<section class="contact-container">
    <div class="contact-grid">
        
        <div class="contact-details">
            <h2 class="gold-text">Reach Out</h2>
            <p>Have a question about our coffee, our workspace, or just want to say hi? Drop us a message.</p>
            
            <div class="info-block">
                <div class="info-item">
                    <strong>Location</strong>
                    <p>123 Coffee Lane, Sandton, South Africa</p>
                </div>
                <div class="info-item">
                    <strong>Email</strong>
                    <p>info@thegrindcoffeecompany.co.za</p>
                </div>
                <div class="info-item">
                    <strong>WhatsApp</strong>
                    <p>+27 11 123 4567</p>
                </div>
            </div>
        </div>

        <div class="contact-form-card">
            <form action="send-message.php" method="POST">
                <div class="form-group">
                    <label>Your Name</label>
                    <input type="text" name="name" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="email@example.com" required>
                </div>
                <div class="form-group">
                    <label>Subject</label>
                    <input type="text" name="subject" placeholder="General Inquiry">
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea name="message" rows="6" placeholder="How can we help?"></textarea>
                </div>
                <button type="submit" class="btn btn-gold" style="width: 100%;">Send Message</button>
            </form>
        </div>

    </div>
</section>

<script>
    // Logic to handle URL parameters for dynamic subjects
    const urlParams = new URLSearchParams(window.location.search);
    const reference = urlParams.get('ref');
    const inquiry = urlParams.get('inquiry');
    
    const subjectField = document.querySelector('input[name="subject"]');
    
    if (reference === 'fullstack') {
        subjectField.value = "Membership Inquiry: Full Stack Plan";
    } else if (reference === 'daypass') {
        subjectField.value = "Booking: Day Pass Inquiry";
    } else if (inquiry === 'menu') {
        subjectField.value = "Catering Inquiry: Menu Items";
    }
</script>

<?php include 'footer.php'; ?>