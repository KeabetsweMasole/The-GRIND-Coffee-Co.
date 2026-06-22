<?php 
// Start the session to track logged-in users and loyalty points
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}

// Check login status
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THE GRIND. | Premium Coffee & Workspace</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    
    <style>
        /* --- Navigation Layout --- */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 8%;
            background: #000;
            position: sticky;
            top: 0;
            z-index: 1001;
            border-bottom: 1px solid #111;
        }

        .logo {
            font-size: 1.4rem;
            font-weight: 900;
            color: #fff;
            letter-spacing: 2px;
            text-decoration: none;
            text-transform: uppercase;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 30px;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .nav-links a {
            text-decoration: none;
            color: #fff;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            transition: color 0.3s ease;
        }

        .nav-links a:hover { color: var(--gold, #C4A484); }

        /* --- Live Tracker Button --- */
        .tracker-link {
            color: var(--gold, #C4A484) !important;
            border: 1px solid var(--gold, #C4A484);
            padding: 6px 12px !important;
            border-radius: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(196, 164, 132, 0.05);
        }

        .live-dot {
            width: 8px;
            height: 8px;
            background: #00ff00;
            border-radius: 50%;
            animation: pulse-green 1.5s infinite;
        }

        @keyframes pulse-green {
            0% { box-shadow: 0 0 0 0px rgba(0, 255, 0, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(0, 255, 0, 0); }
            100% { box-shadow: 0 0 0 0px rgba(0, 255, 0, 0); }
        }

        /* --- Profile Avatar --- */
        .nav-avatar {
            width: 35px;
            height: 35px;
            background: var(--gold, #C4A484);
            color: #000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 0.85rem;
            transition: 0.3s;
        }

        .nav-avatar:hover {
            transform: scale(1.1);
            filter: brightness(1.1);
        }

        .logout-icon {
            color: #888 !important; 
            font-size: 3rem; /* Updated to 3rem as requested */
            padding-left: 15px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            line-height: 1; /* Prevents the large icon from pushing the nav height */
        }

        .logout-icon:hover { 
            color: #ff4444 !important; 
            transform: scale(1.1); 
        }

        /* --- Mobile Toggle (Hamburger) --- */
        .menu-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            z-index: 1002;
        }

        .bar { width: 25px; height: 2px; background: #fff; transition: 0.3s; }

        /* --- Mobile Responsive (Top-Drop Menu) --- */
        @media screen and (max-width: 992px) {
            .menu-toggle { display: flex; }

            .nav-links {
                position: fixed;
                top: -100%; /* Hidden off-top */
                left: 0;
                width: 100%;
                background: rgba(0, 0, 0, 0.98);
                flex-direction: column;
                padding: 100px 0 50px 0;
                transition: all 0.5s cubic-bezier(0.77, 0.2, 0.05, 1.0);
                border-bottom: 2px solid var(--gold, #C4A484);
            }

            .nav-links.active { top: 0; }
            .nav-links li { margin: 15px 0; }
            .nav-links a { font-size: 1.1rem; }

            .menu-toggle.is-active .bar:nth-child(2) { opacity: 0; }
            .menu-toggle.is-active .bar:nth-child(1) { transform: translateY(7px) rotate(45deg); }
            .menu-toggle.is-active .bar:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
        }
    </style>
</head>
<body>

<nav>
    <a href="index.php" class="logo">THE GRIND.</a>
    
    <div class="menu-toggle" id="mobile-menu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>

    <ul class="nav-links" id="nav-list">
        <li><a href="index.php">Home</a></li>
        <li><a href="menu.php">Menu</a></li>
        <li><a href="workspace.php">Workspace</a></li>
        <li><a href="hire-me.php">Hire Me</a></li>
        <li><a href="contact.php">Contact</a></li>

        <?php if($isLoggedIn): ?>
            <li>
                <a href="track-order.php" class="tracker-link" title="Track Active Order">
                    <span class="live-dot"></span>
                    Tracker
                </a>
            </li>

            <li>
                <a href="profile.php" title="My Profile">
                    <div class="nav-avatar">
                        <?php echo strtoupper(substr($_SESSION['user_name'] ?? 'U', 0, 1)); ?>
                    </div>
                </a>
            </li>

            <li>
                <a href="logout.php" class="logout-icon" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        <?php else: ?>
            <li><a href="login.php" style="color: var(--gold, #C4A484) !important;">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>

<script>
    const menu = document.querySelector('#mobile-menu');
    const navList = document.querySelector('#nav-list');

    // Toggle Menu
    menu.addEventListener('click', () => {
        menu.classList.toggle('is-active');
        navList.classList.toggle('active');
    });

    // Close menu on link click
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', () => {
            menu.classList.remove('is-active');
            navList.classList.remove('active');
        });
    });
</script>