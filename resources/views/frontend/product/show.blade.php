<!-- use layout extension -->
@extends('frontend.main')

@section('content')
    @if (isset($message))
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @endif
    @if (isset($dangerMessage))
        <div class="alert alert-danger" role="alert">
            {{ $dangerMessage }}
        </div>
    @endif
    @if (isset($successMessage))
        <div class="alert alert-success" role="alert">
            {{ $successMessage }}
        </div>
    @endif

    <!-- ========================= SECTION CONTENT ========================= -->
    <section class="section-content">
        <div class="container">
            <header class="section-heading">
                <h3 class="section-title">Popular products</h3>
            </header><!-- sect-heading -->
            <hr>
            <div class="row">
                @if (isset($product))
                    <div class="col-md-3">
                        <div href="#" class="card card-product-grid">
                            <a href="#" class="img-wrap"> <img src="{{ Asset($product->image_path) }}"
                                    alt="{{ $product->name }}"> </a>
                            <figcaption class="info-wrap">
                                <div>
                                    @if ($product->active)
                                        <span class="text-success glyphicon glyphicon-ok">Active</span>
                                    @else
                                        <span class="text-danger glyphicon glyphicon-remove">Inactive</span>
                                    @endif
                                </div>
                                <a href="#" class="title">{{ $product->name }}</a>

                                <div class="rating-wrap">
                                    <ul class="rating-stars">
                                        <li style="width:80%" class="stars-active">
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                class="fa fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                class="fa fa-star"></i>
                                        </li>
                                    </ul>
                                    <span class="label-rating text-muted"> 34 reviws</span>
                                </div>
                                <div class="price mt-1">${{ number_format($product->price) }}.00</div>
                                <!-- price-wrap.// -->
                            </figcaption>
                        </div>
                    </div> <!-- col.// -->
                @endif
            </div> <!-- row.// -->
            <hr>
        </div> <!-- container .//  -->
    </section>
    <!-- ========================= SECTION CONTENT END// ========================= -->
    <!-- ========================= SECTION  ========================= -->
    <section class="section-name bg padding-y-sm">
        <div class="container">
            <header class="section-heading">
                <h3 class="section-title">Our Brands</h3>
            </header><!-- sect-heading -->
            <div class="row">
                <div class="col-md-2 col-6">
                    <figure class="box item-logo">
                        <a href="#"><img src="/assets/images/logos/logo1.png"></a>
                        <figcaption class="border-top pt-2">36 Products</figcaption>
                    </figure> <!-- item-logo.// -->
                </div> <!-- col.// -->
                <div class="col-md-2  col-6">
                    <figure class="box item-logo">
                        <a href="#"><img src="/assets/images/logos/logo2.png"></a>
                        <figcaption class="border-top pt-2">980 Products</figcaption>
                    </figure> <!-- item-logo.// -->
                </div> <!-- col.// -->
                <div class="col-md-2  col-6">
                    <figure class="box item-logo">
                        <a href="#"><img src="/assets/images/logos/logo3.png"></a>
                        <figcaption class="border-top pt-2">25 Products</figcaption>
                    </figure> <!-- item-logo.// -->
                </div> <!-- col.// -->
                <div class="col-md-2  col-6">
                    <figure class="box item-logo">
                        <a href="#"><img src="/assets/images/logos/logo4.png"></a>
                        <figcaption class="border-top pt-2">72 Products</figcaption>
                    </figure> <!-- item-logo.// -->
                </div> <!-- col.// -->
                <div class="col-md-2  col-6">
                    <figure class="box item-logo">
                        <a href="#"><img src="/assets/images/logos/logo5.png"></a>
                        <figcaption class="border-top pt-2">41 Products</figcaption>
                    </figure> <!-- item-logo.// -->
                </div> <!-- col.// -->
                <div class="col-md-2  col-6">
                    <figure class="box item-logo">
                        <a href="#"><img src="/assets/images/logos/logo2.png"></a>
                        <figcaption class="border-top pt-2">12 Products</figcaption>
                    </figure> <!-- item-logo.// -->
                </div> <!-- col.// -->
            </div> <!-- row.// -->
        </div><!-- container // -->
    </section>
    <!-- ========================= SECTION  END// ========================= -->
    <!-- ========================= SECTION  ========================= -->
    <section class="section-name padding-y">
        <div class="container">
            <h3 class="mb-3">Download app demo text</h3>
            <a href="#"><img src="/assets/images/misc/appstore.png" height="40"></a>
            <a href="#"><img src="/assets/images/misc/appstore.png" height="40"></a>
        </div><!-- container // -->
    </section>
    <!-- ========================= SECTION  END// ======================= -->
@endsection
