<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Reestablecer la contraseña</h2>

        <div>
            Puedes reestablecer tu contraseña con la siguiente dirección, también puedes copiarla y pegarla en la barra de dirección de tu navegador.

            {{ URL::to('api/v1/user/restore/' . csrf_token()) }}.<br/>

            Equipo MediaTweet.

        </div>

    </body>
</html>