
<?= $this->extend('layouts/admin_main_layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-end flex-row mb-2">
    <button id="btn-add-movie" class="btn btn-primary p-2 pr-3 pl-3"  data-toggle="modal" data-target=".bd-example-modal-lg">Add Movie</button>
</div>

<table class="table table-bordered text-light">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">ID</th>
      <th scope="col">Title</th>
      <th scope="col">Director(s)</th>
      <th scope="col">Genres</th>
      <th scope="col">Rated</th>
      <th scope="col">Price</th>
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
            <h5 class="modal-title" id="exampleModalLongTitle">Add Movie</h5>
            <h2 class="modal-title" id="success-msg"></h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span id="form-exit" aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="d-flex justify-content-center flex-column text-dark">
                    <form id="movie-form" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title">
                                    <small id="_title" class="form-text"></small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <!-- <input type="text" class="form-control" id="description" name="description"> -->
                                    <textarea class="form-control" id="description" cols="5" name="description"></textarea>
                                    <small id="_description" class="form-text"></small>
                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="form-group">
                                    <label for="directors">Director</label>
                                    <input type="text" class="form-control" id="directors" name="directors">
                                    <small id="_directors" class="form-text"></small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="casts">Casts</label>
                                    <input type="text" class="form-control" id="casts" name="casts">
                                    <small id="_casts" class="form-text"></small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="genres">Genres</label>
                                    <input type="text" class="form-control" id="genres" name="genres">
                                    <small id="_genres" class="form-text"></small>
                                </div>
                            </div>


                             <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rated">Rated</label>
                                    <input type="text" class="form-control" id="rated" name="rated">
                                    <small id="_rated" class="form-text"></small>
                                </div>
                            </div>


                             <div class="col-md-12">
                                <div class="form-group">
                                    <label for="poster">Poster</label>
                                    <input type="text" class="form-control" id="poster" name="poster" placeholder="(url)">
                                    <small id="_poster" class="form-text"></small>
                                </div>
                            </div>

                             <div class="col-md-12">
                                <div class="form-group">
                                    <label for="trailer">Trailer</label>
                                    <input type="text" class="form-control" id="trailer" name="trailer" placeholder="(url)">
                                    <small id="_trailer" class="form-text"></small>
                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="form-group">
                                    <label for="length">Length</label>
                                    <input type="text" class="form-control" id="length" name="length">
                                    <small id="_length" class="form-text"></small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" id="price" name="price">
                                    <small id="_price" class="form-text"></small>
                                </div>
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
    <script src="/js/movies.js"></script>
<?= $this->endSection() ?>
