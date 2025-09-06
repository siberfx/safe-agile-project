<header class="bg-white border-b border-gray-200 px-6 py-4">
    <div class="flex items-center justify-between">
        {{-- Left Section: Title --}}
        <div class="flex items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                <p class="text-sm text-gray-600 mt-1">Overzicht van Project Woo-voorziening</p>
            </div>
        </div>

        {{-- Center Section: Search & Quick Actions --}}
        <div class="flex items-center space-x-4 flex-1 max-w-2xl mx-8">
            {{-- Search Bar --}}
            <div class="relative flex-1" x-data="{
                            searchOpen: false,
                            searchQuery: '',
                            searchResults: [],
                            get suggestions() {
                                return window.vueApp ? window.vueApp.suggestions : [
                                    { type: 'service', title: 'Building Permit', icon: 'fa-hard-hat', category: 'Planning' },
                                    { type: 'project', title: 'Road Construction', icon: 'fa-road', category: 'Infrastructure' },
                                    { type: 'citizen', title: 'John Smith', icon: 'fa-user', category: 'Resident' },
                                    { type: 'department', title: 'Public Works', icon: 'fa-building', category: 'Administration' }
                                ];
                            },
                            get shortcuts() {
                                return window.vueApp ? window.vueApp.shortcuts : [
                                    { key: '/service', description: 'Search services only' },
                                    { key: '/project', description: 'Search projects only' },
                                    { key: '/citizen', description: 'Search citizens only' },
                                    { key: '/dept', description: 'Search departments only' }
                                ];
                            }
                        }"
                 @keydown.escape="searchOpen = false"
                 @click.away="searchOpen = false"
                 @focusout="setTimeout(() => searchOpen = false, 100)">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fa-solid fa-search text-gray-400 text-sm"></i>
                </div>
                <input type="text"
                       id="searchInput"
                       x-model="searchQuery"
                       @focus="searchOpen = true"
                       @input="searchOpen = true"
                       placeholder="Search services, projects, citizens..."
                       class="w-full pl-10 pr-4 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <kbd class="text-xs text-gray-400 bg-gray-100 px-2 py-1 rounded border">Ctrl+K</kbd>
                </div>

                {{-- Search Dropdown --}}
                <div x-show="searchOpen"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform translate-y-2"
                     class="absolute top-full left-0 right-0 mt-2 bg-white rounded-xl shadow-xl border border-gray-200 z-50 max-h-96 overflow-hidden">

                    {{-- Search Results or Suggestions --}}
                    <div class="p-4">
                        {{-- Shortcuts Section --}}
                        <div x-show="searchQuery.startsWith('/')" class="mb-4">
                            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">QUICK FILTERS</h4>
                            <div class="space-y-2">
                                <template x-for="shortcut in shortcuts" :key="shortcut.key">
                                    <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-lg cursor-pointer group">
                                        <div class="flex items-center space-x-3">
                                            <kbd class="text-xs bg-primary/10 text-primary px-2 py-1 rounded font-mono" x-text="shortcut.key"></kbd>
                                            <span class="text-sm text-gray-700" x-text="shortcut.description"></span>
                                        </div>
                                        <i class="fa-solid fa-arrow-right text-gray-400 group-hover:text-primary text-xs"></i>
                                    </div>
                                </template>
                            </div>
                        </div>

                        {{-- Suggestions Section --}}
                        <div x-show="!searchQuery.startsWith('/') && searchQuery.length === 0" class="space-y-4">
                            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">POPULAR SEARCHES</h4>
                            <div class="grid grid-cols-1 gap-2">
                                <template x-for="suggestion in suggestions" :key="suggestion.title">
                                    <div class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-lg cursor-pointer group">
                                        <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center">
                                            <i class="fa-solid" :class="suggestion.icon" class="text-primary text-sm"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-900" x-text="suggestion.title"></p>
                                            <p class="text-xs text-gray-500" x-text="suggestion.category"></p>
                                        </div>
                                        <i class="fa-solid fa-arrow-right text-gray-400 group-hover:text-primary text-xs"></i>
                                    </div>
                                </template>
                            </div>
                        </div>

                        {{-- Search Results --}}
                        <div x-show="searchQuery.length > 0 && !searchQuery.startsWith('/')" class="space-y-2">
                            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">SEARCH RESULTS</h4>
                            <div class="space-y-2">
                                <div class="p-3 bg-primary/5 border border-primary/20 rounded-lg">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center">
                                            <i class="fa-solid fa-search text-primary text-sm"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-900">Searching for "<span x-text="searchQuery"></span>"</p>
                                            <p class="text-xs text-gray-500">Press Enter to see all results</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span>Press <kbd class="bg-white px-1 py-0.5 rounded border text-gray-600">Esc</kbd> to close</span>
                            <span>Use <kbd class="bg-white px-1 py-0.5 rounded border text-gray-600">/</kbd> for filters</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- New Item Button --}}
            <div x-data="{ dropdownOpen: false }" class="relative">
                <button @click="dropdownOpen = !dropdownOpen" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Nieuw item
                </button>
                
                <div x-show="dropdownOpen" @click.away="dropdownOpen = false" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
                    <a href="{{ route('admin.businessdoelen.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-bullseye mr-2"></i>
                        Nieuw Businessdoel
                    </a>
                    <a href="{{ route('admin.mijn-taken.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-clipboard-list mr-2"></i>
                        Nieuwe Taak
                    </a>
                    <a href="{{ route('admin.risicos-knelpunten.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Nieuw Risico/Knelpunt
                    </a>
                    <a href="{{ route('admin.rapportages.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-file-alt mr-2"></i>
                        Nieuwe Rapportage
                    </a>
                </div>
            </div>
        </div>

        {{-- Right Section: Notifications & Profile --}}
        <div class="flex items-center space-x-3">
            {{-- Action Buttons --}}
            <div class="flex items-center space-x-2">
                <button class="p-3 text-gray-500 hover:text-primary hover:bg-primary/5 rounded-xl transition-all duration-300 relative group">
                    <i class="fa-solid fa-envelope text-base"></i>
                    <div class="absolute top-2 right-2 w-2.5 h-2.5 bg-red-500 rounded-full border border-white shadow-sm animate-pulse"></div>
                </button>
                <button class="p-3 text-gray-500 hover:text-primary hover:bg-primary/5 rounded-xl transition-all duration-300 relative group">
                    <i class="fa-solid fa-bell text-base"></i>
                    <div class="absolute top-2 right-2 w-2.5 h-2.5 bg-primary rounded-full border border-white shadow-sm animate-pulse"></div>
                </button>
            </div>

            {{-- Divider --}}
            <div class="w-px h-8 bg-gray-200"></div>

            {{-- Profile Dropdown --}}
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-3 p-2.5 rounded-xl hover:bg-gray-50 transition-all duration-300 cursor-pointer group">
                    <div class="w-9 h-9 bg-gradient-to-br from-primary to-primary/80 rounded-xl flex items-center justify-center shadow-sm group-hover:shadow-md transition-all duration-300">
                        <span class="text-white font-semibold text-sm">{{ auth()->check() ? substr(auth()->user()->name, 0, 2) : 'U' }}</span>
                    </div>
                    <div class="hidden sm:flex flex-col">
                        <span class="text-sm font-semibold text-gray-900">{{ auth()->check() ? auth()->user()->name : 'User' }}</span>
                        <span class="text-xs text-gray-500 font-medium">Administrator</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-gray-400 text-sm group-hover:text-gray-600 transition-colors duration-300" :class="open ? 'rotate-180' : ''"></i>
                </button>

                {{-- Dropdown Menu --}}
                <div x-show="open"
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform translate-y-2"
                     class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-xl border border-gray-200 py-2 z-50">

                    {{-- User Info Header --}}
                    <div class="px-4 py-3 border-b border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-primary to-primary/80 rounded-xl flex items-center justify-center shadow-sm">
                                <span class="text-white font-bold text-lg">{{ auth()->check() ? substr(auth()->user()->name, 0, 2) : 'U' }}</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">{{ auth()->check() ? auth()->user()->name : 'User' }}</p>
                                <p class="text-xs text-gray-500">{{ auth()->check() ? auth()->user()->email : 'user@example.com' }}</p>
                                <p class="text-xs text-primary font-medium">Administrator</p>
                            </div>
                        </div>
                    </div>

                    {{-- Menu Items --}}
                    <div class="py-1">
                        <a href="#" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                            <i class="fa-solid fa-user mr-3 text-gray-400 w-4"></i>
                            My Profile
                        </a>
                        <a href="#" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                            <i class="fa-solid fa-cog mr-3 text-gray-400 w-4"></i>
                            Settings
                        </a>
                        <a href="#" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                            <i class="fa-solid fa-bell mr-3 text-gray-400 w-4"></i>
                            Notifications
                        </a>
                        <a href="#" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                            <i class="fa-solid fa-shield-alt mr-3 text-gray-400 w-4"></i>
                            Security
                        </a>
                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-gray-100 my-1"></div>

                    {{-- Additional Items --}}
                    <div class="py-1">
                        <a href="#" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                            <i class="fa-solid fa-question-circle mr-3 text-gray-400 w-4"></i>
                            Help & Support
                        </a>
                        <a href="#" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                            <i class="fa-solid fa-file-alt mr-3 text-gray-400 w-4"></i>
                            Documentation
                        </a>
                    </div>

                    {{-- Logout --}}
                    <div class="border-t border-gray-100 mt-1 pt-1">
                        <form method="POST" action="{{ route('admin.logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="w-full flex items-center px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                <i class="fa-solid fa-sign-out-alt mr-3 text-red-500 w-4"></i>
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
