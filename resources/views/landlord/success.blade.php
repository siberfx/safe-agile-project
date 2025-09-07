<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platform Created Successfully - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-green-50 to-emerald-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-xl p-8 text-center">
                <!-- Success Icon -->
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <h1 class="text-3xl font-bold text-gray-800 mb-4">🎉 Congratulations!</h1>
                <p class="text-xl text-gray-600 mb-8">Your agile platform has been created successfully!</p>

                <!-- Platform Details -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8 text-left">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Platform Details:</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Company:</span>
                            <span class="font-medium">{{ $tenant->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Platform URL:</span>
                            <span class="font-medium text-blue-600">{{ $tenant->domain }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Platform ID:</span>
                            <span class="font-medium">{{ $tenant->slug }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Admin Email:</span>
                            <span class="font-medium">{{ $tenant->settings['admin_email'] ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="bg-blue-50 rounded-lg p-6 mb-8 text-left">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Next Steps:</h2>
                    <ol class="list-decimal list-inside space-y-2 text-gray-700">
                        <li>Access your platform at <strong>{{ $tenant->domain }}</strong></li>
                        <li>Login with your administrator credentials</li>
                        <li>Set up your first program and project</li>
                        <li>Invite team members to collaborate</li>
                        <li>Start managing your agile projects!</li>
                    </ol>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-4">
                    <a href="http://{{ $tenant->domain }}" 
                       class="block w-full bg-blue-600 text-white py-3 px-6 rounded-md hover:bg-blue-700 transition duration-200 font-medium">
                        Access Your Platform
                    </a>
                    
                    <a href="mailto:{{ $tenant->settings['admin_email'] ?? '' }}?subject=Welcome to Your Agile Platform&body=Congratulations! Your agile platform is ready at {{ $tenant->domain }}" 
                       class="block w-full bg-gray-100 text-gray-700 py-3 px-6 rounded-md hover:bg-gray-200 transition duration-200 font-medium">
                        Email Platform Details
                    </a>
                </div>

                <!-- Support Information -->
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <p class="text-sm text-gray-500">
                        Need help getting started? Contact our support team or check the documentation.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
