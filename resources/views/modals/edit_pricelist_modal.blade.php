<div id="edit_pricelist_modal" class="modal fade"
  role="dialog">

  <div class="modal-dialog modal-sm">

    <div class="modal-content">

      <div class="modal-header">
        <button class="close" data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">Edit PriceList</h4>
      </div>

      <div class="modal-body">
        <div class="container">

          <form name="edit_pricelist_form"
            id="edit_pricelist_form">

            <div class="form-group">
              <label for="edit_pricelist_name">Name:</label>
              <input type="text" class="form-control"
                placeholder="pricelist name"
                name="name" id="edit_pricelist_name">
            </div>

            <div class="form-group">
              <label for="edit_effective_date">
                Effective Date:</label>
              <input type="text" class="form-control"
                placeholder="effective date"
                name="effective_date" id="edit_effective_date">
            </div>

            <div class="form-group">
              <label for="edit_pricelist_color">
                Color:</label>
              <input type="text" class="form-control"
                placeholder="pricelist color"
                name="color" id="edit_pricelist_color">
            </div>

            <div class="form-group">
              <button class="btn btn-default"
                data-dismiss="modal">
                Cancel
              </button>
              <button class="btn btn-success"
                type="submit">
                Save
              </button>
            </div>

          </form>

        </div>
     </div>

    </div>

  </div>

</div>
