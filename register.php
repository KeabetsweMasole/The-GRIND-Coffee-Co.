<?php 
include 'header.php'; 
require_once 'db_connect.php';

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($fullName) && !empty($email) && !empty($password)) {
        // Check if email already exists
        $checkEmail = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $checkEmail->execute([$email]);

        if ($checkEmail->rowCount() > 0) {
            $error = "This email is already registered.";
        } else {
            // Hash the password securely
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Match your schema: id, full_name, email, password_hash, loyalty_points, created_at
            $stmt = $pdo->prepare("INSERT INTO users (full_name, email, password_hash, loyalty_points) VALUES (?, ?, ?, 0)");
            
            if ($stmt->execute([$fullName, $email, $hashedPassword])) {
                $success = "Account created! You can now login.";
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<style>
    .register-section {
        min-height: 85vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 60px 20px;
    }

    .register-card {
        background: #0a0a0a;
        border: 1px solid #1a1a1a;
        padding: 50px;
        width: 100%;
        max-width: 450px;
        text-align: center;
        box-shadow: 0 20px 40px rgba(0,0,0,0.5);
    }

    .register-card h2 {
        font-size: 1.8rem;
        letter-spacing: 3px;
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    .register-card p.subtitle {
        color: #666;
        font-size: 0.8rem;
        margin-bottom: 30px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .form-group {
        margin-bottom: 20px;
        text-align: left;
    }

    .form-group label {
        display: block;
        color: var(--gold);
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 8px;
    }

    .form-group input {
        width: 100%;
        padding: 15px;
        background: #111;
        border: 1px solid #222;
        color: #fff;
        font-family: 'Montserrat', sans-serif;
        font-size: 0.9rem;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .form-group input:focus {
        outline: none;
        border-color: var(--gold);
        background: #151515;
    }

    .status-msg {
        padding: 12px;
        font-size: 0.8rem;
        margin-bottom: 20px;
        border-radius: 4px;
        text-align: center;
    }

    .error-msg {
        color: #ff4444;
        background: rgba(255, 68, 68, 0.1);
        border: 1px solid rgba(255, 68, 68, 0.2);
    }

    .success-msg {
        color: #00ff00;
        background: rgba(0, 255, 0, 0.1);
        border: 1px solid rgba(0, 255, 0, 0.2);
    }

    .btn-register {
        width: 100%;
        padding: 16px;
        background: var(--gold);
        color: #000;
        border: none;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 0.8rem;
        cursor: pointer;
        transition: transform 0.2s ease, background 0.3s ease;
        margin-top: 15px;
    }

    .btn-register:hover {
        background: #b39374;
        transform: translateY(-2px);
    }

    .register-footer {
        margin-top: 30px;
        font-size: 0.75rem;
        color: #555;
    }

    .register-footer a {
        color: var(--gold);
        text-decoration: none;
        font-weight: 700;
    }
</style>

<main class="register-section">
    <div class="register-card">
        <h2 class="gold-text">Join The Grind</h2>
        <p class="subtitle">Become a member & earn loyalty points</p>

        <?php if(!empty($error)): ?>
            <div class="status-msg error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if(!empty($success)): ?>
            <div class="status-msg success-msg"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST" action="register.php">
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" placeholder="Amogelang Matlhaga" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="amo@thegrind.co.za" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Create a strong password" required>
            </div>

            <button type="submit" class="btn-register">Create Account</button>
        </form>

        <div class="register-footer">
            Already a member? <a href="login.php">Login to your account</a>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>