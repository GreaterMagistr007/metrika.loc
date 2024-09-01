<script>
    // Показываем или скрываем содержимое карточки .hidden-card по клику на .card-toggler
    document.querySelectorAll('.hidden-card').forEach(function (cardBody) {
        cardBody.querySelectorAll('.card-toggler').forEach(function (toggler) {
            toggler.addEventListener('click', function (el) {
                event.stopPropagation();
                cardBody.querySelectorAll('.row').forEach(function (elem) {
                    elem.classList.toggle('hidden');
                });
            });
        });
    });
</script>

<script>
    //Маска номера телефона
    function mask(event) {
        var matrix = "+7 (___) ___-__-__",
            i = 0,
            def = matrix.replace(/\D/g, ""),
            val = this.value.replace(/\D/g, "");
        if (def.length >= val.length) val = def;
        this.value = matrix.replace(/./g, function (a) {
            return /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? "" : a
        });
        // console.log(this.value);
        if (event.type == "blur") {
            if (this.value.length == 2) this.value = ""
        } else setCursorPosition(this.value.length, this)
    };

    function set_phone_mask(elem){
        if(!elem){return false;}
        elem.addEventListener("input", mask, false);
        elem.addEventListener("focus", mask, false);
        elem.addEventListener("blur", mask, false);
    }

    //Вешаем маску на блок с номером телефона:
    window.addEventListener("load", function () {
        document.querySelectorAll("input.phone").forEach(function(el){
            set_phone_mask(el);
        });
    });
</script>
