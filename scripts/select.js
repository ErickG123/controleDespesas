function toggleOptions(nomeInput) {
    var options = document.getElementById("options" + nomeInput);
    options.classList.toggle("hidden");
}

function updateSelectedText(nomeInput) {
    var checkboxes = document.querySelectorAll(`input[name="${nomeInput}[]"]:checked`);
    var values = Array.from(checkboxes).map(function (checkbox) {
        return checkbox.nextElementSibling.textContent;
    });

    var selectedText = document.getElementById("selectedText" + nomeInput);
    selectedText.textContent = values.length > 0 ? values.join(", ") : "Opções";
    selectedText.classList.toggle("truncate", values.length > 0);
}

function filterOptions(nomeInput) {
    var input = document.getElementById("searchInput" + nomeInput);
    var filter = input.value.toUpperCase();
    var options = document.getElementById("options" + nomeInput);
    var labels = options.getElementsByTagName("label");

    for (var i = 0; i < labels.length; i++) {
        var labelInnerText = labels[i].innerText || labels[i].textContent;
        labels[i].style.display = labelInnerText.toUpperCase().indexOf(filter) > -1 ? "" : "none";
    }
}

document.addEventListener("click", function (event) {
    var dropdowns = document.querySelectorAll("[id^='dropdown']");
    dropdowns.forEach(function (dropdown) {
        var options = dropdown.querySelector("[id^='options']");
        if (options && !dropdown.contains(event.target)) {
            options.classList.add("hidden");
        }
    });
});
