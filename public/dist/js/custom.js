$('.sidebar-menu li').each(function(){
	if ($(this).hasClass('active')) {
		$(this).parent('ul').parent('li').addClass('active');
	}
});

$(".alert-fade").fadeTo(7000, 1000).fadeOut(600, function(){
    $(".alert").alert('close');
});

function editMenu(id) {
    $('#editMenuForm')[0].reset();
    $.ajax({
        url: "/settings/menus/" + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('#editMenuForm').attr('action', '/settings/menus/'+id);
            $('#editMenuForm .input-group-addon').html('<i class="fa '+ data.icon +'"></i>');
            $('#editMenuForm [name="icon"]').val(data.icon);
            if (data.parent_id != 0) {
            	$('#editMenuForm [name="parent_id"]').val(data.parent_id);
            }else{
            	$('#editMenuForm [name="parent_id"]').val(null);
            }
            $('#editMenuForm [name="menu_order"]').val(data.menu_order);
            $('#editMenuForm [name="title"]').val(data.title);
            $('#editMenuForm [name="url"]').val(data.url);
            $('#editMenuForm [name="description"]').val(data.description);
            $('#editMenuForm [name="permission"]').val(data.permission);
            $('#editMenuForm [name="menu_group"]').val(data.menu_group);
            $('#editMenuForm option[value="'+data.menu_group+'"] ').attr('selected', true);

            // Open modal for edit:
            $('#editmenu').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error getting data!');
        }
    });
}

// triggered when modal is about to be shown
$('#confirmDelete').on('show.bs.modal', function(e) {
	//get data-id attribute of the clicked element
	menuId = $(e.relatedTarget).data('menu_id');
	menuName = $(e.relatedTarget).data('menu_name');
	$("#confirmDelete #mName").html( menuName );
	$("#delForm").attr('action', '/settings/menus/' + menuId);//e.g. 'domainname/products/' + menuId
});

$('.icp-auto').iconpicker();

$('.action-destroy').on('click', function() {
	$.iconpicker.batch('.icp.iconpicker-element', 'destroy');
});