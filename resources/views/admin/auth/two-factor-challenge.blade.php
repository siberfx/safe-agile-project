<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Two-Factor Challenge - OPUB Admin Panel</title>

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
<body class="bg-gradient-to-br from-gray-50 via-blue-50/30 to-indigo-50/30 text-gray-900 font-sans min-h-screen flex items-center justify-center">

    <div class="container mx-auto flex justify-center items-center py-10 px-4 sm:px-6 lg:px-8">
        <div class="w-full bg-white shadow-sm rounded-md overflow-hidden lg:flex">
            <div class="hidden lg:block lg:w-1/2">
                <img src="{{ asset('backend/images/login-image.jpg') }}" alt="Two-Factor Challenge Illustration" class="w-full h-full object-cover">
            </div>

            <div class="w-full lg:w-1/2 p-8 sm:p-12">
                <h2 class="text-3xl font-bold mb-2 text-slate-800">Two-Factor Authentication</h2>
                <p class="text-sm text-slate-500 mb-8">Please confirm access to your account by entering the authentication code provided by your authenticator application.</p>

                <form method="POST" action="{{ route('admin.two-factor.login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Authentication Code</label>
                        <input id="code" type="text" name="code" required autofocus autocomplete="one-time-code"
                               class="block w-full rounded-md border border-gray-200 px-3 py-2.5 focus:outline-none focus:border-primary/50 @error('code') border-red-500 @enderror"
                               placeholder="Enter 6-digit code">
                        @error('code')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="recovery_code" class="block text-sm font-medium text-gray-700 mb-1">Recovery Code</label>
                        <input id="recovery_code" type="text" name="recovery_code" autocomplete="one-time-code"
                               class="block w-full rounded-md border border-gray-200 px-3 py-2.5 focus:outline-none focus:border-primary/50 @error('recovery_code') border-red-500 @enderror"
                               placeholder="Or enter recovery code">
                        @error('recovery_code')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="!mt-8">
                        <button type="submit" class="w-full py-2.5 px-3 bg-primary text-white font-semibold rounded-md hover:bg-primary/90 focus:outline-none transition-all duration-300 cursor-pointer">
                            Confirm
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
