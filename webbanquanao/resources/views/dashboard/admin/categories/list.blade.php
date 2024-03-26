@extends('dashboard.layout.master')
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('admin/assets/js/deleteAll/delete.js') }}"></script>
@endsection
@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Category</li>
      </ol>
    </nav>
</div>


<div class="card">
    <div class="card-body">
      <h5 class="card-title">List category</h5>
      <div class="d-flex justify-content-end mt-2 mb-2">
        <a href="{{ route('form_add_categories')}}" class="btn btn-primary mb-3 bt-3" >
            Add Category
          </a>
        </div>
      <!-- Table with stripped rows -->
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody> 
          @php $count=0; @endphp
          @foreach ($list as $item)
          @php $count++; @endphp
         
          <tr>
            <th scope="row">{{ $count}}</th>
            <td>{{ $item->name}}</td>
            <td>
              {{-- @can('update', App\Models\CategoriesModel::class)   --}}
                <a  href="{{ route('edit_categories',[$item->id])}}" class="btn btn-success" selected>Edit</a>
              {{-- @endcan --}}
              {{-- @can('delete', App\Models\CategoriesModel::class) --}}
                <a data-url="{{ route('delete_categories',[$item->id])}}" class="btn btn-warning deleteCategory">Delete</a>
              {{-- @endcan --}}
            </td>
            @endforeach
          </tr>
        </tbody>
      </table>
      <!-- End Table with stripped rows -->
      {{ $list->links()}}
    </div>
</div>
@endsection
