$(function () {

    // Start Product
    // CREATE
    $('form[name="product_store"]').submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var action = form.attr("action");
        var data = form.serialize();

        $.ajax({
            url: action,
            data: data,
            type: "post",
            dataType: "json",
            beforeSend: function (load) {
                ajax_load("open");
            },
            success: function (su) {
                ajax_load("close");

                if (su.message) {
                    var view = '<div class="message ' + su.message.type + '">' + su.message.message + '</div>';
                    $(".form_callback").html(view);
                    $(".message").effect("bounce");
                    return;
                }

                if (su.redirect) {     
                    alert("Produto Cadastrado com Sucesso");               
                    window.location.href = su.redirect.url;
                
                }
            }
        });
        
    });

    // UPDATE
    $('form[name="product_update"]').submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var action = form.attr("action");
        var data = form.serialize();

        $.ajax({
            url: action,
            data: data,
            type: "post",
            dataType: "json",
            beforeSend: function (load) {
                ajax_load("open");
            },
            success: function (su) {
                ajax_load("close");

                if (su.message) {
                    var view = '<div class="message ' + su.message.type + '">' + su.message.message + '</div>';
                    $(".form_callback").html(view);
                    $(".message").effect("bounce");
                    return;
                }

                if (su.redirect) { 
                    alert("Produto Alterado com Sucesso");                
                    window.location.href = su.redirect.url;  
                }
            }
        });
        
    });
    
    // View Modal
    // VIEW
    $('#viewProduct').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var productName = button.data('whateverproductname');
        var productPrice = button.data('whateverproductprice');       
        var productUser = button.data('whateverproductuser');       
        
        var modal = $(this)
        modal.find('.modal-title').text('Visualizar ' + productName)
        modal.find('#productViewName').text(productName)
        modal.find('#productViewPrice').text("R$ " + productPrice)
        modal.find('#productViewUser').text(productUser)
    });

    // Edit Modal
    $('#editProduct').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var productId = button.data('whateverproductid') 
        var productName = button.data('whateverproductname')
        var productPrice = button.data('whateverproductprice')        
        var typeId = button.data('whateverproducttypeid')        
        
        var modal = $(this)
        // modal.find('.modal-title').text('Editar' + ticketTitle)
        modal.find('#productId').val(productId)
        modal.find('#inputName').val(productName)
        modal.find('#inputPrice').val(productPrice)
        $('#editType option[value='+typeId+']').attr('selected','selected');
    });
    // End Product


    // Start Product Type
    // VIEW Modal
    $('#viewType').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var typeName = button.data('whatevertypename');
        var typeTaxe = button.data('whatevertypetaxes');       
        var typeUser = button.data('whateveruser');       
        var typeCreated = button.data('whatevercreated');       
        
        var modal = $(this)
        modal.find('.modal-title').text('Visualizar ' + typeName)
        modal.find('#viewTypeName').text(typeName)
        modal.find('#viewTypeTaxe').text(typeTaxe)
        modal.find('#viewTypeUser').text(typeUser)
        modal.find('#viewTypeCreated').text(typeCreated)
    });

    // EDIT Modal
    $('#editType').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var typetId = button.data('whatevertypeid')
        var taxeId = button.data('whatevertaxeid')
        var typeName = button.data('whatevertypename'); 
        
        var modal = $(this)
        // modal.find('.modal-title').text('Editar ' + dataTaxe.name)
        modal.find('#typeId').val(typetId)
        modal.find('#typeName').val(typeName)
        $('#editTaxe option[value='+taxeId+']').attr('selected','selected');
        
    });
    // End Product Type


     // Start Taxa
    // VIEW Modal
    $('#viewTaxe').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var taxeName = button.data('whatevertaxename');
        var taxePercentage = button.data('whatevertaxepercentage');       
        var taxeUser = button.data('whateveruser');       
        var taxeCreated = button.data('whatevercreated');       
        
        var modal = $(this)
        modal.find('.modal-title').text('Visualizar ' + taxeName)
        modal.find('#viewTaxeName').text(taxeName)
        modal.find('#viewTaxePercentage').text(taxePercentage + "%")
        modal.find('#viewTaxeUser').text(taxeUser)
        modal.find('#viewTaxeCreated').text(taxeCreated)
    });

    // EDIT Modal
    $('#editTaxe').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var taxeId = button.data('whatevertaxeid');
        var taxeName = button.data('whatevertaxename');
        var taxePercentage = button.data('whatevertaxepercentage');
        
        var modal = $(this)
        modal.find('.modal-title').text('Editar ' + taxeName)
        modal.find('#taxeIdEdit').val(taxeId)
        modal.find('#taxeNameEdit').val(taxeName)
        modal.find('#taxePercentageEdit').val(taxePercentage)
    });
    // End Taxa


     // Start Sale
    // VIEW Modal
    $('#viewSale').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var salePName = button.data('whateversalepname');
        var salePPrice = button.data('whateversalepprice');
        var saleTaxeU = button.data('whateversaletaxeunit');
        var salePAmount = button.data('whateversalepamount');
        var saleTotalP = button.data('whateversaletpartial');
        var saleTaxeTt = button.data('whateversaletaxetotal');
        var saleTotal = button.data('whateversaletotal');
        
        var modal = $(this)
        modal.find('.modal-title').text('Visualizar Venda ' + salePName)
        modal.find('#saleViewProduct').text(salePName)
        modal.find('#saleViewValueUnit').text('R$ '+ salePPrice)
        modal.find('#saleViewTaxeUnit').text(saleTaxeU)
        modal.find('#saleViewAmount').text(salePAmount)
        modal.find('#saleViewTotalP').text('R$ '+ saleTotalP)
        modal.find('#saleViewTaxeT').text(saleTaxeTt)
        modal.find('#saleViewTotal').text('R$ '+ saleTotal)
            
    });

    // EDIT Modal
    $('#editSale').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var saleId = button.data('whateversaletid');
        var saleProductId = button.data('whateverproductid');
        var saleProductName = button.data('whateverproductname');
        var saleAmount = button.data('whateversaleamount');
        
        var modal = $(this)
        modal.find('.modal-title').text('Editar Venda ' + saleProductName)
        modal.find('#saleEditId').val(saleId)
        modal.find('#editSaleAmount').val(saleAmount)
        $('#editSaleProd option[value='+saleProductId+']').attr('selected','selected');
    });
    //End Sale

    

    // FORMS
    $("form:not('.ajax_off')").submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var action = form.attr("action");
        var data = form.serialize();

        $.ajax({
            url: action,
            data: data,
            type: "post",
            dataType: "json",
            beforeSend: function (load) {
                ajax_load("open");
            },
            success: function (su) {
                ajax_load("close");

                if (su.message) {
                    var view = '<div class="message ' + su.message.type + '">' + su.message.message + '</div>';
                    $(".form_callback").html(view);
                    $(".message").effect("bounce");
                    return;
                }

                if (su.redirect) {     
                    alert("Item Cadastrado com Sucesso");               
                    window.location.href = su.redirect.url;
                
                }
            }
        });
        
    });



    // Generic
    // DELETE
    $("[data-delete]").click(function (e) {
        e.preventDefault();

        var clicked = $(this);
        var data = clicked.data();
        

        if (data.confirm) {
            var deleteConfirm = confirm(data.confirm);
            if (!deleteConfirm) {
                return;
            }
        }

        $.ajax({
            url: data.delete,
            type: "POST",
            data: data,
            dataType: "json",
            beforeSend: function (load) {
                ajax_load("open");
            },
            success: function (response) {

                ajax_load("close");

                if (response.message) {
                    var view = '<div class="message ' + response.message.type + '">' + response.message.message + '</div>';
                    $(".login_form_callback").html(view);
                    $(".message").effect("bounce");
                    return;
                }
                //redirect
                if (response.redirect) {
                    alert("Item Deletado com Sucesso");
                    window.location.href = response.redirect.url;
                }
                
            }
        });
    });



    // Helpers
    function ajax_load(action) {
        ajax_load_div = $(".ajax_load");

        if (action === "open") {
            ajax_load_div.fadeIn(200).css("display", "flex");
        }

        if (action === "close") {
            ajax_load_div.fadeOut(200);
        }
    }

});