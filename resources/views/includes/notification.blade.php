@if (session('success-msg'))
    <div class="alert alert-success" id="alert_success">
        <h3 class="text-success"><i class="fa fa-check-circle"></i> Success</h3> {{ session('success-msg') }}
    </div>
@endif

@if (session('error-msg'))
    <div class="alert alert-danger" id="alert_error">
        <h3 class="text-danger"><i class="fa fa-exclamation-triangle"></i> Failed</h3> {{ session('error-msg') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-notif" id="alert_error">
        <button class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="text-danger"><i class="fa fa-exclamation-triangle"></i>Failed</h3>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
