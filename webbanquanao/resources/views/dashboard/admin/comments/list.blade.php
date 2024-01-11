@extends('dashboard.layout.master')
@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Comment</li>
      </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
      <h5 class="card-title">List comment</h5>

      <!-- Table with stripped rows -->
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Product</th>
            <th scope="col">Comment</th>
            <th scope="col">Rating</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody> 
          <tr>
            <th scope="row">1</th>
            <td>Slide Show</td>
            <td>Slide Show</td>
            <td>Slide Show</td>
            <td>
                <a href="" class="btn btn-success">Edit</a>
                <a href="" data-url="" class="btn btn-warning deleteCategory">Delete</a>
            </td>
          </tr>
        </tbody>
      </table>
      <!-- End Table with stripped rows -->

    </div>
</div>
{{-- {{ route('delete_category',[$item->id])}} --}}