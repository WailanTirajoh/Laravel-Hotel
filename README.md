# Laravel Hotel


## Init DB
- DB Name: hotel_app
## Init Commands:
- composer install
- php artisan migrate:fresh --seed
- php artisan db:seed --class=UserSeeder
- php artisan serv

## Login:
- Email: admin@admin.com
- Password: admin

## Notes:
- Jika tampilan bootstrap tidak terpanggil
    - Todo:
        - [Download bootstrap 5](https://github.com/twbs/bootstrap/releases/download/v5.0.0-beta3/bootstrap-5.0.0-beta3-dist.zip)
        - Extract dan copy JS dan CSS folder.
        - Ganti file pada hotel-app -> public -> package -> bootstrap (Didalam sini ada JS dan CSS, ganti file tersebut dengan JS dan CSS yang telah didownload)


## ERD
![alt text](https://github.com/WailanTirajoh/laravel_hotel/blob/main/erd.PNG?raw=true)

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
