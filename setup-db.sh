#!/usr/bin/env bash
mkdir -p "$(dirname "$0")/db"
echo "supersecretpassword123" > "$(dirname "$0")/db/password.txt"
