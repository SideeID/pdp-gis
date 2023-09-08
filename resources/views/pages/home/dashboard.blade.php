@extends('layouts.app')

@section('header')
    Dashboard
@endsection

@section('othercss')
    <link rel="stylesheet" href="{{ asset('library/leaflet/leaflet.css') }}" />
    <link rel="stylesheet" href="{{ asset('library/leaflet/leaflet-fullscreen.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-label@0.2.1-0/dist/leaflet.label.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-draw@1.0.4/dist/leaflet.draw.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/css/bootstrap-colorpicker.min.css"
        integrity="sha512-m/uSzCYYP5f55d4nUi9mnY9m49I8T+GUEe4OQd3fYTpFU9CIaPazUG/f8yUkY0EWlXBJnpsA7IToT2ljMgB87Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('otherjs')
    <script src="{{ asset('library/leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('library/leaflet/leaflet-fullscreen.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet-label@0.2.1-0/dist/leaflet.label.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet-draw@1.0.4/dist/leaflet.draw.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/js/bootstrap-colorpicker.min.js"
        integrity="sha512-94dgCw8xWrVcgkmOc2fwKjO4dqy/X3q7IjFru6MHJKeaAzCvhkVtOS6S+co+RbcZvvPBngLzuVMApmxkuWZGwQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/homeController.js') }}"></script>
@endsection

@section('modal')
@endsection

@section('onstart')
    setDataMap({{ json_encode($data) }}, {{ $kebun }})
@endsection

@section('content')
    <nav class="flex mt-0 overflow-x-auto py-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="#"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z">
                        </path>
                    </svg>Menu</a>
            </li>
            <li>
                <div class="flex items-center"><svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4"></path>
                    </svg><a href="{{ route('home') }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-primary md:ml-2 dark:text-gray-400 dark:hover:text-white">Dashboard</a>
                </div>
            </li>
        </ol>
    </nav>
    <div class="flex flex-col md:flex-row w-full h-fit mt-2 justify-between gap-4">

    </div>



    <div class="w-full h-full flex flex-col bg-white dark:bg-slate-700 dark:border-gray-500 duration-300 ease-in-out flex-grow mt-2 min-h-[400px] rounded-lg border-[2px] overflow-x-auto"
        style="opacity: 1;">
        <div class="h-full rounded-lg w-full flex flex-1" id="container_map"></div>

    </div>
    <div class="mt-4 flex  flex-col justify-center md:flex-row md:justify-between gap-2 py-2 items-center">

    </div>
@endsection
