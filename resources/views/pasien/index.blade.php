<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Pasien - Klinik Rawat Jalan</title>
  <link rel="stylesheet" href="{{ asset('css/mnjmpasien.css') }}">
</head>
<body>

  <header class="topbar">
    <span class="brand">Klinik Rawat Jalan</span>
    <nav>
      <a href="{{ route('pasien.index') }}" class="active">Pasien</a>
    </nav>
  </header>

  <main class="container wide">

    <div class="page-head flex">
      <div>
        <h1>Daftar Pasien Terdaftar</h1>
        <p>Total {{ $pasiens->count() }} pasien. Kelola data: tambah, ubah, dan hapus.</p>
      </div>
      <a href="{{ route('pasien.create') }}" class="btn btn-primary">+ Tambah pasien</a>
    </div>

    @if (session('sukses'))
      <div class="alert-success">{{ session('sukses') }}</div>
    @endif

    <div class="card flush">
      <div class="table-wrap">
        <table class="data-table">
          <thead>
            <tr>
              <th>No</th>
              <th>No. Rekam Medis</th>
              <th>Nama Pasien</th>
              <th>Tanggal Lahir</th>
              <th>Domisili</th>
              <th>Kontak Darurat</th>
              <th class="center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($pasiens as $p)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td><span class="badge">{{ $p->no_rekam_medis }}</span></td>
                <td><strong>{{ $p->nama_pasien }}</strong></td>
                <td class="nowrap">{{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d/m/Y') }}</td>
                <td>{{ $p->domisili }}</td>
                <td class="nowrap">{{ $p->kontak_darurat }}</td>
                <td class="center nowrap">
                  <a href="{{ route('pasien.edit', $p) }}" class="btn btn-sm btn-warning">Edit</a>

                  <form action="{{ route('pasien.destroy', $p) }}" method="POST" class="inline"
                        onsubmit="return confirm('Yakin ingin menghapus data pasien ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr><td colspan="7" class="empty">Belum ada data pasien.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </main>
</body>
</html>