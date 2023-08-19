@props(['route' => null , 'cancel' => null, 'files' => false, 'title' => null , 'submit_button' => 'Update',
'cancel_button' => 'Cancel'])
<form class="card" action="{{$route}}" method="POST" {{$files ? 'enctype=multipart/form-data' : null }}>
    @csrf
    @method('patch')
    <div class="card-header pb-0">
        @if ($title)
        <h2 class="card-title mb-0">{{$title}}</h2>
        @endif
        <div class="card-options">
            <a class="card-options-collapse" href="javascript:void(0)" data-bs-toggle="card-collapse">
                <i class="fe fe-chevron-up"></i>
            </a>
            <a class="card-options-remove" href="javascript:void(0)" data-bs-toggle="card-remove">
                <i class="fe fe-x"></i>
            </a>

            @if ($cancel !== null)
            <a href="{{$cancel}}" class="btn btn-square btn-primary pull-right btn-sm">{{$cancel_button}}</a>
            @endif
        </div>
    </div>
    <div class="card-body">
        {{$slot}}
    </div>
    <div class="card-footer text-end">
        <button class="btn btn-primary" type="submit">{{$submit_button}}</button>
    </div>
</form>