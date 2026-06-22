<?php
session_start();

/** * DATABASE CONNECTION
 * Replace 'db_connect.php' with your actual connection file name.
 * Ensure your connection variable is named $conn.
 */
// include 'db_connect.php'; 

// Check if the form was actually submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. COLLECT AND SANITIZE DATA
    // Using filter_input or htmlspecialchars to prevent XSS/Injection
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $plan    = htmlspecialchars($_POST['plan_type']);
    $date    = htmlspecialchars($_POST['booking_date']);
    $seating = isset($_POST['seating']) ? htmlspecialchars($_POST['seating']) : 'Standard';

    // 2. BACK-END VALIDATION
    $errors = [];

    // Check if date is in the past
    if (strtotime($date) < strtotime(date('Y-m-d'))) {
        $errors[] = "You cannot book a workspace for a past date.";
    }

    // Check for empty fields
    if (empty($name) || empty($email) || empty($date)) {
        $errors[] = "All required fields must be filled.";
    }

    // If there are validation errors, redirect back with the first error
    if (!empty($errors)) {
        $_SESSION['error_msg'] = $errors[0];
        header("Location: book-workspace.php?plan=$plan");
        exit();
    }

    // 3. DATABASE INSERTION LOGIC
    /**
     * UNCOMMENT THIS SECTION ONCE YOUR DB CONNECTION IS READY
     * try {
        $sql = "INSERT INTO workspace_bookings (user_name, user_email, plan_type, booking_date, seating_preference, status) 
                VALUES (?, ?, ?, ?, ?, 'Confirmed')";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $plan, $date, $seating);

        if ($stmt->execute()) {
            // SUCCESS: Redirect to success page
            $_SESSION['booking_success'] = "Your $plan reservation for $date is confirmed!";
            header("Location: booking-success.php");
            exit();
        } else {
            // SQL EXECUTION FAILURE
            throw new Exception("Database execution failed.");
        }
    } catch (Exception $e) {
        // Log error and redirect to error page
        error_log($e->getMessage());
        header("Location: booking-error.php");
        exit();
    }
    */

    // --- TEMPORARY SIMULATION FOR TESTING (Remove when DB is connected) ---
    $_SESSION['booking_success'] = "Your " . ucfirst($plan) . " reservation for " . $date . " is confirmed!";
    header("Location: booking-success.php");
    exit();

} else {
    // If someone tries to access this file directly via URL, send them back to workspace
    header("Location: workspace.php");
    exit();
}
?>