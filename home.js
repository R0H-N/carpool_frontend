document.addEventListener("DOMContentLoaded", function() {
<<<<<<< HEAD
<<<<<<< HEAD
=======
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
  
=======
>>>>>>> 2e6c334a3e7c26f92326f0e4b9e087e2d0467b4c
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
<<<<<<< HEAD
=======
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
  
>>>>>>> 0b047e623e75fe026d3a8dad779b1d2ec18757d9
=======
>>>>>>> origin/main
>>>>>>> 2e6c334a3e7c26f92326f0e4b9e087e2d0467b4c
