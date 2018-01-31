<script>
    $(function() {
        $('#flash').delay(500).fadeIn('normal', function() {
            $(this).delay(1500).fadeOut();
        });
    });
</script>
@if(count($errors))
<div class='form-group' id = 'flash'>
  <div class = 'alert alert-danger'>
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
</div>
@endif
