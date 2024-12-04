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

    const content=result.map((list)=>{

        return '<li>' + list + '</li>';
    }).join("");
    
    optionBox.innerHTML = "<ul>" +  content+ "</ul>";


}
