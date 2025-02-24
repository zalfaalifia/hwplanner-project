<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homework Planner</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Theme variables - Light mode becomes the alternate theme */
        :root[data-theme="light"] {
            --primary-bg: #ffffff;
            --nav-bg: #f3f4f6;
            --text-color: #000000;
            --hero-bg: #f8fafc;
            --features-bg: #f3f4f6;
            --card-bg: #ffffff;
            --footer-bg: #1f2937;
        }

        /* Dark theme is now default */
        :root {
            --primary-bg: #111827;
            --nav-bg: #001f3f;
            --text-color: #ffffff;
            --hero-bg: #002244;
            --features-bg: #003b5c;
            --card-bg: #ffffff;
            --footer-bg: #1f2937;
        }

        .animate-bg {
            animation: pulse-bg 2s infinite;
        }

        @keyframes pulse-bg {
            0% { background-color: var(--nav-bg); }
            50% { background-color: var(--features-bg); }
            100% { background-color: var(--nav-bg); }
        }

        .floating-object {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0); }
        }

        .popup {
            opacity: 0;
            transform: scale(0.5);
            transition: opacity 0.5s ease-out, transform 0.5s ease-out;
        }
        .popup.visible {
            opacity: 1;
            transform: scale(1);
        }

        .feature-card {
            transition: all 0.3s ease-in-out;
        }
        .feature-card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            z-index: 10;
        }
        .feature-card:hover img {
            transform: scale(1.1);
        }
        .feature-card:hover h2 {
            color: #1a73e8;
        }

        /* Theme switch styles */
        .theme-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .theme-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #2196F3;  /* Default to blue (checked state) */
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #ccc;  /* Change to gray when switching to light mode */
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }
    </style>
</head>
<body class="transition-colors duration-300" style="background-color: var(--primary-bg); color: var(--text-color);">

    <!-- Navbar -->
    <nav class="py-4 px-6 flex justify-between items-center fixed top-0 w-full z-10 transition-colors duration-300" style="background-color: var(--nav-bg);">
        <div class="text-2xl font-extrabold tracking-widest">Homework Planner</div>
        <div class="flex space-x-6 items-center">
            <!-- Theme Switch -->
            <div class="flex items-center space-x-2">
                <span>🌙</span>
                <label class="theme-switch">
                    <input type="checkbox" id="theme-toggle">
                    <span class="slider"></span>
                </label>
                <span>☀</span>
            </div>
            <a href="{{ route ('calendar.index') }}" class="hover:underline">Calendar</a>
            <a href="{{ route('user.tasks') }}" class="hover:underline">My Task</a>
            <form action="{{ route('user.logout') }}" method="POST">
                @csrf
                <button type="submit" class="hover:underline bg-transparent border-none cursor-pointer">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="flex flex-col md:flex-row items-center justify-between text-center md:text-left py-12 px-6 relative mt-16 rounded-lg shadow-lg max-w-5xl mx-auto border transition-colors duration-300" style="background-color: var(--hero-bg);">
        <div class="md:w-1/2">
            <h1 class="text-4xl font-bold drop-shadow-lg">Stay Organized, Stay Ahead!</h1>
            <p class="text-md mt-4 opacity-75">Aplikasi ini dirancang khusus untuk membantu siswa dan siswi SMKN 1 Gunung Putri dalam mengatur dan merencanakan tugas sekolah dengan lebih mudah dan efisien.</p>
            <a href="{{ route('user.addtask')}}" class="mt-6 bg-blue-400 text-gray-900 py-3 px-6 rounded-lg text-lg font-semibold hover:bg-orange-500 transition transform hover:scale-110 shadow-lg inline-block">
                Get Started Now
            </a>
        </div>
        <img src="{{ asset('images/cat_mascot.png') }}" alt="Mascot" class="floating-object w-96 h-96 object-contain">
    </section>

    <!-- Features Section -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center px-6 py-12 transition-colors duration-300" style="background-color: var(--features-bg);">
        <div class="p-4 rounded-lg shadow-lg feature-card popup transition-all duration-300" style="background-color: var(--card-bg);">
            <img src="{{ asset('images/burnout.jpg') }}" alt="Calendar" class="mx-auto mb-2 rounded-full w-24 h-24 object-cover transition-transform duration-300">
            <h2 class="text-lg font-semibold text-gray-900 transition-colors duration-300">Problem about homework!</h2>
            <p class="text-gray-600 text-sm mt-1">Kamu sering mengalami burnout karna banyaknya homework? Kerjakan dengan bertahap dengan HomeWork Planner aja!</p>
        </div>
        <div class="p-4 rounded-lg shadow-lg feature-card popup transition-all duration-300" style="background-color: var(--card-bg);">
            <img src="{{ asset('images/bingung.jpg') }}" alt="Task Management" class="mx-auto mb-2 rounded-full w-24 h-24 object-cover transition-transform duration-300">
            <h2 class="text-lg font-semibold text-gray-900 transition-colors duration-300">Matematika atau B Inggris?</h2>
            <p class="text-gray-600 text-sm mt-1">Bukan pilihan yang sulit, kerjakan homeworkmu bisa lebih seimbang dengan homework planner loh!</p>
        </div>
        <div class="p-4 rounded-lg shadow-lg feature-card popup transition-all duration-300" style="background-color: var(--card-bg);">
            <img src="{{ asset('images/panik.jpg') }}" alt="Notifications" class="mx-auto mb-2 rounded-full w-24 h-24 object-cover transition-transform duration-300">
            <h2 class="text-lg font-semibold text-gray-900 transition-colors duration-300">Dikejar Deadline?</h2>
            <p class="text-gray-600 text-sm mt-1">Gemeteran kalau ada di situasi ini, Yuk segera kerjakan tugasmu sesuai jadwal yang akan kamu tentukan!</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-white text-center py-4 transition-colors duration-300" style="background-color: var(--footer-bg);">
        <p>&copy; 2025 Homework Planner. All rights reserved.</p>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Popup animation
            const elements = document.querySelectorAll(".popup");
            elements.forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add("visible");
                }, index * 300);
            });

            // Theme switching
            const themeToggle = document.getElementById('theme-toggle');

            // Check for saved theme preference, default to dark if none saved
            const savedTheme = localStorage.getItem('theme') || 'dark';
            document.documentElement.setAttribute('data-theme', savedTheme);
            themeToggle.checked = savedTheme === 'light';  // Checked now means light mode

            // Theme switch handler
            themeToggle.addEventListener('change', function() {
                if (this.checked) {
                    document.documentElement.setAttribute('data-theme', 'light');
                    localStorage.setItem('theme', 'light');
                } else {
                    document.documentElement.setAttribute('data-theme', 'dark');
                    localStorage.setItem('theme', 'dark');
                }
            });
        });
    </script>
</body>
</html>
