<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full" data-theme="true" data-theme-mode="light" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', 'Sign in page using Tailwind CSS')">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Welcomy')</title>

    <!-- Open Graph / Twitter -->
    <meta name="robots" content="follow, index">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@keenthemes">
    <meta name="twitter:creator" content="@keenthemes">
    <meta name="twitter:title" content="@yield('title', 'Welcomy')">
    <meta name="twitter:description" content="@yield('meta_description')">
    <meta name="twitter:image" content="{{ asset('assets/media/app/og-image.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Metronic">
    <meta property="og:title" content="@yield('title', 'Welcomy')">
    <meta property="og:description" content="@yield('meta_description')">
    <meta property="og:image" content="{{ asset('assets/media/app/og-image.png') }}">

    <!-- Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/media/app/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/media/app/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/media/app/favicon-16x16.png') }}">
    <link rel="shortcut icon" href="{{ asset('assets/media/app/favicon.ico') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @livewireStyles
    <!-- Vendor Styles -->
    <link href="{{ asset('assets/vendors/apexcharts/apexcharts.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/keenicons/styles.bundle.css') }}" rel="stylesheet">

    <!-- Metronic Styles -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    <!-- Head -->
    @stack('styles')



</head>
<body class="antialiased flex h-full text-base text-gray-700 [--tw-page-bg:var(--tw-light)] [--tw-page-bg-dark:var(--tw-coal-500)] [--tw-header-height-default:100px] [[data-sticky-header=on]&]:[--tw-header-height:60px] [--tw-header-height:--tw-header-height-default] bg-[--tw-page-bg] dark:bg-[--tw-page-bg-dark]">


  <!-- Theme Mode -->
  <script>
   const defaultThemeMode = 'light'; // light|dark|system
		let themeMode;

		if ( document.documentElement ) {
			if ( localStorage.getItem('theme')) {
					themeMode = localStorage.getItem('theme');
			} else if ( document.documentElement.hasAttribute('data-theme-mode')) {
				themeMode = document.documentElement.getAttribute('data-theme-mode');
			} else {
				themeMode = defaultThemeMode;
			}

			if (themeMode === 'system') {
				themeMode = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
			}

			document.documentElement.classList.add(themeMode);
		}
  </script>
  <!-- End of Theme Mode -->

    <!-- Main Content -->
    @yield('content')

    <!-- Scripts -->
    <script src="{{ asset('assets/js/core.bundle.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script> --}}
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
// Simplified CKEditor Manager - μόνο initialization
window.CKEditorManager = {
    instances: {},

    findEditors: function() {
        return document.querySelectorAll('textarea.ckeditor');
    },

    destroyEditor: function(editorId) {
        if (CKEDITOR.instances[editorId]) {
            console.log(`🗑️ Destroying existing instance: ${editorId}`);
            CKEDITOR.instances[editorId].destroy(true);
            delete this.instances[editorId];
        }
    },

    createEditor: function(textarea) {
        const editorId = textarea.id;

        if (!editorId) {
            console.warn('⚠️ Textarea without ID found, skipping');
            return;
        }

        console.log(`🚀 Creating CKEditor for: ${editorId}`);
        this.destroyEditor(editorId);

        CKEDITOR.replace(editorId, {
            height: 200,
            removePlugins: 'uploadimage,uploadwidget,filetools,filebrowser,image,pastetools,pastefromword,pastefromgdocs,pastefromlibreoffice,pastetext,anchor',
            on: {
                instanceReady: function() {
                    console.log(`✅ CKEditor ready: ${editorId}`);
                }
            }
        });

        this.instances[editorId] = true;
    },

    initializeAll: function() {
        console.log('🔍 Searching for CKEditor textareas...');
        const textareas = this.findEditors();
        console.log(`📝 Found ${textareas.length} CKEditor textareas`);
        textareas.forEach((textarea) => {
            this.createEditor(textarea);
        });
    },

    delayedInit: function(delay = 300) {
        setTimeout(() => {
            this.initializeAll();
        }, delay);
    }
};

// Event Listeners - μόνο για initialization
document.addEventListener('DOMContentLoaded', function() {
    CKEditorManager.delayedInit(500);
});

document.addEventListener('livewire:load', function() {
    CKEditorManager.delayedInit(300);
});

document.addEventListener('livewire:update', function() {
    CKEditorManager.delayedInit(200);
});

window.addEventListener('init-ckeditor-amenities', function() {
    CKEditorManager.delayedInit(100);
});

window.addEventListener('init-ckeditor-before-you-go', function() {
    CKEditorManager.delayedInit(100);
});

document.addEventListener('visibilitychange', function() {
    if (!document.hidden) {
        CKEditorManager.delayedInit(100);
    }
});
</script>
    @stack('scripts')
    @livewireScripts

</body>
</html>
