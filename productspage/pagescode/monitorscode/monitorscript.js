const monitorData ={

    i2k25:{
        black:{
            image: "Monitors/25inch/2k-25-Black.webp",
            title: "25 Inch Black Monitor 2K",
            price: "<del>£149.99</del> £99.99 ",
            descriptionHeading: "Product Description: 2K 25 Inch Black Monitor ",
            description:"Elevate your visual experience with this sleek 25-inch 2K monitor. Boasting a stunning 2560 x 1440 resolution, it delivers sharp, vibrant images for immersive gaming, productivity, or multimedia enjoyment. The monitor's minimalist black design blends seamlessly into any setup, while its ergonomic stand ensures adjustable comfort for long hours of use. Equipped with fast refresh rates and multiple connectivity options, it's perfect for tech enthusiasts and professionals alike."
            
    
    
        },
        white:{
            image: "Monitors/25inch/2k-25-White.webp",
            title: "25 Inch White Monitor 2K",
            price: "<del>£159.99</del> £109.99",
            descriptionHeading: "Product Description: 2K 25 Inch White Monitor ",
            description:"Enhance your viewing experience with this stylish 25-inch 2K monitor in a crisp white finish. With a resolution of 2560 x 1440, it delivers sharp, vibrant visuals for work or play. The modern design and compact size make it a perfect fit for any workspace, while its ergonomic stand ensures adjustable comfort. Offering smooth performance and versatile connectivity options, this monitor is ideal for professionals and tech enthusiasts alike."
    
        },
    
    },
    
    i2k30:{
        black:{
            image: "Monitors/30inch/2k-30-Black.webp",
            title: "30 Inch Black Monitor 2K",
            price: "<del>£199.99</del> £149.99 ",
            descriptionHeading: "Product Description: 30 Inch Black Monitor 2K",
            description:"Experience unparalleled clarity with this 30-inch 2K monitor, offering a vibrant 2560 x 1440 resolution for crystal-clear visuals. Designed with productivity and entertainment in mind, its expansive screen provides ample space for multitasking and immersive viewing. The elegant black finish and slim bezel design add a modern touch to any workspace or gaming setup. Featuring a fast refresh rate, wide viewing angles, and versatile connectivity options, this monitor is built to deliver premium performance for work or play."
    
        },
        white:{
            image: "Monitors/30inch/2k-30-White.webp",
            title: "30 Inch White Monitor 2K",
            price: "<del>£209.99</del> £159.99 ",
            descriptionHeading: "Product Description: 30 Inch White Monitor 2K",
            description:"Experience clarity and style with this 30-inch 2K monitor in elegant white. Boasting a resolution of 2560 x 1440, it offers expansive screen space and vibrant visuals for gaming, multitasking, or creative work. The slim-bezel design complements any modern setup, while its ergonomic features ensure long-term comfort. Equipped with advanced connectivity and smooth performance, this monitor is the perfect blend of functionality and aesthetics."
    
        },
    
    },
    
    i4k25:{
        black:{
            image: "Monitors/25inch/4k-25-black.webp",
            title: "25 Inch Black Monitor 4K",
            price: "<del>£199.99</del> £149.99 ",
            descriptionHeading: "Product Description: 25 Inch Black Monitor 4k",
            description:"Discover extraordinary detail with this 25-inch 4K monitor, boasting an ultra-high-definition resolution of 3840 x 2160. Perfect for professionals, gamers, and content creators, it delivers breathtaking clarity and vibrant colors for an unmatched viewing experience. The sleek black design complements any setup, while its compact size ensures it fits seamlessly into any workspace. With advanced connectivity options and smooth performance, this monitor is a powerful blend of style and functionality, ideal for those who demand exceptional quality."
    
        },
        white:{
            image: "Monitors/25inch/4k-25-White.webp",
            title: "25 Inch White Monitor 4K",
            price: "<del>£209.99</del> £159.99 ",
            descriptionHeading: "Product Description: 25 Inch White Monitor 4k",
            description:"Discover premium visuals with this sleek 25-inch 4K monitor in stunning white. Its ultra-high-definition resolution of 3840 x 2160 delivers incredible detail and vibrant color accuracy, ideal for creative professionals, gamers, and multitaskers. The modern design fits seamlessly into any setup, while its compact size ensures practicality without compromising quality. With fast refresh rates and robust connectivity options, this monitor is as functional as it is beautiful."
    
    
        },
    
    },
    
    i4k30:{
        black:{
            image: "Monitors/30inch/4k-30-Black.webp",
            title: "30 Inch Black Monitor 4K",
            price: "<del>£249.99</del> £199.99 ",
            descriptionHeading: "Product Description: 30 Inch Black Monitor 4k",
            description:"Immerse yourself in stunning visuals with this 30-inch 4K monitor, featuring an impressive resolution of 3840 x 2160 for razor-sharp detail and vivid color accuracy. Perfect for multitasking, gaming, or professional work, its expansive display provides ample screen real estate and an immersive viewing experience. The sleek black design with slim bezels adds a modern touch to any setup, while ergonomic features ensure long-lasting comfort. Equipped with fast refresh rates and multiple connectivity options, this monitor is built for performance and style, making it a must-have for power users."
    
        },
        white:{
            image: "Monitors/30inch/4k-30-White.webp",
            title: "30 Inch White Monitor 4K",
            price: "<del>£259.99</del> £209.99 ",
            descriptionHeading: "Product Description: 30 Inch White Monitor 4k",
            description:"Step into a world of stunning detail with this 30-inch 4K monitor in elegant white. Featuring a resolution of 3840 x 2160, it offers unparalleled clarity and a spacious display for immersive gaming, professional work, or multimedia use. The sleek, minimalist design with slim bezels enhances any workspace, while ergonomic adjustments provide maximum comfort. With cutting-edge performance and versatile connectivity, this monitor is perfect for those who demand both style and excellence."
    
        },
    
    },
    
    
    }
    
    const model = document.body.dataset.model;
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
    
    
    
    