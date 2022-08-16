
<?= $this->extend('layouts/admin_main_layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-end flex-row mb-2">
    <button id="btn-add-cinema" class="btn btn-primary p-2 pr-3 pl-3"  data-toggle="modal" data-target=".bd-example-modal-lg">Add Cinema</button>
</div>

<table class="table table-bordered text-light">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">ID</th>
      <th scope="col">Cinema</th>
      <th scope="col">Date Added</th>
    </tr>
  </thead>
  <tbody>

  </tbody>
</table>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Cinema</h5>
            <h2 class="modal-title" id="success-msg"></h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span id="form-exit" aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="d-flex justify-content-center flex-column text-dark">

                    <form id="cinema-form" method="POST">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="cinemaName">Cinema Name</label>
                                    <input type="text" class="form-control" id="cinemaName" name="cinema_name">
                                    <small id="_cinemaName" class="form-text"></small>
                                </div>
                            </div>


                        <div class="col-12 d-flex justify-content-end">      
                            <button id="submit-btn" type="submit" class="btn btn-primary mr-3 pr-5 pl-5 pt-2 pb-2">Add</button>
                            <button id="btn-cancel" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>       
                        </div> 

                    </form>

                </div>   
        </div>
        <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button id="add" type="button" class="btn btn-primary mr-3 pr-5 pl-5 pt-2 pb-2">Add</button>
        </div> -->
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js_app') ?>
    <script src="/js/cinemas.js"></script>
<?= $this->endSection() ?>
