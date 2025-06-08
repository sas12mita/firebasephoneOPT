<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #e0f7fa, #fce4ec);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .card {
            background: white;
            margin-top: -300px;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h1 {
            margin-bottom: 10px;
            color: #333;
            font-size: 28px;
        }

        p {
            color: #666;
            font-size: 16px;
            margin-bottom: 20px;
        }

        button {
            background-color: #e53935;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #c62828;
        }
    </style>
</head>
<body>

    <div class="card">
        <h1>Welcome, </h1>
        <p>You are logged in with <strong>.</p>

        {{-- <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form> --}}
    </div>

</body>
</html>
