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
            <p>Insert your Email Address</p>
            <form id="forgot">
                <div class="mb-3 w-75">
                    <div class="input-field">
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email" >
                        <button id="mailbtn" class="btn btn-primary custom-btn">Verify</button>
                    </div>
                </div>
                <div class="mb-3 w-75" id="otpField" style="display: none;">
                    <div class="input-field">
                        <input type="text" class="form-control" id="otp" placeholder="OTP" >
                    </div>
                </div>
                <p class="mb-3"> Want to Sign in? <a href="login">Click Here!</a> </p>
                <div class="submit-container mb-5" id="confirm" style="display: none;">
                    <button id="otpbtn" class="btn btn-primary custom-btn">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</section>
</body>
<script>
    const email = document.getElementById('email')
    const otp = document.getElementById('otp');
    const confirmBtn = document.getElementById('confirm');
    document.getElementById('mailbtn').addEventListener('click', async (e) => {
        e.preventDefault();
        if (email.value === '') {
            alert('Please fill in all fields');
            return;
        }

        fetch('/api/auth/user/forgot-password', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                email: email.value,
            })
        })
            .then(response => response.json())
            .then((data) => {
                console.log(data);
                confirmBtn.style.display = 'block';
                otpField.style.display = 'block';
            })
            .catch((err) => {
                alert('thau');
            })
    });

    document.getElementById('otpbtn').addEventListener('click', async (e) => {
        e.preventDefault();
        if (otp.value === ''){
            alert('Please fill in all fields');
            return;
        }
        fetch('/api/auth/user/validate-otp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                email: email.value,
                otp: otp.value,
            })
        })
            .then(response => response.json())
            .then((data) => {
                if (data.status === 'success') {
                    alert('OTP validated successfully');
                    window.location.href = "resetpassword?token=" + data.authorisation.token;
                } else {
                    alert('Invalid OTP');
                }
            })
            .catch((err) => {
                alert('An error occurred. Please try again');
            })
    });
</script>
</html>
