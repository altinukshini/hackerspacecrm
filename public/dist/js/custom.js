$("#alluserstable").DataTable();
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass: 'iradio_minimal-blue',
  increaseArea: '15%' // optional
});
$('input[type="checkbox"].minimal, input[type="radio"].minimal').css('padding-left', '10px');

$('.datepicker').datepicker({
  autoclose: true,
  format: 'yyyy-mm-dd'
});

$(".wysitextarea").wysihtml5();

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
            $('#editMenuForm [name="permission_id"]').val(data.permission_id);
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

function editUser(username) {
    $('#editUserForm')[0].reset();
    $.ajax({
        url: "/users/" + username,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('#editUserForm').attr('action', '/users/'+data.username);
            $('#editUserForm [name="full_name"]').val(data.full_name);
            $('#editUserForm [name="email"]').val(data.email);
            // Open modal for edit:
            $('#editUser').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error getting data!');
        }
    });
}

function editRole(id) {
    $('#editRoleForm')[0].reset();
    $.ajax({
        url: "/roles/" + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('#editRoleForm').attr('action', '/roles/'+id);
            $('#editRoleForm [name="label"]').val(data.label);
            // Open modal for edit:
            $('#editRole').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error getting data!');
        }
    });
}

function editUserRoles(username) {
  
    $("#updateUserRolesForm input").parent('div').attr('aria-checked', 'false').removeClass('checked');
    $("#updateUserRolesForm input").parent('div').removeClass('checked');
    // $("#updateUserRolesForm input").parent('div')
    $("#updateUserRolesForm input").attr("checked", false);
    $('#updateUserRolesForm')[0].reset();
    $.ajax({
        url: "/roles/user/" + username,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('#updateUserRolesForm').attr('action', '/roles/user/'+username);
            for (var key in data) {
                $('#updateUserRolesForm input[value="'+data[key]+'"] ').parent('div').attr('aria-checked', 'true').removeClass('checked');
                $('#updateUserRolesForm input[value="'+data[key]+'"] ').parent('div').addClass('checked');
                $('#updateUserRolesForm input[value="'+data[key]+'"] ').attr("checked", true);
            }
            // Open modal for edit:
            $('#editUserRoles').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error getting data!');
        }
    });
}
// triggered when modal is about to be shown
$('#confirmUserDelete').on('show.bs.modal', function(e) {
    //get data-id attribute of the clicked element
    username = $(e.relatedTarget).data('username');
    $("#confirmUserDelete #username").html( username );
    $("#delForm").attr('action', '/users/' + username);
});

// triggered when modal is about to be shown
$('#confirmRoleDelete').on('show.bs.modal', function(e) {
    //get data-id attribute of the clicked element
    roleid = $(e.relatedTarget).data('roleid');
    rolename = $(e.relatedTarget).data('rolename');
    $("#confirmRoleDelete #rolename").html( rolename );
    $("#delForm").attr('action', '/roles/' + roleid);
});

// triggered when modal is about to be shown
$('#confirmDelete').on('show.bs.modal', function(e) {
	//get data-id attribute of the clicked element
	menuId = $(e.relatedTarget).data('menu_id');
	menuName = $(e.relatedTarget).data('menu_name');
	$("#confirmDelete #mName").html( menuName );
	$("#delForm").attr('action', '/settings/menus/' + menuId);
});

$('.icp-auto').iconpicker();

$('.action-destroy').on('click', function() {
	$.iconpicker.batch('.icp.iconpicker-element', 'destroy');
});

function randString(id){
  var dataSet = $(id).attr('data-character-set').split(','); 
  var possible = '';
  if($.inArray('a-z', dataSet) >= 0){
    possible += 'abcdefghijklmnopqrstuvwxyz';
  }
  if($.inArray('A-Z', dataSet) >= 0){
    possible += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  }
  if($.inArray('0-9', dataSet) >= 0){
    possible += '0123456789';
  }
  if($.inArray('#', dataSet) >= 0){
    possible += '![]{}()%&*$#^<>~@|';
  }
  var text = '';
  for(var i=0; i < $(id).attr('data-size'); i++) {
    text += possible.charAt(Math.floor(Math.random() * possible.length));
  }
  return text;
}

// Create a new password
$(".btn-genpasswd").click(function(){
  // var field = $(this).closest('div').find('input[rel="gp"]');
  var field = $('.genpasswd');
  var password = randString(field);
  field.val(password);
  prompt('Make sure you save your generated password somewhere safe before closing this window!', password)
});

// Auto Select Pass On Focus
$('input[rel="gp"]').on("click", function () {
   $(this).select();
});