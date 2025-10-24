# Testing Instructions untuk Block Anotasi

## Steps untuk Testing

### 1. Install Plugin

1. Login sebagai administrator Moodle
2. Pergi ke `Site administration > Notifications`
3. Follow the installation process
4. Purge all caches: `Site administration > Development > Purge all caches`

### 2. Add Block ke Dashboard

1. Login sebagai user biasa
2. Pergi ke Dashboard
3. Click "Customise this page" atau "Turn editing on"
4. Add block "Anotasi Block"
5. Block akan muncul dengan informasi modul "Algoritma"

### 3. Testing di Web Browser

1. Block akan menampilkan:
   - Module name: Algoritma
   - Course ID: CSE101
   - Module ID: MOD2025A
   - 3 annotations badge
2. Click "View Annotations" untuk melihat halaman detail

### 4. Testing di Mobile App

1. Buka browser: `https://latest.apps.moodledemo.net/`
2. Login ke site Moodle Anda
3. Block "Module Annotations" akan muncul sebagai menu item
4. Click untuk membuka list modul
5. Click modul "Algoritma" untuk membuka anotasi
6. Test navigation dengan tombol Previous/Next

## Expected Behavior Mobile App

### Halaman List Modul:

- Header: "Module Annotations"
- Card berisi: "Available Modules"
- Item: Algoritma dengan info course & module ID
- Badge: "3 annotations"
- Click item → Navigate ke halaman detail

### Halaman Detail Anotasi:

- Header: "Algoritma" dengan back button
- Page counter: "Page 1 of 3"
- Content: Anotasi text untuk halaman tersebut
- Navigation buttons: Previous (disabled di page 1) & Next
- Progress bar di bawah
- Back button → Kembali ke list modul

### Navigation:

- Next button: Page 1 → Page 2 → Page 3
- Previous button: Page 3 → Page 2 → Page 1
- Previous disabled di Page 1
- Next disabled di Page 3

## Troubleshooting

### Jika block tidak muncul di mobile:

1. Purge all caches
2. Logout dan login kembali di mobile app
3. Refresh browser (jika testing di browser)

### Jika navigation tidak berfungsi:

1. Check browser console untuk errors
2. Verify template syntax
3. Check mobile.php configuration

### Jika content tidak update:

1. Pull to refresh di mobile app
2. Clear browser cache
3. Check version number di mobile.php styles

## Data Structure Used

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
        "text": "Sistem operasi mengelola sumber daya..."
      },
      {
        "page": "Page 2",
        "text": "Manajemen memori bertanggung jawab..."
      },
      {
        "page": "Page 3",
        "text": "Multitasking memungkinkan beberapa..."
      }
    ]
  }
}
```

## Files Modified

1. `db/mobile.php` - Mobile app configuration
2. `classes/output/mobile.php` - Mobile output handlers
3. `templates/mobile_modules_list.mustache` - List template
4. `templates/mobile_annotation_detail.mustache` - Detail template

## Key Changes Made

1. ✅ Menggunakan `core-site-plugins-new-content` directive untuk navigation
2. ✅ Simplified JavaScript (tidak perlu custom functions)
3. ✅ Fixed page calculation (dilakukan di PHP, bukan Mustache)
4. ✅ Added proper handler untuk `view_module_annotations`
5. ✅ Improved template structure dengan samePage navigation
