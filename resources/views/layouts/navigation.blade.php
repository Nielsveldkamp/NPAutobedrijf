<style>
    @media (max-width: 1024px){
    .hidden{ display :none;}
    }
    @media (min-width: 1024px){
    .small\:hidden{ display :none;}
    }
    .mr-64{
        margin-right:6rem;
    }
</style>
<nav x-data="{ open: false }" class="bg-gray-800 w-full">
    <!-- Primary Navigation Menu -->
    <div class=" mx-auto sm:pr-4 lg:pr-64">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0  items-center">
                    <a href="{{ route('main') }}">
                        <x-application-logo class="block h-10 w-auto fill-current" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('main')" :active="request()->routeIs('main')">
                        {{ __('Home') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('auto.index')" :active="request()->routeIs('auto.index')">
                        {{ __('Autos') }}
                    </x-nav-link>
                </div>
                @auth
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('auto.create')" :active="request()->routeIs('auto.create')">
                        {{ __('Auto toevoegen') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('tekst.update')" :active="request()->routeIs('tekst.update')">
                        {{ __('Home Page aanpassen') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('contactGegevens.update')" :active="request()->routeIs('contactGegevens.update')">
                        {{ __('Contact gegevens aanpassen') }}
                    </x-nav-link>
                </div>
                @endauth
            </div>
            <!-- Settings Dropdown -->
            @auth
                <div class="hidden sm:flex sm:items-center mr-64 sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium focus:outline-none  text-white">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
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
            @else
                <div class="hidden space-x-8 sm:-my-px mr-64 sm:ml-10 sm:flex">
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        {{ __('Log in') }}
                    </x-nav-link>
                </div>
            @endauth

            <!-- Hamburger -->
            <div class="mr-2 flex items-center small:hidden">
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
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden small:hidden">
        <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('main')" :active="request()->routeIs('main')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('auto.index')" :active="request()->routeIs('auto.index')">
                {{ __('autos') }}
            </x-responsive-nav-link>
            @auth
            <x-responsive-nav-link :href="route('auto.create')" :active="request()->routeIs('auto.create')">
                {{ __('auto toevoegen') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tekst.update')" :active="request()->routeIs('tekst.update')">
                {{ __('Home Page aanpassen') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contactGegevens.update')" :active="request()->routeIs('contactGegevens.update')">
                {{ __('Contact gegevens aanpassen') }}
            </x-responsive-nav-link>
            @endauth
        </div>


        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-white">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
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
        @else
            <x-responsive-nav-link href="{{ route('login') }}">
                Log in
                </x-responsive-nav-linka>
            @endauth
            <!-- searchbar -->
            <div x-data="{ searchOpen: false }" >
                <button  @click="searchOpen = ! searchOpen"
                    class="ml-3 inline-flex items-center justify-center p-2 rounded-md text-gray-200 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <div :class="{ 'hidden': searchOpen, 'inline-flex': !searchOpen }">
                        Zoek
                    </div>
                    <div  :class="{ 'hidden': !searchOpen, 'inline-flex': searchOpen }">
                        Zoek X
                    </div>
                </button>
                <div :class="{ 'block': searchOpen, 'hidden': !searchOpen }" class="hidden small:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <x-search-bar view='-small' ></x-search-bar>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</nav>
