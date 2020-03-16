<?php $v->layout("softexpertadm/_template"); ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard > Produtos</h1>
</div>


<div class="card">

    <!-- Message -->
    <!-- <div class="row my-2">
        <div class="form_callback">
            <?= flash(); ?>
        </div>
    </div> -->


    <h5 class="card-header bg-dark">
        <button class="btn btn-primary" href="#" data-toggle="modal" data-target="#newProduct">
            <i class="fas fa-plus"></i>
            Novo
        </button>
    </h5>
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover">
            <thead class="bg-success text-white">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Registrado Por</th>
                    <th scope="col">Registrado Em</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>

                <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product->name;?></td>
                    <td>R$ <?= str_price($product->price);?></td>
                    <td><?= $product->type()->name;?></td>
                    <td><?= $product->user()->first_name;?> <?= $product->user()->last_name;?></td>
                    <td><?= $product->created_at;?></td>
                    <td>

                        <button type="button" class="btn btn-outline-primary btn-sm btn-pill" data-toggle="modal"
                            data-toggle="modal" data-target="#viewProduct" title="Visualizar"
                            data-whateverproductid="<?= $product->id;?>"
                            data-whateverproductname="<?= $product->name;?>"
                            data-whateverproductprice="<?= str_price($product->price);?>"
                            data-whateverproductuser="<?= $product->registered_by_id;?>">
                            <i class="fa fa-fw fa-eye"></i>
                        </button>

                        <button type="button" class="btn btn-outline-warning btn-sm btn-pill" title="Editar"
                            data-toggle="modal" data-target="#editProduct" data-whateverproductid="<?= $product->id;?>"
                            data-whateverproductname="<?= $product->name;?>"
                            data-whateverproductprice="<?= str_price($product->price);?>"
                            data-whateverproducttypeid="<?= $product->product_type_id;?>"
                            >
                            <i class="fa fa-fw fa-edit"></i>
                        </button>

                        <button type="button" class="btn btn-outline-danger btn-sm btn-pill" title="Delete"
                            data-delete="<?= $router->route("products.delete"); ?>" data-action="delete"
                            data-confirm="ATENÇÃO: Tem certeza que deseja excluir o Produto?"
                            data-product_id="<?= $product->id; ?>">
                            <i class="fa fa-fw fa-trash"></i>

                        </button>


                    </td>
                <tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <p class="">
                        No momento, não existem Produtos.
                    </p>
                    <?php endif; ?>

            </tbody>
        </table>
    </div>
</div>


<!-- Create Modal-->
<div class="modal fade" id="newProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">

    <!-- Ajax Load -->
    <div class="ajax_load">
        <div class="ajax_load_box">
            <div class="ajax_load_box_circle"></div>
            <div class="ajax_load_box_title">Aguarde, carrengando...</div>
        </div>
    </div>

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-ticket-alt"></i> Novo Produto</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form name="product_store" action="<?= $router->route("products.store"); ?>" method="post"
                autocomplete="off">
                <div class="modal-body">

                    <!-- Error Message -->
                    <div class="row">
                        <div class="form_callback">
                            <?= flash(); ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputName"><b>Nome:</b></label>
                        <input name="name" type="text" class="form-control" id="inputName" aria-describedby="titlelHelp"
                            placeholder="Nome do Produto">
                    </div>
                    <div class="form-group">
                        <label for="inputPrice"><b>Preço:</b></label>
                        <input name="price" type="text" class="form-control" id="inputPrice"
                            placeholder="Preço do Produto (Ex: 10,50)">
                    </div>

                    <div class="form-group">
                        <label for="creatType"><b>Categoria:</b></label>
                        <select class="custom-select" name="product_type" id="creatType">
                            <option selected>Selecione a Categoria</option>

                            <?php if (!empty($productTypes)): ?>
                            <?php foreach ($productTypes as $ptype): ?>
                            <option value="<?= $ptype->id;?>"><?= $ptype->name;?></option>

                            <?php endforeach; ?>
                            <?php else: ?>
                            <option>Não há Categoria Registrada</option>
                            <?php endif; ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-success" type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- EDIT Modal-->
<div class="modal fade" id="editProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">

    <!-- Ajax Load -->
    <div class="ajax_load">
        <div class="ajax_load_box">
            <div class="ajax_load_box_circle"></div>
            <div class="ajax_load_box_title">Aguarde, carrengando...</div>
        </div>
    </div>

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-ticket-alt"></i> Editar Produto</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form name="product_update" action="<?= $router->route("products.update"); ?>" method="post"
                autocomplete="off">
                <div class="modal-body">

                    <!-- Error Message -->
                    <div class="row">
                        <div class="form_callback">
                            <?= flash(); ?>
                        </div>
                    </div>

                    <input type="hidden" name="product_id" id="productId">
                    <div class="form-group">
                        <label for="inputName">Name:</label>
                        <input name="name" type="text" class="form-control" id="inputName" aria-describedby="titlelHelp"
                            placeholder="Nome do Produto">
                        <small id="titlelHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="inputPrice">Preço:</label>
                        <input name="price" type="text" class="form-control" id="inputPrice"
                            placeholder="Preço do Produto">
                    </div>
                    <div class="form-group">
                        <label for="creatType"><b>Categoria:</b></label>
                        <select class="custom-select" name="product_type" id="editType">
                            <option selected>Selecione a Categoria</option>

                            <?php if (!empty($productTypes)): ?>
                            <?php foreach ($productTypes as $ptype): ?>
                            <option value="<?= $ptype->id;?>"><?= $ptype->name;?></option>

                            <?php endforeach; ?>
                            <?php else: ?>
                            <option>Não há Categoria Registrada</option>
                            <?php endif; ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-success" type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalCenterTitle">Visualizar Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <dl class="row">
                    <dt class="col-sm-3">Título:</dt>
                    <dd class="col-sm-9" id="productViewName"></dd>

                    <dt class="col-sm-3">Preço:</dt>
                    <dd class="col-sm-9" id="productViewPrice"></dd>

                    <dt class="col-sm-3">Registrado Por:</dt>
                    <dd class="col-sm-9" id="productViewUser"></dd>
                </dl>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>