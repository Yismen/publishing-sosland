#!/bin/bash
set -e

echo "Running Laravel optimization commands..."

# Run general optimizations
php artisan optimize:clear
php artisan optimize

# Filament
php artisan filament:optimize-clear
php artisan filament:optimize

echo "Optimization complete. Starting Supervisor..."

# Start Supervisor to manage the processes
exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
