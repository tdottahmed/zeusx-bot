@extends('layouts.app')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h2 class="text-2xl font-bold mb-4">Automation Control</h2>
            <div class="mb-6">
                <p class="mb-4 text-gray-600">Click the button below to execute the Playwright automation script.</p>
                <form action="{{ route('admin.run-automation') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                        Run Script
                    </button>
                </form>
            </div>

            @if(session('status'))
                <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @endif

            @if(session('output'))
                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-2">Command Output:</h3>
                    <div class="p-4 bg-gray-900 text-gray-100 rounded overflow-x-auto font-mono text-sm leading-relaxed">
                        <pre>{{ session('output') }}</pre>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
