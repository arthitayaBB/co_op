// ฟังก์ชั่นตรวจสอบตำแหน่งการเลื่อน
function checkFadeIn() {
    var elements = document.querySelectorAll('.fade-in');
    var windowHeight = window.innerHeight;

    elements.forEach(function(element) {
        var elementTop = element.getBoundingClientRect().top;
        if (elementTop <= windowHeight - 100) { // เมื่อหน้าจอเลื่อนถึงตำแหน่งนี้
            element.classList.add('show');
        }
    });
}

// ฟังก์ชั่นตรวจสอบการเลื่อน navbar
function checkNavbarScroll() {
    var navbar = document.querySelector('.navbar');
    if (window.scrollY > 100) { // เมื่อเลื่อนลงมาเกิน 100px
        navbar.classList.add('fixed-top'); // เพิ่มคลาส fixed-top
    } else {
        navbar.classList.remove('fixed-top'); // ลบคลาส fixed-top
    }
}

// เรียกใช้ฟังก์ชั่นเมื่อหน้าจอเลื่อน
window.onload = function() {
    checkFadeIn();
    checkNavbarScroll();
};

window.addEventListener('scroll', function() {
    checkFadeIn();
    checkNavbarScroll();
});

document.querySelectorAll('.navbar .btn').forEach(button => {
    button.addEventListener('click', function() {
        document.querySelectorAll('.navbar .btn').forEach(btn => btn.classList.remove('active')); // ลบคลาส active ออกจากทุกปุ่ม
        this.classList.add('active'); // เพิ่มคลาส active ให้กับปุ่มที่ถูกคลิก
    });
});
//สไลด์
        document.addEventListener('DOMContentLoaded', () => {
            const elements = document.querySelectorAll('.slide-in-left, .slide-in-right');

            function checkElements() {
                elements.forEach((el) => {
                    const rect = el.getBoundingClientRect();
                    const inView = rect.top < window.innerHeight * 0.8; // ปรับค่าตามต้องการ

                    if (inView) {
                        el.classList.add('active');
                    }
                });
            }

            // ใช้ IntersectionObserver และ fallback เป็น scroll event
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.2
            });

            if ("IntersectionObserver" in window) {
                elements.forEach((el) => observer.observe(el));
            } else {
                window.addEventListener('scroll', checkElements);
                window.addEventListener('resize', checkElements);
                checkElements();
            }
        });
    