(function( $ ) {

	'use-strict';

	$.fn.ocDrawTable = function(options) {

		var fColumns = [];
		var ajaxObj = null;
		var elem = $(this);
        var eID = elem.attr('id');
        var inputSearch = '';

		var settings = $.extend({
            ajax: null,
            dom: 'lfrtip',
			buttons: false,
			fixedHeader: true,
			lengthMenu:[10,25,50,100],
			paging: true,
            info: true,
            ordering: true,
			data: null,
			setColumns: [],
			order: [[ 0, "desc" ]]
        }, options );

		$.each(settings.setColumns, function(index, value){
			let sCol = {};
			$.each(value, function(key, val){
				if(key == 'columns'){
					sCol['targets'] = val;
				}else if(key == 'buttons'){
					sCol['orderable'] = false;
					sCol['render'] = function ( data, type, full, meta ){
						let drop = '';
						if(val.length > 6){
							drop += '<div style="display:inline" class="mr-2">'+
									  '<button type="button" class="btn btn-outline-primary btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
										'<i class="ti-more"></i>'+
									  '</button>'+
									  '<div class="dropdown-menu dropdown-menu-right">';
							$.each(val, function (i, v){
								if(i >= 6){
                                    if(typeof v.module === 'undefined' || typeof v.moduleAction === 'undefined' || get_pU(v.module, v.moduleAction) !== false){
                                        if(typeof v.if === 'undefined' || eval(v.if)){
                                            drop += '<a class="dropdown-item text-' + (v.color ? v.color : 'primary') + '" href="#" onclick="' + v.action + '(';
                                            $.each(v.params, function(j, b){
                                                drop += "'" + cleanQuote(full[b]) + "'" + (v.params.length > j + 1 ? ', ' : '');
                                            });
                                            drop += ');return false"><i class="' + v.icon + ' mr-2"></i> ' + v.text + '</a>';
                                        }
                                    }
								}
							});
							drop += '</div>'+
									'</div>';
						}
						$.each(val, function (i, v){
                            if(i >= 6) return;
                            if(typeof v.module === 'undefined' || typeof v.moduleAction === 'undefined' || get_pU(v.module, v.moduleAction) !== false){
                                if(typeof v.if === 'undefined' || eval(v.if)){
                                    if(v.check == true){
                                        drop += '<div class="form-group d-inline-block mx-2 mb-0"><div class="form-check mt-2"><label class="form-check-label"><input type="checkbox" class="form-check-input" ';
                                        $.each(v.params, function(j, b){
                                            drop += "data-param" + (j + 1) + "='" + cleanQuote(full[b]) + "'";
                                        });
                                        drop += '><i class="input-helper"></i></label></div></div>';
                                    }else{
                                        drop += '<button  type="button" class="btn btn-outline-' + (v.color ? v.color : 'primary') + ' btn-icon mr-2" onclick="' + v.action + '(';
                                        $.each(v.params, function(j, b){
                                            drop += "'" + cleanQuote(full[b]) + "'" + (v.params.length > j + 1 ? ', ' : '');
                                        });
                                        drop += ')"><i class="' + v.icon + '"></i></button>';
                                    }
                                }
                            }
						});

						return drop;
					}
				}else if(key == 'inputSearch'){
					if(val){
                        sCol['orderable'] = false;
						$.each(sCol['targets'], function(i, v){
							inputSearch += inputSearch == '' ? ':eq(' + v + ')' : ',:eq(' + v + ')';
						});
					}
				}else{
					sCol[key] = val;
				}
			});
			fColumns.push(sCol);
		});
		
		if(settings.data){
			ajaxObj = {
				"url": settings.ajax,
				"type": 'GET',
				"data": settings.data
			};
		}else{
			ajaxObj = settings.ajax;
        }
        
        this.find('thead th').filter(inputSearch).each(function(index){
            if(!$(this).find('.search-column').length){
                var title = $(this).text();
			    $(this).html('<input class="search-column text-primary" type="text" style="border:0;width:100%;outline:none;font-weight:900" placeholder="'+title+'" />' );
            }
		});

        var datatable = this.DataTable({
			"initComplete": function() {
				var input = $('#' + eID + '_wrapper .dataTables_filter input').unbind(),
					self = this.api(),
					$searchButton = $('<button>')
							   .text('Buscar')
							   .addClass('btn btn-outline-primary btn-icon datatable_search_btn btn-sm')
							   .click(function() {
								  self.search(input.val().trim()).draw();
							   })
							   .html('<i class="fas fa-search fa-sm"></i>'),
					$input_group_append = $('<div>')
								.addClass('input-group-append')
								.append($searchButton),
					$input_group = $('<div>')
								.addClass('input-group')
								.append(input, $input_group_append);
				input.on( "keyup", function (event) {
					if (event.which == 13 || input.val() === '') {
						$searchButton.click();
					}
				});
				$('#' + eID + '_wrapper .dataTables_filter label').html($input_group);
			},
            "paging": settings.paging,
            "dom": settings.dom,
            "buttons": settings.buttons,
            "info": settings.info,
            "ordering": settings.ordering,
			"responsive": true,
			"fixedHeader": true,
			"columnDefs": fColumns,
			"lengthMenu":settings.lengthMenu,
			"order": settings.order,
			"processing": true,
			"language": language(),
			"serverSide": (settings.ajax ? true : false),
			"ajax": ajaxObj,
			"drawCallback": function( settings ){
				$('#' + eID).css('width', '100%');
			},
			"fnRowCallback": function( nRow, aData, iDisplayIndex ){
				var index = iDisplayIndex +1;
				$('td:eq(0)',nRow).html(index);
				return nRow;
			}
        });
        
        datatable.columns().every( function () {
			//console.log(this);
			var that = this;
			$('input', this.header()).on('keyup change', function(){
				if(that.search() !== this.value){
					that.search(this.value).draw();
				}
			});
		});

		return datatable;

    };

	function language(){
		var l = {
			"lengthMenu": "Mostrar _MENU_ por p&aacute;gina",
			"zeroRecords": "No se encontr&oacute; registro",
			"info": "P&aacute;gina _PAGE_ de _PAGES_",
			"infoEmpty": "",
			"infoFiltered": "",
			"search": "Buscar",
			"processing":     "Procesando...",
			"emptyTable":     "No hay datos disponibles en la tabla",
			"infoPostFix":    "",
			"url":            "",
			"infoThousands":  ",",
			"loadingRecords": "Cargando...",
			"paginate": {
			  "first":    "Primero",
			  "last":     "Ultimo",
			  "next":     ">",
			  "previous": "<"
			},
			"aria": {
			  "sortAscending":  ": Activar para ordenar la columna de manera ascendente",
			  "sortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		};
		return l;
    }
    
    function cleanQuote(str){
        return (str + '').replace(/\"/g, "&#34;").replace(/\'/g, "&#39;").replace(/(\r\n|\n|\r)/gm, " ");
    }

}( jQuery ));
