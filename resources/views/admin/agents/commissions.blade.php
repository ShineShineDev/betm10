@extends('admin.layout.app')
@section('content')
  <nav aria-label="breadcrumb" class="px-md-3 pt-2 p-1 mt-1 ">
    <ol class="breadcrumb p-1 ">
      <li class="breadcrumb-item active font-weight-bold" aria-current="page">Agents / Commissions / Tom Holland</li>
    </ol>
  </nav>
  <div class="px-md-3 p-1">
    <div class="bg-white">
      <div class="content-header">
        <div class="container-fluid">
          @include('admin.agents._commissions_statistics')
        </div>
      </div>
      {{-- Agents Table --}}
      <section class="content pt-3">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                      <th style="width: 10px">NO</th>
                      <th>Slips</th>
                      <th>Friend Name</th>
                      <th>Commission & Rate</th>
                      <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for ($i = 0; $i < 20; $i++)
                      <tr class="p-0">
                        <td>{{ $i + 1 }}</td>
                        <th> #  {{ bin2hex(random_bytes(5)) }} </th>
                        <th>  {{ bin2hex(random_bytes(5)) }} </th>
                        <th> {{ number_format(strval(mt_rand(1000, 10000))) }} (10%)</th>
                        <th> {{ now() }} </th>
                      </tr>
                    @endfor
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
@endsection
