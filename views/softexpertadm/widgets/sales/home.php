<?php $v->layout("softexpertadm/_template"); ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard > Vendas</h1>
</div>


<div class="card">

    <!-- Message -->
    <!-- <div class="row my-2">
        <div class="form_callback">
            <?= flash(); ?>
        </div>
    </div> -->


    <h5 class="card-header bg-secondary">
        <button class="btn btn-primary" data-toggle="modal" data-target="#newSale">
            <i class="fas fa-plus"></i>
            Nova Venda
        </button>


        <span class="btn bg-danger text-white float-right">
        Impostos Totais <i class="fas fa-percent"></i> <span class="badge badge-light">R$ <?= str_price($saleTaxeTotal) ;?></span>
        </span>

        <span class="btn bg-info text-white float-right mx-2">
        Vendas Totais <i class="fas fa-search-dollar"></i> <span class="badge badge-light">R$ <?= str_price($saleValueTotal) ;?></span>
        </span>

    </h5>
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover table-sm">
            <thead class="bg-success text-white">
                <tr>
                    <th scope="col">Produto</th>
                    <th scope="col">Valor Unitário</th>
                    <th scope="col">Imposto Unitário</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Total Parcial</th>
                    <th scope="col">Imposto Total</th>
                    <th scope="col">Total</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>

                <?php if (!empty($sales)): ?>
                <?php foreach ($sales as $sale): ?>
                <tr>
                    <td><?= $productName = $sale->product()->name;?></td>
                    <td>R$ <?= $priceProduct = str_price($sale->product()->price);?></td>
                    <td>
                        <ul>
                            <li><?= $taxeName = $sale->product()->type()->taxe()->name;?></li>
                            <ul>
                                <li><?= $taxePer = str_percentage($sale->product()->type()->taxe()->percentage). "%";?>
                                </li>
                                <li>R$
                                    <?= $taxePrice = str_price($sale->product()->price * percentage_sub($sale->product()->type()->taxe()->percentage));?>
                                </li>
                            </ul>
                        </ul>

                    </td>
                    <td><?= $sale->amount;?></td>
                    <td>R$ <?= str_price($totalPartial = $sale->amount * $sale->product()->price);?></td>
                    <td>
                        <ul>
                            <li><?= $sale->product()->type()->taxe()->name;?></li>
                            <ul>
                                <li><?= str_percentage($sale->product()->type()->taxe()->percentage). "%";?></li>
                                <li>R$
                                    <?= $taxeTotal = str_price($total = ($totalPartial * percentage_sub($sale->product()->type()->taxe()->percentage)));?>
                                </li>
                            </ul>
                        </ul>
                    </td>
                    <td>R$ <?= $saleTotal = str_price($total + $totalPartial);?></td>
                    <td>

                        <button type="button" class="btn btn-outline-primary btn-sm btn-pill" data-toggle="modal"
                            data-toggle="modal" data-target="#viewSale" title="Visualizar"
                            data-whateversaleid="<?= $sale->id;?>" data-whateversalepname="<?= $productName;?>"
                            data-whateversalepprice="<?= $priceProduct;?>"
                            data-whateversaletaxeunit="<?= $taxeName . " | ". $taxePer. " | R$". $taxePrice;?>"
                            data-whateversalepamount="<?= $sale->amount;?>"
                            data-whateversaletpartial="<?= str_price($totalPartial);?>"
                            data-whateversaletaxetotal="<?= $taxeName . " | ". $taxePer. " | R$". $taxeTotal;?>"
                            data-whateversaletotal="<?= $saleTotal;?>">
                            <i class="fa fa-fw fa-eye"></i>
                        </button>

                        <button type="button" class="btn btn-outline-warning btn-sm btn-pill" title="Editar"
                            data-toggle="modal" data-target="#editSale" 
                            data-whateversaletid="<?= $sale->id;?>"
                            data-whateverproductid="<?= $sale->product()->id;?>"
                            data-whateverproductname="<?= $productName;?>"
                            data-whateversaleamount="<?= $sale->amount;?>">
                            <i class="fa fa-fw fa-edit"></i>
                        </button>

                        <button type="button" class="btn btn-outline-danger btn-sm btn-pill" title="Delete"
                            data-delete="<?= $router->route("sales.delete"); ?>" data-action="delete"
                            data-confirm="ATENÇÃO: Tem certeza que deseja excluir a Venda?"
                            data-sale_id="<?= $sale->id; ?>">
                            <i class="fa fa-fw fa-trash"></i>

                        </button>


                    </td>
                <tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <p class="">
                        No momento, não existem Vendas.
                    </p>
                    <?php endif; ?>

            </tbody>
        </table>
    </div>
</div>


<!-- Create Modal-->
<div class="modal fade" id="newSale" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-cart-arrow-down"></i> Nova Venda</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form name="sale_store" action="<?= $router->route("sales.store"); ?>" method="post" autocomplete="off">
                <div class="modal-body">

                    <!-- Error Message -->
                    <div class="row">
                        <div class="form_callback">
                            <?= flash(); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="creatSale"><b>Produto:</b></label>
                        <select class="custom-select" name="sale_product" id="creatSale">
                            <option selected>Selecione o Produto</option>

                            <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                            <option value="<?= $product->id;?>"><?= $product->name;?></option>

                            <?php endforeach; ?>
                            <?php else: ?>
                            <option>Não há Produtos Registrado</option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="amountSale"><b>Quantidade:</b></label>
                        <input name="amount" type="text" class="form-control" id="amountSale"
                            placeholder="Quantidade (Ex: 10)">
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

<!-- Edit Modal-->
<div class="modal fade" id="editSale" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-cart-arrow-down"></i> Editar Venda</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form name="sale_edit" action="<?= $router->route("sales.update"); ?>" method="post" autocomplete="off">
                <div class="modal-body">

                    <!-- Error Message -->
                    <div class="row">
                        <div class="form_callback">
                            <?= flash(); ?>
                        </div>
                    </div>

                    <input type="hidden" name="sale_id" id="saleEditId">
                    <div class="form-group">
                        <label for="editSaleProd"><b>Produto:</b></label>
                        <select class="custom-select" name="sale_product" id="editSaleProd">
                            <option selected>Selecione o Produto</option>

                            <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                            <option value="<?= $product->id;?>"><?= $product->name;?></option>

                            <?php endforeach; ?>
                            <?php else: ?>
                            <option>Não há Produtos Registrado</option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editSaleAmount"><b>Quantidade:</b></label>
                        <input name="amount" type="text" class="form-control" id="editSaleAmount"
                            placeholder="Quantidade (Ex: 10)">
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
<div class="modal fade" id="viewSale" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalCenterTitle">Visualizar Venda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <dl class="row">
                    <dt class="col-sm-3">Produto:</dt>
                    <dd class="col-sm-9" id="saleViewProduct"></dd>

                    <dt class="col-sm-3">Valor Unitário:</dt>
                    <dd class="col-sm-9" id="saleViewValueUnit"></dd>

                    <dt class="col-sm-3">Imposto Unitário:</dt>
                    <dd class="col-sm-9" id="saleViewTaxeUnit"></dd>

                    <dt class="col-sm-3">Quantidade:</dt>
                    <dd class="col-sm-9" id="saleViewAmount"></dd>

                    <dt class="col-sm-3">Total Parcial:</dt>
                    <dd class="col-sm-9" id="saleViewTotalP"></dd>

                    <dt class="col-sm-3">Imposto Total:</dt>
                    <dd class="col-sm-9" id="saleViewTaxeT"></dd>

                    <dt class="col-sm-3">Total da Venda:</dt>
                    <dd class="col-sm-9" id="saleViewTotal"></dd>
                </dl>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>