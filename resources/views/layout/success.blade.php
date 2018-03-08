<div id="success-alert" class="alert alert-success alert-dismissible admin-alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-check"></i> 成功</h4>
    @if (Session::has('success_message'))
	{{Session::get('success_message')}}
    @endif
</div>
<script type="text/javascript">
	var successMsg = $('#success-alert');
	successMsg.delay(500).fadeIn();
	successMsg.delay(3500).fadeOut();
</script>