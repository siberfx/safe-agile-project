<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OPUB Agile Platform - Login</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- FontAwesome Pro Links --}}
    <link href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css" rel="stylesheet"/>
    <link href="https://site-assets.fontawesome.com/releases/v6.7.2/css/brands.css" rel="stylesheet"/>

    {{-- Styles / Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-50 via-blue-50/30 to-indigo-50/30 text-gray-900 font-sans">

    {{-- Hero Section --}}
    <section class="min-h-screen flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-6xl font-bold text-slate-800 mb-6">
                    Welcome to <span class="text-primary">OPUB Agile</span>
                </h1>
                <p class="text-xl text-slate-600 mb-8 max-w-3xl mx-auto">
                    Access your agile project management platform. Choose your login option below to get started.
                </p>
            </div>
            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                <div class="md:flex">
                    <!-- Left side - Benefits -->
                    <div class="md:w-1/2 bg-indigo-600 text-white p-8">
                        <h2 class="text-2xl font-bold mb-6">What you get:</h2>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <svg class="w-6 h-6 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <h3 class="font-semibold">Complete Agile Management</h3>
                                    <p class="text-indigo-200">Programs, Projects, Epics, Sprints, and Tasks</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <h3 class="font-semibold">Your Own Database</h3>
                                    <p class="text-indigo-200">Complete data isolation and security</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <h3 class="font-semibold">Team Collaboration</h3>
                                    <p class="text-indigo-200">User management and role-based access</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <h3 class="font-semibold">Bug Tracking & Testing</h3>
                                    <p class="text-indigo-200">Comprehensive quality assurance tools</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Right side - Login Options -->
                    <div class="md:w-1/2 p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Access Your Platform</h2>
                        
                        <div class="space-y-4">
                            <!-- Login Button -->
                            <a href="{{ route('admin.login') }}" class="w-full bg-primary text-white py-4 px-6 rounded-lg font-semibold text-center block hover:bg-primary/90 transition-colors duration-200 shadow-lg">
                                <div class="flex items-center justify-center">
                                    <i class="fas fa-sign-in-alt mr-3"></i>
                                    <div>
                                        <div class="text-lg">Login to System</div>
                                        <div class="text-sm opacity-90">Access your agile platform</div>
                                    </div>
                                </div>
                            </a>

                            <!-- Register New Platform Button -->
                            <a href="{{ route('landlord.register.form') }}" class="w-full bg-gray-100 text-gray-800 py-4 px-6 rounded-lg font-semibold text-center block hover:bg-gray-200 transition-colors duration-200 border border-gray-300">
                                <div class="flex items-center justify-center">
                                    <i class="fas fa-plus-circle mr-3"></i>
                                    <div>
                                        <div class="text-lg">Create New Platform</div>
                                        <div class="text-sm opacity-75">Register a new agile platform</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="mt-8 text-center">
                            <p class="text-sm text-gray-600">
                                Need help? <a href="#" class="text-primary hover:underline">Contact Support</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
