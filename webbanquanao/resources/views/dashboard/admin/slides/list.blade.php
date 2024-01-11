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
        <li class="breadcrumb-item active">Slide</li>
      </ol>
    </nav>
</div>


<div class="card">
    <div class="card-body">
      <h5 class="card-title">List slide</h5>
      <div class="d-flex justify-content-end mt-2 mb-2">
        <a href="{{ route('form_add_slide')}}" class="btn btn-primary mb-3 bt-3" >
            Add Slide
          </a>
        </div>
      <!-- Table with stripped rows -->
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Image Slide</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody> 
          @php $count=0; @endphp
          @foreach ($list as $item)
          @php $count++; @endphp
         
          <tr>
            <th scope="row">{{ $count}}</th>
            <td><h1>{{ $item->title}}</h1></td>
            <td><p>{{ $item->desc}}</p></td>
            <td><img width="150px" height="auto" src="{{ $item->code_image}}" alt="{{ $item->name_image}}"></td>
            <td>
                <a href="{{ route('edit_slide',[$item->id])}}" class="btn btn-success">Edit</a>
                <a data-url="{{ route('delete_slide',[$item->id])}}" class="btn btn-warning deleteSlide">Delete</a>
            </td>
            @endforeach
          </tr>
        </tbody>
      </table>
      <!-- End Table with stripped rows -->

    </div>
</div>
@endsection
