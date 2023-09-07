<div class="flex flex-col w-[80%] -translate-x-[400px]  md:translate-x-0 duration-500 ease-in-out max-w-[400px] md:w-[320px] lg:w-[290px] h-full bg-white border-r-[1px] border-r-[#DCDADA] box-border fixed z-[100] pb-10 2xl:pb-10 overflow-y-auto md:scrollbar-hide"
    id="sidebar">
    <div class="flex flex-col w-full px-8 py-6 gap-3">
        <div class="h-16 w-16 bg-black rounded-full overflow-hidden">
            <img class="w-full h-full object-cover" src="{{ asset('images/logo.png') }}" alt="profile">
        </div>
        <div class="flex flex-row 2xl:flex-col justify-between items-center 2xl:items-start w-full gap-3">
            <div class="flex flex-col justify-center">
                <h3
                    class="text-[15px] md:text-[18px] text-gray-800 font-bold lg:text-[16px] w-full2xl:w-full whitespace-nowrap text-ellipsis overflow-hidden">
                    PDP Jember</h3>
                <p class="text-[#535353] text-sm">Admin</p>
            </div>
        </div>
    </div>
    <div class="flex flex-col px-4 gap-1 lg:mt-0 h-full">
        <h1 class="mt-4 text-sm ml-4 py-2">Menu</h1>
        <a class="flex flex-row justify-between h-fit py-2 cursor-pointer menu flex-none {{ Request::segment(1) == 'home' ? 'bg-primary text-white' : 'hover:bg-gray-200' }} px-4 rounded-md"
            href="{{ route('home') }}">
            <div class="flex flex-row items-center w-full">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="1em"
                    width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z">
                    </path>
                </svg>
                <p class="ml-5 poppins-medium text-[15px] md:text-[16px] lg:text-[15px] transition ease-in-out">
                    Dashboard</p>
            </div>
        </a>
        <a class="flex flex-row justify-between h-fit py-2 cursor-pointer menu flex-none hover:bg-gray-200 px-4 rounded-md"
            href="/dashboard">
            <div class="flex flex-row items-center w-full">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="1em"
                    width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z">
                    </path>
                </svg>
                <p class="ml-5 poppins-medium text-[15px] md:text-[16px] lg:text-[15px] transition ease-in-out">User
                    Management</p>
            </div>
        </a>
        <a class="flex flex-row justify-between h-fit py-2 cursor-pointer menu flex-none {{ Request::segment(1) == 'farm' ? 'bg-primary text-white' : 'hover:bg-gray-200' }} px-4 rounded-md"
            href="{{ route('farm') }}">
            <div class="flex flex-row items-center w-full"><svg stroke="currentColor" fill="currentColor"
                    stroke-width="0" viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.125 3C3.089 3 2.25 3.84 2.25 4.875V18a3 3 0 003 3h15a3 3 0 01-3-3V4.875C17.25 3.839 16.41 3 15.375 3H4.125zM12 9.75a.75.75 0 000 1.5h1.5a.75.75 0 000-1.5H12zm-.75-2.25a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5H12a.75.75 0 01-.75-.75zM6 12.75a.75.75 0 000 1.5h7.5a.75.75 0 000-1.5H6zm-.75 3.75a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5H6a.75.75 0 01-.75-.75zM6 6.75a.75.75 0 00-.75.75v3c0 .414.336.75.75.75h3a.75.75 0 00.75-.75v-3A.75.75 0 009 6.75H6z"
                        clip-rule="evenodd"></path>
                    <path d="M18.75 6.75h1.875c.621 0 1.125.504 1.125 1.125V18a1.5 1.5 0 01-3 0V6.75z"></path>
                </svg>
                <p class="ml-5 poppins-medium text-[15px] md:text-[16px] lg:text-[15px] transition ease-in-out">Farm
                    Management</p>
            </div>
        </a>

        <a class="flex flex-row justify-between h-fit py-2 cursor-pointer menu flex-none {{ Request::segment(1) == 'afdeling' ? 'bg-primary text-white' : 'hover:bg-gray-200' }} px-4 rounded-md"
            href="{{ route('afdeling') }}">
            <div class="flex flex-row items-center w-full">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="1em"
                    width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 1.5V13a1 1 0 0 0 1 1V1.5a.5.5 0 0 1 .5-.5H14a1 1 0 0 0-1-1H1.5A1.5 1.5 0 0 0 0 1.5z">
                    </path>
                    <path
                        d="M3.5 2A1.5 1.5 0 0 0 2 3.5v11A1.5 1.5 0 0 0 3.5 16h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 16 9.586V3.5A1.5 1.5 0 0 0 14.5 2h-11zm6 8.5a1 1 0 0 1 1-1h4.396a.25.25 0 0 1 .177.427l-5.146 5.146a.25.25 0 0 1-.427-.177V10.5z">
                    </path>
                </svg>
                <p class="ml-5 poppins-medium text-[15px] md:text-[16px] lg:text-[15px] transition ease-in-out">Afdeling
                    Management</p>
            </div>
        </a>

        <a class="flex flex-row justify-between h-fit py-2 cursor-pointer menu flex-none {{ Request::segment(1) == 'block' ? 'bg-primary text-white' : 'hover:bg-gray-200' }} px-4 rounded-md"
            href="/block">
            <div class="flex flex-row items-center w-full">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="1em"
                    width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z">
                    </path>
                </svg>
                <p class="ml-5 poppins-medium text-[15px] md:text-[16px] lg:text-[15px] transition ease-in-out">Block
                    Management</p>
            </div>
        </a>

        <h1 class="mt-4 text-sm ml-4 py-2">Lainnya</h1>
        <a class="flex flex-row justify-between h-fit py-2 cursor-pointer menu flex-none {{ Request::segment(1) == 'parameter' ? 'bg-primary text-white' : 'hover:bg-gray-200' }} px-4 rounded-md"
            href="{{ route('parameter') }}">
            <div class="flex flex-row items-center w-full">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="1em"
                    width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-3 2v.634l.549-.317a.5.5 0 1 1 .5.866L7 7l.549.317a.5.5 0 1 1-.5.866L6.5 7.866V8.5a.5.5 0 0 1-1 0v-.634l-.549.317a.5.5 0 1 1-.5-.866L5 7l-.549-.317a.5.5 0 0 1 .5-.866l.549.317V5.5a.5.5 0 1 1 1 0zm-2 4.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zm0 2h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z">
                    </path>
                </svg>
                <p class="ml-5 poppins-medium text-[15px] md:text-[16px] lg:text-[15px] transition ease-in-out">
                    Parameter</p>
            </div>
        </a>
        <a class="flex flex-row justify-between h-fit py-2 cursor-pointer menu flex-none {{ Request::segment(1) == 'perhitungan' ? 'bg-primary text-white' : 'hover:bg-gray-200' }} px-4 rounded-md"
            href="{{ route('perhitungan') }}">
            <div class="flex flex-row items-center w-full">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="1em"
                    width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2 .5v2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0-.5.5zm0 4v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zM4.5 9a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM4 12.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zM7.5 6a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM7 9.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm.5 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM10 6.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm.5 2.5a.5.5 0 0 0-.5.5v4a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-.5-.5h-1z">
                    </path>
                </svg>
                <p class="ml-5 poppins-medium text-[15px] md:text-[16px] lg:text-[15px] transition ease-in-out">
                    Perhitungan</p>
            </div>
        </a>
    </div>
</div>

<div onclick="handleSidebar()" id="bgsidebar"
    class="w-screen fixed h-screen flex bg-black z-[98] opacity-0 duration-500 ease-in-out pointer-events-none"></div>
