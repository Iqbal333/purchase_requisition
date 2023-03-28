<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Daftar Pengajuan Barang</title>
    <link rel="stylesheet" href="{{ asset('assets/css/report.css')}}" media="all" />
  </head>
  <body class="container-fluid">
    <header class="clearfix">
      <div id="logo">
        <img src="{{ asset('assets/images/logo/lg-creatsign.jpg') }}">
      </div>
      <h1>PT. ANUGRAH INTI ARTHA MANDIRI</h1>
      <div id="company" class="clearfix">
        <div>PT. ANUGRAH INTI ARTHA MANDIRI</div>
        <div>
            Jl. Bekasi Tim. Raya IX No. 17 A, <br>
            RT 04/RW 10, Rawa Bunga <br>
            Kecamatan Jatinegara, Kota Jakarta Timur, <br>
            Daerah Khusus Ibukota Jakarta 13350
        </div>
        <div>(021) 22897527</div>
      </div>
      <div id="project">
        <div><span>NO</span> {{ $request_items->request_no }}</div>
        <div><span>DIVISI</span> {{ $request_items->division->division_name }}</div>
        <div><span>NAMA</span> {{ $request_items->user->name }}</div>
        <div><span>EMAIL</span> <a href="javascript:void(0);">{{ $request_items->user->email }}</a></div>
        <div><span>TANGGAL</span> {{ $request_items->created_at }}</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">NO</th>
            <th class="desc">NAMA BARANG</th>
            <th class="qty">JUMLAH</th>
            <th class="unit">HARGA</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($request_items->items as $item => $val)
            <tr>
                <td class="service">{{ $loop->iteration }}</td>
                <td class="desc">{{ $val->item }}</td>
                <td class="qty">{{ $val->qty }}</td>
                <td class="unit">@currency($val->unit_price)</td>
                <td class="total">@currency($val->total)</td>
            </tr>
        @endforeach
          <tr>
            <td colspan="4">SUBTOTAL</td>
            @foreach ($grandtotals as $grandtotal)
            <td class="total">@currency($grandtotal->grandtotal)</td>
            @endforeach
          </tr>
          <tr>
          </tr>
          <tr>
            <td colspan="4" class="grand total">GRAND TOTAL</td>
            @foreach ($grandtotals as $grandtotal)
            <td class="grand total">@currency($grandtotal->grandtotal)</td>
            @endforeach
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div class="notice">Invoice dibuat oleh komputer dan berlaku tanpa tanda tangan dan stempel.</div>
      </div>
    </main>
    <footer>
      Invoice dibuat oleh komputer dan berlaku tanpa tanda tangan dan stempel.
    </footer>
  </body>
</html>
