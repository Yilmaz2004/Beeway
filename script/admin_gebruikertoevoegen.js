var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}

document.addEventListener("DOMContentLoaded", function() {
  const select = document.getElementById("rolselect");
  const input = document.getElementById("klassenselect");

  select.addEventListener("change", function() {
    if (select.value === "1") {
      input.style.display = "none";
    } else {
      input.style.display = "";
    }
  });
});
