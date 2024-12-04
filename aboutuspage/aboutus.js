//Slider information

const information = [
  {  
    name: "Who We Are",
    info: "Welcome to Device Direct, the unrivaled leader in technology retail since 2024. We set the industry standard for top-tier tech products at competitive prices.",
  },


  {
    name: "Price Match Guarantee",
    info: "We won't be beaten on price! Match any price from major UK retailers to ensure you always get the best deal.",

  },

  {
    name: "Customer Satisfaction",
    info: "We prioritise customer satisfaction with seamless shopping and excellent service. 'I found the perfect laptop at Device Direct!' - Omar Abdullah Al-Faisal",
  },

  {
    name: "Meet the Team",
    info: "Our passionate team of tech enthusiasts is dedicated to helping you find the perfect products with years of industry experience.",
  },

  {
    name: "Get in Touch",
    info: "We'd love to hear from you! Contact us for inquiries, support, or opportunities to collaborate with Device Direct.",
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