$(document).ready(function(){
  // dynamisch beewaybewerken.html inladen
  let num = 1;

  while (num < 9) {
    var planning = "<div><input type=hidden name=planingid value=" + num + "><textarea type=text name=planning" + num + " rows=2 maxlength=74></textarea></div>";
    var wat = "<div><textarea type=text name=planningwat" + num + " rows=2 maxlength=74></textarea></div>";
    var wie = "<div><textarea type=text name=planningwie" + num + " WieTxt rows=2 maxlength=74></textarea></div>";
    var deadline = "<div><textarea type=text name=planningdeadline" + num + " rows=2 maxlength=74></textarea></div>";
    var done = "<div><input type=checkbox name=planninggedaan" + num + "></div>";

    $("#planning").append(planning);
    $("#wat").append(wat);
    $("#wie").append(wie);
    $("#deadline").append(deadline);
    $("#done").append(done);

    num ++;
  }
  while (num !== 14) {
    var observatie = "<div><input type=hidden name=observatieid value=" + num + "><textarea type=text name=observatietxt" + num + " rows=3 maxlength=155></textarea></div>";
    var leerdoel = "<div><textarea type=text name=leerdoeltxt" + num + " rows=3 maxlength=155></textarea></div>";
    var evaluatie = "<div><textarea type=text name=evaluatietxt" + num + " rows=3 maxlength=155></textarea></div>";
    var werkdoel = "<div><textarea type=text name=werkdoeltxt" + num + " rows=3 maxlength=155></textarea></div>";
    var actie = "<div><textarea type=text name=actietxt" + num + " rows=3 maxlength=155></textarea></div>";

    $("#observatie").append(observatie);
    $("#leerdoel").append(leerdoel);
    $("#evaluatie").append(evaluatie);
    $("#werkdoel").append(werkdoel);
    $("#actie").append(actie);

    num ++;
  }
  const checkbox = document.getElementById("my-checkbox");

  checkbox.addEventListener("click", function(event) {
    if (checkbox.checked) {
      if (!window.confirm("Weet je zekker dat je deze beeway als afgerond wilt markeren!? Je kan deze dan niet meer bewerken")) {
        event.preventDefault();
      }
    } else {
      if (!window.confirm("Weet je zekker dat je deze beeway niet langer wilt markeren als afgerond!?")) {
        event.preventDefault();
      }
    }
  });
}); // end document ready

function handledata(result, div){
  // alert(result);
}
