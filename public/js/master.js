document.addEventListener("DOMContentLoaded", () => {
  // Grab the curve element
  const curve = document.getElementById("curve");
  const defaultCurveValue = 350; // Default curve height
  const curveRate = 3; // Rate of curve adjustment

  let lastKnownScrollPosition = 0;
  let ticking = false;

  const carousels = document.querySelectorAll('.animate-loop');

  // Pause loop on hover
  carousels.forEach(carousel => {
       carousel.addEventListener('mouseenter', () => {
          carousel.style.animationPlayState = 'paused';
      });

       carousel.addEventListener('mouseleave', () => {
          carousel.style.animationPlayState = 'running';
      });
  });

  // Handles scrolling for dynamic curve changes
  const scrollEvent = (scrollPos) => {
      if (scrollPos >= 0 && scrollPos < defaultCurveValue) {
          const curveValue = defaultCurveValue - scrollPos / curveRate;
          curve.setAttribute(
              "d",
              `M 800 300 Q 400 ${curveValue} 0 300 L 0 0 L 800 0 L 800 300 Z`
          );
      }
  };

  // Initialize "Read More" toggle functionality
  const toggleDescriptionButtons = document.querySelectorAll(".toggle-button");
  toggleDescriptionButtons.forEach((button) => {
      button.addEventListener("click", () => {
          const productId = button.getAttribute("data-product-id");
          const description = document.getElementById(`description-${productId}`);

          // Check if the description exists and toggle visibility
          if (description) {
              description.classList.toggle("hidden");
          }
      });
  });

  // Event listener for scrolling
  window.addEventListener("scroll", () => {
      lastKnownScrollPosition = window.scrollY;

      if (!ticking) {
          window.requestAnimationFrame(() => {
              scrollEvent(lastKnownScrollPosition);
              ticking = false;
          });
      }

      ticking = true;
  });
});
