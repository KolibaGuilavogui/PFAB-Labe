<nav x-data="{ open: false }" class="bg-green-100 border-b border-green-200">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('admin.dashboard') }}">
                    <x-application-logo class="block h-16 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- Navigation Desktop -->
            <div class="hidden space-x-6 sm:flex sm:items-center sm:flex-1 sm:ms-10">
                
                @if(Auth::user()?->roles?->contains('name', 'admin'))
                    <!-- Dropdown Tableau de bord -->
                    <div class="relative" x-data="{ openDropdown: false }" @mouseleave="openDropdown = false">
                        <button @click="openDropdown = !openDropdown" @mouseenter="openDropdown = true" class="inline-flex items-center gap-1 py-2 text-xs font-semibold uppercase tracking-wide text-slate-700 hover:text-green-800 focus:outline-none transition">
                            <span>{{ __('Tableau de bord') }}</span>
                            <x-heroicon-o-squares-2x2 class="w-4 h-4 shrink-0"/>
                        </button>

                        <div x-show="openDropdown" 
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute left-0 mt-1 w-56 bg-white rounded-lg shadow-lg border border-green-100 z-50 py-1"
                             style="display: none;">
                            <a href="{{ route('admin.statistique-globale') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-800">
                                {{ __('Statistique Globale') }}
                            </a>
                            <a href="{{ route('admin.suivi-financier') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-800">
                                {{ __('Suivi Financier') }}
                            </a>
                        </div>
                    </div>

                    <!-- Dropdown Utilisateurs -->
                    <div class="relative" x-data="{ openDropdown: false }" @mouseleave="openDropdown = false">
                        <button @click="openDropdown = !openDropdown" @mouseenter="openDropdown = true" class="inline-flex items-center gap-1 py-2 text-xs font-semibold uppercase tracking-wide text-slate-700 hover:text-green-800 focus:outline-none transition">
                            <span>{{ __('Utilisateurs') }}</span>
                            <x-heroicon-o-users class="w-4 h-4 shrink-0"/>
                        </button>

                        <div x-show="openDropdown" 
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute left-0 mt-1 w-56 bg-white rounded-lg shadow-lg border border-green-100 z-50 py-1"
                             style="display: none;">
                            <a href="{{ route('admin.users.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-800">
                                {{ __('Ajouter un utilisateur') }}
                            </a>
                            <a href="{{ route('admin.users.gestion') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-800">
                                {{ __('Gestion des comptes') }}
                            </a>
                            <a href="{{ route('admin.users.listes') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-800">
                                {{ __('Listes des utilisateurs') }}
                            </a>
                        </div>
                    </div>

                    <!-- Commandes -->
                    <x-nav-link :href="route('admin.commandes.index')" :active="request()->routeIs('admin.commandes.*')" class="text-slate-700 font-semibold text-xs uppercase tracking-wide">
                        {{ __('Commandes') }}
                        <x-heroicon-o-shopping-cart class="w-4 h-4 shrink-0 ms-1"/>
                    </x-nav-link>

                    <!-- Dropdown Logistique -->
                    <div class="relative" x-data="{ openDropdown: false }" @mouseleave="openDropdown = false">
                        <button @click="openDropdown = !openDropdown" @mouseenter="openDropdown = true" class="inline-flex items-center gap-1 py-2 text-xs font-semibold uppercase tracking-wide text-slate-700 hover:text-green-800 focus:outline-none transition">
                            <span>{{ __('Logistique') }}</span>
                            <x-heroicon-o-truck class="w-4 h-4 shrink-0"/>
                        </button>

                        <div x-show="openDropdown" 
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute left-0 mt-1 w-56 bg-white rounded-lg shadow-lg border border-green-100 z-50 py-1"
                             style="display: none;">
                            <a href="{{ route('admin.logistique.engagement-livraisons') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-800">
                                {{ __('Engagement des livraisons') }}
                            </a>
                            <a href="{{ route('admin.logistique.suivi-etats') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-800">
                                {{ __('Suivi des états') }}
                            </a>
                        </div>
                    </div>

                    <!-- Supervision & Stats -->
                    <x-nav-link :href="route('admin.supervision')" :active="request()->routeIs('admin.supervision')" class="text-slate-700 font-semibold text-xs uppercase tracking-wide">
                        {{ __('Supervision') }}
                        <x-heroicon-o-eye class="w-4 h-4 shrink-0 ms-1"/>
                    </x-nav-link>

                    <x-nav-link :href="route('admin.statistique')" :active="request()->routeIs('admin.statistique')" class="text-slate-700 font-semibold text-xs uppercase tracking-wide">
                        {{ __('Statistiques') }}
                        <x-heroicon-o-chart-bar class="w-4 h-4 shrink-0 ms-1"/>
                    </x-nav-link>
                @endif

                @if(Auth::user()?->roles?->contains('name', 'producteur'))
                    <x-nav-link :href="route('producteur.espaceproducteur')" :active="request()->routeIs('producteur.espaceproducteur')" class="text-slate-700 font-semibold text-xs uppercase tracking-wide">
                        {{ __('Espace personnel') }}
                        <x-heroicon-o-user class="w-4 h-4 shrink-0 ms-1"/>
                    </x-nav-link>
                @endif

                @if(Auth::user()?->roles?->contains('name', 'fournisseur'))
                    <x-nav-link :href="route('fournisseur.espacefournisseur')" :active="request()->routeIs('fournisseur.espacefournisseur')" class="text-slate-700 font-semibold text-xs uppercase tracking-wide">
                        {{ __('Espace personnel') }}
                        <x-heroicon-o-user class="w-4 h-4 shrink-0 ms-1"/>
                    </x-nav-link>
                @endif

                @if(Auth::user()?->roles?->contains('name', 'client'))
                    <x-nav-link :href="route('client.espaceclient')" :active="request()->routeIs('client.espaceclient')" class="text-slate-700 font-semibold text-xs uppercase tracking-wide">
                        {{ __('Espace personnel') }}
                        <x-heroicon-o-user class="w-4 h-4 shrink-0 ms-1"/>
                    </x-nav-link>
                    <x-nav-link :href="route('client.catalogues')" :active="request()->routeIs('client.catalogues')" class="text-slate-700 font-semibold text-xs uppercase tracking-wide">
                        {{ __('Catalogues des récoltes') }}
                        <x-heroicon-o-archive-box class="w-4 h-4 shrink-0 ms-1"/>
                    </x-nav-link>
                    <x-nav-link :href="route('client.panier-commandes')" :active="request()->routeIs('client.panier-commandes')" class="text-slate-700 font-semibold text-xs uppercase tracking-wide">
                        {{ __('Panier & Commandes') }}
                        <x-heroicon-o-shopping-cart class="w-4 h-4 shrink-0 ms-1"/>
                    </x-nav-link>
                @endif
            </div>

            <!-- Profile Dropdown (Desktop) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-green-50 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profil') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Se deconnecter') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Button (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-green-800 hover:bg-green-200 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Navigation Mobile -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-green-100">
        <div class="pt-2 pb-3 space-y-1">
            @if(Auth::user()?->roles?->contains('name', 'admin'))
                <!-- Dropdown Tableau de bord Mobile -->
                <div x-data="{ dashboardOpen: false }">
                    <button @click="dashboardOpen = !dashboardOpen" class="w-full text-left px-4 py-2 text-sm font-medium text-gray-700 hover:bg-green-200 rounded-md flex items-center justify-between">
                        <span class="flex items-center">
                            <x-heroicon-o-squares-2x2 class="w-4 h-4 shrink-0 mr-2" />
                            {{ __('Tableau de bord') }}
                        </span>
                        <svg :class="{'rotate-180': dashboardOpen}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="dashboardOpen" class="pl-6 space-y-1 my-1">
                        <a href="{{ route('admin.statistique-globale') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-200 rounded-md">
                            {{ __('Statistique Globale') }}
                        </a>
                        <a href="{{ route('admin.suivi-financier') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-200 rounded-md">
                            {{ __('Suivi Financier') }}
                        </a>
                    </div>
                </div>

                <!-- Dropdown Utilisateurs Mobile -->
                <div x-data="{ usersOpen: false }">
                    <button @click="usersOpen = !usersOpen" class="w-full text-left px-4 py-2 text-sm font-medium text-gray-700 hover:bg-green-200 rounded-md flex items-center justify-between">
                        <span class="flex items-center">
                            <x-heroicon-o-users class="w-4 h-4 shrink-0 mr-2" />
                            {{ __('Utilisateurs') }}
                        </span>
                        <svg :class="{'rotate-180': usersOpen}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="usersOpen" class="pl-6 space-y-1 my-1">
                        <a href="{{ route('admin.users.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-200 rounded-md">
                            {{ __('Ajouter un utilisateur') }}
                        </a>
                        <a href="{{ route('admin.users.gestion') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-200 rounded-md">
                            {{ __('Gestion des comptes') }}
                        </a>
                        <a href="{{ route('admin.users.listes') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-200 rounded-md">
                            {{ __('Listes des utilisateurs') }}
                        </a>
                    </div>
                </div>

                <x-responsive-nav-link :href="route('admin.commandes.index')" :active="request()->routeIs('admin.commandes.*')">
                    {{ __('Commandes') }}
                    <x-heroicon-o-shopping-cart class="w-4 h-4 shrink-0 ms-2 inline" />
                </x-responsive-nav-link>

                <!-- Dropdown Logistique Mobile -->
                <div x-data="{ logistiqueOpen: false }">
                    <button @click="logistiqueOpen = !logistiqueOpen" class="w-full text-left px-4 py-2 text-sm font-medium text-gray-700 hover:bg-green-200 rounded-md flex items-center justify-between">
                        <span class="flex items-center">
                            <x-heroicon-o-truck class="w-4 h-4 shrink-0 mr-2" />
                            {{ __('Logistique') }}
                        </span>
                        <svg :class="{'rotate-180': logistiqueOpen}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="logistiqueOpen" class="pl-6 space-y-1 my-1">
                        <a href="{{ route('admin.logistique.engagement-livraisons') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-200 rounded-md">
                            {{ __('Engagement des livraisons') }}
                        </a>
                        <a href="{{ route('admin.logistique.suivi-etats') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-200 rounded-md">
                            {{ __('Suivi des états') }}
                        </a>
                    </div>
                </div>

                <x-responsive-nav-link :href="route('admin.supervision')" :active="request()->routeIs('admin.supervision')">
                    {{ __('Supervision') }}
                    <x-heroicon-o-eye class="w-4 h-4 shrink-0 ms-2 inline" />
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.statistique')" :active="request()->routeIs('admin.statistique')">
                    {{ __('Statistiques') }}
                    <x-heroicon-o-chart-bar class="w-4 h-4 shrink-0 ms-2 inline" />
                </x-responsive-nav-link>
            @endif

            @if(Auth::user()?->roles?->contains('name', 'producteur'))
                <x-responsive-nav-link :href="route('producteur.espaceproducteur')" :active="request()->routeIs('producteur.espaceproducteur')">
                    {{ __('Espace personnel') }}
                    <x-heroicon-o-user class="w-4 h-4 shrink-0 ms-2 inline" />
                </x-responsive-nav-link>
            @endif

            @if(Auth::user()?->roles?->contains('name', 'fournisseur'))
                <x-responsive-nav-link :href="route('fournisseur.espacefournisseur')" :active="request()->routeIs('fournisseur.espacefournisseur')">
                    {{ __('Espace personnel') }}
                    <x-heroicon-o-user class="w-4 h-4 shrink-0 ms-2 inline" />
                </x-responsive-nav-link>
            @endif

            @if(Auth::user()?->roles?->contains('name', 'client'))
                <x-responsive-nav-link :href="route('client.espaceclient')" :active="request()->routeIs('client.espaceclient')">
                    {{ __('Espace personnel') }}
                    <x-heroicon-o-user class="w-4 h-4 shrink-0 ms-2 inline" />
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('client.catalogues')" :active="request()->routeIs('client.catalogues')">
                    {{ __('Catalogues des récoltes') }}
                    <x-heroicon-o-archive-box class="w-4 h-4 shrink-0 ms-2 inline" />
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('client.panier-commandes')" :active="request()->routeIs('client.panier-commandes')">
                    {{ __('Panier & Commandes') }}
                    <x-heroicon-o-shopping-cart class="w-4 h-4 shrink-0 ms-2 inline" />
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Paramètres Profil Mobile -->
        <div class="pt-4 pb-1 border-t border-green-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-600">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profil') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Se deconnecter') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>