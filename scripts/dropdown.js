document.addEventListener("click", function (event) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var isClickInside = false;

    for (var i = 0; i < dropdowns.length; i++) {
        if (dropdowns[i].parentElement.contains(event.target)) {
            isClickInside = true;
        } else {
            dropdowns[i].style.display = "none";
        }
    }

    if (!isClickInside) {
        for (var i = 0; i < dropdowns.length; i++) {
            dropdowns[i].style.display = "none";
        }
    }
});

document.querySelectorAll(".dropdown").forEach(function (dropdown) {
    dropdown.addEventListener("click", function (event) {
        event.stopPropagation();
        var dropdownContent = this.querySelector(".dropdown-content");
        dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
    });
});
