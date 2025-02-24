<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #083055;
        }
        .auth-container {
            background-color: rgb(225, 229, 236);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .auth-header {
            font-weight: bold;
            color: #007bff;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-label {
            font-weight: bold;
        }
        .auth-footer {
            text-align: center;
            margin-top: 15px;
        }
        .auth-footer a {
            color: #007bff;
            text-decoration: none;
        }
        .auth-footer a:hover {
            text-decoration: underline;
        }

        /* Animasi layar nutup */
        .screen-transition {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgb(70, 143, 177);; /* Biru muda */
            transform: translateX(-100%);
            transition: transform 0.7s ease-in-out;
            z-index: 9999;
        }
        .active {
            transform: translateX(0);
        }
    </style>
</head>
<body>
    <div class="screen-transition" id="screenTransition"></div>

    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-md-6 auth-container">
            <h2 class="text-center auth-header mb-4">Register</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.save') }}" method="POST" id="registerForm">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100" id="registerButton">Register</button>

                <div class="auth-footer">
                    <p>Already have an account? <a href="{{ route('user.login') }}">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("registerForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Cegah form submit langsung
            document.getElementById("screenTransition").classList.add("active");

            setTimeout(() => {
                event.target.submit(); // Submit form setelah animasi selesai
            }, 700); // Delay sesuai durasi animasi
        });
    </script>
</body>
</html>
