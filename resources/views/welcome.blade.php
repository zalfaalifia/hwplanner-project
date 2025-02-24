<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Homework Planner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: url('{{ asset("images/homework.png") }}') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            overflow: hidden;
            position: relative;
        }

        .big-image {
            position: absolute;
            top: 15%;
            left: 50%;
            transform: translateX(-50%);
            width: 700px; /* Sesuaikan ukuran */
            height: auto;
            z-index: 3;
        }

        .context {
            text-align: center;
            position: relative;
            z-index: 2;
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 1s ease-out, transform 1s ease-out;
        }

        .navbar {
            background-color: #001 !important;
        }

        .floating-img {
            position: fixed;
            bottom: 20px;
            left: -30px;
            width: 350px;
            height: auto;
            z-index: 3;
            animation: slideIn 3s ease-in-out 3 alternate;
        }

        .chat-box {
            position: fixed;
            bottom: 50px;
            left: 250px;
            background: rgba(0, 0, 0, 0.174);
            border-radius: 10px;
            padding: 15px;
            width: 300px;
            text-align: center;
            z-index: 2;
        }

        .chat-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .chat-buttons a {
            padding: 8px 12px;
            background: #a4cbff;
            border-radius: 5px;
            text-decoration: none;
            color: rgb(255, 255, 255);
            font-weight: bold;
            animation: bounce 1.5s infinite;
            cursor: pointer;
        }

        .chat-buttons a:hover {
            background: #0684d2;
        }

        @keyframes slideIn {
            0% { left: -280px; }
            100% { left: 20px; }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top w-100">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">HomeWork Planner</a>
        </div>
    </nav>

    <img src="{{ asset('images/background.jpg') }}" alt="Big Image" class="big-image">

    <div class="context">
        <p>Aplikasi ini membantu kamu mengatur tugas sekolah dengan mudah dan efisien. <br>Buat daftar tugas, atur deadline, dan tetap terorganisir. <br>Dengan perencanaan yang rapi, tugas jadi lebih ringan dan selesai tepat waktu!</p>
    </div>

    <img src="{{ asset('images/kucing.png') }}" alt="Planner" class="floating-img">

    <div class="chat-box">
        <p>Do you need to make a task?</p>
        <div class="chat-buttons">
            <a href="{{ route('user.register') }}">Yup!</a>
            <a href="#">No, Thanks</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
