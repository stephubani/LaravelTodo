$(document).ready(function (){
    $('#create').click(function (){
        let role_name = $('#rolesname').val()
        let role_id = $('#roleid').val()
        let permissions= [];
        
        $('.permissions').each(function(index,element) {
            if ($(element).is(':checked')) {
                var permissionId = $(element).val()
                permissions.push(permissionId)
            }
            
        });
      
        let data = {
            role_name : role_name,
            permissions : permissions
        }

        if(role_id != ''){
            data.role_id= role_id

        }
        $.ajax({
            type: "GET",
            url: "/roles/create",
            data: {
                data
                
            },

            success: function(response) {
                console.log(response)
                if(response.success == true){
                    let html = ''
                    if(role_id == ''){
                        html += `<tr id='${response.role.id}'>`
                    }
                    html += `
                        <td class='rolesname'>${response.role.name}</td>`
                    html+= `
                        <td>
                            <ul>`
                    response.role.permissions.forEach(function(permission){
                        html += `<li>${permission.name}</li>
                        <input type="hidden" name="permission_id" class='permission_id' value='${permission.id}'>
                        `
                    })
                    html+= `
                            </ul>
                        </td>
                            `

                    html += `
                        <td>
                            <a href='/roles/${response.role.id}/toggle'>
                                <button id= 'click' class='btn ${response.role.is_active ? 'btn-warning' : 'btn-secondary'} '>
                                ${response.role.is_active ? 'Active' : 'Inactive'}</button>
                            </a>
                            
                        </td>
                        <td>
                            <button class='btn editbtn' id='editbtn${response.role.id}'>
                                <input type="hidden" name="" class='rolesid' value='${response.role.id}'>
                            <i class="fa-solid fa-pen"></i>
                            </button>

                            <button class='btn delete' id='delete_btn${response.role.id}'>
                            <i class="fa-solid fa-trash text-danger"></i>
                            </button>
                        </td>
                    `
                    if(role_id == ''){
                        html += `</tr>`
                    }

                    if(role_id == ''){
                        $('#allroles').prepend(html)
                    }else{
                        $(`#${role_id}`).html(html);
                    }
                
                    $('#rolesname').val('')
                    $('#create').text('Create')
                    $('#roleid').val('')
                    $('.permissions').prop('checked', false)

                    $('#feedback').html(response.message)
                    setTimeout(function() {
                        $('#feedback').html('')
                    }, 3000)
                    
                    document.getElementById(`editbtn${response.role.id}`).addEventListener('click' , editRole)
                    document.getElementById(`delete_btn${response.role.id}`).addEventListener('click' , deleteRole)

                }else{
                    $('#feedback').html(response.message)
                    setTimeout(function() {
                        $('#feedback').html('')
                    }, 3000)

                    $('#rolesname').val('')
                    $('#create').text('Create')
                    $('#roleid').val('')
                    $('.permissions').prop('checked', false)
                }
               
              
            },
            error: function(xhr, status, err) {
                console.log(xhr)
                $('#feedback').html(xhr.responseJSON.message)
                setTimeout(function() {
                    $('#feedback').html('')
                }, 3000);
            }
        });
        
    })

   
    $('.editbtn').click(function(event){
        editRole(event)
    })

    $('.delete').click(function(event){
        deleteRole(event)
    })

    

    function editRole(event){
        let role_id = $(event.target).closest('tr').find('.rolesid').val()
        let role_name = $(event.target).closest('tr').find('.rolesname').text()
        let row = $(event.target).closest('tr')
        let permission = []
        $('.permission_id', row).each(function(index,element){
            let permission_id = $(element).val()
            permission.push(permission_id)
        })

       permission.forEach(function(permission_id){
        $('.permissions[value="' + permission_id + '"]').prop('checked', true);
       })


        $('#roleid').val(role_id)
        $('#rolesname').val(role_name)
        $('#create').text('Edit')
    }

    function deleteRole(event){
        let role_id = $(event.target).closest('tr').find('.rolesid').val()

        $.ajax({
            type: "GET",
            url: `roles/${role_id}/delete`,
            success: function(response) {
                console.log(response)
                if(response.success == true){
                     $(`#${role_id}`).remove()
                }else{
                    $('#feedback').html(response.message)
                    setTimeout(function() {
                        $('#feedback').html('')
                    }, 3000);
                }  
              
            },
            error: function(xhr, status, err) {
                console.log(xhr)
                $('#feedback').html(xhr.responseJSON.message)
                setTimeout(function() {
                    $('#feedback').html('')
                }, 3000);
            }
        });
        

    }



    
})