# Theme checks

Static checks for the JCE theme that run without a WordPress install.

```sh
./tools/check-all.sh
```

| Check | What it guards |
|---|---|
| `check-content.php` | Approved copy is complete; sections with no approved text are switched off with a dash rather than falling back to the theme's example copy; every pipe row has all its parts; slugs line up with the icon and photo maps; load-bearing page slugs the Customizer links to still exist. |
| `check-importer.php` | Runs the importer against a stand-in database to prove a protected post is never written to, in either mode — while an unprotected one still updates. Guards the `protect` flag mechanism with a synthetic example, independent of whether any real service currently uses it. |
| `check-bands.php` | Alternating section grounds never collide. A section that switches itself off must decline its turn (`jce_band_if()`), or the two visible sections either side of it both land on white. |
| `check-css-lists.php` | Component lists have their markers stripped; prose lists keep bullets and numbers. |
| `check-body-style.php` | The service body treatment is applied and scoped, and the standfirst never repeats the hero subheading. |

Lives outside `wp-content/themes/` so none of it deploys with the theme.

Each check is plain PHP with a small hand-written WordPress shim at the top — no
PHPUnit, no Composer, no `wp-env`. Delete the folder if you'd rather not keep it.
