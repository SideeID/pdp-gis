<div
    class="flex flex-row items-center gap-3 h-fit bg-white w-full py-6 px-6 md:px-12 border-b-[2px] sticky top-0 z-[90]">
    <div onclick="handleSidebar()" class="md:hidden p-2">
        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" aria-hidden="true" height="1em"
            width="1em" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z"
                clip-rule="evenodd"></path>
        </svg>
    </div>
    <div class="font-semibold">
        @hasSection('header')
            @yield('header')
        @else
            Dashboard
        @endif
    </div>
</div>