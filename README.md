# Laravel Hotel

## Init DB
- DB Name: hotel_app
## Init Commands:
- php artisan migrate:fresh --seed
- php artisan db:seed --class=UserSeeder
- php artisan serv

## Login:
- Email: admin@admin.com
- Password: admin
## Alur Laravel Hotel

- Pelanggan Daftar ke Admin
- Isi identitas diri pelanggan (berdasarkan KTP)
    - Diisi oleh Admin
- Pesan kamar (berapa orang?)
    - Diisi oleh Admin berdasarkan permintaan pelanggan
        - kamar direkomendasikan oleh sistem berdasarkan nilai yang diinput.
- Pilih kamar berdasarkan banyak orang
    - Diisi oleh Admin berdasarkan permintaan pelanggan
        - Pilih tipe kamar, fasilitas, dan harga.
- Masuk dan Selesai kapan?
    - Diisi oleh Admin berdasarkan kesepakatan Check In, dan Check Out sementara untuk kalkulasi harga (dapat bertambah jika bermalam lebih lama)
- DP awal
    - Diisi oleh Admin berdasarkan nilai DP Minimal berdasarkan Tipe
- Selesai (Check Out) dan pelunasan kekurangan pembayaran


## Laravel License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
