#!/bin/sh

size=420

die () {
    echo >&2 "$@"
    exit 1
}

[[ "$#" -eq 2 ]] || die "input path and output path required"

convert $1  -gravity Center -crop "${size}x${size}"+0+0 +repage $2
