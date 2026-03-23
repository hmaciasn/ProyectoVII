import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
const contenedor = document.getElementById('productos');

if (contenedor) {
  fetch('/productos-json')
    .then(res => res.json())
    .then(productos => {
      console.log(productos);

      contenedor.innerHTML = "";

      productos.forEach(p => {
        contenedor.innerHTML += `
          <div class="border p-4 rounded shadow">
            <h3>${p.name}</h3>
            <p>${p.description ?? ''}</p>
            <strong>$${p.price}</strong>
          </div>
        `;
      });
    })
    .catch(err => console.error("ERROR:", err));
}

