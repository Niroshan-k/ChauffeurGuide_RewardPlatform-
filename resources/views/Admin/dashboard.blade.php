<!-- filepath: /Applications/XAMPP/xamppfiles/htdocs/ChauffeurGuide_RewardPlatform/resources/views/Admin/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css'])
    <script>
        // Redirect to login if no token
        if (!localStorage.getItem('admin_token')) {
            window.location.href = '/admin/login';
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full text-center">
        <h1 class="text-3xl font-bold text-blue-700 mb-4">Admin Dashboard</h1>
        <p class="text-gray-700">Welcome, Admin! You are logged in.</p>
    </div>
</body>
</html>