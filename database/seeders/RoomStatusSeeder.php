<?php

namespace Database\Seeders;

use App\Models\RoomStatus;
use Illuminate\Database\Seeder;

class RoomStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Vacant',
            'Occupied',
            'Occupied Clean',
            'Occupied Dirty',
            'Vacant Clean Inspected',
            'Vacant Clean',
            'Vacant Dirty',
            'Compliment',
            'House Use',
            'Do not Disturb',
            'Sleep Out',
            'Skipper',
            'Out of Service',
            'Out of Order',
            'Due Out / Expected Departure',
            'Expected Arrival',
            'Check Out',
            'Late Check Out',
            'Occupied no Luggage',
            'Double Lock',
        ];

        $codes = [
            'V',
            'O',
            'OC',
            'OD',
            'VCI',
            'VC',
            'VD',
            'Comp',
            'HU',
            'DND',
            'SO',
            'Skip',
            'OS',
            'OOO',
            'DO/ED',
            'EA',
            'CO',
            'LCO',
            'ONL',
            'DL',
        ];

        $informations = [
            'Sebutan bagi kamar yang kosong.',
            'Suatu kamar yang sedang ditempati oleh sesorang secara sah dan teregister sebagai tamu hotel.',
            'Suatu kamar yang sedang ditempati oleh sesorang secara sah dan teregister sebagai tamu hotel pada kamar yang bersih.',
            'Suatu kamar yang sedang ditempati oleh sesorang secara sah dan teregister sebagai tamu hotel pada kamar yang kotor. Ini terjadi akibat perubahan status dari OC ke OD setelah melewati satu malam stay.',
            'Kamar kosong yang sudah dibersihkan dan diperiksa oleh floor supervisor dan siap untuk menerima tamu (dijual).',
            'Kamar yang kosong dengan keadaan bersih.',
            'Kamar yang kosong dengan keadaan kotor. kamar kotor dapat terjadi karena tamu yang sudah check out atau program cleaning dari housekeeping.',
            'Kamar yang terigester oleh seorang tamu, namun kamar tersebut free of charge (gratis).',
            'Kamar yang teregister tetapi digunakan oleh pihak managemen hotel.',
            'Kamar yang menaruh tanda tersebut berarti tamu tidak ingin di ganggu.',
            'Seorang tamu yang masih teregister, namun kamar tidak dipergunakan karena tamu tesebut harus meninggalkan hotel beberapa hari atau tamu sedang tidur diluar area hotel.',
            'Tamu meninggalkan hotel sebelum melunasi semua kewajibannya .',
            'Status kamar yang sedang dalam perbaikan.',
            'Kamar yang memerlukan perbaikan yang serius, biasanya lama perbaikan lebih dari satu hari. Status ini dapat terjadi karena kerusakan di kamar atau progam cleaning dari housekeeping.Out of order mengurangi room availability.',
            'Daftar kamar-kamar yang diharapkan untuk check-out hari ini sesuai dengan tanggal departure.',
            'Daftar nama-nama tamu yang diharapkan tiba hari ini.',
            'Tamu yang sudah meninggalkan hotel hari ini setelah melunasi semua kewajibannya termasuk menyerahkan kunci yang dipakai ke front office.',
            'Permintaan tamu untuk meninggalkan hotel lebih lambat dari waktu check out yang ditentukan.',
            'Seorang tamu yang masih teregister pada suatu kamar tanpa suatu barang apapun di dalamnya.',
            'Permintaan tamu ke pihak hotel untuk melakukan double lock sehingga tidak seorangpun dapat masuk ke kamar tersebut.',
        ];

        for ($i = 0; $i < count($codes); $i++) {
            RoomStatus::create([
                'name' => $names[$i],
                'code' => $codes[$i],
                'information' => $informations[$i],
            ]);
        }
    }
}
