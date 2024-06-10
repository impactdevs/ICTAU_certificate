
<div class="form-group">
<div class="mb-3">
<form action="{{ url('admin/formBuilder/update/'. $form->id) }}" method="post" >
@csrf
@method ('PUT')
  <label for="name" class="form-label">Form Name</label>
  <input type="text" name="name" class="form-control" id="name" value ="{{ $form-> name}}"  >
</div>
<div class="mb-3">
<button type="submit" class="btn btn-primary btn-sm" id="btn-submit">submit update</button>
</div>
</form>
</div>

