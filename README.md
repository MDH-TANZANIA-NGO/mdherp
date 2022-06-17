<p align="center"><a href="https://www.mdh.or.tz" target="_blank"><img src="https://www.mdh.or.tz/images/nicepage-images/mdh.png" width="400"></a></p>


## MDH ERP

##Env Settings
<p>
Please Add the following superuser details on <b>.env </b>file to make the system work. 
This will help you when seeding a super user.
</p>
<p>
U_EMAIL= example@example.com <br>
U_PASSWORD=example_123
</p>

## Migrations
<p>To migrate the database, please do the following</p>
<p><b>php artisan migrate</b></p>
<p><b>php artisan migrate --path=database/migrations/v100</b></p>

## Seeding
<p>To seed the database, please do the following</p>
<p><b>php artisan db:seed</b></p>



