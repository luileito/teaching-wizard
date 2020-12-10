#!/usr/bin/env bash

openssl req -x509 -out ./nginx/ssl/server.crt -keyout ./nginx/ssl/server.key \
  -newkey rsa:2048 -nodes -sha256 \
  -subj '/CN=localhost' -extensions EXT -config <( \
   printf "[dn]\nCN=localhost\n[req]\ndistinguished_name = dn\n[EXT]\nsubjectAltName=DNS:localhost\nkeyUsage=digitalSignature\nextendedKeyUsage=serverAuth")

# We might as well just use 2048 bit sized which is considerably faster to generate
# (4096 takes a few minutes [~6 on my MacBook Pro i7])
# or download from e.g. https://2ton.com.au/safeprimes/
openssl dhparam -out ./nginx/ssl/dhparam.pem 4096
