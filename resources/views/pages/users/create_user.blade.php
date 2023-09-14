<script defer src="https://unpkg.com/alpinejs@3.2.3/dist/cdn.min.js"></script>

<div onclick="handleModal()" id="bg_modal"
    class="flex duration-500 w-full h-full bg-black opacity-0 fixed justify-center items-center pointer-events-none">
</div>

<form id="form_user" action="{{ route('user.create') }}" method="POST">
    @csrf
    <div class="flex flex-col w-full h-full justify-center items-center pointer-events-none fixed">
        <div id="konten_modal"
            class="flex scale-0 flex-col duration-500 ease-in-out w-[90%] lg:w-[500px] max-h-[90%] bg-white rounded-lg pointer-events-auto drop-shadow-lg overflow-hidden">
            <header>
                <div class="flex w-full h-fit flex-row justify-between px-6 lg:px-12 py-6 items-center border-b-2">
                    <h1 id="titleModal" class="font-poppins-semibold">Tambah Data</h1>
                    <div onclick="handleModal()" class="bg-[#ED3237] py-2 flex items-center px-2 rounded-md">
                        <svg width="11" height="11" viewBox="0 0 11 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.41089 10.6519L5.68762 6.92859L1.96436 10.6519L0.723267 9.41077L4.44653 5.6875L0.723267 1.96423L1.96436 0.723145L5.68762 4.44641L9.41089 0.723145L10.652 1.96423L6.92871 5.6875L10.652 9.41077L9.41089 10.6519Z"
                                fill="white" />
                        </svg>
                    </div>
                </div>
            </header>

            <div class="flex flex-col flex-grow w-full px-6 lg:px-12 mt-4 overflow-y-auto">
                <div class="grid grid-cols-1 h-full gap-4">
                    <!-- Input ID (Hidden) -->
                    <input maxlength="40"
                        class="w-full border-[2px] px-3 py-2 rounded-lg outline-primary" 
                        type="hidden"
                        name="id" 
                        id="id" 
                        placeholder="">
            
                    <!-- Input Nama -->
                    <div class="flex flex-col w-full">
                        <p class="py-3">Nama <span class="text-red-600">*</span></p>
                        <div class="">
                            <input maxlength="50"
                                class="w-full border-[2px] px-3 py-2 rounded-lg outline-primary" 
                                type="text"
                                name="nama" 
                                id="nama" 
                                placeholder="">
                        </div>
                    </div>
            
                    <!-- Input Email -->
                    <div class="flex flex-col w-full">
                        <p class="py-3">Email <span class="text-red-600">*</span></p>
                        <div class="">
                            <input maxlength="50"
                                class="w-full border-[2px] px-3 py-2 rounded-lg outline-primary" 
                                type="email"
                                name="email" 
                                id="email" 
                                placeholder="">
                        </div>
                    </div>

                    <div class="flex flex-col items-center">
                        <div id="showPasswordButton" onclick="showPassword();" class="flex flex-col">
                            Ubah Password?
                        </div>
                    </div>
                                
                    {{-- <!-- Input Password -->
                    <div id="password-container" class="flex flex-col w-full">
                        <p class="py-3">Password <span class="text-red-600">*</span></p>
                        <div class="">
                            <input maxlength="50"
                                class="w-full border-[2px] px-3 py-2 rounded-lg outline-primary" 
                                type="password"
                                name="password" 
                                id="password" 
                                placeholder="">
                        </div>
                    </div> --}}

                    <div id="password-container" class="flex flex-col w-full" x-data="{ show: true }">
                        <p class="py-3">Password <span class="text-red-600">*</span></p>
                        <div class="relative">
                            <input maxlength="50"
                                class="w-full border-[2px] px-3 py-2 rounded-lg outline-primary" 
                                type="password"
                                name="password" 
                                id="password" 
                                placeholder=""
                                :type="show ? 'password' : 'text'">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                    :class="{'hidden': !show, 'block': show }" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512">
                                    <path fill="currentColor"
                                        d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                    </path>
                                </svg>
                                <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                    :class="{'block': !show, 'hidden': show }" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 640 512">
                                    <path fill="currentColor"
                                        d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07a32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
            <div class="px-6 lg:px-12 py-8">
                <button onclick="handleData()" type="button"
                    class="flex bg-[#38D191] text-white w-full h-fit py-2 rounded-md items-center justify-center">
                    <p id="titleButton">Tambah Data</p>
                </button>
            </div>
        </div>
    </div>

</form>