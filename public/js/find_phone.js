
let ROOT_URL = 'http://localhost:8000/';

// async function getAllItems(){
//     let response = await fetch(`${ROOT_URL}show_car`, {
//         method: 'GET',
//         headers: {
//           'Content-Type': 'application/json;charset=utf-8',
//         },
//       });

//       return await response.json();
   
//   }


async function getAllItems(id){

  let items = await fetch(`${ROOT_URL}api/get_user_contacts?group_id=${id}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json;charset=utf-8',
      },
    });

    
      return await items.json();
   
  }

const onLoad = async() => {
  
  console.log('loaded doc');


  document.getElementById('findButton').onclick = async() => {

    let id = document.getElementById('idInput').value;
    console.log(id);
   
    

   let items = await getAllItems(id);
    
    console.log((items));

    const raw = document.createElement("tr");
      const col1 = document.createElement("td");
      const col2 = document.createElement("td");
      col1.textContent = 'ФИО';
      col2.textContent = 'Телефон';
      raw.appendChild(col1);
      raw.appendChild(col2);
      content.appendChild(raw);

    for (const item of items) {
      const raw = document.createElement("tr");
      const col1 = document.createElement("td");
      const col2 = document.createElement("td");
      col1.textContent = item['name'];
      col2.textContent = item['phone'];

      raw.appendChild(col1);
      raw.appendChild(col2);
      //string.textContent = item['name'] + "\t" +item['phone'];
      content.appendChild(raw);
    }
  }
//   //document.getElementById('catalog').onclick = async() => {
//     let items = await getAllItems();
    
//     for (const item of items) {
//     const element = document.createElement("div");
//     element.classList.add("item");

//     const title = document.createElement("p");
//     title.textContent = item.name;
    
//     const href = document.createElement("a");
   

//     const button = document.createElement("button");
//     button.classList.add("go-to-item");
//     button.id = item.id;
//     button.textContent = "Подробнее";
    
//     const image = document.createElement("img");
//     image.src = item.main_photo;
    
//     href.appendChild(button);
//     element.appendChild(image);
//     element.appendChild(title);
//     element.appendChild(href);
//     document.querySelector(".content").appendChild(element);
    




//     ////////////////////////////////////////
  
//   }

  
//   const elements = document.getElementsByClassName("go-to-item");
  
//   for(const element of elements)
//   {
//     element.onclick = async() =>{
//       window.location.href = ROOT_URL + 'item/' + element.id;
//       }
//   }
 
};

document.addEventListener('DOMContentLoaded', onLoad);
