<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Register</title>
    <style>
        body {
            margin: 0; padding: 0;
            background: linear-gradient(to right, #e0f7fa, #fce4ec);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex; align-items: center; justify-content: center;
            min-height: 100vh;
        }
        .card {
            background: white;
            margin-top: -200px;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            max-width: 400px; width: 100%;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 28px;
        }
        input {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 15px;
            border-radius: 30px;
            border: 1px solid #ccc;
            font-size: 16px;
            box-sizing: border-box;
        }
        button {
            background-color: #1976d2;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }
        button:hover {
            background-color: #115293;
        }
        a {
            display: block;
            margin-top: 15px;
            color: #1976d2;
            text-decoration: none;
            font-weight: 600;
        }
        a:hover {
            text-decoration: underline;
        }
        .error {
            color: #e53935;
            margin-bottom: 15px;
            font-weight: 600;
            text-align: left;
        }
    </style>
</head>
<body>

    <div class="card">
        <h2>Register</h2>

        @if ($errors->any())
            <div class="error">
                <ul style="padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required />
            <input type="text" name="phone"  value="{{ old('phone') }}" placeholder="eg +9779812345678" required />
            <input type="password" name="password" placeholder="Password" required />
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required />
            <button type="submit">Register</button>
        </form>

        
    </div>

</body>
</html>
