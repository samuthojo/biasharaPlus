<div id="add_version_modal" class="modal fade"
  role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Version</h4>
        <button class="close"
          data-dismiss="modal">
          &times;
        </button>
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
              <label>Critical:</label>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" 
                    name="critical" value="1">True
                </label>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" 
                    name="critical" value="0">False
                </label>
              </div>
              <span id="critical_error"
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
