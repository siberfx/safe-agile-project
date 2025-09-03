<div class="w-64 bg-white border-r border-gray-200 shadow-sm">
    <div class="p-4">
        {{-- Logo Section --}}
        <div class="flex items-center space-x-3 mb-6">
            <div class="flex flex-col">
                <h1 class="text-lg font-bold text-gray-900">OPUB</h1>
                <span class="text-xs text-gray-500 font-medium">Admin Panel</span>
            </div>
        </div>

        {{-- Dynamic Menu Sections --}}
        @foreach($sidebarMenus as $menuSection)
            <div class="mb-6">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3 px-1">{{ $menuSection['title'] }}</h3>
                <nav class="space-y-0.5">
                    @foreach($menuSection['items'] as $menuItem)
                        @if(isset($menuItem['hasSubmenu']) && $menuItem['hasSubmenu'])
                            {{-- Menu item with submenu --}}
                            <div x-data="{ submenuOpen: {{ isset($menuItem['isSubmenuOpen']) && $menuItem['isSubmenuOpen'] ? 'true' : 'false' }} }" class="space-y-0.5">
                                <button @click="submenuOpen = !submenuOpen"
                                        class="w-full flex items-center justify-between px-3 py-2.5 rounded-md transition-all duration-200 group
                                           @if(isset($menuItem['isSubmenuOpen']) && $menuItem['isSubmenuOpen'])
                                               bg-primary text-white shadow-sm
                                           @else
                                               text-gray-600 hover:bg-[#154273]/30 hover:text-[#154273]
                                           @endif">
                                    <div class="flex items-center space-x-2.5">
                                        <i class="fa-solid {{ $menuItem['icon'] }} text-sm
                                          @if(isset($menuItem['isSubmenuOpen']) && $menuItem['isSubmenuOpen'])
                                              text-white
                                          @else
                                              text-gray-500 group-hover:text-[#154273]
                                          @endif"></i>
                                        <span class="text-sm font-medium">{{ $menuItem['name'] }}</span>
                                    </div>
                                    <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200
                                          @if(isset($menuItem['isSubmenuOpen']) && $menuItem['isSubmenuOpen'])
                                              text-white
                                          @else
                                              text-gray-500 group-hover:text-[#154273]
                                          @endif"
                                       :class="{ 'rotate-180': submenuOpen }"></i>
                                </button>

                                {{-- Submenu --}}
                                <div x-show="submenuOpen"
                                     x-cloak
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                                     x-transition:enter-end="opacity-100 transform translate-y-0"
                                     class="pl-4 space-y-0.5 bg-primary/5 rounded-md p-2">
                                    @foreach($menuItem['submenu'] as $subItem)
                                        @if(isset($subItem['type']) && $subItem['type'] === 'subsection')
                                            {{-- Subsection with title --}}
                                            <div class="mb-2">
                                                <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5 px-1">{{ $subItem['title'] }}</h4>
                                                <div class="space-y-0.5">
                                                    @foreach($subItem['items'] as $subsectionItem)
                                                        <a href="{{ $subsectionItem['route'] === '#' ? '#' : route($subsectionItem['route']) }}"
                                                           class="flex items-center space-x-2.5 px-2.5 py-1.5 rounded-md transition-all duration-200 group
                                                          @if(isset($subsectionItem['isActive']) && $subsectionItem['isActive'])
                                                              bg-[#154273]/60 text-white shadow-sm
                                                          @else
                                                              text-gray-600 hover:bg-[#154273]/30 hover:text-[#154273]
                                                          @endif">
                                                            <i class="fa-solid {{ $subsectionItem['icon'] }} text-xs
                                                          @if(isset($subsectionItem['isActive']) && $subsectionItem['isActive'])
                                                              text-white
                                                          @else
                                                              text-gray-500 group-hover:text-[#154273]
                                                          @endif"></i>
                                                            <span class="text-xs font-medium">{{ $subsectionItem['name'] }}</span>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else
                                            {{-- Regular submenu item --}}
                                            <a href="{{ $subItem['route'] === '#' ? '#' : route($subItem['route']) }}"
                                               class="flex items-center space-x-2.5 px-2.5 py-1.5 rounded-md transition-all duration-200 group
                                                  @if(isset($subItem['isActive']) && $subItem['isActive'])
                                                      bg-[#154273]/60 text-white shadow-sm
                                                  @else
                                                      text-gray-600 hover:bg-[#154273]/30 hover:text-[#154273]
                                                  @endif">
                                                <i class="fa-solid {{ $subItem['icon'] }} text-xs
                                                  @if(isset($subItem['isActive']) && $subItem['isActive'])
                                                      text-white
                                                  @else
                                                      text-gray-500 group-hover:text-[#154273]
                                                  @endif"></i>
                                                <span class="text-xs font-medium">{{ $subItem['name'] }}</span>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @else
                            {{-- Regular menu item --}}
                            <a href="{{ $menuItem['route'] === '#' ? '#' : route($menuItem['route']) }}"
                               class="flex items-center space-x-2.5 px-3 py-2.5 rounded-md transition-all duration-200 group
                                  @if(isset($menuItem['isActive']) && $menuItem['isActive'])
                                      bg-primary text-white shadow-sm
                                  @else
                                      text-gray-600 hover:bg-[#154273]/30 hover:text-[#154273]
                                  @endif">
                                <i class="fa-solid {{ $menuItem['icon'] }} text-sm
                                  @if(isset($menuItem['isActive']) && $menuItem['isActive'])
                                      text-white
                                  @else
                                      text-gray-500 group-hover:text-[#154273]
                                  @endif"></i>
                                <span class="text-sm font-medium">{{ $menuItem['name'] }}</span>
                            </a>
                        @endif
                    @endforeach
                </nav>
            </div>
        @endforeach

        {{-- Quick Stats Card --}}
        <div class="bg-gray-50 rounded-lg p-3 border border-gray-200">
            <div class="flex items-center space-x-2 mb-2">
                <i class="fa-solid fa-chart-pie text-[#154273] text-xs"></i>
                <span class="font-semibold text-gray-900 text-xs">Quick Stats</span>
            </div>
            <div class="space-y-1.5 mb-2">
                <div class="flex justify-between text-xs">
                    <span class="text-gray-600">Active Projects</span>
                    <span class="font-medium text-[#154273]">24</span>
                </div>
                <div class="flex justify-between text-xs">
                    <span class="text-gray-600">Pending Requests</span>
                    <span class="font-medium text-[#154273]">18</span>
                </div>
            </div>
            <button class="w-full bg-[#154273] text-white py-1.5 px-2 rounded-md text-xs font-medium hover:bg-[#154273]/90 transition-colors duration-200">
                View Details
            </button>
        </div>
    </div>
</div>

