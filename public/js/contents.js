document.addEventListener("DOMContentLoaded", function () {

    var seasonsCount = 0;

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
            if ((Boolean)((Number)(this.options[this.selectedIndex].dataset.isOneVideo))) {
                document.getElementById("is-one-video-0").classList.add("visually-hidden")
            } else {
                document.getElementById("is-one-video-1").classList.add("visually-hidden")
            }
            if (this.options[this.selectedIndex].dataset.isOneVideo) document.getElementById("is-one-video-" + this.options[this.selectedIndex].dataset.isOneVideo).classList.remove("visually-hidden")

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

    if (document.getElementById("add-season")) {
        document.getElementById("add-season").addEventListener("click", function () {
            seasonsCount++;
            let element =
                '<div class="accordion-item">' +
                '<h2 class="accordion-header">' +
                '<button class="accordion-button" type="button" data-bs-toggle="collapse"' +
                `data-bs-target="#collapseSeason${seasonsCount}"><span class="number-season">${seasonsCount} Сезон</span></button>` +
                '</h2>' +
                `<div id="collapseSeason${seasonsCount}" class="accordion-collapse collapse show">` +
                '<div class="accordion-body">' +
                '<div class="d-flex">' +
                `<button type="button" data-episodes-count="0" data-season="${seasonsCount}" class="btn btn-dark mb-3 add-episode">Добавить серию</button>` +
                '<button type="button" class="btn btn-outline-danger ms-auto mb-3 remove-season">Удалить сезон</button>' +
                '</div>' +
                '<ul class="list-group">' +
                '</ul>' +
                '</div>' +
                '</div>' +
                '</div>'
            document.getElementById("seasons-list").insertAdjacentHTML("afterbegin", element)
        })
    }

    if (document.getElementById("seasons-list")) {
        // console.log(this.querySelectorAll())
        this.getElementById("seasons-list").addEventListener("click", function (e) {
            if (e.target.classList.contains("add-episode")) {
                let btn = e.target;
                btn.dataset.episodesCount++;
                element =
                    '<li class="list-group-item list-group-item-action" aria-current="true">' +
                    '<div class="row gy-4">' +
                    '<div class="col-md-2">' +
                    `<div class="h-100 d-flex align-items-center"><div><span class="number">${btn.dataset.episodesCount}</span> Серия</div></div>` +
                    '</div>' +
                    '<div class="col-md-8">' +
                    '<div>' +
                    `<input type="file" required name="episodes[${btn.dataset.season}][${btn.dataset.episodesCount}]" id="" class="form-control form-control-sm episode-video">` +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-2">' +
                    '<div class="d-flex">' +
                    '<button type="button" class="btn btn-sm btn-danger ms-auto remove-episode">Удалить</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</li>'
                btn.parentElement.nextSibling.insertAdjacentHTML("afterbegin", element)
            }
            if (e.target.classList.contains("remove-episode")) {
                let btn = e.target;
                list = btn.parentElement.parentElement.parentElement.parentElement.parentElement.children;
                btnAdd = btn.parentElement.parentElement.parentElement.parentElement.parentElement.previousSibling.children[0];
                btn.parentElement.parentElement.parentElement.parentElement.remove();

                btnAdd.dataset.episodesCount = list.length;
                let length = list.length;
                for (i = 0; i < list.length; i++) {
                    list[i].querySelectorAll(".number")[0].textContent = length
                    list[i].querySelectorAll(".episode-video")[0].setAttribute("name", `episodes[${btnAdd.dataset.season}][${length}]`)

                    length--;
                }
            }
            if (e.target.classList.contains("remove-season")) {
                e.target.parentElement.parentElement.parentElement.parentElement.remove();
                seasonsCount--;
                let length = seasonsCount;
                list = document.getElementById("seasons-list").children;
                for (i = 0; i < list.length; i++) {
                    list[i].querySelector(".accordion-button").dataset.bsTarget = `#collapseSeason${length}`;
                    list[i].querySelector(".accordion-collapse").id = `collapseSeason${length}`;
                    list[i].querySelector(".add-episode").dataset.season = length;
                    list[i].querySelector(".number-season").textContent = length + " Сезон";
                    let episodesLength = list[i].querySelector(".add-episode").dataset.episodesCount;
                    list[i].querySelectorAll(".list-group-item").forEach(item => {
                        item.querySelector(".episode-video").setAttribute("name", `episodes[${length}][${episodesLength}]`)
                        episodesLength--;
                    })
                    length--;
                }
            }
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