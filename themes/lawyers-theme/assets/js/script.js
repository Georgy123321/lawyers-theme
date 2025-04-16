const hamMenu = document.querySelector('.ham-menu');
const offScreenMenu = document.querySelector('.off-screen-menu');
const menuLinks = document.querySelectorAll('.off-screen-menu .header_link');
const overlay = document.querySelector('.overlay'); // просто выбираем, не создаём

// Функция для закрытия меню
function closeMenu() {
    hamMenu.classList.remove('active');
    offScreenMenu.classList.remove('active');
    overlay.classList.remove('active');
}

// Открытие/закрытие меню при клике на бургер
hamMenu.addEventListener('click', () => {
    const isActive = hamMenu.classList.toggle('active');
    offScreenMenu.classList.toggle('active');
    overlay.classList.toggle('active', isActive);
});

// Закрытие при клике на overlay
overlay.addEventListener('click', closeMenu);

// Закрытие при клике на ссылку в меню и плавный скролл
menuLinks.forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        closeMenu();
        const targetId = link.getAttribute('href');
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            targetElement.scrollIntoView({ behavior: 'smooth' });
        }
    });
});



// services start
const toggleBtn = document.getElementById('toggleServices');
const extraServices = document.querySelector('.services_extra');

toggleBtn.addEventListener('click', () => {
	extraServices.classList.toggle('show');
	toggleBtn.textContent = extraServices.classList.contains('show') ? 'Скрыть услуги' : 'Все услуги';
});
// services end

// news strat
const toggleNewsBtn = document.getElementById('toggleNews');
const extraNews = document.querySelector('.news_extra');

toggleNewsBtn.addEventListener('click', () => {
	extraNews.classList.toggle('show');
	toggleNewsBtn.textContent = extraNews.classList.contains('show') ? 'Скрыть новости' : 'Все новости';
});
// news end

new Swiper('.card_wrapper', {
	loop: true,
	spaceBetween: 30,

	// If we need pagination
	pagination: {
		el: '.swiper-pagination',
		clickable: true,
		dynamicBullets: true
	},

	// Navigation arrows
	navigation: {
		nextEl: '.next',
		prevEl: '.prev',
	},

	// And if we need scrollbar
	scrollbar: {
		el: '.swiper-scrollbar',
	},

	breakpoints: {
		768: {
			slidesPerView: 1
		},
		1024: {
			slidesPerView: 2
		}
	}
});