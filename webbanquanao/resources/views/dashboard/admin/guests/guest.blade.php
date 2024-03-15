
@extends('dashboard.layout.master')
@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Khách hàng</li>
      </ol>
    </nav>
</div>
<div class="container">
    
<div class="card">
    <div class="card-body">
      <h5 class="card-title">List khách hàng</h5>
      <div class="d-flex justify-content-end mt-2 mb-2">
        <a href="{{ route('form_add_member')}}" class="btn btn-primary mb-3 bt-3" >
            Add Khách hàng
          </a>
        </div>
      <!-- Table with stripped rows -->
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody> 
          @php $count=0; @endphp
          @foreach ($guestUsers as $item)
          @php $count++; @endphp
         
          <tr>
            <th scope="row">{{ $count}}</th>
            <td>{{ $item->name}}</td>
            <td>{{ $item->email}}</td>
            <td>{{ $item->phone}}</td>
            {{-- <td>
              @foreach ($item->roles as $key)
                {{$key->name}}
              @endforeach
            </td> --}}
            <td>
                <a href="{{ route('edit_member',[$item->id])}}" class="btn btn-success">Edit</a>
                <a data-url="{{ route('delete_user',[$item->id])}}" class="btn btn-warning deleteUser">Delete</a>
            </td>
            @endforeach
          </tr>
        </tbody>
      </table>
      <!-- End Table with stripped rows -->

    </div>
</div>

</div>
@endsection



