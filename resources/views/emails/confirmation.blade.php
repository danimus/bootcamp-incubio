<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Verify your e-mail</h2>

        <div>

            Welcome to MediaTweet,

            Please verify your e-mail address to activate your MediaTweet account.
            It's easy, just click on the link below:

            {{ URL::to('/#/user-confirmation/?token=' .$token) }}.<br/>

            Thank you,
            MediaTweet team.

        </div>

    </body>
</html>