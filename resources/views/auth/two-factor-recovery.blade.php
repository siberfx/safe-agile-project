<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recovery Code - {{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-50 via-blue-50/30 to-indigo-50/30 text-gray-900 font-sans">

<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <div class="mx-auto h-12 w-12 bg-yellow-600 rounded-full flex items-center justify-center">
                <i class="fa-solid fa-key text-white text-xl"></i>
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Use Recovery Code
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Enter one of your recovery codes to access your account
            </p>
        </div>

        <form class="mt-8 space-y-6" method="POST" action="{{ route('admin.two-factor.recovery.verify') }}">
            @csrf

            <div>
                <label for="recovery_code" class="sr-only">Recovery Code</label>
                <input id="recovery_code"
                       name="recovery_code"
                       type="text"
                       placeholder="Enter recovery code"
                       class="appearance-none rounded-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 focus:z-10 sm:text-sm font-mono text-center"
                       required
                       autofocus>
                @error('recovery_code')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i class="fa-solid fa-unlock text-yellow-500 group-hover:text-yellow-400"></i>
                    </span>
                    Use Recovery Code
                </button>
            </div>

            <div class="text-center">
                <p class="text-sm text-gray-600">
                    Have your device back?
                    <a href="{{ route('admin.two-factor.challenge') }}" class="font-medium text-blue-600 hover:text-blue-500">
                        Use authenticator code
                    </a>
                </p>
            </div>

            <div class="text-center">
                <a href="{{ route('admin.login') }}" class="text-sm text-gray-500 hover:text-gray-700">
                    ← Back to login
                </a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
