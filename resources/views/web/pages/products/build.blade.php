@extends('web.layout.index')
@section('css')
<link href="web_assets/css/product_page.css" rel="stylesheet">
<link href="web_assets/css/fonts/fontawesome/css/all.css" rel="stylesheet">
<link href="web_assets/css/leave_review.css" rel="stylesheet">
<link href="web_assets/css/listing.css" rel="stylesheet">
@endsection
@section('content')
<style>
    #collapse-A img {
        width: 100%;
    }

    #reviews a {
        color: black;
    }

    #reviews a:hover {
        color: #004dda;
    }

    .modal-backdrop {
        position: relative;
        z-index: 1;
    }

    .product-item {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        /* Đường viền */
        padding: 10px;
        margin-bottom: 10px;
        background-color: #f9f9f9;
        /* Màu nền */
    }

    .product-image {
        width: 100px;
        /* Kích thước ảnh */
        margin-right: 15px;
    }

    .product-image img {
        max-width: 100%;
        height: auto;
    }

    .product-details {
        flex-grow: 1;
    }

    .product-title {
        font-size: 16px;
        margin-bottom: 5px;
    }

    .product-actions {
        display: flex;
        align-items: center;
    }

    .remove-item {
        margin-left: 10px;
        text-decoration: none;
        color: #007bff;
    }

    .product-price {
        text-align: right;
    }

    .change-item {
        text-decoration: none;
        color: #007bff;
        margin-left: 5px;

    }
</style>
<main>
    <div class="container margin_30">
        <div class="row">
            <div class="col-md-8">
                <div class="all">
                    <div class="slider">
                        <div class="container">
                            <h2>{{__("Build PC")}}</h2>
                            <h5>
                                <form action="/removeAllSession" id="removeAllSession" method="post">
                                    @csrf
                                    <a href="javascript:void(0)" class="remove-item" onclick="document.getElementById('removeAllSession').submit();">Chọn lại</a>
                                </form>
                            </h5>
                            @include('web/pages/products/build/cpu')
                            <br>
                            @include('web/pages/products/build/mainboard')
                            <br>
                            @include('web/pages/products/build/ram')
                            <br>
                            @include('web/pages/products/build/vga')
                            <br>
                            @include('web/pages/products/build/psu')
                            <br>
                            @include('web/pages/products/build/ssd')
                            <br>
                            @include('web/pages/products/build/hdd')
                            <br>
                            @include('web/pages/products/build/case')
                            <br>
                            @include('web/pages/products/build/fancase')
                            <br>
                            @include('web/pages/products/build/screen')
                            <br>
                            @include('web/pages/products/build/mouse')
                            <br>
                            @include('web/pages/products/build/keyboard')
                            <br>
                            @include('web/pages/products/build/headphone')
                            <br>
                            @include('web/pages/products/build/software')
                            <br>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="/">{{__("Home")}}</a></li>
                        <li><a href="/build">{{__("Build")}}</a></li>
                    </ul>
                </div>
                <!-- /page_header -->
                <form action="" method="post">
                    @csrf
                    <div class="prod_info">
                        <h1>{{__("Total")}}</h1>
                        <h3 style="color:#ff0000;margin-top: 5px;">

                            <?php
                            function getPrice($item)
                            {
                                if ($item != null) {
                                    if ($item->price_new != 0 && $item->price == 0) {
                                        return $item->price_new;
                                    } else if ($item->price != 0 && $item->price_new == 0) {
                                        return $item->price;
                                    } else if ($item->price_new != 0 && $item->price != 0) {
                                        return $item->price_new;
                                    } else {
                                        return 0;
                                    }
                                } else {
                                    return 0;
                                }
                            }
                            $vga = getPrice($vga);
                            $cpu = getPrice($cpu);
                            $ram = getPrice($ram);
                            $ssd = getPrice($ssd);
                            $hdd = getPrice($hdd);
                            $psu = getPrice($psu);
                            $mainboard = getPrice($mainboard);
                            $case = getPrice($case);
                            $fancase = getPrice($fancase);
                            $screen = getPrice($screen);
                            $keyboard = getPrice($keyboard);
                            $mouse = getPrice($mouse);
                            $software = getPrice($software);
                            $headphone = getPrice($headphone);



                            $sum = $cpu + $mainboard + $vga + $ram + $ssd + $hdd + $psu + $case + $fancase + $screen + $keyboard + $mouse + $software + $headphone;
                            ?>
                            {{number_format($sum,0,',','.')}}<sup style="text-decoration: underline; padding: 3px; text-transform: lowercase !important;">đ</sup>
                        </h3>
                    </div>
                </form>
                <!-- /product_actions -->
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->

</main>
@endsection
@section('scripts')
<script src="web_assets/js/carousel_with_thumbs.js"></script>
<script>
    $('.wishlistDetail').click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var user_id = "{{Auth::id()}}"
        var product_id = $(this).data('productid');
        $.ajax({
            type: 'POST',
            url: '/wishlist',
            data: {
                product_id: product_id,
                user_id: user_id
            },
            success: function(data) {
                if (data.action == 'add') {
                    totalWishlist();
                    $('a[data-productid=' + product_id + ']').html('<i class="fa-solid fa-heart" style="color:red"></i>').append(`<span>{{__('Add to favorites')}}</span>`);
                } else if (data.action == 'delete') {
                    totalWishlist();
                    $('a[data-productid=' + product_id + ']').html('<i class="fa-regular fa-heart"></i>').append(`<span>{{__('Add to favorites')}}</span>`);

                }
            }
        })
    });
</script>
@endsection