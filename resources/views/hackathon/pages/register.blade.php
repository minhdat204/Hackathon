<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('/css/login/login.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/message/errorMessage.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/login/loading.css') }}" rel="stylesheet" />
    <title>Đăng ký</title>
</head>

<body>

    <section style="flex-direction: column;" id='section'>
        <!--message err-->
        @if ($errors->any())
            <div class="error">
                <div class="error__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24" fill="none">
                        <path fill="#393a37"
                            d="m13 13h-2v-6h2zm0 4h-2v-2h2zm-1-15c-1.3132 0-2.61358.25866-3.82683.7612-1.21326.50255-2.31565 1.23915-3.24424 2.16773-1.87536 1.87537-2.92893 4.41891-2.92893 7.07107 0 2.6522 1.05357 5.1957 2.92893 7.0711.92859.9286 2.03098 1.6651 3.24424 2.1677 1.21325.5025 2.51363.7612 3.82683.7612 2.6522 0 5.1957-1.0536 7.0711-2.9289 1.8753-1.8754 2.9289-4.4189 2.9289-7.0711 0-1.3132-.2587-2.61358-.7612-3.82683-.5026-1.21326-1.2391-2.31565-2.1677-3.24424-.9286-.92858-2.031-1.66518-3.2443-2.16773-1.2132-.50254-2.5136-.7612-3.8268-.7612z">
                        </path>
                    </svg>
                </div>
                <div class="error__title">{{ $errors->first() }}</div>
                <div class="error__close"><svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20"
                        height="20">
                        <path fill="#393a37"
                            d="m15.8333 5.34166-1.175-1.175-4.6583 4.65834-4.65833-4.65834-1.175 1.175 4.65833 4.65834-4.65833 4.6583 1.175 1.175 4.65833-4.6583 4.6583 4.6583 1.175-1.175-4.6583-4.6583z">
                        </path>
                    </svg>
                </div>
            </div>
        @endif
        <!--register form-->
        <div class="form-box">
            <form id="register-form" action="{{ route('register') }}" method="POST" novalidate>
                <div class="form-value">
                    @csrf
                    <h2>ĐĂNG KÝ</h2>
                    <!--username field-->
                    <div class="inputbox">
                        <span class="error-message" id="username-error"></span>
                        <ion-icon name="person-outline"></ion-icon>
                        <input type="text" required placeholder=" " id="username" name="username">
                        <label for="username">Username</label>
                    </div>
                    <!--password field-->
                    <div class="inputbox">
                        <span class="error-message" id="password-error"></span>
                        <input type="password" required placeholder=" " id="password" name="password">
                        <label for="password">Password</label>
                        <span class="eye" onclick="togglePassword()">
                            <ion-icon id="eye-icon" name="eye-off-outline"></ion-icon>
                        </span>
                    </div>
                    <!--confirm password field-->
                    <div class="inputbox">
                        <span class="error-message" id="password_confirmation-error"></span>
                        <input type="password" required placeholder=" " id="password_confirmation" name="password_confirmation">
                        <label for="password_confirmation">Confirm Password</label>
                        <span class="eye" onclick="toggleConfirmPassword()">
                            <ion-icon id="eye-icon-confirm" name="eye-off-outline"></ion-icon>
                        </span>
                    </div>
                    <!--name field-->
                    <div class="inputbox">
                        <span class="error-message" id="name-error"></span>
                        <ion-icon name="id-card-outline"></ion-icon>
                        <input type="text" required placeholder=" " id="name" name="name">
                        <label for="name">Name</label>
                    </div>
                    <!--birthday field-->
                    <div class="inputbox">
                        <span class="error-message" id="bridthday-error"></span>
                        <input style="width: 112%;" type="date" placeholder=" " id="bridthday" name="bridthday">
                        <label for="bridthday">Birthday</label>
                    </div>
                    {{-- <!--image url field-->
                    <div class="inputbox">
                        <span class="error-message" id="img-error"></span>
                        <input type="text" placeholder=" " id="img" name="img">
                        <label for="img">Image URL</label>
                    </div> --}}
                </div>
                <!--submit button-->
                <button type="submit">Đăng ký</button>
            </form>
        </div>
    </section>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="{{ asset('/js/login/closeError.js') }}"></script>
    <script src="{{ asset('/js/login/register.js') }}"></script>

</body>

</html>
