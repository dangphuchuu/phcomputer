@extends('admin/layout/index')
@section('info')
active
@endsection
@section('css')
<link rel="stylesheet" href="admin_assets/vendors/simple-datatables/style.css">
@endsection
@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{__("Banners Collection")}}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin">{{__("Dashboard")}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__("Banners Collection")}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
            <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal" data-bs-target="#bannersfeatured_create">
            {{__("Create")}}
            </button>
            @include('admin/pages/bannersfeatured/create')
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>{{__("Name")}}</th>
                            <th>{{__("Image")}}</th>
                            <th>{{__("Link")}}</th>
                            <th>{{__("Status")}}</th>
                            <th>{{__("Operations")}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bannersfeatured as $key => $bannerfeatured)
                        <tr>
                            <td class="text-center">{{$key+1}}</td>
                            <td class="text-center">{{$bannerfeatured->name}}</td>
                            <td class="text-center">
                                @if($bannerfeatured->image == NULL)
                                    <img style="width: 300px">
                                @else
                                    @if(strstr($bannerfeatured->image,"https") == "")
                                        <img style="width: 300px" src="https://res.cloudinary.com/{{env('CLOUD_NAME')}}/image/upload/{{ $bannerfeatured->image }}.jpg" >
                                    @elseif(strstr($bannerfeatured->image,"https") != "")
                                        <img style="width: 300px" src="{{ $bannerfeatured->image }}" >
                                    @endif
                                @endif
                            </td>
                            <td class="text-center">{{$bannerfeatured->link}}</td>
                            <td id="status{{$bannerfeatured->id}}">
                                @if($bannerfeatured->status == 1)
                                <a href="javascript:void(0)" onclick="status({{$bannerfeatured->id}},0)"><span class="badge bg-success">Active</span></a>
                                @else
                                <a href="javascript:void(0)" onclick="status({{$bannerfeatured->id}},1)"><span class="badge bg-danger">Inactive</span></a>
                                @endif
                            </td>
                            <td class="text-center">
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#bannersfeatured_edit{{$bannerfeatured->id}}">
                                <i data-feather="edit"></i>
                             </a>
                             <a href="admin/bannersfeatured/delete/{{$bannerfeatured->id}}" onclick="return confirm(`{{__('Are you sure you want to delete this ?')}}`)">
                                    <i data-feather="trash-2"></i>
                             </a> 
                            </td>
                            @include('admin/pages/bannersfeatured/edit')

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection
@section('scripts')
<script src="admin_assets/vendors/simple-datatables/simple-datatables.js"></script>
<script src="admin_assets/js/vendors.js"></script>
<script>
    function status(status_id, active) {
        if (active === 1) {
            $("#status" + status_id).html(' <a href="javascript:void(0)" onclick="status(' + status_id + ',0)">\
                <span class="badge bg-success">Active</span>\
            </a>')
        } else {
            $("#status" + status_id).html(' <a href="javascript:void(0)" onclick="status(' + status_id + ',1)">\
                <span class="badge bg-danger">Inactive</span>\
            </a>')
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/admin/bannersfeatured/status",
            type: 'GET',
            dataType: 'json',
            data: {
                'active': active,
                'status_id': status_id
            },
            success: function(data) {
                if (data['success']) {
                    // alert(data.success);
                } else if (data['error']) {
                    alert(data.error);
                }
            }
        });
    }
</script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.file-uploader .img_bannersfeatured').attr('src', e.target.result).removeClass('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".image-bannersfeatured").change(function() {
        readURL(this);
    });
</script>
@endsection