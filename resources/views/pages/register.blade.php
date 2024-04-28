<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('pages.layout.head')
</head>
<body>
<section class="d-flex justify-content-center align-items-center vh-100">
    <div class="container input-container d-flex justify-content-center align-items-center">
        <div class="card d-flex justify-content-center align-items-center" style="box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35); width: 40rem;">
            <h1 class="mb-3 mt-5">Sign Up</h1>
            <form>
                <div class="mb-3 w-75">
                    <div class="input-field">
                        <input type="username" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Username">
                    </div>
                </div>
                <div class="mb-3 w-75">
                    <div class="input-field">
                        <input type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                </div>
                <div class="mb-3 w-75">
                    <div class="input-field">
                        <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                </div>
                <p class="mb-3"> Have an account? <a href="login">Click Here!</a> </p>
                <div class="submit-container mb-5 ">
                    <button type="signup" class="btn btn-primary custom-btn">Sign Up</button>
                </div>
            </form>
        </div>
    </div>
</section>
</body>
</html>
