function confirmDelete(arg){
    var value = confirm("Are You Sure You Want To Delete ?");
    if(value){
      location.href = arg;
    }
  }