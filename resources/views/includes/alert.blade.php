@if(session('error') || session('warning') || session('info') || session('success'))
<div class="col-sm-12 col-xl-12">
    <div class="card">
        <div class="card-body dismiss-text">
            @if(session('error'))
            <div class="alert alert-danger inverse alert-dismissible fade show" role="alert">
                <i class="icon-thumb-down"></i>
                <p>{!! session('error') !!}</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close">
                    <span class="bg-danger" aria-hidden="true">dismiss</span>
                </button>
            </div>
            @endif

            @if(session('warning'))
            <div class="alert alert-warning inverse alert-dismissible fade show" role="alert">
                <i class="icon-bell"></i>
                <p>{!! session('warning') !!}</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close">
                    <span class="bg-warning" aria-hidden="true">dismiss</span>
                </button>
            </div>
            @endif

            @if(session('info'))
            <div class="alert alert-info inverse alert-dismissible fade show" role="alert">
                <i class="icon-help-alt"></i>
                <p>{!! session('info') !!}</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close">
                    <span class="bg-info" aria-hidden="true">dismiss</span>
                </button>
            </div>
            @endif

                @if(session('success'))
                <div class="alert alert-success inverse alert-dismissible fade show" role="alert">
                    <i class="icon-thumb-up alert-center"></i>
                    <p><b> Well done! </b>{!! session('success') !!}</p>
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close">
                        <span class="bg-success" aria-hidden="true">dismiss</span>
                    </button>
                </div>
                @endif
            </div>
            @endif

            @if(session('warning'))
            <div class="alert alert-warning inverse alert-dismissible fade show" role="alert">
                <i class="icon-bell"></i>
                <p>{!! session('warning') !!}</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close">
                    <span class="bg-warning" aria-hidden="true">dismiss</span>
                </button>
            </div>
            @endif

            @if(session('info'))
            <div class="alert alert-info inverse alert-dismissible fade show" role="alert">
                <i class="icon-help-alt"></i>
                <p>{!! session('info') !!}</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close">
                    <span class="bg-info" aria-hidden="true">dismiss</span>
                </button>
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success inverse alert-dismissible fade show" role="alert">
                <i class="icon-thumb-up alert-center"></i>
                <p><b> Well done! </b>{!! session('success') !!}</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close">
                    <span class="bg-success" aria-hidden="true">dismiss</span>
                </button>
            </div>
            @endif
        </div>
    </div>
</div>
@endif
