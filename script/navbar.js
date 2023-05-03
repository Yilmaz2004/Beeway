var menulist = document.getElementById('menulist')
var menu = document.getElementById('menu')

menulist.style.height = '60px';
menu.style.display = 'none';
menu1.style.display = 'none';

function toggleresponsivemenu() {
  if (menulist.style.height == '60px') {
      menulist.style.height = '100%';
  }
  else {
    menulist.style.height = '60px';
  }
}

function togglemenu() {
  if (menu.style.display == 'none') {
      menu.style.display = 'block';
  }
  else {
    menu.style.display = 'none';
  }
}

function togglemenu1() {
  if (menu1.style.display == 'none') {
      menu1.style.display = 'block';
  }
  else {
    menu1.style.display = 'none';
  }
}

var radios = document.getElementsByTagName('input');
for(i=0; i<radios.length; i++ ) {
    radios[i].onclick = function(e) {
        if(e.ctrlKey || e.metaKey) {
            this.checked = false;
        }
    }
}


$(document).ready(function() {
  $("#logoutbtn").on("click", function(){
    event.preventDefault();

    var obj = {'Token' : sessionStorage.getItem("token")};
    const myJSON = JSON.stringify(obj);
    HandleApiCall(handlelogoutdata, "Logout", myJSON);

    sessionStorage.clear();
    window.location.replace("http://192.168.1.95/beeway/login.html");
  })


  function dateTime() { // display Good Morning/Afternoon/Evening
    var ndate = new Date();
    var hours = ndate.getHours();
    var message = hours < 12 ? 'Goedemorgen!' : hours < 18 ? 'Goedemiddag!' : 'Goedeavond!';
    $("h2.day-message").text(message);
  }

  setInterval(dateTime, 1000);
}); // end document ready

function handlelogoutdata (result, div){
  if (result == "NOK") {
    $("#errormsg").html("er was iets mis gegaan, pech!");
  }
}

Number.prototype.leadingZeroes = function(len) {
  return (new Array(len).fill('0', 0).join('') + this).slice(-Math.abs(len));
}
