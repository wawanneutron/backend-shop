@extends('layouts.app-dashboard', [
    'title' => 'Orders'
])

@section('content')
    <div class="container-fluid" >
        <div class="row">
            {{-- widget resi --}}
            {{-- <div class="widgetCekPengiriman" data-kurir="jne"></div><script src="https://www.cekpengiriman.com/widget/widget_resi.js"></script> --}}
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class=" card-header">
                        <h6 class="m-0 font-weight-bold text-uppercase"><i class="fas fa-shopping-cart mr-3"></i>Data Order</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.order.index') }}" method="get">
                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <input type="text" name="q" class=" form-control" placeholder="Cari Berdasarkan No Invoice">
                                    <div class=" input-group-append">
                                        <button type="submit" class=" btn btn-primary text-uppercase"><i class="fas fa-search"></i> cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class=" table table-hover ">
                                <thead class=" table-primary text-uppercase text-center">
                                    <tr>
                                        <th style="width: 6%">No.</th>
                                        <th>No. Invoice</th>
                                        <th>Nama Lengkap</th>
                                        <th>Grand Total</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($invoices as $no => $invoice)
                                        <tr>
                                            <td>{{ ++$no + ($invoices->currentPage()-1) * ($invoices->perpage()) }}</td>
                                            <td>{{ $invoice->invoice }}</td>
                                            <td>{{ $invoice->name }}</td>
                                            <td>{{ moneyFormat($invoice->grand_total )}}</td>
                                            <td>{{ $invoice->status }}</td>
                                            <td>
                                                <a href="{{ route('admin.order.show', $invoice->id) }}" class=" btn btn-primary ml-4"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            <p>Order Belum Tersedia !</p>
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $invoices->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
        <label for="category">Status</label>
        <select name="category_id" class=" form-control">
            <option>-- PILIH STATUS --</option>
            <option value="process">Sedang Diproses</option>
            <option value="pengiriman" v-model="resi" @change="inputResi">Sedang Dikirim</option>
        </select>
         <template v-if="status  == 'SHIPPING'">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="product-title mb-2">Input Resi</div>
            <input
                type="text"
                class="form-control"
                name="resi"
                v-model="resi"
            />
            </div>
            <div class="col-12 col-md-4 col-md-4 col-lg-3 mt-2">
            <button
                type="submit"
                class="btn btn-success mt-4 btn-block"
            >
                Update Resi
            </button>
            </div>
        </template>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection

