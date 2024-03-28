<nav x-data="{ open: false }" class="bg-blue-500 border-b border-gray-100 text-white">
    <!-- Primary Navigation Menu -->
    <div class=" mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <!-- <x-application-logo class="block h-9 w-auto fill-current text-gray-800" /> -->
                        <image src="/images/logo.jpg" class="w-9 h-9 fill-current">
                    </a>
                    <h1 class="ml-3">MILKIZE INVENTORY AND POS SYSTEM</h1>
                </div>

                @if (Auth::user()->user_type != 'DISABLED')
                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex ">
                        @if (Auth::user()->user_type == 'SUPER ADMIN')
                            <x-nav-link :href="route('superAdmin')" :active="request()->routeIs('superAdmin')">
                                {{ __('Account') }}
                            </x-nav-link>
                            <x-nav-link :href="route('superAdmin')" :active="request()->routeIs('superAdmin')">
                                {{ __('Archived Account') }}
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                            <x-nav-link :href="route('POS')" :active="request()->routeIs('POS')">
                                {{ __('POS') }}
                            </x-nav-link>
                            <div class="hidden sm:flex sm:items-center sm:ms-6">
                                <x-dropdown align="left" width="48">
                                    <x-slot name="trigger">
                                        <button
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                            <div> {{ __('Inventory') }}</div>

                                            <div class="ms-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('Register-Supplier')" :active="request()->routeIs('Register-Supplier')">
                                            {{ __('Register Supplier') }}
                                        </x-dropdown-link>

                                        <x-dropdown-link :href="route('Register-Item')" :active="request()->routeIs('Register-Item')">
                                            {{ __('Register Items') }}
                                        </x-dropdown-link>

                                        <x-dropdown-link :href="route('Ingredients-Volume')" :active="request()->routeIs('Ingredients-Volume')">
                                            {{ __('Ingredients Volume') }}
                                        </x-dropdown-link>

                                        <!-- <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Purchase') }}
                                </x-dropdown-link> -->

                                    </x-slot>
                                </x-dropdown>
                            </div>

                            <div class="hidden sm:flex sm:items-center sm:ms-6">
                                <x-dropdown align="left" width="48">
                                    <x-slot name="trigger">
                                        <button
                                            class="inline-flex text-white items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-blue-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                            <div> {{ __('Categories') }}</div>

                                            <div class="ms-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('Ingredient-categories')" :active="request()->routeIs('Ingredient-categories')">
                                            {{ __('Register Ingredient') }}
                                        </x-dropdown-link>

                                        <x-dropdown-link :href="route('supplier-categories')" :active="request()->routeIs('supplier-categories')">
                                            {{ __('Register Supplier') }}
                                        </x-dropdown-link>

                                        <x-dropdown-link :href="route('brand-categories')" :active="request()->routeIs('brand-categories')">
                                            {{ __('Register Brand') }}
                                        </x-dropdown-link>

                                        <x-dropdown-link :href="route('unit-categories')" :active="request()->routeIs('unit-categories')">
                                            {{ __('Register Unit') }}
                                        </x-dropdown-link>

                                        <x-dropdown-link :href="route('toppins-add')" :active="request()->routeIs('toppins-add')">
                                            {{ __('Register Toppings/Add On') }}
                                        </x-dropdown-link>

                                    </x-slot>
                                </x-dropdown>
                            </div>
                            <x-nav-link :href="route('Sales_Report', [
                                'start_date' => now()->format('Y-m-d'),
                                'end_date' => now()->format('Y-m-d'),
                            ])" :active="request()->routeIs('Sales_Report')">
                                {{ __('Reports') }}
                            </x-nav-link>
                            @if (Auth::user()->user_type === 'ADMIN')
                                <div class="hidden sm:flex sm:items-center sm:ms-6">
                                    <x-dropdown align="left" width="48">
                                        <x-slot name="trigger">
                                            <button
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                <div> {{ __('Maintenance') }}</div>

                                                <div class="ms-1">
                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            {{-- <x-dropdown-link :href="route('Register-Item')" :active="request()->routeIs('Register-Item')">
                                    {{ __('Sugar Level Settings') }}
                                </x-dropdown-link> --}}
                                            <x-dropdown-link :href="route('Account')" :active="request()->routeIs('Account')">
                                                {{ __('Accounts') }}
                                            </x-dropdown-link>
                                            <x-dropdown-link :href="route('Archived')" :active="request()->routeIs('Archived')">
                                                {{ __('Archived') }}
                                            </x-dropdown-link>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                            @else
                                <div class="hidden sm:flex sm:items-center sm:ms-6">
                                    <x-dropdown align="left" width="48">
                                        <x-slot name="trigger">
                                            <button
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-50 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                <div> {{ __('Maintenance') }}</div>

                                                <div class="ms-1">
                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            {{-- <x-dropdown-link :href="route('Register-Item')" :active="request()->routeIs('Register-Item')">
                                {{ __('Sugar Level Settings') }}
                            </x-dropdown-link> --}}
                                            <x-dropdown-link :href="route('Archived')" :active="request()->routeIs('Archived')">
                                                {{ __('Archived') }}
                                            </x-dropdown-link>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                            @endif
                        @endif
                    </div>
            </div>

            @endif
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>






            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
