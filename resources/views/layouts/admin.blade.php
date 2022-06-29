<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/solid.min.css">
    <link rel="stylesheet" href="{{asset('css/adminstyle.css') }}">
    <script src="https://cdn.tiny.cloud/1/cilgdefwwpjwph4t9r56jwn4kf0yp1sqhhl0l0sf7z400bng/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        var editor_config = {
        path_absolute : "http://localhost/unitop/back-end/Laravel/project/unimart/",
        selector: '#mytextarea',
        height: 500,
        relative_urls: false,
        plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table directionality",
        "emoticons template paste textpattern"
        ],
        toolbar: "insertfile undo redo | fontsizeselect fontselect styleselect  |   lineheight | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | forecolor backcolor emoticons",
        file_picker_callback : function(callback, value, meta) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
        if (meta.filetype == 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.openUrl({
            url : cmsURL,
            title : 'Filemanager',
            width : x * 0.8,
            height : y * 0.8,
            resizable : "yes",
            close_previous : "no",
            onMessage: (api, message) => {
            callback(message.content);
        }
      });
    }
  };

  tinymce.init(editor_config);
    </script>
    <script>
        var editor_config = {
        path_absolute : "http://localhost/unitop/back-end/Laravel/project/unimart/",
        selector: '#describe',
        height: 250,
        relative_urls: false,
        plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table directionality",
        "emoticons template paste textpattern"
        ],
        toolbar: "insertfile undo redo | fontsizeselect fontselect styleselect  |   lineheight | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | forecolor backcolor emoticons",
        file_picker_callback : function(callback, value, meta) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
        if (meta.filetype == 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.openUrl({
            url : cmsURL,
            title : 'Filemanager',
            width : x * 0.8,
            height : y * 0.8,
            resizable : "yes",
            close_previous : "no",
            onMessage: (api, message) => {
            callback(message.content);
        }
      });
    }
  };

  tinymce.init(editor_config);
    </script>
    <title>Admintrator</title>
</head>
<body>
    <div id="warpper" class="nav-fixed">
        <nav class="topnav shadow navbar-light bg-white d-flex">
            <div class="navbar-brand"><a href="?">UNITOP ADMIN</a></div>
            <div class="nav-right ">
                <div class="btn-group mr-auto">
                    <button type="button" class="btn dropdown" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="plus-icon fas fa-plus-circle"></i>
                    </button>
                    <div class="dropdown-menu">
                        
                            <a class="dropdown-item" href="{{url('admin/post/add')}}">Thêm bài viết</a>
                      
                        
                            <a class="dropdown-item" href="{{url('admin/product/add')}}">Thêm sản phẩm</a>
                      
                       
                            <a class="dropdown-item" href="{{url('admin/order/list')}}">Xem đơn hàng</a>
                                 
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Tài khoản</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        <!-- end nav  -->
        @php
            $module_active=session('module_active');
        @endphp
        <div id="page-body" class="d-flex">
            <div id="sidebar" class="bg-white">
                <ul id="sidebar-menu">
                    <li class="nav-link {{$module_active=='dashboard'?'active':''}}">
                        <a href="{{url('dashboard')}}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Dashboard
                        </a>
                    </li>

                   
                        <li class="nav-link {{$module_active=='page'?'active':''}}">
                            <a href="{{url('admin/page/list')}}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"></i>
                                </div>
                                Trang
                            </a>
                            <i class="arrow fas {{$module_active=='page'?'fa-angle-down':'fa-angle-right'}}"></i>

                            <ul class="sub-menu">
                                <li><a href="{{url('admin/page/add')}}">Thêm mới</a></li>
                                <li><a href="{{url('admin/page/list')}}">Danh sách</a></li>
                            </ul>
                        </li>
                   
                    
                   
                        <li class="nav-link {{$module_active=='post'?'active':''}}">
                            <a href="{{url('admin/post/list')}}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"></i>
                                </div>
                                Bài viết
                            </a>
                            <i class="arrow fas {{$module_active=='post'?'fa-angle-down':'fa-angle-right'}}"></i>
                            <ul class="sub-menu">
                                <li><a href="{{url('admin/post/add')}}">Thêm mới</a></li>
                                <li><a href="{{url('admin/post/list')}}">Danh sách</a></li>
                                <li><a href="{{url('admin/post/cat')}}">Danh mục</a></li>
                            </ul>
                        </li>
                   
                    
                    
                        <li class="nav-link {{$module_active=='product'?'active':''}}">
                            <a href="{{url('admin/product/list')}}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"></i>
                                </div>
                                Sản phẩm
                            </a>
                            <i class="arrow fas {{$module_active=='product'?'fa-angle-down':'fa-angle-right'}}"></i>
                            <ul class="sub-menu">
                                <li><a href="{{url('admin/product/add')}}">Thêm mới</a></li>
                                <li><a href="{{url('admin/product/list')}}">Danh sách sản phẩm</a></li>
                                <li><a href="{{url('admin/product/cat')}}">Danh mục</a></li>
                                <li><a href="{{url('admin/product/list_color')}}">Danh sách màu</a></li>
                            </ul>
                        </li>
                  
                    
                    
                        <li class="nav-link {{$module_active=='order'?'active':''}}">
                            <a href="{{url('admin/order/list')}}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"></i>
                                </div>
                                Bán hàng
                            </a>
                            <i class="arrow fas {{$module_active=='order'?'fa-angle-down':'fa-angle-right'}}"></i>
                            <ul class="sub-menu">
                                <li><a href="{{url('admin/order/list')}}">Đơn hàng</a></li>
                            </ul>
                        </li>
                        <li class="nav-link {{$module_active=='user'?'active':''}}">
                            <a href="{{url('admin/user/list')}}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"></i>
                                </div>
                                Users
                            </a>
                            <i class="arrow fas {{$module_active=='user'?'fa-angle-down':'fa-angle-right'}}"></i>

                            <ul class="sub-menu">
                                <li><a href="{{url('admin/user/add')}}">Thêm mới</a></li>
                                <li><a href="{{url('admin/user/list')}}">Danh sách</a></li>
                            </ul>
                        </li>
                   
                        <li class="nav-link {{$module_active=='role'?'active':''}}">
                            <a href="{{url('admin/role/list')}}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"></i>
                                </div>
                                Quản lý quyền
                            </a>
                            <i class="arrow fas {{$module_active=='role'?'fa-angle-down':'fa-angle-right'}}"></i>

                            <ul class="sub-menu">
                                <li><a href="{{url('admin/role/list')}}" style="font-size: 15px">Danh sách nhóm quyền</a></li>
                            </ul>
                        </li>


                    <li class="nav-link {{$module_active=='slider'?'active':''}}">
                        <a href="{{url('admin/slider/list')}}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Slider
                        </a>
                    </li>
                </ul>
            </div>
            <div id="wp-content">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script>       
        $(document).ready(function(){            
            $("#keyword").on('keyup', function(){
                
                var keyword=$(this).val();
                
                if(keyword.length > 0){
                    console.log(keyword);
                    $.ajax({
                        //type: 'method',
                        url: "{{url('admin/page/search')}}",
                        data: {
                            keyword: keyword
                        },
                        dataType: 'json',
                        beforeSend:function(){
                            $("#search-result").html("<li style='list-style:none'>loading...</li>");
                        },
                        success: function (res) {   
                            var _html='';
                            $.each(res.data, function(index, data){
                                _html+="<li style='list-style:none'>"+data.title+"</li>";
                            });
                            $("#search-result").html( _html);
                        },
                    });
                }  
            });
        }); 
    </script>
    <script>
       // change color
        $(document).ready(function(){  
            $('.choose').on('change',function(){ 
                var cat_id = $(this).val();
                var _token = $('input[name="_token"]').val();               
                $.ajax({
                        url: "{{url('admin/product/selectCat')}}",
                        method: "POST",
                        data: {cat_id:cat_id,_token:_token},      
                        dataType: 'html',            
                        success: function (data) {     
                            $("#product-cat-child").html(data);
                        },
                    });
            }); 
            $('#colorpicker').on('change',function(){ 
                //alert(this.value);
                $('#hexcolor').val(this.value);
                
            });
            $('.checkbox_wp').on('click',function(){ 
                $(this).parents('.role_detail').find('.checkbox_child').prop('checked',$(this).prop('checked'));
            });
            $('.checkall_role').on('click',function(){ 
                //alert('op');
                $(this).parents('.card').find('.checkbox_child').prop('checked',$(this).prop('checked'));
                $(this).parents('.card').find('.checkbox_wp').prop('checked',$(this).prop('checked'));
            });
            
               
        });
        show_upload_image=function(){
            var upload_image=document.getElementById("file-slider")
            if(upload_image.files && upload_image.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#image-slider').attr('src', e.target.result)
                };
                reader.readAsDataURL(upload_image.files[0]);
            }
        }
    </script>
    
    {{-- <script>
        $(document).ready(function(){  

            $('#color-current').click(function(){  
                $('#select-color').stop().fadeToggle();                
            }); 

            $('.color-selected').click(function(){ 
                $('.color-selected').removeClass('active-color');              
                $(this).addClass('active-color');  
                $('#color-current').text('');             
                 var color = $(this).css('background-color');
                    //alert(color);
                    $('#color-current').css('background-color', color);
                    $('#color-current').attr('value', color);               
            });  
                
        });
    </script> --}}
    {{-- <script>
        $(document).ready(function(){     
       $('#colorpicker').on('change', function() { 
        hexcolor = $('#hexcolor');
       hexcolor.html(color);
           alert('ok');
           hexcolor.html(this.value); 
        });
     });
    </script> --}}
</body>

</html>
