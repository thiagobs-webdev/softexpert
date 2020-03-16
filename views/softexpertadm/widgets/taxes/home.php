<?php $v->layout("softexpertadm/_template"); ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h5 class="h3 mb-0 text-gray-800">Dashboard > Tipos > Taxas</h5>
</div>


<div class="card">

    <!-- Message -->
    <!-- <div class="row my-2">
        <div class="form_callback">
            <?= flash(); ?>
        </div>
    </div> -->


    <h5 class="card-header bg-dark">
        <button class="btn btn-primary" data-toggle="modal" data-target="#newTaxe">
            <i class="fas fa-plus"></i>
            Novo
        </button>
    </h5>
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover table-sm">
            <thead class="bg-success text-white">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Porcentagem</th>
                    <th scope="col">Registrado Por</th>
                    <th scope="col">Registrado Em</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>

                <?php if (!empty($taxes)): ?>
                <?php foreach ($taxes as $taxe): ?>
                <tr>
                    <td><?= $taxe->name;?></td>
                    <td><?= $taxe->percentage;?> %</td>
                    <td><?= $taxe->user()->first_name;?> <?= $taxe->user()->last_name;?></td>
                    <td><?= $taxe->created_at;?></td>
                    <td>

                        <button type="button" class="btn btn-outline-primary btn-sm btn-pill" data-toggle="modal"
                            data-toggle="modal" data-target="#viewTaxe" title="Visualizar"
                            data-whatevertaxeid="<?= $taxe->id;?>"
                            data-whatevertaxename="<?= $taxe->name;?>"
                            data-whatevertaxepercentage="<?= str_percentage($taxe->percentage);?>"
                            data-whateveruser="<?= $taxe->registered_by_id;?>"
                            data-whatevercreated="<?= $taxe->created_at;?>"
                            >
                            <i class="fa fa-fw fa-eye"></i>
                        </button>

                        <button type="button" class="btn btn-outline-warning btn-sm btn-pill" title="Editar"
                            data-toggle="modal" data-target="#editTaxe" 
                            data-whatevertaxeid="<?= $taxe->id;?>"
                            data-whatevertaxename="<?= $taxe->name;?>"
                            data-whatevertaxepercentage="<?= str_percentage($taxe->percentage);?>"
                            data-whateveruser="<?= $taxe->registered_by_id;?>"
                            data-whatevercreated="<?= $taxe->created_at;?>"
                            >
                            <i class="fa fa-fw fa-edit"></i>
                        </button>

                        <button type="button" class="btn btn-outline-danger btn-sm btn-pill" title="Delete"
                            data-delete="<?= $router->route("taxes.delete"); ?>" data-action="delete"
                            data-confirm="ATENÇÃO: Tem certeza que deseja excluir a Taxa?"
                            data-taxe_id="<?= $taxe->id; ?>">
                            <i class="fa fa-fw fa-trash"></i>

                        </button>


                    </td>
                <tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <p class="">
                        No momento, não existem Taxas cadastradas.
                    </p>
                    <?php endif; ?>

            </tbody>
        </table>
    </div>
</div>


<!-- Create Modal-->
<div class="modal fade" id="newTaxe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-ticket-alt"></i> Nova Taxa</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form name="taxes_store" action="<?= $router->route("taxes.store"); ?>" method="post" autocomplete="off">
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
                            placeholder="Nome da Taxa">
                    </div>

                    <div class="form-group">
                        <label for="inputPercentage"><b>Porcentagem:</b></label>
                        <input name="percentage" type="text" class="form-control" id="inputPercentage"
                            placeholder="Taxa (Ex: 3,50)">
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
<div class="modal fade" id="editTaxe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-ticket-alt"></i> Editar Taxa</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form name="taxe_update" action="<?= $router->route("taxes.update"); ?>" method="post"
                autocomplete="off">
                <div class="modal-body">

                    <!-- Error Message -->
                    <div class="row">
                        <div class="form_callback">
                            <?= flash(); ?>
                        </div>
                    </div>

                    <input type="hidden" name="taxe_id" id="taxeIdEdit">
                    <div class="form-group">
                        <label for="taxeNameEdit">Name:</label>
                        <input name="name" type="text" class="form-control" id="taxeNameEdit" aria-describedby="titlelHelp"
                            placeholder="Nome da Taxa">
                        <small id="titlelHelp" class="form-text text-muted"></small>
                    </div>

                    <div class="form-group">
                        <label for="taxePercentageEdit"><b>Porcentagem:</b></label>
                        <input name="percentage" type="text" class="form-control" id="taxePercentageEdit"
                            placeholder="Taxa (Ex: 3,50)">
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
<div class="modal fade" id="viewTaxe" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                    <dd class="col-sm-9" id="viewTaxeName"></dd>

                    <dt class="col-sm-3">Porcentagem:</dt>
                    <dd class="col-sm-9" id="viewTaxePercentage"></dd>

                    <dt class="col-sm-3">Registrado Por:</dt>
                    <dd class="col-sm-9" id="viewTaxeUser"></dd>

                    <dt class="col-sm-3">Registrado Em:</dt>
                    <dd class="col-sm-9" id="viewTaxeCreated"></dd>
                </dl>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>