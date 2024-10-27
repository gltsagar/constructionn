
const bannerSwiper = new Swiper(".banner-swiper-one", {
    rewind: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        renderBullet: function (index, className) {
          return '<span class="' + className + '">' + (index + 1) + "</span>";
        },
    },
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    speed: 2000,
});


const projectsSwiper = new Swiper(".projects-swiper", {
    slidesPerView: 1,
    spaceBetween: 48,
    loop: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 48,
        },
        575:{
            lidesPerView: 2,
            spaceBetween: 48,
        },
        767:{
            slidesPerView: 3,
            spaceBetween: 48,
        },
        992: {
            slidesPerView: 2,
            spaceBetween: 48,
        },
        1099:{
            slidesPerView: 3,
            spaceBetween: 48,
        }
    }
  });

const testimonialSwiper = new Swiper(".testimonial-swiper", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

const teamsSwiper = new Swiper(".teams-swiper", {
    slidesPerView: 3,
    spaceBetween: 72,
    loop: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints:{
        0:{
            slidesPerView: 1,
            spaceBetween: 40,
        },
        575:{
            slidesPerView: 2,
            spaceBetween: 40,
        },
        767:{
            slidesPerView: 3,
            spaceBetween: 40,
        },
        992:{
            slidesPerView: 3,
            spaceBetween: 72,
        }
    }
  });


  const blogsSwiper = new Swiper(".blogs-swiper", {
    slidesPerView: 3,
    spaceBetween: 72,
    loop: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints:{
        0:{
            slidesPerView: 1,
            spaceBetween: 40,
        },
        575:{
            slidesPerView: 2,
            spaceBetween: 40,
        },
        767:{
            slidesPerView: 3,
            spaceBetween: 40,
        },
        992:{
            slidesPerView: 3,
            spaceBetween: 72,
        }
    }
  });

const partnersSwiper = new Swiper(".partners-swiper", {
    slidesPerView: 5,
    spaceBetween: 72,
    loop: true,
    breakpoints:{
        0:{
            slidesPerView: 2,
            spaceBetween: 40,
        },
        575:{
            slidesPerView: 3,
            spaceBetween: 40,
        },
        767:{
            slidesPerView: 4,
            spaceBetween: 40,
        },
        992:{
            slidesPerView: 5,
            spaceBetween: 72,
        }
    }
  });


const bannerSwiperTwo = new Swiper(".banner-swiper-two__thumb", {
    loop: true,
    spaceBetween: 0,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesProgress: true,
    breakpoints: {
        0:{
            slidesPerView: 1
        },
        575:{
            slidesPerView: 2
        },
        767:{
            slidesPerView: 3
        },
        992:{
            slidesPerView: 4
        }
    }
  });
const bannerSwiperTwoTop = new Swiper(".banner-swiper-two__view", {
    loop: true,
    spaceBetween: 10,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    thumbs: {
      swiper: bannerSwiperTwo,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
  });


const bannerSwiperFour = new Swiper(".banner-swiper-four", {
    slidesPerView: 1,
    spaceBetween: 0,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    loop: true,
});

const bannerFourEl = document.querySelector('.banner-swiper-four')
const swiperSlide = bannerFourEl.querySelectorAll('.swiper-slide')

swiperSlide.forEach(slide => {
    const bannerItem = slide.querySelectorAll('.banner-item')

    const totalBannerItem = bannerItem.length

    bannerItem[0].style.width = '50%';
    bannerItem[0].classList.add('active');

    for (let i = 1; i < bannerItem.length; i++) {
        bannerItem[i].style.width = `${50 / (totalBannerItem - 1)}%`;
    }

    bannerItem.forEach(item => {
        item.addEventListener('mouseenter', () => {
            if(window.matchMedia('(min-width: 992px)').matches){
                bannerItem.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.style.width = `${50 / (totalBannerItem - 1)}%`;
                        otherItem.classList.remove('active');
                    }
                })
                item.style.width = '50%';
                item.classList.add('active');
            }else if (window.matchMedia('(min-width: 767px)').matches){
                bannerItem.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.style.width = '30%';
                        otherItem.classList.remove('active');
                    }
                })
                item.style.width = '70%';
                item.classList.add('active');
            }else{
                bannerItem.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.style.width = '0%';
                        otherItem.classList.remove('active');
                    }
                })
                item.style.width = '100%';
                item.classList.add('active');
            }
        })
    })
})

const updateBannerItem = () => {
    swiperSlide.forEach(slide => {
        const bannerItem = slide.querySelectorAll('.banner-item')
        if(window.matchMedia('(min-width: 992px)').matches){
            bannerItem.forEach((item,index) => {
                item.style.display = 'block'
            })
        }else if(window.matchMedia('(min-width: 767px)').matches){
            const banners = Array.from(bannerItem).slice(0,2)
            bannerItem.forEach(item => {
                item.style.display = 'none'
            })
            banners.forEach(item => {
                item.style.display = 'block'
                item.style.width = '30%'
                if(item.classList.contains('active')){
                    item.style.width = '70%'
                }
            })
        }else{
            bannerItem.forEach(item => {
                item.style.display = 'none'
            })
            bannerItem.forEach(item => {
                item.style.display = 'none'
            })
            bannerItem[0].style.display = 'block'
            bannerItem[0].style.width = '100%'
        }
    })
}

updateBannerItem()

window.addEventListener('resize', updateBannerItem)



