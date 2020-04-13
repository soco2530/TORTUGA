function load(page){
	var query=$("#q").val();
	var per_page=10;
	var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
	$("#loader").fadeIn('slow');
	$.ajax({
		method: 'POST',
		url:'comisionbuscar.php',
		data: parametros,
		 beforeSend: function(objeto){
		$("#loader").html("Cargando...");
		},
		success:function(data){
			$(".outer_div").html(data).fadeIn('slow');
			$("#loader").html("");
		}
	});
}

$(document).ready(function(){
   
    //console.log('jQuery is bbbb');
	load(1);
	function getCategories(){
		$.ajax({
			url : 'comisionbuscar.php',
			method : 'POST',
			data : {GET_CATEGORIES:1},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);

				var brandHTML = '';

				$.each(resp.message, function(index, value){
					brandHTML += '<tr>'+
									'<td>'+ value.idcomision +'</td>'+
									'<td>'+ value.descripcion +'</td>'+
									'<td><a class="btn btn-sm btn-info edit-category"><span style="display:none;">'+JSON.stringify(value)+'</span><i class="fas fa-pencil-alt"></i></a>&nbsp;<a cid="'+value.idcomision+'" class="btn btn-sm btn-danger delete-category"><i class="fas fa-trash-alt"></i></a></td>'+
								'</tr>';
				});

				$("#category_list").html(brandHTML);

			}
		})

	}


$(".add-category").on("click", function(){

	$.ajax({
		url : 'comisionbuscar.php',
		method : 'POST',
		data : $("#add-category-form").serialize(),
		success : function(response){
			var resp = $.parseJSON(response);
			if (resp.status == 202) {
				
				$('#add-category-form').trigger("reset");
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

$(document.body).on('click', '.delete-category', function(){

	var cid = $(this).data('id');

	if (confirm("Estas seguro que quieres eliminar esta categoria")) {
		$.ajax({
			url : 'comisionbuscar.php',
			method : 'POST',
			data : {DELETE_CATEGORY:1, cid:cid},
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





//EDITAR

$(document.body).on("click", ".edit-category", function(){

	var cat = $.parseJSON($.trim($(this).children("span").html()));
	$("input[name='e_cat_title']").val(cat.descripcion);
	$("input[name='cat_id']").val(cat.idcomision);

	$("#edit_category_modal").modal('show');


});

$(".edit-category-btn").on('click', function(){

	$.ajax({
		url : 'comisionbuscar.php',
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







	
});