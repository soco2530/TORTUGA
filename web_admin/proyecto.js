function load(page){
	var query=$("#q").val();
	var per_page=10;
	var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
	$("#loader").fadeIn('slow');
	$.ajax({
		method: 'POST',
		url:'../admin/classes/producto_paginar.php',
		data: parametros,
		 beforeSend: function(objeto){
		$("#loader").html("Cargando...");
		},
		success:function(data){
			$(".outer_div").html(data).fadeIn('slow');
			$("#loader").html("");
		}
	})
}

$(document).ready(function(){

	load(1);

	var productList;

	function getProducts(){
		$.ajax({
			url : '../admin/classes/Producto.php',
			method : 'POST',
			data : {GET_PRODUCT:1},
			success : function(response){
				//console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {

					var productHTML = '';

					productList = resp.message.products;

					if (productList) {
						$.each(resp.message.products, function(index, value){

							productHTML += '<tr>'+
								              '<td>'+''+'</td>'+
								              '<td>'+ value.descripcion +'</td>'+
								              '<td><img width="60" height="60" src="../product_images/'+value.imagen+'"></td>'+
								              '<td>'+ value.precio +'</td>'+
								              '<td>'+ value.stock +'</td>'+
								              '<td>'+ value.categoria +'</td>'+
								              '<td>'+ value.razonsocial +'</td>'+
								              '<td><a class="btn btn-sm btn-info edit-product" style="color:#fff;"><span style="display:none;">'+JSON.stringify(value)+'</span><i class="fas fa-pencil-alt"></i></a>&nbsp;<a pid="'+value.idproducto+'" class="btn btn-sm btn-danger delete-product" style="color:#fff;"><i class="fas fa-trash-alt"></i></a></td>'+
								            '</tr>';

						});

						$("#producto_listado").html(productHTML);
					}

					var catSelectHTML = '<option value="">Seleccione Categoria</option>';
					$.each(resp.message.categorias, function(index, value){

						catSelectHTML += '<option value="'+ value.idcategoria +'">'+ value.descripcion +'</option>';

					});

					$(".category_list").html(catSelectHTML);

					var brandSelectHTML = '<option value="">Seleccione Proveedor</option>';
					$.each(resp.message.proveedores, function(index, value){

						brandSelectHTML += '<option value="'+ value.idproveedor +'">'+ value.razonsocial +'</option>';

					});

					$(".proveedor_list").html(brandSelectHTML);

				}
			}

		});
	}

	getProducts();

	$(".add-product").on("click", function(){

		$.ajax({

			url : '../admin/classes/Producto.php',
			method : 'POST',
			data : new FormData($("#add-product-form")[0]),
			contentType : false,
			cache : false,
			processData : false,
			success : function(response){
				console.log(response);
				var resp = response;
				if (resp.status == 202) {
					load(1);
					$("#add-product-form").trigger("reset");
					$("#message").html(`<div class="alert alert-info alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							`+ resp.message +`
						</div>`
					);
					//$("#producto_msg").html(resp.message);
				}else if(resp.status == 303){
					$("#message").html(`<div class="alert alert-info alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							`+ resp.message +`
						</div>`
					);
				}
				$("#add_product_modal").modal('hide');
			}

		});

	});


	$(document.body).on('click', '.edit-product', function(){

		var product = $.parseJSON($.trim($(this).find('span').text()));

		$("input[name='_descripcion']").val(product.descripcion);
		$("select[name='_idcategoria']").val(product.idcategoria);
		$("select[name='_idproveedor']").val(product.idproveedor);
		$("input[name='_precio']").val(product.precio);
		$("input[name='_stock']").val(product.stock);

		$("input[name='_imagen']").siblings("img").attr("src", "../product_images/"+product.imagen);
		$("input[name='pid']").val(product.idproducto);
		$("#edit_product_modal").modal('show');

	});

	$(".submit-edit-product").on('click', function(){

		$.ajax({

			url : '../admin/classes/Producto.php',
			method : 'POST',
			data : new FormData($("#edit-product-form")[0]),
			contentType : false,
			cache : false,
			processData : false,
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					$("#edit-product-form").trigger("reset");
					$("#edit_product_modal").modal('hide');
					load(1);
					$("#message").html(`<div class="alert alert-info alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							`+ resp.message +`
						</div>`
					);
				}else if(resp.status == 303){
					$("#message").html(`<div class="alert alert-info alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							`+ resp.message +`
						</div>`
					);
				}
			}

		});


	});

	$(document.body).on('click', '.delete-product', function(){

		var pid = $(this).data('id');
		if (confirm("Estas seguro que quieres eliminar este producto ?")) {
			$.ajax({
				url : '../admin/classes/Producto.php',
				method : 'POST',
				data : {DELETE_PRODUCT: 1, pid:pid},
				success : function(response){
					console.log(response);
					var resp = $.parseJSON(response);
					if (resp.status == 202) {
						load(1);
					}else if (resp.status == 303) {
						$("#message").html(`<div class="alert alert-info alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								`+ resp.message +`
							</div>`
						);
					}
				}

			});
		}else{
			$("#message").html(`<div class="alert alert-info alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					`+ 'Cancelled' +`
				</div>`
			);
		}


	});

});
