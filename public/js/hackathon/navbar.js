let lastScrollTop = 0;
const navbar = document.querySelector('.navbar'); // Đảm bảo đúng class của navbar
const scrollThreshold = 500; // Điều chỉnh giá trị ngưỡng cuộn

// Debounce function để giảm tần suất gọi hàm khi cuộn
function debounce(func, wait = 20, immediate = true) {
  let timeout;
  return function() {
    const context = this, args = arguments;
    const later = function() {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };
    const callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) func.apply(context, args);
  };
}

const handleScroll = debounce(function() {
  let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

  if (scrollTop > lastScrollTop && scrollTop > scrollThreshold) { // Cuộn xuống và qua ngưỡng
    navbar.classList.add('navbar-hidden');
    navbar.classList.remove('navbar-visible');
  } else if (scrollTop < lastScrollTop) { // Cuộn lên
    navbar.classList.add('navbar-visible');
    navbar.classList.remove('navbar-hidden');
  }

  lastScrollTop = scrollTop;
}, 10); // Giảm thời gian debounce để phản hồi mượt mà hơn

window.addEventListener('scroll', handleScroll);
