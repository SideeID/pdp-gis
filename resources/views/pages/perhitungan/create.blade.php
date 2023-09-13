<div onclick="handleModal()" id="bg_modal"
    class="flex duration-500 w-full h-full bg-black opacity-0 fixed justify-center items-center pointer-events-none">
</div>

<form id="form_perhitungan" action="{{ route('perhitungan.create') }}" method="POST">
    @csrf
    <div class="flex flex-col w-full h-full justify-center items-center pointer-events-none fixed">
        <div id="konten_modal"
            class="flex scale-0 flex-col duration-500 ease-in-out w-[90%] lg:w-[1000px] max-h-[90%] bg-white rounded-lg pointer-events-auto drop-shadow-lg overflow-hidden">
            <header>
                <div
                    class="flex w-full h-fit flex-row justify-between px-6 lg:px-12 py-6 items-center border-b-2 dark:border-b-gray-600">
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
                    <input maxlength="40" class="w-full border-[2px] px-3 py-2 rounded-lg outline-primary"
                        type="hidden" name="id" id="id" placeholder="">

                    <div class="flex flex-col w-full">
                        <p class="py-3">Nama Kebun <span class="text-red-600">*</span></p>
                        <div class="relative">
                            <select key="kebun" onchange="pilihKebun({{ $kebun }})" maxlength="40"
                                class="w-full border-[2px] px-3 py-2 rounded-lg outline-primary appearance-none bg-transparent pr-10"
                                type="text" name="kebun" id="kebun" placeholder="">
                                <option disabled selected value=""></option>
                                @foreach ($kebun as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <svg class="absolute  flex h-full top-0 right-0 mr-4" stroke="currentColor"
                                fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1em"
                                width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M840.4 300H183.6c-19.7 0-30.7 20.8-18.5 35l328.4 380.8c9.4 10.9 27.5 10.9 37 0L858.9 335c12.2-14.2 1.2-35-18.5-35z">
                                </path>
                            </svg>
                        </div>
                    </div>

                    <div class="flex flex-col w-full">
                        <p class="py-3">Nama Afdeling <span class="text-red-600">*</span></p>
                        <div class="relative">
                            <select key="afdeling" onclick="pilihAfdeling(this)" maxlength="40"
                                class="w-full border-[2px] px-3 py-2 rounded-lg outline-primary appearance-none bg-transparent pr-10"
                                type="text" name="afdeling" id="afdeling" placeholder="">
                            </select>
                            <svg class="absolute  flex h-full top-0 right-0 mr-4" stroke="currentColor"
                                fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1em"
                                width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M840.4 300H183.6c-19.7 0-30.7 20.8-18.5 35l328.4 380.8c9.4 10.9 27.5 10.9 37 0L858.9 335c12.2-14.2 1.2-35-18.5-35z">
                                </path>
                            </svg>
                        </div>
                    </div>

                    <div class="flex flex-col w-full">
                        <p class="py-1 font-poppins-semibold">PH Tanah <span class="text-red-600">*</span></p>
                        <div class="flex md:flex-row gap-2 w-full flex-col">
                            <div class="relative pt-4 flex-1 ">
                                <input key="pH tanah" oninput="validateNumberInput(this)" maxlength="13"
                                    class="w-full border-[2px] px-3 py-2 rounded-lg outline-primary" type="text"
                                    name="ph" id="ph" placeholder="">
                                {{-- <p class="absolute top-2 px-2 bg-white left-6 text-xs">Batas Bawah</p> --}}
                            </div>
                        </div>

                    </div>
                    <div class="flex flex-col w-full">
                        <p class="py-1 font-poppins-semibold">Suhu <span class="text-red-600">*</span></p>
                        <div class="flex md:flex-row gap-2 w-full flex-col">
                            <div class="relative pt-4 flex-1 ">
                                <input key="batas bawah suhu" oninput="validateNumberInput(this)" maxlength="13"
                                    class="w-full border-[2px] px-3 py-2 rounded-lg outline-primary" type="text"
                                    name="suhu_bawah" id="suhu_bawah" placeholder="">
                                <p class="absolute top-2 px-2 bg-white dark:bg-slate-700 left-6 text-xs">Batas Bawah</p>
                                <p
                                    class="absolute right-4 top-2 h-full text-xs text-center items-center flex justify-center">
                                    °C</p>
                            </div>
                            <div class="relative pt-4 flex-1">
                                <input key="batas atas suhu" oninput="validateNumberInput(this)" maxlength="13"
                                    class="w-full border-[2px] px-3 py-2 rounded-lg outline-primary" type="text"
                                    name="suhu_atas" id="suhu_atas" placeholder="">
                                <p class="absolute top-2 px-2 bg-white left-6 dark:bg-slate-700 text-xs">Batas Atas</p>
                                <p
                                    class="absolute right-4 top-2 h-full text-xs text-center items-center flex justify-center">
                                    °C</p>
                            </div>
                        </div>

                    </div>

                    <div class="flex flex-col w-full">
                        <p class="py-1 font-poppins-semibold">Curah Hujan <span class="text-red-600">*</span></p>
                        <div class="flex md:flex-row gap-2 w-full flex-col">
                            <div class="relative pt-4 flex-1 ">
                                <input key="curah hujan" oninput="validateNumberInput(this)" maxlength="13"
                                    class="w-full border-[2px] px-3 py-2 rounded-lg outline-primary" type="text"
                                    name="hujan" id="hujan" placeholder="">
                                {{-- <p class="absolute top-2 px-2 bg-white left-6 text-xs">Batas Bawah</p> --}}
                            </div>
                        </div>

                    </div>

                    <div class="flex flex-col w-full">
                        <p class="py-1 font-poppins-semibold">Ketinggian <span class="text-red-600">*</span></p>
                        <div class="flex md:flex-row gap-2 w-full flex-col">
                            <div class="relative pt-4 flex-1 ">
                                <input key="ketinggian" oninput="validateNumberInput(this)" maxlength="13"
                                    class="w-full border-[2px] px-3 py-2 rounded-lg outline-primary" type="text"
                                    name="ketinggian" id="ketinggian" placeholder="">
                                {{-- <p class="absolute top-2 px-2 bg-white left-6 text-xs">Batas Bawah</p> --}}
                                <p
                                    class="absolute right-4 top-2 h-full text-xs text-center items-center flex justify-center">
                                    MDPL</p>
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
