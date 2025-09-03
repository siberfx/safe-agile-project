<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify Email - OPUB Admin Panel</title>

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
                <img src="{{ asset('backend/images/login-image.jpg') }}" alt="Verify Email Illustration" class="w-full h-full object-cover">
            </div>

            <div class="w-full lg:w-1/2 p-8 sm:p-12">
                <h2 class="text-3xl font-bold mb-2 text-slate-800">Verify Your Email</h2>
                <p class="text-sm text-slate-500 mb-8">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?</p>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 text-sm text-green-600 bg-green-50 border border-green-200 rounded-md p-3">
                        A new verification link has been sent to the email address you provided during registration.
                    </div>
                @endif

                <div class="space-y-5">
                    <form method="POST" action="{{ route('admin.verification.send') }}">
                        @csrf
                        <button type="submit" class="w-full py-2.5 px-3 bg-primary text-white font-semibold rounded-md hover:bg-primary/90 focus:outline-none transition-all duration-300 cursor-pointer">
                            Resend Verification Email
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="w-full py-2.5 px-3 bg-gray-200 text-gray-700 font-semibold rounded-md hover:bg-gray-300 focus:outline-none transition-all duration-300 cursor-pointer">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
