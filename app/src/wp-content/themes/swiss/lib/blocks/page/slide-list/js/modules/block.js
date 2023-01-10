import Flickity from "flickity";
const cardslideshow = {
    elements: [],

    sliderOptions: {
        contain: true,
        groupCells: true,
        prevNextButtons: true,
        pageDots: false
    },

    init: function() {
        if (!Flickity) {
            // that's required.
            return false;
        }

        this.capture();

        if (this.elements.length > 0) {
            for (var i = this.elements.length - 1; i >= 0; i--) {
                this.setup(this.elements[i]);
            }
        }

        var flickityButtons = document.querySelectorAll('.flickity-prev-next-button');
        flickityButtons.forEach(function(button) {
            button.setAttribute('aria-hidden', 'true');
            button.setAttribute('tabindex', '-1');
        });
    },

    capture: function() {
        this.elements = document.querySelectorAll(".js-card-slideshow");
    },

    setup: function(el) {
        const flky = new Flickity(el, this.sliderOptions);

        flky.on("dragStart", function() {
            cardslideshow.introHide(this);
        });

        flky.on("settle", function() {
            cardslideshow.introShow(this);
        });

        flky.on("select", function() {
            cardslideshow.introToggle(this);
        });
    },

    introToggle: function(flkty) {
        if (flkty.selectedIndex < 1) {
            flkty.element.parentNode.parentNode.parentNode.classList.add(
                "has-intro-visible"
            );
        } else {
            flkty.element.parentNode.parentNode.parentNode.classList.remove(
                "has-intro-visible"
            );
            flkty.element.parentNode.parentNode.parentNode.classList.add(
                "has-intro-behind"
            );
        }
    },

    introHide: function(flkty) {
        flkty.element.parentNode.parentNode.parentNode.classList.add(
            "has-intro-behind"
        );
    },

    introShow: function(flkty) {
        if (flkty.selectedIndex < 1) {
            flkty.element.parentNode.parentNode.parentNode.classList.remove(
                "has-intro-behind"
            );
            flkty.element.parentNode.parentNode.parentNode.classList.add(
                "has-intro-visible"
            );
        }
    }
};

cardslideshow.init();

$(".c-slideshow-card")
    .mouseenter(function() {
        var elem = $(this).find(".c-slideshow-card__description");
        if (elem[0]) {
            var height = elem[0].scrollHeight;
            elem.css("height", height + "px");
        }
    })
    .mouseleave(function() {
        var elem = $(this).find(".c-slideshow-card__description");
        if (elem[0]) {
            elem.css("height", "0px");
        }
    });
