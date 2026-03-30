import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

console.log("JS cargado");

document.addEventListener("DOMContentLoaded", () => {

  const contenedor = document.getElementById('productos');
  const buscador = document.getElementById('buscador');

  function cargarProductos(busqueda = "") {

    fetch(`/productos-json?buscar=${encodeURIComponent(busqueda)}`)
      .then(res => res.json())
      .then(productos => {

        if (!contenedor) return;

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

  // Si estás en la página de productos
  if (contenedor) {
    cargarProductos();

    if (buscador) {
      buscador.addEventListener('keyup', (e) => {
        cargarProductos(e.target.value);
      });
    }
  }

  // Si estás en cualquier otra página (navbar)
  if (buscador && !contenedor) {
    buscador.addEventListener('keyup', (e) => {

      if (e.key === 'Enter') {
        const valor = e.target.value;
        window.location.href = `/productos?buscar=${valor}`;
      }

    });
  }

});
