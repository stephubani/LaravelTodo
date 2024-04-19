$(document).ready(function (){
    $('#create').click(function (){
        let role_name = $('#rolesname').val()
        let role_id = $('#roleid').val()
        let data = {
            role_name : role_name
        }

        if(role_id != ''){
            data.role_id= role_id
        }

        // console.log(data)
        // return

        $.ajax({
            type: "GET",
            url: "/roles/create",
            data: {
                data
                
            },

            success: function(response) {
                console.log(response)
                let html = ''
                if(role_id == ''){
                    html += `<tr id='${response.id}'>`
                }
                html += `
                
                    <td class='rolesname'>${response.name}</td>
                    <td><button id= 'click' class='btn ${response.is_active ? 'btn-warning' : 'btn-secondary'} '>
                        ${response.is_active ? 'Active' : 'Inactive'}</button></td>
                    <td>
                        <button class='btn editbtn' id='editbtn${response.id}'>
                            <input type="hidden" name="" class='rolesid' value='${response.id}'>
                    <i class="fa-solid fa-pen"></i>
                    </button>

                    <button class='btn delete' id='delete_btn${response.id}'>
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


                document.getElementById(`editbtn${response.id}`).addEventListener('click' , editRole)
                document.getElementById(`delete_btn${response.id}`).addEventListener('click' , deleteRole)

              
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
                $(`#${role_id}`).remove()
              
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

    function changeRoleStatus(event){
        let role_id = $(event.target).closest('tr').find('.rolesid').val()


    }
    
})