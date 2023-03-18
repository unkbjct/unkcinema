window.onload = function () {
    if (document.getElementById("add-attribute")) {
        document.getElementById("add-attribute").addEventListener("click", function () {
            let value = document.getElementById("value-attribute").value;
            let repeat = false;

            document.querySelectorAll(".attributes-item").forEach(item => {
                if (item.children[0].textContent == value) repeat = true;
            })

            document.getElementById("value-attribute").select()

            if (repeat || !value) return;
            let element =
                '<div data-bs-theme="dark" class="attributes-item">' +
                `<div class="me-4">${value}</div>` +
                `<input type="hidden" name="attributes[]" value="${value}">` +
                '<button title="Удалить" type="button" class="btn-close" aria-label="Close"></button>' +
                '</div>'
            document.getElementById("attributes-list").insertAdjacentHTML("afterbegin", element);
        })
    }

    if (document.getElementById("attributes-list")) {
        document.getElementById("attributes-list").addEventListener("click", function (e) {
            if (!e.target.classList.contains("btn-close")) return;

            e.target.parentElement.remove()
        })
    }
}