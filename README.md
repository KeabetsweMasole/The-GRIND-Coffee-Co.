# Grind Coffee Co. ☕

## Overview
Grind Coffee Co. is a full-stack coffee shop platform consisting of:

1. **Web Application** – Customer-facing website built with PHP, JavaScript, HTML, and CSS.
2. **Mobile Application (Android)** – Native Android application packaged as an APK.

The platform allows customers to browse products, place orders, manage accounts, view order history, book workspaces/events, and interact with the Grind Coffee Co. ecosystem across both web and mobile devices.

---

## Features

### Website
- User registration and login
- Customer profile management
- Coffee and food menu browsing
- Order placement and tracking
- Order history
- Workspace booking system
- Event booking functionality
- Queue ticket management
- Account settings management
- Responsive user interface

### Mobile Application (Android)
- Android mobile experience
- Customer account access
- Mobile ordering workflow
- Integrated coffee shop services
- Optimized user experience for smartphones

---

## Technology Stack

### Web Application
- PHP
- HTML5
- CSS3
- JavaScript
- MySQL Database

### Mobile Application
- Kotlin / Android
- AndroidX Libraries
- Gradle Build System

---

## Project Structure

```text
Grind-Coffee-Co/
│
├── website/
│   ├── index.php
│   ├── menu.php
│   ├── order.php
│   ├── workspace.php
│   ├── profile.php
│   ├── login.php
│   ├── register.php
│   ├── settings.php
│   └── ...
│
├── mobile-app/
│   └── Grind Coffee Co.apk
│
└── README.md
```

---

## Website Pages

| Page | Description |
|--------|-------------|
| Home | Landing page for customers |
| Menu | Browse coffee and food items |
| Order | Place customer orders |
| Track Order | Track order status |
| Workspace | Book workspace facilities |
| Hire Me / Events | Event booking functionality |
| Profile | Manage user profile |
| Settings | User preferences |
| Order History | Previous customer orders |

---

## Installation

### Website Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/grind-coffee-co.git
   ```

2. Move the project into your web server directory.

3. Create a MySQL database.

4. Configure database credentials in:

   ```php
   db_connect.php
   ```

5. Start Apache and MySQL.

6. Open:

   ```
   http://localhost/grind-coffee-co
   ```

### Android App

1. Install the provided APK.
2. Enable installation from unknown sources if required.
3. Launch the application.

---

## Future Enhancements

- Real-time order updates
- Advanced analytics dashboard
- Mobile and web synchronization

---

## Author

- Keabetswe Masole [ST10437711] (PM, Risk Management, App Dev)
- Amogelang Matlhaga [ST10355816] (Lead Developer, Web Dev)
- Lesego Mathe [ST10440650] (Admin, Design)
