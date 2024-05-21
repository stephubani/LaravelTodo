$(document).ready(function(){
    $('#save').click(function(){
        let user_name = $('#user').val()
        let user_email = $('#useremail').val()
        let user_id = $('#userid').val()
        let role_id = $('#active_roles').val()

        let data = {
            user_name : user_name,
            user_email : user_email,
            role_id : role_id
        }

        if(user_id != ''){
            data.user_id = user_id
        }
        
        $.ajax({
            type : 'GET',
            url : `user/save`,
            data : {
               data
            },

            success:function(response){
                console.log(response)
                if(response.success == true){
                    let html = ''
                    if(user_id == ''){
                        html += `<tr id='${response.user.id}'>`
                    }
                    html += `
                        <td class='${response.user.role.id}'>${response.user.role.name}</td>
                        <td class='username'>${response.user.name}</td>
                        <td class='useremail'>${response.user.email}</td>
                        <td>
                            <a href="/users/${response.user.id}/toggle">
                            <button id= 'click' class='btn ${response.user.is_active ? 'btn-warning' : 'btn-secondary'} '>
                            ${response.user.is_active ? 'Active' : 'Inactive'}</button>
                            </a>
                        
                        </td>
                        <td>
                            <button class='btn editbtn' id='edit_btn${response.user.id}'>
                                <input type="hidden" name="rolesid" class='role_id'value='${response.user.role.id}'>
                                <input type="hidden" name="userid" class='user_id' value='${response.user.id}'>
                                <i class="fa-solid fa-pen"></i>
                            </button>

                            <button class='btn delete' id='delete_btn${response.user.id}'>
                                <i class="fa-solid fa-trash text-danger"></i>
                            </button>
                        </td>
                    `
                    if(user_id == ''){
                        html += ` </tr>`
                    }

                    if(user_id == ''){
                        $('#user_details').prepend(html)
                    }else{
                        $(`#${response.user.id}`).html(html)

                    }

                    $('#user').val('')
                    $('#useremail').val('')
                    $('#userid').val('')
                    $('#active_roles').val('')
                    $('#save').text('Create User')

                    $('#feedback').html(response.message)
                    setTimeout(function() {
                        $('#feedback').html('')
                    }, 3000);

                    document.getElementById(`edit_btn${response.user.id}`).addEventListener('click' , editUser)
                    document.getElementById(`delete_btn${response.user.id}`).addEventListener('click' , deleteUser)

                }else{
                    $('#feedback').html(response.message)
                    setTimeout(function() {
                        $('#feedback').html('')
                    }, 3000);

                    $('#user').val('')
                    $('#useremail').val('')
                    $('#userid').val('')
                    $('#active_roles').val('')
                    $('#save').text('Create User')
                }
              
                
            },

            error:function(xhr, status , err){
                console.log(xhr)
                $('#feedback').html(xhr.responseJSON.message)
                setTimeout(function() {
                    $('#feedback').html('')
                }, 3000);
            }

            

        })
    })

    $('.editbtn').click(function(event){
        editUser(event)
    })

    $('.delete').click(function(event){
        deleteUser(event)
    })

    function editUser(event){
        let user_id = $(event.target).closest('tr').find('.user_id').val()
        let user_name = $(event.target).closest('tr').find('.username').text()
        let user_email = $(event.target).closest('tr').find('.useremail').text()
        let role_id= $(event.target).closest('tr').find('.role_id').val()
        
       

        $('#user').val(user_name)
        $('#useremail').val(user_email)
        $('#userid').val(user_id)
        $('#save').text('Edit User')
        $('#active_roles').val(role_id);
    }

    function deleteUser(event){
        let user_id = $(event.target).closest('tr').find('.user_id').val()

        $.ajax({
            type : 'GET',
            url : `user/delete`,
            data : {
              user_id : user_id
            },

            success:function(response){
                console.log(response)

                $(`#${user_id}`).remove()
                
            },

            error:function(xhr, status , err){
                console.log(xhr)
                $('#feedback').html(xhr.responseJSON.message)
                setTimeout(function() {
                    $('#feedback').html('')
                }, 3000);
            }

            

        })

        
    }
})