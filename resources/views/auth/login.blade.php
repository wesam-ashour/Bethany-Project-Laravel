<!doctype html>
<html @if(App::getLocale() == 'en') lang="en" dir="ltr" @else lang="ar" dir="rtl" @endif>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/login/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{asset('assets/login/css/owl.carousel.min.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/media/logos/logomain.jpeg')}}"/>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Style -->
    <link rel="stylesheet" href="{{asset('assets/login/css/style.css')}}">

    <title>Bethany</title>
</head>
<body>


<div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image:url({{url('assets/login/images/logomain1.jpeg')}}) "></div>
    <div class="contents order-2 order-md-1">

        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7">
                    <h3><strong>{{ __('login.Welcome') }}</strong></h3>
                    <p class="mb-4">{{ __('login.please') }}</p>
                    <form method="POST" action="{{ route('login') }}" class="form w-100" novalidate="novalidate" id="kt_sign_in_form" >
                        @csrf
                        @if ($errors->any())
                            <!--begin::Alert-->
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ __('login.Error') }}</strong><br>@foreach ($errors->all() as $error) {{ $error }}<br> @endforeach
                            </div>

                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="form-group first">
                            <label for="email">{{ __('login.Email') }}</label>
                            <input class="form-control" type="email" name="email" required>

                        </div>
                        <br>
                        <div class="form-group last mb-3">
                            <label for="password">{{ __('login.Password') }}</label>
                            <input type="password" class="form-control" name="password" required autocomplete="current-password">

                        </div>
                        <br>
                        <div class="d-grid gap-2 col-12.1 mx-auto">

                        <button type="submit" class="btn btn-primary" style="background-color:deepskyblue">{{ __('login.Login') }}</button>
                        </div>
                    </form>
                    <br>
                    <br>
                    <div align="center">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" hreflang="{{ $localeCode }}" class="text-muted text-hover-primary px-2" >{{ $properties['native'] }}</a>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>



<script src="{{asset('assets/login/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('assets/login/js/popper.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="{{asset('assets/login/js/main.js')}}"></script>
</body>
</html>
