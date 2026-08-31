# JCE Tree Service — WordPress Theme

Custom theme built from the approved Creative Brief and Brand Brief in `../../../content/`.
Content lives in WordPress; this theme supplies templates, structure, styling, and schema.

## Brand

Colors sampled directly from the logo file:

| Token | Hex | Use |
|---|---|---|
| `--green` | `#3CB460` | Logo green. Utility bar, CTAs, accents. |
| `--charcoal` | `#242430` | Logo "JCE" lettering. Nav bar, stats band. |
| `--forest` / `--forest-900` | `#14311F` / `#0D2115` | Dark content bands, hero overlay, footer. |
| `--amber` | `#E8912F` | **Emergency only.** Deliberately not green so storm CTAs cut through. |
| `--cream` | `#F6F7F3` | Alternating section ground. |

Type: **Playfair Display** headings (echoes the logo's high-contrast serif) + **Libre Franklin**
body (a Franklin Gothic descendant — warmer and more "local trade" than a neutral geometric sans).
All design tokens are CSS custom properties at the top of `style.css`.

## Structure

```
style.css                    Design system + all component styles
functions.php                Bootstraps inc/
header.php                   Green utility bar → charcoal nav → Storm Emergency button
footer.php                   4-column dark footer + sticky mobile call bar
front-page.php               Homepage
archive-service.php          /services/ landing page
home.php                     Blog index          single.php   Blog post
page.php                     Generic page        404.php      Not found
index.php                    Required fallback / search / archives
single-service.php           A single service     single-location.php   A single town
single-landing_page.php      Paid/LSA landing page (chrome stripped, one CTA)
page-templates/
  template-about.php         "About Us"
  template-contact.php       "Contact / Estimate" — includes a styled estimate form
  template-emergency.php     "Emergency Tree Service" — target of the nav button
template-parts/              hero, proof-cards, stats, about-split, services-grid,
                             personal-estimate-steps, credentials, service-area,
                             reviews, cta-band, page-hero
inc/
  theme-setup.php            Supports, menus, fonts, image sizes, performance trims
  customizer.php             "Business Info" panel + jce_biz()/jce_tel()/jce_url() helpers
  icons.php                  Inline SVG icons + media placeholders
  custom-post-types.php      service, location, testimonial, landing_page
  meta-boxes.php             Admin fields for those CPTs
  schema.php                 LocalBusiness + Review (sitewide), Service (service pages)
  seo.php                    Meta description, canonical, Open Graph, breadcrumbs
assets/js/main.js            Mobile nav only — no jQuery, deferred
```

## Editable in WordPress, not code

- **Appearance > Customize > Business Info** — phone, email, address, hours, hero
  headline/subhead/image, star rating, review count, arborist count, emergency number and
  page URL, social links. Everything the site displays about the business reads from here.
- **Services / Locations / Testimonials / Landing Pages** — custom post types with their own
  admin fields. Service order (Page Attributes > Order) drives the homepage grid, so removal
  leads; the first card automatically gets the highlighted treatment.
- **Search Snippet** box on every post/page/CPT — sets the meta description Google shows.
- **Appearance > Menus** — Primary, plus three optional footer menus. A sensible fallback
  menu renders until one is assigned.

## Photography

Selected from `content/photos/` (126 originals) and processed into `assets/images/`.
Every file was orientation-corrected, cropped to its slot's aspect ratio, re-encoded
(progressive JPEG, q82), and **stripped of EXIF** — the originals are photos of customers'
homes and carried GPS coordinates.

| Slot | File | Shows |
|---|---|---|
| Homepage hero | `hero-home.jpg` (+`-1280`) | Crane lifting a limb above a home, open sky for the headline |
| Services hero | `hero-services.jpg` | Spider lift and climber working over a roof |
| About hero | `hero-about.jpg` | Fleet lined up on a residential street |
| Contact hero | `hero-contact.jpg` | Bucket truck under a mature street tree |
| Emergency hero | `hero-emergency.jpg` | Storm-felled tree across a lawn |
| About / homepage split | `crew-team-river-falls.jpg` | Three crew in front of a JCE truck reading "River Falls, WI" |
| Service cards ×8 | `service-*.jpg` | One per service, matched to the actual work |
| Location cards | `location-{river-falls,hudson,prescott}.jpg` | Town-specific job sites |

`crew-chainsaw-winter.jpg` is bundled but unused — an alternate for the About split.

**Regenerating:** the selection and crop parameters are not scripted into the theme. To
re-crop, re-run the processing step against `content/photos/` with a new focus value
(0 = top, 1 = bottom) for the affected image.

**Not used, deliberately:** `IMG_3488.jpeg` (a crew member in a truck cab with two young
children) reads perfectly for the family-owned story, but publishing identifiable photos of
minors is Joe's call, not ours. Parade photos (`IMG_5978`–`IMG_5984`) are a strong fit for the
community angle in the brand brief and are worth adding to an About or blog post once you
confirm the crowd shots are fine to publish.

## Performance & SEO notes

Built for the Core Web Vitals side of the visibility goal:
- No jQuery, no icon font, no CSS framework. Icons are inline SVG (zero extra requests).
- Only two font families, four weights total, `display=swap` + preconnect.
- Hero image gets `fetchpriority="high"` (it's the LCP element); everything else lazy-loads.
- Emoji scripts, oEmbed discovery, generator tags, and the classic block stylesheet are removed.
- LocalBusiness + Review + Service + BreadcrumbList schema. SEO meta output auto-disables if
  Yoast / Rank Math / AIOSEO / SEO Framework is installed, so no duplicate tags.

## Still to do

1. **Install into WordPress** — copy this folder to `wp-content/themes/` on the staging site.
   The repo holds the theme only, not a WP core install.
2. **Settings > Reading** — static front page = "Home", posts page = "Blog".
3. **Fill in Business Info** — the phone number in the Customizer default is a placeholder.
4. **Upload the logo** (`content/JCE-logo-1200-white.png` suits the charcoal nav) via
   Customize > Site Identity.
5. **Photography** — 19 optimized job photos ship in `assets/images/` (see below). Replacing any
   of them is a WordPress action, not a code one: set a Customizer hero image, or a Featured
   Image on the Service/Location/page. Uploads always beat the bundled file.
6. **Forms plugin** — `template-contact.php` ships a working, styled HTML form; swap it for a
   Contact Form 7 / Gravity Forms / WPForms shortcode so submissions actually send. The form
   markup uses theme classes the plugin output can reuse.
7. **Create the pages** and assign templates: About → "About Us", Contact and Estimate →
   "Contact / Estimate", Emergency → "Emergency Tree Service".
8. **River Falls redirect plan** — the brief is explicit that River Falls organic rank is being
   defended. Inventory existing URLs before migrating and 301 anything that changes.
