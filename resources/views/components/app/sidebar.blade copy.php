<div>
    <!-- Sidebar backdrop (mobile only) -->
    <div class="fixed inset-0 bg-slate-900 bg-opacity-30 z-40 lg:hidden lg:z-auto transition-opacity duration-200"
        :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'" aria-hidden="true" x-cloak></div>

    <!-- Sidebar -->
    <div id="sidebar"
        class="flex flex-col absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0 h-screen overflow-y-scroll lg:overflow-y-auto no-scrollbar w-64 lg:w-20 lg:sidebar-expanded:!w-64 2xl:!w-64 shrink-0 bg-slate-900 p-4 transition-all duration-200 ease-in-out"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'" @click.outside="sidebarOpen = false"
        @keydown.escape.window="sidebarOpen = false" x-cloak="lg">
        

        <!-- Sidebar header -->
        <div class="flex justify-between mb-10 pr-3 sm:px-2">
            <!-- Close button -->
            <button class="lg:hidden text-slate-500 hover:text-slate-400" @click.stop="sidebarOpen = !sidebarOpen"
                aria-controls="sidebar" :aria-expanded="sidebarOpen">
                <span class="sr-only">Close sidebar</span>
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z" />
                </svg>
            </button>
            <!-- Logo -->
            <a class="block" href="{{ route('dashboard') }}">
               
                <h2 class="text-2xl font-bold text-white">Pharmaceuticals</h2>

            </a>
        </div>

        <!-- Links -->
        <div class="space-y-8">
            <!-- Pages group -->
            <div>
                <ul class="mt-3">
                    <!-- Dashboard -->
                     <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if(in_array(Request::segment(1), ['dashboard'])){{ 'bg-slate-900' }}@endif" x-data="{ open: {{ in_array(Request::segment(1), ['dashboard']) ? 1 : 0 }} }" href="{{ route('dashboard') }}">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if(in_array(Request::segment(1), ['dashboard'])){{ 'hover:text-slate-200' }}@endif" href="{{ route('dashboard') }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                        <path class="fill-current @if(in_array(Request::segment(1), ['dashboard'])){{ 'text-indigo-500' }}@else{{ 'text-slate-400' }}@endif" d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0z" />
                                        <path class="fill-current @if(in_array(Request::segment(1), ['dashboard'])){{ 'text-indigo-600' }}@else{{ 'text-slate-600' }}@endif" d="M12 3c-4.963 0-9 4.037-9 9s4.037 9 9 9 9-4.037 9-9-4.037-9-9-9z" />
                                        <path class="fill-current @if(in_array(Request::segment(1), ['dashboard'])){{ 'text-indigo-200' }}@else{{ 'text-slate-400' }}@endif" d="M12 15c-1.654 0-3-1.346-3-3 0-.462.113-.894.3-1.285L6 6l4.714 3.301A2.973 2.973 0 0112 9c1.654 0 3 1.346 3 3s-1.346 3-3 3z" />
                                    </svg>
                                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200" href="{{ route('dashboard') }}">
                                     Dashboard 
                                    </span>
                                </div>
                            </div>
                        </a>
                       
                    </li>
                    <!-- Users -->
                    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['users', 'roles'])) {{ 'bg-slate-900' }} @endif"
                        x-data="{ open: {{ in_array(Request::segment(1), ['users', 'roles']) ? 1 : 0 }} }">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['users', 'roles'])) {{ 'hover:text-slate-200' }} @endif"
                            href="#0" @click.prevent="sidebarExpanded ? open = !open : sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">


                                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                        <path
                                            class="fill-current @if (in_array(Request::segment(1), ['users', 'roles'])) {{ 'text-indigo-300' }} @else {{ 'text-slate-400' }} @endif"
                                            d="M18.974 8H22a2 2 0 012 2v6h-2v5a1 1 0 01-1 1h-2a1 1 0 01-1-1v-5h-2v-6a2 2 0 012-2h.974zM20 7a2 2 0 11-.001-3.999A2 2 0 0120 7zM2.974 8H6a2 2 0 012 2v6H6v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5H0v-6a2 2 0 012-2h.974zM4 7a2 2 0 11-.001-3.999A2 2 0 014 7z" />
                                        <path
                                            class="fill-current @if (in_array(Request::segment(1), ['users', 'roles'])) {{ 'text-indigo-500' }} @else {{ 'text-slate-600' }} @endif"
                                            d="M12 6a3 3 0 110-6 3 3 0 010 6zm2 18h-4a1 1 0 01-1-1v-6H6v-6a3 3 0 013-3h6a3 3 0 013 3v6h-3v6a1 1 0 01-1 1z" />
                                        <path
                                            class="fill-current @if (in_array(Request::segment(1), ['users', 'roles'])) {{ 'text-indigo-300' }} @else {{ 'text-slate-400' }} @endif"
                                            d="M12 15l11-7L11.504.136a1 1 0 00-1.019.007L0 7l13 8z" />
                                    </svg>

                                    <span
                                        class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Users</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400 @if (in_array(Request::segment(1), ['users', 'roles'])) {{ 'rotate-180' }} @endif"
                                        :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>


                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1 @if (!in_array(Request::segment(1), ['users', 'roles'])) {{ 'hidden' }} @endif"
                                :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('users.index')) || (Route::is('roles.index')) {{ '!text-indigo-500' }} @endif"
                                        href="{{ route('users.index') }}">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Manage
                                            Users</span>
                                    </a>
                                </li>

                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('roles.index')) || (Route::is('roles.index')) {{ '!text-indigo-500' }} @endif"
                                        href="{{ route('roles.index') }}">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Manage
                                            Roles</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <!--users-->


                    <!-- customers-->
                    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['customers'])) {{ 'bg-slate-900' }} @endif"
                        x-data="{ open: {{ in_array(Request::segment(1), ['customers']) ? 1 : 0 }} }">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['customers'])) {{ 'hover:text-slate-200' }} @endif"
                            href="#0" @click.prevent="sidebarExpanded ? open = !open : sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                   

                                     <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
    <path class="fill-current @if (in_array(Request::segment(1), ['customers'])) {{ 'text-indigo-300' }} @else {{ 'text-slate-400' }} @endif" d="M18.974 8H22a2 2 0 012 2v6h-2v5a1 1 0 01-1 1h-2a1 1 0 01-1-1v-5h-2v-6a2 2 0 012-2h.974zM20 7a2 2 0 11-.001-3.999A2 2 0 0120 7zM2.974 8H6a2 2 0 012 2v6H6v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5H0v-6a2 2 0 012-2h.974zM4 7a2 2 0 11-.001-3.999A2 2 0 014 7z" />
    <path class="fill-current @if (in_array(Request::segment(1), ['customers'])) {{ 'text-indigo-500' }} @else {{ 'text-slate-600' }} @endif" d="M12 6a3 3 0 110-6 3 3 0 010 6zm2 18h-4a1 1 0 01-1-1v-6H6v-6a3 3 0 013-3h6a3 3 0 013 3v6h-3v6a1 1 0 01-1 1z" />
    <path class="fill-current @if (in_array(Request::segment(1), ['customers'])) {{ 'text-indigo-300' }} @else {{ 'text-slate-400' }} @endif" d="M12 15l11-7L11.504.136a1 1 0 00-1.019.007L0 7l13 8z" />
</svg>

                                    <span
                                        class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Customers</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400 @if (in_array(Request::segment(1), ['customers'])) {{ 'rotate-180' }} @endif"
                                        :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1 @if (!in_array(Request::segment(1), ['customers'])) {{ 'hidden' }} @endif"
                                :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('customers.index')) {{ '!text-indigo-500' }} @endif"
                                        href="{{ route('customers.index') }}">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Manage
                                            Customers</span>
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </li>

                    <!-- customers-->


                    <!-- advances -->
                    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['advances'])) {{ 'bg-slate-900' }} @endif"
                        x-data="{ open: {{ in_array(Request::segment(1), ['advances']) ? 1 : 0 }} }">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['advances'])) {{ 'hover:text-slate-200' }} @endif"
                            href="#0" @click.prevent="sidebarExpanded ? open = !open : sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                     <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                        <path class="fill-current @if(in_array(Request::segment(1), ['advances'])){{ 'text-indigo-500' }}@else{{ 'text-slate-600' }}@endif" d="M14.5 7c4.695 0 8.5 3.184 8.5 7.111 0 1.597-.638 3.067-1.7 4.253V23l-4.108-2.148a10 10 0 01-2.692.37c-4.695 0-8.5-3.184-8.5-7.11C6 10.183 9.805 7 14.5 7z" />
                                        <path class="fill-current @if(in_array(Request::segment(1), ['advances'])){{ 'text-indigo-300' }}@else{{ 'text-slate-400' }}@endif" d="M11 1C5.477 1 1 4.582 1 9c0 1.797.75 3.45 2 4.785V19l4.833-2.416C8.829 16.85 9.892 17 11 17c5.523 0 10-3.582 10-8s-4.477-8-10-8z" />
                                    </svg>
                                    <span
                                        class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Advances</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400 @if (in_array(Request::segment(1), ['advances'])) {{ 'rotate-180' }} @endif"
                                        :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1 @if (!in_array(Request::segment(1), ['advances'])) {{ 'hidden' }} @endif"
                                :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('advances.index')) {{ '!text-indigo-500' }} @endif"
                                        href="{{ route('advances.index') }}">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Manage
                                            Advances</span>
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </li>
                    <!-- advances -->


                                        <!--balancing -->
                    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['balancing'])) {{ 'bg-slate-900' }} @endif"
                        x-data="{ open: {{ in_array(Request::segment(1), ['balancing']) ? 1 : 0 }} }">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['balancing'])) {{ 'hover:text-slate-200' }} @endif"
                            href="#0" @click.prevent="sidebarExpanded ? open = !open : sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                   


                                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                        <circle class="fill-current @if(in_array(Request::segment(1), ['balancing'])){{ 'text-indigo-300' }}@else{{ 'text-slate-400' }}@endif" cx="18.5" cy="5.5" r="4.5" />
                                        <circle class="fill-current @if(in_array(Request::segment(1), ['balancing'])){{ 'text-indigo-500' }}@else{{ 'text-slate-600' }}@endif" cx="5.5" cy="5.5" r="4.5" />
                                        <circle class="fill-current @if(in_array(Request::segment(1), ['balancing'])){{ 'text-indigo-500' }}@else{{ 'text-slate-600' }}@endif" cx="18.5" cy="18.5" r="4.5" />
                                        <circle class="fill-current @if(in_array(Request::segment(1), ['balancing'])){{ 'text-indigo-300' }}@else{{ 'text-slate-400' }}@endif" cx="5.5" cy="18.5" r="4.5" />
                                    </svg>
                                    <span
                                        class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Balancing</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400 @if (in_array(Request::segment(1), ['balancing'])) {{ 'rotate-180' }} @endif"
                                        :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1 @if (!in_array(Request::segment(1), ['balancing'])) {{ 'hidden' }} @endif"
                                :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('balancing.index')) {{ '!text-indigo-500' }} @endif"
                                        href="{{ route('balancing.index') }}">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Manage
                                            Balancing</span>
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </li>

                    <!-- baalncing -->

                    <!-- cash payments-->
                    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['cash'])) {{ 'bg-slate-900' }} @endif"
                        x-data="{ open: {{ in_array(Request::segment(1), ['cash']) ? 1 : 0 }} }">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['cash'])) {{ 'hover:text-slate-200' }} @endif"
                            href="#0" @click.prevent="sidebarExpanded ? open = !open : sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                   


                                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                        <circle class="fill-current @if(in_array(Request::segment(1), ['cash'])){{ 'text-indigo-300' }}@else{{ 'text-slate-400' }}@endif" cx="18.5" cy="5.5" r="4.5" />
                                        <circle class="fill-current @if(in_array(Request::segment(1), ['cash'])){{ 'text-indigo-500' }}@else{{ 'text-slate-600' }}@endif" cx="5.5" cy="5.5" r="4.5" />
                                        <circle class="fill-current @if(in_array(Request::segment(1), ['cash'])){{ 'text-indigo-500' }}@else{{ 'text-slate-600' }}@endif" cx="18.5" cy="18.5" r="4.5" />
                                        <circle class="fill-current @if(in_array(Request::segment(1), ['cash'])){{ 'text-indigo-300' }}@else{{ 'text-slate-400' }}@endif" cx="5.5" cy="18.5" r="4.5" />
                                    </svg>
                                    <span
                                        class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Cash Payments</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400 @if (in_array(Request::segment(1), ['cash'])) {{ 'rotate-180' }} @endif"
                                        :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1 @if (!in_array(Request::segment(1), ['cash'])) {{ 'hidden' }} @endif"
                                :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('cash.index')) {{ '!text-indigo-500' }} @endif"
                                        href="{{ route('cash.index') }}">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Manage Cash Payments</span>
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </li>
                    <!-- cash payments-->

                    <!-- Coffee -->
                    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['coffee', 'coffee_prices', 'coffee_types', 'coffee_loadings', 'coffee_purchases'])) {{ 'bg-slate-900' }} @endif"
                        x-data="{ open: {{ in_array(Request::segment(1), ['coffee', 'coffee_prices', 'coffee_types', 'coffee_loadings', 'coffee_purchases']) ? 1 : 0 }} }">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['coffee', 'coffee_prices', 'coffee_types', 'coffee_loadings', 'coffee_purchases'])) {{ 'hover:text-slate-200' }} @endif"
                            href="#0" @click.prevent="sidebarExpanded ? open = !open : sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    


                                 

                                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                    <path class="fill-current @if(in_array(Request::segment(1), ['coffee', 'coffee_prices', 'coffee_types', 'coffee_loadings', 'coffee_purchases'])){{ 'text-indigo-500' }}@else{{ 'text-slate-600' }}@endif" d="M20 7a.75.75 0 01-.75-.75 1.5 1.5 0 00-1.5-1.5.75.75 0 110-1.5 1.5 1.5 0 001.5-1.5.75.75 0 111.5 0 1.5 1.5 0 001.5 1.5.75.75 0 110 1.5 1.5 1.5 0 00-1.5 1.5A.75.75 0 0120 7zM4 23a.75.75 0 01-.75-.75 1.5 1.5 0 00-1.5-1.5.75.75 0 110-1.5 1.5 1.5 0 001.5-1.5.75.75 0 111.5 0 1.5 1.5 0 001.5 1.5.75.75 0 110 1.5 1.5 1.5 0 00-1.5 1.5A.75.75 0 014 23z" />
                                    <path class="fill-current @if(in_array(Request::segment(1), ['coffee', 'coffee_prices', 'coffee_types', 'coffee_loadings', 'coffee_purchases'])){{ 'text-indigo-300' }}@else{{ 'text-slate-400' }}@endif" d="M17 23a1 1 0 01-1-1 4 4 0 00-4-4 1 1 0 010-2 4 4 0 004-4 1 1 0 012 0 4 4 0 004 4 1 1 0 010 2 4 4 0 00-4 4 1 1 0 01-1 1zM7 13a1 1 0 01-1-1 4 4 0 00-4-4 1 1 0 110-2 4 4 0 004-4 1 1 0 112 0 4 4 0 004 4 1 1 0 010 2 4 4 0 00-4 4 1 1 0 01-1 1z" />
                                </svg>

                                    
                                    <span
                                        class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Coffee</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400 @if (in_array(Request::segment(1), ['coffee', 'coffee_prices', 'coffee_types', 'coffee_loadings', 'coffee_purchases'])) {{ 'rotate-180' }} @endif"
                                        :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>

                                    

                                    
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1 @if (!in_array(Request::segment(1), ['coffee', 'coffee_prices', 'coffee_types', 'coffee_loadings', 'coffee_purchases'])) {{ 'hidden' }} @endif"
                                :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('coffee_types.index')) {{ '!text-indigo-500' }} @endif"
                                        href="{{ route('coffee_types.index') }}">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Manage
                                            Coffee Types</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('coffee_prices.index')) {{ '!text-indigo-500' }} @endif"
                                        href="{{ route('coffee_prices.index') }}">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Manage
                                            Coffee Prices</span>
                                    </a>
                                </li>
                                                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('coffee_loadings.index')) {{ '!text-indigo-500' }} @endif"
                                        href="{{ route('coffee_loadings.index') }}">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Manage
                                            Coffee Loading</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('coffee_purchases.index')) {{ '!text-indigo-500' }} @endif"
                                        href="{{ route('coffee_purchases.index') }}">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Manage Purchases</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Coffee -->


                    <!-- stock-->
                    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['stocks', 'dead_stock'])) {{ 'bg-slate-900' }} @endif"
                        x-data="{ open: {{ in_array(Request::segment(1), ['stocks', 'dead_stock']) ? 1 : 0 }} }">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['stocks'])) {{ 'hover:text-slate-200' }} @endif"
                            href="#0" @click.prevent="sidebarExpanded ? open = !open : sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                  

                                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                        <path
                                            class="fill-current @if (in_array(Request::segment(1), ['stocks', 'dead_stock'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-400' }} @endif"
                                            d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0z" />
                                        <path
                                            class="fill-current @if (in_array(Request::segment(1), ['stocks', 'dead_stock'])) {{ 'text-indigo-600' }}@else{{ 'text-slate-600' }} @endif"
                                            d="M12 3c-4.963 0-9 4.037-9 9s4.037 9 9 9 9-4.037 9-9-4.037-9-9-9z" />
                                        <path
                                            class="fill-current @if (in_array(Request::segment(1), ['stocks', 'dead_stock'])) {{ 'text-indigo-200' }}@else{{ 'text-slate-400' }} @endif"
                                            d="M12 15c-1.654 0-3-1.346-3-3 0-.462.113-.894.3-1.285L6 6l4.714 3.301A2.973 2.973 0 0112 9c1.654 0 3 1.346 3 3s-1.346 3-3 3z" />
                                    </svg>
                                    <span
                                        class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Stock</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400 @if (in_array(Request::segment(1), ['stocks', 'dead_stock'])) {{ 'rotate-180' }} @endif"
                                        :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1 @if (!in_array(Request::segment(1), ['stocks', 'dead_stock'])) {{ 'hidden' }} @endif"
                                :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('stocks.index')) {{ '!text-indigo-500' }} @endif"
                                        href="{{ route('stocks.index') }}">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Manage
                                            Stock</span>
                                    </a>
                                </li>

                                 <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('dead_stock.index')) {{ '!text-indigo-500' }} @endif"
                                        href="{{ route('dead_stock.index') }}">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Manage
                                           Dead Stock</span>
                                    </a>
                                </li>


                                 <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('dead_stock.create')) {{ '!text-indigo-500' }} @endif"
                                        href="{{ route('dead_stock.create') }}">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Transfer
                                           Dead Stock</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        
                        
                    </li>
                    <!-- stock-->

   


              <!-- Expense -->
<li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['expenses', 'expense_items', 'expense_categories'])) {{ 'bg-slate-900' }} @endif"
    x-data="{ open: {{ in_array(Request::segment(1), ['expenses', 'expense_items', 'expense_categories']) ? 1 : 0 }} }">
    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['expenses', 'expense_items', 'expense_categories'])) {{ 'hover:text-slate-200' }} @endif"
        href="#0" @click.prevent="sidebarExpanded ? open = !open : sidebarExpanded = true">
        <div class="flex items-center justify-between">
            <div class="flex items-center">


                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                    <path class="fill-current @if(in_array(Request::segment(1), ['expenses', 'expense_items', 'expense_categories'])){{ 'text-indigo-300' }}@else{{ 'text-slate-400' }}@endif" d="M13 6.068a6.035 6.035 0 0 1 4.932 4.933H24c-.486-5.846-5.154-10.515-11-11v6.067Z" />
                    <path class="fill-current @if(in_array(Request::segment(1), ['expenses', 'expense_items', 'expense_categories'])){{ 'text-indigo-500' }}@else{{ 'text-slate-700' }}@endif" d="M18.007 13c-.474 2.833-2.919 5-5.864 5a5.888 5.888 0 0 1-3.694-1.304L4 20.731C6.131 22.752 8.992 24 12.143 24c6.232 0 11.35-4.851 11.857-11h-5.993Z" />
                    <path class="fill-current @if(in_array(Request::segment(1), ['expenses', 'expense_items', 'expense_categories'])){{ 'text-indigo-600' }}@else{{ 'text-slate-600' }}@endif" d="M6.939 15.007A5.861 5.861 0 0 1 6 11.829c0-2.937 2.167-5.376 5-5.85V0C4.85.507 0 5.614 0 11.83c0 2.695.922 5.174 2.456 7.17l4.483-3.993Z" />
                </svg>
                <span
                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Expenses</span>
            </div>
            <!-- Icon -->
            <div
                class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400 @if (in_array(Request::segment(1), ['expenses', 'expense_items', 'expense_categories'])) {{ 'rotate-180' }} @endif"
                    :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                </svg>
            </div>
        </div>
    </a>
    <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
        <ul class="pl-9 mt-1 @if (!in_array(Request::segment(1), ['expenses', 'expense_items', 'expense_categories'])) {{ 'hidden' }} @endif"
            :class="open ? '!block' : 'hidden'">
                        <li class="mb-1 last:mb-0">
                <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('expense_categories.index')) {{ '!text-indigo-500' }} @endif"
                    href="{{ route('expense_categories.index') }}">
                    <span
                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Manage
                        Categories</span>
                </a>
            </li>
            <li class="mb-1 last:mb-0">
                <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('expense_items.index')) || (Route::is('expense_items.index')) || (Route::is('expense_categories.index')) {{ '!text-indigo-500' }} @endif"
                    href="{{ route('expense_items.index') }}">
                    <span
                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Manage Items</span>
                </a>
            </li>
             <li class="mb-1 last:mb-0">
                <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('expenses.index')) || (Route::is('expense_items.index')) || (Route::is('expense_categories.index')) {{ '!text-indigo-500' }} @endif"
                    href="{{ route('expenses.index') }}">
                    <span
                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Manage Expenses</span>
                </a>
            </li>
            
        </ul>
    </div>
</li>
<!-- Expense -->




                    <!-- capital-->
                    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['capital'])) {{ 'bg-slate-900' }} @endif"
                        x-data="{ open: {{ in_array(Request::segment(1), ['capital']) ? 1 : 0 }} }">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['capital'])) {{ 'hover:text-slate-200' }} @endif"
                            href="#0" @click.prevent="sidebarExpanded ? open = !open : sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                  

                                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                        <path class="fill-current @if(in_array(Request::segment(1), ['capital'])){{ 'text-indigo-300' }}@else{{ 'text-slate-400' }}@endif" d="M13 6.068a6.035 6.035 0 0 1 4.932 4.933H24c-.486-5.846-5.154-10.515-11-11v6.067Z" />
                                        <path class="fill-current @if(in_array(Request::segment(1), ['capital'])){{ 'text-indigo-500' }}@else{{ 'text-slate-700' }}@endif" d="M18.007 13c-.474 2.833-2.919 5-5.864 5a5.888 5.888 0 0 1-3.694-1.304L4 20.731C6.131 22.752 8.992 24 12.143 24c6.232 0 11.35-4.851 11.857-11h-5.993Z" />
                                        <path class="fill-current @if(in_array(Request::segment(1), ['capital'])){{ 'text-indigo-600' }}@else{{ 'text-slate-600' }}@endif" d="M6.939 15.007A5.861 5.861 0 0 1 6 11.829c0-2.937 2.167-5.376 5-5.85V0C4.85.507 0 5.614 0 11.83c0 2.695.922 5.174 2.456 7.17l4.483-3.993Z" />
                                    </svg>



                                    <span
                                        class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Capital</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400 @if (in_array(Request::segment(1), ['capital'])) {{ 'rotate-180' }} @endif"
                                        :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1 @if (!in_array(Request::segment(1), ['capital'])) {{ 'hidden' }} @endif"
                                :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('capital.index')) {{ '!text-indigo-500' }} @endif"
                                        href="{{ route('capital.index') }}">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Manage
                                            Capital</span>
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </li>
                    <!-- capital-->

                    <!-- Report -->
<li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), [
        'report',
        'millingReport',
        'boxReport',
        'transportReport',
        'sundryReport',
        'labourReport',
        'reports.index',
        'coffee_loadings.index'
    ])) {{ 'bg-slate-900' }} @endif"
    x-data="{ open: {{ in_array(Request::segment(1), ['report', 'millingReport', 'boxReport', 'transportReport', 'sundryReport', 'labourReport', 'reports.index', 'coffee_loadings.index']) ? 1 : 0 }} }">
    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), [
            'report',
            'millingReport',
            'boxReport',
            'transportReport',
            'sundryReport',
            'labourReport',
            'reports.index',
            'coffee_loadings.index'
        ])) {{ 'hover:text-slate-200' }} @endif"
        href="#0" @click.prevent="sidebarExpanded ? open = !open : sidebarExpanded = true">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                    <path
                        class="fill-current @if (in_array(Request::segment(1), [
                                'report',
                                'millingReport',
                                'boxReport',
                                'transportReport',
                                'sundryReport',
                                'labourReport',
                                'reports.index',
                                'coffee_loadings.index'
                            ])) {{ 'text-indigo-300' }}@else{{ 'text-slate-400' }} @endif"
                        d="M13 15l11-7L11.504.136a1 1 0 00-1.019.007L0 7l13 8z" />
                    <path
                        class="fill-current @if (in_array(Request::segment(1), [
                                'report',
                                'millingReport',
                                'boxReport',
                                'transportReport',
                                'sundryReport',
                                'labourReport',
                                'reports.index',
                                'coffee_loadings.index'
                            ])) {{ 'text-indigo-600' }}@else{{ 'text-slate-700' }} @endif"
                        d="M13 15L0 7v9c0 .355.189.685.496.864L13 24v-9z" />
                    <path
                        class="fill-current @if (in_array(Request::segment(1), [
                                'report',
                                'millingReport',
                                'boxReport',
                                'transportReport',
                                'sundryReport',
                                'labourReport',
                                'reports.index',
                                'coffee_loadings.index'
                            ])) {{ 'text-indigo-500' }}@else{{ 'text-slate-600' }} @endif"
                        d="M13 15.047V24l10.573-7.181A.999.999 0 0024 16V8l-11 7.047z" />
                </svg>
                <span
                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Reports</span>
            </div>
            <!-- Icon -->
            <div
                class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400 @if (in_array(Request::segment(1), [
                        'report',
                        'millingReport',
                        'boxReport',
                        'transportReport',
                        'sundryReport',
                        'labourReport',
                        'reports.index',
                        'coffee_loadings.index'
                    ])) {{ 'rotate-180' }} @endif"
                    :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                </svg>
                
            </div>
        </div>
    </a>
    <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
        <ul class="pl-9 mt-1 @if (
            !in_array(Request::segment(1), [
                'report',
                'reports.index',
                'millingReport',
                'boxReport',
                'transportReport',
                'sundryReport',
                'labourReport',
                'coffee_loadings.index'
            ])) {{ 'hidden' }} @endif"
            :class="open ? '!block' : 'hidden'">
            <li class="mb-1 last:mb-0">
                <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('reports.index')) {{ '!text-indigo-500' }} @endif"
                    href="{{ route('reports.index') }}">
                    <span
                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Daily
                        Reports</span>
                </a>
            </li>
            <li class="mb-1 last:mb-0">
                <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('millingReport')) {{ '!text-indigo-500' }} @endif"
                    href="{{ route('millingReport') }}">
                    <span
                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Milling
                        Report</span>
                </a>
            </li>
            <li class="mb-1 last:mb-0">
                <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('boxReport')) {{ '!text-indigo-500' }} @endif"
                    href="{{ route('boxReport') }}">
                    <span
                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Box
                        Report</span>
                </a>
            </li>
            <li class="mb-1 last:mb-0">
                <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('transportReport')) {{ '!text-indigo-500' }} @endif"
                    href="{{ route('transportReport') }}">
                    <span
                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Transport
                        Report</span>
                </a>
            </li>
            <li class="mb-1 last:mb-0">
                <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('sundryReport')) {{ '!text-indigo-500' }} @endif"
                    href="{{ route('sundryReport') }}">
                    <span
                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Sun
                        Dry Report</span>
                </a>
            </li>
            <li class="mb-1 last:mb-0">
                <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('labourReport')) {{ '!text-indigo-500' }} @endif"
                    href="{{ route('labourReport') }}">
                    <span
                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Labour
                        Report</span>
                </a>
            </li>
            <li class="mb-1 last:mb-0">
                <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('coffee_loadings.index')) {{ '!text-indigo-500' }} @endif"
                    href="{{ route('coffee_loadings.index') }}">
                    <span
                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Coffee Loading Report</span>
                </a>
            </li>
        </ul>
    </div>
</li>
<!-- Report -->



                    <!-- capital-->
                    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['audit-logs'])) {{ 'bg-slate-900' }} @endif"
                        x-data="{ open: {{ in_array(Request::segment(1), ['audit-logs']) ? 1 : 0 }} }">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['capital'])) {{ 'hover:text-slate-200' }} @endif"
                            href="#0" @click.prevent="sidebarExpanded ? open = !open : sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                  

                                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                        <path class="fill-current @if(in_array(Request::segment(1), ['audit-logs'])){{ 'text-indigo-300' }}@else{{ 'text-slate-400' }}@endif" d="M13 6.068a6.035 6.035 0 0 1 4.932 4.933H24c-.486-5.846-5.154-10.515-11-11v6.067Z" />
                                        <path class="fill-current @if(in_array(Request::segment(1), ['audit-logs'])){{ 'text-indigo-500' }}@else{{ 'text-slate-700' }}@endif" d="M18.007 13c-.474 2.833-2.919 5-5.864 5a5.888 5.888 0 0 1-3.694-1.304L4 20.731C6.131 22.752 8.992 24 12.143 24c6.232 0 11.35-4.851 11.857-11h-5.993Z" />
                                        <path class="fill-current @if(in_array(Request::segment(1), ['audit-logs'])){{ 'text-indigo-600' }}@else{{ 'text-slate-600' }}@endif" d="M6.939 15.007A5.861 5.861 0 0 1 6 11.829c0-2.937 2.167-5.376 5-5.85V0C4.85.507 0 5.614 0 11.83c0 2.695.922 5.174 2.456 7.17l4.483-3.993Z" />
                                    </svg>



                                    <span
                                        class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Audit Logs</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400 @if (in_array(Request::segment(1), ['audit-logs'])) {{ 'rotate-180' }} @endif"
                                        :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1 @if (!in_array(Request::segment(1), ['audit-logs'])) {{ 'hidden' }} @endif"
                                :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if (Route::is('audit-logs.index')) {{ '!text-indigo-500' }} @endif"
                                        href="{{ route('audit-logs.index') }}">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Manage
                                            Audit Logs</span>
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </li>




                </ul>
            </div>
        </div>

        <!-- Expand / collapse button -->
        <div class="pt-3 hidden lg:inline-flex 2xl:hidden justify-end mt-auto">
            <div class="px-3 py-2">
                <button @click="sidebarExpanded = !sidebarExpanded">
                    <span class="sr-only">Expand / collapse sidebar</span>
                    <svg class="w-6 h-6 fill-current sidebar-expanded:rotate-180" viewBox="0 0 24 24">
                        <path class="text-slate-400"
                            d="M19.586 11l-5-5L16 4.586 23.414 12 16 19.414 14.586 18l5-5H7v-2z" />
                        <path class="text-slate-600" d="M3 23H1V1h2z" />
                    </svg>
                </button>
            </div>
        </div>

    </div>
</div>