let close = document.querySelector(".formClose");

close.addEventListener("click", function() {
    const urlParams = new URLSearchParams(window.location.search);
    const archived = urlParams.get("archived");
    
    if (archived === "0") {
        window.location.href = "index.php";
    }

    if (archived === "1") {
        window.location.href = "archive.php";
    }
});
