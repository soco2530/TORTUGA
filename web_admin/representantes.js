function load(page){
	var query=$("#q").val();
	var per_page=10;
	var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
	$("#loader").fadeIn('slow');
	$.ajax({
		method: 'POST',
		url:'REPREDIRECTIVA.php',
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
	function getCategories(){
		$.ajax({
			url : 'REPREDIRECTIVA.php',
			method : 'POST',
			data : {GET_PROVEEDOR:1},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);

				var brandHTML = '';

				$.each(resp.message, function(index, value){
					brandHTML += '<tr>'+
									'<td>'+ value.idrepresentante+'</td>'+
									'<td>'+ value.ruc +'</td>'+
									'<td>'+ value.nombre +'</td>'+
									'<td>'+ value.direccion +'</td>'+
									'<td>'+ value.razonsocial +'</td>'+
									'<td>'+ value.telefono +'</td>'+
									'<td><center><a class="btn btn-sm btn-info edit-supplier"><span style="display:none;">'+JSON.stringify(value)+'</span><i class="fas fa-pencil-alt"></i></a>&nbsp;<a pid="'+value.idrepresentante+'" class="btn btn-sm btn-danger delete-supplier"><i class="fas fa-trash-alt"></i></a> </center></td>'+
								'</tr>';
				});

				$("#proveedor_list").html(brandHTML);

			}
		})

	}

	$(".add_repredirectiva").on("click", function(){

		$.ajax({
			url : 'REPREDIRECTIVA.php',
			method : 'POST',
			data : $("#add-proveedor-form").serialize(),
			success : function(response){
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					load(1);
					$('#add-proveedor-form').trigger("reset");
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

	$(document.body).on("click", ".edit-supplier", function(){

		var cat = $.parseJSON($.trim($(this).children("span").html()));

		$("input[name='_ruc']").val(cat.ruc);
		$("input[name='_nombre']").val(cat.nombre);
		$("input[name='_direccion']").val(cat.direccion);
		$("input[name='_razonsocial']").val(cat.razonsocial);
		$("input[name='_telefono']").val(cat.telefono);
		$("input[name='idrepresentante']").val(cat.idrepresentante);
		$("#edit_category_modal").modal('show');

	});

	$(".edit-category-btn").on('click', function(){

		$.ajax({
			url : 'REPREDIRECTIVA.php',
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

	$(document.body).on('click', '.delete-supplier', function(){

		var pid = $(this).data('id');

		if (confirm("Estas seguro que quieres eliminar este proveedor?")) {
			$.ajax({
				url : 'REPREDIRECTIVA.php',
				method : 'POST',
				data : {DELETE_SUPPLIER:1, pid:pid},
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
			})
		}else{
			$("#message").html(`<div class="alert alert-info alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					`+ 'Cancelled' +`
				</div>`
			);
		}
	});
});
