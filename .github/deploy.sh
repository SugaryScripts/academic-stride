#!/bin/bash

# Script to deploy Laravel public files to public_html
# Make sure to run this from your home directory or adjust paths accordingly

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Configuration - adjust these paths as needed
LARAVEL_DIR="~/repositories/academic-stride"  # Change to your Laravel project directory
PUBLIC_HTML_DIR="/public_html/garudacerdas.id"  # Change if your public_html is elsewhere

echo -e "${YELLOW}Laravel Deployment Script${NC}"
echo "=============================="

# Check if directories exist
if [ ! -d "$LARAVEL_DIR" ]; then
    echo -e "${RED}Error: Laravel directory not found at $LARAVEL_DIR${NC}"
    exit 1
fi

if [ ! -d "$PUBLIC_HTML_DIR" ]; then
    echo -e "${RED}Error: public_html directory not found at $PUBLIC_HTML_DIR${NC}"
    exit 1
fi

# Confirm action
echo -e "${YELLOW}WARNING: This will delete ALL files in $PUBLIC_HTML_DIR${NC}"
read -p "Are you sure you want to continue? (y/N): " -n 1 -r
echo
if [[ ! $REPLY =~ ^[Yy]$ ]]
then
    echo "Operation cancelled."
    exit 0
fi

# Delete all files in public_html
echo "Cleaning public_html directory..."
rm -rf $PUBLIC_HTML_DIR/* $PUBLIC_HTML_DIR/.* 2>/dev/null || true

# Copy Laravel public files
echo "Copying Laravel public files..."
cp -r $LARAVEL_DIR/public/* $PUBLIC_HTML_DIR/
cp $LARAVEL_DIR/public/.htaccess $PUBLIC_HTML_DIR/ 2>/dev/null || true

# Fix permissions (common issue with Laravel)
echo "Setting permissions..."
find $PUBLIC_HTML_DIR -type d -exec chmod 755 {} \;
find $PUBLIC_HTML_DIR -type f -exec chmod 644 {} \;

echo -e "${GREEN}Deployment completed successfully!${NC}"
echo "Please remember to:"
echo "1. Update your index.php paths if needed"
echo "2. Set up your .env file with database credentials"
echo "3. Run migrations if necessary"
