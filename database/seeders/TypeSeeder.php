<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = [
            'Standard Room',
            'Superior Room',
            'Deluxe Room',
            'Junior Suite Room',
            'Suite Room',
            'Presidential Suite',
            'Single Room',
            'Twin Room',
            'Double Room',
            'Family Room/Triple Room',
            'Connecting Room',
            'Murphy Room',
            'Accessible Room/Disabled Room',
            'Smoking/Non Smoking Room',
            'Cabana Room',
        ];

        $information = [
            'Seperti namanya, jenis kamar standard room adalah tipe kamar hotel yang paling dasar di hotel. Biasanya, kamar tipe ini dibanderol dengan harga yang relatif murah. Fasilitas yang ditawarkan pun standar seperti kasur ukuran king size atau dua queen size. Namun, penawaran yang diberikan tergantung pada masing-masing hotel. Standard room hotel bintang 1 dan bintang 5 tentu berbeda.',
            'Pada dasarnya, superior room adalah tipe kamar yang sedikit lebih baik dari tipe standard room. Perbedaannya dapat berupa dari fasilitas yang diberikan, interior kamar, atau pemandangan dari kamar.',
            'Di atas tipe kamar hotel superior room adalah deluxe room. Kamar ini tentu memiliki kamar yang lebih besar. Tersedia pilihan kasur yang bisa kamu pilih, double bed atau twin bed. Biasanya, dari segi interior kamar ini terkesan lebih mewah.',
            'Tipe kamar hotel junior suite room ditandai dengan adanya ruang tamu. Namun, ruang tamu tersebut masih berada satu ruangan dengan tempat tidur. Ruang tamu tersebut biasanya dibatasi atau disekat dengan lemari besar agar tempat tidur tidak terlihat. ',
            'Suite room berada di atas tipe kamar hotel junior suite room. Ruang tamu di kamar hotel ini terpisah dari kamar tidur. Dari segi fasilitas, tentu berbeda dari junior suite room. Selain ruang tamu, biasanya tipe kamar hotel ini dilengkapi dengan dapur.',
            'Presidential suite adalah tipe kamar hotel yang terbaik dan paling mahal. Bahkan, tidak semua hotel memiliki presidential suite. Fasilitas yang ditawarkan pun tentu yang terbaik, mulai dari interior, pemandangan kamar, dan masih banyak lainnya.',
            'Single room adalah tipe kamar hotel yang paling umum. Tipe kamar hotel ini terdiri dari satu single bed, sofa, dan kamar mandi. Ukuran kamarnya juga tidak terlalu besar. Biasanya tipe kamar hotel ini dipilih oleh para backpacker atau solo traveler karena fasilitasnya memang untuk satu orang dan harga yang murah.',
            'Dari namanya saja, sudah bisa ditebak bahwa tipe kamar hotel ini memiliki dua tempat tidur ukuran single yang terpisah. Tipe kamar hotel ini cocok digunakan untuk suami istri atau menginap bersama teman dengan jumlah orang 2-3 orang.',
            'Ingin menginap dengan lebih nyaman dan fasilitas yang lebih baik? Kamu bisa memesan tipe kamar hotel double room. Tipe kamar hotel ini biasanya memiliki ukuran kasur yang besar seperti king size. Double room ini cocok banget buat pasangan suami istri yang ingin berbulan madu.',
            'Pergi traveling bersama keluarga besar atau teman-teman? Kamu bisa pilih tipe kamar hotel family room. Dari segi ukuran kamar, tentu jauh lebih luas daripada tipe kamar hotel lainnya. Tipe kamar hotel family room ini biasanya tersedia satu tempat dengan ukuran king size dan satu tempat tidur dengan ukuran yang lebih kecil.',
            'Tipe kamar hotel dengan Connecting Room ini cocok untuk kamu yang pergi bersama keluarga besar atau rombongan tetapi ingin memiliki kamar tidur masing-masing.  Kamar kamu dan anggota keluarga lainnya akan bersebelahan dan terdapat pintu yang menghubungkan kamar kalian. Sehingga, kalau kamu atau anggota keluarga lainnya ingin ke kamar satu sama lain, bisa melalui connecting door dan tidak perlu repot melalui pintu depan, Toppers.',
            'Murphy room ini adalah tipe kamar hotel yang menyediakan sofa bed di kamar. Sofa bed ini digunakan sebagai tempat tidur pada malam hari dan ruang tamu di siang hari. Besar kamar Murphy Room ini sekitar 20 – 40 m. Wah, seru, ya konsepnya!',
            'Tipe kamar Accessible Room/Disable Room ini tersedia untuk para tamu yang memiliki keterbatasan. Adanya tipe kamar ini juga diwajibkan oleh hukum, loh, untuk menghindari diskriminasi. Hal ini juga dibuat agar memudahkan tamu-temu tersebut saat menginap di hotel.',
            'Biasanya tamu tidak diizinkan untuk merokok di dalam kamar. Tetapi, banyak hotel yang sudah menyediakan tipe kamar hotel Smoking/Non Smoking Room. Hal ini juga berguna agar tidak mengganggu tamu selanjutnya dengan aroma rokok yang terdapat pada kamar. Jadi, kalau kamu seorang perokok, sekarang bisa memesan kamar dengan tipe smooking room.',
            'Kamu ingin langsung berenang saat buka pintu kamar? Atau punya private pool? Pilih tipe kamar hote Cabana Room! Tipe kamar hotel ini memang didesain dengan kolam renang private untuk pemesan kamar tersebut. Luas kamar Cabana Room ini sekitar 30 – 40 m.',
        ];

        for ($i = 0; $i < count($name); $i++) {
            Type::create([
                'name' => $name[$i],
                'information' => $information[$i],
            ]);
        }
    }
}
