<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>S</title>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{url('/')}}">Nova</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item {{!empty($uri) && $uri === 'home' ? 'active' : ''}}">
                        <a class="nav-link" href="{{url('/')}}">Schedule</a>
                    </li>
                    <li class="nav-item {{!empty($uri) &&  $uri === 'student' ? 'active' : ''}}">
                        <a class="nav-link" href="{{url('/students')}}">Students</a>
                    </li>
                    <li class="nav-item {{!empty($uri) && $uri  === 'teacher' ? 'active' : ''}}">
                        <a class="nav-link" href="{{url('/teachers')}}">Teachers</a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>

</header>

<div id="app">
    @yield('content')
</div>

<script src="{{asset('js/app.js')}}"></script>
@yield('scripts')
</body>
</html>
