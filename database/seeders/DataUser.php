<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DataUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            // Kadisnav
            [
                'name' => 'kadisnav',
                'username' => 'kadisnav',
                'email' => 'kadisnav@email.com',
                'password' => Hash::make('kadisnav'),
            ],
            // Kabid Operasi
            [
                'name' => 'kabidoperasi',
                'username' => 'kabidoperasi',
                'email' => 'kabidoperasi@email.com',
                'password' => Hash::make('kabidoperasi'),
            ],
            // Kabid Logistik
            [
                'name' => 'kabidlogistik',
                'username' => 'kabidlogistik',
                'email' => 'kabidlogistik@email.com',
                'password' => Hash::make('kabidlogistik'),
            ],
            // Kabag Tata Usaha
            [
                'name' => 'kabagtatausaha',
                'username' => 'kabagtatausaha',
                'email' => 'kabagtatausaha@email.com',
                'password' => Hash::make('kabagtatausaha'),
            ],
            // Kasie Sarana Prasarana
            [
                'name' => 'kasiesaranaprasarana',
                'username' => 'kasiesaranaprasarana',
                'email' => 'kasiesaranaprasarana@email.com',
                'password' => Hash::make('kasiesaranaprasarana'),
            ],
            // Kasie Program
            [
                'name' => 'kasieprogram',
                'username' => 'kasieprogram',
                'email' => 'kasieprogram@email.com',
                'password' => Hash::make('kasieprogram'),
            ],
            // Kasie Pengadaan
            [
                'name' => 'kasiepengadaan',
                'username' => 'kasiepengadaan',
                'email' => 'kasiepengadaan@email.com',
                'password' => Hash::make('kasiepengadaan'),
            ],
            // Kasie Penhapusan
            [
                'name' => 'kasiepenhapusan',
                'username' => 'kasiepenhapusan',
                'email' => 'kasiepenhapusan@email.com',
                'password' => Hash::make('kasiepenhapusan'),
            ],
            // Kasie Keuangan
            [
                'name' => 'kasiekeuangan',
                'username' => 'kasiekeuangan',
                'email' => 'kasiekeuangan@email.com',
                'password' => Hash::make('kasiekeuangan'),
            ],
            // Kasie Kepegawaian
            [
                'name' => 'kasiekepegawaian',
                'username' => 'kasiekepegawaian',
                'email' => 'kasiekepegawaian@email.com',
                'password' => Hash::make('kasiekepegawaian'),
            ],

            // Kasie Kepegawaian
            [
                'name' => 'kasiepenghapusan',
                'username' => 'kasiepenghapusan',
                'email' => 'kasiepenghapusan@email.com',
                'password' => Hash::make('kasiepenghapusan'),
            ],
        ];

        foreach ($users as $user) {
            // dd($user['name']);
            User::updateOrCreate(
                ['name' => $user['name']],
                ['username' => $user['username'],
                'email' => $user['email'],
                'password' => $user['password'],
            ]);
        }
    }
}
