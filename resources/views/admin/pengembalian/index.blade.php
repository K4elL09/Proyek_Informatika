@extends('layouts.admin')

@section('title', 'Pengembalian & Verifikasi')

@section('content')

    <div class="stok-header">
        <h1>Verifikasi Pembayaran</h1>
    </div>

    @if (session('success'))
        <div class="alert-success" style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert-danger" style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px;">{{ session('error') }}</div>
    @endif

    <div class="stok-table-container" style="margin-bottom: 50px;">
        <table class="stok-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pemesan</th>
                    <th>Total</th>
                    <th>Bukti</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksiVerifikasi as $transaksi)
                <tr>
                    <td>#{{ $transaksi->id }}</td>
                    <td>{{ $transaksi->nama }}</td>
                    <td>Rp{{ number_format($transaksi->total, 0, ',', '.') }}</td>
                    <td>
    @if($transaksi->bukti_transfer)
        <small style="display:block; font-size: 10px; color: yellow;">
            DB: {{ $transaksi->bukti_transfer }}
        </small>

        <a href="{{ asset('storage/' . $transaksi->bukti_transfer) }}" target="_blank" class="btn-edit" style="background: #17a2b8; color: white; border:none; padding: 5px 10px; cursor: pointer; display: inline-block; margin-top: 5px;">
            <i class="fas fa-image"></i> Lihat (Cara 1)
        </a>

        @else
        <span style="color: #aaa;">-</span>
    @endif
</td>
                    <td>
                        <form action="{{ route('admin.pembayaran.setuju', $transaksi->id) }}" method="POST" onsubmit="return confirm('Setujui pembayaran ini? Stok akan dikurangi.');">
                            @csrf
                            <button type="submit" class="btn-tambah" style="width: auto; padding: 5px 10px; font-size: 12px; background: #28a745;">
                                <i class="fas fa-check"></i> Setujui
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #aaa; padding: 20px;">Tidak ada pembayaran pending.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <div class="stok-header" style="border-top: 1px solid #333; padding-top: 30px;">
        <h1>Alat yang Sedang Disewa</h1>
    </div>

    <div class="stok-table-container">
        <table class="stok-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pemesan</th>
                    <th>Tanggal Sewa</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksiDisewa as $transaksi)
                <tr>
                    <td>#{{ $transaksi->id }}</td>
                    <td>{{ $transaksi->nama }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_sewa)->format('d M Y') }}</td>
                    <td><span style="color: #f0ad4e;">{{ $transaksi->status }}</span></td>
                    <td>
                        <form action="{{ route('admin.pengembalian.proses') }}" method="POST" onsubmit="return confirm('Barang sudah kembali? Stok akan bertambah.');">
                            @csrf
                            <input type="hidden" name="transaksi_id" value="{{ $transaksi->id }}">
                            <button type="submit" class="btn-tambah" style="width: auto; background-color: #007bff; border:none;">
                                <i class="fas fa-box-open"></i> Terima Barang
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #aaa; padding: 20px;">Tidak ada barang disewa.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div id="buktiModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 1000; align-items: center; justify-content: center;">
        <div style="position: relative; background: #222; padding: 10px; border-radius: 10px; max-width: 90%; max-height: 90%;">
            <span onclick="closeBukti()" style="position: absolute; top: -15px; right: -15px; background: red; color: white; border-radius: 50%; width: 30px; height: 30px; text-align: center; line-height: 30px; cursor: pointer; font-weight: bold;">&times;</span>
            <img id="buktiImg" src="" style="max-width: 100%; max-height: 80vh; border-radius: 5px;">
        </div>
    </div>

    <script>
        function showBukti(url) {
            document.getElementById('buktiImg').src = url;
            document.getElementById('buktiModal').style.display = 'flex';
        }
        function closeBukti() {
            document.getElementById('buktiModal').style.display = 'none';
        }
    </script>

@endsection