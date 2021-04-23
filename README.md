# Laravel Hotel

## Modul
- Dashboard
    - Guests Chart
    - Guests on this day

- Transaction
    - Payment
        - Create & Store Payment
        - Payment History
    - Room Reservation
        - Step:
            1. Choose Customer:
                - Create New Customer / Pick from existing Customer
            2. Input Form:
                - How many people
                - Date for Check In
                - Date for Check Out
            3. Pick Available Room:
                - Check unoccupied room between date Check in and Check out.
                - Room Capacity must be > than input how many people.
            4. Confirmation & Down Payment
                - Down Payment: 15% of total price
                - Payment must be equal or higher than Down Payment
            5. If the transaction Success:
                - Send Email notification to Super Role about transaction payment.
                - Send push notification to Super Role.

- CUSTOMER Management
    - Create Customer
    - Read Customer
        - Paginate
        - Search
    - Update Customer
    - Delete Customer
        - Cannot be deleted if the customer has transaction
    - Customer Detail

- USER Management
    - Create User
    - Read User (Super, Admin)
        - Paginate
        - Search
    - Read User (Customer)
        - Paginate
        - Search
    - Update User
    - Delete User
        - Cannot be deleted if the User has transaction
    - User Detail

- ROOM Management
    - Create Room
    - Read Room
        - Paginate
        - Search
    - Update Room
    - Delete Room
        - Cannot be deleted if the Room already connected in transaction
    - Room Detail

- CRUD ROOM TYPE
    - Create Room Type
    - Read Room Type
        - Paginate 
        - Search
    - Update Room Type
    - Delete Room Type

- CRUD ROOM STATUS
    - Create Room Status
    - Read Room Status
        - Paginate
        - Search
    - Update Room Status
    - Delete Room Status

## Fitur

## TODO:
- Nota Pembayaran                                                   (Done)
- Notifikasi & Email pemesanan kamar ke super admin                 (Done)
- Notifikasi & Email status pembayaran ke admin                     (Done)
- Customer meminta kamar dibersihkan (Pop notifikasi untuk admin)   
- Customer pesan makan (Pop notifikasi untuk admin)

## Init DB
- Create DB Name: hotel_app
## Init Commands:
```
composer install
npm install && npm run dev
php artisan migrate:fresh --seed
php artisan serv                => Terminal 1
php artisan websockets:serv     => Terminal 2   //Menjalankan websocket
```

## Login:
- Email: wailantirajoh@gmail.com
- Password: wailan

## Notes:
- Jika tampilan bootstrap tidak terpanggil:
    1. [Download bootstrap 5](https://github.com/twbs/bootstrap/releases/download/v5.0.0-beta3/bootstrap-5.0.0-beta3-dist.zip)
    2. Extract dan copy folder JS dan CSS.
    3. Ganti file pada hotel-app -> public -> package -> bootstrap (Didalam sini ada JS dan CSS, ganti file tersebut dengan JS dan CSS yang telah didownload)


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


## Alur App untuk Admin
1. Identity Card
2. For how many person?
3. Choose a room
4. Pick day for Check in and check out
5. Down payment for first transaction (25% of total price)
6. Check out and Pay off the bill

## Laravel License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
