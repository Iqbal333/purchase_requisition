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
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="helpInputTop">No Pengajuan</label>
                                <input type="text" class="form-control" id="helpInputTop">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Nama</label>
                                <input type="text" value="{{ auth()->user()->name }}" name="name" readonly class="form-control" id="basicInput" placeholder="">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="helpInputTop">Division</label>
                                <input type="text" class="form-control" id="helpInputTop">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="helperText">Description</label>
                            <p><small class="text-muted">Find helper text here for given textbox.</small></p>
                            <textarea name="description" class="form-control" id="" cols="10" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="table-responsive mt-5">
                        <label for="">Detail Item</label>
                        <table class="table mt-5" id="t_item">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Unit</th>
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
                                            <input type="text" name="unit[{{ $key }}]" id="unit_{{ $key }}" class="form-control" value="{{ old('unit')[$key] }}">
                                        </td>
                                        <td>
                                            <input type="number" name="unit_price[{{ $key }}]" id="unit_price_{{ $key }}" class="form-control" value="{{ old('unit_price')[$key] }}">
                                        </td>
                                        <td>
                                            <input type="number" name="qty[{{ $key }}]" id="qty_{{ $key }}" class="form-control" value="{{ old('qty')[$key] }}">
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
                                        <input type="text" name="unit[0]" id="unit_0" class="form-control">
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
                            <input type="text" name="unit[${count}]" id="unit_${count}" class="form-control">
                        </td>
                        <td>
                            <input type="number" name="unit_price[${count}]" id="unit_price_${count}" class="form-control">
                        </td>
                        <td>
                            <input type="number" name="qty[${count}]" id="qty_${count}" class="form-control">
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
@endpush
