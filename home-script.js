function myFunction() {
  var id = document.getElementById("addSel").value;
  // Returns successful data submission message when the entered information is stored in database.
  var dataString = 'id1=' + id;
  // AJAX code to submit form.
  if (id == '') {
    alert("Please Select A Sticker Album");
  } else {
    $.ajax({
      type: "POST",
      url: "getAlbum.php",
      data: dataString,
      cache: false,
      success: function(html){location.reload();}
    });
  }
  return false;
}
function getSticker(id){
  var dataString = 'id2=' + id;
  $.ajax({
    type: "POST",
    url: "buy.php",
    data: dataString,
    cache: false,
    success: function(html){location.reload();}
  });
}
function sellSticker(){
  var id = document.getElementById("addSell").value;
  // Returns successful data submission message when the entered information is stored in database.
  var dataString = 'id3=' + id;
  // AJAX code to submit form.
  if (id == '') {
    alert("Please Select A Sticker to Sell");
  } else {
    console.log(id);
    $.ajax({
      type: "POST",
      url: "sellSticker.php",
      data: dataString,
      cache: false,
      success: function(html){location.reload();}
    });
  }
  return false;
}
