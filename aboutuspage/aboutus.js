//Slider information

const information = [
  {  
    name: "Who We Are",
    info: "Welcome to Device Direct, the unrivaled leader in technology retail since 2024. We set the industry standard by offering top-tier tech products at competitive prices, all backed by exceptional customer service.",
  },

  {
    name: "Our Vision",
    info: "At Device Direct, our vision is to redefine online shopping by seamlessly merging affordability with the latest in technology. As the leading tech retailer, we offer a comprehensive range of top-brand products at competitive prices. We are committed to providing unmatched convenience, variety, and value, making us the go-to destination for tech enthusiasts.",
  },

  {
    name: "Our Mission",
    info: "Our mission is simple: to empower our customers with access to high-quality products and exceptional service all at unbeatable prices. Every step we take is driven by our commitment to our customers' satisfaction.",
  },

  {
    name: "Price Match Guarantee",
    info: "We stand by our promise of unbeatable value. With our Price Match Guarantee, you can shop confidently knowing you'll always get the best deal. If you find a product cheaper elsewhere, we'll match their price with 100% certainty.",

  },

  {
    name: "Customer Satisfaction",
    info: "We prioritise customer satisfaction with a seamless shopping experience and excellent service. Here's what one customer had to say: 'I found the perfect laptop at Device Direct! The 24/7 support team were incredibly professional and helpful.' - Omar Abdullah Al-Faisal",
  },

  {
    name: "Meet the Team",
    info: "Our dedicated team of professionals is the backbone of Device Direct. From product experts to support specialists, each member is passionate about providing an unparalleled experience for our customers.",
  },

  {
    name: "Why Choose Us",
    info: "At Device Direct, we offer more than just products. We provide peace of mind with a vast selection, trusted quality, fast delivery, and round-the-clock support. This is why thousands of customers choose us daily.",
  },

  {
    name: "Sustainability Commitment",
    info: "At Device Direct, we are dedicated to supporting sustainable practices. We partner with suppliers who prioritise environmentally friendly production, and we strive to use minimal packaging to reduce waste. Our commitment to green initiatives helps build a better future for everyone.",
  },

  {
    name: "Get in Touch",
    info: "Have a question or need assistance? Our friendly support team is here to help. Reach out to us via email or use the Contact Us page on our website to submit your query. We'll ensure your experience with us is nothing short of exceptional.",
  },
];


let i = 0;
let j = information.length;

let infoSlider = document.getElementById("info-slider");
let nextBtn = document.getElementById("next");
let prevBtn = document.getElementById("prev");

let displayInfo = () => {
  console.log(`Displaying Slide: ${i}`);
  infoSlider.innerHTML = `
    <h3>${information[i].name}</h3>
    <p>${information[i].info}</p>
  `;
};

nextBtn.addEventListener("click", () => {
  i = (i + 1) % j;
  displayInfo();
});

prevBtn.addEventListener("click", () => {
  i = (i - 1 + j) % j;
  displayInfo();
});

document.addEventListener("DOMContentLoaded", () => {
  displayInfo();
});