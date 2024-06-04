<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ForgetPassword</title>
    @include('pages.layout.head')
</head>
<body>
<section class="d-flex justify-content-center align-items-center vh-100">
    <div class="container input-container d-flex justify-content-center align-items-center">
        <div class="card d-flex justify-content-center align-items-center" style="box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35); width: 40rem;">
            <h1 class="mb-4 mt-5">Forget Password?</h1>
            <p>Insert your new password</p>
                <form id="forgot">
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
                    <div class="submit-container mb-5" id="confirm">
                        <button id="submit" class="btn btn-primary custom-btn">Confirm</button>
                    </div>
            </form>
        </div>
    </div>
</section>
</body>
<script>
    const password = document.getElementById('password');
    const rePassword = document.getElementById('re-password');
    document.getElementById('submit').addEventListener('click', async (e) => {
        e.preventDefault();
        if (password.value === '' || rePassword.value === '') {
            alert('Please fill in all fields');
            return;
        }
        if (password.value !== rePassword.value) {
            alert('Passwords do not match');
            return;
        }
        const params = new Proxy(new URLSearchParams(window.location.search), {
            get: (searchParams, prop) => searchParams.get(prop),
        });
        // Get the value of "some_key" in eg "https://example.com/?some_key=some_value"
        let token = params.token // "some_value"
        fetch('/api/auth/user/reset-password', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                "Authorization": "Bearer " + token
            },
            body: JSON.stringify({
                password: password.value,
            })
        })
            .then(response => response.json())
            .then((data) => {
                console.log(data);
                if(data.status === 'success') {
                    alert(data.message);
                }})
            .catch((err) => {
                console.log(err);
                alert('An error occurred. Please try again');
            })
    });
</script>
</html>
