<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            background: radial-gradient(circle at 50% 50%, rgba(58,123,213,0.8), rgba(0,210,255,0.8), rgba(58,213,118,0.8), rgba(0,92,161,0.8));
            background-size: 400% 400%;
            animation: gradient-bg 10s ease infinite;
            overflow: hidden;
        }
        @keyframes gradient-bg {
            0% {
                background-position: 0% 50%;
            }
            25% {
                background-position: 50% 0%;
            }
            50% {
                background-position: 100% 50%;
            }
            75% {
                background-position: 50% 100%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        .position-absolute {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
        h1 {
            color: #fff;
            font-size: 3rem;
            font-weight: bold;
            animation: move 5s linear infinite;
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.8);
        }
        @keyframes move {
            50% {
                transform: translate(-50%, -50%) translateX(100%);
            }
        }
    </style>
</head>
<body>
    <div class="position-absolute top-50 start-50 translate-middle">
        <h1 class="mt-4">Halaman Tidak Ditemukan</h1>
    </div>
</body>
</html>
