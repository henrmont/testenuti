!(function($){
    $('#product_image').on('change',function(event){
        //get the file name
        var absoluteFileName = URL.createObjectURL(event.target.files[0]);
        var fileName = event.target.files[0].name;
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);

        $('#image').css({
            'width'                 :   '400px',
            'height'                :   '400px',
            'background-image'      :   'url('+absoluteFileName+')',
            'background-size'       :   'cover',
            'background-position'   :   'center center',
            'border-radius'         :   '30px',
        });
    })

    $('[data-target="#editCity"]').on("click", function(){
        $('#editCityId').val($(this).data('id'));
        $('#editCityName').val($(this).data('name'));
    })

    $('[data-target="#editAirplane"]').on("click", function(){
        $('#editAirplaneId').val($(this).data('id'));
        $('#editAirplaneName').val($(this).data('name'));
    })

    $('#vooCityFrom').on("change",function(){
        $('#vooCityTo').html('');
        var filter = $('#vooCityFrom').val();
        var url_city = "/system/city/search/"+filter;
        var url_airplane = "/system/airplane/search/"+filter;
        $.ajax({
            type:       "GET",
            dataType:   "json",
            url:        url_city,
            beforeSend: function(){
                
            },
            success:    function(data){
                $.each(data, function(key, value){
                    $('#vooCityTo').append('<option value="'+value.id+'">'+value.name+'</option>');
                })
            },
        })
        $.ajax({
            type:       "GET",
            dataType:   "json",
            url:        url_airplane,
            beforeSend: function(){
                
            },
            success:    function(data){
                $.each(data, function(key, value){
                    $('#vooAirplane').append('<option value="'+value.id+'">'+value.name+'</option>');
                })
            },
        })
    })

    $('#search').keyup(function(){
        $('#result').html('');
        var sep  = ($('#search').val().match(/,/g) || []).length;
        if(sep > 0){
            var filter = $('#search').val().split(",");
            var url = "/admin/zones/search/"+filter[0].trim()+"/"+filter[1].trim();
        }else{
            var filter = $('#search').val();
            var url = "/admin/zones/search/"+filter;
        }
        $.ajax({
            type:       "GET",
            dataType:   "json",
            url:        url,
            beforeSend: function(){
                
            },
            success:    function(data){
                if($('#search').val() == ''){
                    $('#result').html('');
                } else {
                    $.each(data, function(key, value){
                        $('#result').append('<div class="p-2" style="display: grid; grid-template-columns:8fr 3fr;"><div><small style="font-style:italic;">'+value.name+', '+value.city_name+'/'+value.uf+'</small></div><div class="text-right"><a href="/admin/zones/add/'+value.id+'" class="btn btn-sm btn-warning">Registrar zona</a></div></div>');
                    })
                }
            },
        })
    })

    $('.zone_remove').click(function(e){
        e.preventDefault();
        var data = $(this);
        bootbox.confirm("Deseja realmente excluir essa zona?", function(e){
            if(e == true){
                window.location = data.attr("href");
            }
        });
    })

    $('#search-clients').keyup(function(){
        $('#result').html('');
        var sep  = ($('#search-clients').val().match(/,/g) || []).length;
        if(sep > 0){
            var filter = $('#search-clients').val().split(",");
            var url = "/admin/client/search/"+filter[0].trim()+"/"+filter[1].trim();
        }else{
            var filter = $('#search-clients').val();
            var url = "/admin/client/search/"+filter;
        }
        $.ajax({
            type:       "GET",
            dataType:   "json",
            url:        url,
            beforeSend: function(){
                
            },
            success:    function(data){
                if($('#search-clients').val() == ''){
                    $('#result').html('');
                } else {
                    $.each(data, function(key, value){
                        $('#result').append('<div class="p-2" style="display: grid; grid-template-columns:8fr 3fr;"><div><small style="font-style:italic;">'+value.username+', '+value.email+'</small></div><div class="text-right"><a href="/admin/client/add/'+value.id+'" class="btn btn-sm btn-warning">Registrar cliente</a></div></div>');
                    })
                }
            },
        })
    })

    $('.client_change').click(function(e){
        e.preventDefault();
        var data = $(this);
        bootbox.confirm("Deseja habilitar/desabilitar esse cliente?", function(e){
            if(e == true){
                window.location = data.attr("href");
            }
        });
    })

    $('#search-vendors').keyup(function(){
        $('#result').html('');
        var filter = $('#search-vendors').val();
        var url = "/system/vendor/search/"+filter;
        $.ajax({
            type:       "GET",
            dataType:   "json",
            url:        url,
            beforeSend: function(){
                
            },
            success:    function(data){
                if($('#search-vendors').val() == ''){
                    $('#result').html('');
                } else {
                    $.each(data, function(key, value){
                        $('#result').append('<div class="p-2" style="display: grid; grid-template-columns:3fr 3fr;"><div><small style="font-style:italic;">'+value.username+', '+value.zones+'</small></div><div class="text-right"><a href="/system/vendor/request/'+value.id+'" class="btn btn-sm btn-warning">Solicitar requisição</a></div></div>');
                    })
                }
            },
        })
    })

    $('.vendor_remove').click(function(e){
        e.preventDefault();
        var data = $(this);
        bootbox.confirm("Deseja Excluir esse fornecedor?", function(e){
            if(e == true){
                window.location = data.attr("href");
            }
        });
    })

    $('.crequest_remove').click(function(e){
        e.preventDefault();
        var data = $(this);
        bootbox.confirm("Deseja Excluir essa solicitação?", function(e){
            if(e == true){
                window.location = data.attr("href");
            }
        });
    })

    $('.crequest_add').click(function(e){
        e.preventDefault();
        var data = $(this);
        bootbox.confirm("Deseja Aprovar essa solicitação?", function(e){
            if(e == true){
                window.location = data.attr("href");
            }
        });
    })

    $('.favorite_add').click(function(e){
        e.preventDefault();
        var data = $(this);
        bootbox.confirm("Deseja adicionar esse produto dos favoritos?", function(e){
            if(e == true){
                window.location = data.attr("href");
            }
        });
    })

    $('.favorite_remove').click(function(e){
        e.preventDefault();
        var data = $(this);
        bootbox.confirm("Deseja remover esse produto dos favoritos?", function(e){
            if(e == true){
                window.location = data.attr("href");
            }
        });
    })

    $('#cep').focusout(function(){
        var filter = $('#cep').val();
        var url = "/system/local/search/"+filter;
        $.ajax({
            type:       "GET",
            dataType:   "json",
            url:        url,
            beforeSend: function(){
                
            },
            success:    function(data){
                if(data.length > 0){
                    $.each(data, function(key, value){
                        $('#adress').val(value.descricao);
                        $('#district').val(value.bairro);
                        $('#city').val(value.cidade);
                        $('#uf').val(value.uf);
                    })
                }else{
                    $('#adress').val('');
                    $('#district').val('');
                    $('#city').val('');
                    $('#uf').val('');
                }
            },
        })
    })

    $('[name="payment"]').click(function(e){
        if($(this).val() == 1){
            $('#troco').show();
        }else{
            $('#troco').hide();
        }
    })

    $('.prequest_submit').click(function(e){
        e.preventDefault();
        var data = $('[name="form-prequest"]');
        bootbox.confirm("Confirmar a compra?", function(e){
            if(e == true){
                data.submit();
            }
        });
    })

    $('.prequest_aprove').click(function(e){
        e.preventDefault();
        var data = $(this);
        bootbox.confirm("Confirmar a solicitação?", function(e){
            if(e == true){
                window.location = data.attr("href");
            }
        });
    })

    $('.prequest_reject').click(function(e){
        e.preventDefault();
        var data = $(this);
        bootbox.confirm("Rejeitar a solicitação?", function(e){
            if(e == true){
                window.location = data.attr("href");
            }
        });
    })

    $('.prequest_user_cancel').click(function(e){
        e.preventDefault();
        var data = $(this);
        bootbox.confirm("Ao cancelar uma solicitação sua conta poderá ser bloqueada para o fornecedor. Deseja cancelar a solicitação?", function(e){
            if(e == true){
                window.location = data.attr("href");
            }
        });
    })

    $('.prequest_admin_cancel').click(function(e){
        e.preventDefault();
        var data = $(this);
        bootbox.confirm("Ao cancelar uma solicitação será cobrada uma taxa de R$ 2,00. Deseja cancelar a solicitação?", function(e){
            if(e == true){
                window.location = data.attr("href");
            }
        });
    })

    $('.prequest_finish').click(function(e){
        e.preventDefault();
        var data = $(this);
        bootbox.confirm("Finalizar a solicitação?", function(e){
            if(e == true){
                window.location = data.attr("href");
            }
        });
    })

    $('#search-partner-vendor').keyup(function(){
        $('#result').html('');
        var filter = $('#search-partner-vendor').val();
        var url = "/partner/search/"+filter;
        $.ajax({
            type:       "GET",
            dataType:   "json",
            url:        url,
            beforeSend: function(){
                
            },
            success:    function(data){
                if($('#search-partner-vendor').val() == ''){
                    $('#result').html('');
                } else {
                    $.each(data, function(key, value){
                        $('#result').append('<div class="p-2" style="display: grid; grid-template-columns:8fr 4fr;"><div><small style="font-style:italic;">'+value.username+', '+value.email+'</small></div><div class="text-right"><a href="/partner/vendor/add/'+value.id+'" class="btn btn-sm btn-warning">Registrar fornecedor</a></div></div>');
                    })
                }
            },
        })
    })

    $('#search-super-partner').keyup(function(){
        var filter = $('#search-super-partner').val();
        var url = "/super/search/partner/"+filter;
        $.ajax({
            type:       "GET",
            dataType:   "json",
            url:        url,
            beforeSend: function(){
                
            },
            success:    function(data){
                if($('#search-super-partner').val() == ''){
                    $('#result').html('');
                } else {
                    $.each(data, function(key, value){
                        $('#result').append('<div class="p-2" style="display: grid; grid-template-columns:8fr 4fr;"><div><small style="font-style:italic;">'+value.username+', '+value.email+'</small></div><div class="text-right"><a href="/super/vendor/add/'+value.id+'" class="btn btn-sm btn-warning">Registrar parceiro</a></div></div>');
                    })
                }
            },
        })
    })

    $('#search-super-vendor').keyup(function(){
        $('#result').html('');
        var filter = $('#search-super-vendor').val();
        var url = "/super/search/vendor/"+filter;
        $.ajax({
            type:       "GET",
            dataType:   "json",
            url:        url,
            beforeSend: function(){
                
            },
            success:    function(data){
                if($('#search-super-vendor').val() == ''){
                    $.each(data, function(key, value){
                        if(value.active == true){
                            $('#result').append('<div class="row item-content m-2 p-2 justify-content-center"><div class="col-lg-1 col-sm-1 col-xs-2 pt-1"><i class="fas fa-map-marker-alt"></i></div><div class="col-lg-2 col-sm-2 col-xs-2 pt-1"><span style="font-style: italic;">'+value.username+'</span></div><div class="col-lg-3 col-sm-3 col-xs-3 pt-1"><span style="font-style: italic;">'+value.email+'</span></div><div class="col-lg-2 col-sm-2 col-xs-2 pt-1"><span style="font-style: italic;">'+value.price+'</span></div><div class="col-lg-1 col-sm-1 col-xs-1 text-center"><button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#incFatura" data-id='+value.id+'>Fatura</button></div><div class="col-lg-2 col-sm-2 col-xs-2 text-center"><a href="/super/vendor/change/'+value.id+'" class="btn btn-sm btn-success vendor_change">Ativado</a></div><div class="col-lg-1 col-sm-1 col-xs-1 text-center"><a href="#" class="btn btn-sm btn-danger">Excluir</a></div></div>');
                            $('[data-target="#incFatura"]').click(function(){
                                $('#notes_vendorId').val($(this).data('id'));
                            })
                        }else{
                            $('#result').append('<div class="row item-content m-2 p-2 justify-content-center"><div class="col-lg-1 col-sm-1 col-xs-2 pt-1"><i class="fas fa-map-marker-alt"></i></div><div class="col-lg-2 col-sm-2 col-xs-2 pt-1"><span style="font-style: italic;">'+value.username+'</span></div><div class="col-lg-3 col-sm-3 col-xs-3 pt-1"><span style="font-style: italic;">'+value.email+'</span></div><div class="col-lg-2 col-sm-2 col-xs-2 pt-1"><span style="font-style: italic;">'+value.price+'</span></div><div class="col-lg-1 col-sm-1 col-xs-1 text-center"><button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#incFatura" data-id='+value.id+'>Fatura</button></div><div class="col-lg-2 col-sm-2 col-xs-2 text-center"><a href="/super/vendor/change/'+value.id+'" class="btn btn-sm btn-secondary vendor_change">Desativado</a></div><div class="col-lg-1 col-sm-1 col-xs-1 text-center"><a href="#" class="btn btn-sm btn-danger">Excluir</a></div></div>');
                            $('[data-target="#incFatura"]').click(function(){
                                $('#notes_vendorId').val($(this).data('id'));
                            })
                        }
                    })
                } else {
                    $.each(data, function(key, value){
                        if(value.active == true){
                            $('#result').append('<div class="row item-content m-2 p-2 justify-content-center"><div class="col-lg-1 col-sm-1 col-xs-2 pt-1"><i class="fas fa-map-marker-alt"></i></div><div class="col-lg-2 col-sm-2 col-xs-2 pt-1"><span style="font-style: italic;">'+value.username+'</span></div><div class="col-lg-3 col-sm-3 col-xs-3 pt-1"><span style="font-style: italic;">'+value.email+'</span></div><div class="col-lg-2 col-sm-2 col-xs-2 pt-1"><span style="font-style: italic;">'+value.price+'</span></div><div class="col-lg-1 col-sm-1 col-xs-1 text-center"><button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#incFatura" data-id='+value.id+'>Fatura</button></div><div class="col-lg-2 col-sm-2 col-xs-2 text-center"><a href="/super/vendor/change/'+value.id+'" class="btn btn-sm btn-success vendor_change">Ativado</a></div><div class="col-lg-1 col-sm-1 col-xs-1 text-center"><a href="#" class="btn btn-sm btn-danger">Excluir</a></div></div>');
                            $('[data-target="#incFatura"]').click(function(){
                                $('#notes_vendorId').val($(this).data('id'));
                            })
                        }else{
                            $('#result').append('<div class="row item-content m-2 p-2 justify-content-center"><div class="col-lg-1 col-sm-1 col-xs-2 pt-1"><i class="fas fa-map-marker-alt"></i></div><div class="col-lg-2 col-sm-2 col-xs-2 pt-1"><span style="font-style: italic;">'+value.username+'</span></div><div class="col-lg-3 col-sm-3 col-xs-3 pt-1"><span style="font-style: italic;">'+value.email+'</span></div><div class="col-lg-2 col-sm-2 col-xs-2 pt-1"><span style="font-style: italic;">'+value.price+'</span></div><div class="col-lg-1 col-sm-1 col-xs-1 text-center"><button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#incFatura" data-id='+value.id+'>Fatura</button></div><div class="col-lg-2 col-sm-2 col-xs-2 text-center"><a href="/super/vendor/change/'+value.id+'" class="btn btn-sm btn-secondary vendor_change">Desativado</a></div><div class="col-lg-1 col-sm-1 col-xs-1 text-center"><a href="#" class="btn btn-sm btn-danger">Excluir</a></div></div>');
                            $('[data-target="#incFatura"]').click(function(){
                                $('#notes_vendorId').val($(this).data('id'));
                            })
                        }
                    })
                }
            },
        })
    })

    $('[data-target="#incFatura"]').click(function(){
        $('#notes_vendorId').val($(this).data('id'));
    })
})(jQuery)