# Block Anotasi - Moodle Block Plugin

Block plugin untuk Moodle yang menampilkan anotasi modul dan mendukung Moodle Mobile App dengan navigasi halaman.

## Fitur

- ✅ **Mobile App Support**: Fully compatible dengan Moodle Mobile App
- ✅ **Dashboard Integration**: Dapat ditambahkan ke dashboard pengguna
- ✅ **API Integration**: Ready untuk integrasi dengan API eksternal
- ✅ **Page Navigation**: Navigation dengan tombol Previous/Next pada mobile app
- ✅ **Responsive Design**: Menggunakan Ionic components untuk mobile UI
- ✅ **Dummy Data**: Dilengkapi dengan data dummy untuk testing

## Struktur File

```
blocks/anotasi/
├── version.php                           # Plugin version definition
├── block_anotasi.php                     # Main block class
├── view.php                              # Web view page
├── db/
│   ├── access.php                        # Capabilities definition
│   └── mobile.php                        # Mobile app configuration
├── classes/
│   ├── api_service.php                   # API service class
│   └── output/
│       └── mobile.php                    # Mobile output handlers
├── templates/
│   ├── content.mustache                  # Web block content template
│   ├── mobile_modules_list.mustache      # Mobile modules list template
│   └── mobile_annotation_detail.mustache # Mobile annotation detail template
├── lang/en/
│   └── block_anotasi.php                 # Language strings
└── styles/
    └── mobile.css                        # Mobile app styles
```

## Instalasi

1. **Upload File**: Salin folder `anotasi` ke dalam direktori `blocks/` Moodle Anda.

2. **Install Plugin**:

   - Login sebagai administrator
   - Pergi ke `Site administration > Notifications`
   - Ikuti proses instalasi plugin

3. **Purge Cache**:
   - Pergi ke `Site administration > Development > Purge all caches`

## Penggunaan

### Web Interface

1. Pergi ke Dashboard
2. Turn editing on
3. Add block "Anotasi Block"
4. Block akan menampilkan informasi modul dan link untuk melihat detail

### Mobile App

1. Login ke Moodle Mobile App
2. Block akan muncul sebagai menu item di dashboard
3. Klik untuk melihat daftar modul
4. Klik modul untuk melihat anotasi dengan navigasi halaman

## Fitur Mobile App

### Halaman List Modul

- Menampilkan daftar modul yang tersedia
- Setiap modul menunjukkan nama, course ID, module ID, dan jumlah anotasi
- Icon dan styling yang menarik

### Halaman Detail Anotasi

- Menampilkan anotasi per halaman
- Page counter (e.g., "Page 1 of 3")
- Tombol Previous/Next untuk navigasi
- Progress bar untuk indikator halaman
- Tombol back untuk kembali ke list modul

## Data API Format

Plugin ini menggunakan format API response sebagai berikut:

```json
{
  "status": "success",
  "data": {
    "modul_name": "Algoritma",
    "course_id": "CSE101",
    "modul_id": "MOD2025A",
    "annotations": [
      {
        "page": "Page 1",
        "text": "Konten anotasi halaman 1..."
      },
      {
        "page": "Page 2",
        "text": "Konten anotasi halaman 2..."
      }
    ]
  }
}
```

## Kustomisasi

### Mengganti Data Dummy

Edit file `classes/api_service.php` method `get_module_data()` untuk mengintegrasikan dengan API real.

### Menambah Modul

Edit method `get_modules_list()` untuk menampilkan multiple modules.

### Styling

Edit file `styles/mobile.css` untuk mengubah tampilan mobile app.

## Capabilities

- `block/anotasi:addinstance` - Menambah block ke course
- `block/anotasi:myaddinstance` - Menambah block ke dashboard
- `block/anotasi:view` - Melihat konten block

## Kompatibilitas

- Moodle 3.9+
- Moodle Mobile App 4.0+
- PHP 7.4+

## Testing Mobile App

1. **Browser Testing**:

   - Buka `https://latest.apps.moodledemo.net/`
   - Login ke site Moodle Anda

2. **Cache Management**:
   - Setelah ubah `mobile.php` → Refresh browser
   - Setelah ubah template → Pull to refresh di app
   - Jika tidak berubah → Purge all caches

## Troubleshooting

### Block tidak muncul di mobile app

1. Pastikan file `db/mobile.php` sudah benar
2. Purge all caches
3. Logout dan login kembali di mobile app

### Template tidak update

1. Lakukan Pull to Refresh (PTR) di mobile app
2. Clear browser cache jika testing di browser

### Navigation tidak berfungsi

1. Periksa JavaScript di `classes/output/mobile.php`
2. Pastikan parameter yang dikirim sudah benar

## Development

Untuk development lebih lanjut:

1. **Add Real API**: Ganti dummy data dengan real API call
2. **Add Authentication**: Tambah autentikasi untuk API external
3. **Add Caching**: Implementasi caching untuk performa
4. **Add Search**: Tambah fitur pencarian anotasi
5. **Add Bookmarks**: Tambah fitur bookmark halaman tertentu

## License

GPL v3 or later
