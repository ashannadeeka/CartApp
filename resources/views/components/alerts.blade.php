@if (session('status'))
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('status') }}
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning">
      <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('warning') }}
    </div>
@endif
@if (session('danger'))
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('danger') }}
    </div>
@endif
