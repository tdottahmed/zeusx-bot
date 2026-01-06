<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ZeusX') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 h-full">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-zeus-deep via-zeus-vibrant to-zeus-deep relative overflow-hidden">
            
            <!-- Decorative Background Elements -->
             <div class="absolute top-0 left-0 -translate-x-1/2 -translate-y-1/2 w-96 h-96 rounded-full bg-zeus-pink/20 blur-3xl pointer-events-none"></div>
             <div class="absolute bottom-0 right-0 translate-x-1/3 translate-y-1/3 w-[500px] h-[500px] rounded-full bg-zeus-gold/10 blur-3xl pointer-events-none"></div>

            <div class="relative z-10 w-full sm:max-w-md mt-6 px-6 py-8 bg-gray-900/80 backdrop-blur-md shadow-2xl overflow-hidden sm:rounded-2xl border border-white/10 ring-1 ring-black/5">
                <div class="flex justify-center mb-8">
                     <a href="/" class="text-3xl font-black tracking-tighter text-white">
                        ZEUS<span class="text-zeus-pink">X</span> <span class="text-sm font-medium tracking-normal text-gray-400 uppercase ml-1">Automation</span>
                    </a>
                </div>
                
                {{ $slot }}
            </div>
            
             <div class="mt-8 text-white/40 text-xs relative z-10">
                &copy; {{ date('Y') }} ZeusX Automation. All rights reserved.
            </div>
        </div>
    </body>
</html>
