@extends('layouts.app')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Permintaan Barang</h3>
                <p class="text-subtitle text-muted">Ajukan barang yang dibutuhkan sesuai kebutuhanmu.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Input</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Permintaan Barang</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('request_items.store') }}" method="POST" id="formAdd">

                        @include('includes.notification')

                        @csrf

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="helpInputTop">No Pengajuan</label>
                                    <input type="text" name="request_no" class="form-control" id="helpInputTop">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="basicInput">Nama</label>
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" readonly class="form-control" id="basicInput" placeholder="">
                                    <input type="text" value="{{ auth()->user()->name }}" readonly class="form-control" id="basicInput" placeholder="">
                                </div>
                            </div>

                            {{-- <div>
                                <h3 style="font-variant: small-caps;">penjumlahan dalam bentuk perkalian [*]</h3>
                                <input name="harga" id="harga" onkeyup="sumHM();" >
                                <input name="jumlah" id="jumlah" onkeyup="sumHM();" >
                                <input name="total" id="total">
                            </div> --}}

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="basicInput">Division</label>
                                    <input type="hidden" name="division_id" value="{{ auth()->user()->division_id }}" readonly class="form-control" id="basicInput" placeholder="">
                                    <input type="text" value="{{ auth()->user()->division->division_name }}" readonly class="form-control" id="basicInput" placeholder="">
                                </div>
                            </div>

                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <strong>Division:</strong>
                                    <select name="division_id" id="division" class="form-select choices" required>
                                        <option value="" selected hidden>--Choose Division--</option>
                                        @foreach($divisions as $division)
                                            <option value="{{ $division->id ?? '' }}">{{ $division->division_name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}

                            <div class="form-group">
                                <label for="helperText">Description</label>
                                <p><small class="text-muted">Find helper text here for given textbox.</small></p>
                                <textarea name="description" class="form-control" id="" cols="10" rows="5"></textarea>
                            </div>

                            {{-- <label for="">Test Format Rupiah</label>
                            <div class="input-group mb-3 mt-2">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                <input type="text" class="form-control tanpa-rupiah" placeholder="Harga" aria-label="Harga" aria-describedby="basic-addon1">
                            </div> --}}
                        </div>

                        <div class="table-responsive mt-2">
                            <label for="">Detail Item</label>
                            <table class="table mt-2" id="t_item">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Unit Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Remarks</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(old('_token'))
                                        @foreach (old('item') as $key => $val)

                                        <tr>
                                            <td>
                                                <input type="text" name="item[{{ $key }}]" id="item_{{ $key }}" class="form-control" value="{{ old('item')[$key] }}">
                                            </td>
                                            <td>
                                                <input type="number" name="unit_price[{{ $key }}]" onkeyup="sumHM();" id="unit_price_{{ $key }}" class="form-control" value="{{ old('unit_price')[$key] }}">
                                            </td>
                                            <td>
                                                <input type="number" name="qty[{{ $key }}]" onkeyup="sumHM();" id="qty_{{ $key }}" class="form-control" value="{{ old('qty')[$key] }}">
                                            </td>
                                            <td>
                                                <input type="number" name="total[{{ $key }}]" id="total_{{ $key }}" class="form-control" value="{{ old('total')[$key] }}">
                                            </td>
                                            <td>
                                                <input type="text" name="remark[{{ $key }}]" id="remark_{{ $key }}" class="form-control" value="{{ old('remark')[$key] }}">
                                            </td>
                                            <td>
                                                {!! $key !==0 ? '<button type="button" class="btn btn-sm btn-danger btn-delete" >X</button> ' : '' !!}
                                            </td>
                                        </tr>

                                        @endforeach

                                    @else

                                    <tr>
                                        <td>
                                            <input type="text" name="item[0]" id="item_0" class="form-control">
                                        </td>
                                        <td>
                                            <input type="number" name="unit_price[0]" id="unit_price_0" class="form-control">
                                        </td>
                                        <td>
                                            <input type="number" name="qty[0]" id="qty_0" class="form-control">
                                        </td>
                                        <td>
                                            <input type="number" name="total[0]" id="total_0" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="remark[0]" id="remark_0" class="form-control">
                                        </td>
                                        <td></td>
                                    </tr>

                                    @endif

                                </tbody>
                                <tfoot>
                                    <td colspan="7">
                                        <button class="btn btn-sm btn-info" id="btn_add" type="button">+ Add Item</button>
                                    </td>
                                </tfoot>
                            </table>
                        </div>

                        <button class="btn btn-md btn-primary float-end" id="btn_save" type="submit">Save</button>

                    </form>
                </div>
            </div>
        </section>

    </div>
</div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function(){

            let count = {{ old('_token') ? count(old('item')) : 0 }};

            $('#btn_add').on('click', function() {
                count += 1

                let row = `
                    <tr>
                        <td>
                            <input type="text" name="item[${count}]" id="item_${count}" class="form-control">
                        </td>
                        <td>
                            <input type="number" name="unit_price[${count}]" id="unit_price_${count}" class="form-control">
                        </td>
                        <td>
                            <input type="number" name="qty[${count}]" id="qty_${count}" class="form-control tanpa-rupiah">
                        </td>
                        <td>
                            <input type="number" name="total[${count}]" id="total_${count}" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="remark[${count}]" id="remark_${count}" class="form-control">
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger btn-delete">X</button>
                        </td>
                    </tr>
                `

                $('#t_item tbody').append(row)
                })

                $('#t_item').on('click', '.btn-delete', function() {
                    $(this).closest('tr').remove()
                })

                $('#formAdd').validate()
        })
    </script>

    <script type="text/javascript">
        function sumHM()
        {
            var unit_price = document.getElementById('harga').value;
            var qty = document.getElementById('jumlah').value;
            var result = 0;
            result = parseInt(unit_price) * parseInt(qty);

            if (!isNaN(result)) {
                document.getElementById('total').value = result;
            }
        }
    </script>

    <script>
        /* Tanpa Rupiah */
        var tanpa_rupiah = document.querySelectorAll('.tanpa-rupiah')[0];
        tanpa_rupiah.addEventListener('keyup', function(e)
        {
            tanpa_rupiah.value = formatRupiah(this.value);
        });

        /* Fungsi */
        function formatRupiah(angka, prefix)
        {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split    = number_string.split(','),
                sisa     = split[0].length % 3,
                rupiah     = split[0].substr(0, sisa),
                ribuan     = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
@endpush
