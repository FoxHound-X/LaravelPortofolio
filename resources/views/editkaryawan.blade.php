<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Pegawai</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <div class="form-card">
            <h2>Update Data Pegawai</h2>
            <p>Perbarui informasi detail karyawan di bawah ini.</p>
            
            <form action="{{ route( 'update.pegawai', $data->id ) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text"  name="nama_pegawai" value="{{ $data->nama_pegawai }}" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="posisi">Posisi</label>
                        <input type="text" name="posisi" value="{{ $data->posisi }}" required>
                    </div>
                    <div class="form-group">
                        <label for="shift">Shift</label>
                        <input type="text"  name="shift" value="{{ $data->shift }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="hp">Nomor HP</label>
                    <input type="tel" name="nomer_hp" value="{{ $data->nomer_hp }}" required>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" required>
                        <option value="{{ $data->status }}" disabled selected></option>
                        <option value="aktif">Aktif</option>
                        <option value="libur">Libur</option>
                    </select>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

</body>

<style>
    /* Reset Dasar */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
}

body {
    background-color: #f4f7f6;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}

.container {
    width: 100%;
    max-width: 500px;
}

.form-card {
    background: #ffffff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

h2 {
    color: #333;
    margin-bottom: 8px;
    font-size: 1.5rem;
}

p {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 25px;
}

/* Layout Form */
.form-group {
    margin-bottom: 18px;
}

.form-row {
    display: flex;
    gap: 15px;
}

.form-row .form-group {
    flex: 1;
}

label {
    display: block;
    font-size: 0.85rem;
    font-weight: 600;
    color: #444;
    margin-bottom: 6px;
}

input, select {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 0.95rem;
    color: #333;
    outline: none;
    transition: border-color 0.2s;
}

input:focus, select:focus {
    border-color: #4a90e2;
}

/* Tombol */
.button-group {
    margin-top: 10px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

button {
    padding: 12px;
    border: none;
    border-radius: 6px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}

.btn-save {
    background-color: #4a90e2;
    color: white;
}

.btn-save:hover {
    background-color: #357abd;
}

.btn-cancel {
    background-color: transparent;
    color: #888;
}

.btn-cancel:hover {
    color: #333;
}

/* Responsif untuk Layar Kecil */
@media (max-width: 400px) {
    .form-row {
        flex-direction: column;
        gap: 0;
    }
}
</style>

</html>