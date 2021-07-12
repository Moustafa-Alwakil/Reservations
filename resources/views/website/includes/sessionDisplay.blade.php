<div class="col-12">
    @if(Session()->has('success'))
      <div class="alert alert-success"> {{Session()->get('success')}} </div>
    @elseif(Session()->has('error'))
      <div class="alert alert-danger"> {{Session()->get('error')}} </div>
    @endif
</div>