<p class="mt-2 text-center dark:text-white">Menampilkan <b class="text-primary dark:text-gray-300">{{ $paginator->count() }}</b> Dari <b
        class="text-primary dark:text-gray-300">{{ $paginator->total() }}</b> Data</p>
@if ($paginator->hasPages())

    <div class="px-2 justify-center py-2 flex w-fit items-center">
        <ul class="flex flex-row gap-2">
            @if ($paginator->onFirstPage())
                <li class="hidden items-center bg-[#EFEFEF] dark:bg-slate-700 dark:text-white rounded-md cursor-pointer hover:bg-[#ebebeb]">
                    <a class="w-full px-4 items-center flex h-full" href="{{ $paginator->previousPageUrl() }}">
                        <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 6.5L11.25 0.00480938L11.25 12.9952L0 6.5Z" fill="#787777" />
                        </svg>
                    </a>
                </li>
            @else
                <li class="flex items-center bg-[#EFEFEF] dark:bg-slate-700 dark:text-white rounded-md cursor-pointer hover:bg-[#ebebeb]">
                    <a class="w-full px-4 items-center flex h-full" href="{{ $paginator->previousPageUrl() }}">
                        <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 6.5L11.25 0.00480938L11.25 12.9952L0 6.5Z" fill="#787777" />
                        </svg>
                    </a>
                </li>
            @endif
            @foreach ($elements as $element)
                @if (is_array($element))
                    <?php $index = 0; ?>
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="py-2 bg-primary px-4 text-white rounded-md cursor-pointer">{{ $page }}
                            </li>
                        @else
                            @if ($paginator->currentPage() != 1)
                                @if ($paginator->currentPage() == $paginator->lastPage())
                                    @for ($i = 0; $i < 4; $i++)
                                        @if ($page == $paginator->currentPage() - $i)
                                            <a href="{{ $url }}">
                                                <li
                                                    class="py-2 bg-[#EFEFEF] dark:bg-slate-700 dark:text-white px-4 text-black rounded-md cursor-pointer hover:bg-[#ebebeb]">
                                                    {{ $page }}
                                                </li>
                                            </a>
                                        @endif
                                    @endfor
                                @else
                                    @if ($paginator->currentPage() == $paginator->lastPage() - 1)
                                        @for ($i = 0; $i < 3; $i++)
                                            @if ($page == $paginator->currentPage() - $i)
                                                <a href="{{ $url }}">
                                                    <li
                                                        class="py-2 bg-[#EFEFEF] dark:bg-slate-700 dark:text-white px-4 text-black rounded-md cursor-pointer hover:bg-[#ebebeb]">
                                                        {{ $page }}
                                                    </li>
                                                </a>
                                            @endif
                                        @endfor
                                    @else
                                        @if ($page == $paginator->currentPage() - 1)
                                            <a href="{{ $url }}">
                                                <li
                                                    class="py-2 bg-[#EFEFEF] dark:bg-slate-700 dark:text-white px-4 text-black rounded-md cursor-pointer hover:bg-[#ebebeb]">
                                                    {{ $page }}
                                                </li>
                                            </a>
                                        @endif
                                    @endif
                                @endif
                            @endif

                            @if ($paginator->currentPage() == 1)
                                @for ($i = 1; $i < 4; $i++)
                                    @if ($page == $paginator->currentPage() + $i)
                                        <a href="{{ $url }}">
                                            <li
                                                class="py-2 bg-[#EFEFEF] dark:bg-slate-700 dark:text-white px-4 text-black rounded-md cursor-pointer hover:bg-[#ebebeb]">
                                                {{ $page }}
                                            </li>
                                        </a>
                                    @endif
                                @endfor
                            @else
                                @for ($i = 1; $i < 3; $i++)
                                    @if ($page == $paginator->currentPage() + $i)
                                        <a href="{{ $url }}">
                                            <li
                                                class="py-2 bg-[#EFEFEF] dark:bg-slate-700 dark:text-white px-4 text-black rounded-md cursor-pointer hover:bg-[#ebebeb]">
                                                {{ $page }}
                                            </li>
                                        </a>
                                    @endif
                                @endfor
                            @endif
                            {{-- @if ($page == $paginator->currentPage() + 2)
                                <a href="{{ $url }}">
                                    <li
                                        class="py-2 bg-[#EFEFEF] dark:bg-slate-700 dark:text-white px-4 text-black rounded-md cursor-pointer hover:bg-[#ebebeb]">
                                        {{ $page }}
                                    </li>
                                </a>
                            @endif
                            @if ($page == $paginator->currentPage() + 3)
                                <a href="{{ $url }}">
                                    <li
                                        class="py-2 bg-[#EFEFEF] dark:bg-slate-700 dark:text-white px-4 text-black rounded-md cursor-pointer hover:bg-[#ebebeb]">
                                        {{ $page }}
                                    </li>
                                </a>
                            @endif --}}

                            {{-- @if ($page < $paginator->currentPage() + 4 && $page > $paginator->currentPage())
                                <a href="{{ $url }}">
                                    <li
                                        class="py-2 bg-[#EFEFEF] dark:bg-slate-700 dark:text-white px-4 text-black rounded-md cursor-pointer hover:bg-[#ebebeb]">
                                        {{ $page }}
                                    </li>
                                </a>
                            @endif --}}
                        @endif
                        <?php $index++; ?>
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <li class="flex items-center bg-[#EFEFEF] dark:bg-slate-700 dark:text-white rounded-md cursor-pointer hover:bg-[#ebebeb]">
                    <a class="w-full px-4 items-center flex h-full" href="{{ $paginator->nextPageUrl() }}">
                        <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 6.5L0.75 12.9952V0.00480938L12 6.5Z" fill="#787777" />
                        </svg>
                    </a>
                </li>
            @else
                <li class="hidden items-center bg-[#EFEFEF] dark:bg-slate-700 dark:text-white rounded-md cursor-pointer hover:bg-[#ebebeb]">
                    <a class="w-full px-4 items-center flex h-full" href="{{ $paginator->nextPageUrl() }}">
                        <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 6.5L0.75 12.9952V0.00480938L12 6.5Z" fill="#787777" />
                        </svg>
                    </a>
                </li>
            @endif
        </ul>
    </div>
@endif
