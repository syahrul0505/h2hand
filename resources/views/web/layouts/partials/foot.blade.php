<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>

<div class="whatsapp-float">
    <a href="https://wa.me/628889120198" target="_blank" class="whatsapp-btn">
        <i class="uil uil-whatsapp"></i>
    </a>
</div>

<style>
.whatsapp-float {
    position: fixed;
    bottom: 80px;
    right: 20px;
    z-index: 999;
}

.whatsapp-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    background-color: #25d366;
    color: white;
    border-radius: 50%;
    font-size: 28px;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);
    transition: all 0.3s ease;
}

.whatsapp-btn:hover {
    background-color: #128c7e;
    color: white;
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(37, 211, 102, 0.6);
}
</style>

<script src="{{ asset('assets-frontent/js/plugins.js') }}"></script>
<script src="{{ asset('assets-frontent/js/theme.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (document.querySelector('#hero-carousel')) {
            const heroSwiper = new Swiper('#hero-carousel', {
                loop: true,
                grabCursor: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        }
    });
</script>
