document.addEventListener("DOMContentLoaded", function() {
    const hostOption = document.getElementById("host-option");
    const getOption = document.getElementById("get-option");
    const hostForm = document.getElementById("host-ride-form");
    const getForm = document.getElementById("get-ride-form");
    const container = document.getElementById("container");
  
    hostOption.addEventListener("click", function() {
      hostForm.style.display = "block";
      getForm.style.display = "none";
      hostOption.style.backgroundColor = "#000"; // Set background color to black
      getOption.style.backgroundColor = "#ddd";
      container.classList.remove("slide-left");
    });
  
    getOption.addEventListener("click", function() {
      getForm.style.display = "block";
      hostForm.style.display = "none";
      getOption.style.backgroundColor = "#000"; // Set background color to black
      hostOption.style.backgroundColor = "#ddd";
      container.classList.add("slide-left");
    });
  });