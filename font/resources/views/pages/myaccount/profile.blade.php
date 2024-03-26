@extends('layouts.master')
@section('content')
        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
          <h1 class="text-center text-white display-6">My account</h1>
          <ol class="breadcrumb justify-content-center mb-0">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active text-white">My account</li>
          </ol>
      </div>
      <!-- Single Page Header End -->
      <div class="container-fluid py-5">
        <div class="container py-5">
          <section class="section profile">
            <div class="row">
              <div class="col-xl-4">

                <div class="card">
                  <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <img src="{{ $user['image_avatar']}}" alt="Profile" class="rounded-circle">
                    <h2>{{ $user['name']}}</h2>
                    {{-- <h3>Web Designer</h3> --}}
                    {{-- <div class="social-links mt-2">
                      <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                      <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                      <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                      <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div> --}}
                  </div>
                </div>

              </div>

              <div class="col-xl-8">

                <div class="card">
                  <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                      <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                      </li>

                      <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                      </li>

                      {{-- <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-order">Order</button>
                      </li> --}}


                    </ul>
                    <div class="tab-content pt-2">

                      <div class="tab-pane fade show active profile-overview" id="profile-overview">
                        <h5 class="card-title">About</h5>
                        <p class="small fst-italic">{{ $user['desc']}}</p>

                        <h5 class="card-title">Profile Details</h5>

                        <div class="row">
                          <div class="col-lg-3 col-md-4 label ">Full Name</div>
                          <div class="col-lg-9 col-md-8">{{ $user['name']}}</div>
                        </div>

                        <div class="row">
                          <div class="col-lg-3 col-md-4 label">Phone</div>
                          <div class="col-lg-9 col-md-8">{{ $user['phone']}}</div>
                        </div>

                        <div class="row">
                          <div class="col-lg-3 col-md-4 label">Address</div>
                          <div class="col-lg-9 col-md-8">{{ $user['address']}}</div>
                        </div>

                        <div class="row">
                          <div class="col-lg-3 col-md-4 label">Email</div>
                          <div class="col-lg-9 col-md-8">{{ $user['email']}}</div>
                        </div>

                      </div>

                      <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

              <!-- Profile Edit Form -->
              {{-- action="{{ route('update_profile',[$user->id])}}" --}}
              <form  method="post" enctype="multipart/form-data">
                @csrf
                {{-- @method("PUT") --}}
                <div class="row mb-3">
                  <label class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                  <div class="col-md-8 col-lg-9">
                    <img src="{{ $user['image_avatar']}}" alt="{{ $user['name_avatar']}}">
                    <div class="pt-2">
                      <div class="input-group">
                        <span class="input-group-btn">
                          <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                            <i class="fa fa-picture-o"></i> Choose
                          </a>
                        </span>
                        <input id="thumbnail" class="form-control" type="hidden" name="filepath" value="{{ $user['image_avatar']}}">
          
                    </div>
                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    
                      @if($errors->has('filepath'))
                      <span class="text-danger">{{ $errors->first('filepath') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="name" type="text" class="form-control" id="fullName" value="{{ $user['name']}}">
                    @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea name="desc" class="form-control" id="about" style="height: 100px">{{ $user['desc']}}</textarea>
                    @if($errors->has('desc'))
                    <span class="text-danger">{{ $errors->first('desc') }}</span>
                    @endif
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="address" type="text" class="form-control" id="Address" value="{{ $user['address']}}">
                    @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="phone" type="text" class="form-control" id="Phone" value="{{ $user['phone']}}">
                    @if($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="email" type="text" class="form-control" id="Email" value="{{ $user['email']}}">
                    <input name="role" type="hidden" class="form-control" value="1">
                    {{-- <input name="password" type="hidden" class="form-control" value="{{ $user->password}}"> --}}
                    @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
              </form><!-- End Profile Edit Form -->

                      </div>

                      {{-- <div class="tab-pane fade show profile-order" id="profile-order">
                        <h5 class="card-title">About</h5>
                        
                        <!-- Cart Page Start -->
                        <div class="container-fluid py-5">
                          <div class="container py-5">
                              <div class="table-responsive">
                                  <table class="table">
                                      <thead>
                                        <tr>
                                          <th scope="col">Products</th>
                                          <th scope="col">Name</th>
                                          <th scope="col">Price</th>
                                          <th scope="col">Quantity</th>
                                          <th scope="col">Total</th>
                                          <th scope="col">Handle</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <th scope="row">
                                                  <div class="d-flex align-items-center">
                                                      <img src="img/vegetable-item-3.png" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                                  </div>
                                              </th>
                                              <td>
                                                  <p class="mb-0 mt-4">Big Banana</p>
                                              </td>
                                              <td>
                                                  <p class="mb-0 mt-4">2.99 $</p>
                                              </td>
                                              <td>
                                                  <div class="input-group quantity mt-4" style="width: 100px;">
                                                      <div class="input-group-btn">
                                                          <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                                          <i class="fa fa-minus"></i>
                                                          </button>
                                                      </div>
                                                      <input type="text" class="form-control form-control-sm text-center border-0" value="1">
                                                      <div class="input-group-btn">
                                                          <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                              <i class="fa fa-plus"></i>
                                                          </button>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td>
                                                  <p class="mb-0 mt-4">2.99 $</p>
                                              </td>
                                              <td>
                                                  <button class="btn btn-md rounded-circle bg-light border mt-4" >
                                                      <i class="fa fa-times text-danger"></i>
                                                  </button>
                                              </td>
                                          
                                          </tr>
                                          <tr>
                                              <th scope="row">
                                                  <div class="d-flex align-items-center">
                                                      <img src="img/vegetable-item-5.jpg" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="" alt="">
                                                  </div>
                                              </th>
                                              <td>
                                                  <p class="mb-0 mt-4">Potatoes</p>
                                              </td>
                                              <td>
                                                  <p class="mb-0 mt-4">2.99 $</p>
                                              </td>
                                              <td>
                                                  <div class="input-group quantity mt-4" style="width: 100px;">
                                                      <div class="input-group-btn">
                                                          <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                                          <i class="fa fa-minus"></i>
                                                          </button>
                                                      </div>
                                                      <input type="text" class="form-control form-control-sm text-center border-0" value="1">
                                                      <div class="input-group-btn">
                                                          <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                              <i class="fa fa-plus"></i>
                                                          </button>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td>
                                                  <p class="mb-0 mt-4">2.99 $</p>
                                              </td>
                                              <td>
                                                  <button class="btn btn-md rounded-circle bg-light border mt-4" >
                                                      <i class="fa fa-times text-danger"></i>
                                                  </button>
                                              </td>
                                          </tr>
                                          <tr>
                                              <th scope="row">
                                                  <div class="d-flex align-items-center">
                                                      <img src="img/vegetable-item-2.jpg" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="" alt="">
                                                  </div>
                                              </th>
                                              <td>
                                                  <p class="mb-0 mt-4">Awesome Brocoli</p>
                                              </td>
                                              <td>
                                                  <p class="mb-0 mt-4">2.99 $</p>
                                              </td>
                                              <td>
                                                  <div class="input-group quantity mt-4" style="width: 100px;">
                                                      <div class="input-group-btn">
                                                          <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                                          <i class="fa fa-minus"></i>
                                                          </button>
                                                      </div>
                                                      <input type="text" class="form-control form-control-sm text-center border-0" value="1">
                                                      <div class="input-group-btn">
                                                          <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                              <i class="fa fa-plus"></i>
                                                          </button>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td>
                                                  <p class="mb-0 mt-4">2.99 $</p>
                                              </td>
                                              <td>
                                                  <button class="btn btn-md rounded-circle bg-light border mt-4" >
                                                      <i class="fa fa-times text-danger"></i>
                                                  </button>
                                              </td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                        </div>
                        <!-- Cart Page End -->
                      </div> --}}

                    </div><!-- End Bordered Tabs -->

                  </div>
                </div>

              </div>
            </div>
          </section>
        </div>
      </div>
@endsection