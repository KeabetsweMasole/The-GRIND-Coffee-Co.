<?php 
// 1. ALL PHP LOGIC GOES AT THE TOP
require_once 'db_connect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT id, full_name, password_hash, loyalty_points FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            // Now this will work because no HTML has been sent yet
            session_regenerate_id(true);
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['loyalty'] = $user['loyalty_points'];

            header("Location: menu.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    }
}

// 2. NOW INCLUDE THE HEADER (Which contains HTML/CSS)
include 'header.php'; 
?>

<style>
    .login-section {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .login-card {
        background: #0a0a0a;
        border: 1px solid #1a1a1a;
        padding: 50px;
        width: 100%;
        max-width: 400px;
        text-align: center;
        box-shadow: 0 20px 40px rgba(0,0,0,0.5);
    }

    .login-card h2 {
        font-size: 1.8rem;
        letter-spacing: 3px;
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    .login-card p.subtitle {
        color: #666;
        font-size: 0.8rem;
        margin-bottom: 30px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .form-group {
        margin-bottom: 25px;
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

    .error-msg {
        color: #ff4444;
        background: rgba(255, 68, 68, 0.1);
        padding: 10px;
        font-size: 0.75rem;
        margin-bottom: 20px;
        border-radius: 4px;
        border: 1px solid rgba(255, 68, 68, 0.2);
    }

    .btn-login {
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
        margin-top: 10px;
    }

    .btn-login:hover {
        background: #b39374; /* Slightly darker gold */
        transform: translateY(-2px);
    }

    .login-footer {
        margin-top: 30px;
        font-size: 0.75rem;
        color: #555;
    }

    .login-footer a {
        color: var(--gold);
        text-decoration: none;
        font-weight: 700;
    }
</style>

<main class="login-section">
    <div class="login-card">
        <h2 class="gold-text">Member Login</h2>
        <?php if(!empty($error)): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn-login">Login to Account</button>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>