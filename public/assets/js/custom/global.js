$('.save').click(function(){
    $('.save').addClass('d-none');
    $('.btn-loading').removeClass('d-none');
});


$('#show-password-register').click(function(e){
    e.preventDefault();

    $('#password_register').attr('type', 'text');
    $('#hide-password-register').removeClass('d-none');
    $('#show-password-register').addClass('d-none');
});


$('#hide-password-register').click(function(e){
    e.preventDefault();

    $('#password_register').attr('type', 'password');
    $('#show-password-register').removeClass('d-none');
    $('#hide-password-register').addClass('d-none');
});

$('#show-confirm-password-register').click(function(e){
    e.preventDefault();

    $('#password_confirm_register').attr('type', 'text');
    $('#hide-confirm-password-register').removeClass('d-none');
    $('#show-confirm-password-register').addClass('d-none');
});


$('#hide-confirm-password-register').click(function(e){
    e.preventDefault();

    $('#password_confirm_register').attr('type', 'password');
    $('#show-confirm-password-register').removeClass('d-none');
    $('#hide-confirm-password-register').addClass('d-none');
});


$('#show-password-login').click(function(e){
    e.preventDefault();

    $('#password').attr('type', 'text');
    $('#hide-password-login').removeClass('d-none');
    $('#show-password-login').addClass('d-none');
});


$('#hide-password-login').click(function(e){
    e.preventDefault();

    $('#password').attr('type', 'password');
    $('#show-password-login').removeClass('d-none');
    $('#hide-password-login').addClass('d-none');
});


function deleteElement(id, url, token){
    swal({
        title: $('#are_you_sure_to_delete').val(),
        text: $('#this_action_is_irreversible').val(),
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: $('#yes_delete_it').val(),
        closeOnConfirm: false
    },
    function(){
        swal({
          title : $('#deleted').val(),
          text : $('#the_item_was_successfully_deleted').val(),
          type : "success",
        }, function(){
          //$('#form_phone_delete').submit();
          //console.log(id);
          //console.log(url);
          //console.log(token);
          var inputs = '';
          inputs += '<input type="hidden" name="id_element" value="' + id + '" />'
                    + '<input type="hidden" name="_token" value="' + token + '" />';

          $("body").append('<form action="' + url + '" method="POST" id="poster">' + inputs + '</form>');
          $("#poster").submit();
        });
    });
}

function deleteElement3(id, url, token){
    swal({
        title: $('#are_you_sure_to_delete').val(),
        text: $('#this_action_is_irreversible').val(),
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: $('#yes_delete_it').val(),
        closeOnConfirm: false
    },
    function(){
        swal({
          title : $('#deleted').val(),
          text : $('#the_item_was_successfully_deleted').val(),
          type : "success",
        }, function(){
          //$('#form_phone_delete').submit();
          //console.log(id);
          //console.log(url);
          //console.log(token);
          var inputs = '';
          inputs += '<input type="hidden" name="id_element" value="' + id + '" />'
                    + '<input type="hidden" name="_token" value="' + token + '" />';

          $("body").append('<form action="' + url + '" method="POST" id="poster">' + inputs + '</form>');
          $("#poster").submit();
        });
    });
}

function readNotification(id, url, token){
    var inputs = '';
    inputs += '<input type="hidden" name="id_element" value="' + id + '" />'
              + '<input type="hidden" name="_token" value="' + token + '" />';

    $("body").append('<form action="' + url + '" method="POST" id="posterNotif">' + inputs + '</form>');
    $("#posterNotif").submit();
}

function displayNotifications()
{
  $url = $('#display-notif').val();
  //console.log($url);
  window.location.replace($url);
}


function getPermission(id, name, isPermision)
{
    //console.log("name : " + name + "\nisPermission : " + isPermision);

    $('#user-mgmt-target').text(name);
    $('#id-user-mgmt').val(id);

    isPermision == 1 ? $('#mgmt-permission').attr('checked', true) : $('#mgmt-permission').attr('checked', false);

}

$('#save-mgmt-btn').click(function(e){
    e.preventDefault();

    $('#mgmt-form').submit();
});


function setConsultation(id_user, id_document, id_room, token, url)
{
    /* console.log('Id user : ' + id_user +
            '\nId document : ' + id_document + '\nId room : ' + id_room +
            '\nToken : ' + token + '\nRoute : ' + url);
    */

    $.ajax({
        type : 'post',
        url : url,
        data : {
            '_token' : token,
            'id_user' : id_user,
            'id_document' : id_document,
            'id_room' : id_room
        },
        success:function(response)
        {
            //console.log(response.consultation);
        }
    });
}
