@extends('layouts.app')

@section('header')
    Farms
@endsection

@section('othercss')
    <link rel="stylesheet" href="{{ asset('library/leaflet/leaflet.css') }}" />
@endsection

@section('otherjs')
    <script src="{{ asset('library/leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('js/farmController.js') }}"></script>
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
                    </svg><a href="#"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-primary md:ml-2 dark:text-gray-400 dark:hover:text-white">Farm
                        Management</a></div>
            </li>
        </ol>
    </nav>
    <div class="flex flex-col md:flex-row w-full h-fit mt-2 justify-between gap-4">
        <input class="py-2 px-6 border-[2px] rounded-lg outline-none w-full md:flex-1 md:max-w-[400px]"
            placeholder="Search..." type="text">
        <div class="flex flex-row gap-2 cursor-default mt-4 md:mt-0">
            <div class="bg-red-500 hover:bg-red-600 px-3 py-2 text-white rounded-md items-center justify-center">
                <p>Hapus</p>
            </div><a
                class="bg-green-500 hover:bg-green-600 px-3 py-2 text-white rounded-md items-center justify-center"
                href="#">Tambah</a>
        </div>
    </div>

    

    <div class="w-full h-full flex flex-col bg-white flex-grow mt-8 min-h-[400px] rounded-lg px-6 py-4 border-[2px] overflow-x-auto"
        style="opacity: 1;">
        <table class="border-separate border-spacing-y-3">
            <thead>
                <tr>
                    <th class="px-4 py-4 text-center">
                        <div class=""><input class="h-4 w-4" type="checkbox" id="" name=""></div>
                    </th>
                    <th class="px-4 py-4 text-left">Nama</th>
                    <th class="px-4 py-4 text-left">Alamat</th>
                    <th class="px-4 py-4 text-left">Kecamatan</th>
                    <th class="px-4 py-4 text-left">Kota</th>
                    <th class="px-4 py-4 text-left">Luas</th>
                    <th class="px-4 py-4 text-left">Warna</th>
                    <th class="px-4 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-gray-100 rounded-xl">
                <tr style="opacity: 1; transform: none;">
                    <td class="px-4 w-16 text-center">
                        <div class=""><input class="h-4 w-4" type="checkbox" id="" name=""></div>
                    </td>
                    <td class="text-left px-4">Kebun Teh</td>
                    <td class="text-left px-4">Jln Letjend Mastrip No 20 Gg 21</td>
                    <td class="text-left px-4">Sumbersari</td>
                    <td class="text-left px-4">Jember3</td>
                    <td class="text-left px-4">50M2</td>
                    <td class="text-left px-4">Hijau</td>
                    <td class="px-4 py-2 flex items-center justify-center">
                        <div class="flex flex-row gap-2">
                            <div class="flex bg-orange-400 px-3 py-3 rounded-md"><svg stroke="currentColor"
                                    fill="currentColor" stroke-width="0" viewBox="0 0 24 24" color="white"
                                    style="color:white" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                    <path
                                        d="M14 19.88V22h2.12l5.17-5.17-2.12-2.12zM20 8l-6-6H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H12v-2.95l8-8V8zm-7 1V3.5L18.5 9H13zM22.71 14l-.71-.71a.996.996 0 00-1.41 0l-.71.71L22 16.12l.71-.71a.996.996 0 000-1.41z">
                                    </path>
                                </svg></div>
                            <div class="flex bg-red-600 px-3 py-3 rounded-md"><svg stroke="currentColor" fill="currentColor"
                                    stroke-width="0" viewBox="0 0 24 24" color="white" style="color:white" height="1em"
                                    width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                    <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z">
                                    </path>
                                </svg></div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <h1 class="font-poppins-semibold py-3 mt-7">Tampilan Kebun pada Peta</h1>

    <div class="w-full h-[600px] flex flex-col bg-white rounded-lg px-6 py-4 border-[2px] overflow-x-auto"
        style="opacity: 1;">
        <div class="h-full" id="map"></div>
    </div>
@endsection
