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
            <form id='signup'>
                <div class="mb-3 w-75">
                    <div class="input-field">
                        <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                </div>
                <div class="mb-3 w-75">
                    <div class="input-field">
                        <input type="text" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Username">
                    </div>
                </div>
                <div class="mb-3 w-75">
                    <div class="input-field">
                        <input type="password" class="form-control" id="password" placeholder="Input your password">
                    </div>
                </div>
                <div class="mb-3 w-75">
                    <div class="input-field">
                        <input type="password" class="form-control" id="re-password" placeholder="Reinput your password">
                    </div>
                </div>
                <p class="mb-3"> Already have an account? <a href="login">Click here!</a> </p>
                <div class="submit-container mb-5 ">
                    <button type="signup" class="btn btn-primary custom-btn">Sign Up</button>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
    const email = document.getElementById('email');
    const username = document.getElementById('username');
    const password = document.getElementById('password');
    const rePassword = document.getElementById('re-password');

    document.getElementById('signup').addEventListener('submit', async (e) => {
        e.preventDefault();
        if (email.value === '' || username.value === '' || password.value === '' || rePassword.value === '') {
            alert('Please fill in all fields');
            return;
        }
        if (password.value !== rePassword.value) {
            alert('Passwords do not match');
            return;
        }
        fetch('/api/auth/user/validate-otp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                otp:otp.value,
            })
        })
        .then(response => response.json())
        .then(data => {
            sessionStorage.setItem("accessToken", JSON.stringify(data.authorisation));
            sessionStorage.setItem("User", JSON.stringify(data.user));
            window.location.replace('/')
        })
        .catch((error) => {
            alert('An error occurred. Please try again');
        });
    });
</script>
</body>
</html>
