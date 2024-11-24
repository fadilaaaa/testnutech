<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-blue-600 text-white p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">Profile</h1>
        <a href="/products" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">Back to Products</a>
    </header>

    <!-- Main Content -->
    <main class="flex-grow p-6">
        <div class="container mx-auto">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <div class="flex flex-col items-center space-y-4">
                    <img src="{{ asset('images/profile.jpeg') }}" alt="User Profile"
                        class=" w-[20%] border-2 border-gray-300">
                    <div>
                        <h2 class="text-2xl font-bold">Aminudin Fadila</h2>
                        <p class="text-gray-700">Web Programmer</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        © 2024 Aminudin Fadila Products. All Rights Reserved.
    </footer>
</body>

</html>
