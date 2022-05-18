<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <title>@yield('title')</title>
</head>
<body>

    @include('admin.layouts.header')
  
    <main class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <aside>
                        @section('sidebar')
                            @include('admin.layouts.sidebar')
                        @show
                    </aside>
                </div>
                <div class="col-10">
                    <div class="content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
       
    </main>

    @include('admin.layouts.footer')
    

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script type="text/javascript">
    $(document).ready(function() {
    $('.category_status_btn').click(function(){
            var status = $(this).data('status');
            var id = $(this).data('id');
            alert(status,id);
            // var alert = 'Thay đổi status thành công';
            $.ajax({
                url:"{{url('/chang-status-ajax')}}",
                method:"POST",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    status:status,
                    id:id
                },
                success:function(data){
                    location.reload();
                   // $('#notify_comment').html('<span class="text text-alert">'+alert+'</span>');
                }
            });
        });
    });
    </script>
</body>
</html>