# CentralShop - Claude.md

## Estado del Proyecto
- **Fase:** Inicial - Implementación de Base de Datos, Admin CRUD y Vistas Informativas completadas.
- **Stack:** Laravel 12 + Bootstrap 5 + Alpine.js.
- **Objetivo:** Crear un ecommerce moderno, minimalista y rápido.

## Arquitectura
- **Framework:** Laravel 12
- **Frontend:** Blade, Bootstrap 5, Alpine.js
- **Base de Datos:** SQLite (Local) / MySQL (Prod)
- **Despliegue:** SFTP (DreamHost)

## Sistema de Diseño
- **Estilo:** Blackout / Premium Dark.
- **Paleta de Colores:**
  - Primario: #0F172A (Deep Dark)
  - Secundario: #2563EB (Blue)
  - Accent: #38BDF8 (Sky)
  - Fondo: #111827 (Blackout)
  - Texto: #F1F5F9 / #94A3B8

## Estructura de la Interfaz
- **Header:** Barra informativa con beneficios y rotador de mensajes.
- **Navbar:** Estilo Blackout, búsqueda inteligente, links de categorías.
- **Hero:** Banners temáticos con mascotas e imágenes de productos.
- **Cards:** Estilo premium dark con efectos hover y badges de oferta.

## Tareas Pendientes
- [x] Implementar Layout base en Blade (Bootstrap 5 + CDNs).
- [x] Configurar variables CSS con la paleta de colores Blackout.
- [x] Crear componentes de Navbar y Footer (Visa, MC, MP, PayPal).
- [x] Diseñar Hero Section y Banners promocionales.
- [x] Definir estructura de base de datos para productos y categorías.
- [x] Crear CRUD completo de Productos con carga de imágenes al servidor.
- [x] Crear CRUD completo de Categorías.
- [x] Implementar Modo Oscuro (Blackout) en Panel Admin y Tienda.
- [x] Crear vistas informativas (FAQ, Contacto Online, Nosotros, etc.).
- [x] Implementar suscripción a Newsletter por AJAX con gestión en Admin.
- [ ] Crear Seeders con datos reales de la imagen de referencia.

---
*Nota: Enfocado inicialmente en catálogo y branding, sin login ni carrito automatizado.*
