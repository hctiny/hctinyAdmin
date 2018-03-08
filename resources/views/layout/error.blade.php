<div id="error-alert" class="alert alert-danger alert-dismissible admin-alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-ban"></i> 错误</h4>
    @if (count($errors) > 0)
    	@foreach ($errors->all() as $error)
			{{$error}}<br />
    	@endforeach
    @endif
</div>
<script type="text/javascript">
	var errMsg = $('#error-alert');
	errMsg.delay(500).fadeIn();
	errMsg.delay(3500).fadeOut();
</script>