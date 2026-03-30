<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| Rutas para usuarios autenticados
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
/*    Route::get('/productos-json', function () {
    return response()->json(Product::all());
});

    Route::get('/productos', function () {
    return view('productos.index');
})->middleware(['auth'])->name('productos');

}); */

    /*
|--------------------------------------------------------------------------
| Rutas productos mas buscador
|--------------------------------------------------------------------------
*/
   Route::middleware(['auth'])->group(function () {

    // Vista de productos
    Route::get('/productos', function () {
        return view('productos.index');
    })->name('productos');

    // Endpoint JSON con búsqueda
    Route::get('/productos-json', function (Request $request) {

        $buscar = $request->buscar;

        $query = Product::query();

        if ($buscar) {
            $query->where('nombre', 'like', "%$buscar%");
        }

        return response()->json($query->get());

    });

}); 
    


/*
|--------------------------------------------------------------------------
| Rutas SOLO para ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin', function () {
        return "Panel de Administrador";
    })->name('admin.dashboard');

});


require __DIR__.'/auth.php';
