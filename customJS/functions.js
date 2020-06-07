 // $(document).ready(function(){ 	
 //      var error = '<?php echo $error; ?>';  // get the $_GET param if failed login
 //      var password_changed = '<?php echo $password_changed; ?>';
 //      console.log(error);

   
 //      //add the text to the empty input-field for the error message
 //      if(error || error.length !== 0 ){
 //        if(error == 'There is a registration with that email'){
 //          $('#register_info').text(error);  
 //        }else if(error == 'Message sent'){
 //          //message info when mail is send
 //          $('#message_info').text(error);
 //          sessionStorage.removeItem('subject', 'textarea');
 //          sessionStorage.removeItem('textarea');
 //        }else if(error == 'Successfully logged out'){
 //          sessionStorage.clear();
 //        }else{
 //          //user has error for access/sign via the form
 //          $('#login_info').text(error);
 //        }        
 //      }

 //      if(password_changed == 'success'){
 //        $('#pass_reset').css('display', 'block');
 //      }


 //      var email_login_session = (sessionStorage.getItem('email_login') != 'undefined') ? sessionStorage.getItem('email_login') : '';  
 //      var firstName_session = (sessionStorage.getItem('firstName') != 'undefined') ? sessionStorage.getItem('firstName') : '';  
 //      var lastName_session = (sessionStorage.getItem('lastName') != 'undefined') ? sessionStorage.getItem('lastName') : '';  
 //      var subject_session = (sessionStorage.getItem('subject') != 'undefined') ? sessionStorage.getItem('subject') : '';
 //      var email_session = (sessionStorage.getItem('email_reg') != 'undefined') ? sessionStorage.getItem('email_reg') : '';
 //      var textarea_session = (sessionStorage.getItem('textarea') != 'undefined') ? sessionStorage.getItem('textarea') : '';

 //      //Retype the 2-forms-fields with the sessionStorage      
 //        $('#email_login').val(email_login_session);
 //        $('#firstName').val(firstName_session);
 //        $('#lastName').val(lastName_session);
 //        $('#subject').val(subject_session);
 //        $('#email_reg').val(email_session);
 //        $('#textarea').text(textarea_session);
 //          // var textarea = $('#textarea').val();
 //          // textarea != '' || textarea != undefined ? $('#textarea').text(textarea_session) : '' ;
          

    
 //      //save the send-email-field-data for the session on input-change
 //      $('#email_login, #firstName, #lastName, #subject, #email_reg, #textarea').on('change', function(){
 //        sessionStorage.setItem('email_login', $('#email_login').val());
 //        sessionStorage.setItem('firstName', $('#firstName').val());
 //        sessionStorage.setItem('lastName', $('#lastName').val());
 //        sessionStorage.setItem('subject', $('#subject').val());
 //        sessionStorage.setItem('email_reg', $('#email_reg').val());
 //        sessionStorage.setItem('textarea', $('#textarea').val());        
 //      });


 //      // function passwordCompare(pass, repass){
 //      //   console.log(pass+repass);
 //      // }

 //      // $('#password_reg, #repassword').on('keyup', function(){
 //      //   passwordCompare($('#password_reg').val(), $('#repassword').val());
 //      // });


 //      //Password vs repassword
 //      var register_check = false;
 //      $('#password_reg, #repassword').on('keyup', function () {
 //        if ($('#password_reg').val() == $('#repassword').val()) {
 //          if($('#password_reg').val().length < 6){
 //            $('#message').html('Password must be at least 6 characters').css('color', 'red');
 //            register_check = false;
 //          }else{
 //           $('#message').html('').css('color', '');
 //           register_check = true;
 //          }
 //          // $('#message').html('').css('color', '');          
 //        } else {
 //          register_check = false;
 //          $('#message').html('Passwords don"t match').css('color', 'red');
 //        }
 //      });

 //       $('#formRegister').submit(function(event){
 //        if(register_check == false){
 //          event.preventDefault();
 //        }
 //      });



 //      //ResetPassword vs ReResetpassword
 //      var reset_check = false;
 //      $('#resetpassword, #reresetpassword').on('keyup', function () {
 //        if ($('#resetpassword').val() == $('#reresetpassword').val()) {
 //          if($('#resetpassword').val().length < 6){
 //            $('#message').html('Password must be at least 6 characters').css('color', 'red');
 //            reset_check = false;
 //          }else{
 //            $('#message').html('').css('color', '');          
 //          reset_check = true;  
 //          }          
 //        } else{ 
 //          // $('#message').show();
 //          reset_check = false;
 //          $('#message').html('Passwords don"t match').css('color', 'red');
 //        }
 //      });

 //      $('#formReset').submit(function(event){
 //        if(reset_check == false){
 //          event.preventDefault();
 //        }
 //      });

 //    });//document ready