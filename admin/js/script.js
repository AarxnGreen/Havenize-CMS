$(document).ready(function() {
    $('#summernote').summernote({
      height: 200
    });
  });

$(document).ready(function(){
  $('#selectAllBoxes').click(function(event){
    if(this.checked) {

      $('.checkBoxes').each(function(){
        this.checked = true;
      });
    } 

    else {

      $('.checkBoxes').each(function(){
        this.checked = false;
      });
      
    }
  })
})

function loadUsersOnline() {

  $.get("includes/adminfunctions.php?onlineusers=result", function(data){

    $(".usersonline").text(data);

  });

}

loadUsersOnline();
// setInterval(function() {

//   loadUsersOnline();

// }, 1000)

