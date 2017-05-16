<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/application/assets/css/main.css">
</head>
<body>

<div class="row">
    <div class="col-md-offset-4 col-md-4">
        <h1 class="text-uppercase centered-text">feedback form</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-5">
        <form action="/main/sendFeedbackMessage" method="post" class="form-horizontal">

            <div class="form-group">
                <label for="userName" class="col-md-2 control-label">Name</label>
                <div class="col-md-10">
                    <input type="email" class="form-control" id="userName" placeholder="Input your name ...">
                </div>
            </div>

            <div class="form-group">
                <label for="userEmail" class="col-md-2 control-label">Email</label>
                <div class="col-md-10">
                    <input type="password" class="form-control" id="userEmail" placeholder="Input your email ...">
                </div>
            </div>

            <div class="form-group">
                <label for="userHomepage" class="col-md-2 control-label">Homepage</label>
                <div class="col-md-10">
                    <input type="password" class="form-control" id="userHomepage" placeholder="Input your homepage ...">
                </div>
            </div>

            <div class="form-group">
                <label for="userText" class="col-md-2 control-label">Message</label>
                <div class="col-md-10">
                    <input type="password" class="form-control" id="userText" placeholder="Input your message ...">
                </div>
            </div>

            <div class="form-group">
                <label for="userCaptcha" class="col-md-5 control-label">
                    <img class="captcha" src="<?= $captchaPatch ?>" alt="">
                </label>
                <div class="col-md-7">
                    <input type="password" class="form-control" id="userCaptcha" placeholder="Input captcha ...">
                </div>
            </div>

            <div class="col-md-offset-4 col-md-6">
                <button type="submit" class="btn btn-default center-block">Send message</button>
            </div>

        </form>
    </div>
    <div class="col-md-3"></div>
</div>
</body>
</html>