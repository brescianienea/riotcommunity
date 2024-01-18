const viewBtn = document.querySelector("#share-profile"),
        popup = document.querySelector(".popup"),
        close = popup.querySelector(".close"),
        field = popup.querySelector(".field"),
        input = field.querySelector("input"),
        copy = field.querySelector("button");

    viewBtn.onclick = () => {
        popup.classList.toggle("show");
    }
    close.onclick = () => {
        viewBtn.click();
    }

    copy.onclick = () => {
        input.select(); //select input value
        if (document.execCommand("copy")) { //if the selected text is copied
            field.classList.add("active");
            copy.innerText = "Copied";
            setTimeout(() => {
                window.getSelection().removeAllRanges(); //remove selection from page
                field.classList.remove("active");
                copy.innerText = "Copy";
            }, 3000);
        }
    }

    $('.share-facebook').on('click', function () {
        let currentURL = $(this).attr('url');
        window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(currentURL), 'facebook-share');

    });

    $('.share-whatsapp').on('click', function () {
        let currentURL = $(this).attr('url');
        let encodedURL = encodeURIComponent(currentURL);

        let whatsappURL = "https://wa.me/?text=Check out this page: " + encodedURL;

        window.open(whatsappURL);

    });

    $('.share-telegram').on('click', function () {
        var currentURL = $(this).attr('url');
        var encodedURL = encodeURIComponent(currentURL);

        var telegramURL = "tg://msg?text=Check out this page: " + encodedURL;

        window.open(telegramURL);

    });

    $('.share-twitter').on('click', function () {
        const currentURL = $(this).attr('url');

        window.open('https://twitter.com/intent/tweet?url=' + encodeURIComponent(currentURL), 'twitter-share');
    })