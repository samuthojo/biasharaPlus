<div id="add_pricelist_modal" class="modal fade"
  role="dialog">

  <div class="modal-dialog modal-sm">

    <div class="modal-content">

      <div class="modal-header">
        <button class="close" data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">Add PriceList</h4>
      </div>

      <div class="modal-body">
        <div class="container">

          <form name="add_pricelist_form"
            id="add_pricelist_form">

            <div class="form-group">
              <label for="pricelist_name">Name:</label>
              <input type="text" class="form-control"
                placeholder="pricelist name"
                name="name" id="pricelist_name">
            </div>

            <div class="form-group">
              <label for="effective_date">
                Effective Date:</label>
              <input type="text" class="form-control"
                placeholder="effective date"
                name="effective_date" id="effective_date">
            </div>

            <div class="form-group">
              <label for="pricelist_color">
                Color:</label>
              <input type="text" class="form-control"
                placeholder="pricelist color"
                name="color" id="pricelist_color">
            </div>

            <div class="form-group">
              <button class="btn btn-default"
                data-dismiss="modal">
                Cancel
              </button>
              <button class="btn btn-success"
                type="submit">
                Add
              </button>
            </div>

          </form>

        </div>
     </div>

    </div>

  </div>

</div>
