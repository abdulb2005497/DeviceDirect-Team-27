const monitorData ={

    i2k25:{
        black:{
            image: "Monitors/25inch/2k-25-Black.webp",
            title: "25 Inch Black Monitor 2K",
            price: "<del>£149.99</del> £99.99 ",
            descriptionHeading: "Product Description: HD 40 Inch Black TV ",
            description:"Elevate your visual experience with this sleek 25-inch 2K monitor. Boasting a stunning 2560 x 1440 resolution, it delivers sharp, vibrant images for immersive gaming, productivity, or multimedia enjoyment. The monitor's minimalist black design blends seamlessly into any setup, while its ergonomic stand ensures adjustable comfort for long hours of use. Equipped with fast refresh rates and multiple connectivity options, it's perfect for tech enthusiasts and professionals alike."
            
    
    
        },
        white:{
            image: "Monitors/25inch/2k-25-White.webp",
            title: "25 Inch White Monitor 2K",
            price: "<del>£159.99</del> £109.99",
            descriptionHeading: "Product Description: HD 40 Inch White TV ",
            description:"Enhance your viewing experience with this stylish 25-inch 2K monitor in a crisp white finish. With a resolution of 2560 x 1440, it delivers sharp, vibrant visuals for work or play. The modern design and compact size make it a perfect fit for any workspace, while its ergonomic stand ensures adjustable comfort. Offering smooth performance and versatile connectivity options, this monitor is ideal for professionals and tech enthusiasts alike."
    
        },
    
    },
    
    i2k30:{
        black:{
            image: "TVs/60inch/HD-60-Black.webp",
            title: "HD 60 Inch Black TV",
            price: "<del>£249.99</del>£149.99",
            descriptionHeading: "Product Description: HD 60 Inch Black TV",
            description:"Elevate your home entertainment experience with the HD 60 Inch Black TV, a stunning blend of size, style, and performance. Featuring crisp high-definition resolution, vivid color reproduction, and a sleek aesthetic, this TV is the centerpiece for any living space. Whether you're watching blockbuster movies or binge-watching your favorite series, the expansive 60-inch display ensures you won’t miss a single detail. With 4D surround sound, HDMI, and USB ports for ultimate connectivity, it's ready to take your viewing experience to the next level. Don't wait—get this incredible HD TV today at an unbeatable price. Upgrade now to experience entertainment like never before!"
    
        },
        white:{
            image: "TVs/60inch/HD-60-White.webp",
            title: "HD 60 Inch White TV",
            price: "<del>£259.99</del>£159.99",
            descriptionHeading: "Product Description: HD 60 Inch White TV",
            description:"Brighten your space with the HD 60 Inch White TV, where high-performance technology meets elegant design. Featuring a sleek white frame that seamlessly blends into modern decor, this TV delivers stunning high-definition visuals and vivid color accuracy on a 60-inch display. Perfect for movie nights, gaming, or your favorite shows, it offers immersive entertainment enhanced by 4D surround sound. With multiple connectivity options, including HDMI and USB, it's ready to elevate your home entertainment setup. Take advantage of this exclusive offer and add sophistication and functionality to your living room today!"
    
        },
    
    },
    
    i4k25:{
        black:{
            image: "TVs/80inch/HD-80-Black.webp",
            title: "80-Inch Black TV HD",
            price: "<del>£299.99</del> £199.99 ",
            descriptionHeading: "Product Description: HD 80 Inch Black TV",
            description:"Transform your living room into a personal cinema with the HD 80 Inch Black TV. With its massive display and crystal-clear high-definition resolution, this TV delivers a viewing experience that’s larger than life. Designed to impress, it showcases deep contrast, vibrant colors, and fluid motion—perfect for movies, gaming, or sports. Equipped with state-of-the-art audio and versatile connectivity options like HDMI and USB, this TV is built to integrate seamlessly into your setup. For a limited time, seize the chance to own this entertainment powerhouse at an extraordinary discount. Bring home the thrill of immersive visuals today!"
    
        },
        white:{
            image: "TVs/80inch/HD-80-White.webp",
            title: "80-Inch White TV HD",
            price: "<del>£309.99</del> £209.99 ",
            descriptionHeading: "Product Description: HD 80 Inch White TV",
            description:"Make a bold statement in your entertainment area with the HD 80 Inch White TV. Designed to impress, this TV combines a chic white exterior with expansive high-definition resolution, offering breathtaking visuals and dynamic audio for the ultimate viewing experience. Ideal for cinematic movie nights or adrenaline-pumping gaming sessions, the 80-inch screen brings every detail to life. Equipped with HDMI, USB, and other versatile connections, it integrates effortlessly with your devices. Don't miss this chance to upgrade to a stylish and high-performance centerpiece at an unbeatable price!"
    
    
        },
    
    },
    
    i4k30:{
        black:{
            image: "TVs/40inch/4K-40-Black.webp",
            title: "40-Inch Black TV 4K",
            price: "<del>£249.99</del> £149.99 ",
            descriptionHeading: "Product Description: 4K 40 Inch Black TV",
            description:"Discover the brilliance of ultra-high definition with the 4K 40 Inch Black TV. Compact yet powerful, this TV combines sleek design with cutting-edge 4K resolution, offering unparalleled clarity and lifelike color details. Perfect for bedrooms, kitchens, or smaller living spaces, this TV ensures every pixel delivers perfection, whether you’re streaming, gaming, or watching live TV. Complete with advanced sound technology and seamless connectivity through HDMI and USB, it’s designed to fit effortlessly into your modern lifestyle. Don’t miss out—upgrade to 4K quality now and enjoy an exclusive offer for a limited time only!"
    
        },
        white:{
            image: "TVs/40inch/4k-40-White.webp",
            title: "40-Inch White TV 4K",
            price: "<del>£259.99</del> £159.99 ",
            descriptionHeading: "Product Description: 4K 40 Inch White TV",
            description:"Add a touch of elegance to your home with the 4K 40 Inch White TV. Compact yet powerful, this sleek white television delivers the brilliance of ultra-high-definition resolution, ensuring every frame is packed with crisp detail and lifelike colors. Ideal for smaller spaces, it’s the perfect combination of aesthetics and performance. Whether you're streaming, gaming, or catching up on your favorite shows, the 4K clarity is matched by advanced sound technology and convenient HDMI and USB connectivity. Don’t wait—upgrade your entertainment setup today with this stylish and affordable 4K TV!"
    
        },
    
    },
    
    
    }
    
    const model=document.body.dataset.model;
    const normal = document.getElementById("normal");
    const colourselector = document.getElementById('colourselector');
    const pname = document.getElementById('pname');
    const pprice = document.getElementById('pprice');
    const pdescription = document.getElementById('pdescription');
    const pdescriptionheading =document.getElementById('pdescriptionheading');
    const black = document.getElementById('black');
    const white = document.getElementById('white');
    
    
    function updateItems(variant){
        const product=monitorData[model][variant];
        normal.src=product.image;
            pname.textContent=product.title;
            pprice.innerHTML=product.price;
            pdescriptionheading.textContent=product.descriptionHeading;
            pdescription.textContent=product.description;
    
    }
    
    
    colourselector.addEventListener("change",function(){
        const selectedValue= colourselector.value.toLowerCase();
        updateItems(selectedValue);
    
        }
    )
    
    black.addEventListener("click",function(){
        updateItems("black");
    }
    )
    
    white.addEventListener("click",function(){
    updateItems("white");
     
    }
    )
    
    
    
    