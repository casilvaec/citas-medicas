#!/bin/bash

# Ejecutar las migraciones de creación de tablas
php artisan migrate:refresh --path=database/migrations/2024_07_11_105503_create_tipos_identificacion_table.php
php artisan migrate:refresh --path=database/migrations/2024_07_11_105514_create_generos_table.php
php artisan migrate:refresh --path=database/migrations/2024_07_11_105525_create_ciudades_table.php
php artisan migrate:refresh --path=database/migrations/2024_07_11_105535_create_usuarios_table.php
php artisan migrate:refresh --path=database/migrations/2024_07_16_105546_create_pacientes_table.php
php artisan migrate:refresh --path=database/migrations/2024_07_16_105556_create_medicos_table.php
php artisan migrate:refresh --path=database/migrations/2024_07_11_105616_create_horarios_medicos_table.php
php artisan migrate:refresh --path=database/migrations/2024_07_11_105625_create_citas_table.php

# Ejecutar la migración de ajuste de claves foráneas
php artisan migrate:refresh --path=database/migrations/2024_07_21_000000_adjust_foreign_keys.php
