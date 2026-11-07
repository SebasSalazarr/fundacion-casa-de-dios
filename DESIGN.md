---
name: Fundación Casa de Dios Fuente de Agua Viva
description: Una página cálida y humana donde las personas reales llevan la voz.
colors:
  arena: "#fbf7f0"
  blanco: "#fffefb"
  durazno: "#fbe8db"
  cielo: "#e0f0f8"
  coral: "#c2412d"
  coral-hondo: "#a53422"
  tinta: "#2b2622"
  tinta-suave: "#5f564c"
  linea: "#e8dfd2"
typography:
  display:
    fontFamily: "Bricolage Grotesque Variable, system-ui, sans-serif"
    fontSize: "clamp(1.875rem, 3.6vw, 3rem)"
    fontWeight: 700
    lineHeight: 1.08
    letterSpacing: "-0.02em"
  body:
    fontFamily: "Figtree Variable, system-ui, sans-serif"
    fontSize: "1.0625rem"
    fontWeight: 400
    lineHeight: 1.6
rounded:
  foto: "20px"
  panel: "32px"
  control: "999px"
components:
  button-primary:
    backgroundColor: "{colors.coral}"
    textColor: "#ffffff"
    rounded: "{rounded.control}"
    height: "3.5rem"
  button-primary-hover:
    backgroundColor: "{colors.coral-hondo}"
  button-soft:
    backgroundColor: "{colors.durazno}"
    textColor: "{colors.coral-hondo}"
    rounded: "{rounded.control}"
---

# Design System: Fundación Casa de Dios Fuente de Agua Viva

## Overview

**Creative North Star: "La casa abierta"**

Una página tranquila y cercana: fondo arena, paneles suaves y fotos reales a todo color. El color fuerte lo ponen las personas de las fotos; la interfaz se queda en tonos suaves para no competir con ellas.

**Key Characteristics:**
- Fondo claro con paneles durazno y cielo muy suaves.
- Fotos reales con esquinas redondeadas, sin filtros ni texto encima.
- Coral solo para las acciones de donar.

## Colors

Tonos suaves y cálidos, con un único acento.

### Primary
- **Coral:** botones de donar, enlaces y foco. Nada más lleva este color.

### Secondary
- **Durazno y Cielo:** paneles que agrupan secciones. Durazno para hacer y donar; cielo para misión e historias.

### Neutral
- **Arena y Blanco:** fondo general y tarjetas.
- **Tinta y Tinta suave:** títulos y texto secundario.

### Named Rules
**The Acento Único Rule.** El coral se reserva para donar y para enlaces; nunca cubre planos grandes.

## Typography

**Display Font:** Bricolage Grotesque (con system-ui)
**Body Font:** Figtree (con system-ui)

**Character:** Títulos modernos con un trazo amable, sobre una letra de texto muy legible en celular.

### Hierarchy
- **Display** (700, 2.125–3.75rem, 1.08): título principal y títulos de sección.
- **Title** (700, 1.1875–1.375rem): subtítulos y nombres de valores.
- **Body** (400, 1.0625rem, 1.6): texto corrido, máximo 68ch.

## Layout

Contenedor de 1336px con margen lateral de clamp(1rem, 4vw, 3rem). Una columna en celular; desde 960px, portada 5/7 con collage de tres fotos y retículas de 12 columnas. Ritmo de sección: clamp(3.5rem, 7vw, 6.5rem). Orden del inicio: quiénes somos, qué hacemos, misión y visión, ubicación, fotos, video, historias, valores y donar.

## Elevation & Depth

Casi plano. Una sola sombra cálida y difusa para la tarjeta de donación, el menú abierto y la barra del celular.

## Shapes

Formas redondeadas y amables: fotos de 20px, paneles de 32px y controles en forma de píldora.

## Components

### Buttons
- **Shape:** píldora, alto mínimo de 3.5rem.
- **Primary:** fondo coral, texto blanco.
- **Soft:** fondo durazno, texto coral hondo, para acciones secundarias.
- **Hover / Active:** se oscurece; al presionar baja a scale(0.97) en 140ms.

### Tarjeta de donación
Tarjeta blanca con cuatro montos en píldora y el botón "Donar" con el monto. Al cambiar de monto, las cifras que cambian ruedan en 200ms; sin animación si el usuario pide movimiento reducido.

### Galería y visor
Cuadrícula de fotos cuadradas. Al tocar una foto se abre un visor a pantalla completa con anterior, siguiente, contador, flechas del teclado y cierre con Esc.

### Navigation
Barra fija arriba con subrayado al pasar el mouse. En celular, botón Menú y barra inferior que aparece cuando ningún botón de donar está a la vista.

## Do's and Don'ts

### Do:
- **Do** usar fotos reales a todo color y dejar libres las caras.
- **Do** limitar el hover a dispositivos con mouse y respetar el movimiento reducido.

### Don't:
- **Don't** usar planos de color saturado ni la idea de bono: el usuario los rechazó.
- **Don't** publicar cifras de impacto hasta que la fundación las confirme.
- **Don't** agregar filtros ni tintes sobre las fotografías.
