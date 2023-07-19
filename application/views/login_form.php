<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Admin</title>

    <!-- Bootstrap core CSS-->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

    <div class="container" style="font-family: Futura® BT;">
        <div class="row">
            <div class="card shadow col-12 col-md-6 col-lg-4 text-center mt-5 mx-auto p-4">
                <div class="row">
                    <div class="text-center mx-auto px-4">
                        <img src="<?= base_url('assets/img/logohimsya.jpg'); ?>" style="width : 20%">
                        <h1 class="h3">Login PMR</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mx-auto mb-4">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="username" class="float-left">Username :</label>
                                <input type="text" class="form-control" name="username" placeholder="Username..." required />
                            </div>
                            <div class="form-group">
                                <label for="password" class="float-left">Password :</label>
                                <input type="password" class="form-control" name="password" placeholder="Password..." required />
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary w-100 mt-3" value="Login" />
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>