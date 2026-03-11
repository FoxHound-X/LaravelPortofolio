<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Azure Hotel — Admin Panel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500&family=IBM+Plex+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
</head>
<body>

<aside id="sidebar">
  <div class="brand">
    <div class="brand-logo">
      <div class="brand-icon">🏨</div>
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
      <span class="nav-badge">3</span>
    </div>
    <div class="nav-divider"></div>
    <div class="nav-group">Kamar</div>
    <div class="nav-item" data-target="daftar-kamar">
      <span class="nav-icon">▦</span> Daftar Kamar
    </div>
    <div class="nav-item" data-target="pesanan-kamar">
      <span class="nav-icon">≡</span> Daftar Pesanan
    </div>
    <div class="nav-item" data-target="tambah-kamar">
      <span class="nav-icon">+</span> Tambah Kamar
    </div>
    <div class="nav-divider"></div>
    <div class="nav-group">SDM</div>
    <div class="nav-item" data-target="karyawan">
      <span class="nav-icon">◉</span> Daftar Karyawan
    </div>
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
    <div class="page-title" id="pageTitle">Dashboard</div>
    <div class="topbar-right">
      <div class="topbar-date">2026.03.08 — SUN</div>
      <div class="avatar">AD</div>
    </div>
  </div>

  <div class="content">

    <!-- DASHBOARD -->
    <section class="section active" id="dashboard">
      <div class="welcome-bar">
        <div>
          <div class="welcome-title">Selamat Datang, Administrator</div>
          <div class="welcome-sub">Anda sudah login. Semua sistem berjalan normal.</div>
        </div>
        <div class="online-dot"><div class="dot"></div>ONLINE</div>
      </div>
      <div class="stats-row">
        <div class="stat-box">
          <div class="stat-label">Total Kamar</div>
          <div class="stat-num">{{ $jmlhkamar }}</div>
          <div class="stat-sub">4 sedang maintenance</div>
        </div>
        <div class="stat-box">
          <div class="stat-label">Kamar Aktif</div>
          <div class="stat-num">{{ $KamarAktif }}</div>
          <div class="stat-sub">2 check-in hari ini</div>
        </div>
        <div class="stat-box">
          <div class="stat-label">Karyawan</div>
          <div class="stat-num">12</div>
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
            <tr>
              <td class="mono" style="color:var(--muted);">09:42</td>
              <td>Pesanan baru — Kamar 201</td>
              <td>Budi Santoso</td>
              <td><span class="pill pill-confirmed">CONFIRMED</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <!-- NOTIFIKASI -->
    <section class="section" id="notifikasi">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Notifikasi</div>
          <button class="btn btn-ghost">Tandai Semua Dibaca</button>
        </div>
        <div class="notif-row">
          <div class="notif-bar"></div>
          <div>
            <div class="notif-title">Pesanan baru diterima</div>
            <div class="notif-desc">Tamu Budi Santoso memesan Kamar 201 — Deluxe King.</div>
            <div class="notif-time">08:37 — 5 menit lalu</div>
          </div>
        </div>
        <div class="notif-row">
          <div class="notif-bar"></div>
          <div>
            <div class="notif-title">2 tamu dijadwalkan check-in</div>
            <div class="notif-desc">Check-in pukul 14:00 WIB. Siapkan kamar 101 dan 204.</div>
            <div class="notif-time">07:00 — 1 jam lalu</div>
          </div>
        </div>
        <div class="notif-row">
          <div class="notif-bar"></div>
          <div>
            <div class="notif-title">Kamar 305 — Maintenance selesai</div>
            <div class="notif-desc">Suite Room sudah siap digunakan kembali.</div>
            <div class="notif-time">06:15 — 3 jam lalu</div>
          </div>
        </div>
        <div class="notif-row">
          <div class="notif-bar read"></div>
          <div>
            <div class="notif-title" style="color:var(--muted);">Laporan bulanan Februari tersedia</div>
            <div class="notif-desc" style="color:var(--muted);">Laporan telah dibuat dan siap diunduh.</div>
            <div class="notif-time">2026.03.06 — 2 hari lalu</div>
          </div>
        </div>
      </div>
    </section>

    <!-- DAFTAR KAMAR -->
    <section class="section" id="daftar-kamar">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Daftar Kamar</div>
          <button class="btn btn-primary" onclick="switchTab('tambah-kamar')">+ Tambah Kamar</button>
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
                    <button class="tbl-btn">EDIT</button>
                    <form action="/kamar/{{ $itemkamar->id }}" method="POST">
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
      <div class="card">
        <div class="card-header">
          <div class="card-title">Tambah Kamar Baru</div>
        </div>
        <div class="form-body">
          <div class="form-group">
            <label>Nomor Kamar</label>
            <input type="text" placeholder="cth. 301"/>
          </div>
          <div class="form-group">
            <label>Tipe Kamar</label>
            <select>
              <option>Standard Twin</option>
              <option>Standard Queen</option>
              <option>Deluxe King</option>
              <option>Suite</option>
              <option>Presidential Suite</option>
            </select>
          </div>
          <div class="form-group">
            <label>Lantai</label>
            <input type="number" placeholder="cth. 3"/>
          </div>
          <div class="form-group">
            <label>Harga per Malam (Rp)</label>
            <input type="number" placeholder="cth. 800000"/>
          </div>
          <div class="form-group">
            <label>Kapasitas Tamu</label>
            <input type="number" placeholder="cth. 2"/>
          </div>
          <div class="form-group">
            <label>Status Kamar</label>
            <select>
              <option>Tersedia</option>
              <option>Terisi</option>
              <option>Maintenance</option>
            </select>
          </div>
          <div class="form-group full">
            <label>Fasilitas / Keterangan</label>
            <textarea placeholder="cth. AC, WiFi, TV 42in, bathtub, pemandangan laut..."></textarea>
          </div>
        </div>
        <div class="form-footer">
          <button class="btn btn-primary">SIMPAN KAMAR</button>
          <button class="btn btn-ghost">BATAL</button>
        </div>
      </div>
    </section>

    <!-- KARYAWAN -->
    <section class="section" id="karyawan">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Daftar Karyawan</div>
          <button class="btn btn-primary">+ Tambah Karyawan</button>
        </div>
        <table>
          <thead>
            <tr>
              <th>ID</th><th>Nama</th><th>Posisi</th>
              <th>Shift</th><th>No. HP</th><th>Status</th><th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="mono" style="color:var(--c3);">#EMP-001</td>
              <td>
                <div style="display:flex;align-items:center;gap:10px;">
                  <div style="width:28px;height:28px;background:var(--c2);border:2px solid var(--c3);display:flex;align-items:center;justify-content:center;font-family:'IBM Plex Mono',monospace;font-size:10px;color:var(--c3);">SL</div>
                  Siti Lestari
                </div>
              </td>
              <td>Front Desk</td>
              <td class="mono">07:00 – 15:00</td>
              <td class="mono">0812-3456-7890</td>
              <td><span class="pill pill-active">AKTIF</span></td>
              <td>
                <button class="tbl-btn">EDIT</button>
                <button class="tbl-btn del">HAPUS</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

  </div>
</main>

  <style>
    :root {
      --c0: #0D1433;
      --c1: #171F55;
      --c2: #274272;
      --c3: #6C90C3;
      --c4: #9BB8D8;
      --text: #D4E2F4;
      --muted: #5A7AA8;
      --line: #1E2D5A;
      --green: #3DB87A;
      --amber: #D4A029;
      --red:   #C44B4B;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'IBM Plex Sans', sans-serif;
      background: var(--c0);
      color: var(--text);
      display: flex;
      min-height: 100vh;
      overflow: hidden;
    }
    #sidebar {
      width: 240px;
      min-height: 100vh;
      background: var(--c1);
      border-right: 2px solid var(--line);
      display: flex;
      flex-direction: column;
      flex-shrink: 0;
    }
    .brand {
      padding: 28px 24px 22px;
      border-bottom: 2px solid var(--line);
    }
    .brand-logo { display: flex; align-items: center; gap: 10px; }
    .brand-icon {
      width: 36px; height: 36px;
      background: var(--c3);
      display: flex; align-items: center; justify-content: center;
      font-size: 16px;
    }
    .brand-name {
      font-family: 'IBM Plex Mono', monospace;
      font-size: 13px; font-weight: 500;
      letter-spacing: .12em; color: var(--c3); text-transform: uppercase;
    }
    .brand-sub { font-size: 10px; color: var(--muted); margin-top: 2px; letter-spacing: .08em; }
    nav { flex: 1; padding: 16px 0; display: flex; flex-direction: column; }
    .nav-group {
      padding: 10px 20px 4px;
      font-family: 'IBM Plex Mono', monospace;
      font-size: 9px; font-weight: 500;
      letter-spacing: .2em; text-transform: uppercase;
      color: var(--muted);
    }
    .nav-item {
      display: flex; align-items: center; gap: 12px;
      padding: 10px 24px;
      cursor: pointer;
      color: var(--muted);
      font-size: 13px; font-weight: 400;
      transition: background .12s, color .12s;
      border-left: 3px solid transparent;
    }
    .nav-item .nav-icon { width: 18px; text-align: center; font-size: 14px; flex-shrink: 0; }
    .nav-item:hover { background: var(--c0); color: var(--text); }
    .nav-item.active { background: var(--c0); color: var(--c3); border-left-color: var(--c3); font-weight: 500; }
    .nav-badge {
      margin-left: auto;
      background: var(--c2); color: var(--c3);
      font-family: 'IBM Plex Mono', monospace;
      font-size: 10px; padding: 1px 7px; font-weight: 500;
    }
    .nav-divider { height: 2px; background: var(--line); margin: 8px 0; }
    .sidebar-footer { border-top: 2px solid var(--line); padding: 16px 0; }
    .nav-item.logout:hover { background: #2a1414; color: var(--red); border-left-color: var(--red); }
    #main { flex: 1; background: var(--c0); overflow-y: auto; display: flex; flex-direction: column; }
    .topbar {
      background: var(--c1);
      border-bottom: 2px solid var(--line);
      padding: 0 32px; height: 56px;
      display: flex; align-items: center; justify-content: space-between;
      flex-shrink: 0; position: sticky; top: 0; z-index: 10;
    }
    .page-title {
      font-family: 'IBM Plex Mono', monospace;
      font-size: 13px; font-weight: 500;
      letter-spacing: .1em; text-transform: uppercase; color: var(--c3);
    }
    .topbar-right { display: flex; align-items: center; gap: 20px; }
    .topbar-date { font-family: 'IBM Plex Mono', monospace; font-size: 11px; color: var(--muted); }
    .avatar {
      width: 32px; height: 32px;
      background: var(--c2); border: 2px solid var(--c3);
      display: flex; align-items: center; justify-content: center;
      font-family: 'IBM Plex Mono', monospace;
      font-size: 11px; font-weight: 500; color: var(--c3);
    }
    .content { padding: 28px 32px; flex: 1; }
    .section { display: none; }
    .section.active { display: block; animation: fadeUp .2s ease; }
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(8px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .welcome-bar {
      background: var(--c2);
      border-left: 4px solid var(--c3);
      padding: 20px 24px; margin-bottom: 24px;
      display: flex; align-items: center; justify-content: space-between;
    }
    .welcome-title {
      font-family: 'IBM Plex Mono', monospace;
      font-size: 15px; font-weight: 500; color: var(--c4);
    }
    .welcome-sub { font-size: 12px; color: var(--muted); margin-top: 4px; }
    .online-dot {
      display: flex; align-items: center; gap: 7px;
      font-family: 'IBM Plex Mono', monospace;
      font-size: 11px; color: var(--green);
    }
    .dot { width: 8px; height: 8px; background: var(--green); }
    .stats-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2px; margin-bottom: 24px; }
    .stat-box { background: var(--c1); padding: 22px 24px; border-top: 3px solid var(--c2); }
    .stat-box:first-child { border-top-color: var(--c3); }
    .stat-label {
      font-family: 'IBM Plex Mono', monospace;
      font-size: 9px; letter-spacing: .2em;
      text-transform: uppercase; color: var(--muted); margin-bottom: 10px;
    }
    .stat-num {
      font-family: 'IBM Plex Mono', monospace;
      font-size: 44px; font-weight: 400; color: var(--text); line-height: 1;
    }
    .stat-sub { font-size: 11px; color: var(--muted); margin-top: 6px; }
    .card { background: var(--c1); border: 2px solid var(--line); }
    .card-header {
      padding: 16px 24px; border-bottom: 2px solid var(--line);
      display: flex; align-items: center; justify-content: space-between;
    }
    .card-title {
      font-family: 'IBM Plex Mono', monospace;
      font-size: 11px; font-weight: 500;
      letter-spacing: .14em; text-transform: uppercase; color: var(--c3);
    }
    .btn {
      font-family: 'IBM Plex Mono', monospace;
      font-size: 11px; font-weight: 500; letter-spacing: .06em;
      padding: 7px 16px; cursor: pointer; border: none; transition: background .12s;
    }
    .btn-primary { background: var(--c3); color: var(--c0); }
    .btn-primary:hover { background: var(--c4); }
    .btn-ghost { background: transparent; color: var(--muted); border: 2px solid var(--line); }
    .btn-ghost:hover { border-color: var(--c2); color: var(--text); }
    table { width: 100%; border-collapse: collapse; }
    thead th {
      padding: 10px 20px; text-align: left;
      font-family: 'IBM Plex Mono', monospace;
      font-size: 9px; font-weight: 500; letter-spacing: .18em;
      text-transform: uppercase; color: var(--muted);
      background: var(--c0); border-bottom: 2px solid var(--line);
    }
    tbody tr { border-bottom: 1px solid var(--line); }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: rgba(39,66,114,.3); }
    tbody td { padding: 13px 20px; font-size: 13px; color: var(--text); }
    .mono { font-family: 'IBM Plex Mono', monospace; font-size: 12px; }
    .pill {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 3px 10px;
      font-family: 'IBM Plex Mono', monospace;
      font-size: 10px; font-weight: 500; letter-spacing: .06em;
    }
    .pill-available { background: #0d2e1d; color: var(--green); }
    .pill-booked    { background: #152040; color: var(--c3); }
    .pill-maint     { background: #2e2208; color: var(--amber); }
    .pill-confirmed { background: #0d2e1d; color: var(--green); }
    .pill-pending   { background: #2e2208; color: var(--amber); }
    .pill-cancelled { background: #2e0d0d; color: var(--red); }
    .pill-active    { background: #0d2e1d; color: var(--green); }
    .tbl-btn {
      font-family: 'IBM Plex Mono', monospace;
      font-size: 10px; font-weight: 500;
      padding: 4px 11px; cursor: pointer;
      border: 1px solid var(--line); background: transparent;
      color: var(--c3); transition: all .12s;
      margin-right: 4px; letter-spacing: .04em;
    }
    .tbl-btn:hover { background: var(--c2); border-color: var(--c3); }
    .tbl-btn.del { color: var(--red); border-color: #3a1a1a; }
    .tbl-btn.del:hover { background: #2e1010; border-color: var(--red); }
    .notif-row {
      display: flex; align-items: flex-start; gap: 16px;
      padding: 16px 24px; border-bottom: 1px solid var(--line);
    }
    .notif-row:last-child { border-bottom: none; }
    .notif-row:hover { background: rgba(39,66,114,.2); }
    .notif-bar { width: 3px; background: var(--c3); flex-shrink: 0; align-self: stretch; min-height: 40px; }
    .notif-bar.read { background: var(--line); }
    .notif-title { font-size: 13px; font-weight: 500; color: var(--text); }
    .notif-desc  { font-size: 12px; color: var(--muted); margin-top: 3px; }
    .notif-time  { font-family: 'IBM Plex Mono', monospace; font-size: 10px; color: var(--muted); margin-top: 5px; }
    .form-body { padding: 24px; display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .form-group { display: flex; flex-direction: column; gap: 6px; }
    .form-group.full { grid-column: 1 / -1; }
    label {
      font-family: 'IBM Plex Mono', monospace;
      font-size: 9px; font-weight: 500; letter-spacing: .18em;
      text-transform: uppercase; color: var(--muted);
    }
    input, select, textarea {
      background: var(--c0); border: 2px solid var(--line);
      color: var(--text);
      font-family: 'IBM Plex Sans', sans-serif;
      font-size: 13px; padding: 9px 13px;
      outline: none; transition: border-color .15s;
    }
    input:focus, select:focus, textarea:focus { border-color: var(--c3); }
    select option { background: var(--c1); }
    textarea { resize: vertical; min-height: 80px; }
    .form-footer { padding: 0 24px 24px; display: flex; gap: 10px; }
    ::-webkit-scrollbar { width: 4px; height: 4px; }
    ::-webkit-scrollbar-track { background: var(--c0); }
    ::-webkit-scrollbar-thumb { background: var(--c2); }
    ::-webkit-scrollbar-thumb:hover { background: var(--c3); }
  </style>

<script>
  const titles = {
    'dashboard':     'Dashboard',
    'notifikasi':    'Notifikasi',
    'daftar-kamar':  'Daftar Kamar',
    'pesanan-kamar': 'Daftar Pesanan',
    'tambah-kamar':  'Tambah Kamar',
    'karyawan':      'Daftar Karyawan',
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
  document.querySelectorAll('.nav-item[data-target]').forEach(item => {
    item.addEventListener('click', () => switchTab(item.dataset.target));
  });
</script>
</body>
</html>
