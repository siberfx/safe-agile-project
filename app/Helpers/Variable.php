<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Variable
{
    public const int CACHE_TTL = 86400;

    public const string
        ADMIN_ROLE = 'admin',
        SUPER_ADMIN_ROLE = 'super_admin';

    public const string
        GUARD_NAME = 'web';

    public static function expiresAt(): Carbon
    {
        return now()->addSeconds(self::CACHE_TTL);
    }

    public const array DEFAULT_SA_EMAILS = [
        ['name' => 'Admin', 'email' => 'demo@demo.com', 'password' => '@Welcome123!!'],
    ]; // default admin accounts

    public const array DEFAULT_ROLES = [
        'super_admin' => 'Super Administrator',
        'admin' => 'Administrator',
    ];

    /**
     * Upload paths for different file types
     * All paths are relative to the storage/app/public directory
     */
    public const array UPLOAD_PATHS = [
        'settings' => 'settings',
        'articles' => 'articles',
        'pages' => 'pages',
        'categories' => 'categories',
        'users' => 'users',
        'general' => 'general',
    ];

    /**
     * Upload a file to storage
     *
     * @param  UploadedFile  $file  The uploaded file
     * @param  string  $type  The type of upload (settings, articles, etc.)
     * @param  string|null  $oldPath  Path to old file to delete (optional)
     * @param  string|null  $customName  Custom filename (optional)
     * @return string The path to the uploaded file
     */
    public static function uploadFile(UploadedFile $file, string $type = 'general', ?string $oldPath = null, ?string $customName = null): string
    {
        // Delete old file if provided
        if ($oldPath) {
            self::deleteFile($oldPath);
        }

        // Get the upload path for the specified type
        $uploadPath = self::UPLOAD_PATHS[$type] ?? self::UPLOAD_PATHS['general'];

        // Generate filename
        $filename = $customName ?? time().'_'.Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$file->getClientOriginalExtension();

        // Upload the file to storage
        // Return the URL to the file (for use in views)
        $file->storeAs($uploadPath, $filename, 'public');

        return $uploadPath.'/'.$filename;
    }

    /**
     * Delete a file from storage
     *
     * @param  string|null  $path  Path to the file
     * @return bool Whether the file was deleted
     */
    public static function deleteFile(?string $path): bool
    {
        if (! $path) {
            return false;
        }

        return Storage::disk('public')->delete($path);
    }

    /**
     * Generate a unique UUID
     *
     * @return string The generated UUID
     */
    public static function generateUuid(): string
    {
        do {
            $uuid = Str::uuid()->toString();
        } while (Media::where('uuid', $uuid)->exists());

        return $uuid;
    }

    public static function getImage(?string $image): ?string
    {
        if (empty($image)) {
            return null;
        }

        if (str_contains($image, 'storage')) {
            return asset('storage/'.$image);
        }

        if (str_contains($image, 'http')) {
            return $image;
        }

        return asset($image);
    }
}
