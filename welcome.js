document.addEventListener("DOMContentLoaded", () => {
    const alertBox = document.getElementById("welcomeMessage");
  
    if (alertBox) {
      setTimeout(() => {
        alertBox.style.display = "none";
      }, 4000); // Hide after 4 seconds
    }
  });
  