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
    @yield('othercss')
    @vite(['resources/css/app.css'])
</head>

<body onload="@yield('onstart')">
    @include('sweetalert::alert')
    {{-- Sidebar --}}
    @include('components.sidebar')
    {{-- End sidebar --}}

    {{-- Modal --}}
    <div class="z-[999] fixed">
        @yield('modal')
    </div>
    {{-- End Modal --}}

    <div class="flex flex-col w-full md:pl-[320px] lg:pl-[290px] min-h-screen duration-300 ease-in-out">
        @include('components.header')

        <div class="h-fit flex-grow flex flex-col py-4 px-6 md:px-12 bg-gray-100">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    @yield('otherjs')
</body>

</html>
