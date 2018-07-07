if (window.location.search.indexOf("loginerror") != -1) {
  $("#logInModal").modal("show");
}

var inputs = document.querySelectorAll("input");
inputs.forEach(input => {
  input.addEventListener("change", function(e) {
    if (e.target.value != "") {
      e.target.parentElement.children[1].classList.add("customclass");
      e.target.parentElement.children[1].style.color = "green";
    } else {
      e.target.parentElement.children[1].classList.remove("customclass");
      e.target.parentElement.children[1].style.color = "";
    }
  });
});

var resetButton = document.getElementById("reset");
if (resetButton != null) {
  resetButton.addEventListener("click", function() {
    var inputs = document.querySelectorAll("input");
    inputs.forEach(input => {
      input.parentElement.children[1].classList.remove("customclass");
      input.parentElement.children[1].style.color = "";
    });
  });
}

var editOperator = document.getElementById("edit_controller");
var editButton = document.getElementById("edit_button");
var oldClass = "btn-outline-success";
var newClass = "btn-outline-danger";
var tempClass;
var newEditOperatorText = "Close editing";
var oldEditOperatorText = "Open editing";
var tempEditOperatorText;
function editController() {
  if (editOperator != null) {
    inputs.forEach(input => {
      input.hasAttribute("disabled")
        ? input.removeAttribute("disabled")
        : input.setAttribute("disabled", "true");
    });
    editButton.classList.toggle("disabled");
    editOperator.classList.replace(oldClass, newClass);
    tempClass = newClass;
    newClass = oldClass;
    oldClass = tempClass;
    editOperator.innerText = newEditOperatorText;
    tempEditOperatorText = newEditOperatorText;
    newEditOperatorText = oldEditOperatorText;
    oldEditOperatorText = tempEditOperatorText;
  }
}

var trackEvents = document.querySelectorAll("button,a");
trackEvents.forEach(event => {
  event.addEventListener("click", function(e) {
    e = e || window.event;
    var target = e.target || e.srcElement;
    var text = target.textContent || target.innerText;
    gtag("event", "click", {
      event_label: text
    });
  });
});
