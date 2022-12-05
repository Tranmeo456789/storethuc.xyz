@if (Session::has('app_notify'))
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ntg-notify">
                <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>{{ session('app_notify') }}</strong>
                </div>
            </div>
        </div>
    </div>
    @php Session::forget('app_notify');    @endphp
@endif
@if (Session::has('app_notify_error'))
    <div class="col-md-12 col-sm-12 col-xs-12 my-notify">
        <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>{{ session('app_notify_error') }}</strong>
        </div>
    </div>
    @php Session::forget('app_notify_error');    @endphp
@endif