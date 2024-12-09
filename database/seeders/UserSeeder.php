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
        $pembimbingPklRole = Role::firstOrCreate(['name' => 'pembimbing-pkl']);
        $pengujiPklRole = Role::firstOrCreate(['name' => 'penguji-pkl']);

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
        $pembimbingPklIds = MhsPkl::pluck('dosen_pembimbing')->toArray();
        $pengujiPklIds = MhsPkl::pluck('dosen_penguji')->toArray();
        $kaprodiIds = Pimpinan::where('jabatan_id', 3)->pluck('dosen_id')->toArray();

        foreach ($dosens as $dosen) {
            $existingUser = User::where('email', $dosen->email)->first();

            if ($existingUser) {
                $existingUser->assignRole($dosenRole);

                if (in_array($dosen->id_dosen, $pembimbingPklIds)) {
                    $existingUser->assignRole($pembimbingPklRole);
                }

                if (in_array($dosen->id_dosen, $pengujiPklIds)) {
                    $existingUser->assignRole($pengujiPklRole);
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

                if (in_array($dosen->id_dosen, $pembimbingPklIds)) {
                    $user->assignRole($pembimbingPklRole);
                }

                if (in_array($dosen->id_dosen, $pengujiPklIds)) {
                    $user->assignRole($pengujiPklRole);
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
