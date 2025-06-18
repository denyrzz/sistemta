<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\MhsPkl;
use App\Models\Pimpinan;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $adminRole = Role::create(['name' => 'admin']);
        $kaprodiRole = Role::firstOrCreate(['name' => 'kaprodi']);
        $mahasiswaRole = Role::firstOrCreate(['name' => 'mahasiswa']);
        $dosenRole = Role::firstOrCreate(['name' => 'dosen']);
        $pembimbingRole = Role::firstOrCreate(['name' => 'pembimbing']);
        $pengujiRole = Role::firstOrCreate(['name' => 'penguji']);

        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678')
        ]);
        $adminUser->assignRole($adminRole);

        $superAdminUser = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('12345678')
        ]);
        $superAdminUser->assignRole($superAdminRole);

        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();
        $pembimbingIds = MhsPkl::pluck('dosen_pembimbing')->toArray();
        $pengujiIds = MhsPkl::pluck('dosen_penguji')->toArray();
        $kaprodiIds = Pimpinan::where('jabatan_id', 3)->pluck('dosen_id')->toArray();

        foreach ($dosens as $dosen) {
            $existingUser = User::where('email', $dosen->email)->first();

            if ($existingUser) {
                $existingUser->assignRole($dosenRole);

                if (in_array($dosen->id_dosen, $pembimbingIds)) {
                    $existingUser->assignRole($pembimbingRole);
                }

                if (in_array($dosen->id_dosen, $pengujiIds)) {
                    $existingUser->assignRole($pengujiRole);
                }

                if (in_array($dosen->id_dosen, $kaprodiIds)) {
                    $existingUser->assignRole($kaprodiRole);
                }
            } else {
                $user = User::create([
                    'name' => $dosen->nama,
                    'email' => $dosen->email,
                    'password' => $dosen->password,
                ]);

                $user->assignRole($dosenRole);

                if (in_array($dosen->id_dosen, $pembimbingIds)) {
                    $user->assignRole($pembimbingRole);
                }

                if (in_array($dosen->id_dosen, $pengujiIds)) {
                    $user->assignRole($pengujiRole);
                }

                if (in_array($dosen->id_dosen, $kaprodiIds)) {
                    $user->assignRole($kaprodiRole);
                }
            }
        }

        foreach ($mahasiswas as $mahasiswa) {
            $existingUser = User::where('email', $mahasiswa->email)->first();

            if ($existingUser) {
                $existingUser->assignRole($mahasiswaRole);

            } else {
                $user = User::create([
                    'name' => $mahasiswa->nama,
                    'email' => $mahasiswa->email,
                    'password' => $mahasiswa->password,
                ]);

                $user->assignRole($mahasiswaRole);
            }
        }
    }
}
