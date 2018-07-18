<div id="edit_version_modal" class="modal fade"
  role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Version</h4>
        <button class="close"
          data-dismiss="modal">
          &times;
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <form name="edit_version_form"
            id="edit_version_form">
            <div class="form-group">
              <label for="edit_version_number">Version:</label>
              <input type="text" class="form-control" name="version_number"
                id="edit_version_number" placeholder="version number">
              <span id="edit_version_number_error"
                class="text-danger" style="display: none;"></span>
            </div>
            <div class="form-group">
              <label for="edit_features">Features:</label>
              <textarea name="features" id="edit_features"
                class="form-control" placeholder="features"
                rows="3" style="width: 180px"></textarea>
              <span id="edit_features_error"
                  class="text-danger" style="display: none;"></span>
            </div>
            <div class="form-group">
              <button class="btn btn-default"
                data-dismiss="modal">Cancel</button>
              <button class="btn btn-success"
                type="button" onclick="attemptEditVersion()">Save</button>
              @include('inline_loader')
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
