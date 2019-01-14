$(".js-show-tags-mobile").click(function() {
    $(this)
        .siblings(".b-taglist__container")
        .toggleClass("active");
    $(this).toggleClass("active");
});
