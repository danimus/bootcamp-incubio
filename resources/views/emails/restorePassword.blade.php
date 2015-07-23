<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Restore your password</h2>

        <div>
            To change your password, click the link below or copy and paste it into your browser.

            {{ URL::to('/#/restore/?token=' .$token) }}.<br/>

            If you did not request to have your password reset, no further action is necessary, but if you have any questions or need further assistance, please contact us at mediatweet.incubio@gmail.com.


            MediaTweet team.

        </div>

    </body>
</html>