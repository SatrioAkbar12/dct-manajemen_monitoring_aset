<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'admin')->first();
        $user = User::create([
            'nama' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin123'),
            'memiliki_sim' => 1
        ]);
        $user->assignRole($role->name);

        $user = User::create(['nama' => 'Ahmad Ramadhan', 'email' => 'ahmdramdn47@gmail.com', 'username' => 'ahmadRamadhan', 'password' => Hash::make('22Pt7DNRtoL11sHWNn1B'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Akhmad Nur Wahid', 'email' => 'anwcorp@gmail.com', 'username' => 'akhmadNurWahid', 'password' => Hash::make('ZiNnj24bXgX1MdxUauf1'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Atika Maulida', 'email' => 'atikamaulida12@gmail.com', 'username' => 'atikaMaulida', 'password' => Hash::make('srGHWV8KUyFhvtMMegAi'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Budi Yulianto', 'email' => 'yuliantob176@gmail.com', 'username' => 'budiYulianto', 'password' => Hash::make('eWoULdTBRx4DJr2Az9PQ'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Cahyo Rudianto', 'email' => 'rudi@dct.co.id', 'username' => 'cahyoRudianto', 'password' => Hash::make('dAa20j5vg6VQad11qQdY'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Dimas Kadarianto', 'email' => 'dimaskad01@gmail.com', 'username' => 'dimasKadarianto', 'password' => Hash::make('g6yQov6fjfu9yppCcsEX'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Firdaus Agam Subaeni', 'email' => 'firdaus.agam80@gmail.com', 'username' => 'firdausAgamSubaeni', 'password' => Hash::make('x39F5XAyd2qud5kQfawp'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Heri Setyawan', 'email' => 'heri.dct@gmail.com', 'username' => 'heriSetyawan', 'password' => Hash::make('JJ1QAHQfovDP5QPhTQQw'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Isse Alfian Azis', 'email' => 'issealfian@gmail.com', 'username' => 'isseAlfianAzis', 'password' => Hash::make('rEVzKnd6c1xf2GYG3xsQ'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Resky Andrian Sugesti', 'email' => 'andrianresky@gmail.com', 'username' => 'reskyAndrianSugesti', 'password' => Hash::make('y09AcLwVrXZ7fAw8P1AC'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Reyno Nur Fahreza', 'email' => 'Reyno.fahreza@gmail.com', 'username' => 'reynoNurFahreza', 'password' => Hash::make('bsWR2g5ukmnxkBxP1wkC'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Rifky Muhammad Ilma Fatwa', 'email' => 'rifky.mif@gmail.com', 'username' => 'rifkyMuhammadIlmaFatwa', 'password' => Hash::make('kREBFJrULRGtaXMo422Y'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Rohwan', 'email' => 'Rohwan.ngarsan@gmail.com', 'username' => 'rohwan', 'password' => Hash::make('Ao1kNCqCDCm8epxc3uWv'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Santy Septiyani Laisa', 'email' => 'santy24fit@gmail.com', 'username' => 'santySeptiyaniLaisa', 'password' => Hash::make('Ca3eBs5MFTbHta3j7jzE'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Saskia Nur Fiwisya', 'email' => 'saskianurfiwisya@gmail.com', 'username' => 'saskiaNurFiwisya', 'password' => Hash::make('sf3AxJEppvRekRVvQEb4'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Uuk Fatahilah Rachmat', 'email' => 'uuk.fatahilah@gmail.com', 'username' => 'uukFatahilahRachmat', 'password' => Hash::make('TR4w6p778bYMLYunWjeZ'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Wawan Setiawan', 'email' => 'wawan.nuri.setiawan@gmail.com', 'username' => 'wawanSetiawan', 'password' => Hash::make('mGBHv8eQr5rf8RnFr0HK'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Yaman S', 'email' => 'yaman.sabenih78@gmail.com', 'username' => 'yamanS', 'password' => Hash::make('Eapbe3AP8z71PYtraG6o'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Achmad Hasan', 'email' => 'achmadhasan56518@gmail.com', 'username' => 'achmadHasan', 'password' => Hash::make('M8jopFrx6eMJHUBV4L17'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Agus Mahardika', 'email' => 'acan.hanter@gmail.com', 'username' => 'agusMahardika', 'password' => Hash::make('xgoK8BDYGwT6aMDxDvfW'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Amirrudin Ferdiansyah', 'email' => 'amirdakara2908@gmail.com', 'username' => 'amirrudinFerdiansyah', 'password' => Hash::make('rHoU10zfVRrz7mEofoTU'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Annis Annavi Rahayu', 'email' => 'annis@griyasafety.com', 'username' => 'annisAnnaviRahayu', 'password' => Hash::make('mnJiRfXnvc6dEM6BxVcn'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Bogi Prasetyo', 'email' => 'bogiprasetyo127@gmail.com', 'username' => 'bogiPrasetyo', 'password' => Hash::make('M0VzHiyD5XWmT3PbaJW6'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Dean Arle Fitriawan', 'email' => 'deanarlefitriawan@gmail.com', 'username' => 'deanArleFitriawan', 'password' => Hash::make('1RLVLH8VcNCYQrvqaC89'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Dita Anggraini', 'email' => 'ditaditawn@gmail.com', 'username' => 'ditaAnggraini', 'password' => Hash::make('P52QMoJDfg5F34aaFLc5'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Kemala Indah Sari', 'email' => 'kemalaindahs@gmail.com', 'username' => 'kemalaIndahSari', 'password' => Hash::make('NtZYnM01TimVrNYeNuQp'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Lina Dahliana', 'email' => 'linadahlianaa@gmail.com', 'username' => 'linaDahliana', 'password' => Hash::make('qmxf8e405XA2gz4VTK6C'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Marsela Istanti', 'email' => 'marselaistanti.tanti@gmail.com', 'username' => 'marselaIstanti', 'password' => Hash::make('YND6WiXa2KpTWfG5EZ3d'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Mohamad Fadli', 'email' => 'Abhelbalbo@gmail.com', 'username' => 'mohamadFadli', 'password' => Hash::make('mmunEmDvNw4afdaVnYGT'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Niki Andriani', 'email' => 'nikiandriani210586@gmail.com', 'username' => 'nikiAndriani', 'password' => Hash::make('QxssKVx4KT4QnpdJjZKd'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Novi Suhardiman', 'email' => 'novisuhardiman85@gmail.com', 'username' => 'noviSuhardiman', 'password' => Hash::make('GvY64Zoc0hh9Wgjonndb'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Nur Adha Saptaningrum', 'email' => 'nuradha.saptaningrum.nas@gmail.com', 'username' => 'nurAdhaSaptaningrum', 'password' => Hash::make('vi2MaUHnTh9zkEYdvPRZ'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Rahmat Hidayat', 'email' => 'rahmat.bangle@gmail.com', 'username' => 'rahmatHidayat', 'password' => Hash::make('vmv0EJofVtR1jdomp7NT'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Sangga Rizzi Hermawan', 'email' => 'SRHermawan10@gmail.com', 'username' => 'sanggaRizziHermawan', 'password' => Hash::make('ADfAxxpNRCKGerGY8CBt'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Septia Wahdah', 'email' => 'septiawahdah08@gmail.com', 'username' => 'septiaWahdah', 'password' => Hash::make('y6BZ2TrMT7r0bTWTwLTE'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Shella Indrianti', 'email' => 'Shella.indrianti@gmail.com', 'username' => 'shellaIndrianti', 'password' => Hash::make('dEGttTCbL1bcWHWArdRv'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Sri Handayani Nurraharjo', 'email' => 'handa.dct@gmail.com', 'username' => 'sriHandayaniNurraharjo', 'password' => Hash::make('knVtyxmkx4a3ZTkryoNg'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Syafira Audri Septiningtias', 'email' => 'audrisyafira@gmail.com', 'username' => 'syafiraAudriSeptiningtias', 'password' => Hash::make('LYrnZMunyYyM4MAyn7dW'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Tasya Diern Febrilia', 'email' => 'tasya@griyasafety.com', 'username' => 'tasyaDiernFebrilia', 'password' => Hash::make('m42V0kxnuv0g9kxiUcN8'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Thasyah Aini', 'email' => 'ainithasyah8@gmail.com', 'username' => 'thasyahAini', 'password' => Hash::make('KevX4rwtYhRtCURiXHZd'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Tita Lia Rasmara', 'email' => 'titarasmaraa@gmail.com', 'username' => 'titaLiaRasmara', 'password' => Hash::make('EtAZx79HvG0to1DG2bkZ'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Vieda Aphrodetty Herliena', 'email' => 'Vieda.aphrodetty72@gmail.com', 'username' => 'viedaAphrodettyHerliena', 'password' => Hash::make('cRQuZQ6VZP1raVobd9G9'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Aji Esa Nirwana', 'email' => 'ajiesanirwanaa@gmail.com', 'username' => 'ajiEsaNirwana', 'password' => Hash::make('nwcer6A3i2FQ9BMhqLo8'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Saep Reza Pratama', 'email' => 'saepreza41@gmail.com', 'username' => 'saepRezaPratama', 'password' => Hash::make('pemMG3hn97nY1W2d4Pkq'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Untung Wijaya', 'email' => 'gizza9009@gmail.com', 'username' => 'untungWijaya', 'password' => Hash::make('5MEHwnT0RXjXH1Fcgoa5'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Setyo Budi Utomo', 'email' => 'setyobudiu20@gmail.com', 'username' => 'setyoBudiUtomo', 'password' => Hash::make('Qy1WD2Ub9hFcGPqMKYnW'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Hendi Permadi', 'email' => 'Hasegawanaoki77@gmail.com', 'username' => 'hendiPermadi', 'password' => Hash::make('aF3KjKkqThqmCgdRoKcs'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Fadli Ahmad Hamzah', 'email' => 'fadlihamzah070700@gmail.com', 'username' => 'fadliAhmadHamzah', 'password' => Hash::make('2oaXVmLrjC7P38gKJs0i'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Ari Subekhan', 'email' => 'arisubekhan21@gmail.com', 'username' => 'ariSubekhan', 'password' => Hash::make('mXB0bckzA8FtEnTEGc1p'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Bani Ismail', 'email' => 'baniismail24@gmail.com', 'username' => 'baniIsmail', 'password' => Hash::make('shVEdwajATsZxEwMHE0Z'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Alfin Nur', 'email' => 'finzfour@gmail.com', 'username' => 'alfinNur', 'password' => Hash::make('5r7sDPZuV0Pktb9duh2a'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');

        $user = User::create(['nama' => 'Satrio Akbar Sudigdo', 'email' => '7.1.satrioakbar@gmail.com', 'username' => 'satrioAkbar', 'password' => Hash::make('kze58Xg0Jv1rDMZhzvrf'), 'memiliki_sim' => 1, 'first_login' => 1]);
        $user->assignRole('user');
    }
}
