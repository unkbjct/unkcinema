window.onload = function () {
    if (document.getElementById("add-comment")) {
        document.getElementById("add-comment").addEventListener("click", function () {
            document.getElementById("add-comment-form").classList.remove("visually-hidden")
            this.parentElement.parentElement.after(document.getElementById("add-comment-form"))
            document.getElementById("isAnswer").classList.add("visually-hidden");
            document.getElementById("parent-id").value = null;
        })
    }

    if (document.getElementById("btn-close-form")) {
        document.getElementById("btn-close-form").addEventListener("click", function () {
            document.getElementById("add-comment-form").classList.add("visually-hidden")
        })
    }

    document.querySelectorAll(".btn-answer").forEach(btn => {
        btn.addEventListener("click", function () {
            console.log(document.getElementById("add-comment-form"))
            console.log(this.parentElement.parentElement.parentElement);
            this.parentElement.parentElement.parentElement.after(document.getElementById("add-comment-form"))
            document.getElementById("add-comment-form").classList.remove("visually-hidden")
            document.getElementById("isAnswer").classList.remove("visually-hidden");
            document.getElementById("answer-login").textContent = this.dataset.parentLogin;
            document.getElementById("parent-id").value = this.dataset.parentId;
        })
    })


}

