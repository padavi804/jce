#!/usr/bin/env bash
# All theme checks. Run from anywhere:  ./tools/check-all.sh
set -uo pipefail
cd "$(dirname "$0")/.."

THEME="wp-content/themes/jce-tree-service"
fail=0

echo "── PHP syntax ──"
while IFS= read -r f; do
  out=$(php -l "$f" 2>&1) || { echo "  $out"; fail=1; }
done < <(find "$THEME" -name '*.php')
[ $fail -eq 0 ] && echo "  clean"

for check in check-content check-importer check-bands check-css-lists check-body-style; do
  echo "── $check ──"
  php "tools/$check.php" || fail=1
done

echo
[ $fail -eq 0 ] && echo "ALL CHECKS PASSED" || echo "SOME CHECKS FAILED"
exit $fail
