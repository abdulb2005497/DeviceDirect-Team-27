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


(function () {
  let searchitems = [
    'HD 40-Inch TV',
    '4K 40-Inch TV',
    'HD 60-Inch TV',
    '4K 60-Inch TV',
    'HD 80-Inch TV',
    '4K 80-Inch TV',
    '2K 25 Inch Monitor',
    '4K 25 Inch Monitor',
    '2K 30 Inch Monitor',
    '4K 30 Inch Monitor',
    '12 Inch Windows Laptop',
    '12 Inch Chrome Laptop',
    '12 Inch Airbook Laptop',
    '12 Inch Probook Laptop',
    '16 Inch Windows Laptop',
    '16 Inch Chrome Laptop',
    '16 Inch Airbook Laptop',
    '16 Inch Probook Laptop',
    'In Ear Black Headphones',
    'In Ear White Headphones',
    'In Ear Grey Headphones',
    'Over Ear Black Headphones',
    'Over Ear White Headphones',
    'Over Ear Grey Headphones',
    'PS4',
    'PS5',
    'Xbox 1',
    'Wii',
    'Wii U',
    'Switch',
  ];

  const itemrefs = {
      'HD 40-Inch TV': '../productspage/pagescode/tvcode/tvs-HD40.php',
      '4K 40-Inch TV': '../productspage/pagescode/tvcode/tvs-4K40.php',
      'HD 60-Inch TV': '../productspage/pagescode/tvcode/tvs-HD60.php',
      '4K 60-Inch TV': '../productspage/pagescode/tvcode/tvs-4K60.php',
      'HD 80-Inch TV': '../productspage/pagescode/tvcode/tvs-HD-80.php',
      '4K 80-Inch TV': '../productspage/pagescode/tvcode/tvs-4K80.php',
      '2K 25 Inch Monitor': '../productspage/pagescode/monitorscode/monitors-2K25.php',
      '4K 25 Inch Monitor': '../productspage/pagescode/monitorscode/monitors-4K25.php',
      '2K 30 Inch Monitor': '../productspage/pagescode/monitorscode/monitors-2K30.php',
      '4K 30 Inch Monitor': '../productspage/pagescode/monitorscode/monitors-4K30.php',
      '12 Inch Windows Laptop': '../productspage/pagescode/laptopscode/laptops-12W.php',
      '12 Inch Chrome Laptop': '../productspage/pagescode/laptopscode/laptops-12C.php',
      '12 Inch Airbook Laptop': '../productspage/pagescode/laptopscode/laptops-12A.php',
      '12 Inch Probook Laptop': '../productspage/pagescode/laptopscode/laptops-12P.php',
      '16 Inch Windows Laptop': '../productspage/pagescode/laptopscode/laptops-16W.php',
      '16 Inch Chrome Laptop': '../productspage/pagescode/laptopscode/laptops-16C.php',
      '16 Inch Airbook Laptop': '../productspage/pagescode/laptopscode/laptops-16A.php',
      '16 Inch Probook Laptop': '../productspage/pagescode/laptopscode/laptops-16P.php',
      'In Ear Black Headphones': '../productspage/pagescode/headphonescode/inearblack.php',
      'In Ear White Headphones': '../productspage/pagescode/headphonescode/inearwhite.php',
      'In Ear Grey Headphones': '../productspage/scode/headphonescode/ineargrey.php',
      'Over Ear Black Headphones': '../productspage/pagescode/headphonescode/overearblack.php',
      'Over Ear White Headphones': '../productspage/pagescode/headphonescode/overearwhite.php',
      'Over Ear Grey Headphones': '../productspage/pagescode/headphonescode/overeargrey.php',
      'PS4': '../productspage/pagescode/consolescode/ps4.php',
      'PS5': '../productspage/pagescode/consolescode/ps5.php',
      'Xbox 1': '../productspage/pagescode/consolescode/xbox1.php',
      'Wii': '../productspage/pagescode/consolescode/nintendowii.php',
      'Wii U': '../productspage/pagescode/consolescode/wiiu.php',
      'Switch': '../productspage/pagescode/consolescode/switch.php'
    };


  const optionBoxNav = document.querySelector('.optionboxnav');
  const inputBoxNav = document.getElementById('inputsearchnav');

  inputBoxNav.onkeyup = function () {
    let result = [];
    let input = inputBoxNav.value;
    if (input.length) {
      result = searchitems.filter((keyword) => {
        return keyword.toLowerCase().includes(input.toLowerCase());
      });
    } else {
      result = [];
    }
    displayNav(result);
  };

  function displayNav(result) {
    if (result.length) {
      const content = result
        .map((list) => {
          const ref = itemrefs[list];
          return `<li><a href="${ref}">${list}</a></li>`;
        })
        .join('');
      optionBoxNav.innerHTML = `<ul>${content}</ul>`;
    } else {
      optionBoxNav.innerHTML = '<p>No results found.</p>';
    }
  }
})(); 


