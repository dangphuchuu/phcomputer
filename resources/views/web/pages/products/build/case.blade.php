<div class="toolbox elemento_stick">
    <div class="container">
        @if(isset($case))
        @foreach($case->ProductsImage as $img)
        @if($loop ->first)
        <form action="/removeCase" id="case{{$case->id}}" method="post">
            @csrf
            <div class="product-item">
                <div class="product-image">
                    <a href="/detail/{{$case->id}}">
                        <img src="https://res.cloudinary.com/{{env('CLOUD_NAME')}}/image/upload/{{$img->image}}.jpg" alt="Product Image">
                    </a>
                </div>
                <div class="product-details">
                    <a href="/detail/{{$case->id}}">
                        <h2 class="product-title" style="max-width: 530px; overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">{{$case->name}}</h2>
                    </a>
                    <div class="product-actions">
                        <div class="product-price">
                            @if($case->price_new!=0 && $case->price !=0)
                            <span class="new_price">{{number_format($case->price_new,0,",",".")}} Vnđ</span>
                            <span class="old_price">{{number_format($case->price,0,",",".")}} Vnđ</span>

                            @elseif($case->price_new == 0 && $case->price !=0)
                            <span class="new_price">{{number_format($case->price,0,",",".")}} Vnđ</span>

                            @elseif($case->price == 0 && $case->price_new !=0)
                            <span class="new_price">{{number_format($case->price_new,0,",",".")}} Vnđ</span>

                            @else
                            <span class="new_price">{{__("Contact")}}</span>

                            @endif
                        </div>
                        <a href="javascript:void(0)" class="remove-item" onclick="document.getElementById('case{{$case->id}}').submit();"> Xóa</a>
                    </div>
                </div>

                <a href="#" data-bs-toggle="modal" data-bs-target="#case" class="change-item">{{__("Change")}}</a>
            </div>
        </form>
        @endif
        @endforeach
        @else
        <ul class="clearfix">
            <li>
                {{__("Case")}}
            </li>
            <li>
                <a href="#" data-id="2" class="open-modal" data-bs-toggle="modal" data-bs-target="#case">
                    {{__("Select")}}
                </a>
                <!-- The Modal -->

            </li>
        </ul>
        @endif
    </div>
</div>

<div class="modal" id="case">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">{{__("Case")}}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="toolbox elemento_stick">
                    @foreach($allCase as $pro)
                    @foreach($pro->ProductsImage as $img)
                    @if($loop ->first)
                    <div class="mt-1">
                        <form action="/addCase" method="post">
                            @csrf
                            <div class="product-item">
                                <div class="product-image">
                                    <a href="/detail/{{$pro->id}}">
                                        <img src="https://res.cloudinary.com/{{env('CLOUD_NAME')}}/image/upload/{{$img->image}}.jpg" alt="Product Image">
                                    </a>
                                </div>
                                <div class="product-details">
                                    <a href="/detail/{{$pro->id}}">
                                        <h2 class="product-title">{{$pro->name}}</h2>
                                    </a>
                                    <div class="product-actions">
                                        <div class="product-price">
                                            @if($pro->price_new!=0 && $pro->price !=0)
                                            <span class="new_price">{{number_format($pro->price_new,0,",",".")}} Vnđ</span>
                                            <span class="old_price">{{number_format($pro->price,0,",",".")}} Vnđ</span>

                                            @elseif($pro->price_new == 0 && $pro->price !=0)
                                            <span class="new_price">{{number_format($pro->price,0,",",".")}} Vnđ</span>

                                            @elseif($pro->price == 0 && $pro->price_new !=0)
                                            <span class="new_price">{{number_format($pro->price_new,0,",",".")}} Vnđ</span>

                                            @else
                                            <span class="new_price">{{__("Contact")}}</span>

                                            @endif
                                        </div>

                                    </div>
                                </div>
                                <button class="btn_1" type="submit" data-bs-dismiss="modal">
                                    {{__("Add")}}
                                </button>
                                <input type="hidden" name="products_id" value="{{$pro->id}}" />
                            </div>
                        </form>
                    </div>
                    @endif
                    @endforeach
                    @endforeach
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>