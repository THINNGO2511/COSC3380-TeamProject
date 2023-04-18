function toggleDateFields() {
  var select = document.getElementById("report");
  var dateFields = document.getElementById("date-fields");
  var hintField = document.getElementById("hint");

  if (select.value == "demographics") {
    dateFields.style.display = "none";
    hintField.style.display = "none";
  } else {
    dateFields.style.display = "block";
    hintField.style.display = (select.value == "sales" || select.value == "best_sellers" || select.value == "best_categories") ? "block" : "none";
  }
}
