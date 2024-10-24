var swiper = new Swiper(".swiper-container", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    effect: "slide", // Hiệu ứng trượt
    speed: 600, // Tốc độ chuyển slide
    grabCursor: true, // Hiệu ứng kéo trượt
    simulateTouch: true, // Hoạt động như thao tác vuốt
    autoplay: {
      delay: 6000, // Thời gian giữa các slide (3000ms = 3 giây)
      disableOnInteraction: false, // Tiếp tục chạy sau khi người dùng tương tác
    },
  });

