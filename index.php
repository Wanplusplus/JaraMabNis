<?php
require_once "importance.php";

// Define valid routes mapped to view files
$routes = [
    // Auth
    'login'               => 'views/login.php',
    'logout'              => 'views/logout.php',
    'login-patient'       => 'views/login-patient.php',

    // Dashboard (default)
    'dashboard'           => 'views/dashboard.php',

    // Patients
    'patients'            => 'views/patients.php',
    'add-patient'         => 'views/add-patients.php',
    'new-patient'         => 'views/new-patient.php',
    'patient-data'        => 'views/patient-data.php',

    // Doctors
    'doctors-record'      => 'views/doctors-record.php',
    'add-doctor'          => 'views/add-doctors.php',

    // Appointments
    'appointments'        => 'views/appointments.php',
    'book-appointments'   => 'views/book-appointments.php',
    'reply-appointment'   => 'views/reply-appointment.php',
    'p-reply-appointments'=> 'views/p-reply-appointments.php',
    'p-sent-appointments' => 'views/p-sent-appointments.php',

    // Records
    'outbreaks'           => 'views/outbreaks.php',
    'add-outbreak'        => 'views/add-outbreak.php',
    'hiv'                 => 'views/hiv.php',

    // Other
    'enquiry'             => 'views/enquiry.php',
    'reports'             => 'views/reports.php',
    'print'               => 'views/print.php',
    'profile'             => 'views/profile.php',
    'change-password'     => 'views/change-password.php',
    'cop-paste'           => 'views/cop-paste.php',
    'settings'            => 'views/settings.php',
];

// Public routes that don't require login
$publicRoutes = ['login', 'login-patient', 'enquiry'];

// Get current route (default to dashboard)
$route = isset($_GET['route']) ? trim($_GET['route']) : 'dashboard';

// Redirect to login if not logged in and route is protected
if (!in_array($route, $publicRoutes) && !User::loggedIn()) {
    Config::redir("login");
}

// Redirect logged-in users away from login page
if (in_array($route, ['login', 'login-patient']) && User::loggedIn()) {
    Config::redir("dashboard");
}

// Dispatch to the correct view
if (array_key_exists($route, $routes)) {
    $viewFile = $routes[$route];
    if (file_exists($viewFile)) {
        require_once $viewFile;
    } else {
        // View file missing
        http_response_code(404);
        echo "<h2>Page not found: <code>" . htmlspecialchars($route) . "</code></h2>";
        echo "<p>Expected view file: <code>" . htmlspecialchars($viewFile) . "</code></p>";
    }
} else {
    // Unknown route
    http_response_code(404);
    echo "<h2>404 - Page not found</h2>";
    echo "<p><a href='?route=dashboard'>Go to Dashboard</a></p>";
}