<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sign Up</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
<div>
    <form>
        <div class="inputSignUp">
            <label>
                Email
                <input name="mail" />
            </label>
            <label>
                Senha
                <input name="password" type="password" />
            </label>
            <label>
                Confirme sua senha
                <input name="confirm_password" type="password" />
            </label>
            <div class="location">
                <label>
                    Digite seu CEP
                    <input name="cep" />
                </label>
                <div>
                    <label>
                        Rua:
                        <input name="street" />
                    </label>
                    <label>
                        Bairro:
                        <input name="district" />
                    </label>
                    <label>
                        Número:
                        <input name="number" />
                    </label>
                </div>
                <div>
                    <label>
                        Cidade:
                        <input name="city" />
                    </label>
                    <label>
                        Estado:
                        <input name="state" />
                    </label>
                </div>
            </div>
        </div>
        <button type="submit">Cadastrar</button>
    </form>
</div>
</body>
</html>
