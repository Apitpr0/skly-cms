const textContainer = document.getElementById("textContainer");
const boldText = document.getElementById("boldText");
const text = "Sistem Pengurusan Kaunseling";
let index = 0;

function typeText() {
  if (index < text.length) {
    boldText.innerHTML += text.charAt(index);
    index++;
  } else {
    // Reset the index to start from the beginning
    index = 0;
    boldText.innerHTML = "";
  }

  setTimeout(typeText, 100); // Adjust the typing speed here (in milliseconds)
}

// Call the typing function to start the animation
typeText();
