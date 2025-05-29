 <div class="border-b border-gray-200 pb-5 lg:pb-0 mb-5 lg:mb-10">
    <!-- Container -->
    <div class="container-fixed flex flex-wrap justify-between items-center gap-2">
     <div class="grid">
      <div class="scrollable-x-auto">
       <div class="menu gap-5 lg:gap-7.5" data-menu="true">
        <div class="menu-item border-b-2 border-b-transparent menu-item-active:border-b-gray-900 menu-item-here:border-b-gray-900">
         <a class="menu-link gap-2.5 pb-2 lg:pb-4" href="{{ route('dashboard') }}" tabindex="0">
          <span class="menu-title text-nowrap text-sm text-gray-800 menu-item-active:text-gray-900 menu-item-active:font-medium menu-item-here:text-gray-900 menu-item-here:font-medium menu-item-show:text-gray-900 menu-link-hover:text-gray-900">
           My Dashboard
          </span>
         </a>
        </div>
            <div class="menu-item border-b-2 border-b-transparent menu-item-active:border-b-gray-900 menu-item-here:border-b-gray-900"
                data-menu-item-placement="bottom-start" data-menu-item-placement-rtl="bottom-end"
                data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:hover">
            <div class="menu-link gap-1.5 pb-2 lg:pb-4" tabindex="0">
                <span class="menu-title text-nowrap text-sm text-gray-800 menu-item-active:text-gray-900 menu-item-active:font-medium menu-item-here:text-gray-900 menu-item-here:font-medium menu-item-show:text-gray-900 menu-link-hover:text-gray-900">
                My Properties
                </span>
                <span class="menu-arrow">
                <i class="ki-filled ki-down text-2xs text-gray-500"></i>
                </span>
            </div>

            <div class="menu-dropdown menu-default py-2 min-w-[200px]">
                @forelse(auth()->user()->properties as $property)
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('properties.edit', $property) }}" tabindex="0">
                    <span class="menu-title">
                        {{ $property->name }}
                    </span>
                    </a>
                </div>
                @empty
                <div class="menu-item">
                    <span class="menu-link text-gray-500" tabindex="0">
                    <span class="menu-title">No properties yet</span>
                    </span>
                </div>
                @endforelse
            </div>
            </div>
       </div>
      </div>
     </div>
     <div class="flex items-center text-2sm text-gray-800 gap-5 lg:pb-4">
      <a class="hover:text-primary" href="#">
       Support
      </a>
     </div>
    </div>
    <!-- End of Container -->
   </div>
