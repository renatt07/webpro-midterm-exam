<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="icon" href="{{ asset('favicon.png') }}">
        <meta charset="utf-g">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>My To-Do List</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        
        <div class="relative min-h-screen bg-gray-900 flex flex-col items-center justify-center p-6">
            
            <div class="text-center">
                <div class="text-white mb-8">
                    <span class="font-bold text-5xl text-indigo-400">
                        My ToDo
                    </span>
                </div>

                <h1 class="text-4xl font-bold text-white">
                    Welcome to My To-Do List Website
                </h1>

                <p class="mt-4 text-lg text-gray-400">
                    Organize all your task here.
                </p>

                <div class="mt-10 flex items-center justify-center space-x-6">
                    <a href="{{ route('login') }}" 
                       class="px-8 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-500 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition ease-in-out duration-150">
                        Login
                    </a>
                    
                    <a href="{{ route('register') }}" 
                       class="px-8 py-3 bg-gray-700 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition ease-in-out duration-150">
                        Register
                    </a>
                </div>
            </div>

        </div>
    </body>
</html>