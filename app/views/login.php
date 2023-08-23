<?php echo '<meta name="viewport" content="width=device-width, initial-scale=0.8, maximum-scale=0.8, user-scalable=no"><div class="container">
    <html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content>
<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
<meta name="generator" content="Hugo 0.88.1">
<title>ANYMOD - Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        html,
body {
  height: 100%;
}

body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
.btn-group-lg>.btn, .btn-lg {
    padding: 0.5rem 1rem;
    font-size: 1.25rem;
    border-radius: 20px;
}
    </style>
</head>
<body class="text-center">
<main class="form-signin">
<form action="?page=login" method="POST">
                <input name="form_login" type="hidden" value="LOGIN">
<img class="mb-4" src="https://i.ibb.co/CPK7k3f/oie-Xigk08og-Yaf-F.png" alt width="80" height="80">
<h1 class="h3 mb-3 fw-normal">Painel ANYMOD</h1>
<div class="form-floating mb-3">
<input class="form-control"  name="user" id="username" value="" placeholder="Usuário" required type="text" value>
<label class="form-label" for="username_login" placeholder="Nome de usuario">Nome de usuario</label>
</div>
<div class="form-floating">
<input class="form-control" type="password" name="pass" id="password" value="" placeholder="Senha" required>
<label class="form-label" for="pwd_login" placeholder="Senha" type="password">Senha</label>
</div>
<div class="form-group mb-3">
</div>
<input class="w-100 btn btn-lg btn-primary btn-block" id="submit" name="submit" type="submit" value="Entrar">
</form>
</main>
</body>
</html>
		';;