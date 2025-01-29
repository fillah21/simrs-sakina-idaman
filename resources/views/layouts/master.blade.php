<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ $title }}</title>
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
            rel="stylesheet"
        />
        <meta name="base-url" id="base-url" content="{{ asset('') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href={{ asset("windmill-template/public/assets/css/tailwind.output.css") }} />
        <link rel="stylesheet" href={{ asset("css/style.css") }} />
        <link href="{{ asset('js/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
        <script
            src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
            defer
        ></script>
        <script src={{ asset("js/jquery.js") }}></script>
        <script src={{ asset("windmill-template/public/assets/js/init-alpine.js") }}></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.tailwindcss.css">
        <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">

        {{-- <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
        />
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
            defer
        ></script>
        <script src="./assets/js/charts-lines.js" defer></script>
        <script src="./assets/js/charts-pie.js" defer></script> --}}
        @stack('style')
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body>
        <div
            class="flex h-screen bg-gray-50 dark:bg-gray-900"
            :class="{ 'overflow-hidden': isSideMenuOpen }"
        >
            @include('layouts.sidebar')
            
            <div class="flex flex-col flex-1 w-full">
                @include('layouts.navbar')

                <main class="h-full overflow-y-auto">
                    <div class="container px-6 mx-auto grid">
                        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                            {{ $title }}
                        </h2>

                        @yield('content')
                    </div>
                </main>
            </div>
        </div>

        <script>
            let baseUrl = window.baseUrl;

            if (!baseUrl) {
                baseUrl = document.getElementById('base-url').getAttribute('content');
            }
        </script>
        {{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> --}}
        <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.2.1/js/dataTables.tailwindcss.js"></script>
        <script src="https://cdn.tailwindcss.com/"></script>

        <script src="{{ asset('js/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('js/helper.js') }}"></script>
        @stack('script')
    </body>
</html>
