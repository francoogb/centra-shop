<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Subscriber;

Route::get('/', function () {
    $categories    = \App\Models\Category::where('is_active', true)->where('slug', '!=', 'ofertas')->get();
    $featured      = \App\Models\Product::with('category')->where('is_active', true)->where('is_featured', true)->where('is_book', false)->take(6)->get();
    $allProducts   = \App\Models\Product::with('category')->where('is_active', true)->where('is_book', false)->latest()->take(12)->get();
    $flashProducts = \App\Models\Product::with('category')->activeFlashSales()->where('is_book', false)->take(15)->get();
    $bookProducts  = \App\Models\Product::with('category')->where('is_active', true)->where('is_book', true)->latest()->get();
    return view('index', compact('categories', 'featured', 'allProducts', 'flashProducts', 'bookProducts'));
})->name('home_inicio');

// Sitemap XML
Route::get('/sitemap.xml', function () {
    $categories = \App\Models\Category::where('is_active', true)->get();
    $products   = \App\Models\Product::where('is_active', true)->select('slug', 'updated_at')->get();
    return response()
        ->view('sitemap', compact('categories', 'products'))
        ->header('Content-Type', 'application/xml');
})->name('sitemap');

// Rutas estáticas de navegación
Route::get('/nosotros', function () { return view('centralshop.nosotros'); })->name('nosotros');
Route::get('/envios', function () { return view('centralshop.envios'); })->name('envios');
Route::get('/cambios', function () { return view('centralshop.cambios'); })->name('cambios');
Route::get('/terminos', function () { return view('centralshop.terminos'); })->name('terminos');
Route::get('/privacidad', function () { return view('centralshop.privacidad'); })->name('privacidad');
Route::get('/preguntas-frecuentes', function () { return view('centralshop.preguntas'); })->name('preguntas');
Route::get('/ayuda', function () { return view('centralshop.ayuda'); })->name('ayuda');
Route::get('/medios-de-pago', function () { return view('centralshop.pagos'); })->name('pagos');
Route::get('/contacto', function () { return view('centralshop.contacto'); })->name('contacto');

// Formulario de Contacto
Route::post('/contacto', function (Request $request) {
    $request->validate([
        'name'    => 'required|string|max:100',
        'email'   => 'required|email|max:150',
        'subject' => 'required|string|max:200',
        'message' => 'required|string|max:2000',
    ]);
    \App\Models\Contact::create($request->only('name', 'email', 'subject', 'message'));

    try {
        \Illuminate\Support\Facades\Mail::send(
            'emails.contact',
            [
                'contactName'    => $request->name,
                'contactEmail'   => $request->email,
                'contactSubject' => $request->subject,
                'contactMessage' => $request->message,
            ],
            function ($message) use ($request) {
                $message->to(config('mail.from.address'))
                        ->replyTo($request->email, $request->name)
                        ->subject('Nuevo contacto: ' . $request->subject);
            }
        );
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error('Contact mail error: ' . $e->getMessage());
    }

    return response()->json(['success' => true]);
})->name('contacto.store');

// Newsletter subscription
Route::post('/subscribe', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    try {
        \App\Models\Subscriber::firstOrCreate(['email' => $request->email]);

        $appUrl = url('/');
        \Illuminate\Support\Facades\Mail::send(
            'emails.subscribe',
            compact('appUrl'),
            function ($message) use ($request) {
                $message->to($request->email)->subject('¡Bienvenido/a a CentralShop!');
            }
        );

        return response()->json(['success' => true, 'message' => '¡Suscripción exitosa! Gracias por unirte.']);
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error('Subscribe mail error: ' . $e->getMessage());
        return response()->json(['success' => true, 'message' => '¡Suscripción exitosa! Gracias por unirte.']);
    }
})->name('subscribe');

// Catálogo general y filtrado por categoría
Route::get('/catalogo/{slug?}', function (Request $request, string $slug = null) {
    $categories = \App\Models\Category::where('is_active', true)
        ->where('slug', '!=', 'ofertas')
        ->withCount([
            'products as active_products_count' => function ($query) {
                $query->where('is_active', true);
            }
        ])
        ->orderBy('name')
        ->get();
    $currentCategory = null;
    $searchTerm = trim((string) $request->query('q', ''));
    $totalActiveProducts = \App\Models\Product::where('is_active', true)->count();

    $query = \App\Models\Product::with('category')->where('is_active', true);

    if ($slug) {
        $currentCategory = \App\Models\Category::where('slug', $slug)->firstOrFail();
        $query->where('category_id', $currentCategory->id);
    }

    // Price Filtering
    if ($request->filled('min_price')) {
        $query->where(function($q) use ($request) {
            $q->where('price', '>=', $request->min_price)
              ->orWhere('discount_price', '>=', $request->min_price);
        });
    }
    if ($request->filled('max_price')) {
        $query->where(function($q) use ($request) {
            $q->where('price', '<=', $request->max_price)
              ->orWhere('discount_price', '<=', $request->max_price);
        });
    }

    if ($searchTerm !== '') {
        $query->where(function ($productQuery) use ($searchTerm) {
            $productQuery
                ->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('description', 'like', '%' . $searchTerm . '%')
                ->orWhereHas('category', function ($categoryQuery) use ($searchTerm) {
                    $categoryQuery->where('name', 'like', '%' . $searchTerm . '%');
                });
        });
    }

    $products = $query->latest()->get();

    return view('catalogo', compact('products', 'categories', 'currentCategory', 'searchTerm', 'totalActiveProducts'));
})->name('catalogo');

// Registro de click WhatsApp + redirect
Route::get('/wsp/{slug}', function (string $slug, Request $request) {
    $product = \App\Models\Product::where('slug', $slug)->firstOrFail();
    $phone   = $request->query('p', '56942922528');
    \App\Models\WhatsappContact::create([
        'product_id'   => $product->id,
        'product_name' => $product->name,
        'phone'        => $phone,
        'status'       => 'pendiente',
    ]);
    $message = urlencode('Hola CentralShop, quiero información sobre: ' . $product->name);
    return redirect("https://wa.me/{$phone}?text={$message}");
})->name('wsp.contact');

// Detalle del Producto (Pública)
Route::get('/producto/{slug}', function (string $slug) {
    $product = \App\Models\Product::with(['category', 'images'])->where('slug', $slug)->firstOrFail();
    $related  = \App\Models\Product::where('category_id', $product->category_id)
                    ->where('id', '!=', $product->id)->take(4)->get();
    return view('show', compact('product', 'related'));
})->name('product.show');

// Admin Auth
Route::get('/admin/login', fn () => view('admin.login'))->name('admin.login')->middleware('guest');

Route::post('/admin/login', function (Request $request) {
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);
    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended(route('admin.dashboard'));
    }
    return back()->withErrors(['email' => 'Credenciales incorrectas.'])->onlyInput('email');
})->name('admin.login.post')->middleware('guest');

Route::post('/admin/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('admin.login');
})->name('admin.logout')->middleware('auth');

// Panel de Administración
Route::prefix('admin')->middleware('auth')->group(function () {
    // Dashboard Principal
    Route::get('/', function () {
        $productsCount = \App\Models\Product::count();
        $categoriesCount = \App\Models\Category::count();
        $latestProducts = \App\Models\Product::latest()->take(5)->get();
        return view('admin.index', compact('productsCount', 'categoriesCount', 'latestProducts'));
    })->name('admin.dashboard');
    
    // Gestión de Categorías
    Route::get('/categories', function () {
        $categories = \App\Models\Category::all();
        return view('admin.categories.index', compact('categories'));
    })->name('admin.categories.index');

    // Crear Categoría (AJAX)
    Route::post('/categories', function (Request $request) {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'icon'      => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);

        $slug = \Illuminate\Support\Str::slug($validated['name']);
        $original = $slug;
        $i = 1;
        while (\App\Models\Category::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $i++;
        }

        $category = \App\Models\Category::create(array_merge($validated, [
            'slug'      => $slug,
            'is_active' => $request->boolean('is_active', true),
        ]));

        return response()->json(['success' => true, 'category' => $category]);
    })->name('admin.categories.store');

    // Actualizar Categoría (AJAX)
    Route::put('/categories/{category}', function (\App\Models\Category $category, Request $request) {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'icon'      => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);

        // Si el nombre cambia, actualizamos el slug (opcional, pero suele ser lo esperado)
        if ($category->name !== $validated['name']) {
            $slug = \Illuminate\Support\Str::slug($validated['name']);
            $original = $slug;
            $i = 1;
            while (\App\Models\Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
                $slug = $original . '-' . $i++;
            }
            $category->slug = $slug;
        }

        $category->update(array_merge($validated, [
            'is_active' => $request->boolean('is_active'),
        ]));

        return response()->json(['success' => true, 'category' => $category]);
    })->name('admin.categories.update');

    // Eliminar Categoría (AJAX)
    Route::delete('/categories/{category}', function (\App\Models\Category $category) {
        $category->delete();
        return response()->json(['success' => true]);
    })->name('admin.categories.destroy');
    
    // Gestión de Productos
    Route::get('/products', function () {
        $products   = \App\Models\Product::with('category')->latest()->get();
        $categories = \App\Models\Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products.index', compact('products', 'categories'));
    })->name('admin.products.index');

    // Toggle Flash Sale (AJAX)
    Route::post('/products/{product}/toggle-flash', function (\App\Models\Product $product, Request $request) {
        $product->flash_sale = !$product->flash_sale;
        $product->save();
        return response()->json(['success' => true, 'flash_sale' => $product->flash_sale]);
    })->name('admin.products.toggle-flash');

    // Guardar Fechas de Oferta Flash (AJAX)
    Route::post('/products/{product}/flash-dates', function (\App\Models\Product $product, Request $request) {
        $request->validate([
            'flash_sale_starts_at' => 'nullable|date',
            'flash_sale_ends_at'   => 'nullable|date|after_or_equal:flash_sale_starts_at',
        ]);
        $product->flash_sale_starts_at = $request->flash_sale_starts_at;
        $product->flash_sale_ends_at   = $request->flash_sale_ends_at;
        $product->flash_sale = true;
        $product->save();
        return response()->json(['success' => true]);
    })->name('admin.products.flash-dates');

    // Crear Producto (AJAX)
    Route::post('/products', function (Request $request) {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'category_id'    => 'required|exists:categories,id',
            'price'          => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'stock'          => 'required|integer|min:0',
            'description'    => 'nullable|string',
            'image'          => 'nullable|image|max:2048',
            'is_featured'    => 'boolean',
            'is_active'      => 'boolean',
        ]);

        $slug = \Illuminate\Support\Str::slug($validated['name']);
        $original = $slug;
        $i = 1;
        while (\App\Models\Product::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $i++;
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $imagePath = asset('storage/' . $imagePath);
        }

        $product = \App\Models\Product::create(array_merge($validated, [
            'slug'        => $slug,
            'image'       => $imagePath,
            'is_featured' => $request->boolean('is_featured'),
            'is_active'   => $request->boolean('is_active', true),
            'is_book'     => $request->boolean('is_book'),
        ]));

        // Handle Gallery Images (Batch)
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $path = $file->store('products/gallery', 'public');
                $product->images()->create([
                    'image_path' => asset('storage/' . $path)
                ]);
            }
        }

        $product->load(['category', 'images']);
        return response()->json(['success' => true, 'product' => $product]);
    })->name('admin.products.store');

    // Actualizar Producto (AJAX — acepta PUT y POST+_method)
    Route::match(['put','post'], '/products/{product}', function (\App\Models\Product $product, Request $request) {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'category_id'    => 'required|exists:categories,id',
            'price'          => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock'          => 'required|integer|min:0',
            'description'    => 'nullable|string',
            'image'          => 'nullable|image|max:2048',
            'is_featured'    => 'boolean',
            'is_active'      => 'boolean',
            'is_book'        => 'boolean',
        ]);

        $data = array_merge($validated, [
            'is_featured' => $request->boolean('is_featured'),
            'is_active'   => $request->boolean('is_active'),
            'is_book'     => $request->boolean('is_book'),
        ]);

        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe y no es una URL externa (opcional pero recomendado)
            if ($product->image && str_contains($product->image, asset('storage/'))) {
                $oldPath = str_replace(asset('storage/'), '', $product->image);
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldPath);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = asset('storage/' . $imagePath);
        } else {
            unset($data['image']); // Mantener la imagen actual si no se sube una nueva
        }

        $product->update($data);

        // Handle Gallery Images (Batch)
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $path = $file->store('products/gallery', 'public');
                $product->images()->create([
                    'image_path' => asset('storage/' . $path)
                ]);
            }
        }

        $product->load(['category', 'images']);
        return response()->json(['success' => true, 'product' => $product]);
    })->name('admin.products.update');

    // Eliminar Producto (AJAX)
    Route::delete('/products/{product}', function (\App\Models\Product $product) {
        $product->delete();
        return response()->json(['success' => true]);
    })->name('admin.products.destroy');
    
    // Gestión de Suscriptores
    Route::get('/subscribers', function () {
        $subscribers = \App\Models\Subscriber::latest()->get();
        return view('admin.subscribers.index', compact('subscribers'));
    })->name('admin.subscribers.index');

    // Eliminar múltiples suscriptores (AJAX)
    Route::delete('/subscribers/bulk', function (Request $request) {
        $request->validate(['ids' => 'required|array', 'ids.*' => 'integer']);
        \App\Models\Subscriber::whereIn('id', $request->ids)->delete();
        return response()->json(['success' => true]);
    })->name('admin.subscribers.bulk-destroy');

    // Eliminar Suscriptor (AJAX)
    Route::delete('/subscribers/{subscriber}', function (\App\Models\Subscriber $subscriber) {
        $subscriber->delete();
        return response()->json(['success' => true]);
    })->name('admin.subscribers.destroy');

    // Envío de Campaña a Suscriptores
    Route::post('/subscribers/campaign', function (\Illuminate\Http\Request $request) {
        $request->validate(['template' => 'required|string']);

        $templates = [
            'oferta_flash' => [
                'subject'     => '⚡ Oferta Flash exclusiva para ti — CentralShop',
                'badgeText'   => '⚡ Oferta Flash',
                'headline'    => '¡Solo por hoy! Precios increíbles en productos seleccionados',
                'intro'       => 'Tenemos ofertas por tiempo limitado que no puedes dejar pasar. Entra ahora y aprovecha antes de que se agoten.',
                'bodyContent' => '<p style="text-align:center;"><span style="color:#fbbf24;font-size:18px;font-weight:700;">🔥 Descuentos de hasta 40% OFF</span><br><span style="color:#94a3b8;font-size:14px;">Válido solo por las próximas 24 horas</span></p>',
                'ctaText'     => 'Ver Ofertas Ahora →',
            ],
            'nuevo_producto' => [
                'subject'     => '🆕 ¡Nuevo en CentralShop! Mira lo que llegó',
                'badgeText'   => '🆕 Nuevo Producto',
                'headline'    => '¡Llegaron novedades a la tienda!',
                'intro'       => 'Actualizamos nuestro catálogo con productos frescos que estabas esperando. Sé el primero en verlos.',
                'bodyContent' => '<p style="text-align:center;"><span style="color:#4ade80;font-size:18px;font-weight:700;">✅ Stock disponible ahora</span><br><span style="color:#94a3b8;font-size:14px;">Escríbenos por WhatsApp y te asesoramos</span></p>',
                'ctaText'     => 'Ver Nuevos Productos →',
            ],
            'bienvenida' => [
                'subject'     => '👋 ¡Bienvenido/a a CentralShop! Te tenemos un regalo',
                'badgeText'   => '👋 Bienvenida',
                'headline'    => '¡Gracias por unirte a nuestra comunidad!',
                'intro'       => 'Nos alegra tenerte con nosotros. Somos una tienda comprometida con ofrecerte los mejores productos al mejor precio.',
                'bodyContent' => '<p style="text-align:center;"><span style="color:#38bdf8;font-size:18px;font-weight:700;">🎁 Como bienvenida, tenemos envío prioritario en tu primera compra</span><br><span style="color:#94a3b8;font-size:14px;">Solo menciona este email al escribirnos por WhatsApp</span></p>',
                'ctaText'     => 'Explorar la Tienda →',
            ],
            'promo_especial' => [
                'subject'     => '🎉 Promoción especial — Solo para suscriptores',
                'badgeText'   => '🎉 Promo Especial',
                'headline'    => '¡Una promoción creada especialmente para ti!',
                'intro'       => 'Por ser parte de nuestra comunidad, tienes acceso anticipado a esta oferta exclusiva. Solo disponible para suscriptores.',
                'bodyContent' => '<p style="text-align:center;"><span style="color:#c084fc;font-size:18px;font-weight:700;">💜 Beneficio exclusivo para suscriptores</span><br><span style="color:#94a3b8;font-size:14px;">Escríbenos por WhatsApp mencionando "SUSCRIPTOR"</span></p>',
                'ctaText'     => 'Reclamar Beneficio →',
            ],
        ];

        $tpl = $templates[$request->template] ?? null;
        if (!$tpl) return response()->json(['success' => false, 'message' => 'Plantilla no encontrada.'], 422);

        $subscribers = \App\Models\Subscriber::all();
        if ($subscribers->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No hay suscriptores para enviar.'], 422);
        }

        $appUrl = url('/');
        $ctaUrls = [
            'oferta_flash'   => url('/catalogo'),
            'nuevo_producto' => url('/catalogo'),
            'bienvenida'     => url('/'),
            'promo_especial' => url('/catalogo'),
        ];
        $ctaUrl = $ctaUrls[$request->template] ?? url('/');
        $sent   = 0;
        $errors = 0;

        foreach ($subscribers as $subscriber) {
            try {
                \Illuminate\Support\Facades\Mail::send(
                    'emails.campaign',
                    array_merge($tpl, compact('appUrl', 'ctaUrl')),
                    function ($message) use ($subscriber, $tpl) {
                        $message->to($subscriber->email)->subject($tpl['subject']);
                    }
                );
                $sent++;
            } catch (\Exception $e) {
                $errors++;
                \Illuminate\Support\Facades\Log::error('Campaign mail error: ' . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Campaña enviada a {$sent} suscriptores." . ($errors > 0 ? " ({$errors} errores)" : ''),
        ]);
    })->name('admin.subscribers.campaign');

    // Perfil del usuario logueado
    Route::get('/profile', fn () => view('admin.profile'))->name('admin.profile');

    Route::put('/profile', function (Request $request) {
        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
        ]);
        auth()->user()->update($request->only('name', 'email'));
        return response()->json(['success' => true]);
    })->name('admin.profile.update');

    Route::put('/profile/password', function (Request $request) {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:8',
        ], [
            'current_password.required' => 'Ingresa tu contraseña actual.',
            'new_password.required'     => 'Ingresa la nueva contraseña.',
            'new_password.min'          => 'La nueva contraseña debe tener al menos 8 caracteres.',
        ]);
        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, auth()->user()->password)) {
            return response()->json(['success' => false, 'message' => 'La contraseña actual es incorrecta.']);
        }
        auth()->user()->update(['password' => \Illuminate\Support\Facades\Hash::make($request->new_password)]);
        return response()->json(['success' => true, 'message' => 'Contraseña actualizada correctamente.']);
    })->name('admin.profile.password');

    // Gestión de Usuarios (solo super admin)
    Route::get('/users', function () {
        if (!auth()->user()->is_super_admin) abort(403);
        $users = \App\Models\User::latest()->get();
        return view('admin.users.index', compact('users'));
    })->name('admin.users.index');

    Route::post('/users', function (Request $request) {
        if (!auth()->user()->is_super_admin) abort(403);
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'is_super_admin' => 'boolean',
        ]);
        $user = \App\Models\User::create([
            'name'           => $request->name,
            'email'          => $request->email,
            'password'       => \Illuminate\Support\Facades\Hash::make($request->password),
            'is_super_admin' => $request->boolean('is_super_admin'),
        ]);
        return response()->json(['success' => true, 'user' => $user]);
    })->name('admin.users.store');

    Route::put('/users/{user}', function (\App\Models\User $user, Request $request) {
        if (!auth()->user()->is_super_admin) abort(403);
        $request->validate([
            'name'           => 'required|string|max:100',
            'email'          => 'required|email|unique:users,email,' . $user->id,
            'password'       => 'nullable|min:8',
            'is_super_admin' => 'boolean',
        ]);
        $data = [
            'name'           => $request->name,
            'email'          => $request->email,
            'is_super_admin' => $request->boolean('is_super_admin'),
        ];
        if ($request->filled('password')) {
            $data['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
        }
        $user->update($data);
        return response()->json(['success' => true]);
    })->name('admin.users.update');

    Route::delete('/users/{user}', function (\App\Models\User $user) {
        if (!auth()->user()->is_super_admin) abort(403);
        if ($user->id === auth()->id()) {
            return response()->json(['success' => false, 'message' => 'No puedes eliminarte a ti mismo.']);
        }
        $user->delete();
        return response()->json(['success' => true]);
    })->name('admin.users.destroy');

    // Gestión de Contactos WhatsApp
    Route::get('/orders', function () {
        $contacts    = \App\Models\WhatsappContact::with('product')->latest()->get();
        $total       = $contacts->count();
        $pendientes  = $contacts->where('status', 'pendiente')->count();
        $concretadas = $contacts->where('status', 'concretada')->count();
        return view('admin.orders.index', compact('contacts', 'total', 'pendientes', 'concretadas'));
    })->name('admin.orders.index');

    Route::delete('/orders/bulk', function (Request $request) {
        $request->validate(['ids' => 'required|array', 'ids.*' => 'integer']);
        \App\Models\WhatsappContact::whereIn('id', $request->ids)->delete();
        return response()->json(['success' => true]);
    })->name('admin.orders.bulk-destroy');

    Route::patch('/orders/{contact}/status', function (\App\Models\WhatsappContact $contact, Request $request) {
        $contact->update(['status' => $request->status]);
        return response()->json(['success' => true]);
    })->name('admin.orders.status');

    Route::delete('/orders/{contact}', function (\App\Models\WhatsappContact $contact) {
        $contact->delete();
        return response()->json(['success' => true]);
    })->name('admin.orders.destroy');
});
