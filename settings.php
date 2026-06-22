<?php 
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
include 'header.php'; 

$userName = $_SESSION['user_name'] ?? "Amogelang Matlhaga";
$userEmail = $_SESSION['user_email'] ?? "amo@syretech.co.za";
?>

<style>
    /* Updated this section to center everything vertically and horizontally */
    .settings-container { 
        min-height: 80vh; 
        background: #050505; 
        color: white; 
        padding: 60px 10%; 
        font-family: 'Montserrat', sans-serif; 
        display: flex; 
        flex-direction: column; /* Stack the back button and card */
        justify-content: center; 
        align-items: center; 
    }

    .settings-card { 
        width: 100%; 
        max-width: 700px; 
        background: #0a0a0a; 
        padding: 40px; 
        border: 1px solid #111; 
        border-radius: 12px; 
    }
    
    /* Back Button Styling */
    .back-dash {
        align-self: center; /* Centers the button horizontally */
        width: 100%;
        max-width: 700px; /* Matches the card width */
        color: #555;
        text-decoration: none;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
        transition: 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .back-dash:hover { color: var(--gold, #C4A484); }

    .form-group { margin-bottom: 25px; }
    .form-group label { display: block; font-size: 0.7rem; color: var(--gold, #C4A484); text-transform: uppercase; margin-bottom: 10px; letter-spacing: 1px; }
    .form-group input { width: 100%; background: #000; border: 1px solid #222; padding: 12px; color: white; border-radius: 5px; outline: none; transition: 0.3s; }
    .form-group input:focus { border-color: var(--gold, #C4A484); }
    
    .save-btn { background: var(--gold, #C4A484); color: #000; border: none; padding: 15px 30px; font-weight: 900; text-transform: uppercase; cursor: pointer; border-radius: 5px; width: 100%; margin-top: 20px; }
    .save-btn:hover { filter: brightness(1.1); }
</style>

<div class="settings-container">
    <a href="profile.php" class="back-dash">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
    </a>

    <div class="settings-card">
        <h2 style="margin-bottom: 30px; font-weight: 900;">Account Settings</h2>
        
        <form action="update-profile.php" method="POST">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" value="<?php echo $userName; ?>">
            </div>
            
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="<?php echo $userEmail; ?>">
            </div>
            
            <div class="form-group">
                <label>New Password (Leave blank to keep current)</label>
                <input type="password" name="password" placeholder="••••••••">
            </div>

            <div style="margin: 40px 0; border-top: 1px solid #111; padding-top: 20px;">
                <h3 style="font-size: 0.9rem; margin-bottom: 15px;">Preferences</h3>
                <label style="display: flex; align-items: center; gap: 10px; font-size: 0.8rem; color: #888; cursor: pointer;">
                    <input type="checkbox" checked style="width: auto;"> Receive "Brew Ready" WhatsApp notifications
                </label>
            </div>
            
            <button type="submit" class="save-btn">Update Profile</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>