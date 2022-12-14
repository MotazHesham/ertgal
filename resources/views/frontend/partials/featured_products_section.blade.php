<section class="mb-4">
    <div class="container">
        <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
            <div class="section-title-1 clearfix">
                <h3 class="heading-5 strong-700 mb-0 float-left">
                    <span class="mr-4">{{__('Featured Products')}}</span>
                </h3>
            </div>
            <div class="caorusel-box arrow-round gutters-5">
                <div class="slick-carousel" data-slick-items="6" data-slick-xl-items="5" data-slick-lg-items="4"  data-slick-md-items="3" data-slick-sm-items="2" data-slick-xs-items="2">
                    @foreach (filter_products(\App\Models\Product::where('published', 1)->where('featured', '1'))->orderBy('updated_at','desc')->limit(12)->get() as $key => $product)
                    <div class="caorusel-card">
                        <div class="product-card-2 card card-product shop-cards shop-tech">
                            <div class="card-body p-0">

                                <div class="card-image">
                                    <a href="{{ route('product', $product->slug) }}" class="d-block">
                                        <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($product->featured_img) }}" alt="{{ __($product->name) }}">
                                    </a>
                                </div>
                                <div class="p-md-3 p-2 text-center">
                                    <div class="price-box">
                                        @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                            <del class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                                        @endif
                                        <span class="product-price strong-600">{{ home_discounted_base_price($product->id) }}</span>
                                    </div>
                                    <div class="star-rating star-rating-sm mt-1">
                                        {{ renderStarRating($product->rating) }}
                                    </div>
                                    <h2 class="product-title p-0 text-truncate-2">
                                        <a href="{{ route('product', $product->slug) }}">{{ __($product->name) }}</a>
                                    </h2>
                                    @auth 
                                        @if(auth()->user()->user_type == 'seller')
                                            <p class="price-box">
                                                <div style=" background-color: #348282; color: white; border-radius: 17px;">
                                                    <b class="product-price strong-600">{{single_price($product->unit_price - $product->purchase_price)}} </b>
                                                ???????? ??????????
                                                </div> 
                                            </p>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
