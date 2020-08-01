$(document).ready(function() {
    new WOW().init();

    var owl = $("#slider-service");

    owl.owlCarousel({
        pagination: false,
        items: 3, //10 items above 1000px browser width
        itemsDesktop: [1000, 3], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 2], // betweem 900px and 601px
        itemsTablet: [600, 1], //2 items between 600 and 0
        itemsMobile: false // itemsMobile disabled - inherit from itemsTablet option
    });

    // Custom Navigation Events
    $(".next").click(function() {
        owl.trigger('owl.next');
    })
    $(".prev").click(function() {
        owl.trigger('owl.prev');
    })
    $(".play").click(function() {
        owl.trigger('owl.play', 1000); //owl.play event accept autoPlay speed as second parameter
    })
    $(".stop").click(function() {
        owl.trigger('owl.stop');
    })
    $('#slide-service .item, .height').matchHeight();
    $('.map-block').click(function(event) {
        $(this).css({
            display: 'none',
        });
    });
    $('.menu').click(function(event) {
        $('.nav-responsive').css({
            top: '0'
        });
    });
    $('.nav-close').click(function(event) {

        $('.nav-responsive').css({
            top: '-1500px'
        });
    });

});
// Plugin Visiable
// (function(e) { e.fn.visible = function(t, n, r) {
//         var i = e(this).eq(0),
//             s = i.get(0),
//             o = e(window),
//             u = o.scrollTop(),
//             a = u + o.height(),
//             f = o.scrollLeft(),
//             l = f + o.width(),
//             c = i.offset().top,
//             h = c + i.height(),
//             p = i.offset().left,
//             d = p + i.width(),
//             v = t === true ? h : c,
//             m = t === true ? c : h,
//             g = t === true ? d : p,
//             y = t === true ? p : d,
//             b = n === true ? s.offsetWidth * s.offsetHeight : true,
//             r = r ? r : "both";
//         if (r === "both") return !!b && m <= a && v >= u && y <= l && g >= f;
//         else if (r === "vertical") return !!b && m <= a && v >= u;
//         else if (r === "horizontal") return !!b && y <= l && g >= f } })(jQuery)
// jQuery(window).scroll(function(event) {

//     jQuery(".wow").each(function(i, el) {
//         var el = jQuery(el);
//         if (el.visible(true)) {
//             new WOW().init();
//         } else {
//             el.removeClass('animated');
//             el.removeAttr('style');
//             new WOW().init();

//         }
//     });

// });

// Plugin Skect Animation
function Particle(x, y, radius) {
    this.init(x, y, radius);
}

Particle.prototype = {

    init: function(x, y, radius) {

        this.alive = true;

        this.radius = radius || 10;
        this.wander = 0.15;
        this.theta = random(TWO_PI);
        this.drag = 0.92;
        this.color = '#fff';

        this.x = x || 0.0;
        this.y = y || 0.0;

        this.vx = 0.0;
        this.vy = 0.0;
    },

    move: function() {

        this.x += this.vx;
        this.y += this.vy;

        this.vx *= this.drag;
        this.vy *= this.drag;

        this.theta += random(-0.5, 0.5) * this.wander;
        this.vx += sin(this.theta) * 0.1;
        this.vy += cos(this.theta) * 0.1;

        this.radius *= 0.96;
        this.alive = this.radius > 0.5;
    },

    draw: function(ctx) {

        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, 0, TWO_PI);
        ctx.fillStyle = this.color;
        ctx.fill();
    }
};


var MAX_PARTICLES = 280;
var COLOURS = ['#F7B83C', '#E0E4CC', '#F38630', '#FA6900', '#FF4E50', '#F9D423'];

var particles = [];
var pool = [];

var ideabranch = Sketch.create({
    container: document.getElementById('hero')
});


ideabranch.setup = function() {

    var i, x, y;

    for (i = 0; i < 20; i++) {
        x = (ideabranch.width * 0.5) + random(-100, 100);
        y = (ideabranch.height * 0.5) + random(-100, 100);
        ideabranch.spawn(x, y);
    }
};



ideabranch.spawn = function(x, y) {

    if (particles.length >= MAX_PARTICLES)
        pool.push(particles.shift());

    particle = pool.length ? pool.pop() : new Particle();
    particle.init(x, y, random(5, 40));

    particle.wander = random(0.5, 2.0);
    particle.color = random(COLOURS);
    particle.drag = random(0.9, 0.99);

    theta = random(TWO_PI);
    force = random(2, 8);

    particle.vx = sin(theta) * force;
    particle.vy = cos(theta) * force;

    particles.push(particle);
}

ideabranch.update = function() {

    var i, particle;

    for (i = particles.length - 1; i >= 0; i--) {

        particle = particles[i];

        if (particle.alive) particle.move();
        else pool.push(particles.splice(i, 1)[0]);
    }
};

ideabranch.draw = function() {

    ideabranch.globalCompositeOperation = 'lighter';

    for (var i = particles.length - 1; i >= 0; i--) {
        particles[i].draw(ideabranch);
    }
};

ideabranch.mousemove = function() {

    var particle, theta, force, touch, max, i, j, n;

    for (i = 0, n = ideabranch.touches.length; i < n; i++) {

        touch = ideabranch.touches[i], max = random(1, 4);
        for (j = 0; j < max; j++) ideabranch.spawn(touch.x, touch.y);
    }
};
$('.wrapper-king').click(function() {
    $(this).fadeOut();
});