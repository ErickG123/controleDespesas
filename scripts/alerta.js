document.addEventListener("DOMContentLoaded", function () {
    var alertElement = document.getElementById("alert");
    if (alertElement) {
        alertElement.classList.add("transition-transform", "duration-500", "transform", "translate-x-full");

        setTimeout(function () {
            alertElement.classList.remove("translate-x-full");
        }, 100);

        setTimeout(function () {
            alertElement.classList.add("translate-x-full");

            setTimeout(function () {
                alertElement.remove();
            }, 500);
        }, 4500);
    }
});
