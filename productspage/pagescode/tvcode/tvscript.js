
const colourselector = document.getElementById('colourselector');
const pname = document.getElementById('pname');
const pprice = document.getElementById('pprice');
const pdescription = document.getElementById('pdescription');
const pdescriptionheading =document.getElementById('pdescriptionheading');

colourselector.addEventListener("change",function(){

    const selectedValue= colourselector.value;
    console.log(selectedValue);

    if(selectedValue=="Black"){
        normal.src="TVs/40inch/HD-40-Black.webp";
        pname.textContent="40-Inch Black TV HD";
        pprice.innerHTML="<del>£199.99</del> £99.99";
        pdescriptionheading.textContent="Product Description: HD 40 Inch Black TV – Now at Half Price!"
        pdescription.textContent="Experience stunning visuals and immersive entertainment with the HD 40 Inch Black TV, the perfect addition to any home. Boasting crystal-clear picture quality, vibrant colors, and sleek modern design, this television is designed to enhance your viewing experience, whether you're watching your favorite movies, shows, or gaming. With advanced 4D surround sound technology and multiple connectivity options, including HDMI and USB, it's ready to integrate seamlessly into your setup. Limited Time Offer: Get this incredible HD TV at half the original price! Don't miss this opportunity to upgrade your entertainment system and bring cinematic visuals right to your living room. Click 'Add to Basket' now to make it yours before the deal ends!";

    }else if (selectedValue=="White"){

        normal.src="TVs/40inch/HD-40-White.webp";
        pname.textContent="40-Inch White TV HD";
        pprice.innerHTML="<del>£209.99</del> £109.99";
        pdescriptionheading.textContent="Product Description: HD 40 Inch White TV – Now at Half Price!"
        pdescription.textContent="Experience stunning visuals and immersive entertainment with the HD 40 Inch White TV, the perfect addition to any home. Boasting crystal-clear picture quality, vibrant colors, and sleek modern design, this television is designed to enhance your viewing experience, whether you're watching your favorite movies, shows, or gaming. With advanced 4D surround sound technology and multiple connectivity options, including HDMI and USB, it's ready to integrate seamlessly into your setup. Limited Time Offer: Get this incredible HD TV at half the original price! Don't miss this opportunity to upgrade your entertainment system and bring cinematic visuals right to your living room. Click 'Add to Basket' now to make it yours before the deal ends!";
    }
    }
)

const black = document.getElementById('black');
const white = document.getElementById('white');

black.addEventListener("click",function(){
    normal.src="TVs/40inch/HD-40-Black.webp";
        pname.textContent="40-Inch Black TV HD";
        pprice.innerHTML="<del>£199.99</del> £99.99";
        pdescriptionheading.textContent="Product Description: HD 40 Inch Black TV – Now at Half Price!"
        pdescription.textContent="Experience stunning visuals and immersive entertainment with the HD 40 Inch Black TV, the perfect addition to any home. Boasting crystal-clear picture quality, vibrant colors, and sleek modern design, this television is designed to enhance your viewing experience, whether you're watching your favorite movies, shows, or gaming. With advanced 4D surround sound technology and multiple connectivity options, including HDMI and USB, it's ready to integrate seamlessly into your setup. Limited Time Offer: Get this incredible HD TV at half the original price! Don't miss this opportunity to upgrade your entertainment system and bring cinematic visuals right to your living room. Click 'Add to Basket' now to make it yours before the deal ends!";

}
)

white.addEventListener("click",function(){
    normal.src="TVs/40inch/HD-40-White.webp";
        pname.textContent="40-Inch White TV HD";
        pprice.innerHTML="<del>£209.99</del> £109.99";
        pdescriptionheading.textContent="Product Description: HD 40 Inch White TV – Now at Half Price!"
        pdescription.textContent="Experience stunning visuals and immersive entertainment with the HD 40 Inch White TV, the perfect addition to any home. Boasting crystal-clear picture quality, vibrant colors, and sleek modern design, this television is designed to enhance your viewing experience, whether you're watching your favorite movies, shows, or gaming. With advanced 4D surround sound technology and multiple connectivity options, including HDMI and USB, it's ready to integrate seamlessly into your setup. Limited Time Offer: Get this incredible HD TV at half the original price! Don't miss this opportunity to upgrade your entertainment system and bring cinematic visuals right to your living room. Click 'Add to Basket' now to make it yours before the deal ends!";
    
}
)





