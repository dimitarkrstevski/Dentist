#### To setup the project please follow this instructions:

1. Clone this repo:
```
cd/destination_folder (on your local machine)
git clone {repo_rul}
```
2. Create a database on your local machine 

3. Generate key:
```
php artisan key:generate
```
4. Rename .env.example file to .env

5. Open .env file and setup the following variables:
```
DB_DATABASE= {your database name}
DB_USERNAME= {db username}
DB_PASSWORD= {db password}
```
6. Create a profile on https://mailtrap.io/

7. Create new project and inbox

8. In Integrations select Laravel 7+ and copy values

9. Paste values in .env
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME= {generated username}
MAIL_PASSWORD= {generated password}
MAIL_ENCRYPTION=tls
```
10. In order to create db tables, run this command:
```
php artisan migrate
```
11. Seed data (academies, skills) running this command:
```
php artisan db:seed
```
12. Run the following commands to optimize the asset:
```
npm install
npm run dev
```
13. Star application using this command:
```
php artisan serve
```
14. Follow the generated link and start using application
