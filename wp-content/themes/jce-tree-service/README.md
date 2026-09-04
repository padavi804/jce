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
  template-service-area.php  "Service Area" — the /service-area/ hub for town pages
  template-contact.php       "Contact / Estimate" — includes a styled estimate form
  template-emergency.php     "Emergency Tree Service" — target of the nav button
template-parts/              hero, proof-cards, stats, about-split, services-grid,
                             personal-estimate-steps, credentials, service-area,
                             reviews, cta-band, page-hero, plus the section blocks:
                             feature-list, service-scope, faq, highlight-cards,
                             milestones, locations-grid, related-services
inc/
  theme-setup.php            Supports, menus, fonts, image sizes, performance trims
  customizer.php             "Business Info" panel + jce_biz()/jce_tel()/jce_url() helpers
  icons.php                  Inline SVG icons, service icon map, media placeholders
  fields.php                 List-field parsing + the jce_band() section alternator
  custom-post-types.php      service, location, testimonial, landing_page
  meta-boxes.php             Admin fields for those CPTs and the page templates
  demo-content.php           Tools > JCE Example Content — the one-click importer
  schema.php                 LocalBusiness + Review (sitewide), Service (service pages)
  seo.php                    Meta description, canonical, Open Graph, breadcrumbs
assets/js/main.js            Mobile nav only — no jQuery, deferred
```

## The page set

| Page | Template | Content lives in |
|---|---|---|
| `/services/` | `archive-service.php` | Service posts + an optional `services-intro` Page for the editorial copy |
| `/services/{service}/` | `single-service.php` | The Service post: editor + "Service Page Sections" |
| `/service-area/` | `template-service-area.php` | The Page: editor + "Page Sections" |
| `/service-area/{town}/` | `single-location.php` | The Location post: editor + "Service Area Page Sections" |
| `/about/` | `template-about.php` | The Page: editor + "Page Sections" |

Archives can't hold editable copy of their own, so `/services/` looks for a Page with the
slug **`services-intro`** and pulls its content, Highlight Cards, and FAQ. It ships as a
draft — the copy renders on the archive whether or not the Page itself is published.

## How the sections are edited

Every section below the editor content on these pages is a field, not template code. The
fields are plain textareas — **one item per line, parts separated by a pipe**:

```
Dead branches you can see|Bare limbs still bare in July are not late to leaf out.
Mushrooms at the base|Fungal growth usually means decay is already established.
```

That format was chosen over a JavaScript repeater because it survives WordPress updates,
can be pasted straight out of a Google Doc, and is legible to someone who has never seen a
custom-field UI. Parsing lives in `inc/fields.php`.

**Empty and off mean different things.**

- **Blank** falls back to example copy, so a newly created Service renders as a complete
  page before anyone has typed anything. The site is never half-built while copy is being
  written, and the fallback doubles as a worked example of what belongs in the field.
- **A single dash (`-`)** renders nothing. This matters on a page carrying approved copy:
  Tree Removal has no price-factors section in its signed-off text, and falling back there
  would publish invented copy under the client's name. `none`, `hide`, and `off` work too.

Two sections have no fallback at all and simply don't render until filled: **proof blocks**
and **sub-services**. Inventing a customer quote is not the same kind of placeholder as
inventing a FAQ answer.

The editor body is the third case — it renders only when it has content. It sits first under
the hero at the largest body size, where placeholder prose is indistinguishable from real
copy at a glance.

FAQ fields on Services, Locations, and Pages are also published as **FAQPage schema**, which
is what earns the expandable questions under a search listing.

### Section grounds

`jce_band()` in `inc/fields.php` alternates section backgrounds white/cream in page order,
because sections render conditionally — a town with no neighborhoods listed skips that
block. Hardcoding the grounds would produce white-on-white collisions the moment a field
was left empty.

- `jce_band()` — for a section that always renders.
- `jce_band_if( $rows )` — for one that might not. A skipped section must **not** take a
  turn from the alternator, or the sections either side of it both land on the same ground.
- `jce_band( 'dark' )` — after a dark or green band, so the next light section is white.

### Service page anatomy

Beyond the shared sections, a Service page has its own hero and three page-specific blocks:

| Block | Field | Notes |
|---|---|---|
| Hero eyebrow / H1 | `Eyebrow`, `Page Headline (H1)` | The post title stays short — it is what cards and menus show — so the long keyword headline gets its own field. Past ~40 characters the H1 automatically steps down a size. |
| Hero buttons + area line | — | Estimate + call buttons come from the Customizer. The "Proudly serving…" line is generated from the Location posts by `jce_area_sentence()`, so adding a town updates it everywhere. |
| Trust strip | Customizer > Trust Signals | Rating, arborist count, years, and an optional fourth award slot (`Award / Badge`). Blank award = slot skipped. |
| Process steps | `Process Heading`, `Process Steps` | Beyond three steps the grid goes three-up, so five read as 3 + 2 rather than 4 + 1. |
| Proof blocks | `Proof Blocks` | `Heading \| Body \| Quote \| Who \| Photo caption`. Two captions separated by `//` render a before/after pair. A block with no quote **and** no body is dropped — the component will not publish a claim with no evidence under it. |
| Sub-services + Good to Know | `The List`, `"Good to Know" Points` | Each card gets a photo slot labelled with its own title, so the page doubles as a shot list until photos land. |

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

## Getting a site up

1. **Install into WordPress** — copy this folder to `wp-content/themes/` on the staging site.
   The repo holds the theme only, not a WP core install.
2. **Tools > JCE Example Content > Import** — creates 8 Services, 10 Locations, 6
   Testimonials, and the About / Service Area / Estimate / Emergency pages, each filled with
   realistic example copy and with its page template already assigned. Safe to re-run:
   anything whose slug already exists is skipped, so it never overwrites edited copy.
3. **Settings > Permalinks** — click Save once so the new Service and Location URLs resolve.
4. **Settings > Reading** — static front page = "Home", posts page = "Blog".
5. **Fill in Business Info** — the phone number in the Customizer default is a placeholder.

Three imported slugs are load-bearing because Customizer defaults link to them:
`/estimate/`, `/emergency-tree-service/` (the nav's Storm Emergency button and the sticky
mobile call bar), and `/service-area/` (what every town page breadcrumbs up to). The
importer reports it if WordPress assigns a different slug because something already holds
that URL.

## Still to do

1. **Upload the logo** (`content/JCE-logo-1200-white.png` suits the charcoal nav) via
   Customize > Site Identity.
2. **Replace the example copy** — the imported Services, Locations, and pages are filled with
   realistic placeholder text. It reads as finished, which is the point, but none of it is
   Joe's. Work through it in the WordPress editor; the section fields sit below the editor on
   each screen.
3. **Photography** — 19 optimized job photos ship in `assets/images/` (see above). Replacing
   any of them is a WordPress action, not a code one: set a Customizer hero image, or a
   Featured Image on the Service/Location/page. Uploads always beat the bundled file.
4. **Forms plugin** — `template-contact.php` ships a working, styled HTML form; swap it for a
   Contact Form 7 / Gravity Forms / WPForms shortcode so submissions actually send. The form
   markup uses theme classes the plugin output can reuse.
5. **Menus** — build the Primary menu from the imported pages. Until one is assigned, the
   fallback menu in `inc/theme-setup.php` renders, and its URLs already match the imported
   slugs.
6. **River Falls redirect plan** — the brief is explicit that River Falls organic rank is being
   defended. Inventory existing URLs before migrating and 301 anything that changes.
