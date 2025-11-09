#!/bin/sh
script_name="flux"

echo "👔 Setting up Flux credentials..."
composer config http-basic.composer.fluxui.dev $FLUX_USERNAME $FLUX_LICENSE_KEY
