function HandleApiCall(callback, func, txtJSON, target = "") { // dynamische handleApiCall functie om api aan te roepen

  const key = func;
  const data = {[key] : txtJSON};

  $.ajax({
    type: "POST",
    url: "http://192.168.1.95//Beeway/php/api.php",
    data: data,
    cache: false,
    crossDomain: true,
    success: function (msg) {
      callback(msg, target);
    }
  });
}
