/**
 *
 * Function that executes whenever the admin changes the status of an application
 * An asynchronous call is made to the back end which changes an application's status and shoots out
 * an email the user regarding the change of status
 * 
 * @param id
 * @param status
 * @return void
 */
function changeStatus(id, status)
 {
     $.ajax({
         type: "POST",
         url: BASE_URL+'/application/action',
         data: {id:id,status:status},
         success: function(result){
            if(result){
                window.location.href=BASE_URL+'/application/'+id;
            }
         }
     });
 }
