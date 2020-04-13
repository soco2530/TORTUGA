function load(page){
	var query=$("#q").val();
	var per_page=10;
	var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
	$("#loader").fadeIn('slow');
	$.ajax({
		method: 'POST',
		url:'Colabor.php',
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

	function getClientes(){
		$.ajax({
			url : 'Colabor.php',
			method : 'POST',
			data : {GET_CLIENTE:1},
			success : function(response){
				var resp = $.parseJSON(response);

				/*var brandHTML = '';

				$.each(resp.message, function(index, value){
					brandHTML += '<tr>'+
								'<td>'+ value.idcliente +'</td>'+
		             '<td>'+ value.nombres +'</td>'+
								 '<td>'+ value.apellidos +'</td>'+
								 '<td>'+ value.numerodocumento +'</td>'+
								 '<td>'+ value.razonsocial +'</td>'+
								 '<td>'+ value.direccion +'</td>'+
								 '<td>'+ value.telefono +'</td>'+
									'<td><a class="btn btn-sm btn-info edit-category"><span style="display:none;">'+JSON.stringify(value)+'</span><i class="fas fa-pencil-alt"></i></a>&nbsp;<a cid="'+value.idcliente+'" class="btn btn-sm btn-danger delete-client"><i class="fas fa-trash-alt"></i></a></td>'+
								'</tr>';
				});

				$("#cliente_list").html(brandHTML);*/

			}
		})

	}

	$(".add-cliente").on("click", function(){

		$.ajax({
			url : 'Colabor.php',
			method : 'POST',
			data : $("#add-cliente-form").serialize(),
			success : function(response){
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					load(1);
					$('#add-cliente-form').trigger("reset");
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
				$("#add_category_modal").modal('hide');
			}
		})

	});



	$(document.body).on("click", ".edit-category", function(){
		var cat = $.parseJSON($.trim($(this).children("span").html()));

		$("input[name='_nombres']").val(cat.nombre);
		$("input[name='_apellidos']").val(cat.apellidos);
		$("input[name='_email']").val(cat.email);
		$("input[name='_clave']").val(cat.clave);
		$("input[name='_numerodocumento']").val(cat.dni);
		$("input[name='_razonsocial']").val(cat.Razonsocil);
		$("input[name='_direccion']").val(cat.direccion);
		$("input[name='_telefono']").val(cat.telefono);
		$("input[name='idcliente']").val(cat.idcolaborador);
		$("#edit_category_modal").modal('show');
	});

	$(".edit-category-btn").on('click', function(){
		$.ajax({
			url : 'Colabor.php',
			method : 'POST',
			data : $("#edit-category-form").serialize(),
			success : function(response){
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
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
				$("#edit_category_modal").modal('hide');
			}
		})

	});




	$(document.body).on('click', '.delete-customer', function(){

		var cid = $(this).data('cid');

		if (confirm("desea eliminar al colaborador")) {
			$.ajax({
				url : 'Colabor.php',
				method : 'POST',
				data : {DELETE_CLIENTE:1, cid:cid},
				success : function(response){
					var resp = $.parseJSON(response);
					if (resp.status == 202) {
						$("#message").html(`<div class="alert alert-info alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								`+ resp.message +`
							</div>`
						);
						load(1);
					}else if(resp.status == 303){
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
