function toggleDateFields() {
  var select = document.getElementById("report");
  var dateFields = document.getElementById("date-fields");
  var categoryField = document.getElementById("category-field");

  if (select.value == "demographics") {
    dateFields.style.display = "none";
    categoryField.style.display = "none";
  } else if (select.value == "sales") {
    dateFields.style.display = "block";
    categoryField.style.display = "block";
  } else {
    dateFields.style.display = "block";
    categoryField.style.display = "none";
  }
}
