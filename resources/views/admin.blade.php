<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Azure Hotel — Admin Panel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500&family=IBM+Plex+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
</head>
<body>

<aside id="sidebar">
  <div class="brand">
    <div class="brand-logo">
      <div class="brand-icon">icon</div>
      <div>
        <div class="brand-name">Azure Hotel</div>
        <div class="brand-sub">Admin System</div>
      </div>
    </div>
  </div>
  <nav>
    <div class="nav-group">Main</div>
    <div class="nav-item active" data-target="dashboard">
      <span class="nav-icon">⊞</span> Dashboard
    </div>
    <div class="nav-item" data-target="notifikasi">
      <span class="nav-icon">◎</span> Notifikasi
      <span class="nav-badge">{{ $totalnotif }}</span>
    </div>
    <div class="nav-divider"></div>
    <div class="nav-group">Kamar</div>
    <div class="nav-item" data-target="daftar-kamar">
      <span class="nav-icon">▦</span> Daftar Kamar
    </div>
        <div class="nav-item" data-target="pesanan-kamar">
          <span class="nav-icon">≡</span> Daftar Pesanan
        </div>
    @if (Auth::user()->role == 'admin')
        <div class="nav-item" data-target="tambah-kamar">
          <span class="nav-icon">+</span> Tambah Kamar
        </div>
    @endif
    <div class="nav-divider"></div>
    <div class="nav-group">SDM</div>
    <div class="nav-item" data-target="karyawan">
      <span class="nav-icon">◉</span> Daftar Karyawan
    </div>
    <div class="nav-item" data-target="tambah-karyawan">
      <span class="bi bi-person"></span> Tambah Karyawan
    </div>
    <div class="nav-item" data-target="edit-karyawan">
      <span class="bi bi-person"></span> Edit Data Karyawan
    </div>
    <div class="nav-divider"></div>
    <div class="nav-group">Administrator Menu</div>
    @if (Auth::user()->role == 'admin')
        <div class="nav-item-admin" data-target="tambah-user">
          <span class="bi bi-person"></span> Tambah User
        </div>
    @else
        <div class="nav-item-admin" data-target="tambah-user" style="cursor:not-allowed; opacity:0.6;">
          <span class="bi bi-person"></span> Tambah User
        </div>
    @endif
  </nav>
  <div class="sidebar-footer">
    <div class="nav-item logout">
      <span class="nav-icon">←</span>
      <a href="{{ route('logout.sys') }}">Logout</a>
    </div>
  </div>
</aside>

<main id="main">
    <div class="topbar">
      <button class="menu-btn" onclick="toggleSidebar()">☰</button>

      <div class="page-title" id="pageTitle">Dashboard</div>

      <div class="topbar-right">
        <div class="topbar-date" id="live-date"></div>
        <div class="avatar">{{ strtoupper(substr(Auth::user()->name,0,2)) }}</div>
      </div>
    </div>
  <div class="content">

    <!-- DASHBOARD -->
    <section class="section active" id="dashboard">
      <div class="welcome-bar">
        <div>
          <div class="welcome-title">Selamat Datang, {{ Auth::user()->name }}</div>
          <div class="welcome-sub">Anda sudah login. Semua sistem berjalan normal.</div>
        </div>
        <div class="online-dot"><div class="dot"></div>ONLINE</div>
      </div>
      <div class="stats-row">
        <div class="stat-box">
          <div class="stat-label">Total Kamar</div>
          <div class="stat-num">{{ $jmlhkamar }}</div>
          <div class="stat-sub">{{ $KamarMaintenance }} sedang maintenance</div>
        </div>
        <div class="stat-box">
          <div class="stat-label">Kamar Aktif</div>
          <div class="stat-num">{{ $KamarAktif }}</div>
          <div class="stat-sub">2 check-in hari ini</div>
        </div>
        <div class="stat-box">
          <div class="stat-label">Karyawan</div>
          <div class="stat-num">{{ $jumlahpegawai }}</div>
          <div class="stat-sub">3 shift aktif sekarang</div>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <div class="card-title">Aktivitas Terkini</div>
          <span style="font-family:'IBM Plex Mono',monospace;font-size:10px;color:var(--muted);">HARI INI</span>
        </div>
        <table>
          <thead>
            <tr>
              <th>Waktu</th><th>Aktivitas</th><th>Pengguna</th><th>Status</th>
            </tr>
          </thead>
          <tbody>
              @if ($notif->isEmpty())

              @else
              @foreach ($notif as $ntf)
              <tr>
                <td class="mono" style="color:var(--muted);">{{ $ntf->created_at }}</td>
                <td>{{ $ntf->title }}</td>
                <td>{{ $ntf->deskripsi }}</td>
                <td>
                  @if ($ntf->status == 1)
                  <span class="pill pill-notconfirmed">Belum Di Baca</span>
                  @elseif ($ntf->status == 2)
                    <span class="pill pill-confirmed">Sudah Di Baca</span>
                  @endif
                </td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
    </section>

    <!-- NOTIFIKASI -->
    @if($notif->isEmpty())
    <div style="padding:20px;color:gray;">
        Tidak ada notifikasi
    </div>
    @else
    @foreach ($notif as $nf)

    <section class="section" id="notifikasi">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Notifikasi Sistem</div>
          <form action="{{ route('notifi.readall') }}" method="POST">
            @csrf
            <button class="btn btn-ghost">Tandai Semua Dibaca</button>
          </form>
        </div>
        <div class="notif-container">
          <div class="notif-item">
            <div class="notif-icon success">✓</div>
            <div class="notif-content">
              <div class="notif-title">{{ $nf->title }}</div>
              <div class="notif-desc">{{ $nf->deskripsi }}</div>
              <div class="notif-time">{{ $nf->created_at }}</div>
            </div>
          </div>

        </div>
      </div>
    </section>
    @endforeach
    @endif

    <!-- DAFTAR KAMAR -->
    <section class="section" id="daftar-kamar">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Daftar Kamar</div>
          <form name="search" action="{{ route('finddatakamar') }}" method="GET" class="form-inline">
            <input name="tab" type="hidden" value="daftar-kamar">
            <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
          @if (Auth::user()->role == 'admin')

          <button class="btn btn-primary" onclick="switchTab('tambah-kamar')">+ Tambah Kamar</button>
          @endif
        </div>
        <table>
          <thead>
            <tr>
              <th>No. Kamar</th><th>Tipe</th><th>Lantai</th>
              <th>Kapasitas</th><th>Harga / Malam</th><th>Status</th><th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @if ($datakamar->isEmpty())
            <tr>
              <td>Data Sedang Kosong</td>
            </tr>
            @else
                @foreach ($datakamar as $itemkamar)
                <tr>
                  <td class="mono" style="color:var(--c3);">{{ $itemkamar->no_kamar }}</td>
                  <td>{{ $itemkamar->tipe_kamar }}</td>
                  <td class="mono">{{ $itemkamar->lantai }}</td>
                  <td class="mono">{{ $itemkamar->kapasitas }}</td>
                  <td class="mono">Rp. {{ $itemkamar->harga }}</td>
                  <td><span class="pill pill-available">{{ $itemkamar->status }}</span></td>
                  <td>
                    @if (Auth::user()->role == 'admin')
                    <button class="tbl-btn">EDIT</button>
                    <form action="/kamar/{{ $itemkamar->id }}" method="POST">
                      @csrf
                      @method('DELETE')
                        <button type="submit" class="tbl-btn del">HAPUS</button>
                    @else
                        <button class="tbl-btn del">Anda Bukan Adminclear</button>
                    @endif
                    </form>
                  </td>
                </tr>
                @endforeach
              @endif

          </tbody>
        </table>
      </div>
    </section>

    <!-- PESANAN KAMAR -->
    <section class="section" id="pesanan-kamar">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Daftar Pesanan Kamar</div>
          <span class="mono" style="color:var(--muted);font-size:11px;">1 pesanan aktif</span>
        </div>
        <table>
          <thead>
            <tr>
              <th>ID Pesanan</th><th>Nama Tamu</th><th>Kamar</th>
              <th>Check-in</th><th>Check-out</th><th>Total</th><th>Status</th><th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="mono" style="color:var(--c3);">#ORD-0042</td>
              <td>Budi Santoso</td>
              <td class="mono">201</td>
              <td class="mono">2026.03.10</td>
              <td class="mono">2026.03.13</td>
              <td class="mono">Rp 2.400.000</td>
              <td><span class="pill pill-confirmed">CONFIRMED</span></td>
              <td>
                <button class="tbl-btn">DETAIL</button>
                <button class="tbl-btn del">BATAL</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <!-- TAMBAH KAMAR -->
    <section class="section" id="tambah-kamar">
      @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
          <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Form Tambah Kamar -->
        <div class="card">
          <div class="card-header">
            <div class="card-title flex items-center gap-2">
              <i class="bi bi-house-add text-primary"></i>
              Tambah Kamar Baru
            </div>
          </div>
          <form action="/tambah" method="POST" class="p-6 space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                  <i class="bi bi-hash mr-1"></i>Nomor Kamar
                </label>
                <input name="no_kamar" type="text" placeholder="Contoh: 301" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required/>
              </div>
              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                  <i class="bi bi-tag mr-1"></i>Tipe Kamar
                </label>
                <select name="tipe_kamar" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                  <option value="Standard Twin">Standard Twin</option>
                  <option value="Standard Queen">Standard Queen</option>
                  <option value="Deluxe King">Deluxe King</option>
                  <option value="Suite">Suite</option>
                  <option value="Presidential Suite">Presidential Suite</option>
                </select>
              </div>
              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                  <i class="bi bi-building mr-1"></i>Lantai
                </label>
                <input name="lantai" type="number" placeholder="Contoh: 3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required/>
              </div>
              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                  <i class="bi bi-cash mr-1"></i>Harga per Malam (Rp)
                </label>
                <input name="harga" type="number" placeholder="Contoh: 800000" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required/>
              </div>
              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                  <i class="bi bi-people mr-1"></i>Kapasitas Tamu
                </label>
                <input name="kapasitas" type="number" placeholder="Contoh: 2" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required/>
              </div>
              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                  <i class="bi bi-check-circle mr-1"></i>Status Kamar
                </label>
                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                  <option value="1">Tersedia</option>
                  <option value="0">Terisi</option>
                  <option value="2">Maintenance</option>
                </select>
              </div>
            </div>
            <div class="flex gap-4 pt-4">
              <button class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-200 flex items-center gap-2" type="submit" onclick="this.disabled=true; this.form.submit();">
                <i class="bi bi-save"></i>SIMPAN KAMAR
              </button>
              <button class="bg-gray-200 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-300 transition duration-200" type="button" onclick="switchTab('daftar-kamar')">BATAL</button>
            </div>
          </form>
        </div>

        <!-- Upload Excel -->
        <div class="card">
          <div class="card-header">
            <div class="card-title flex items-center gap-2">
              <i class="bi bi-file-earmark-excel text-green-600"></i>
              Import Data Kamar via Excel
            </div>
          </div>
          <div class="p-6">
            <p class="text-sm text-gray-600 mb-4">Upload file Excel untuk menambahkan data kamar secara massal. Pastikan format sesuai dengan template.</p>
            <form action="{{ route('import.datakamar') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
              @csrf
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pilih File Excel</label>
                <input type="file" name="file" accept=".xlsx,.xls" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required/>
              </div>
              <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition duration-200 flex items-center gap-2">
                <i class="bi bi-upload"></i>Upload Excel
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>

        <!-- TAMBAH Karyawan -->
    <section class="section" id="tambah-karyawan">
      <form action="{{ route('tambah.karyawan') }}" method="POST">
        @csrf
          <div class="card">
          <div class="card-header">
            <div class="card-title">Tambah Data Karyawan</div>
          </div>
          <div class="form-body">
            <div class="form-group">
              <label>Nama Pegawai</label>
              <input name="nama_pegawai" type="text" placeholder="Masukkan User"/>
            </div>
            <div class="form-group">
              <label>Posisi</label>
              <input name="posisi" type="text" placeholder="Front Office"/>
            </div>
            <div class="form-group">
              <label>Shift</label>
              <input name="shift" type="text" placeholder="9.00 - 13.00"/>
            </div>
            <div class="form-group">
              <label>Nomer Hp</label>
              <input name="nomer_hp" type="text" placeholder="08xxxxxx"/>
            </div>
            <div class="form-group">
              <label>Status</label>
              <select name="status">
                <option value="Aktif">Aktif</option>
                <option value="libur">Libur</option>
              </select>
            </div>
          </div>
          <div class="form-footer">
            <button class="btn btn-primary">SIMPAN</button>
          </div>
        </div>
      </form>
    </section>

        <!-- TAMBAH User -->
    <section class="section" id="tambah-user">
      <form action="{{ route('user.tambah') }}" method="POST">
        @csrf
          <div class="card">
          <div class="card-header">
            <div class="card-title">Tambah Kamar Baru</div>
          </div>
          <div class="form-body">
            <div class="form-group">
              <label>User Name</label>
              <input name="name" type="text" placeholder="Masukkan User"/>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input name="email" type="email" placeholder="Masukkan Email"/>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input name="password" type="password" placeholder="Masukkan User"/>
            </div>
            <div class="form-group">
              <label>Role</label>
              <select name="role">
                <option value="admin">Admin</option>
                <option value="front">Front</option>
                <option value="visitor">Visitor</option>
              </select>
            </div>
          </div>
          <div class="form-footer">
            <button class="btn btn-primary">SIMPAN</button>
          </div>
        </div>
      </form>
    </section>

    <!-- KARYAWAN -->
    <section class="section" id="karyawan">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Daftar Karyawan</div>
            <button class="btn btn-primary" onclick="openPopup()">Upload Data Karyawan</button>
        </div>
        <table>
          <thead>
            <tr>
              <th>ID</th><th>Nama</th><th>Posisi</th>
              <th>Shift</th><th>No. HP</th><th>Status</th><th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @if ($datapegawai -> isEmpty())
              <tr>
                <td>Data Seang Kosong</td>
              </tr>
            @else
              @foreach ($datapegawai as $item)
              @csrf
              <tr>
                <td class="mono" style="color:var(--c3);">{{ $item->id }}</td>
                <td>
                  <div style="display:flex;align-items:center;gap:10px;">
                    <div style="width:28px;height:28px;background:var(--c2);border:2px solid var(--c3);display:flex;align-items:center;justify-content:center;font-family:'IBM Plex Mono',monospace;font-size:10px;color:var(--c3);">SL</div>
                    {{ $item->nama_pegawai }}
                  </div>
                </td>
                <td>{{ $item->posisi }}</td>
                <td class="mono">{{ $item->shift }}</td>
                <td class="mono">{{ $item->nomer_hp }}</td>
                <td><span class="pill pill-active">{{ $item->status }}</span></td>
                <td>
                  <a href="{{ route('edit.pegawai', $item->id) }}" class="tbl-btn">EDIT</a>
                  <form action="/pegawai/{{ $item->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                      <button type="submit" class="tbl-btn del">HAPUS</button>
                  </form>
                </td>
              </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </section>


<div class="popup" id="popup">
    <div class="popup-content">
        <h3>Upload File</h3>

        <form action="{{ route('import.datapegawai') }}" method="post" enctype="multipart/form-data">
          @csrf
            <input type="file" name="file">

            <button type="submit">Submit</button>
            <button type="button" onclick="closePopup()">Cancel</button>
        </form>
    </div>
</div>

<script>
function openPopup(){
    document.getElementById("popup").style.display = "flex";
}

function closePopup(){
    document.getElementById("popup").style.display = "none";
}


</script>

</div>
</main>

  <style>

    /* NOTIFICATION */

.notif-container{
display:flex;
flex-direction:column;
}

.notif-item{
display:flex;
gap:15px;
padding:16px 20px;
border-bottom:1px solid var(--border);
transition:all .15s;
}

.notif-item:hover{
background:#f9fafb;
}

.notif-icon{
width:36px;
height:36px;
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
font-size:14px;
font-weight:600;
}

.notif-icon.success{
background:#eafaf1;
color:var(--green);
}

.notif-icon.info{
background:#e8f4fd;
color:var(--primary);
}

.notif-icon.warning{
background:#fff4e5;
color:var(--amber);
}

.notif-content{
flex:1;
}

.notif-title{
font-size:14px;
font-weight:600;
margin-bottom:3px;
}

.notif-desc{
font-size:13px;
color:var(--muted);
}

.notif-time{
font-size:11px;
color:var(--muted);
margin-top:4px;
}

    body{
    font-family: Arial;
}

button{
    padding:10px 20px;
    cursor:pointer;
}

.popup{
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.5);

    justify-content:center;
    align-items:center;
}

.popup-content{
    background:white;
    padding:30px;
    border-radius:8px;
    width:300px;
}

.btn-group{
    margin-top:15px;
}
:root{
--bg:#f4f6f9;
--sidebar:#ffffff;
--card:#ffffff;
--border:#e5e7eb;

--text:#2c3e50;
--muted:#7f8c8d;

--primary:#3498db;
--primary-dark:#2c3e50;

--green:#2ecc71;
--amber:#f39c12;
--red:#e74c3c;
}

*,
*::before,
*::after{
box-sizing:border-box;
margin:0;
padding:0;
}

body{
font-family:Segoe UI, Arial, sans-serif;
background:var(--bg);
color:var(--text);
display:flex;
min-height:100vh;
/* overflow:hidden; */
}

/* SIDEBAR */

#sidebar{
width:240px;
background:var(--sidebar);
border-right:1px solid var(--border);
display:flex;
flex-direction:column;
}

.brand{
padding:25px;
border-bottom:1px solid var(--border);
}

.brand-name{
font-size:16px;
font-weight:600;
color:var(--primary-dark);
}

.brand-sub{
font-size:12px;
color:var(--muted);
}

/* NAV */

nav{
flex:1;
padding:10px 0;
}

.nav-group{
padding:10px 20px;
font-size:11px;
text-transform:uppercase;
color:var(--muted);
}

.nav-item{
display:flex;
align-items:center;
gap:10px;
padding:12px 20px;
cursor:pointer;
font-size:14px;
color:var(--text);
transition:all .15s;
border-left:3px solid transparent;
}
.nav-item-admin{
display:flex;
align-items:center;
gap:10px;
padding:12px 20px;
cursor:pointer;
font-size:14px;
color:var(--text);
transition:all .15s;
border-left:3px solid transparent;
}

.nav-item:hover{
background:#f1f5f9;
}
.nav-item-admin:hover{
background:#dc2827;
}

.nav-item.active{
background:#f1f5f9;
border-left:3px solid var(--primary);
font-weight:600;
}

.nav-badge{
margin-left:auto;
background:var(--primary);
color:white;
font-size:11px;
padding:2px 7px;
border-radius:10px;
}

.nav-divider{
height:1px;
background:var(--border);
margin:10px 0;
}

.sidebar-footer{
border-top:1px solid var(--border);
}

.logout a{
color:var(--red);
text-decoration:none;
}

/* MAIN */

#main{
flex:1;
background:var(--bg);
display:flex;
flex-direction:column;
overflow-y:auto;
}

/* TOPBAR */

.topbar{
height:60px;
background:white;
border-bottom:1px solid var(--border);
display:flex;
align-items:center;
justify-content:space-between;
padding:0 30px;
}

.page-title{
font-size:16px;
font-weight:600;
}

.topbar-date{
font-size:13px;
color:var(--muted);
}

.avatar{
width:34px;
height:34px;
background:var(--primary-dark);
color:white;
display:flex;
align-items:center;
justify-content:center;
border-radius:50%;
font-size:12px;
}

/* CONTENT */

.content{
padding:30px;
}

.section{
display:none;
}

.section.active{
display:block;
}

/* WELCOME */

.welcome-bar{
background:white;
border:1px solid var(--border);
border-left:4px solid var(--primary);
padding:18px 20px;
margin-bottom:25px;
display:flex;
justify-content:space-between;
align-items:center;
border-radius:6px;
}

.welcome-title{
font-weight:600;
}

.welcome-sub{
font-size:13px;
color:var(--muted);
}

.online-dot{
display:flex;
align-items:center;
gap:6px;
color:var(--green);
font-size:12px;
}

.dot{
width:8px;
height:8px;
background:var(--green);
border-radius:50%;
}

/* STATS */

.stats-row{
display:grid;
grid-template-columns:repeat(3,1fr);
gap:20px;
margin-bottom:25px;
}

.stat-box{
background:white;
border:1px solid var(--border);
border-radius:8px;
padding:20px;
}

.stat-label{
font-size:12px;
color:var(--muted);
}

.stat-num{
font-size:32px;
font-weight:600;
margin-top:6px;
}

.stat-sub{
font-size:12px;
color:var(--muted);
margin-top:3px;
}

/* CARD */

.card{
background:white;
border:1px solid var(--border);
border-radius:8px;
box-shadow:0 8px 18px rgba(0,0,0,0.04);
}

.card-header{
padding:18px 20px;
border-bottom:1px solid var(--border);
display:flex;
justify-content:space-between;
align-items:center;
}

.card-title{
font-weight:600;
}

/* TABLE */

table{
width:100%;
border-collapse:collapse;
}

thead{
background:#f9fafb;
}

thead th{
font-size:12px;
padding:12px 18px;
text-align:left;
color:var(--muted);
}

tbody tr{
border-top:1px solid var(--border);
}

tbody tr:hover{
background:#f9fafb;
}

tbody td{
padding:13px 18px;
font-size:14px;
}

.mono{
font-family:monospace;
}

/* BUTTON */

.btn{
padding:7px 14px;
font-size:13px;
border-radius:6px;
cursor:pointer;
border:none;
}

.btn-primary{
background:var(--primary-dark);
color:white;
}

.btn-primary:hover{
background:#1a252f;
}

.btn-ghost{
background:white;
border:1px solid var(--border);
}

/* TABLE BUTTON */

.tbl-btn{
font-size:12px;
padding:4px 10px;
border:1px solid var(--border);
background:white;
cursor:pointer;
border-radius:4px;
}

.tbl-btn.del{
color:var(--red);
}

/* STATUS */

.pill{
font-size:11px;
padding:4px 8px;
border-radius:12px;
}

.pill-available{
background:#eafaf1;
color:var(--green);
}

.pill-confirmed{
background:#eafaf1;
color:var(--green);
}
.pill-notconfirmed{
background:#eafaf1;
color:var(--red);
}

.pill-active{
background:#eafaf1;
color:var(--green);
}

/* FORM */

.form-body{
padding:20px;
display:grid;
grid-template-columns:1fr 1fr;
gap:16px;
}

.form-group{
display:flex;
flex-direction:column;
gap:6px;
}

.form-group.full{
grid-column:1 / -1;
}

label{
font-size:12px;
color:var(--muted);
}

input,
select,
textarea{
padding:10px;
border:1px solid var(--border);
border-radius:6px;
}

input:focus,
select:focus,
textarea:focus{
outline:none;
border-color:var(--primary);
}

textarea{
resize:vertical;
min-height:80px;
}

.form-footer{
padding:0 20px 20px;
display:flex;
gap:10px;
}

/* ================= MOBILE ================= */

.menu-btn{
display:none;
background:none;
border:none;
font-size:20px;
cursor:pointer;
}

/* TABLE SCROLL MOBILE */

table{
min-width:700px;
}

.card{
overflow-x:auto;
}

/* RESPONSIVE */

@media (max-width:900px){

/* SIDEBAR */

#sidebar{
position:fixed;
left:-260px;
top:0;
height:100%;
z-index:1000;
transition:0.3s;
}

#sidebar.active{
left:0;
}

/* MENU BUTTON */

.menu-btn{
display:block;
}

/* MAIN */

#main{
width:100%;
}

/* STATS */

.stats-row{
grid-template-columns:1fr;
}

/* FORM */

.form-body{
grid-template-columns:1fr;
}

/* TOPBAR */

.topbar{
padding:0 15px;
}

/* CONTENT */

.content{
padding:15px;
}

}

/* SMALL PHONE */

@media (max-width:500px){

.page-title{
font-size:14px;
}

.avatar{
width:28px;
height:28px;
font-size:10px;
}

.topbar-date{
display:none;
}

}

  </style>

<script>

function toggleSidebar(){
  document.getElementById("sidebar").classList.toggle("active");
}

  const titles = {
    'dashboard':     'Dashboard',
    'notifikasi':    'Notifikasi',
    'daftar-kamar':  'Daftar Kamar',
    'pesanan-kamar': 'Daftar Pesanan',
    'tambah-kamar':  'Tambah Kamar',
    'karyawan':      'Daftar Karyawan',
    'tambah-karyawan':      'Tambah Karyawan',
  };
  function switchTab(target) {
    document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
    document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
    const sec = document.getElementById(target);
    if (sec) sec.classList.add('active');
    const item = document.querySelector('.nav-item[data-target="' + target + '"]');
    if (item) item.classList.add('active');
    document.getElementById('pageTitle').textContent = titles[target] || target;
  }
  document.querySelectorAll('.nav-item[data-target], .nav-item-admin[data-target]')
    .forEach(item => {
    item.addEventListener('click', () => switchTab(item.dataset.target));
  });

  @if(isset($tab))
    switchTab("{{ $tab }}");
@endif
</script>
</body>
</html>
