  <header class="flex items-center transition-[height] shrink-0 bg-[--tw-page-bg] dark:bg-[--tw-page-bg-dark] h-[--tw-header-height]" data-sticky="true" data-sticky-class="transition-[height] fixed z-10 top-0 left-0 right-0 shadow-sm backdrop-blur-md bg-white/70 dark:bg-coal-500/70 dark:border-b dark:border-b-coal-100" data-sticky-name="header" data-sticky-offset="200px" id="header">
    <!-- Container -->
    <div class="container-fixed flex justify-between items-center lg:gap-4" id="header_container">
     <!-- Logo -->
     <div class="flex items-center gap-2 lg:gap-5 2xl:-ml-[60px]">
      <a href="{{route('dashboard')}}">
       <img class="dark:hidden max-w-[40px] logo" src="{{ asset('assets/media/logos/welcomy-icon.jpg') }}"/>
       <img class="hidden dark:inline-block min-h-[42px]" src="assets/media/app/mini-logo-circle-dark.svg"/>
      </a>
      <div class="flex items-center">
       <h3 class="text-gray-700 text-base hidden md:block">
        Welcomy
       </h3>
       <span class="text-sm text-gray-400 font-medium px-2.5 hidden md:inline">
        /
       </span>
       <div class="menu menu-default" data-menu="true">
        <div class="menu-item" data-menu-item-offset="0, 10px" data-menu-item-placement="bottom-start" data-menu-item-toggle="dropdown" data-menu-item-trigger="hover">
         <button class="menu-toggle text-gray-900 font-medium">
          Account
          <span class="menu-arrow">
           <i class="ki-filled ki-down">
           </i>
          </span>
         </button>
         <div class="menu-dropdown menu-default w-48">
          <div class="menu-item">
           <a class="menu-link" href="html/demo2/public-profile/profiles/default.html" tabindex="0">
            <span class="menu-icon">
             <i class="ki-filled ki-profile-circle">
             </i>
            </span>
            <span class="menu-title">
             Public Profile
            </span>
           </a>
          </div>
          <div class="menu-item active">
           <a class="menu-link" href="html/demo2.html" tabindex="0">
            <span class="menu-icon">
             <i class="ki-filled ki-setting-2">
             </i>
            </span>
            <span class="menu-title">
             Account
            </span>
           </a>
          </div>
          <div class="menu-item">
           <a class="menu-link" href="html/demo2/network/get-started.html" tabindex="0">
            <span class="menu-icon">
             <i class="ki-filled ki-users">
             </i>
            </span>
            <span class="menu-title">
             Network
            </span>
           </a>
          </div>
          <div class="menu-item">
           <a class="menu-link" href="html/demo2/authentication/get-started.html" tabindex="0">
            <span class="menu-icon">
             <i class="ki-filled ki-security-user">
             </i>
            </span>
            <span class="menu-title">
             Authentication
            </span>
           </a>
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
     <!-- End of Logo -->
     <!-- Topbar -->
     <div class="flex items-center gap-3.5">
      <div class="flex items-center gap-1">
      </div>
      <div class="menu" data-menu="true">
       <div class="menu-item" data-menu-item-offset="20px, 10px" data-menu-item-offset-rtl="-20px, 10px" data-menu-item-placement="bottom-end" data-menu-item-placement-rtl="bottom-start" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
        <div class="menu-toggle btn btn-icon rounded-full">
         <img alt="" class="size-9 rounded-full justify-center border border-gray-500 shrink-0" src="assets/media/avatars/gray/5.png">
         </img>
        </div>
        <div class="menu-dropdown menu-default light:border-gray-300 w-screen max-w-[250px]">
         <div class="flex items-center justify-between px-5 py-1.5 gap-1.5">
          <div class="flex items-center gap-2">
           <img alt="" class="size-9 rounded-full border-2 border-success" src="assets/media/avatars/300-2.png">
            <div class="flex flex-col gap-1.5">
             <span class="text-sm text-gray-800 font-semibold leading-none">
                {{ auth()->user()->name }}
             </span>
             <a class="text-xs text-gray-600 hover:text-primary font-medium leading-none" href="#">
                {{ auth()->user()->email }}
             </a>
            </div>
           </img>
          </div>
         </div>
         <div class="menu-separator">
         </div>
         <div class="flex flex-col">
          <div class="menu-item">
           <a class="menu-link" href="route('profile.edit')">
            <span class="menu-icon">
             <i class="ki-filled ki-profile-circle">
             </i>
            </span>
            <span class="menu-title">
             My Profile
            </span>
           </a>
          </div>

          <div class="menu-item" data-menu-item-offset="-10px, 0" data-menu-item-placement="left-start" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:hover">
           <div class="menu-link">
            <span class="menu-icon">
             <i class="ki-filled ki-icon">
             </i>
            </span>
            <span class="menu-title">
             Language
            </span>
            <div class="flex items-center gap-1.5 rounded-md border border-gray-300 text-gray-600 p-1.5 text-2xs font-medium shrink-0">
             English
             <img alt="" class="inline-block size-3.5 rounded-full" src="assets/media/flags/united-states.svg"/>
            </div>
           </div>
           <div class="menu-dropdown menu-default light:border-gray-300 w-full max-w-[170px]">
            <div class="menu-item active">
             <a class="menu-link h-10" href="?dir=ltr">
              <span class="menu-icon">
               <img alt="" class="inline-block size-4 rounded-full" src="assets/media/flags/united-states.svg"/>
              </span>
              <span class="menu-title">
               English
              </span>
              <span class="menu-badge">
               <i class="ki-solid ki-check-circle text-success text-base">
               </i>
              </span>
             </a>
            </div>
           </div>
          </div>
         </div>
         <div class="menu-separator">
         </div>
         <div class="flex flex-col">
          <div class="menu-item mb-0.5">
           <div class="menu-link">
            <span class="menu-icon">
             <i class="ki-filled ki-moon">
             </i>
            </span>
            <span class="menu-title">
             Dark Mode
            </span>
            <label class="switch switch-sm">
             <input data-theme-state="dark" data-theme-toggle="true" name="check" type="checkbox" value="1"/>
            </label>
           </div>
          </div>
          <div class="menu-item px-4 py-1.5">
           <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="btn btn-sm btn-light justify-center">
                Log out
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
     <!-- End of Topbar -->
    </div>
    <!-- End of Container -->
   </header>
