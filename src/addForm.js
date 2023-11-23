let btnAdd = document.querySelector(".btnAdd");
let formContainer = document.querySelector(".formContainer");
let page = document.querySelector(".page"); // Corrected selector
let close = document.querySelector(".formClose");

btnAdd.addEventListener("click", () => {
    page.classList.add("blur"); // Add a class to blur the background
    formContainer.style.display = "flex"; // Display the form
    console.log("clicked!");
});

close.addEventListener("click", () => {
    formContainer.style.display = "none"; // Close the form
    page.classList.remove("blur"); // Remove the class to remove the background blur
});



