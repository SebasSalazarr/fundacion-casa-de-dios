# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Users

Primary: people in Colombia who give small amounts ($5.000 to $50.000 COP) from their phone, many arriving from Facebook or WhatsApp links. They have seconds to decide whether the foundation is real and whether their money reaches someone.

## Product Purpose

Website of Fundación Casa de Dios Fuente de Agua Viva, a non-profit in Turbo, Antioquia, Colombia. It works with children, adolescents, young people, families and communities through education in Christian principles, food support and community work. The site exists to earn trust and turn a visit into a donation. Success: a first-time visitor understands who the foundation is and donates, or contacts it by WhatsApp.

## Positioning

A local foundation with real people on the ground in Turbo: its own team in red shirts, its own halls and neighbourhoods, children and families photographed at real deliveries and gatherings. No large NGO can truthfully show that.

## Operating Context

Donations are processed by Wompi. Checkout is currently in test mode; a live switch needs production keys. Amounts offered today: $5.000, $10.000, $20.000, $50.000 COP. Contact is WhatsApp and Facebook. Visitors are mostly on phones, often on mobile data.

## Capabilities and Constraints

- Laravel 13, Blade, Vite, PHP 8.4. Must move off Netlify to a PHP host before launch.
- Impact figures are NOT confirmed and must not be published until the foundation confirms them. The legacy site contradicted itself (350 vs +300 children, 4 vs 10 years).
- Spanish only.

## Brand Commitments

- Name: Fundación Casa de Dios Fuente de Agua Viva.
- Logo: `public/img/logo.jpeg`, a white dove with a round seal holding a house and a family.
- Christian identity is real and stays visible, in the foundation's own words.
- Voice: warm, direct, plain Colombian Spanish.

## Evidence on Hand

- 62 unique real photographs and one institutional video in `public/img/` (e5, e21, e49 and e52 are duplicates). The user confirmed guardian authorization to publish photos of children.
- Two real testimonials, published without names: "Gracias a la fundación hoy puedo estudiar y soñar con un mejor futuro." and "Aquí encontré alimento, educación y amor."
- Mission, vision, objectives and seven values, carried over from the legacy site (index.html in git history).
- Address: Cl. 99 #15-95, Turbo, Antioquia. WhatsApp +57 312 856 6550. Facebook profile id 100083337127889.
- Absent, do not fabricate: impact figures, financial reports, legal registration data, partner names, named testimonials.

## Product Principles

1. Show the people, do not describe them: real photographs carry the proof.
2. Never claim what cannot be backed up; on a donation page one wrong number costs more than no number.
3. Donating is always one obvious step away, especially on a phone.
4. Dignity first: people are shown as protagonists, never as objects of pity.

## Accessibility & Inclusion

Must work on low-end phones and slow mobile data: light pages, readable type, large touch targets, WCAG AA contrast, reduced-motion respected.
