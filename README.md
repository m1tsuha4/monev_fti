# Monev FTI Application Setup Guide

This guide will walk you through the steps to set up the Monev FTI application.

## Prerequisites
- PHP version "^7.3|^8.0"
- Laravel version "^8.75"

## Installation Steps

1. **Clone the Project**:
   ```
   git clone <repository_url>
   ```

2. **Create Environment File**:
   Create a `.env` file in the root directory of the project and configure your database settings.

3. **Database Setup**:
   Set up your database configuration in the `.env` file.

4. **Update Dependencies**:
   Run the following command in your terminal:
   ```
   composer update
   ```

5. **Create Symbolic Link for Storage**:
   Run the following command:
   ```
   php artisan storage:link
   ```

6. **Run Migrations**:
   Execute migrations to create necessary tables:
   ```
   php artisan migrate
   ```

7. **Seed Database with Prodi Data**:
   Seed the database with Prodi data:
   ```
   php artisan db:seed --class=ProdiSeeder
   ```

8. **Seed Database with Dosen Data**:
   Seed the database with Dosen data:
   ```
   php artisan db:seed --class=DosenSeeder
   ```

9. **Insert Data into tahun_akademik and kurikulums Tables**:
   Insert necessary data into `tahun_akademik` and `kurikulums` tables.

10. **Seed Database with MataKuliah Data**:
    Seed the database with MataKuliah data:
    ```
    php artisan db:seed --class=MataKuliahSeeder
    ```

11. **Seed Database with FormDokumen Data**:
    Seed the database with FormDokumen data:
    ```
    php artisan db:seed --class=FormDokumenSeeder
    ```

12. **Seed Database with FormSoal Data**:
    Seed the database with FormSoal data:
    ```
    php artisan db:seed --class=FormSoalSeeder
    ```

13. **Run the Application**:
    Start the Laravel development server:
    ```
    php artisan serve
    ```

Now you should be able to access the Monev FTI application by navigating to the URL provided by the `php artisan serve` command.

If you encounter any issues during the setup process, feel free to reach out for assistance.
