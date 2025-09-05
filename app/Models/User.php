<?php

namespace App\Models;

use App\Helpers\Variable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'kvk_nummer',
        'bedrijfsnaam',
        'telefoon',
        'adres',
        'postcode',
        'plaats',
        'land',
        'btw_nummer',
        'iban',
        'website',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return (bool)$this->hasAnyRole([Variable::ADMIN_ROLE, Variable::SUPER_ADMIN_ROLE]);
    }

    /**
     * Check if user has 2FA enabled.
     */
    public function hasTwoFactorEnabled(): bool
    {
        return !is_null($this->two_factor_confirmed_at) && !is_null($this->two_factor_secret);
    }

    /**
     * Get decrypted recovery codes.
     */
    public function getRecoveryCodes(): array
    {
        if (!$this->two_factor_recovery_codes) {
            return [];
        }

        return json_decode(decrypt($this->two_factor_recovery_codes), true) ?? [];
    }

    /**
     * Use a recovery code.
     */
    public function useRecoveryCode(string $code): bool
    {
        $recoveryCodes = $this->getRecoveryCodes();

        if (!in_array($code, $recoveryCodes)) {
            return false;
        }

        // Remove used code
        $remainingCodes = array_diff($recoveryCodes, [$code]);

        $this->update([
            'two_factor_recovery_codes' => encrypt(json_encode(array_values($remainingCodes)))
        ]);

        return true;
    }

    // Agile relationships
    public function assignedTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    public function createdProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'created_by');
    }

    public function testCases(): HasMany
    {
        return $this->hasMany(TestCase::class, 'tester_id');
    }

    public function reportedBugs(): HasMany
    {
        return $this->hasMany(Bug::class, 'reporter_id');
    }

    public function assignedBugs(): HasMany
    {
        return $this->hasMany(Bug::class, 'assignee_id');
    }
}
