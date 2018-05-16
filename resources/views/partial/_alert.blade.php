<div class="alert alert-{{ Session::get('alert')['type'] }} alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h4><i class="icon fa fa-ban"></i> Alert!</h4>
{{ Session::get('alert')['message'] }}
</div>