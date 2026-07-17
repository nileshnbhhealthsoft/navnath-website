<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use App\Models\SiteContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        AdminUser::query()->firstOrCreate(
            ['email' => (string) config('admin.email', 'admin@ascent.in')],
            [
                'name' => 'Administrator',
                'password' => Hash::make((string) config('admin.password', 'ChangeMe123!')),
                'is_active' => true,
            ],
        );

        SiteContent::query()->firstOrCreate([], [
            'content' => config('site_content'),
        ]);
    }
}
