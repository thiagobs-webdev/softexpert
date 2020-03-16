<?php $v->layout("softexpertadm/_template"); ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h5 class="h3 mb-0 text-gray-800">Dashboard > Produtos > Tipos</h5>
</div>


<div class="card">

    <!-- Message -->
    <!-- <div class="row my-2">
        <div class="form_callback">
            <?= flash(); ?>
        </div>
    </div> -->


    <h5 class="card-header bg-dark">
        <button class="btn btn-primary" data-toggle="modal" data-target="#newProductType">
            <i class="fas fa-plus"></i>
            Novo
        </button>
    </h5>
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover table-sm">
            <thead class="bg-success text-white">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Taxa</th>
                    <th scope="col">Registrado Por</th>
                    <th scope="col">Registrado Em</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>

                <?php if (!empty($productTypes)): ?>
                <?php foreach ($productTypes as $type): ?>
                <tr>
                    <td><?= $type->name;?></td>
                    <td><?= $taxe = $type->taxe()->name;?> <?= str_percentage($type->taxe()->percentage);?> %</td>
                    <td><?= $user = $type->user()->first_name ." " . $type->user()->last_name;?></td>
                    <td><?= $type->created_at;?></td>
                    <td>

                        <button type="button" class="btn btn-outline-primary btn-sm btn-pill" data-toggle="modal"
                            data-toggle="modal" data-target="#viewType" title="Visualizar"
                            data-whatevertypeid="<?= $type->id;?>" data-whatevertypename="<?= $type->name;?>"
                            data-whatevertypetaxes="<?= $taxe;?> %" data-whateveruser="<?= $user;?>"
                            data-whatevercreated="<?= $type->created_at;?>">
                            <i class="fa fa-fw fa-eye"></i>
                        </button>

                        <button type="button" class="btn btn-outline-warning btn-sm btn-pill" title="Editar"
                            data-toggle="modal" data-target="#editType" data-whatevertypeid="<?= $type->id;?>"
                            data-whatevertaxeid="<?= $type->product_type_taxes_id;?>"
                            data-whatevertypename="<?= $type->name;?>"
                            data-whatevertaxename="<?= $type->taxe()->name;?>">
                            <i class="fa fa-fw fa-edit"></i>
                        </button>

                        <button type="button" class="btn btn-outline-danger btn-sm btn-pill" title="Delete"
                            data-delete="<?= $router->route("categories.delete"); ?>" data-action="delete"
                            data-confirm="ATENÇÃO: Tem certeza que deseja excluir o Tipo de Produto?"
                            data-type_id="<?= $type->id; ?>">
                            <i class="fa fa-fw fa-trash"></i>

                        </button>


                    </td>
                <tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <p class="">
                        No momento, não existem Tipos de Produtos.
                    </p>
                    <?php endif; ?>

            </tbody>
        </table>
    </div>
</div>


<!-- Create Modal-->
<div class="modal fade" id="newProductType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-ticket-alt"></i> Novo Tipo Produto</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form name="product_type_store" action="<?= $router->route("categories.store"); ?>" method="post"
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
                            placeholder="Nome do Tipo">
                    </div>

                    <div class="form-group">
                        <label for="creatTaxe"><b>Taxa:</b></label>
                        <select class="custom-select" name="type_taxe" id="creatTaxe">
                            <option value="" selected>Selecione a Taxa</option>

                            <?php if (!empty($taxes)): ?>
                            <?php foreach ($taxes as $taxe): ?>
                            <option value="<?= $taxe->id;?>"><?= $taxe->name;?></option>

                            <?php endforeach; ?>
                            <?php else: ?>
                            <option>Não há Taxa Registrada</option>
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
<div class="modal fade" id="editType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-ticket-alt"></i> Editar Tipo de Produto
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form name="type_update" action="<?= $router->route("categories.update"); ?>" method="post"
                autocomplete="off">
                <div class="modal-body">

                    <!-- Error Message -->
                    <div class="row">
                        <div class="form_callback">
                            <?= flash(); ?>
                        </div>
                    </div>

                    <input type="hidden" name="type_id" id="typeId">
                    <div class="form-group">
                        <label for="typeName">Name:</label>
                        <input name="name" type="text" class="form-control" id="typeName" aria-describedby="titlelHelp"
                            placeholder="Nome do Tipo de Produto">
                        <small id="titlelHelp" class="form-text text-muted"></small>
                    </div>


                    <div class="form-group">
                        <label for="editTaxe"><b>Taxa:</b></label>
                        <select class="custom-select" name="type_taxe" id="editTaxe">
                            <option value="" selected>Selecione a Taxa</option>

                            <?php if (!empty($taxes)): ?>
                            <?php foreach ($taxes as $taxe): ?>
                            <option value="<?= $taxe->id;?>"><?= $taxe->name;?></option>

                            <?php endforeach; ?>
                            <?php else: ?>
                            <option>Não há Taxa Registrada</option>
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
<div class="modal fade" id="viewType" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalCenterTitle">Visualizar Tipo de Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <dl class="row">
                    <dt class="col-sm-3">Nome:</dt>
                    <dd class="col-sm-9" id="viewTypeName"></dd>

                    <dt class="col-sm-3">Taxa:</dt>
                    <dd class="col-sm-9" id="viewTypeTaxe"></dd>

                    <dt class="col-sm-3">Registrado Por:</dt>
                    <dd class="col-sm-9" id="viewTypeUser"></dd>

                    <dt class="col-sm-3">Registrado Em:</dt>
                    <dd class="col-sm-9" id="viewTypeCreated"></dd>
                </dl>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
