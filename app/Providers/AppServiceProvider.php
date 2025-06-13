<?php

namespace App\Providers;

use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Prodi;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('isSuperAdmin', function (User $user) {
            return $user->level === "superadmin";
        });

        Gate::define('isAdmin', function (User $user) {
            return $user->level === "admin";
        });

        Gate::define('isKajur', function (User $user) {
            return $user->level === "kajur";
        });

        Gate::define('isKaprodi', function (User $user) {
            return $user->level === "kaprodi";
        });

        Gate::define('isDosen', function (User $user) {
            return $user->level === "dosen";
        });

        Gate::define('isMahasiswa', function (User $user) {
            return $user->level === "mahasiswa";
        });

        // JENJANG MAHASISWA
        Gate::define('isSarjana', function (User $user) {
            // Cari mahasiswa berdasarkan email pengguna yang sedang login
            $mahasiswa = Mahasiswa::where('email', $user->email)->first();

            return $user->level === 'mahasiswa' && $mahasiswa && $mahasiswa->prodi->namajenjang === 'D-IV';
        });

        Gate::define('isDiploma', function (User $user) {
            // Cari mahasiswa berdasarkan email pengguna yang sedang login
            $mahasiswa = Mahasiswa::where('email', $user->email)->first();

            return $user->level === 'mahasiswa' && $mahasiswa && $mahasiswa->prodi->namajenjang === 'D-III';
        });
    }
}
