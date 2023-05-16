const logo = document.getElementById("logo");

// Add the rotate animation class to the logo
logo.classList.add("rotate");

// Remove the rotate animation class after the animation completes
logo.addEventListener("animationend", () => {
  logo.classList.remove("rotate");
});

const style = `
  <style>
    @keyframes rotateAnimation {
      0% {
        transform: rotateY(0);
      }

      50% {
        transform: rotateY(180deg);
      }

      100% {
        transform: rotateY(0);
      }
    }

    .rotate {
      animation: rotateAnimation 2s ease-in-out infinite;
    }
  </style>
`;

// Insert the CSS styles into the document head
document.head.insertAdjacentHTML("beforeend", style);
