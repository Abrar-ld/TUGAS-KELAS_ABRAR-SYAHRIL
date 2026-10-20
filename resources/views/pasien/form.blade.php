<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ isset($pasien) ? 'Edit' : 'Tambah' }} Data Pasien - Klinik Rawat Jalan</title>
  <link rel="stylesheet" href="{{ asset('css/mnjmpasien.css') }}">
</head>
<body>

  <header class="topbar">
    <span class="brand">Klinik Rawat Jalan</span>
    <nav>
      <a href="{{ route('pasien.index') }}" class="active">Pasien</a>
    </nav>
  </header>

  <main class="container">
    <div class="page-head">
      <h1>{{ isset($pasien) ? 'Edit' : 'Tambah' }} data pasien</h1>
      <p>Isi profil dasar pasien. Kolom bertanda <span class="req">*</span> wajib diisi.</p>
    </div>

    <form class="card" method="POST"
          action="{{ isset($pasien) ? route('pasien.update', $pasien) : route('pasien.store') }}">
      @csrf
      @if (isset($pasien))
        @method('PUT')
      @endif

      <fieldset>
        <legend>Identitas pasien</legend>

        <div class="field">
          <label for="nama_pasien">Nama pasien <span class="req">*</span></label>
          <input type="text" id="nama_pasien" name="nama_pasien"
                 placeholder="Contoh: Siti Rahmawati"
                 value="{{ old('nama_pasien', $pasien->nama_pasien ?? '') }}" required>
          @error('nama_pasien') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="row">
          <div class="field">
            <label for="tanggal_lahir">Tanggal lahir <span class="req">*</span></label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                   value="{{ old('tanggal_lahir', isset($pasien) ? \Carbon\Carbon::parse($pasien->tanggal_lahir)->format('Y-m-d') : '') }}" required>
            @error('tanggal_lahir') <div class="error-text">{{ $message }}</div> @enderror
          </div>

          <div class="field">
            <label for="no_rekam_medis">No. rekam medis <span class="req">*</span></label>
            <input type="text" id="no_rekam_medis" name="no_rekam_medis"
                   placeholder="Contoh: RM-000123"
                   value="{{ old('no_rekam_medis', $pasien->no_rekam_medis ?? '') }}" required>
            <small>Nomor unik untuk setiap pasien.</small>
            @error('no_rekam_medis') <div class="error-text">{{ $message }}</div> @enderror
          </div>
        </div>
      </fieldset>

      <fieldset>
        <legend>Domisili &amp; kontak</legend>

        <div class="field">
          <label for="domisili">Domisili <span class="req">*</span></label>
          <textarea id="domisili" name="domisili" rows="3"
                    placeholder="Alamat tempat tinggal saat ini" required>{{ old('domisili', $pasien->domisili ?? '') }}</textarea>
          @error('domisili') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="field">
          <label for="kontak_darurat">Kontak darurat <span class="req">*</span></label>
          <input type="tel" id="kontak_darurat" name="kontak_darurat"
                 placeholder="Contoh: 081234567890" pattern="[0-9+\- ]{8,15}"
                 value="{{ old('kontak_darurat', $pasien->kontak_darurat ?? '') }}" required>
          <small>Nomor keluarga atau orang terdekat yang bisa dihubungi.</small>
          @error('kontak_darurat') <div class="error-text">{{ $message }}</div> @enderror
        </div>
      </fieldset>

      <div class="actions">
        <a href="{{ route('pasien.index') }}" class="btn btn-ghost">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan pasien</button>
      </div>
    </form>
  </main>
</body>
</html>