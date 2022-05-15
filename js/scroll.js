$(".scroll-right, .scroll-left").each((index, value) => {
    if($(value).closest(".product-gallery div").innerWidth() < $(value).closest(".product-gallery").innerWidth()) {
        $(value).hide();
    } else {
        $(value).show();
    }
});

$(window).on('resize', () => {
    $(".scroll-right, .scroll-left").each((index, value) => {
        if($(value).closest(".product-gallery div").innerWidth() < $(value).closest(".product-gallery").innerWidth()) {
            $(value).hide();
        }   else {
            $(value).show();
        }
    })
});

$('.scroll-right').on("click", (e) => {
    e.preventDefault();
    $(e.target).closest(".product-gallery").scrollLeft($(e.target).closest(".product-gallery").scrollLeft() + $(e.target).closest(".product-gallery").innerWidth());

    if ($(e.target).closest(".product-gallery")[0].offsetWidth + $(e.target).closest(".product-gallery").scrollLeft() + $(e.target).closest(".product-gallery").innerWidth() >= $(e.target).closest(".product-gallery")[0].scrollWidth) {
        $(e.target).closest(".scroll-right").hide();
    }

    if($(e.target).closest(".product-gallery").scrollLeft() + $(e.target).closest(".product-gallery").innerWidth() > 0) {
        $(e.target).closest(".scroll-right").siblings(".scroll-left").show();
    }
    
});

$('.scroll-left').on("click", (e) => {
    e.preventDefault();
    $(e.target).closest(".product-gallery").scrollLeft($(e.target).closest(".product-gallery").scrollLeft() - $(e.target).closest(".product-gallery").innerWidth());
    
    if($(e.target).closest(".product-gallery").scrollLeft() - $(e.target).closest(".product-gallery").innerWidth() <= 0) {
        $(e.target).closest(".scroll-left").hide();
    }

    if($(e.target).closest(".product-gallery")[0].offsetWidth + $(e.target).closest(".product-gallery").scrollLeft() - $(e.target).closest(".product-gallery").innerWidth() < $(e.target).closest(".product-gallery")[0].scrollWidth) {
        $(e.target).closest(".scroll-left").siblings(".scroll-right").show();
    }

});