# PROMPT REBRANDING — COLOR PALETTE & TYPOGRAPHY
## Website Desa Wisata Petik Jeruk Selorejo
### Mengganti seluruh warna & font: Front-end Publik + Dashboard Operator/Admin
---

> **KONTEKS:** Project Laravel 11 sudah 100% selesai. Prompt ini KHUSUS
> mengganti Color Palette dan Font di SELURUH halaman (publik + dashboard)
> sesuai design reference yang sudah ditentukan.
> Kirim satu per satu secara berurutan. Jangan gabungkan prompt.

---

## ═══════════════════════════════════════
## ANALISIS DESIGN REFERENCE
## (Baca ini sebelum mengeksekusi prompt manapun)
## ═══════════════════════════════════════

```
COLOR PALETTE YANG DIGUNAKAN (7 warna utama):

┌─────────────────────────────────────────────────────────────┐
│  NAMA          │  HEX        │  PERAN DI WEBSITE            │
├─────────────────────────────────────────────────────────────┤
│  SUNSHINE      │  #F5C518    │  Accent utama, CTA button,   │
│                │             │  highlight, badge penting    │
├─────────────────────────────────────────────────────────────┤
│  CREAM         │  #F5F0E8    │  Background utama semua      │
│                │             │  halaman (ganti #f8f9f0)     │
├─────────────────────────────────────────────────────────────┤
│  CRISP CARRO   │  #F26522    │  Secondary accent, hover     │
│  (Oranye)      │             │  state, ikon, dekorasi       │
├─────────────────────────────────────────────────────────────┤
│  TOMATO BURST  │  #D93025    │  Error/danger, notif penting │
│  (Merah)       │             │  delete button               │
├─────────────────────────────────────────────────────────────┤
│  FOREST GREEN  │  #1A5C38    │  Primary utama, navbar,      │
│                │             │  sidebar, heading utama      │
├─────────────────────────────────────────────────────────────┤
│  KIWI          │  #7CB518    │  Secondary green, badge,     │
│  (Hijau lime)  │             │  success state, link         │
├─────────────────────────────────────────────────────────────┤
│  SKY BLUE      │  #2AABE2    │  Info state, link aktif,     │
│  (Biru muda)   │             │  chart warna ke-4            │
├─────────────────────────────────────────────────────────────┤
│  LIGHT GRAY    │  #E8E8E8    │  Border, divider, input bg   │
│  (Abu netral)  │             │  disabled state              │
└─────────────────────────────────────────────────────────────┘

FONT YANG DIGUNAKAN:

┌─────────────────────────────────────────────────────────────┐
│  FONT           │  PERAN                │  WEIGHT           │
├─────────────────────────────────────────────────────────────┤
│  Peace Sans     │  Display / Hero /     │  700 (Bold)       │
│                 │  Judul besar halaman  │                   │
├─────────────────────────────────────────────────────────────┤
│  Open Sauce One │  Heading H1–H3,       │  400, 600, 700    │
│                 │  Navbar, Sidebar,     │                   │
│                 │  Label, Button        │                   │
├─────────────────────────────────────────────────────────────┤
│  Open Sauce One │  Body text, paragraf, │  400 (Regular)    │
│  (atau fallback │  form input, tabel,   │                   │
│  system-ui)     │  keterangan           │                   │
└─────────────────────────────────────────────────────────────┘

CATATAN PENTING:
- "Peace Sans" adalah font bebas/free untuk penggunaan personal.
  Karena tidak tersedia di Google Fonts, kita gunakan alternatif
  terdekat yang TERSEDIA di Google Fonts: "Playfair Display" (serif bold)
  atau "Bebas Neue" (display sans) sebagai pengganti Peace Sans.
  → PILIHAN: Gunakan "Bebas Neue" untuk judul display (paling mirip Peace Sans).

- "Open Sauce One" tersedia di Google Fonts.
  URL: https://fonts.google.com/specimen/Open+Sauce+One
  → Gunakan ini untuk semua teks UI, body, heading reguler.
```

---

## ═══════════════════════════════════════
## PROMPT CP-1 — SETUP CSS VARIABLES & GOOGLE FONTS
## ═══════════════════════════════════════

```
Saya punya project Laravel 11 — Website Desa Wisata Petik Jeruk Selorejo
yang sudah 100% selesai. Saya ingin mengganti seluruh Color Palette dan Font
sesuai design reference baru.

TUGAS: Setup CSS Variables dan Google Fonts sebagai fondasi perubahan.

LANGKAH 1 — Import Google Fonts:
Buka file: resources/css/app.css
Di baris PALING ATAS (sebelum semua import lainnya), tambahkan:

@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap');

Catatan: "Open Sauce One" memiliki nama serupa dengan "Open Sans" di Google Fonts.
Untuk kepastian ketersediaan, gunakan "Open Sans" (Google Fonts resmi) sebagai
pengganti "Open Sauce One" karena keduanya adalah sans-serif humanist yang sangat mirip.
"Bebas Neue" digunakan sebagai pengganti "Peace Sans" (display font bold).

LANGKAH 2 — Ganti SELURUH CSS Variables:
Buka file: resources/css/app.css
Cari bagian :root { ... } yang sudah ada dan GANTI SELURUHNYA dengan:

:root {
  /* ── COLOR PALETTE UTAMA ── */
  --color-sunshine:     #F5C518;   /* Kuning — Accent, CTA, Highlight */
  --color-cream:        #F5F0E8;   /* Krem — Background halaman */
  --color-carro:        #F26522;   /* Oranye — Secondary accent, hover */
  --color-tomato:       #D93025;   /* Merah — Danger, delete, error */
  --color-forest:       #1A5C38;   /* Hijau tua — Primary, navbar, sidebar */
  --color-kiwi:         #7CB518;   /* Hijau lime — Success, badge, link */
  --color-sky:          #2AABE2;   /* Biru — Info, active link */
  --color-gray-light:   #E8E8E8;   /* Abu — Border, divider */
  --color-gray-mid:     #9E9E9E;   /* Abu sedang — Placeholder, muted */
  --color-dark:         #1A1A1A;   /* Hitam teks */
  --color-white:        #FFFFFF;

  /* ── ALIAS SEMANTIK (dipakai di komponen) ── */
  --primary:            var(--color-forest);    /* #1A5C38 */
  --primary-dark:       #0F3D25;               /* Forest lebih gelap untuk hover */
  --primary-light:      #2E7D4F;               /* Forest lebih terang */
  --secondary:          var(--color-kiwi);      /* #7CB518 */
  --accent:             var(--color-sunshine);  /* #F5C518 */
  --accent-hover:       #D4A914;               /* Sunshine lebih gelap saat hover */
  --accent-orange:      var(--color-carro);     /* #F26522 */
  --danger:             var(--color-tomato);    /* #D93025 */
  --info:               var(--color-sky);       /* #2AABE2 */
  --success:            var(--color-kiwi);      /* #7CB518 */
  --bg-page:            var(--color-cream);     /* #F5F0E8 — background semua halaman */
  --bg-card:            #FFFFFF;               /* Background card */
  --bg-sidebar:         var(--color-forest);   /* #1A5C38 — sidebar dashboard */
  --bg-navbar:          #FFFFFF;               /* Navbar publik */
  --bg-topbar:          var(--color-forest);   /* Top bar publik */
  --border-color:       var(--color-gray-light); /* #E8E8E8 */
  --text-primary:       var(--color-dark);      /* #1A1A1A */
  --text-muted:         var(--color-gray-mid);  /* #9E9E9E */
  --text-on-primary:    #FFFFFF;               /* Teks di atas warna primary */
  --text-on-accent:     #1A1A1A;              /* Teks di atas sunshine (gelap) */

  /* ── TYPOGRAPHY ── */
  --font-display:   'Bebas Neue', 'Impact', sans-serif;
  --font-heading:   'Open Sans', 'Segoe UI', system-ui, sans-serif;
  --font-body:      'Open Sans', 'Segoe UI', system-ui, sans-serif;
  --font-mono:      'Courier New', monospace;

  /* ── FONT SIZE SCALE ── */
  --text-xs:    0.72rem;    /* 11.5px */
  --text-sm:    0.825rem;   /* 13.2px */
  --text-base:  1rem;       /* 16px */
  --text-lg:    1.125rem;   /* 18px */
  --text-xl:    1.375rem;   /* 22px */
  --text-2xl:   1.75rem;    /* 28px */
  --text-3xl:   2.25rem;    /* 36px */
  --text-4xl:   3rem;       /* 48px */
  --text-display: 4rem;     /* 64px — khusus hero */

  /* ── SPACING & RADIUS ── */
  --radius-sm:   6px;
  --radius-md:   10px;
  --radius-lg:   16px;
  --radius-xl:   24px;
  --shadow-sm:   0 1px 4px rgba(26,92,56,0.08);
  --shadow-md:   0 4px 16px rgba(26,92,56,0.12);
  --shadow-lg:   0 8px 32px rgba(26,92,56,0.16);
}

LANGKAH 3 — Tambahkan Global Base Styles:
Setelah blok :root { } di atas, tambahkan:

/* ── GLOBAL BASE ── */
*,
*::before,
*::after {
  box-sizing: border-box;
}

html {
  scroll-behavior: smooth;
}

body {
  font-family: var(--font-body);
  font-size: var(--text-base);
  color: var(--text-primary);
  background-color: var(--bg-page);
  line-height: 1.6;
  -webkit-font-smoothing: antialiased;
}

/* ── HEADINGS: Open Sans untuk H1–H6 ── */
h1, h2, h3, h4, h5, h6,
.h1, .h2, .h3, .h4, .h5, .h6 {
  font-family: var(--font-heading);
  font-weight: 700;
  color: var(--text-primary);
  line-height: 1.25;
}

/* ── DISPLAY HEADINGS: Bebas Neue (pengganti Peace Sans) ── */
.display-1, .display-2, .display-3, .display-4,
.display-5, .display-6,
.font-display,
.hero-title,
.section-display-title {
  font-family: var(--font-display) !important;
  letter-spacing: 0.03em;
  line-height: 1.1;
}

/* ── BOOTSTRAP VARIABLE OVERRIDES ── */
/* Warna Bootstrap disesuaikan dengan palette baru */
.btn-primary {
  background-color: var(--primary) !important;
  border-color: var(--primary) !important;
  color: var(--text-on-primary) !important;
  font-family: var(--font-heading);
  font-weight: 600;
}
.btn-primary:hover,
.btn-primary:focus {
  background-color: var(--primary-dark) !important;
  border-color: var(--primary-dark) !important;
}

.btn-accent,
.btn-warning {
  background-color: var(--accent) !important;
  border-color: var(--accent) !important;
  color: var(--text-on-accent) !important;
  font-family: var(--font-heading);
  font-weight: 700;
}
.btn-accent:hover,
.btn-warning:hover {
  background-color: var(--accent-hover) !important;
  border-color: var(--accent-hover) !important;
  color: var(--text-on-accent) !important;
}

.btn-success {
  background-color: var(--color-kiwi) !important;
  border-color: var(--color-kiwi) !important;
  color: #fff !important;
}
.btn-danger {
  background-color: var(--color-tomato) !important;
  border-color: var(--color-tomato) !important;
  color: #fff !important;
}
.btn-info {
  background-color: var(--color-sky) !important;
  border-color: var(--color-sky) !important;
  color: #fff !important;
}

/* ── BADGE COLORS ── */
.badge.bg-primary { background-color: var(--primary) !important; }
.badge.bg-success { background-color: var(--color-kiwi) !important; }
.badge.bg-warning { background-color: var(--accent) !important; color: var(--text-on-accent) !important; }
.badge.bg-danger  { background-color: var(--color-tomato) !important; }
.badge.bg-info    { background-color: var(--color-sky) !important; }

/* ── LINKS ── */
a {
  color: var(--primary);
  transition: color 0.2s ease;
}
a:hover {
  color: var(--accent-orange);
  text-decoration: none;
}

/* ── FORM CONTROLS ── */
.form-control,
.form-select {
  font-family: var(--font-body);
  font-size: var(--text-base);
  border-color: var(--border-color);
  border-radius: var(--radius-sm);
  background-color: #fff;
  color: var(--text-primary);
}
.form-control:focus,
.form-select:focus {
  border-color: var(--primary);
  box-shadow: 0 0 0 3px rgba(26,92,56,0.12);
}
.form-label {
  font-family: var(--font-heading);
  font-weight: 600;
  font-size: var(--text-sm);
  color: var(--text-primary);
  margin-bottom: 6px;
}

/* ── CARDS ── */
.card {
  background: var(--bg-card);
  border: 1px solid var(--border-color);
  border-radius: var(--radius-md);
  box-shadow: var(--shadow-sm);
}
.card-header {
  font-family: var(--font-heading);
  font-weight: 700;
  background: #fff;
  border-bottom: 2px solid var(--border-color);
}

/* ── ALERTS ── */
.alert-success {
  background: #f0faf0;
  border-color: var(--color-kiwi);
  color: #2a5a0a;
}
.alert-danger {
  background: #fef0f0;
  border-color: var(--color-tomato);
  color: #8a1a14;
}
.alert-info {
  background: #f0f8ff;
  border-color: var(--color-sky);
  color: #0a4a6a;
}
.alert-warning {
  background: #fffbf0;
  border-color: var(--accent);
  color: #6a4a00;
}

/* ── TABLES ── */
.table th {
  font-family: var(--font-heading);
  font-weight: 700;
  font-size: var(--text-sm);
  background: var(--primary);
  color: #fff;
  border-color: var(--primary-dark);
}
.table td {
  font-size: var(--text-sm);
  color: var(--text-primary);
  vertical-align: middle;
}
.table-striped > tbody > tr:nth-of-type(odd) > * {
  background-color: rgba(245,240,232,0.6);
}

/* ── PAGINATION ── */
.page-link {
  color: var(--primary);
  border-color: var(--border-color);
  font-family: var(--font-body);
}
.page-link:hover {
  background-color: var(--accent);
  color: var(--text-on-accent);
  border-color: var(--accent);
}
.page-item.active .page-link {
  background-color: var(--primary);
  border-color: var(--primary);
  color: #fff;
}

/* ── BREADCRUMB ── */
.breadcrumb {
  font-family: var(--font-body);
  font-size: var(--text-sm);
  background: transparent;
}
.breadcrumb-item a {
  color: var(--primary);
}
.breadcrumb-item.active {
  color: var(--text-muted);
}

LANGKAH 4 — Jalankan build:
npm run build

LANGKAH 5 — Verifikasi di browser:
Buka http://desa-selorejo-v2.test/ 
Buka DevTools → Elements → :root
Pastikan semua CSS variable --color-forest, --accent, --font-display dll sudah terdefinisi.
Background halaman harus berubah menjadi krem (#F5F0E8).

HASIL YANG DIHARAPKAN:
- Font Open Sans aktif di seluruh body text
- CSS variables terdefinisi dan bisa dipakai di seluruh file CSS
- Background halaman krem, button primary hijau forest, accent kuning sunshine
- Belum semua komponen berubah — itu dikerjakan di prompt berikutnya
```

---

## ═══════════════════════════════════════
## PROMPT CP-2 — REBRANDING NAVBAR & FOOTER PUBLIK
## ═══════════════════════════════════════

```
Saya punya project Laravel 11 — Website Desa Wisata Petik Jeruk Selorejo.
CSS variables dan Google Fonts sudah disetup di prompt sebelumnya.

File target:
- resources/views/layouts/partials/public-header.blade.php
- resources/views/layouts/partials/public-footer.blade.php
- resources/css/app.css

TUGAS: Terapkan color palette dan font baru ke Navbar dan Footer publik.

=== NAVBAR PUBLIK ===

Buka public-header.blade.php dan ganti semua inline style / class warna dengan:

1. TOP BAR (background):
   Ganti background apapun yang ada dengan:
   style="background: var(--color-forest); color: #fff;"
   
   Font top bar:
   style="font-family: var(--font-body); font-size: var(--text-xs);"

2. MAIN NAVBAR:
   Ganti class/style background navbar menjadi:
   style="background: #fff; border-bottom: 3px solid var(--accent);"
   
   PENTING: Border bawah navbar menggunakan warna SUNSHINE (#F5C518) 
   untuk memberi aksen yang kuat sesuai palette baru.

3. BRAND/LOGO ICON (div background ikon daun):
   Ganti menjadi:
   style="background: var(--color-forest); border-radius: var(--radius-sm); padding: 7px;"
   
   Teks nama desa:
   style="font-family: var(--font-display); font-size: 1.1rem; 
          letter-spacing: 0.04em; color: var(--color-forest);"
   
   Teks sub (kecamatan/kabupaten):
   style="font-family: var(--font-body); font-size: var(--text-xs); color: var(--text-muted);"

4. MENU ITEMS (nav-link):
   Tambahkan di CSS (resources/css/app.css):
   
   /* Navbar public links */
   #mainNavbar .nav-link {
     font-family: var(--font-heading);
     font-size: var(--text-sm);
     font-weight: 600;
     color: var(--text-primary) !important;
     padding: 8px 14px;
     border-radius: var(--radius-sm);
     transition: background 0.2s, color 0.2s;
   }
   #mainNavbar .nav-link:hover,
   #mainNavbar .nav-link.active {
     background: var(--accent);
     color: var(--text-on-accent) !important;
   }
   #mainNavbar .dropdown-menu {
     border: none;
     border-top: 3px solid var(--accent);
     border-radius: 0 0 var(--radius-md) var(--radius-md);
     box-shadow: var(--shadow-md);
     padding: 8px 0;
   }
   #mainNavbar .dropdown-item {
     font-family: var(--font-body);
     font-size: var(--text-sm);
     color: var(--text-primary);
     padding: 9px 18px;
     transition: background 0.15s;
   }
   #mainNavbar .dropdown-item:hover {
     background: var(--color-cream);
     color: var(--color-forest);
   }
   /* Hamburger toggler warna */
   #mainNavbar .navbar-toggler {
     border: 2px solid var(--color-forest);
   }
   #mainNavbar .navbar-toggler-icon {
     filter: invert(20%) sepia(60%) saturate(800%) hue-rotate(110deg);
   }

5. RUNNING TEXT BAR:
   Ganti background-nya menjadi:
   style="background: var(--accent); padding: 7px 0; border-bottom: 2px solid var(--accent-hover);"
   
   Teks marquee:
   style="font-family: var(--font-body); font-size: var(--text-xs); 
          font-weight: 600; color: var(--text-on-accent);"

=== FOOTER PUBLIK ===

Buka public-footer.blade.php dan terapkan:

1. WRAPPER FOOTER:
   Ganti background footer menjadi:
   style="background: var(--color-forest); color: #fff; padding: 48px 0 0 0;"

2. JUDUL KOLOM FOOTER (h5/h6):
   style="font-family: var(--font-display); 
          font-size: 1.1rem;
          letter-spacing: 0.05em;
          color: var(--accent);   /* Kuning sunshine — kontras di atas hijau */
          margin-bottom: 16px;
          padding-bottom: 8px;
          border-bottom: 2px solid rgba(245,197,24,0.3);"

3. TEKS DAN LINK DALAM FOOTER:
   style="font-family: var(--font-body); font-size: var(--text-sm); 
          color: rgba(255,255,255,0.85); line-height: 1.8;"
   
   Link footer:
   Tambahkan di CSS:
   .footer-link {
     color: rgba(255,255,255,0.7) !important;
     font-family: var(--font-body);
     font-size: var(--text-sm);
     transition: color 0.2s;
     text-decoration: none;
   }
   .footer-link:hover {
     color: var(--accent) !important;
   }

4. BOTTOM BAR (copyright):
   style="background: var(--primary-dark); /* hijau lebih gelap */
          padding: 12px 0;
          margin-top: 40px;"
   
   Teks copyright:
   style="font-family: var(--font-body); font-size: var(--text-xs); 
          color: rgba(255,255,255,0.6); text-align: center;"

5. IKON SOSIAL MEDIA DI FOOTER:
   Bungkus setiap ikon dengan:
   <a href="..." class="footer-social-icon">
     <i data-lucide="facebook" ...></i>
   </a>
   
   Tambahkan CSS:
   .footer-social-icon {
     display: inline-flex;
     align-items: center;
     justify-content: center;
     width: 36px;
     height: 36px;
     background: rgba(255,255,255,0.1);
     border-radius: 50%;
     color: #fff !important;
     margin-right: 8px;
     transition: background 0.2s, transform 0.2s;
   }
   .footer-social-icon:hover {
     background: var(--accent);
     color: var(--text-on-accent) !important;
     transform: translateY(-2px);
   }

Jalankan: npm run build
Test di browser — navbar dan footer harus tampil dengan palette baru.

HASIL YANG DIHARAPKAN:
- Navbar: background putih, border bawah kuning sunshine, teks hijau forest,
  hover item berubah ke background kuning
- Running text: background kuning, teks hitam, font Open Sans bold
- Footer: background hijau forest gelap, judul kolom kuning, teks putih semi-transparan
- Copyright bar: hijau lebih gelap dari footer
```

---

## ═══════════════════════════════════════
## PROMPT CP-3 — REBRANDING HALAMAN BERANDA PUBLIK
## ═══════════════════════════════════════

```
Saya punya project Laravel 11 — Website Desa Wisata Petik Jeruk Selorejo.
CSS variables dan font sudah disetup. Navbar & footer sudah direbrand.

File target:
- resources/views/public/beranda.blade.php
- resources/css/app.css

TUGAS: Terapkan palette dan font baru ke seluruh komponen halaman beranda.

=== 1. HERO SLIDER ===

Tambahkan CSS:

/* Hero Slider */
.hero-slider .carousel-caption {
  background: linear-gradient(
    to top,
    rgba(26,92,56,0.90) 0%,
    rgba(26,92,56,0.40) 70%,
    transparent 100%
  );
  left: 0 !important;
  right: 0 !important;
  bottom: 0 !important;
  padding: 32px 40px 28px !important;
  text-align: left !important;
  border-radius: 0 !important;
}
.hero-slider .carousel-caption .caption-kecil {
  font-family: var(--font-body);
  font-size: var(--text-sm);
  font-weight: 600;
  color: var(--accent); /* kuning sunshine */
  text-transform: uppercase;
  letter-spacing: 0.1em;
  margin-bottom: 6px;
}
.hero-slider .carousel-caption h5,
.hero-slider .carousel-caption .caption-judul {
  font-family: var(--font-display); /* Bebas Neue */
  font-size: 2.4rem;
  letter-spacing: 0.04em;
  color: #fff;
  line-height: 1.1;
  margin-bottom: 10px;
}
.hero-slider .carousel-caption p {
  font-family: var(--font-body);
  font-size: var(--text-base);
  color: rgba(255,255,255,0.85);
  margin-bottom: 16px;
}
.hero-slider .carousel-caption .btn-cta-hero {
  background: var(--accent);
  color: var(--text-on-accent);
  font-family: var(--font-heading);
  font-weight: 700;
  font-size: var(--text-sm);
  padding: 10px 24px;
  border: none;
  border-radius: var(--radius-sm);
  text-decoration: none;
  display: inline-block;
  transition: background 0.2s, transform 0.15s;
}
.hero-slider .carousel-caption .btn-cta-hero:hover {
  background: var(--accent-hover);
  transform: translateY(-1px);
}
/* Carousel indicators warna */
.hero-slider .carousel-indicators button {
  background-color: rgba(255,255,255,0.5) !important;
  width: 8px !important;
  height: 8px !important;
  border-radius: 50% !important;
}
.hero-slider .carousel-indicators .active {
  background-color: var(--accent) !important;
}

=== 2. SECTION TITLES (SEMUA SECTION DI BERANDA) ===

Tambahkan CSS:

/* Section heading pattern */
.section-heading-wrapper {
  margin-bottom: 32px;
}
.section-label {        /* Teks kecil di atas judul: "KATEGORI" */
  font-family: var(--font-body);
  font-size: var(--text-xs);
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.12em;
  color: var(--accent-orange); /* oranye carro */
  display: block;
  margin-bottom: 4px;
}
.section-title {        /* Judul utama section */
  font-family: var(--font-display); /* Bebas Neue */
  font-size: var(--text-3xl);
  letter-spacing: 0.04em;
  color: var(--color-forest);
  line-height: 1;
  margin-bottom: 8px;
}
.section-divider {      /* Garis dekoratif bawah judul */
  display: flex;
  align-items: center;
  gap: 8px;
  margin-top: 8px;
}
.section-divider::before {
  content: '';
  display: block;
  width: 48px;
  height: 4px;
  background: var(--accent);
  border-radius: 2px;
}
.section-divider::after {
  content: '';
  display: block;
  width: 12px;
  height: 4px;
  background: var(--accent-orange);
  border-radius: 2px;
}

Di beranda.blade.php, update setiap judul section dari:
<h2 class="...">Berita Terbaru</h2>
menjadi:
<div class="section-heading-wrapper">
  <span class="section-label">Informasi</span>
  <h2 class="section-title">Berita Terbaru</h2>
  <div class="section-divider"></div>
</div>

Terapkan pola yang sama untuk semua section:
- Berita Terbaru → label: "INFORMASI"
- Produk Unggulan → label: "PRODUK DESA"
- Sambutan Kades → label: "DARI KEPALA DESA"
- Galeri → label: "DOKUMENTASI"
- Akses Cepat → label: "NAVIGASI CEPAT"

=== 3. KARTU BERITA ===

Tambahkan CSS:

.berita-card {
  border: none !important;
  border-radius: var(--radius-md) !important;
  overflow: hidden !important;
  box-shadow: var(--shadow-sm) !important;
  transition: transform 0.2s, box-shadow 0.2s !important;
  background: var(--bg-card) !important;
}
.berita-card:hover {
  transform: translateY(-4px) !important;
  box-shadow: var(--shadow-md) !important;
}
.berita-card .card-img-top {
  height: 180px;
  object-fit: cover;
  transition: transform 0.3s;
}
.berita-card:hover .card-img-top {
  transform: scale(1.04);
}
.berita-card .badge-kategori {
  font-family: var(--font-body);
  font-size: var(--text-xs);
  font-weight: 700;
  background: var(--accent);
  color: var(--text-on-accent);
  padding: 3px 10px;
  border-radius: 30px;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}
.berita-card .card-title {
  font-family: var(--font-heading);
  font-size: var(--text-base);
  font-weight: 700;
  color: var(--text-primary);
  line-height: 1.35;
  margin: 10px 0 6px;
}
.berita-card .card-text {
  font-family: var(--font-body);
  font-size: var(--text-sm);
  color: var(--text-muted);
  line-height: 1.6;
}
.berita-card .btn-baca {
  font-family: var(--font-heading);
  font-size: var(--text-sm);
  font-weight: 600;
  color: var(--color-forest);
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 4px;
  transition: color 0.2s, gap 0.2s;
}
.berita-card .btn-baca:hover {
  color: var(--accent-orange);
  gap: 8px;
}

=== 4. KARTU PRODUK ===

.produk-card {
  border: none !important;
  border-radius: var(--radius-md) !important;
  overflow: hidden !important;
  box-shadow: var(--shadow-sm) !important;
  transition: transform 0.2s, box-shadow 0.2s !important;
}
.produk-card:hover {
  transform: translateY(-4px) !important;
  box-shadow: var(--shadow-md) !important;
}
.produk-card .harga {
  font-family: var(--font-display);
  font-size: var(--text-xl);
  color: var(--color-forest);
  letter-spacing: 0.02em;
}
.produk-card .stok-badge {
  font-size: var(--text-xs);
  font-weight: 700;
  padding: 3px 10px;
  border-radius: 30px;
}
.produk-card .stok-badge.tersedia {
  background: #edfaed;
  color: #1a7a1a;
}
.produk-card .stok-badge.habis {
  background: #feeeee;
  color: var(--color-tomato);
}

=== 5. QUICK ACCESS BUTTONS ===

.quick-btn {
  background: #fff !important;
  border: 2px solid var(--border-color) !important;
  border-radius: var(--radius-md) !important;
  color: var(--text-primary) !important;
  font-family: var(--font-heading) !important;
  font-weight: 700 !important;
  font-size: var(--text-sm) !important;
  transition: border-color 0.2s, background 0.2s, transform 0.15s !important;
  text-decoration: none !important;
}
.quick-btn:hover {
  border-color: var(--accent) !important;
  background: var(--accent) !important;
  color: var(--text-on-accent) !important;
  transform: translateY(-2px) !important;
}
.quick-btn [data-lucide] {
  color: var(--color-forest);
  transition: color 0.2s;
}
.quick-btn:hover [data-lucide] {
  color: var(--text-on-accent);
}

=== 6. SECTION BACKGROUND ALTERNATING ===

Di beranda.blade.php, terapkan pola background bergantian antar section:
- Section Sambutan: background var(--color-cream) — krem
- Section Berita: background #fff — putih
- Section Produk: background var(--color-cream) — krem
- Section Galeri: background var(--color-forest) — hijau gelap (dark section)
- Section Polling: background #fff — putih

Untuk section Galeri (dark):
<section style="background: var(--color-forest); padding: 64px 0;">
  <!-- judul section dengan warna kebalikan -->
  <span class="section-label" style="color: var(--accent);">DOKUMENTASI</span>
  <h2 class="section-title" style="color: #fff;">Galeri Desa</h2>

Jalankan: npm run build

HASIL YANG DIHARAPKAN:
- Hero slider dengan gradient hijau, judul Bebas Neue, tombol CTA kuning
- Section titles menggunakan pattern label+judul Bebas Neue+garis dekoratif
- Kartu berita dan produk dengan hover effect yang smooth
- Quick access buttons border putih → hover kuning
- Background section bergantian krem dan putih
```

---

## ═══════════════════════════════════════
## PROMPT CP-4 — REBRANDING HALAMAN PUBLIK LAINNYA
## ═══════════════════════════════════════

```
Saya punya project Laravel 11 — Website Desa Wisata Petik Jeruk Selorejo.
CSS variables, font, navbar, footer, dan beranda sudah direbrand.

File target:
- resources/views/public/profil/ (semua)
- resources/views/public/pemerintahan/ (semua)
- resources/views/public/wisata/index.blade.php
- resources/views/public/produk/ (semua)
- resources/views/public/galeri/index.blade.php
- resources/views/public/statistik/index.blade.php
- resources/views/public/apbdes/index.blade.php
- resources/views/public/berita/ (semua)
- resources/views/public/kontak/index.blade.php
- resources/css/app.css

TUGAS: Terapkan palette dan font baru ke semua halaman publik tersisa.

=== CSS GLOBAL UNTUK SEMUA HALAMAN PUBLIK ===

Tambahkan di resources/css/app.css:

/* ── PAGE HERO BANNER (dipakai semua halaman bukan beranda) ── */
.page-hero {
  background: linear-gradient(135deg, var(--color-forest) 0%, var(--primary-light) 100%);
  padding: 48px 0 40px;
  margin-bottom: 40px;
  position: relative;
  overflow: hidden;
}
.page-hero::after {        /* Dekorasi oranye di pojok kanan */
  content: '';
  position: absolute;
  top: -40px;
  right: -40px;
  width: 200px;
  height: 200px;
  background: var(--accent-orange);
  border-radius: 50%;
  opacity: 0.15;
}
.page-hero::before {       /* Dekorasi kuning di pojok kiri bawah */
  content: '';
  position: absolute;
  bottom: -60px;
  left: -20px;
  width: 160px;
  height: 160px;
  background: var(--accent);
  border-radius: 50%;
  opacity: 0.12;
}
.page-hero .page-hero-breadcrumb .breadcrumb-item,
.page-hero .page-hero-breadcrumb .breadcrumb-item a {
  font-family: var(--font-body);
  font-size: var(--text-xs);
  color: rgba(255,255,255,0.7);
}
.page-hero .page-hero-breadcrumb .breadcrumb-item.active {
  color: var(--accent);
}
.page-hero .page-hero-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
  color: rgba(255,255,255,0.4);
}
.page-hero-title {
  font-family: var(--font-display);   /* Bebas Neue */
  font-size: var(--text-4xl);
  letter-spacing: 0.05em;
  color: #fff;
  line-height: 1;
  margin: 8px 0 0;
}
.page-hero-subtitle {
  font-family: var(--font-body);
  font-size: var(--text-base);
  color: rgba(255,255,255,0.8);
  margin-top: 8px;
}

Di SETIAP halaman publik (profil, pemerintahan, wisata, produk, galeri, dll),
ganti header section menjadi menggunakan class page-hero:

SEBELUM (contoh):
<div class="container py-4">
  <nav aria-label="breadcrumb">...</nav>
  <h2>Sejarah Desa</h2>
</div>

SESUDAH:
<div class="page-hero">
  <div class="container">
    <nav aria-label="breadcrumb" class="page-hero-breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="#">Profil Desa</a></li>
        <li class="breadcrumb-item active">Sejarah Desa</li>
      </ol>
    </nav>
    <h1 class="page-hero-title">Sejarah Desa</h1>
    <p class="page-hero-subtitle">Mengenal perjalanan panjang Desa Selorejo</p>
  </div>
</div>
<div class="container pb-5">
  ... konten halaman ...
</div>

=== CSS TAMBAHAN PER HALAMAN ===

Tambahkan di resources/css/app.css:

/* ── HALAMAN WISATA ── */
.wisata-info-box {
  border-left: 4px solid var(--accent) !important;
  border-radius: 0 var(--radius-md) var(--radius-md) 0 !important;
  background: var(--color-cream) !important;
  padding: 24px !important;
}
.wisata-info-box .list-group-item {
  background: transparent !important;
  border-color: var(--border-color) !important;
  font-family: var(--font-body) !important;
}
.wisata-info-box .harga-tiket {
  font-family: var(--font-display) !important;
  font-size: var(--text-3xl) !important;
  color: var(--color-forest) !important;
  letter-spacing: 0.02em !important;
}
.wisata-cta .btn {
  background: var(--color-forest) !important;
  color: #fff !important;
  font-family: var(--font-heading) !important;
  font-weight: 700 !important;
  border: none !important;
  padding: 14px 32px !important;
  border-radius: var(--radius-sm) !important;
  font-size: var(--text-base) !important;
  transition: background 0.2s, transform 0.15s !important;
}
.wisata-cta .btn:hover {
  background: var(--primary-dark) !important;
  transform: translateY(-2px) !important;
}

/* ── STRUKTUR ORGANISASI ── */
.struktur-card {
  border: 2px solid var(--border-color) !important;
  border-top: 4px solid var(--accent) !important;
  border-radius: var(--radius-md) !important;
  background: #fff !important;
  transition: border-color 0.2s, box-shadow 0.2s !important;
}
.struktur-card:hover {
  border-color: var(--color-forest) !important;
  box-shadow: var(--shadow-md) !important;
}
.struktur-card .jabatan {
  font-family: var(--font-body) !important;
  font-size: var(--text-xs) !important;
  font-weight: 700 !important;
  color: var(--accent-orange) !important;
  text-transform: uppercase !important;
  letter-spacing: 0.08em !important;
}
.struktur-card .nama {
  font-family: var(--font-heading) !important;
  font-size: var(--text-base) !important;
  font-weight: 700 !important;
  color: var(--color-forest) !important;
}

/* ── HALAMAN STATISTIK: Chart.js Colors ── */
/* Tidak bisa via CSS — update di blade/JS */
/* Pastikan di statistik/index.blade.php, warna dataset Chart.js diubah menjadi: */
/*
  backgroundColor: [
    '#F5C518',  // Sunshine
    '#1A5C38',  // Forest Green
    '#F26522',  // Crisp Carro
    '#2AABE2',  // Sky Blue
    '#7CB518',  // Kiwi
    '#D93025',  // Tomato Burst
    '#E8E8E8',  // Light Gray
  ]
*/

Buka resources/views/public/statistik/index.blade.php
Cari semua definisi backgroundColor: [...] di dalam script Chart.js
Ganti dengan array warna di atas.

/* ── HALAMAN KONTAK ── */
.kontak-info-item [data-lucide] {
  color: var(--accent-orange) !important;
}
.kontak-wa-btn {
  background: #25D366 !important;     /* WhatsApp green */
  color: #fff !important;
  font-family: var(--font-heading) !important;
  font-weight: 700 !important;
  border: none !important;
}
.kontak-wa-btn:hover {
  background: #1ebe5d !important;
}
/* Highlight border form kontak */
.kontak-form .form-control:focus {
  border-color: var(--accent) !important;
  box-shadow: 0 0 0 3px rgba(245,197,24,0.2) !important;
}

/* ── GALERI: Tab aktif ── */
.galeri-tabs .nav-link.active {
  background: var(--color-forest) !important;
  color: #fff !important;
  border-color: var(--color-forest) !important;
}
.galeri-tabs .nav-link {
  font-family: var(--font-heading) !important;
  font-weight: 600 !important;
  color: var(--text-primary) !important;
}

/* ── DETAIL BERITA ── */
.berita-detail-judul {
  font-family: var(--font-display) !important;
  letter-spacing: 0.02em !important;
  color: var(--color-forest) !important;
}
.berita-detail-konten {
  font-family: var(--font-body) !important;
  font-size: var(--text-lg) !important;
  line-height: 1.85 !important;
  color: #2a2a2a !important;
}
/* Blockquote di konten berita */
.berita-detail-konten blockquote {
  border-left: 4px solid var(--accent) !important;
  background: var(--color-cream) !important;
  padding: 16px 20px !important;
  border-radius: 0 var(--radius-sm) var(--radius-sm) 0 !important;
  font-style: italic !important;
  color: var(--color-forest) !important;
}

/* ── APBDES: Progress bar ── */
.progress {
  background-color: var(--color-gray-light) !important;
  border-radius: var(--radius-sm) !important;
  height: 10px !important;
}
.progress-bar {
  background: linear-gradient(90deg, var(--color-forest), var(--color-kiwi)) !important;
  border-radius: var(--radius-sm) !important;
}

Jalankan: npm run build
Test semua halaman publik di browser.

HASIL YANG DIHARAPKAN:
- Semua halaman memiliki page-hero banner hijau gradient dengan Bebas Neue
- Breadcrumb putih semi-transparan di atas banner
- Warna komponen konsisten: aksen kuning, tombol hijau forest, oranye untuk label
- Chart statistik menggunakan 7 warna palette baru
- Progress bar APBDes gradient hijau
```

---

## ═══════════════════════════════════════
## PROMPT CP-5 — REBRANDING DASHBOARD OPERATOR
## ═══════════════════════════════════════

```
Saya punya project Laravel 11 — Website Desa Wisata Petik Jeruk Selorejo.
Halaman publik sudah direbrand semua.

File target:
- resources/views/layouts/dashboard.blade.php
- resources/views/layouts/partials/sidebar-operator.blade.php
- resources/views/layouts/partials/sidebar-admin.blade.php
- resources/views/operator/dashboard.blade.php
- resources/css/app.css

TUGAS: Terapkan palette dan font baru ke seluruh dashboard operator & admin.

=== SIDEBAR ===

Tambahkan CSS:

/* ── SIDEBAR DASHBOARD ── */
#sidebar {
  background: var(--color-forest) !important;   /* #1A5C38 */
  font-family: var(--font-body) !important;
}

/* Brand sidebar */
#sidebar .sidebar-brand-name {
  font-family: var(--font-display) !important;
  font-size: 1.05rem !important;
  letter-spacing: 0.05em !important;
  color: #fff !important;
}
#sidebar .sidebar-brand-sub {
  font-family: var(--font-body) !important;
  font-size: var(--text-xs) !important;
  color: rgba(255,255,255,0.55) !important;
}
#sidebar .sidebar-brand-icon {
  background: var(--accent) !important;         /* kuning sunshine */
  border-radius: var(--radius-sm) !important;
  padding: 6px !important;
  color: var(--text-on-accent) !important;
}

/* Nav links sidebar */
#sidebar .nav-link {
  font-family: var(--font-body) !important;
  font-size: var(--text-sm) !important;
  font-weight: 500 !important;
  color: rgba(255,255,255,0.70) !important;
  border-radius: var(--radius-sm) !important;
  padding: 9px 14px !important;
  margin-bottom: 2px !important;
  transition: background 0.15s, color 0.15s !important;
}
#sidebar .nav-link:hover {
  background: rgba(255,255,255,0.10) !important;
  color: #fff !important;
}
/* Active state menggunakan SUNSHINE (kuning) */
#sidebar .nav-link.active,
#sidebar .nav-link[style*="background:#2d6a4f"],
#sidebar .nav-link[style*="background: #2d6a4f"] {
  background: var(--accent) !important;
  color: var(--text-on-accent) !important;
  font-weight: 700 !important;
}
#sidebar .nav-link.active [data-lucide] {
  color: var(--text-on-accent) !important;
}

/* Dropdown sidebar */
#sidebar .collapse ul .nav-link {
  font-size: var(--text-xs) !important;
  padding: 7px 14px !important;
  color: rgba(255,255,255,0.60) !important;
}
#sidebar .collapse ul .nav-link:hover {
  color: var(--accent) !important;
}

/* Bottom user info */
#sidebar .sidebar-bottom {
  border-top: 1px solid rgba(255,255,255,0.12) !important;
  padding: 12px 14px !important;
}
#sidebar .sidebar-bottom .nav-link {
  font-size: var(--text-xs) !important;
  color: rgba(255,255,255,0.50) !important;
  padding: 6px 10px !important;
}
#sidebar .sidebar-bottom .nav-link:hover {
  color: var(--accent) !important;
  background: transparent !important;
}

PENTING — Update inline style active menu di sidebar-operator.blade.php:
Cari semua instance 'background:#2d6a4f;color:#fff;'
Ganti menjadi: 'background:var(--accent);color:var(--text-on-accent);font-weight:700;'
Ini memastikan menu aktif berwarna KUNING SUNSHINE bukan hijau tua.

=== TOPBAR DASHBOARD ===

Tambahkan CSS:

/* ── TOPBAR DASHBOARD ── */
.topbar {
  background: #fff !important;
  border-bottom: 3px solid var(--accent) !important;   /* Garis bawah kuning */
  font-family: var(--font-body) !important;
}
.topbar h5,
.topbar .page-title {
  font-family: var(--font-display) !important;
  font-size: 1.35rem !important;
  letter-spacing: 0.04em !important;
  color: var(--color-forest) !important;
}
.topbar .user-name {
  font-family: var(--font-body) !important;
  font-size: var(--text-sm) !important;
  font-weight: 600 !important;
  color: var(--text-primary) !important;
}
.topbar .badge {
  font-family: var(--font-body) !important;
  font-weight: 700 !important;
  background: var(--color-forest) !important;
  color: #fff !important;
}
/* Tombol logout */
.topbar .btn-logout {
  border: 2px solid var(--color-tomato) !important;
  color: var(--color-tomato) !important;
  font-family: var(--font-heading) !important;
  font-weight: 600 !important;
  font-size: var(--text-sm) !important;
  border-radius: var(--radius-sm) !important;
  background: transparent !important;
  transition: background 0.2s, color 0.2s !important;
}
.topbar .btn-logout:hover {
  background: var(--color-tomato) !important;
  color: #fff !important;
}

=== STAT CARDS DASHBOARD ===

Tambahkan CSS:

/* ── STAT CARDS ── */
/* Override warna border-left card menggunakan palette baru */
.stat-card-berita  { border-left-color: var(--color-sky)    !important; }
.stat-card-pesan   { border-left-color: var(--color-kiwi)   !important; }
.stat-card-galeri  { border-left-color: var(--accent)       !important; }
.stat-card-produk  { border-left-color: var(--color-carro)  !important; }

.stat-card-berita  .stat-icon { background: var(--color-sky)   !important; }
.stat-card-pesan   .stat-icon { background: var(--color-kiwi)  !important; }
.stat-card-galeri  .stat-icon { background: var(--accent)      !important; color: var(--text-on-accent) !important; }
.stat-card-produk  .stat-icon { background: var(--color-carro) !important; }

/* Angka stat cards */
.stat-card .stat-number {
  font-family: var(--font-display) !important;
  font-size: var(--text-4xl) !important;
  letter-spacing: 0.02em !important;
  color: var(--text-primary) !important;
  line-height: 1 !important;
}
/* Label stat cards */
.stat-card .stat-label {
  font-family: var(--font-body) !important;
  font-size: var(--text-xs) !important;
  font-weight: 600 !important;
  color: var(--text-muted) !important;
  text-transform: uppercase !important;
  letter-spacing: 0.06em !important;
}
/* Link di bawah angka */
.stat-card .stat-link {
  font-family: var(--font-body) !important;
  font-size: var(--text-xs) !important;
  font-weight: 600 !important;
  text-decoration: none !important;
  transition: opacity 0.15s !important;
}
.stat-card .stat-link:hover { opacity: 0.75 !important; }
.stat-card-berita .stat-link  { color: var(--color-sky)   !important; }
.stat-card-pesan  .stat-link  { color: var(--color-kiwi)  !important; }
.stat-card-galeri .stat-link  { color: var(--accent-hover) !important; }
.stat-card-produk .stat-link  { color: var(--color-carro)  !important; }

Di resources/views/operator/dashboard.blade.php:
Tambahkan class CSS yang sesuai pada setiap card:
- Card Total Berita: class="card stat-card stat-card-berita border-0 shadow-sm"
- Card Pesan Baru: class="card stat-card stat-card-pesan border-0 shadow-sm"
- Card Galeri: class="card stat-card stat-card-galeri border-0 shadow-sm"
- Card Produk: class="card stat-card stat-card-produk border-0 shadow-sm"
Tambahkan class "stat-number" pada div angka besar.
Tambahkan class "stat-label" pada div label kecil di atas angka.
Tambahkan class "stat-icon" pada div background ikon.
Tambahkan class "stat-link" pada setiap link "Lihat Detail →".

=== SECTION AKSES CEPAT DASHBOARD ===

Tambahkan CSS:

.dashboard-quick-btn {
  border: 2px solid var(--border-color) !important;
  border-radius: var(--radius-sm) !important;
  background: #fff !important;
  color: var(--text-primary) !important;
  font-family: var(--font-heading) !important;
  font-weight: 600 !important;
  font-size: var(--text-sm) !important;
  padding: 8px 16px !important;
  transition: border-color 0.2s, background 0.2s, color 0.2s !important;
  text-decoration: none !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 6px !important;
}
.dashboard-quick-btn:hover {
  border-color: var(--accent) !important;
  background: var(--accent) !important;
  color: var(--text-on-accent) !important;
}
.dashboard-quick-btn [data-lucide] {
  transition: color 0.2s !important;
  color: var(--color-forest) !important;
}
.dashboard-quick-btn:hover [data-lucide] {
  color: var(--text-on-accent) !important;
}

Di operator/dashboard.blade.php:
Ganti class semua tombol akses cepat dari btn-outline-* menjadi class="dashboard-quick-btn"

=== CONTENT AREA DASHBOARD ===

Tambahkan CSS:

#content {
  background: var(--color-cream) !important;   /* krem, bukan abu */
  font-family: var(--font-body) !important;
}
#content .card-header h6,
#content .card-header .card-title {
  font-family: var(--font-heading) !important;
  font-weight: 700 !important;
  color: var(--color-forest) !important;
}

/* Flash message di dashboard */
#content .alert-success {
  background: #f0faf0 !important;
  border-left: 4px solid var(--color-kiwi) !important;
  border-top: none; border-right: none; border-bottom: none;
  border-radius: var(--radius-sm) !important;
  font-family: var(--font-body) !important;
}
#content .alert-danger {
  background: #fef0f0 !important;
  border-left: 4px solid var(--color-tomato) !important;
  border-top: none; border-right: none; border-bottom: none;
}

Jalankan: npm run build

HASIL YANG DIHARAPKAN:
- Sidebar: background forest green, menu aktif kuning sunshine
- Topbar: putih dengan garis bawah kuning, judul Bebas Neue hijau
- Stat cards: border kiri warna berbeda sesuai kategori, angka Bebas Neue besar
- Akses cepat: border putih → hover kuning
- Background konten: krem (#F5F0E8)
```

---

## ═══════════════════════════════════════
## PROMPT CP-6 — REBRANDING FORM CRUD OPERATOR & DASHBOARD ADMIN
## ═══════════════════════════════════════

```
Saya punya project Laravel 11 — Website Desa Wisata Petik Jeruk Selorejo.
Dashboard operator utama sudah direbrand.

File target:
- Semua file di resources/views/operator/ (form create/edit)
- resources/views/admin/ (semua halaman)
- resources/css/app.css

TUGAS: Terapkan palette dan font baru ke form CRUD operator dan halaman admin.

=== CSS GLOBAL FORM CRUD ===

Tambahkan di resources/css/app.css:

/* ── PAGE HEADER DASHBOARD (judul halaman dalam konten) ── */
.dashboard-page-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
  padding-bottom: 16px;
  border-bottom: 2px solid var(--border-color);
}
.dashboard-page-header h4,
.dashboard-page-header .page-heading {
  font-family: var(--font-display) !important;
  font-size: var(--text-2xl) !important;
  letter-spacing: 0.03em !important;
  color: var(--color-forest) !important;
  margin: 0 !important;
}
.dashboard-page-header .btn-tambah {
  background: var(--color-forest) !important;
  color: #fff !important;
  font-family: var(--font-heading) !important;
  font-weight: 700 !important;
  font-size: var(--text-sm) !important;
  border: none !important;
  border-radius: var(--radius-sm) !important;
  padding: 8px 18px !important;
  text-decoration: none !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 6px !important;
  transition: background 0.2s !important;
}
.dashboard-page-header .btn-tambah:hover {
  background: var(--primary-dark) !important;
}

/* ── TABEL CRUD (index pages) ── */
.crud-table {
  border-radius: var(--radius-md) !important;
  overflow: hidden !important;
  box-shadow: var(--shadow-sm) !important;
  background: #fff !important;
}
.crud-table thead th {
  background: var(--color-forest) !important;
  color: #fff !important;
  font-family: var(--font-heading) !important;
  font-weight: 700 !important;
  font-size: var(--text-xs) !important;
  text-transform: uppercase !important;
  letter-spacing: 0.06em !important;
  padding: 12px 16px !important;
  border: none !important;
}
.crud-table tbody td {
  font-family: var(--font-body) !important;
  font-size: var(--text-sm) !important;
  padding: 12px 16px !important;
  border-color: var(--border-color) !important;
  vertical-align: middle !important;
  color: var(--text-primary) !important;
}
.crud-table tbody tr:hover {
  background: rgba(245,197,24,0.06) !important;  /* kuning sangat muda saat hover */
}

/* Tombol aksi di tabel */
.btn-edit-row {
  background: var(--color-sky) !important;
  color: #fff !important;
  border: none !important;
  border-radius: var(--radius-sm) !important;
  font-size: var(--text-xs) !important;
  padding: 4px 12px !important;
  font-weight: 600 !important;
  text-decoration: none !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 4px !important;
}
.btn-edit-row:hover { background: #1a8fbf !important; color: #fff !important; }

.btn-delete-row {
  background: var(--color-tomato) !important;
  color: #fff !important;
  border: none !important;
  border-radius: var(--radius-sm) !important;
  font-size: var(--text-xs) !important;
  padding: 4px 12px !important;
  font-weight: 600 !important;
}
.btn-delete-row:hover { background: #b01e15 !important; }

/* ── FORM CARD (create/edit pages) ── */
.form-card {
  background: #fff !important;
  border: none !important;
  border-radius: var(--radius-lg) !important;
  box-shadow: var(--shadow-md) !important;
  overflow: hidden !important;
}
.form-card .form-card-header {
  background: linear-gradient(135deg, var(--color-forest), var(--primary-light)) !important;
  color: #fff !important;
  padding: 20px 28px !important;
  font-family: var(--font-display) !important;
  font-size: var(--text-xl) !important;
  letter-spacing: 0.04em !important;
}
.form-card .form-card-body {
  padding: 28px !important;
}
.form-card .form-section-title {
  font-family: var(--font-heading) !important;
  font-size: var(--text-base) !important;
  font-weight: 700 !important;
  color: var(--color-forest) !important;
  border-left: 4px solid var(--accent) !important;
  padding-left: 12px !important;
  margin: 24px 0 16px !important;
}
.form-card .btn-submit {
  background: var(--color-forest) !important;
  color: #fff !important;
  font-family: var(--font-heading) !important;
  font-weight: 700 !important;
  font-size: var(--text-base) !important;
  padding: 12px 32px !important;
  border: none !important;
  border-radius: var(--radius-sm) !important;
  transition: background 0.2s, transform 0.15s !important;
}
.form-card .btn-submit:hover {
  background: var(--primary-dark) !important;
  transform: translateY(-1px) !important;
}
.form-card .btn-cancel {
  border: 2px solid var(--border-color) !important;
  color: var(--text-muted) !important;
  background: transparent !important;
  font-family: var(--font-heading) !important;
  font-weight: 600 !important;
  font-size: var(--text-base) !important;
  padding: 10px 28px !important;
  border-radius: var(--radius-sm) !important;
  text-decoration: none !important;
  transition: border-color 0.2s, color 0.2s !important;
}
.form-card .btn-cancel:hover {
  border-color: var(--color-forest) !important;
  color: var(--color-forest) !important;
}

/* Badge status publish/draft */
.badge-publish {
  background: var(--color-kiwi) !important;
  color: #fff !important;
  font-family: var(--font-body) !important;
  font-size: var(--text-xs) !important;
  font-weight: 700 !important;
  padding: 4px 10px !important;
  border-radius: 30px !important;
}
.badge-draft {
  background: var(--color-gray-mid) !important;
  color: #fff !important;
  font-family: var(--font-body) !important;
  font-size: var(--text-xs) !important;
  font-weight: 700 !important;
  padding: 4px 10px !important;
  border-radius: 30px !important;
}

=== UPDATE VIEW FILES ===

Untuk SETIAP file di resources/views/operator/ yang memiliki tabel (index),
tambahkan class "crud-table" pada tag <table>.
Tambahkan class "btn-edit-row" pada link/tombol Edit.
Tambahkan class "btn-delete-row" pada tombol Hapus.

Untuk SETIAP file create/edit:
Bungkus form dalam <div class="form-card">
  <div class="form-card-header">Tambah/Edit [Nama]</div>
  <div class="form-card-body">
    ... isi form ...
    <button type="submit" class="btn-submit">Simpan</button>
    <a href="..." class="btn-cancel">Batal</a>
  </div>
</div>

=== DASHBOARD ADMIN ===

Di resources/views/admin/dashboard.blade.php:
- Terapkan class yang sama: stat-card, crud-table, form-card
- Sidebar admin menggunakan CSS yang sama dengan sidebar operator (sudah di-handle)
- Bedakan visual admin dengan menambahkan accent merah tomat di elemen admin:

.admin-accent-bar {        /* Bar merah di atas konten admin */
  height: 4px;
  background: linear-gradient(90deg, var(--color-tomato), var(--accent-orange));
  margin-bottom: 0;
}

Di layouts/dashboard.blade.php, jika user adalah admin, tambahkan:
@if(Auth::user()->role == 'admin')
  <div class="admin-accent-bar"></div>
@endif

=== HALAMAN LOGIN ===

Buka: resources/views/auth/login.blade.php
Terapkan palette baru:

1. Background halaman:
   <body style="background: var(--color-cream); min-height: 100vh;
                display: flex; align-items: center; justify-content: center;
                font-family: var(--font-body);">

2. Card login:
   - background: #fff
   - border-top: 5px solid var(--color-forest)
   - border-radius: var(--radius-lg)
   - box-shadow: var(--shadow-lg)

3. Judul "Masuk":
   font-family: var(--font-display);
   font-size: var(--text-3xl);
   color: var(--color-forest);
   letter-spacing: 0.04em;

4. Sub judul "Operator Panel":
   font-family: var(--font-body);
   font-size: var(--text-sm);
   color: var(--text-muted);

5. Tombol Login:
   background: var(--color-forest);
   color: #fff;
   font-family: var(--font-heading);
   font-weight: 700;
   width: 100%;
   padding: 12px;
   border-radius: var(--radius-sm);

6. Ikon di atas form:
   background: var(--accent);
   color: var(--text-on-accent);
   border-radius: var(--radius-md);
   padding: 12px;
   margin-bottom: 20px;

Jalankan: npm run build

HASIL YANG DIHARAPKAN:
- Semua tabel CRUD: header hijau forest, row hover kuning sangat muda
- Tombol edit biru sky, tombol hapus merah tomat
- Form card: header gradient hijau, judul Bebas Neue
- Badge publish hijau kiwi, badge draft abu
- Dashboard admin ada accent bar merah-oranye di atas
- Halaman login: card putih border atas hijau, judul Bebas Neue
```

---

## ═══════════════════════════════════════
## PROMPT CP-7 — VALIDASI AKHIR & KONSISTENSI MENYELURUH
## ═══════════════════════════════════════

```
Saya punya project Laravel 11 — Website Desa Wisata Petik Jeruk Selorejo.
Semua prompt rebranding CP-1 sampai CP-6 sudah dieksekusi.

TUGAS: Validasi akhir konsistensi warna dan font di seluruh website.

=== CEK 1: FONT LOADING ===

Buka browser → F12 → Network tab → filter "font"
Reload halaman /
Pastikan ada request ke fonts.googleapis.com dan font berikut ter-load:
- Bebas Neue (400)
- Open Sans (300, 400, 500, 600, 700)

Jika font tidak ter-load:
a) Cek koneksi internet server (font CDN butuh internet)
b) Pastikan import Google Fonts di app.css di baris PALING ATAS
c) Alternatif: download font dan taruh di resources/fonts/, lalu @font-face

=== CEK 2: CSS VARIABLES AKTIF ===

Buka DevTools → Elements → pilih tag <html> → Computed
Scroll ke bagian custom properties (--*)
Pastikan semua variable ini ada dan nilai benar:
- --color-sunshine: #F5C518
- --color-cream: #F5F0E8
- --color-carro: #F26522
- --color-tomato: #D93025
- --color-forest: #1A5C38
- --color-kiwi: #7CB518
- --color-sky: #2AABE2
- --font-display: 'Bebas Neue', 'Impact', sans-serif
- --font-body: 'Open Sans', 'Segoe UI', system-ui, sans-serif

=== CEK 3: VISUAL CHECKLIST HALAMAN PUBLIK ===

Buka setiap halaman dan verifikasi:

[ ] / (beranda)
    - Background krem (#F5F0E8) ✓
    - Navbar: putih, border bawah kuning ✓
    - Running text: background kuning, teks hitam ✓
    - Hero slider: teks Bebas Neue di atas gambar ✓
    - Section titles: font Bebas Neue, garis dekoratif kuning-oranye ✓
    - Footer: hijau forest gelap, judul kolom kuning ✓

[ ] /wisata
    - Page hero: gradient hijau, judul Bebas Neue putih ✓
    - Info box: border kiri kuning, background krem ✓
    - Harga tiket: Bebas Neue, hijau forest ✓
    - Tombol CTA: hijau forest ✓

[ ] /berita
    - Filter tab: font Open Sans, aktif hijau forest ✓
    - Card berita: layout horizontal di mobile, thumbnail kiri ✓
    - Pagination: hover kuning ✓

[ ] /statistik
    - Chart warna: Sunshine, Forest, Carro, Sky, Kiwi, Tomato ✓

[ ] /kontak
    - Ikon info: oranye carro ✓
    - Tombol WA: hijau WhatsApp ✓
    - Form focus: ring kuning sunshine ✓

=== CEK 4: VISUAL CHECKLIST DASHBOARD ===

Login sebagai operator → kunjungi /operator/dashboard

[ ] Sidebar: background forest green ✓
[ ] Menu aktif: background kuning sunshine, teks hitam ✓
[ ] Topbar: putih, garis bawah kuning, judul Bebas Neue hijau ✓
[ ] Stat cards: border kiri berwarna, angka Bebas Neue ✓
[ ] Content area: background krem ✓
[ ] Tombol akses cepat: hover kuning ✓

Kunjungi /operator/berita (tabel CRUD):
[ ] Header tabel: hijau forest, teks putih ✓
[ ] Row hover: kuning sangat muda ✓
[ ] Tombol Edit: biru sky ✓
[ ] Tombol Hapus: merah tomato ✓

Kunjungi /operator/berita/create (form):
[ ] Form card header: gradient hijau ✓
[ ] Form section title: border kiri kuning ✓
[ ] Tombol Simpan: hijau forest ✓
[ ] Tombol Batal: border abu ✓

Login sebagai admin → kunjungi /admin/dashboard:
[ ] Accent bar merah-oranye di atas konten ✓

Kunjungi /login:
[ ] Background krem ✓
[ ] Card login border atas hijau ✓
[ ] Judul Bebas Neue hijau forest ✓
[ ] Tombol masuk hijau forest full width ✓

=== CEK 5: TIDAK ADA WARNA LAMA ===

Jalankan pencarian global di VS Code:
Ctrl+Shift+F → cari: #2d6a4f
Ini adalah warna PRIMARY LAMA. Ganti semua kemunculan inline style dengan var(--color-forest).

Ctrl+Shift+F → cari: #74c69d
Ini warna secondary lama. Ganti dengan var(--color-kiwi).

Ctrl+Shift+F → cari: #f4a261
Ini warna accent orange lama. Ganti dengan var(--color-carro).

Ctrl+Shift+F → cari: #1b4332
Ini warna dark lama. Ganti dengan var(--primary-dark).

Ctrl+Shift+F → cari: #f8f9f0
Ini warna background lama. Ganti dengan var(--bg-page) atau var(--color-cream).

Setelah semua penggantian, jalankan: npm run build

=== CEK 6: KONSISTENSI TYPOGRAPHY ===

Buka halaman sembarang → F12 → klik elemen heading utama halaman
Di panel Computed: pastikan font-family mengandung "Bebas Neue"

Klik elemen paragraf/body text
Di panel Computed: pastikan font-family mengandung "Open Sans"

Klik tombol/button
Di panel Computed: pastikan font-family mengandung "Open Sans" dengan weight 600/700

=== LANGKAH FINAL ===

1. Jalankan: php artisan view:clear
2. Jalankan: php artisan cache:clear
3. Jalankan: npm run build
4. Reload browser dengan hard refresh (Ctrl+Shift+R)

HASIL YANG DIHARAPKAN:
Seluruh website — front-end publik dan dashboard operator/admin —
menggunakan palette 7 warna baru (Sunshine, Cream, Crisp Carro, Tomato Burst,
Forest Green, Kiwi, Sky Blue) secara konsisten.
Font Bebas Neue untuk semua display/judul besar.
Font Open Sans untuk semua body text, heading reguler, dan UI element.
Tidak ada satupun warna atau font lama yang tersisa.
```

---

## ═══════════════════════════════════════
## RINGKASAN URUTAN EKSEKUSI
## ═══════════════════════════════════════

| # | Prompt | Target | Waktu |
|---|--------|--------|-------|
| **CP-1** | Setup CSS Variables & Google Fonts | app.css | 10 menit |
| **CP-2** | Navbar & Footer Publik | public-header, public-footer | 15 menit |
| **CP-3** | Beranda Publik | beranda.blade.php | 20 menit |
| **CP-4** | Semua Halaman Publik Lainnya | 9 halaman publik | 25 menit |
| **CP-5** | Dashboard Operator | sidebar, topbar, stat cards | 20 menit |
| **CP-6** | Form CRUD + Dashboard Admin + Login | semua operator/, admin/ | 20 menit |
| **CP-7** | Validasi Akhir & Konsistensi | seluruh project | 15 menit |

**Total estimasi: 125 menit (~2 jam)**

---

## REFERENSI WARNA CEPAT

```
Sunshine      #F5C518  → Accent, CTA, running text bg, menu aktif sidebar
Cream         #F5F0E8  → Background halaman, section bergantian
Crisp Carro   #F26522  → Label kecil, ikon info, dekorasi
Tomato Burst  #D93025  → Danger, hapus, error, admin accent
Forest Green  #1A5C38  → Primary, navbar border, sidebar bg, heading
Kiwi          #7CB518  → Success, badge publish, tombol sekunder
Sky Blue      #2AABE2  → Info, tombol edit, link aktif
Light Gray    #E8E8E8  → Border, divider, disabled
```

---
*Dokumen Rebranding Color Palette & Typography — Desa Selorejo*
*Ridwan Hakim Mashadi — NIM K3523066 — KKN Tematik UNS 2026*
