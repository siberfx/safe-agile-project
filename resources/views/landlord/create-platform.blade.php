<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Your Agile Platform - OPUB</title>

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
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-6xl font-bold text-slate-800 mb-6">
                    Launch Your <span class="text-primary">Agile Platform</span>
                </h1>
                <p class="text-xl text-slate-600 mb-8 max-w-3xl mx-auto">
                    Create your own dedicated agile project management platform with complete data isolation, 
                    team collaboration tools, and enterprise-grade security.
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

                    <!-- Right side - Registration Form -->
                    <div class="md:w-1/2 p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Create Your Platform</h2>
                        
                        @if ($errors->any())
                            <div class="bg-red-50 border border-red-200 rounded-md p-4 mb-6">
                                <div class="flex">
                                    <svg class="w-5 h-5 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                    <div>
                                        <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('landlord.register') }}" class="space-y-6">
                            @csrf
                            
                            <!-- Company Information -->
                            <div>
                                <label for="company_name" class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                                <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                       required>
                            </div>


                            <!-- Admin User Information -->
                            <div class="border-t pt-6">
                                <h3 class="text-lg font-medium text-gray-800 mb-4">Administrator Account</h3>
                                
                                <div>
                                    <label for="admin_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                    <input type="text" id="admin_name" name="admin_name" value="{{ old('admin_name') }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                           required>
                                </div>

                                <div>
                                    <label for="admin_email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                    <input type="email" id="admin_email" name="admin_email" value="{{ old('admin_email') }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                           required>
                                </div>

                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                                    <input type="password" id="password" name="password" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                           required>
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                           required>
                                </div>
                            </div>

                            <!-- Optional Information -->
                            <div class="border-t pt-6">
                                <h3 class="text-lg font-medium text-gray-800 mb-4">Additional Information (Optional)</h3>
                                
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                </div>

                                <div>
                                    <label for="company_address" class="block text-sm font-medium text-gray-700 mb-2">Company Address</label>
                                    <textarea id="company_address" name="company_address" rows="3" 
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ old('company_address') }}</textarea>
                                </div>
                            </div>

                            <button type="submit" 
                                    class="w-full bg-indigo-600 text-white py-3 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 font-medium transition duration-200">
                                Create My Agile Platform
                            </button>
                        </form>

                        <div class="mt-6 text-center">
                            <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-gray-800">
                                <i class="fas fa-arrow-left mr-1"></i>
                                Back to Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
