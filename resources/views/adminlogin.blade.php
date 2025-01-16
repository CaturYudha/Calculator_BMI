<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-sm sm:max-w-md md:max-w-lg bg-white rounded-lg shadow-lg p-6 sm:p-8 md:p-10">
            <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-center text-gray-900 mb-6 sm:mb-8">Admin Login</h2>

            <form id="loginForm">
                <div class="mb-4 sm:mb-5">
                    <label for="email" class="block text-gray-700 text-sm sm:text-base font-medium mb-1 sm:mb-2">Email</label>
                    <input type="email" id="email" class="shadow-sm appearance-none border rounded w-full py-2 px-3 sm:py-3 sm:px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required autofocus>
                </div>

                <div class="mb-5 sm:mb-6">
                    <label for="password" class="block text-gray-700 text-sm sm:text-base font-medium mb-1 sm:mb-2">Password</label>
                    <input type="password" id="password" class="shadow-sm appearance-none border rounded w-full py-2 px-3 sm:py-3 sm:px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                </div>

                <div class="flex items-center justify-between mb-5 sm:mb-6">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" class="h-4 w-4 sm:h-5 sm:w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm sm:text-base text-gray-900">
                            Remember me
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <button id="submitButton" type="submit" class="w-full bg-blue-500 hover:bg-blue-600 focus:bg-blue-600 text-white font-medium py-2 px-4 sm:py-3 sm:px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 text-sm sm:text-base transition duration-150 ease-in-out">
                        Login
                    </button>
                </div>

                <div id="errorMessage" class="mt-4 text-red-500 text-center hidden">Invalid email or password. Please try again.</div>
            </form>
        </div>
    </div>

    <script>
        // Handle login form submission
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            e.preventDefault();

            // Show loading indicator by disabling the button
            const submitButton = document.getElementById('submitButton');
            submitButton.disabled = true;
            submitButton.textContent = 'Logging in...';

            // Simulate successful login and directly navigate to /admins page
            window.location.href = '/admins';  // Skip login validation and go directly to /admins page
        });
    </script>
</body>

</html>
