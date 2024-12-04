document.getElementById("contactForm").addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent form submission
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const message = document.getElementById("message").value;
  
    alert(
      `Thank you, ${name}! Your message has been received.\n\n` +
      `Email: ${email}\n` +
      `Message: ${message}`
    );
  });
  