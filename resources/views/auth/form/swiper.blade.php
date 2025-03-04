              <!-- SWIPER JS -->
              <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
              
              
              <script>
                var swiper = new Swiper('.swiper-container', {
                    slidesPerView: 6, // Display 4 logos at a time
                    spaceBetween: 30, // Space between logos
                    loop: true, // Loop the slides
                    autoplay: {
                        delay: 2500, // Auto-slide every 2.5 seconds
                        disableOnInteraction: false, // Continue autoplay after interaction
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 2, // 2 logos on small screens
                        },
                        768: {
                            slidesPerView: 3, // 3 logos on medium screens
                        },
                        1024: {
                            slidesPerView: 4, // 4 logos on large screens
                        },
                    },
                });
            </script>