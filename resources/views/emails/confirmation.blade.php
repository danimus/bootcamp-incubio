<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Reestablecer la contraseña</h2>

        <div>
            Puedes confirmar tu mail a través de esta dirrección:

            {{ URL::to('#/user-confirmation/?token=' .$token) }}.<br/>

            Equipo MediaTweet.

        </div>

    </body>
</html>