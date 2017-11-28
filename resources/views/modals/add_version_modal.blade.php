<div id="add_version_modal" class="modal fade"
  role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close"
          data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">Add Version</h4>
      </div>
      <div class="modal-body">
        <div class="container">
          <form name="add_version_form"
            id="add_version_form">
            <div class="form-group">
              <label for="version_number">Version:</label>
              <input type="text" class="form-control" name="version_number"
                id="version_number" placeholder="version number">
              <span id="version_number_error"
                class="text-danger" style="display: none;"></span>
            </div>
            <div class="form-group">
              <label for="features">Features:</label>
              <textarea name="features" id="features"
                class="form-control" placeholder="features"
                rows="3" style="width: 180px"></textarea>
              <span id="features_error"
                  class="text-danger" style="display: none;"></span>
            </div>
            <div class="form-group">
              <button class="btn btn-default"
                data-dismiss="modal">Cancel</button>
              <button class="btn btn-success"
                type="button" onclick="addVersion()">Add</button>
              @include('inline_loader')
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
