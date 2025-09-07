<?php

Route::redirect('/', '/admin');

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SystemController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\TwoFactorController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin')->name('home');
// Admin Routes

Route::group(['as' => 'admin.'], function () {

    // Guest routes (no auth required)
    Route::get('login', function () {
        return view('admin.auth.login');
    })->name('login');

    Route::get('register', function () {
        return view('admin.auth.register');
    })->name('register');

    Route::get('forgot-password', function () {
        return view('admin.auth.forgot-password');
    })->name('forgot-password');

    // Authentication POST routes
    Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.post');
    Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register.post');

    // Two-Factor Authentication Routes (guest accessible)
    Route::get('two-factor-challenge', [TwoFactorController::class, 'show'])->name('two-factor.challenge');
    Route::post('two-factor-challenge', [TwoFactorController::class, 'verify'])->name('two-factor.verify');
    Route::get('two-factor-recovery', [TwoFactorController::class, 'showRecovery'])->name('two-factor.recovery');
    Route::post('two-factor-recovery', [TwoFactorController::class, 'verifyRecovery'])->name('two-factor.recovery.verify');

    Route::get('reset-password/{token}', function (string $token) {
        return view('admin.auth.reset-password', ['request' => request()]);
    })->name('password.reset');

    // Auth routes (auth required)
    Route::get('verify-email', function () {
        return view('admin.auth.verify-email');
    })->name('verification.notice');

    Route::get('confirm-password', function () {
        return view('admin.auth.confirm-password');
    })->name('password.confirm');

    Route::post('email/verification-notification', [App\Http\Controllers\Auth\EmailVerificationController::class, 'resend'])->name('verification.send');
    Route::post('forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::post('reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.store');
    Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    Route::post('user/confirm-password', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'confirm'])->name('password.confirm');

    // not exists
    Route::post('email/verification-notification', [App\Http\Controllers\Auth\EmailVerificationController::class, 'resend'])->name('verification.send');
    Route::put('user/password', [App\Http\Controllers\Auth\PasswordController::class, 'update'])->name('password.update');
    Route::put('user/profile-information', [App\Http\Controllers\Auth\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('user/profile', [App\Http\Controllers\Auth\ProfileController::class, 'destroy'])->name('profile.destroy');

    // Protected Admin Routes (require authentication)
    Route::middleware('admin')->group(function () {
        Route::get('/', [SystemController::class, 'index'])->name('index');

        // Two-Factor Authentication Setup Routes
        Route::group(['prefix' => 'two-factor', 'as' => 'two-factor.'], function () {
            Route::get('setup', [App\Http\Controllers\Auth\TwoFactorSetupController::class, 'show'])->name('setup');
            Route::post('enable', [App\Http\Controllers\Auth\TwoFactorSetupController::class, 'enable'])->name('enable');
            Route::delete('disable', [App\Http\Controllers\Auth\TwoFactorSetupController::class, 'disable'])->name('disable');
            Route::post('recovery-codes', [App\Http\Controllers\Auth\TwoFactorSetupController::class, 'generateRecoveryCodes'])->name('recovery-codes');
        });

        // Profile routes
        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
            Route::get('/', [ProfileController::class, 'index'])->name('index');
            Route::put('/', [ProfileController::class, 'update'])->name('update');
            Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
            Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');

            // 2FA routes
            Route::post('/2fa/setup', [ProfileController::class, 'setupTwoFactor'])->name('2fa.setup');
            Route::post('/2fa/confirm', [ProfileController::class, 'confirmTwoFactor'])->name('2fa.confirm');
            Route::post('/2fa/cancel', [ProfileController::class, 'cancelTwoFactorSetup'])->name('2fa.cancel');
            Route::delete('/2fa/disable', [ProfileController::class, 'disableTwoFactor'])->name('2fa.disable');
            Route::post('/2fa/recovery-codes', [ProfileController::class, 'generateRecoveryCodes'])->name('2fa.recovery-codes');
        });


        // Mijn Taken routes
        Route::resource('mijn-taken', App\Http\Controllers\Admin\MijnTakenController::class);

        // Risico's & Knelpunten routes
        Route::resource('risicos-knelpunten', App\Http\Controllers\Admin\RisicosKnelpuntenController::class);

        // Rapportages routes
        Route::resource('rapportages', App\Http\Controllers\Admin\RapportagesController::class);

        // Access Management routes
        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
            // Users routes
            Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::get('/create', [UserController::class, 'create'])->name('create');
                Route::post('/', [UserController::class, 'store'])->name('store');
                Route::get('/{user}', [UserController::class, 'show'])->name('show');
                Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
                Route::put('/{user}', [UserController::class, 'update'])->name('update');
                Route::patch('/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('toggle-status');
                Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
            });

            // Roles routes
            Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
                Route::get('/', [RoleController::class, 'index'])->name('index');
                Route::get('/create', [RoleController::class, 'create'])->name('create');
                Route::post('/', [RoleController::class, 'store'])->name('store');
                Route::get('/{role}', [RoleController::class, 'show'])->name('show');
                Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit');
                Route::put('/{role}', [RoleController::class, 'update'])->name('update');
                Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy');
            });

            // Permissions routes
            Route::group(['prefix' => 'permissions', 'as' => 'permissions.'], function () {
                Route::get('/', [PermissionController::class, 'index'])->name('index');
                Route::get('/create', [PermissionController::class, 'create'])->name('create');
                Route::post('/', [PermissionController::class, 'store'])->name('store');
                Route::get('/{permission}', [PermissionController::class, 'show'])->name('show');
                Route::get('/{permission}/edit', [PermissionController::class, 'edit'])->name('edit');
                Route::put('/{permission}', [PermissionController::class, 'update'])->name('update');
                Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('destroy');
            });

            // SAFe Agile Module Routes
            Route::resource('programs', App\Http\Controllers\Admin\ProgramController::class);
            Route::resource('business-goals', App\Http\Controllers\Admin\BusinessGoalController::class);
            Route::resource('epics', App\Http\Controllers\Admin\EpicController::class);
            Route::resource('features', App\Http\Controllers\Admin\FeatureController::class);
            Route::resource('sprints', App\Http\Controllers\Admin\SprintController::class);
            Route::resource('user-stories', App\Http\Controllers\Admin\UserStoryController::class);
            Route::resource('testing', App\Http\Controllers\Admin\TestingController::class);
            Route::resource('bugs', App\Http\Controllers\Admin\BugController::class);

            // Dashboard routes
            Route::get('/dashboard/stakeholder', [SystemController::class, 'stakeholderDashboard'])->name('dashboard.stakeholder');
            Route::get('/dashboard/project-manager', [SystemController::class, 'projectManagerDashboard'])->name('dashboard.project-manager');
            Route::get('/dashboard/team', [SystemController::class, 'teamDashboard'])->name('dashboard.team');

            // Kanban Board
            Route::get('/kanban', [SystemController::class, 'kanbanBoard'])->name('kanban.index');

            // Reports routes
            Route::get('/reports/sprints', [SystemController::class, 'sprintReports'])->name('reports.sprints');
            Route::get('/reports/quarterly', [SystemController::class, 'quarterlyReports'])->name('reports.quarterly');
            Route::get('/reports/kpi', [SystemController::class, 'kpiDashboard'])->name('reports.kpi');
        });

    }); // End of protected admin routes

    // Admin fallback route - redirect non-existent admin routes to login
    Route::fallback(function () {
        return redirect()->route('admin.login');
    });
});
