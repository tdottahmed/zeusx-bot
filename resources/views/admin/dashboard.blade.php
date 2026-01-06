@extends('layouts.app')

@section('content')
    <div class="sm:flex sm:items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold leading-7 text-white sm:truncate sm:text-3xl sm:tracking-tight">Automation Dashboard</h1>
            <p class="mt-2 text-sm text-gray-400">Overview of your bot operations and system status.</p>
        </div>
        <div class="mt-4 sm:ml-4 sm:mt-0">
             <span class="inline-flex items-center rounded-full bg-emerald-500/10 px-3 py-1 text-sm font-medium text-emerald-400 ring-1 ring-inset ring-emerald-500/20">
                <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                System Operational
             </span>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Automation Widget -->
        <div class="relative overflow-hidden rounded-xl bg-gray-800 shadow-sm ring-1 ring-white/10 transition-all hover:shadow-lg group">
            <div class="absolute top-0 right-0 -mr-4 -mt-4 w-24 h-24 rounded-full bg-gradient-to-br from-zeus-vibrant/20 to-zeus-pink/20 blur-xl group-hover:blur-2xl transition-all"></div>
            
            <div class="p-6 relative z-10">
                <div class="flex items-center gap-x-4 mb-4">
                    <div class="flex-none rounded-lg bg-gradient-to-br from-zeus-deep to-zeus-vibrant p-3 shadow-md border border-white/10">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold leading-6 text-white">Run Script</h3>
                        <p class="text-xs text-gray-400">Main Automation Sequence</p>
                    </div>
                </div>
                
                <p class="text-sm text-gray-300 mb-6 leading-relaxed">
                    Executes the ZeuxX Playwright automation. This process may take several minutes to complete.
                </p>
                     
                <form action="{{ route('admin.run-automation') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex justify-center items-center gap-2 rounded-lg bg-gray-900 px-4 py-3 text-sm font-semibold text-white shadow-sm ring-1 ring-white/10 hover:bg-zeus-deep hover:shadow-zeus-deep/30 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zeus-deep transition-all duration-300 transform group-hover:-translate-y-0.5">
                        <span>Execute Now</span>
                        <svg class="w-4 h-4 text-zeus-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </button>
                </form>
            </div>
            
            <div class="bg-gray-900/50 px-6 py-3 border-t border-white/5 flex justify-between items-center">
                 <span class="text-xs font-medium text-gray-500">Status</span>
                 <span class="text-xs font-semibold text-zeus-vibrant">Ready</span>
            </div>
        </div>

        <!-- Read Only Stats Widget -->
        <div class="relative overflow-hidden rounded-xl bg-gray-800 shadow-sm ring-1 ring-white/10 opacity-60 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-500">
             <div class="p-6">
                 <div class="flex items-center gap-x-4 mb-4">
                    <div class="flex-none rounded-lg bg-gray-700 p-3">
                        <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold leading-6 text-white">Active Offers</h3>
                         <p class="text-xs text-gray-400">Monitoring</p>
                    </div>
                 </div>
                 <div class="mt-4">
                     <span class="text-4xl font-black text-white tracking-tight">--</span>
                     <span class="text-sm text-gray-500 ml-2">total</span>
                 </div>
             </div>
             <div class="bg-gray-900/50 px-6 py-3 border-t border-white/5">
                 <span class="text-xs text-gray-500 italic">Data sync pending...</span>
            </div>
        </div>
    </div>

    <!-- Output Console -->
    @if(session('status') || session('output'))
        <div class="mt-8 animate-fade-in-up">
            <h3 class="text-sm font-bold uppercase tracking-wide text-gray-500 mb-3 ml-1">Process Logs</h3>
            <div class="rounded-xl bg-gray-950 shadow-2xl ring-1 ring-white/10 overflow-hidden relative">
                <!-- Mac-like dots -->
                <div class="bg-gray-900 px-4 py-2 flex items-center gap-2 border-b border-gray-800">
                    <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                    <div class="w-3 h-3 rounded-full bg-yellow-500/80"></div>
                    <div class="w-3 h-3 rounded-full bg-green-500/80"></div>
                    <span class="ml-2 text-xs text-gray-500 font-mono">console output</span>
                </div>
                
                <div class="p-4 sm:p-6 font-mono text-sm leading-6">
                    @if(session('status'))
                        <div class="mb-4 flex items-center gap-3 text-emerald-400 border-b border-gray-800 pb-4">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ session('status') }}</span>
                        </div>
                    @endif

                    @if(session('output'))
                        <pre class="text-gray-300 max-h-[500px] overflow-auto scrollbar-thin scrollbar-thumb-gray-800 scrollbar-track-transparent">{{ session('output') }}</pre>
                    @endif
                </div>
            </div>
        </div>
    @endif
@endsection
