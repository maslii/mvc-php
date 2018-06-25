<div class="container mb-5">
    <div class="row">
        
        <?php foreach ($this->viewData['products']->getAll() as $key => $value) { ?>
            
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <?= $value->name ?>
                        </h5>
                    </div>
                    <div class="card-body">
                        <img class="card-img" src="<?= $value->image ?>"
                             alt="<?= $value->name ?>">
                        <div class="card-img-overlay py-5">
                        <span class="badge badge-secondary card-text float-right"
                              style="font-size: 100%;">
                            <?= $value->price ?> ₴
                        </span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="input-group">
                            <input type="number" class="form-control"
                                   name="input-product-add"
                                   maxlength="3" value="1">
                            <div class="input-group-append">
                                <button class="btn btn-success"
                                        name="btn-product-add"
                                        data-product-id="<?= $value->id ?>"
                                        data-product-price="<?= $value->price ?>">
                                    <i class="material-icons align-middle">add</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        <?php } ?>
    
    </div>
</div>

<div class="modal" id="modal-product-add" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h1 class="text-success text-center">
                    Товар додано!
                </h1>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal-error" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h1 class="text-danger text-center">
                    Помилка AJAX!
                </h1>
            </div>
        </div>
    </div>
</div>