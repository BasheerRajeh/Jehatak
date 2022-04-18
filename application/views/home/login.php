<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل دخول</title>
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/bootstrap.rtl.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/app.rtl.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/auth.css" />
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri&display=swap" rel="stylesheet">
</head>

<body>

    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="logo">
                        <a href="<?php echo URL; ?>"><img class="w-50 mb-5" src="<?php echo URL; ?>public/images/logo/logo.png" alt="Logo" srcset=""></a>
                    </div>
                    <h1 class="auth-title">تسجيل الدخول</h1>
                    <p class="auth-subtitle mb-5">أدخل بياناتك لتسجيل الدخول</p>

                    <form action="<?php echo URL; ?>home/useraction/login" method="POST" onsubmit="return validateSignIn();">
                        <div class="form-group position-relative has-icon-left mb-2">
                            <input type="email" id="email" name="email" class="form-control form-control-xl" placeholder="الإيميل">
                            <p class="error text-danger m-3"><?php if (isset($email_error)) echo $email_error; ?></p>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-2">
                            <input type="password" id="password" name="password" class="form-control form-control-xl" placeholder="كلمة المرور">
                            <p class="error text-danger m-3"><?php if (isset($password_error)) echo $password_error; ?></p>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2">تسجيل الدخول</button>
                    </form>

                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">هل تمتلك حساب؟<a href="<?php echo URL; ?>home/signup" class="font-bold"> أنشئ حسابك</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <img class="col-12 img-fluid" style="object-fit: fill; height: 100vh" src="<?php echo URL; ?>/public/images/bg/bg11.jpg" alt="background">
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo URL; ?>public/js/validate.js"></script>
</body>

</html>