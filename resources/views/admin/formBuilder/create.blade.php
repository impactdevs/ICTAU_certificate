

<div class="form-group">
  <div class="mb-3">
    <form action="{{ url('admin/formBuilder') }}" method="post" >
    @csrf
      <label for="name" class="form-label">Form Name</label>
      <input type="text" name="name" class="form-control" id="name" placeholder="enter form name">
    </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-primary btn-sm" id="btn-submit">submit</button>
      </div>
    </form>
  </div>
</div>
