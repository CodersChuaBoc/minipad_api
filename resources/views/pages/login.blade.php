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
            <h1 class="mb-3 mt-5">Sign In</h1>
            <form>
                <a href="*" class="btn"><button class="btn  btn-outline-secondary d-flex justify-content-center align-content:center custom-btn">
                        <img src={{ asset('svg/gugu.svg') }} alt="google" width="20px" height="20px">
                        <span> Continue With Google </span></button></a>
                <p> or</p>
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
                <p class="mb-3"> Lost password? <a href="register">Click Here!</a> </p>
                <div class="submit-container mb-5 ">
                <a href="register" type="button" class="btn btn-outline-primary custom-btn">Sign Up</a>
                <button type="login" class="btn btn-primary custom-btn">Log In</button>
                </div>
            </form>
            </div>
        </div>
    </section>
</body>
</html>
