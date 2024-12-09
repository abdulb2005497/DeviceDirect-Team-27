
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
            'HD 40-Inch TV': './productspage/pagescode/tvcode/tvs-HD40.php',
            '4K 40-Inch TV': './productspage/pagescode/tvcode/tvs-4K40.php',
            'HD 60-Inch TV': './productspage/pagescode/tvcode/tvs-HD60.php',
            '4K 60-Inch TV': './productspage/pagescode/tvcode/tvs-4K60.php',
            'HD 80-Inch TV': './productspage/pagescode/tvcode/tvs-HD-80.php',
            '4K 80-Inch TV': './productspage/pagescode/tvcode/tvs-4K80.php',
            '2K 25 Inch Monitor': './productspage/pagescode/monitorscode/monitors-2K25.php',
            '4K 25 Inch Monitor': './productspage/pagescode/monitorscode/monitors-4K25.php',
            '2K 30 Inch Monitor': './productspage/pagescode/monitorscode/monitors-2K30.php',
            '4K 30 Inch Monitor': './productspage/pagescode/monitorscode/monitors-4K30.php',
            '12 Inch Windows Laptop': './productspage/pagescode/laptopscode/laptops-12W.php',
            '12 Inch Chrome Laptop': './productspage/pagescode/laptopscode/laptops-12C.php',
            '12 Inch Airbook Laptop': './productspage/pagescode/laptopscode/laptops-12A.php',
            '12 Inch Probook Laptop': './productspage/pagescode/laptopscode/laptops-12P.php',
            '16 Inch Windows Laptop': './productspage/pagescode/laptopscode/laptops-16W.php',
            '16 Inch Chrome Laptop': './productspage/pagescode/laptopscode/laptops-16C.php',
            '16 Inch Airbook Laptop': './productspage/pagescode/laptopscode/laptops-16A.php',
            '16 Inch Probook Laptop': './productspage/pagescode/laptopscode/laptops-16P.php',
            'In Ear Black Headphones': './productspage/pagescode/headphonescode/inearblack.php',
            'In Ear White Headphones': './productspage/pagescode/headphonescode/inearwhite.php',
            'In Ear Grey Headphones': './productspage/scode/headphonescode/ineargrey.php',
            'Over Ear Black Headphones': './productspage/pagescode/headphonescode/overearblack.php',
            'Over Ear White Headphones': './productspage/pagescode/headphonescode/overearwhite.php',
            'Over Ear Grey Headphones': './productspage/pagescode/headphonescode/overeargrey.php',
            'PS4': './productspage/pagescode/consolescode/ps4.php',
            'PS5': './productspage/pagescode/consolescode/ps5.php',
            'Xbox 1': './productspage/pagescode/consolescode/xbox1.php',
            'Wii': './productspage/pagescode/consolescode/nintendowii.php',
            'Wii U': './productspage/pagescode/consolescode/wiiu.php',
            'Switch': './productspage/pagescode/consolescode/switch.php'
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
      
    
    