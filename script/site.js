$(document).ready(function(){

  if (window.location.pathname !== "/Beeway/login.html") {
    var obj = {'Token' : sessionStorage.getItem("token")};
    const myJSON = JSON.stringify(obj);
    HandleApiCall(handlesessioncheckdata, "SessionCheck", myJSON);
  }

  $("#loginbtn").on("click", function(){
    event.preventDefault();

    var school = $("#schoolselect option:selected").val();
    var email = $("#email").val();
    var psw = $("#psw").val();

    var psw5 = $.md5(psw);

    var obj = {'Email' : email, 'Psw' : psw5, 'School' : school};
    const myJSON = JSON.stringify(obj);

    HandleApiCall(handlelogindata, "Login", myJSON);
  })

}); // end document ready

function handlesessioncheckdata (result) {
  if (result == "OK") { // session valid
    // nothing happens
  } else if (result == "NOK1") { // session expired
    var obj = {'Token' : sessionStorage.getItem("token")};
    const myJSON = JSON.stringify(obj);
    HandleApiCall(handlelogoutdata, "Logout", myJSON);

    sessionStorage.clear();
    sessionStorage.setItem("error", "session verlopen, log opnieuw in");
    window.location.replace("http://192.168.1.95/beeway/login.html");
  } else if (result == "NOK2") { // session not found
    sessionStorage.clear();
    sessionStorage.setItem("error", "session error, log opnieuw in");
    window.location.replace("http://192.168.1.95/beeway/login.html");
  } else {
    sessionStorage.clear();
    sessionStorage.setItem("error", "session error, log opnieuw in");
    window.location.replace("http://192.168.1.95/beeway/login.html");
  }
}

function handlelogindata (result, div) {
   alert(result);
  if (result == "NOK1") {
    $("#errormsg").html("Selecteer een school!");
  } else if (result == "NOK2") {
    $("#errormsg").html("Het email, wachtwoord of school komen niet overeen!");
  } else {
    const obj = JSON.parse(result);

    sessionStorage.setItem("token", obj['Token']);
    sessionStorage.setItem("voornaam", obj['Voornaam']);
    window.location.replace("http://192.168.1.95/beeway/beewaylijst.html");
  }
}
