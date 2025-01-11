const xhr = new XMLHttpRequest();
xhr.open("GET", "../data/xml/menu.xml", true);
xhr.onload = function() {
  if (xhr.status === 200) {
    const xmlDoc = xhr.responseXML;
    const items = xmlDoc.getElementsByTagName("item");

    let menuHTML = "";
    for (let i = 0; i < items.length; i++) {
      const nombre = items[i].getElementsByTagName("nombre")[0].textContent;
      const link = items[i].getElementsByTagName("link")[0].textContent;
      const subItems = items[i].getElementsByTagName("subitem");

      if (subItems.length > 0) {
        menuHTML += `
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" href="#" id="dropdown${i}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              ${nombre}
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdown${i}">
        `;
        for (let j = 0; j < subItems.length; j++) {
          const subNombre = subItems[j].getElementsByTagName("nombre")[0].textContent;
          const subLink = subItems[j].getElementsByTagName("link")[0].textContent;
          menuHTML += `<li><a class="dropdown-item" href="${subLink}">${subNombre}</a></li>`;
        }
        menuHTML += `</ul></li>`;
      } else {
        menuHTML += `<li class="nav-item"><a class="nav-link text-dark" href="${link}">${nombre}</a></li>`;
      }
    }
    document.getElementById("menu").innerHTML = menuHTML;
  } else {
    console.error("Error al cargar el menú XML");
  }
};
xhr.send();
