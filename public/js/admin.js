document.addEventListener('DOMContentLoaded', function () { // Аналог $(document).ready(function(){
    if (document.querySelectorAll(".btn-ani-remove")) {
        document.querySelectorAll(".btn-ani-remove").forEach(btn => {
            var startTime;
            btn.addEventListener("mousedown", function (event) {
                startTime = Date.now();
            })
            btn.addEventListener("mouseup", function (event) {
                let differance = Date.now() - startTime;
                if (differance > 1500) {
                    if (document.getElementById("form-remove-" + this.dataset.id))
                        document.getElementById("form-remove-" + this.dataset.id).submit();
                }
            })

        })
    }
});