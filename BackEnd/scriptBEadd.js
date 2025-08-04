
// สลับโหมด Dark/Light
function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
}

particlesJS("particles-js", {
    particles: {
        number: { value: 150, density: { enable: true, value_area: 800 } },
        color: { value: "#ffffff" },
        shape: { type: "circle", stroke: { width: 0, color: "#000000" }, polygon: { nb_sides: 5 } },
        opacity: { value: 0.5, random: true, anim: { enable: true, speed: 1, opacity_min: 0.1 } },
        size: { value: 3, random: true, anim: { enable: true, speed: 40, size_min: 0.1 } },
        line_linked: { enable: true, distance: 150, color: "#ffffff", opacity: 0.4, width: 1 },
        move: { enable: true, speed: 4, direction: "none", random: false, straight: false, out_mode: "out", bounce: false }
    },
    interactivity: {
        detect_on: "canvas",
        events: { onhover: { enable: true, mode: "repulse" }, onclick: { enable: true, mode: "push" }, resize: true },
    },
    retina_detect: true
});
