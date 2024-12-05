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
    'Switch'
];

const itemrefs = {
    'HD 40-Inch TV': './pagescode/tvcode/tvs-HD40.html',
    '4K 40-Inch TV': './pagescode/tvcode/tvs-4K40.html',
    'HD 60-Inch TV': './pagescode/tvcode/tvs-HD60.html',
    '4K 60-Inch TV': './pagescode/tvcode/tvs-4K60.html',
    'HD 80-Inch TV': './pagescode/tvcode/tvs-HD-80.html',
    '4K 80-Inch TV': './pagescode/tvcode/tvs-4K80.html',
    '2K 25 Inch Monitor': './pagescode/monitorscode/monitors-2K25.html',
    '4K 25 Inch Monitor': './pagescode/monitorscode/monitors-4K25.html',
    '2K 30 Inch Monitor': './pagescode/monitorscode/monitors-2K30.html',
    '4K 30 Inch Monitor': './pagescode/monitorscode/monitors-4K30.html',
    '12 Inch Windows Laptop': './pagescode/laptopscode/laptops-12W.html',
    '12 Inch Chrome Laptop': './pagescode/laptopscode/laptops-12C.html',
    '12 Inch Airbook Laptop': './pagescode/laptopscode/laptops-12A.html',
    '12 Inch Probook Laptop': './pagescode/laptopscode/laptops-12P.html',
    '16 Inch Windows Laptop': './pagescode/laptopscode/laptops-16W.html',
    '16 Inch Chrome Laptop': './pagescode/laptopscode/laptops-16C.html',
    '16 Inch Airbook Laptop': './pagescode/laptopscode/laptops-16A.html',
    '16 Inch Probook Laptop': './pagescode/laptopscode/laptops-16P.html',
    'In Ear Black Headphones': './pagescode/headphonescode/inearblack.html',
    'In Ear White Headphones': './pagescode/headphonescode/inearwhite.html',
    'In Ear Grey Headphones': './pagescode/headphonescode/ineargrey.html',
    'Over Ear Black Headphones': './pagescode/headphonescode/overearblack.html',
    'Over Ear White Headphones': './pagescode/headphonescode/overearwhite.html',
    'Over Ear Grey Headphones': './pagescode/headphonescode/overeargrey.html',
    'PS4': './pagescode/consolescode/ps4.html',
    'PS5': './pagescode/consolescode/ps5.html',
    'Xbox 1': './pagescode/consolescode/xbox1.html',
    'Wii': './pagescode/consolescode/nintendowii.html',
    'Wii U': './pagescode/consolescode/wiiu.html',
    'Switch': './pagescode/consolescode/switch.html'
};

const optionBox=document.querySelector(".optionbox");  
const inputBox=document.getElementById("inputsearch");

inputBox.onkeyup = function() {
    let result = [];
    let input = inputBox.value;
    if(input.length){

        result=searchitems.filter((keyword)=>{
            return keyword.toLowerCase().includes(input.toLowerCase());
        });

    } else {
        result=[];
    }
    display(result);
}

function display(result){
    if(result.length){
        const content =result.map((list)=>{
            const ref = itemrefs[list];
            return `<li><a href="${ref}">${list}</a></li>`;
     }).join("");
     optionBox.innerHTML = `<ul>${content}</ul>`;
    }else {
        optionBox.innerHTML = '<p>No results found.</p>';
    }
    }

