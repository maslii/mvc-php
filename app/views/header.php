<nav class="navbar bg-light mb-5">
    <div class="container">
        <a href="/" class="navbar-brand float-left">Крамниця</a>
        <div class="float-right">
            <span class="align-middle mr-3">
            
                <?php if ($this->viewData['cart']->isEmpty()) { ?>
                    Корзина пуста
                <?php } else { ?>
                    Товарів
                    <span class="badge badge-secondary"
                          style="font-size: 100%;">
                        <?= $this->viewData['cart']->countAll(); ?>
                    </span>
                    на суму
                    <span class="badge badge-secondary"
                          style="font-size: 100%;">
                        <?= $this->viewData['cart']->priceAll(); ?> ₴
                    </span>
                <?php } ?>
                
            </span>

            <div class="btn-group">
                <button class="btn btn-outline-danger" name="btn-cart-del">
                    <i class="material-icons align-middle">delete</i>
                </button>
                <button class="btn btn-success" name="btn-cart-open">
                    <i class="material-icons align-middle">shopping_cart</i>
                </button>
            </div>
        </div>
    </div>
</nav>

<div class="modal" id="modal-cart" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Корзина
                </h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <?php foreach ($this->viewData['cart']->getAll() as $item) { ?>
                        <div class="row mb-3">
                            <div class="col d-flex align-items-center justify-content-between">
                                <h5>
                                    <?= $this->viewData['products']->get($item->getId())->name; ?>
                                </h5>
                                <span class="badge badge-secondary d-block float-right"
                                      style="font-size: 100%;">
                                    <?= ($item->getCount() * $item->getPrice()); ?> ₴
                                </span>
                                <div class="input-group w-25">
                                    <input type="number" class="form-control"
                                           value="<?= $item->getCount(); ?>"
                                           maxlength="3">
                                    <div class="input-group-append">
                                        <button class="btn btn-danger"
                                                name="btn-cart-item-del"
                                                data-product-id="<?= $item->getId(); ?>">
                                            <i class="material-icons align-middle">clear</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer d-flex align-items-center justify-content-between">
                <span class="badge badge-secondary"
                      style="font-size: 100%;">
                        <?= $this->viewData['cart']->priceAll(); ?> ₴
                </span>
                <button type="button" class="btn btn-success float-right">
                    Оформити замовлення
                </button>
            </div>
        </div>
    </div>
</div>

