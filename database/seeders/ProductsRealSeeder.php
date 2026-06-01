<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductsRealSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Categorías ───────────────────────────────────────────────
        $categories = [
            'seguridad' => ['name' => 'Seguridad & Vigilancia', 'icon' => 'bi-shield-check'],
            'hogar'     => ['name' => 'Hogar & Confort', 'icon' => 'bi-house-heart'],
            'cocina'    => ['name' => 'Electrodomésticos de Cocina', 'icon' => 'bi-cup-hot'],
            'belleza'   => ['name' => 'Belleza & Cuidado Personal', 'icon' => 'bi-person-heart'],
            'tech'      => ['name' => 'Tecnología & Gadgets', 'icon' => 'bi-cpu'],
            'herramientas' => ['name' => 'Herramientas & Accesorios', 'icon' => 'bi-tools'],
            'camping'   => ['name' => 'Camping & Aire Libre', 'icon' => 'bi-tree'],
        ];

        $catModels = [];
        foreach ($categories as $slug => $data) {
            $catModels[$slug] = Category::firstOrCreate(['slug' => $slug], [
                'name'      => $data['name'],
                'icon'      => $data['icon'],
                'is_active' => true
            ]);
        }

        // ─── Productos Únicos ──────────────────────────────────────────
        $productos = [
            // SEGURIDAD
            [
                'category_id' => $catModels['seguridad']->id,
                'name' => 'Cámara de Seguridad WiFi TASBEL Smart Camera PTZ',
                'description' => 'Cámara de vigilancia profesional TASBEL con tecnología Smart WiFi. Cuenta con movimiento PTZ (Pan/Tilt/Zoom) controlable desde el celular, visión nocturna infrarroja de alta potencia, audio bidireccional para hablar y escuchar, y ranura para memoria Micro SD. Ideal para exteriores e interiores con detección de movimiento inteligente.',
                'image' => 'products/WhatsApp Image 2026-04-17 at 07.47.07 (2).jpeg',
                'price' => 29990,
                'discount_price' => 24990,
            ],
            [
                'category_id' => $catModels['seguridad']->id,
                'name' => 'Cámara WiFi Panorama 360° tipo Ampolleta',
                'description' => 'Innovadora cámara de seguridad con forma de ampolleta para una instalación discreta y sencilla en cualquier soquete estándar. Ofrece una visión panorámica de 360 grados, conexión WiFi estable, alertas al celular y visión nocturna. Perfecta para monitorear hogares u oficinas sin cables complicados.',
                'image' => 'products/WhatsApp Image 2026-04-17 at 07.47.08.jpeg',
                'price' => 21990,
                'discount_price' => 18990,
            ],

            // HOGAR
            [
                'category_id' => $catModels['hogar']->id,
                'name' => 'Calefactor Eléctrico Portátil FU YUAN 800W',
                'description' => 'Estufa eléctrica portátil FU YUAN con dos niveles de potencia (400W/800W). Diseño compacto con rejilla de seguridad, ideal para espacios pequeños, oficinas o dormitorios. Cuenta con tubos de cuarzo de alta eficiencia térmica y switch de seguridad anti-vuelco.',
                'image' => 'products/WhatsApp Image 2026-04-16 at 17.42.07 (2).jpeg',
                'price' => 12990,
                'discount_price' => 9990,
            ],
            [
                'category_id' => $catModels['hogar']->id,
                'name' => 'Mini Calefactor de Pared Handy Heater 400W',
                'description' => 'El original Handy Heater es un calefactor cerámico compacto que se conecta directamente a la toma de corriente de la pared. Con 400W de potencia, termostato ajustable de 15°C a 32°C, temporizador programable y pantalla digital LED. Ahorra espacio y calienta cualquier habitación rápidamente.',
                'image' => 'products/WhatsApp Image 2026-04-16 at 17.42.08.jpeg',
                'price' => 15990,
                'discount_price' => 12990,
            ],
            [
                'category_id' => $catModels['hogar']->id,
                'name' => 'Dispensador de Agua Eléctrico TASBEL Intelligent',
                'description' => 'Bomba de agua eléctrica recargable TASBEL con control táctil inteligente. Compatible con botellones de 5L a 20L. Batería de larga duración mediante carga USB, fabricado con materiales de grado alimenticio y manguera de silicona. Solución higiénica y moderna para su cocina u oficina.',
                'image' => 'products/WhatsApp Image 2026-04-16 at 17.42.02.jpeg',
                'price' => 9990,
                'discount_price' => 7990,
            ],

            // COCINA
            [
                'category_id' => $catModels['cocina']->id,
                'name' => 'Licuadora Profesional Hoffmans HM-920 800W',
                'description' => 'Potente licuadora Hoffmans con motor de 800W de alto rendimiento. Incluye jarra de vidrio grueso resistente a choques térmicos y accesorio molinillo seco para granos de café o especias. 5 velocidades más función pulso, cuchillas de acero inoxidable de 6 aspas para triturar hielo sin esfuerzo.',
                'image' => 'products/WhatsApp Image 2026-04-16 at 17.42.13.jpeg',
                'price' => 34990,
                'discount_price' => 29990,
            ],
            [
                'category_id' => $catModels['cocina']->id,
                'name' => 'Hervidor Eléctrico de Vidrio ROF-1 2.0L',
                'description' => 'Elegante hervidor de agua eléctrico ROF con cuerpo de vidrio borosilicato de alta resistencia y capacidad de 2 litros. Potencia de 1500W para un hervido rápido, luz LED azul indicadora de funcionamiento, base giratoria 360° y sistema de apagado automático por seguridad.',
                'image' => 'products/WhatsApp Image 2026-04-16 at 17.42.45 (1).jpeg',
                'price' => 16990,
                'discount_price' => null,
            ],
            [
                'category_id' => $catModels['cocina']->id,
                'name' => 'Hervidor Eléctrico Térmico MARADO 2.3L',
                'description' => 'Hervidor eléctrico MARADO de gran capacidad (2.3 litros). Diseño de doble capa con interior de acero inoxidable para mantener el calor por más tiempo y exterior frío al tacto. Potente, duradero y con diseño minimalista moderno para cualquier cocina.',
                'image' => 'products/WhatsApp Image 2026-04-16 at 17.42.46.jpeg',
                'price' => 14990,
                'discount_price' => null,
            ],
            [
                'category_id' => $catModels['cocina']->id,
                'name' => 'Batidora de Mano TASBEL Super Hand Mixer',
                'description' => 'Batidora manual TASBEL de 300W con 7 velocidades ajustables. Incluye juegos de batidores y ganchos para masa de acero inoxidable. Ligera, ergonómica y potente, ideal para preparar postres, cremas y mezclas de repostería con total comodidad.',
                'image' => 'products/WhatsApp Image 2026-04-16 at 17.41.57.jpeg',
                'price' => 12990,
                'discount_price' => null,
            ],
            [
                'category_id' => $catModels['cocina']->id,
                'name' => 'Sandwichera Eléctrica 2 Panes 1200W',
                'description' => 'Sandwichera de alta potencia con placas antiadherentes de fácil limpieza. Capacidad para dos sándwiches divididos en triángulos perfectos. Luces indicadoras de encendido y listo, cierre de seguridad y diseño compacto para almacenamiento vertical.',
                'image' => 'products/WhatsApp Image 2026-04-16 at 17.42.03.jpeg',
                'price' => 18990,
                'discount_price' => 15990,
            ],
            [
                'category_id' => $catModels['cocina']->id,
                'name' => 'Minipimer RoyalMaster 300W Blanca',
                'description' => 'Batidora de inmersión RoyalMaster con motor de 300W optimizado para bajo ruido. Cuchillas de acero inoxidable de alta resistencia, mango ergonómico y diseño desmontable para una limpieza rápida. Perfecta para sopas, batidos y papillas.',
                'image' => 'products/WhatsApp Image 2026-04-17 at 07.47.08 (1).jpeg',
                'price' => 14990,
                'discount_price' => null,
            ],

            // BELLEZA & CUIDADO PERSONAL
            [
                'category_id' => $catModels['belleza']->id,
                'name' => 'Trimmer Profesional VINTAGE T9 Golden',
                'description' => 'Cortadora de pelo y barba profesional Vintage T9 con diseño tallado de dragón en metal dorado. Cuchilla en T de acero al carbono para cortes ultra precisos al ras. Inalámbrica, recargable por USB, incluye peines guía y kit de mantenimiento. El estilo clásico con tecnología moderna.',
                'image' => 'products/WhatsApp Image 2026-04-16 at 17.41.56.jpeg',
                'price' => 12990,
                'discount_price' => 9990,
            ],
            [
                'category_id' => $catModels['belleza']->id,
                'name' => 'Afeitadora Eléctrica IRM 3 en 1 Recargable',
                'description' => 'Sistema de aseo personal completo IRM. Incluye cabezal de afeitado rotativo, trimmer de nariz y oídos, y recortadora de precisión. Cuchillas autoafilables, diseño ergonómico y batería de larga duración. Todo lo que un hombre necesita para su cuidado diario en un solo dispositivo.',
                'image' => 'products/WhatsApp Image 2026-04-16 at 17.41.54.jpeg',
                'price' => 19990,
                'discount_price' => 15990,
            ],
            [
                'category_id' => $catModels['belleza']->id,
                'name' => 'Cepillo Secador Eléctrico 3 en 1 Voluminizador',
                'description' => 'Potente cepillo secador que seca, alisa y da volumen a tu cabello en un solo paso. Tecnología de iones negativos para reducir el frizz y proteger el pelo del daño térmico. Cerdas mixtas desenredantes y múltiples niveles de calor. Logra un acabado de salón en casa.',
                'image' => 'products/WhatsApp Image 2026-04-16 at 17.41.49.jpeg',
                'price' => 18990,
                'discount_price' => 14990,
            ],
            [
                'category_id' => $catModels['belleza']->id,
                'name' => 'Alisador de Pelo Kerati Therapy Pro HD-1533',
                'description' => 'Plancha alisadora profesional con placas de cerámica avanzada impregnadas con keratina. Control de temperatura digital, calentamiento rápido y placas flotantes para un deslizamiento perfecto. Protege tu fibra capilar mientras logras un liso brillante y duradero.',
                'image' => 'products/WhatsApp Image 2026-04-16 at 17.41.53.jpeg',
                'price' => 22990,
                'discount_price' => 18990,
            ],
            [
                'category_id' => $catModels['belleza']->id,
                'name' => 'Depiladora Facial 2 en 1 TASBEL USB',
                'description' => 'Depiladora facial de precisión con diseño elegante y compacto tipo labial. Recargable por USB, incluye cabezal para cejas y cabezal para vello facial fino. Indolora, segura para todo tipo de piel y con luz LED integrada para no perder ningún detalle.',
                'image' => 'products/WhatsApp Image 2026-04-16 at 17.41.55.jpeg',
                'price' => 8990,
                'discount_price' => null,
            ],
            [
                'category_id' => $catModels['belleza']->id,
                'name' => 'Pistola de Masaje Muscular Mini Massage Gun',
                'description' => 'Pistola de masaje de percusión ultra compacta para recuperación muscular y alivio del estrés. Cuenta con múltiples niveles de intensidad, funcionamiento silencioso y batería recargable. Incluye diferentes cabezales para tratar distintas zonas del cuerpo. Ideal para deportistas y uso doméstico.',
                'image' => 'products/WhatsApp Image 2026-04-16 at 17.42.01.jpeg',
                'price' => 24990,
                'discount_price' => 19990,
            ],

            // TECH & GADGETS
            [
                'category_id' => $catModels['tech']->id,
                'name' => 'TV Box TASBEL 5G 6K Ultra HD',
                'description' => 'Transforma tu televisor en un potente Smart TV con el TV Box TASBEL. Soporta resolución 6K, conexión WiFi 5G de alta velocidad, 8GB de RAM y 128GB de almacenamiento. Viene con Android 14 preinstalado, control remoto y acceso a miles de apps como Netflix, YouTube y Disney+.',
                'image' => 'products/WhatsApp Image 2026-04-16 at 17.41.47.jpeg',
                'price' => 45990,
                'discount_price' => 38990,
            ],
            [
                'category_id' => $catModels['tech']->id,
                'name' => 'Game Stick 4K Ultra HD con 2 Mandos Inalámbricos',
                'description' => 'Consola retro portátil tipo pendrive que se conecta directamente al HDMI del televisor. Incluye miles de juegos clásicos preinstalados y dos controles inalámbricos de 2.4GHz. Disfruta de la nostalgia de las consolas clásicas en alta definición 4K.',
                'image' => 'products/WhatsApp Image 2026-04-16 at 17.41.48.jpeg',
                'price' => 32990,
                'discount_price' => 27990,
            ],
            [
                'category_id' => $catModels['tech']->id,
                'name' => 'Parlante Bluetooth TASBEL Sphere con Luces LED',
                'description' => 'Parlante inalámbrico con diseño esférico moderno y sonido envolvente 360°. Cuenta con efectos de luces LED rítmicas, entrada USB, ranura Micro SD y radio FM. Batería recargable para llevar tu música a todas partes con estilo.',
                'image' => 'products/WhatsApp Image 2026-04-16 at 17.42.32.jpeg',
                'price' => 14990,
                'discount_price' => null,
            ],
            [
                'category_id' => $catModels['tech']->id,
                'name' => 'Power Bank SOLMA 20000mAh Ultra-Thin',
                'description' => 'Batería externa SOLMA de alta capacidad (20000mAh) con diseño ultra delgado. Permite cargar hasta 3 dispositivos simultáneamente, cuenta con pantalla digital LED indicadora de carga, linterna integrada y múltiples protecciones de seguridad. Nunca te quedes sin energía.',
                'image' => 'products/WhatsApp Image 2026-04-16 at 17.42.42 (2).jpeg',
                'price' => 22990,
                'discount_price' => 19990,
            ],
            [
                'category_id' => $catModels['tech']->id,
                'name' => 'Cargador Rápido 5.8A SEMMA con Cable USB',
                'description' => 'Cargador de pared de alta velocidad con salida de 5.8A. Incluye cable USB de alta calidad. Tecnología Smart Chip para una carga segura y eficiente, compatible con smartphones, tablets y otros dispositivos electrónicos.',
                'image' => 'products/WhatsApp Image 2026-04-16 at 17.42.43.jpeg',
                'price' => 8990,
                'discount_price' => 6990,
            ],
            [
                'category_id' => $catModels['tech']->id,
                'name' => 'Drone 998 PRO con Doble Cámara 4K',
                'description' => 'Drone plegable 998 PRO ideal para principiantes y entusiastas. Cuenta con doble cámara 4K UHD, transmisión en tiempo real vía WiFi, modo "headless", mantenimiento de altura y despegue/aterrizaje con un solo botón. Control remoto incluido y compatible con app móvil.',
                'image' => 'products/WhatsApp Image 2026-04-16 at 17.41.47 (1).jpeg',
                'price' => 39990,
                'discount_price' => 34990,
            ],

            // HERRAMIENTAS
            [
                'category_id' => $catModels['herramientas']->id,
                'name' => 'Alargador Eléctrico Multipresa 15 Metros',
                'description' => 'Extensión eléctrica reforzada de 15 metros con regleta de 4 tomas universales y switch de encendido/apagado con luz piloto. Soporta hasta 2500W, ideal para uso doméstico, talleres o jardín. Cable de alta resistencia y durabilidad.',
                'image' => 'products/WhatsApp Image 2026-04-16 at 17.42.25.jpeg',
                'price' => 12990,
                'discount_price' => null,
            ],

            // CAMPING
            [
                'category_id' => $catModels['camping']->id,
                'name' => 'Anafe Cocinilla Portátil TASBEL 1 Hornalla',
                'description' => 'Cocinilla a gas portátil de 1 hornalla marca TASBEL. Ideal para camping, picnics o como emergencia en casa. Encendido electrónico, control de llama ajustable y maletín de transporte incluido (según disponibilidad). Robusta y fácil de usar.',
                'image' => 'products/WhatsApp Image 2026-04-17 at 07.47.07 (1).jpeg',
                'price' => 15990,
                'discount_price' => 12990,
            ],
            [
                'category_id' => $catModels['camping']->id,
                'name' => 'Anafe a Gas 3 Hornallas con Kit de Instalación',
                'description' => 'Cocina de sobremesa a gas con 3 quemadores de alto rendimiento. Incluye kit completo: regulador de gas, manguera y abrazaderas. Tapa protectora metálica, perillas frontales de precisión. La solución completa para cocinar en el exterior o en espacios reducidos.',
                'image' => 'products/WhatsApp Image 2026-04-17 at 07.47.07.jpeg',
                'price' => 35990,
                'discount_price' => 29990,
            ],
        ];

        foreach ($productos as $data) {
            Product::firstOrCreate(
                ['slug' => Str::slug($data['name'])],
                array_merge($data, [
                    'slug'           => Str::slug($data['name']),
                    'stock'          => rand(10, 50),
                    'is_featured'    => rand(0, 1) == 1,
                    'is_active'      => true,
                    'flash_sale'     => rand(0, 5) == 0,
                ])
            );
        }
    }
}
