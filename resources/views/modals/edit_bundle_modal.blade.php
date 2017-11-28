<div id="edit_bundle_modal" class="modal fade"
  role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close"
          data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">Edit Bundle</h4>
      </div>
      <div class="modal-body">
        <div class="container">
          <form name="edit_bundle_form"
            id="edit_bundle_form">
            <div class="form-group">
              <label for="edit_name">Name:</label>
              <input type="text" class="form-control" name="name"
                id="edit_name" placeholder="" readonly>
              <span id="edit_name_error"
                class="text-danger" style="display: none;"></span>
            </div>
            <div class="form-group">
              <label for="edit_duration">Duration:</label>
              <input type="text" class="form-control" name="duration_in_months"
                id="edit_duration" placeholder="" readonly>
              <span id="edit_duration_error"
                class="text-danger" style="display: none;"></span>
            </div>
            <div class="form-group">
              <label for="edit_price">Price:</label>
              <input type="text" class="form-control" name="price"
                id="edit_price" placeholder="">
              <span id="edit_price_error"
                class="text-danger" style="display: none;"></span>
            </div>
            <div class="form-group">
              <button class="btn btn-default"
                data-dismiss="modal">Cancel</button>
              <button class="btn btn-success"
                type="button" onclick="attemptEditBundle()">Save</button>
              @include('inline_loader')
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
