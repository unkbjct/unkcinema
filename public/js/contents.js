document.addEventListener("DOMContentLoaded", function () {

    if (document.getElementById("type") && document.getElementById("type").value) {
        let attributes = JSON.parse(document.getElementById("type").options[document.getElementById("type").selectedIndex].dataset.attributes);
        attributes.forEach(attr => {
            let element =
                '<div class="attributes-item mb-3">' +
                `<label for="attribute-${attr.id}" class="form-label">${attr.name}</label>` +
                `<input type="text" class="form-control" name="attributes[${attr.id}]" id="attribute-${attr.id}">` +
                '<div class="form-text">Не Обязательное.</div>' +
                '</div>'
            document.getElementById("attributes-list").insertAdjacentHTML("afterbegin", element)
        });
        JSON.parse(document.getElementById("attributes-list").dataset.attributesValue).forEach(attr => {
            if ('attribute-' + attr.id) document.getElementById("attribute-" + attr.id).value = attr.value
        })
        // document.querySelectorAll("attributes-input").forEach(input => {

        // })
        // if (!this.options[this.selectedIndex].dataset.attributes) return;
    }

    if (document.getElementById("form-create") && document.getElementById("type")) {
        document.getElementById("type").addEventListener("change", function () {
            document.querySelectorAll(".attributes-item").forEach(item => {
                item.remove();
            })
            

            if (!this.options[this.selectedIndex].dataset.attributes) return;
            let attributes = JSON.parse(this.options[this.selectedIndex].dataset.attributes);
            attributes.forEach(attr => {
                let element =
                    '<div class="attributes-item mb-3">' +
                    `<label for="attribute-${attr.id}" class="form-label">${attr.name}</label>` +
                    `<input type="text" class="form-control" name="attributes[${attr.id}]" id="attribute-${attr.id}">` +
                    '<div class="form-text">Не Обязательное.</div>' +
                    '</div>'
                document.getElementById("attributes-list").insertAdjacentHTML("afterbegin", element)
            });
            if (this.value == document.getElementById("attributes-list").dataset.typeId) {
                JSON.parse(document.getElementById("attributes-list").dataset.attributesValue).forEach(attr => {
                    if ('attribute-' + attr.id) document.getElementById("attribute-" + attr.id).value = attr.value
                })
            }
            // console.log(attributes);
            // alert(123)
        })
    }

    

    if (document.getElementById("add-category")) {
        document.getElementById("add-category").addEventListener("click", function () {
            let value = document.getElementById("value-category").value;
            let text = document.getElementById("value-category").options[document.getElementById("value-category").selectedIndex].textContent
            let isRepeat = false;

            document.querySelectorAll(".categories-item").forEach(item => {
                if (item.children[0].textContent == text) isRepeat = true;
            })

            // document.getElementById("value-attribute").select()

            if (isRepeat || !value) return;
            let element =
                '<div class="categories-item">' +
                `<div class="me-3">${text}</div>` +
                `<input type="hidden" name="categories[]" value="${value}">` +
                '<button title="Удалить" type="button" class="btn-close" aria-label="Close"></button>' +
                '</div>'
            document.getElementById("categories-list").insertAdjacentHTML("afterbegin", element);
        })
    }

    if (document.getElementById("categories-list")) {
        document.getElementById("categories-list").addEventListener("click", function (e) {
            if (!e.target.classList.contains("btn-close")) return;
            e.target.parentElement.remove()
        })
    }
})
window.onload = function () {

}