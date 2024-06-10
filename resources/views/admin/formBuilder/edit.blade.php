
<div class="form-group">
<div class="mb-3">
<form action="{{ url('admin/formBuilder/update/') }}" method="post" >
@csrf
@method ('PUT')
  <label for="name" class="form-label">Form Name</label>
  <input type="text" name="name" class="form-control" id="name" >
</div>
<div class="mb-3">
<button type="submit" class="btn btn-primary btn-sm" id="btn-submit">submit update</button>
</div>
</form>
</div>

