<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .container {
            max-width: 300px;
            margin: 0 auto;
            border: 2px solid #000;
            padding: 10px;
            background-color: #fff;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .alamat {
            text-align: center;
        }
        .struk {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: none;
            padding: 5px 0;
        }
        th {
            text-align: left;
        }
        .subtotal {
            text-align: right;
        }
        .kembalian {
            text-align: right;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
        }
        .span {
            font-size: .7em;
            font-weight: normal;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Kasir Wikrama <br> <span class="span"> Jl. Raya Wangun, RT.01/RW.06, Sindangsari, Kec. Bogor Tim., Kota Bogor.</span></h2>
            <h3> Struk Penjualan</h3>
        </div>
        <hr>
        <table>
            <tr>
                <th>Tanggal <a style="margin-left:55px ">:</a></th>
                <td>{{ $penjualan->tanggal_penjualan }}</td>
                {{-- <td>{{ $penjualan->TanggalPenjualan }}</td> --}}
            </tr>
            <tr>
                <th>Waktu<a style="margin-left:73px ">:</th>
                {{-- <td>{{ date('H:i:s') }}</td> --}}
                <td>{{ $penjualan->created_at->setTimeZone('Asia/Jakarta')->format('H:i:s')}}</td>                                                <input type="hidden" name="tanggal_penjualan" id="tanggal_penjualan" value="hiddenValue">
            </tr>            
            <tr>
                <th>Pelanggan  <a style="margin-left:35px ">:</a></th>
                <td>{{ $pelanggan->nama_pelanggan}}</td>
                {{-- <td>{{ $pelanggan->NamaPelanggan }}</td> --}}
            </tr>
            {{-- <tr>
                <th>Kasir <a style="margin-left:76px ">:</a></th>
                <td>{{ $cetak->createdBy->username }}</td>
            </tr> --}}
            <tr>
                <th>Alamat<a style="margin-left:68px ">:</a></th>
                <td>{{ $pelanggan->alamat }}</td>
                {{-- <td>{{ $pelanggan->Alamat }}</td> --}}
            </tr>
            <tr>
                <th>Nomor Telepon<a style="margin-left:4px">:</a></th>
                <td>{{ $pelanggan->no_tlp }}</td>
                {{-- <td>{{ $pelanggan->NomorTelepon }}</td> --}}
            </tr>
        </table>
        <table>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th class="subtotal">Subtotal</th>
            </tr>
            @foreach ($penjualans as $detail)
            {{-- @foreach ($detailPenjualan as $detail) --}}
            <tr>
                <td>{{ $detail->produk->nama_produk }}</td>
                <td>{{ $detail->jumlah_produk }}</td>
                <td class="subtotal">RP.{{ number_format ($detail->subtotal, 0,',','.') }}</td>
            </tr>
            @endforeach
        </table>
        <hr>
        <table>
            <tr>
                <th>Total Harga <a style="margin-left:55px ">:</a></th>
                <td class="bayar">Rp. {{ number_format ($detail->penjualan->total_harga, 0,',','.') }}</td>
                {{-- <td>{{ $penjualan->TanggalPenjualan }}</td> --}}
            </tr>
            <tr>
                <th>Bayar<a style="margin-left:103px ">:</a></th>
                <td class="bayar">Rp. {{ number_format ($detail->penjualan->bayar, 0,',','.') }}</td>
                {{-- <td>{{ $pelanggan->NamaPelanggan }}</td> --}}
            </tr>
            {{-- <tr>
                <th>Kasir <a style="margin-left:76px ">:</a></th>
                <td>{{ $cetak->createdBy->username }}</td>
            </tr> --}}
            <tr>
                <th>Kembalian<a style="margin-left:66px ">:</a></th>
                <td class="bayar">Rp. {{ number_format ($detail->penjualan->kembalian, 0,',','.') }}</td>
                {{-- <td>{{ $pelanggan->Alamat }}</td> --}}
            </tr>
        </table>
        <div class="footer">
            <p>Terima kasih telah berbelanja di toko kami!</p>
        </div>
    </div>
    {{-- <a href="detail-penjualan-petugas"><button style="color:#012970"class="button-17" role="button"> Kembali</button></a> --}}
</body>
</html>