window.addEventListener('DOMContentLoaded',() => {

    // notification bar
    const notifBar = document.querySelector('.notification-wrap');
    const notifyCloseBtn = notifBar?.querySelector('#notify-close');

    notifyCloseBtn?.addEventListener('click', () => {
        notifBar.style.position = 'absolute'
        notifBar.style.left = '0'
        notifBar.style.right = '0'
        notifBar.classList.add('hide');
    })

    // side bar
    const hamBarDesktop = document.querySelector('#desktopSideMenuOpener');
    const sideMenuOverlay = document.querySelector('#sideMenuOverlay');
     const desktopSideMenuEl = document.querySelector('#desktopSideMenu')
      const desktopSideMenuClose = document.querySelector('#desktopSideMenuClose')
 
      hamBarDesktop?.addEventListener('click',() => {
        hamBarDesktop.classList.add('active')
         sideMenuOverlay.style.display = 'block'
         desktopSideMenuEl.classList.add('active')
     })
 
     sideMenuOverlay.addEventListener('click', () => {
         sideMenuOverlay.style.display = 'none'
         hamBarDesktop.classList.remove('active')
         desktopSideMenuEl.classList.remove('active')
     })
     desktopSideMenuClose?.addEventListener('click',() => {
         sideMenuOverlay.style.display = 'none'
         hamBarDesktop.classList.remove('active')
         desktopSideMenuEl.classList.remove('active')
     })
 
    
   // side bar
    const hamBarEl = document.querySelector('#sideMenuOpener');
    const mobileSideMenuEl = document.querySelector('#mobileSideMenu');
    const mobileSideMenuClose = document.querySelector('#mobileSideMenuClose');
    hamBarEl.addEventListener('click',() => {
        hamBarEl.classList.add('active')
        sideMenuOverlay.style.display = 'block'
        mobileSideMenuEl.classList.add('active')
    })
    console.log(hamBarEl)

    sideMenuOverlay.addEventListener('click', () => {
        sideMenuOverlay.style.display = 'none'
        hamBarEl.classList.remove('active')
        mobileSideMenuEl.classList.remove('active')
    })
    mobileSideMenuClose.addEventListener('click',() => {
        sideMenuOverlay.style.display = 'none'
        hamBarEl.classList.remove('active')
        mobileSideMenuEl.classList.remove('active')
    })

    //Mobile Side Menu
    const mobileMenus = document.querySelectorAll('#mobileSideMenu .menu');

    mobileMenus?.forEach((mobileMenu) => {
        if (mobileMenu) {
            const menuItems = mobileMenu.querySelectorAll('.menu-item.menu-item-has-children');
        
            menuItems.forEach((item) => {
              const button = document.createElement('button');
              button.classList.add('angle-down');
              button.textContent = 'Angle down';
              item.appendChild(button);
            });
        }
    })

    const submenuOpener = document.querySelectorAll('.angle-down');
    const handleOpeningSubmenu = (opener) => {
        let totalHeight = 0; // Initialize totalHeight to 0
        const submenu = opener.previousElementSibling;
        totalHeight = submenu.scrollHeight
        const innerSubMenu = submenu.querySelectorAll('ul');
        innerSubMenu.forEach(menu => {
          totalHeight += menu.scrollHeight;
        })
        if(submenu.style.visibility === "visible"){
          submenu.style.visibility = "hidden";
          submenu.style.maxHeight = "0";
        }else{
          submenu.style.visibility = "visible";
          submenu.style.maxHeight =  totalHeight + "px";
        }
        opener.classList.toggle('active')
        totalHeight = 0;
    }
    submenuOpener.forEach(opener => {
        opener.addEventListener('click', () => handleOpeningSubmenu(opener));
    });


    // dynamic menu dropdown
    const subMenus = document.querySelectorAll('.desktop-header .menu .sub-menu');      
  
    subMenus.forEach(function (menu) {
        const rect = menu.getBoundingClientRect();
        if (rect.right > window.innerWidth) {
            if (menu.parentElement.parentElement.classList.contains('menu')) {
                menu.style.left = 'auto';
                menu.style.right = '0';
            } else {
                menu.style.left = 'auto';
                menu.style.right = '100%';
            }
        }
    });
   
    const headerSearchBtn = document.querySelector('#headerSearchBtn')
    const headerSearch = document.querySelector('#headerSearch')

    headerSearchBtn.addEventListener('click', () => {
       headerSearch.classList.toggle('active')
       headerSearchBtn.classList.toggle('active')
    })
    const label = document.getElementById('wp-block-email__label')
    const inputField = document.getElementById('wp-block-email__field')

    inputField?.addEventListener('click', () => {
        label.classList.add('active')
    })
    inputField?.addEventListener('change',() => {
        if(inputField.value.length <= 0 ){
            label.classList.remove('active')
        }
    })

    // Counter
    const counterContainers = document.querySelectorAll('.counter-card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                startCount(entry.target);
                observer.unobserve(entry.target);
            }
        });
    });

    counterContainers.forEach((counter) => {
        observer.observe(counter);
    });

    const startCount = (counter) => {
        const counterEl = counter.querySelector('.counter-number');
        const prefix = counterEl.getAttribute('data-prefix');
        const target = +parseInt(counterEl.getAttribute('data-count'));
        let count = 0;
        let increment = target / 200; // Duration of the counter

        const timer = setInterval(() => {
            count += increment;
            if(prefix){
                counterEl.innerText = `${Math.floor(count)} ${prefix}`;
            }else{
                counterEl.innerText = `${Math.floor(count)}`;
            }
            
            if (count >= target) {
                clearInterval(timer);
                if(prefix){
                    counterEl.innerText = `${target} ${prefix}`;
                }else{
                    counterEl.innerText = `${target}`;
                }
            }
        }, 8);
    };

    // teams social links
    const teamSocialLinksEl = document.querySelectorAll('.team-social-links')
    
    teamSocialLinksEl.forEach(el => {
        const socialButton = el.querySelector('#team-social-btn')
        socialButton.addEventListener('click',() => el.classList.toggle('active'))
    })

    // tabs 
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons?.forEach(button => {
        if(button.getAttribute('data-default')){
            button.classList.add('active')
        }
        const id = button.getAttribute("data-id");
        button.addEventListener('click',() => {
            handleTabs(id,button)
        })
    })
    tabContents.forEach(content => {
        if(content.getAttribute('data-default')){
            content.classList.add('active')
        }
    })
    const handleTabs = (id,button) => {
        tabButtons.forEach(btn => {
            btn.classList.remove('active')
        })
        button.classList.add('active');
        tabContents.forEach(content => {
            const contentId = content.getAttribute("data-id");
            if(id !== contentId){
                content.classList.remove('active')
            }else{
                content.classList.add('active')
            }
        })
    }

    // Accordion
    const accordionContainer = document.querySelectorAll('.accordion');
    const accordionButtons = document.querySelectorAll('.accordion-button');

    // Define the Intersection Observer options
    const observerOptions = {
        root: null, // Use the viewport as the root
        rootMargin: '0px', // No margin
        threshold: 0.5, // Trigger when at least 50% of the target is visible
    };

    accordionContainer?.forEach(accordion => {
        const accordionButton = accordion.querySelectorAll('.accordion-button');
        const accordionItem = accordion.querySelectorAll('.accordion-item');
        const firstContent = accordionButton[0].nextElementSibling; 
        // Initialize the Intersection Observer for the first content
        const contentObserver = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    accordionItem[0].classList.add('active');
                    accordionButton[0].classList.add('active');
                    firstContent.classList.add('active');
                    firstContent.style.maxHeight = firstContent.scrollHeight + 12 + "px";
                    // Unobserve after activation
                    contentObserver.unobserve(firstContent);
                }
          });
        }, observerOptions);    
        // Start observing the first content
        contentObserver.observe(firstContent);
    });

    accordionButtons?.forEach(button => {
        button.addEventListener('click', () => handleAccordion(button));
    });

    const handleAccordion = (button) => {
        const content = button.nextElementSibling;
        const accordionItem = button.parentElement;
        button.classList.toggle('active');
        accordionItem.classList.toggle('active');
        content.classList.toggle('active');
        content.style.maxHeight = content.style.maxHeight ? null : content.scrollHeight + 12 + "px";
    };

     // Scroll To Top
     const scrollTopEl = document.querySelector('#scroll__top');
    
    //  const handleScroll = () => {
    //      let height = 350;
    //      const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    //      if (winScroll > height) {
    //          scrollTopEl.style.visibility = "visible"
    //          scrollTopEl.style.opacity = 1
    //      } else {
    //          scrollTopEl.style.visibility = "hidden"
    //          scrollTopEl.style.opacity = 0
    //      }
    //  }
     
    //  const handleScrollTop = () => {
    //      window.addEventListener('scroll', handleScroll);
    //      return () => window.removeEventListener('scroll', handleScroll);
    //  }
    //  handleScrollTop()
    function toggleScrollTopEl() {
            // var scrollToTopButton = document.getElementById('scrollToTopButton');
            var bottomThreshold = 100; // Adjust the threshold as needed

            // Calculate the scroll position and the document height
            var scrollPosition = window.scrollY;
            var documentHeight = document.body.scrollHeight - window.innerHeight;

            if (scrollPosition >= documentHeight - bottomThreshold) {
                scrollTopEl?.classList.add('active')
            } else {
                scrollTopEl?.classList.remove('active')
            }
    }
    window.addEventListener('scroll', toggleScrollTopEl);
     const goToTop = () => {
        window.scrollTo({ top: 0, behavior: 'smooth' })
     }
     scrollTopEl?.addEventListener('click',(e)=>{
        e.preventDefault()
        goToTop()
    })

    //   Video Fancy box
   
    Fancybox.bind("[data-fancybox]", {});
      

})