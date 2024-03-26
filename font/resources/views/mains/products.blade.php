<div class="container-fluid fruite py-5">
    <div class="container py-5">
      <div class="tab-class text-center">
        <div class="row g-4">
          <div class="col-lg-4 text-start">
            <h1>Our Organic Products</h1>
          </div>
          <div class="col-lg-8 text-end">
          </div>
        </div>
        <div class="tab-content  mt-3">
          <div class="tab-pane fade show p-0 active">
            <div class="row g-4">
              <div class="col-lg-12">
                <div class="row g-4">
                  @foreach ($products['data'] as $product)
                  <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                      <div class="fruite-img">
                        <img
                          src="{{ $product['images'][0]['code_image'] }}"
                          class="img-fluid w-100 rounded-top"
                          alt="{{ $product['images'][0]['name']}}"
                        />
                      </div>
                      {{-- <div
                        class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                        style="top: 10px; left: 10px"
                      >
                        Fruits
                      </div>   --}}
                      <div
                        class="p-4 border border-secondary border-top-0 rounded-bottom"
                      >
                        <h4><a href="{{ route('shop_detail',$product['id'])}}">{{ $product['name']}}</a></h4>
                        <p>{!! $product['content'] !!}</p>
                        <div
                          class="d-flex justify-content-between flex-lg-wrap"
                        >
                          <p class="text-dark fs-5 fw-bold mb-0">
                            {{ number_format($product['price'])}} VND 
                          </p>
                          <a
                            href="{{ route('shop_detail',$product['id'])}}"
                            class="btn border border-secondary rounded-pill px-3 text-primary"
                            ><i
                              class="fa fa-shopping-bag me-2 text-primary"
                            ></i>
                            Chi tiết</a
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>