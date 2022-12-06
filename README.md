## Minha Morada - Backend

--------------------------------------------
Desenvolvimento das autenticações de usuário, tendo as seguintes funcionalidades:
<ul>
    <li>Login</li>
    <li>Logout</li>
    <li>Cadastro</li>
    <li>Reset de senha</li>
    <li>Listagem de usuários</li>
    <li>Busca de CEP</li>
</ul>

O banco escolhido para receber as migrations foi o Postgres

--------------------------------------------
As rotas e seus parâmetros são as seguintes:

**Login** </br>
<code>/api/login</code> - <code>[email, password]</code> <br/>

**Logout** </br>
<code>/api/logout</code>

**Cadastro** </br>
<code>/api/newUser</code> - <code>[email, password, name, cep, street, number, district, city, state]</code>

**CEP** </br>
<code>/api/cep</code> - <code>[cep]</code>

**Cadastro** </br>
<code>/api/newUser</code> - <code>[email, password, name, cep, street, number, district, city, state]</code>

**Solicitar nova senha** </br>
<code>/api/recover</code> - <code>[email]</code>

**Cadastrar nova senha**</br>
<code>/api/password/reset</code> - <code>[email, password, token]</code>

**Listagem de usuários**</br>
<code>/api/users</code>
