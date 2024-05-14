<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:wght@300;400;500;700&display=swap">
    <style>
        .main {
            /* float: left;
          width:calc(100%-100px);
          padding: 0px 50px;

            width:50%; margin-left:25%;margin-bottom:50px; */
            margin-bottom: 0.25rem;
            display: block;
            /* font-size: .875rem; */
            line-height: 1.25rem;
            font-weight: 500;
            --tw-text-opacity: 1;
            color: rgb(55 65 81 / var(--tw-text-opacity));
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Roboto', sans-serif;
            font-weight: bold;
            font-size: 12px;

        }

        .register {
            /* font-size: 3rem;  */
            text-align: center;
            margin-bottom: 30px;
            margin-top: 15px;
        }

        /* .center{
            text-align:center;
        } */
        .form-control {
            /* font-size: .875rem;
          line-height: 2.5rem; */
            width: 274px;
            border: 0.5px solid #D3D3D3;
            /* margin-bottom: 10px;
          margin-top:10px; */
            margin: 10px 0px;

            /* font-family: Arial bold ; */
            /* font-size: 12px; Set font size to 12px*/
            /* padding: 5px 10px; */
            padding-left: 10px;

        }

        .form-control:focus {
            border-color: blue;
            outline: none;
        }

        .submitregister {
            color: white;

            /* width:220px; */
            /* font-size: .875rem;
        line-height: 2.5rem; */
            background: white;
            width: 288px;
            margin: 15px 0px;
            border: 0.5px solid #1E90FF;
            background: blue;
            font-size: 15px;
            font-weight: bold;

            /* font-family:  arial bold; */
            /* font-family: 'monserat'; */
            /* font-size:17px; */
            /* margin:5px; */
        }

        .submitregister:hover {
            opacity: 0.5;
            filter: alpha(opacity=50);
            border-color: blue;
        }

        .login {
            color: red;
            margin-left: 10px;
        }


        .form-control:focus {
            border-color: blue;
            outline: none;
        }

        .border {
            border-radius: 5px;
            font-size: .875rem;
            line-height: 2.5rem;
        }

        .margin {
            margin-left: 10px;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #D3D3D3;
            border-radius: 5px;
            width: 300px;
            margin: 0 auto;
            background: #fff;

            /* font-family: Arial bold ; */

            /* font-size:15px; */

        }

        .google-logo {
            position: relative;
            width: 12px;
            height: 12px;
            padding: 0;
            border-top: 5px solid #ea4335;
            border-right: 5px solid #4285f4;
            border-bottom: 5px solid #34a853;
            border-left: 5px solid #fbbc05;
            border-radius: 50%;
            background-color: white;
            /* để trùng màu nền*/
            margin-left: 15px;
            margin-right: 25px;
        }

        .google-logo::before {
            content: "";
            /* z-index: 100; */
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 10px;
            height: 4.5px;
            background-color: #4285f4;
            right: -4.5px;
        }

        .google-logo::after {
            content: "";
            position: absolute;
            top: -5px;
            right: -5px;
            width: 0;
            height: 0;
            border-top: 10px solid transparent;
            border-right: 12px solid white;
            /* để trùng màu nền*/
        }

        .btnloginwgg {
            /* font-size: .875rem;
        line-height: 2.5rem; */
            width: 288px;
            border: 0.5px solid #D3D3D3;
            background: white;
            /* margin-bottom: 2px; */
            display: flex;
            align-items: center;
            /* font-family: bold arial; */
            font-size: 15px;
            /* font-family:  arial bold; */
            font-weight: bold;
            margin-left: 10px;
        }

        .btnloginwgg:hover {
            opacity: 0.5;
            filter: alpha(opacity=50);
            border-color: blue;
        }

        hr {
            /* margin-left: 10px;
         margin-right:10px;
         margin-top: -5px;
        margin-bottom: 15px; */
            margin: 5px 3.5px 10px 10px;
        }

        .showpw {
            /* font-size:17px; */
            margin-left: 0.5px;
            font-weight: normal;

        }

        h2 {
            font-size: 30px;
        }

        .btn {
            text-decoration: none;
        }

        input::placeholder {
            font-size: 12px;

        }

        .form-email,
        .form-pass {
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <div class ="main">
        <div class="form-container">
            <h2 class="register">Đăng ký</h2>
            <!-- <div class="google-logo"></div> -->
            <a href="xlloginwgg.php" class="btn"><button class="btnloginwgg border">
                    <div class="google-logo"></div> Đăng nhập với Google
                </button> <br></a>
            <hr>
            <form id="register">
                <div class="form-email">
                    <label class="email ">Email:</label> <br>
                    <input type="text" name="email" class="form-control border " id="email"
                        placeholder="Nhập email">
                    <input type="text" name="name" class="form-control border " id="name"
                        placeholder="Nhập tên">
                </div>
                <div class="form-pass">
                    <label class="pw">Mật khẩu:</label> <br>
                    <input type="password" name="matkhau" class="form-control border" id="password"
                        placeholder="Mật khẩu"><br>
                    <input type="password" name="nhaplaimatkhau" class="form-control border" id="repassword"
                        placeholder="Nhập lại mật khẩu"><br>
                    <input type="checkbox" name="showpw" class="showpw"> Hiển thị mật khẩu <br>
                    <button type="submit" class="form-control border submitregister">Đăng ký</button>
                </div>


                <div><a href={{ route('login') }} class="login">Bạn đã có tài khoản?</a></div>
            </form>
        </div>
    </div>
    <script>
        const email = document.getElementById('email');
        const name = document.getElementById('name');
        const password = document.getElementById('password');
        const rePassword = document.getElementById('repassword');
        const showPasswordCheckbox = document.querySelector('.showpw');

        showPasswordCheckbox.addEventListener('change', function() {
            if (this.checked) {
                password.type = 'text';
                rePassword.type = 'text';
            } else {
                password.type = 'password';
                rePassword.type = 'password';
            }
        });

        document.getElementById('register').addEventListener('submit', async (e) => {
            e.preventDefault();
            if (email.value === '' || name.value === '' || password.value === '' || rePassword.value ===
                '') {
                alert('Please fill in all fields');
                return;
            }
            if (password.value !== rePassword.value) {
                alert('Passwords do not match');
                return;
            }
            fetch('/api/auth/user/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        email: email.value,
                        name: name.value,
                        password: password.value
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
