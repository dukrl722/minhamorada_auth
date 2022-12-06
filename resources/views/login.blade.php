<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Entrar</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            height: 100vh;
        }

        form {
            max-width: 300px;
            background: #a0aec0;
            border-radius: 8px;
            margin: auto;
            display: flex;
            flex-direction: column;
            padding: 15px;
        }

        button {
            padding: 5px 10px;
            margin: 5px 0;
        }

        .inputLogin {
            display: flex;
            flex-direction: column;
        }

        .inputLogin > label {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body class="antialiased">
<div>
    <form action="{{route('login')}} method=post">
        <div class="inputLogin">
            <label>
                Email
                <input name="email" />
            </label>
            <label>
                Password
                <input name="password" type="password" />
            </label>
        </div>
        <button type="submit">Entrar</button>
        <a href="{{route('signup')}}">Esqueceu sua senha?</a>
    </form>
</div>
</body>
</html>
