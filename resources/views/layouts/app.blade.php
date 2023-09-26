<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Favicon -->
    <link href="{{ asset('images/favicon.png') }}" rel=" shortcut icon">
    <title>
        @hasSection('header')
            @yield('header') |
        @endif PDP Jember
    </title>
    @notifyCss
    @yield('othercss')
    @vite(['resources/css/app.css'])
</head>

<body>
    <div class="z-[999] fixed">
        @include('notify::components.notify')
    </div>
<body class="" onload="@yield('onstart')">
    @include('sweetalert::alert')
    {{-- Sidebar --}}
    @include('components.sidebar')
    {{-- End sidebar --}}
    

    <div id="loading"
        class="fixed w-full h-full top-0 left-0 flex flex-col justify-center items-center bg-slate-50 dark:bg-slate-700 z-[99999]">
        <div class="loadingspinner"></div>
    </div>

    {{-- Modal --}}
    <div class="z-[999] fixed">
        @yield('modal')
    </div>
    {{-- End Modal --}}

    <div class="flex flex-col w-full md:pl-[320px] lg:pl-[290px] min-h-screen duration-300 ease-in-out">
        @include('components.header')

        <div class="h-fit flex-grow flex flex-col py-4 px-6 md:px-12 bg-gray-100 dark:bg-slate-600">
            @yield('content')
        </div>
    </div>
    @notifyJs
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    @yield('otherjs')
</body>

</html>
