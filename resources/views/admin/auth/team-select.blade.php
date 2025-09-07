<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Select Team - OPUB Admin Panel</title>

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
        <div class="w-full max-w-md bg-white shadow-sm rounded-md overflow-hidden">
            <div class="p-8 sm:p-12">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold mb-2 text-slate-800">Select Your Team</h2>
                    <p class="text-sm text-slate-500">Welcome back, {{ $user->name }}! Choose which team you'd like to access.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-md">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-400"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">
                                    There was an error with your selection
                                </h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.team.select.post') }}" class="space-y-4">
                    @csrf

                    <div class="space-y-3">
                        @foreach($teams as $team)
                            <label class="relative flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors duration-200 @error('team_id') border-red-500 @enderror">
                                <input type="radio" name="team_id" value="{{ $team->id }}" class="sr-only" required>
                                <div class="flex items-center justify-between w-full">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-users text-white text-sm"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-sm font-semibold text-gray-900">{{ $team->name }}</h3>
                                            <p class="text-xs text-gray-500">{{ $team->tenant->name }}</p>
                                            @if($team->description)
                                                <p class="text-xs text-gray-400 mt-1">{{ $team->description }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="w-4 h-4 border-2 border-gray-300 rounded-full team-radio-indicator"></div>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>

                    <div class="!mt-8">
                        <button type="submit" class="w-full py-2.5 px-3 bg-primary text-white font-semibold rounded-md hover:bg-primary/90 focus:outline-none transition-all duration-300 cursor-pointer">
                            Continue to Dashboard
                        </button>
                    </div>
                </form>

                <div class="text-center mt-6">
                    <a href="{{ route('admin.login') }}" class="text-sm text-slate-500 hover:text-slate-700 font-medium">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Back to Login
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Handle radio button styling
        document.addEventListener('DOMContentLoaded', function() {
            const radioInputs = document.querySelectorAll('input[type="radio"][name="team_id"]');
            const labels = document.querySelectorAll('label');
            
            radioInputs.forEach((input, index) => {
                input.addEventListener('change', function() {
                    // Reset all labels
                    labels.forEach(label => {
                        label.classList.remove('border-primary', 'bg-primary/5');
                        label.classList.add('border-gray-200');
                        const indicator = label.querySelector('.team-radio-indicator');
                        if (indicator) {
                            indicator.classList.remove('border-primary', 'bg-primary');
                            indicator.classList.add('border-gray-300');
                            indicator.innerHTML = '';
                        }
                    });
                    
                    // Style selected label
                    if (this.checked) {
                        const label = this.closest('label');
                        label.classList.remove('border-gray-200');
                        label.classList.add('border-primary', 'bg-primary/5');
                        const indicator = label.querySelector('.team-radio-indicator');
                        if (indicator) {
                            indicator.classList.remove('border-gray-300');
                            indicator.classList.add('border-primary', 'bg-primary');
                            indicator.innerHTML = '<i class="fas fa-check text-white text-xs"></i>';
                        }
                    }
                });
            });
        });
    </script>

</body>
</html>
