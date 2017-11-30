<div id="edit_number_modal" class="modal fade"
  role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close"
          data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">Edit Number</h4>
      </div>
      <div class="modal-body">
        <div class="container">
          <form name="edit_number_form"
            id="edit_number_form">
            <div class="form-group">
              <label for="edit_service_provider">Service Provider:</label>
              <input type="text" class="form-control" name="service_provider"
                id="edit_service_provider" placeholder="eg. Vodacom">
              <span id="edit_service_provider_error"
                class="text-danger" style="display: none;"></span>
            </div>
            <div class="form-group">
              <label for="edit_phone_number">Phone Number:</label>
              <input type="text" class="form-control" name="phone_number"
                id="edit_phone_number" placeholder="phone number">
              <span id="edit_phone_number_error"
                class="text-danger" style="display: none;"></span>
            </div>
            <div class="form-group">
              <button class="btn btn-default"
                data-dismiss="modal">Cancel</button>
              <button class="btn btn-success"
                type="button" onclick="attemptEditNumber()">Save</button>
              @include('inline_loader')
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
